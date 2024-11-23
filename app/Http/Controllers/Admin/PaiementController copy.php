<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paiement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaiementController extends Controller
{
    // Fonction pour afficher les paiements
    public function index()
    {
        $paiements = Paiement::with(['abonnement', 'modePaiement'])->get();
        return view('admin.paiements.index', compact('paiements'));
    }

    // Fonction pour afficher le formulaire de paiement
    public function creerPaiement($abonnementId)
    {
        $abonnement = Abonnement::findOrFail($abonnementId);
        return view('admin.paiements.creer', compact('abonnement'));
    }

    // Fonction pour enregistrer un paiement
    public function enregistrerPaiement(Request $request, $abonnementId)
    {
        $abonnement = Abonnement::findOrFail($abonnementId);

        Paiement::create([
            'abonnement_id' => $abonnement->id,
            'date_paiement' => now(),
            'montant' => $abonnement->planAbonnement->prix,
            'mode_paiement_id' => $request->input('mode_paiement_id'),
            'statut' => 'en attente',
        ]);

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès. En attente de validation.');
    }

    // Fonction pour valider un paiement
    public function validerPaiement($paiementId)
    {
        $paiement = Paiement::findOrFail($paiementId);

        // Mettre à jour le paiement et l'abonnement
        $paiement->update(['statut' => 'effectué']);
        $paiement->abonnement->update([
            'date_debut' => now(),
            'date_fin' => now()->addDays($paiement->abonnement->planAbonnement->duree_jours),
            'statut' => 'actif',
        ]);

        return redirect()->route('paiements.index')->with('success', 'Paiement validé et abonnement activé.');
    }
}
