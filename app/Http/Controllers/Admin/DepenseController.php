<?php

namespace App\Http\Controllers\Admin;

use App\Models\Caisse;
use App\Models\Depense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
       $quincaillerie_id = Auth::user()->quincaillerie_id;

       // Récupérer toutes les dépenses associées à la quincaillerie
       $depenses = Depense::where('quincaillerie_id', $quincaillerie_id)
           ->orderBy('date_depense', 'desc')
           ->get();

       // Récupérer toutes les caisses associées à la quincaillerie
       $caisses = Caisse::where('quincaillerie_id', $quincaillerie_id)->get();

       // Retourner la vue avec les dépenses et les caisses
       return view('admin.depenses.index', compact('depenses', 'caisses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer les caisses pour le formulaire de création
        $caisses = Caisse::where('quincaillerie_id', Auth::user()->quincaillerie_id)->get();

        return view('admin.depenses.add', compact('caisses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données de la requête
        $validated = $request->validate([
            'caisse_id' => 'required|exists:caisses,id',
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric',
            'date_depense' => 'required|date',
        ]);

        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        // Créer une nouvelle dépense
        $depense = Depense::create([
            'quincaillerie_id' => $quincaillerie_id,
            'caisse_id' => $validated['caisse_id'],
            'description' => $validated['description'],
            'montant' => $validated['montant'],
            'date_depense' => $validated['date_depense'],
        ]);

        // Mettre à jour le solde de la caisse
        $caisse = Caisse::findOrFail($depense->caisse_id);
        $caisse->solde_actuel -= $depense->montant;
        $caisse->save();

        return redirect()->route('admin.depense')->with('success', 'Dépense ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        // Trouver la dépense spécifiée
        $depense = Depense::where('id', $id)
            ->where('quincaillerie_id', $quincaillerie_id)
            ->firstOrFail();

        return view('admin.depenses.show', compact('depense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        // Trouver la dépense à éditer
        $depense = Depense::where('id', $id)
            ->where('quincaillerie_id', $quincaillerie_id)
            ->firstOrFail();

        // Récupérer les caisses pour le formulaire d'édition
        $caisses = Caisse::where('quincaillerie_id', $quincaillerie_id)->get();

        return view('admin.depenses.edit', compact('depense', 'caisses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données de la requête
        $validated = $request->validate([
            'caisse_id' => 'required|exists:caisses,id',
            'description' => 'required|string|max:255',
            'montant' => 'required|numeric',
            'date_depense' => 'required|date',
        ]);

        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        // Trouver la dépense à mettre à jour
        $depense = Depense::where('id', $id)
            ->where('quincaillerie_id', $quincaillerie_id)
            ->firstOrFail();

        // Mettre à jour le solde de la caisse avant la mise à jour
        $ancienneCaisse = Caisse::findOrFail($depense->caisse_id);
        $ancienneCaisse->solde_actuel += $depense->montant;
        $ancienneCaisse->save();

        // Mettre à jour la dépense
        $depense->update([
            'caisse_id' => $validated['caisse_id'],
            'description' => $validated['description'],
            'montant' => $validated['montant'],
            'date_depense' => $validated['date_depense'],
        ]);

        // Mettre à jour le solde de la nouvelle caisse
        $nouvelleCaisse = Caisse::findOrFail($validated['caisse_id']);
        $nouvelleCaisse->solde_actuel -= $validated['montant'];
        $nouvelleCaisse->save();

        return redirect()->route('admin.depense')->with('success', 'Dépense mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        // Trouver la dépense à supprimer
        $depense = Depense::where('id', $id)
            ->where('quincaillerie_id', $quincaillerie_id)
            ->firstOrFail();

        // Mettre à jour le solde de la caisse
        $caisse = Caisse::findOrFail($depense->caisse_id);
        $caisse->solde_actuel += $depense->montant;
        $caisse->save();

        // Supprimer la dépense
        $depense->delete();

        return redirect()->route('admin.depense')->with('success', 'Dépense supprimée avec succès.');
    }
}
