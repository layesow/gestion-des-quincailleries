<?php

namespace App\Http\Controllers\Admin;

use App\Models\Caisse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $caisses = Caisse::where('quincaillerie_id', $user->quincaillerie_id)->get(); // Filtrer les caisses par quincaillerie de l'utilisateur
        return view('admin.caisses.index', compact('caisses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer les quincailleries disponibles pour l'utilisateur
        $quincailleries = Quincaillerie::where('id', Auth::user()->quincaillerie_id)->get();

        // Afficher le formulaire de création
        return view('admin.caisses.add', compact('quincailleries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string|max:255',
            'solde_initial' => 'required|numeric|min:0',
            'solde_actuel' => 'required|numeric|min:0',
        ]);

        // Créer une nouvelle caisse associée à la quincaillerie de l'utilisateur connecté
        Caisse::create([
            'nom' => $request->input('nom'),
            'solde_initial' => $request->input('solde_initial'),
            'solde_actuel' => $request->input('solde_actuel'),
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.caisses')
                         ->with('success', 'Caisse créée avec succès.');
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
        // Vérifier l'appartenance de la caisse à la quincaillerie de l'utilisateur
        if ($caisse->quincaillerie_id != Auth::user()->quincaillerie_id) {
            return redirect()->route('admin.caisses.index')
                             ->with('error', 'Accès non autorisé.');
        }

        // Récupérer les quincailleries disponibles pour l'utilisateur
        $quincailleries = Quincaillerie::where('id', Auth::user()->quincaillerie_id)->get();

        // Afficher le formulaire d'édition
        return view('admin.caisses.edit', compact('caisse', 'quincailleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Vérifier l'appartenance de la caisse à la quincaillerie de l'utilisateur
        // Récupérer la caisse en utilisant l'ID et vérifier l'appartenance
        $caisse = Caisse::where('id', $id)
                        ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                        ->firstOrFail();


        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string|max:255',
            'solde_initial' => 'required|numeric|min:0',
            'solde_actuel' => 'required|numeric|min:0',
        ]);

        // Mettre à jour la caisse
        $caisse->update([
            'nom' => $request->input('nom'),
            'solde_initial' => $request->input('solde_initial'),
            'solde_actuel' => $request->input('solde_actuel'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.caisses')
                         ->with('success', 'Caisse mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Vérifier l'appartenance de la caisse à la quincaillerie de l'utilisateur
        if ($caisse->quincaillerie_id != Auth::user()->quincaillerie_id) {
            return redirect()->route('admin.caisses')
                             ->with('error', 'Accès non autorisé.');
        }

        // Supprimer la caisse
        $caisse->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.caisses')
                         ->with('success', 'Caisse supprimée avec succès.');
    }

    /* public function correctSoldeInitial(Request $request, string $id)
    {
        // Vérifier l'appartenance de la caisse à la quincaillerie de l'utilisateur
        $caisse = Caisse::where('id', $id)
                        ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                        ->firstOrFail();

        // Validation des données de la requête
        $request->validate([
            'solde_initial' => 'required|numeric|min:0',
        ]);

        // Mettre à jour solde_initial et solde_actuel
        $caisse->update([
            'solde_initial' => $request->input('solde_initial'),
            'solde_actuel' => $request->input('solde_initial'), // Mettre à jour solde_actuel pour refléter solde_initial
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.caisses.index')
                        ->with('success', 'Valeur du solde initial corrigée avec succès.');
    } */

    //form
    /* <!-- Formulaire pour corriger solde_initial -->
    <form action="{{ route('admin.caisses.correctSolde', ['id' => $caisse->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="solde_initial">Solde Initial</label>
            <input type="text" name="solde_initial" class="form-control" id="solde_initial" value="{{ old('solde_initial', $caisse->solde_initial) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Corriger</button>
    </form> */

    //Route::put('/caisses/{id}/corriger', [CaisseController::class, 'correctSoldeInitial'])->name('admin.caisses.correctSolde');



}
