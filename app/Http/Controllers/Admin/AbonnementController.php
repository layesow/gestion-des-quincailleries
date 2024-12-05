<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paiement;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Models\PlanAbonnement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbonnementController extends Controller
{
    public function index()
    {
        $abonnements = Abonnement::with(['quincaillerie', 'planAbonnement', 'paiements'])->get();

        return view('admin.abonnements.index', compact('abonnements'));
    }

    /**
     * Display a listing of the resource.
     */
    public function pack()
    {
        // Récupérer tous les plans d'abonnement actifs
        $plans = PlanAbonnement::where('statut', 'actif')->get();

        return view('admin.abonnements.pack', compact('plans'));
    }



    /* public function souscrire($planId)
    {
        // Récupérer l'utilisateur connecté et sa quincaillerie
        $quincaillerie = Auth::user()->quincaillerie;

        if (!$quincaillerie) {
            return redirect()->back()->with('error', 'Vous n\'avez pas de quincaillerie associée.');
        }

        // Récupérer le plan d'abonnement
        $plan = PlanAbonnement::findOrFail($planId);

        return view('admin.abonnements.souscrire', compact('plan', 'quincaillerie'));
    } */
    public function souscrire($planId)
    {
        // Récupérer l'utilisateur connecté et sa quincaillerie
        $quincaillerie = Auth::user()->quincaillerie;

        if (!$quincaillerie) {
            return redirect()->back()->with('error', 'Vous n\'avez pas de quincaillerie associée.');
        }

        // Récupérer le plan d'abonnement
        $plan = PlanAbonnement::findOrFail($planId);

        // Vérifier s'il y a un abonnement en attente ou actif pour cette quincaillerie
        $abonnementExistant = Abonnement::where('quincaillerie_id', $quincaillerie->id)
            ->whereIn('statut', ['en attente', 'actif'])
            ->exists();

        if ($abonnementExistant) {
            return redirect()->back()->with('error', 'Vous avez déjà un abonnement en attente ou actif.');
        }

        // Si aucune condition de vérification n'est remplie, afficher la vue de souscription
        return view('admin.abonnements.souscrire', compact('plan', 'quincaillerie'));
    }


    public function enregistrerSouscription(Request $request, $planId)
    {
        $quincaillerie = Auth::user()->quincaillerie;

        if (!$quincaillerie) {
            return redirect()->back()->with('error', 'Vous n\'avez pas de quincaillerie associée.');
        }

        $plan = PlanAbonnement::findOrFail($planId);

        // Création de l'abonnement en attente
        $abonnement = Abonnement::create([
            'quincaillerie_id' => $quincaillerie->id,
            'plan_abonnement_id' => $plan->id, // Utilisez ici plan->id qui correspond à 'plan_abonnement_id'
            'date_debut' => null, // À définir après paiement
            'date_fin' => null,   // À définir après paiement
            'statut' => 'en attente',
        ]);

        // Création d'un paiement en attente pour cet abonnement
        Paiement::create([
            'abonnement_id' => $abonnement->id,
            'date_paiement' => now(),
            'montant' => $plan->prix,
            'mode_paiement_id' => null, // ID du mode de paiement, à ajuster si nécessaire
            'statut' => 'en attente',
        ]);

        return redirect()->route('abonnements.index')->with('success', 'Souscription enregistrée avec succès. Votre paiement est en attente.');
    }


    public function miseAJourAbonnement($abonnementId)
    {
        // Récupérer l'abonnement correspondant
        $abonnement = Abonnement::findOrFail($abonnementId);

        // Récupérer le paiement associé à l'abonnement qui est marqué comme effectué
        $paiement = $abonnement->paiements()->where('statut', 'effectué')->first();

        if ($paiement) {
            // Mise à jour de l'abonnement avec la date de début, date de fin et statut
            $abonnement->update([
                'date_debut' => now(),
                'date_fin' => now()->addDays($abonnement->planAbonnement->duree_jours),
                'statut' => 'actif',
            ]);

            // Mise à jour du statut du paiement si nécessaire
            $paiement->update(['statut' => 'effectué']);
        }

        // Redirection avec un message de succès
        return redirect()->route('abonnements.index')->with('success', 'Abonnement activé avec succès.');
    }


    // app/Http/Controllers/Admin/AbonnementController.php
    public function validerPaiement(Request $request, $abonnementId)
    {
        // Récupérer l'abonnement
        $abonnement = Abonnement::findOrFail($abonnementId);

        // Vérifier si l'abonnement a déjà un paiement en attente
        $paiement = $abonnement->paiements()->where('statut', 'en attente')->first();

        if ($paiement) {
            // Mise à jour du statut du paiement
            $paiement->update([
                'statut' => 'effectué',
                'date_paiement' => now(),
            ]);

            // Mise à jour de l'abonnement après validation du paiement
            $abonnement->update([
                'date_debut' => now(),
                'date_fin' => now()->addDays($abonnement->planAbonnement->duree_jours),
                'statut' => 'actif',
            ]);

            return redirect()->route('abonnements.index')->with('success', 'Paiement validé et abonnement activé.');
        }

        return redirect()->back()->with('error', 'Aucun paiement en attente trouvé pour cet abonnement.');
    }


}
