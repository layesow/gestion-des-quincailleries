<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PlanAbonnement;
use App\Http\Controllers\Controller;

class PlanAbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = PlanAbonnement::all(); // Récupère tous les plans d'abonnement
        return view('admin.plan_abonnements.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plan_abonnements.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree_jours' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'statut' => 'required|in:actif,inactif',
        ]);

        PlanAbonnement::create($request->all());

        return redirect()->route('admin.plan')->with('success', 'Plan d\'abonnement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         // Trouvez le plan d'abonnement par ID
        $planAbonnement = PlanAbonnement::findOrFail($id);

        // Retournez la vue d'édition avec les données du plan d'abonnement
        return view('admin.plan_abonnements.edit', compact('planAbonnement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validez les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree_jours' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'statut' => 'required|in:actif,inactif',
        ]);

        // Trouvez le plan d'abonnement par ID
        $planAbonnement = PlanAbonnement::findOrFail($id);

        // Mettez à jour les données du plan d'abonnement
        $planAbonnement->update($request->all());

        // Redirigez avec un message de succès
        return redirect()->route('admin.plan')->with('success', 'Plan d\'abonnement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer le plan d'abonnement en fonction de l'ID
        $plan = PlanAbonnement::findOrFail($id);

        // Supprimer le plan
        $plan->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.plan')->with('success', 'Plan d\'abonnement supprimé avec succès.');

    }
}
