<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rapport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer les rapports de la quincaillerie de l'utilisateur connecté
        $rapports = Rapport::where('quincaillerie_id', Auth::user()->quincaillerie_id)->get();
        return view('admin.rapports.index', compact('rapports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Afficher le formulaire de création de rapport
        return view('admin.rapports.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_rapport' => 'required|date',
        ]);

        // Créer un nouveau rapport pour la quincaillerie de l'utilisateur connecté
        Rapport::create([
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'date_rapport' => $request->input('date_rapport'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.rapport')
                         ->with('success', 'Rapport créé avec succès.');
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
        // Récupérer le rapport et vérifier l'appartenance à la quincaillerie de l'utilisateur
        $rapport = Rapport::where('id', $id)
                          ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                          ->firstOrFail();

        // Afficher le formulaire d'édition
        return view('admin.rapports.edit', compact('rapport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupérer le rapport et vérifier l'appartenance à la quincaillerie de l'utilisateur
        $rapport = Rapport::where('id', $id)
                          ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                          ->firstOrFail();

        // Validation des données de la requête
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_rapport' => 'required|date',
        ]);

        // Mettre à jour le rapport
        $rapport->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'date_rapport' => $request->input('date_rapport'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.rapport')
                         ->with('success', 'Rapport mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer le rapport et vérifier l'appartenance à la quincaillerie de l'utilisateur
        $rapport = Rapport::where('id', $id)
                          ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                          ->firstOrFail();

        // Supprimer le rapport
        $rapport->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.rapport')
                         ->with('success', 'Rapport supprimé avec succès.');
    }
}
