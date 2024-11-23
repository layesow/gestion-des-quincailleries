<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id; // Supposons que le modèle User a la relation quincaillerie_id

        // Récupérer les catégories associées à cette quincaillerie
        $categories = Categorie::where('quincaillerie_id', $quincaillerie_id)->get();

        // Renvoyer la vue avec les catégories filtrées
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Afficher le formulaire de création
        return view('admin.categories.add');
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

        // Créer une nouvelle catégorie associée à la quincaillerie de l'utilisateur connecté
        Categorie::create([
            'nom' => $request->input('nom'),
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.categories')
                         ->with('success', 'Catégorie créée avec succès.');
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
        // Récupérer la catégorie en utilisant l'ID et vérifier l'appartenance
        $categorie = Categorie::where('id', $id)
                              ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                              ->firstOrFail();

        // Afficher le formulaire d'édition
        return view('admin.categories.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Récupérer la catégorie en utilisant l'ID et vérifier l'appartenance
        $categorie = Categorie::where('id', $id)
                              ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                              ->firstOrFail();

        // Mettre à jour la catégorie
        $categorie->update([
            'nom' => $request->input('nom'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.categories')
                         ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer la catégorie en utilisant l'ID et vérifier l'appartenance
        $categorie = Categorie::where('id', $id)
                              ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                              ->firstOrFail();

        // Supprimer la catégorie
        $categorie->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.categories')
                         ->with('success', 'Catégorie supprimée avec succès.');
    }
}
