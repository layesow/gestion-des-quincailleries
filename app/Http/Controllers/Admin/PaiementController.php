<?php

// app/Http/Controllers/Admin/PaiementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use App\Models\Abonnement;
use App\Models\ModePaiement;
use App\Models\ModePaiementAbonne;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        /* $paiements = Paiement::with(['abonnement', 'modePaiement'])->get();
        return view('admin.paiements.index', compact('paiements')); */
        $paiements = Paiement::with(['abonnement', 'modePaiementAbonne'])->get();
        $modesPaiementAbonne = ModePaiementAbonne::all(); // Assure-toi que tu as un modèle ModePaiement pour cela
        return view('admin.paiements.index', compact('paiements', 'modesPaiementAbonne'));
    }


    public function enregistrerPaiement(Request $request, $abonnementId)
    {
        $abonnement = Abonnement::findOrFail($abonnementId);

        Paiement::create([
            'abonnement_id' => $abonnement->id,
            'date_paiement' => now(),
            'montant' => $abonnement->planAbonnement->prix,
            'mode_paiement_abonne_id' => $request->input('mode_paiement_abonne_id'),
            'statut' => 'en attente',
        ]);

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès. En attente de validation.');
    }

    public function validerPaiement($paiementId)
    {
        $paiement = Paiement::findOrFail($paiementId);

        $paiement->update(['statut' => 'effectué']);
        $paiement->abonnement->update([
            'date_debut' => now(),
            'date_fin' => now()->addDays($paiement->abonnement->planAbonnement->duree_jours),
            'statut' => 'actif',
        ]);

        return redirect()->route('paiements.index')->with('success', 'Paiement validé et abonnement activé.');
    }


    public function mettreAJourMode(Request $request, $paiement_id)
{
    // Debugger la requête pour voir ce qui est envoyé
    //dd($request->all());  // Cela vous montrera toutes les données envoyées dans la requête

    // Validation
    $request->validate([
        'mode_paiement_abonne_id' => 'required|exists:modes_paiement_abonne,id',
    ]);

    // Trouver le paiement
    $paiement = Paiement::findOrFail($paiement_id);

    // Mise à jour du mode de paiement
    $paiement->update([
        'mode_paiement_abonne_id' => $request->input('mode_paiement_abonne_id'),
    ]);

    // Retourner à la liste des paiements avec un message de succès
    return redirect()->route('paiements.index')->with('success', 'Mode de paiement mis à jour avec succès.');
}


}

