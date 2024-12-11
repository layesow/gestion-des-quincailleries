<?php

namespace App\Http\Controllers\Admin;

use App\Models\ModePaiement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ModePaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $modePaiements = ModePaiement::where('quincaillerie_id', $user->quincaillerie_id)->get();
        return view('admin.mode_paiement.index', compact('modePaiements'));
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
        ModePaiement::create([
            'nom' => $request->input('nom'),
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.modePaiement')
                         ->with('success', 'Mode de paiement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Afficher les détails d'un mode de paiement
        return view('admin.modes_paiement.show', compact('modePaiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le mode de paiement en utilisant l'ID et vérifier l'appartenance à la quincaillerie de l'utilisateur
        $modePaiement = ModePaiement::where('id', $id)
            ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
            ->firstOrFail(); // Utiliser firstOrFail pour récupérer le mode de paiement ou lancer une exception si non trouvé

        // Vérifier si le mode de paiement appartient bien à la quincaillerie de l'utilisateur
        if ($modePaiement->quincaillerie_id != Auth::user()->quincaillerie_id) {
            return redirect()->route('admin.modePaiement')
                            ->with('error', 'Accès non autorisé.');
        }

        // Afficher le formulaire d'édition
        return view('admin.mode_paiement.edit', compact('modePaiement'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupérer le mode de paiement en utilisant l'ID et vérifier l'appartenance à la quincaillerie de l'utilisateur
        $modePaiement = ModePaiement::where('id', $id)
            ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
            ->firstOrFail(); // Utiliser firstOrFail pour gérer les cas où le mode de paiement n'existe pas

        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Mettre à jour le mode de paiement
        $modePaiement->update([
            'nom' => $request->input('nom'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.modePaiement')
                        ->with('success', 'Mode de paiement mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer le mode de paiement en utilisant l'ID et vérifier l'appartenance à la quincaillerie de l'utilisateur
        $modePaiement = ModePaiement::where('id', $id)
            ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
            ->firstOrFail(); // Utiliser firstOrFail pour gérer les cas où le mode de paiement n'existe pas

        // Supprimer le mode de paiement
        $modePaiement->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.modePaiement')
                        ->with('success', 'Mode de paiement supprimé avec succès.');
    }

}
