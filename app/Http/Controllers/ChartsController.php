<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Recette;
use App\Models\Rubrique;
use App\Models\Solde;
use Illuminate\Http\Request;

class ChartsController extends Controller
{


    public function chart()
    {
        // Fetch the solde chart data
        $soldeData = Solde::orderBy('annee')->get();
        $years = $soldeData->pluck('annee');
        $caisseValues = $soldeData->pluck('caisse');
        $banqueValues = $soldeData->pluck('banque');
        $latestSolde = Solde::orderBy('annee', 'desc')->first();
        $latestCaisse = $latestSolde->caisse;
        $latestBanque = $latestSolde->banque;

        // Fetch the recette and depense rubrique data
        $recetteRubrique = $this->recetteRubrique();
        $depenseRubrique = $this->depenseRubrique();

        // Prepare the chart data
        $data = [
            'years' => $years,
            'caisseValues' => $caisseValues,
            'banqueValues' => $banqueValues,
            'latestCaisse' => $latestCaisse,
            'latestBanque' => $latestBanque,
            'recetteRubrique' => $recetteRubrique,
            'depenseRubrique' => $depenseRubrique,
        ];

        // Pass the chart data to the view
        return view('home', compact('data'));
    }

    public function recetteRubrique()
    {
        $rubriques = Rubrique::where('for', false)->get();
        $data = [];
        foreach ($rubriques as $rubrique) {
            if ($rubrique->libelle !== 'Augmentation de la banque') {
                $amount = Recette::where('rubrique_id', $rubrique->id)->where('approuve', true)->sum('montant');
                $data[] = ['label' => $rubrique->libelle, 'amount' => $amount];
            }
        }
        return $data;
    }
    public function depenseRubrique()
    {
        $rubriques = Rubrique::where('for', true)->get();
        $data = [];
        foreach ($rubriques as $rubrique) {
            $amount = Depense::where('rubrique_id', $rubrique->id)->where('approuve', true)->sum('montant');
            $data[] = ['label' => $rubrique->libelle, 'amount' => $amount];
        }
        return $data;
    }

    public function soldeStatistics()
    {
        // Fetch all the solde data
        $soldeData = Solde::orderBy('annee')->get();

        // Extract the years, caisse, and banque values from the data
        $years = $soldeData->pluck('annee');
        $caisseValues = $soldeData->pluck('caisse');
        $banqueValues = $soldeData->pluck('banque');

        // Get the latest caisse and banque values
        $latestSolde = Solde::orderBy('annee', 'desc')->first();
        $latestCaisse = $latestSolde->caisse;
        $latestBanque = $latestSolde->banque;

        // Pass the data to the view
        return view('solde.index', compact('years', 'caisseValues', 'banqueValues', 'latestCaisse', 'latestBanque'));
    }


}
