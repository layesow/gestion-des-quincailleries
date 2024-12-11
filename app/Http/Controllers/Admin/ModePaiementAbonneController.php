<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ModePaiementAbonne;

class ModePaiementAbonneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupère tous les modes de paiement abonnés sans filtrer par quincaillerie_id
        $modePaiementAbonnes = ModePaiementAbonne::all();

        // Passe les données à la vue
        return view('admin.mode_paiement_abonne.index', compact('modePaiementAbonnes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Afficher le formulaire de création
        return view('admin.modes_paiement.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Créer un nouveau mode de paiement associé à la quincaillerie de l'utilisateur
        ModePaiementAbonne::create([
            'nom' => $request->input('nom'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.modePaiementAbonne')
                         ->with('success', 'Mode de paiement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher les détails d'un mode de paiement
        return view('admin.modes_paiement_abonne.show', compact('modePaiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le mode de paiement par son identifiant (id)
        $modePaiementAbonne = ModePaiementAbonne::findOrFail($id);

        // Afficher le formulaire d'édition
        return view('admin.mode_paiement_abonne.edit', compact('modePaiementAbonne'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupérer le mode de paiement par son ID
        $modePaiementAbonne = ModePaiementAbonne::findOrFail($id); // Trouver directement par ID

        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Mettre à jour le mode de paiement
        $modePaiementAbonne->update([
            'nom' => $request->input('nom'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.modePaiementAbonne')
                        ->with('success', 'Mode de paiement mis à jour avec succès.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer le mode de paiement par son ID
        $modePaiementAbonne = ModePaiementAbonne::findOrFail($id); // Trouver directement par ID

        // Supprimer le mode de paiement
        $modePaiementAbonne->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.modePaiementAbonne')
                        ->with('success', 'Mode de paiement supprimé avec succès.');
    }


}
