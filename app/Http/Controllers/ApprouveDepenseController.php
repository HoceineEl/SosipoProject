<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Rubrique;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApprouveDepenseController extends Controller
{
    public function index()
    {
        // Get all rubriques where 'for' column is true
        $rubriques = Rubrique::where('for', true)->get();
        // Get all users
        $users = User::get();
        // Get all invalid depenses (where 'approuve' column is false)
        $depensesInvalide = Depense::where('approuve', false)->get();

        // Create an array of data to be passed to the view
        $data = [
            'depensesInvalide' => $depensesInvalide,
            'users' => $users,
            'rubriques' => $rubriques,
        ];

        // Load the 'approuve.showDepense' view with the data
        return view('approuve.showDepense', $data);
    }

    public function approved($id)
    {
        // Find the Depense with the given $id
        $depense = Depense::find($id);
        // Set 'approuve' column to true
        $depense->approuve = true;

        // Get the Solde with id "1"
        $solde = Solde::find("1");

        // Check the mode of payment for the Depense
        if ($depense->modepaiement == "1") {
            // If it's paid with bank, check if the bank balance will be negative after subtracting the Depense amount
            if ($solde->banque - $depense->montant < 0)
                // If so, redirect to the same page with an error message
                return redirect()->route('approuve.depense.show')->withError('Solde banque insuffisant.');
            // Subtract the Depense amount from the bank balance
            $solde->banque -= $depense->montant;
        } else {
            // If it's paid with cash, check if the cash balance will be negative after subtracting the Depense amount
            if ($solde->caisse - $depense->montant < 0)
                // If so, redirect to the same page with an error message
                return redirect()->route('approuve.depense.show')->withError('Solde caisse insuffisant.');
            // Subtract the Depense amount from the cash balance
            $solde->caisse -= $depense->montant;
        }

        // Save the Solde and Depense changes to the database
        $solde->save();
        $depense->save();

        // Redirect to the same page with a success message
        return redirect()->route('approuve.depense.show')->withSuccess('La depense approuvé avec succès.');
    }

    public function destroy($id)
    {
        // Find the Depense with the given $id
        $depense = Depense::find($id);
        // Delete the Depense from the database
        $depense->delete();
        // Delete the file associated with the Depense from the storage
        Storage::delete('app/', $depense->feuille);

        // Redirect back to the same page with a success message
        return back()->withSuccess('Dépense annulée avec succès.');
    }
}
