<?php

// app/Http/Controllers/Admin/PaiementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use App\Models\Abonnement;
use App\Models\ModePaiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        /* $paiements = Paiement::with(['abonnement', 'modePaiement'])->get();
        return view('admin.paiements.index', compact('paiements')); */
        $paiements = Paiement::with(['abonnement', 'modePaiement'])->get();
    $modesPaiement = ModePaiement::all(); // Assure-toi que tu as un modèle ModePaiement pour cela
    return view('admin.paiements.index', compact('paiements', 'modesPaiement'));
    }


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
        $paiement = Paiement::findOrFail($paiement_id);
        $paiement->update([
            'mode_paiement_id' => $request->input('mode_paiement_id'),
        ]);

        return redirect()->route('paiements.index')->with('success', 'Mode de paiement mis à jour avec succès.');
    }

}

