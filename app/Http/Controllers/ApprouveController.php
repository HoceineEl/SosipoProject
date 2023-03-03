<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Rubrique;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;

class ApprouveController extends Controller
{
    public function index()
    {
        $rubriques = Rubrique::where('for', true)->get();
        $users = User::get();
        $recettesInvalide = Recette::where('approuve', false)->get();
        $data = [
            'recettesInvalide' => $recettesInvalide,
            'users' => $users,
            'rubriques' => $users,
        ];
        return view('approuve.show', $data);
    }
    public function approved($id)
    {
        $recette = Recette::find($id);
        $recette->approuve = true;
        $solde = Solde::find("1");
        if ($recette->modepaiement == "1") {
            $solde->banque += $recette->montant;
        } else  $solde->caisse += $recette->montant;
        $solde->save();
        $recette->save();
        return redirect()->route('approuve.show')->withSuccess('La recette aprouvé avec succes.');
    }

    public function destroy($id)
    {
        $recette = Recette :: find($id);
        $recette->delete();
        return back()->withSuccess('Recette annulé avec succes.');
    }
}
