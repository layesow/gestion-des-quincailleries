<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Vente;
use App\Models\Caisse;
use App\Models\Produit;
use App\Models\ModePaiement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ID de la quincaillerie de l'utilisateur connecté
        $quincaillerieId = auth()->user()->quincaillerie_id;

        // Récupérer tous les produits de cette quincaillerie
        $produits = Produit::where('quincaillerie_id', $quincaillerieId)->get();

        // Récupérer tous les modes de paiement
        $modesPaiement = ModePaiement::where('quincaillerie_id', $quincaillerieId)->get();

        // Récupérer toutes les caisses de la quincaillerie
        $caisses = Caisse::where('quincaillerie_id', $quincaillerieId)->get();

        // Récupérer les ventes en cours pour la quincaillerie
        $ventesEnCours = Vente::with(['produits', 'user', 'caisse', 'modePaiement'])
            ->where('quincaillerie_id', $quincaillerieId)
            ->get();

        return view('admin.pos.index', compact('produits', 'modesPaiement', 'caisses', 'ventesEnCours'));
    }


    /**
     * Store a newly created resource in storage.
     */
    /* public function store(Request $request)
    {
        // Calculer le total de la vente
        $total = 0;
        $produits = Produit::findMany(array_column($request->produits, 'id')); // Récupérer tous les produits en une seule requête

        foreach ($request->produits as $produitData) {
            // Récupérer le produit
            $produit = $produits->firstWhere('id', $produitData['id']);

            // Calculer le total pour chaque produit
            $total += $produit->prix * $produitData['quantite'];
        }

        // Assurez-vous que 'modes_paiement_id' est bien fourni dans la requête
        if (!$request->has('modes_paiement_id')) {
            return redirect()->back()->with('error', 'Le mode de paiement est requis.');
        }

        // Créer la vente en incluant le 'mode_paiement_id' et le 'total'
        $vente = Vente::create([
            'client_nom' => $request->client_nom,
            'client_telephone' => $request->client_telephone,
            'quincaillerie_id' => auth()->user()->quincaillerie_id,
            'user_id' => auth()->id(),
            'caisse_id' => $request->caisse_id,
            'modes_paiement_id' => $request->modes_paiement_id, // Ajoutez le mode de paiement ici
            'date_vente' => now(),
            'total' => $total, // Ajoutez le total calculé
        ]);

        // Ajouter les produits à la vente
        foreach ($request->produits as $produitData) {
            $produit = $produits->firstWhere('id', $produitData['id']);

            // Calculer le total du produit
            $totalProduit = $produit->prix * $produitData['quantite'];

            // Ajouter le produit à la vente dans la table pivot
            $vente->produits()->attach($produitData['id'], [
                'quantite' => $produitData['quantite'],
                'prix_unitaire' => $produit->prix,
                'total' => $totalProduit, // Ajout du total calculé pour le produit
            ]);
        }

        return redirect()->back()->with('success', 'Vente enregistrée avec succès !');
    } */
    /* public function store(Request $request)
    {
        // Calculer le total de la vente
        $total = 0;
        $produits = Produit::findMany(array_column($request->produits, 'id')); // Récupérer tous les produits en une seule requête

        foreach ($request->produits as $produitData) {
            // Récupérer le produit
            $produit = $produits->firstWhere('id', $produitData['id']);

            // Calculer le total pour chaque produit
            $total += $produit->prix * $produitData['quantite'];
        }

        // Assurez-vous que 'modes_paiement_id' est bien fourni dans la requête
        if (!$request->has('modes_paiement_id')) {
            return redirect()->back()->with('error', 'Le mode de paiement est requis.');
        }

        // Créer la vente en incluant le 'mode_paiement_id' et le 'total'
        $vente = Vente::create([
            'client_nom' => $request->client_nom,
            'client_telephone' => $request->client_telephone,
            'quincaillerie_id' => auth()->user()->quincaillerie_id,
            'user_id' => auth()->id(),
            'caisse_id' => $request->caisse_id,
            'modes_paiement_id' => $request->modes_paiement_id, // Ajoutez le mode de paiement ici
            'date_vente' => now(),
            'total' => $total, // Ajoutez le total calculé
        ]);

        // Ajouter les produits à la vente
        foreach ($request->produits as $produitData) {
            $produit = $produits->firstWhere('id', $produitData['id']);

            // Calculer le total du produit
            $totalProduit = $produit->prix * $produitData['quantite'];

            // Ajouter le produit à la vente dans la table pivot
            $vente->produits()->attach($produitData['id'], [
                'quantite' => $produitData['quantite'],
                'prix_unitaire' => $produit->prix,
                'total' => $totalProduit, // Ajout du total calculé pour le produit
            ]);
        }

        // Mettre à jour le solde de la caisse
        $caisse = Caisse::findOrFail($vente->caisse_id);
        $caisse->solde_actuel += $total; // Ajouter le total de la vente au solde actuel
        $caisse->save();

        return redirect()->back()->with('success', 'Vente effectuée avec succès !');
    } */
    public function store(Request $request)
    {
        // Calculer le total de la vente
        $total = 0;
        $produits = Produit::findMany(array_column($request->produits, 'id')); // Récupérer tous les produits en une seule requête

        foreach ($request->produits as $produitData) {
            // Récupérer le produit
            $produit = $produits->firstWhere('id', $produitData['id']);

            // Calculer le total pour chaque produit
            $total += $produit->prix * $produitData['quantite'];
        }

        // Assurez-vous que 'modes_paiement_id' est bien fourni dans la requête
        if (!$request->has('modes_paiement_id')) {
            return redirect()->back()->with('error', 'Le mode de paiement est requis.');
        }

        // Créer la vente en incluant le 'mode_paiement_id' et le 'total'
        $vente = Vente::create([
            'client_nom' => $request->client_nom,
            'client_telephone' => $request->client_telephone,
            'quincaillerie_id' => auth()->user()->quincaillerie_id,
            'user_id' => auth()->id(),
            'caisse_id' => $request->caisse_id,
            'modes_paiement_id' => $request->modes_paiement_id, // Ajoutez le mode de paiement ici
            'date_vente' => now(),
            'total' => $total, // Ajoutez le total calculé
        ]);

        // Ajouter les produits à la vente et mettre à jour le stock
        foreach ($request->produits as $produitData) {
            $produit = $produits->firstWhere('id', $produitData['id']);

            // Calculer le total du produit
            $totalProduit = $produit->prix * $produitData['quantite'];

            // Ajouter le produit à la vente dans la table pivot
            $vente->produits()->attach($produitData['id'], [
                'quantite' => $produitData['quantite'],
                'prix_unitaire' => $produit->prix,
                'total' => $totalProduit, // Ajout du total calculé pour le produit
            ]);

            // Mettre à jour le stock
            $stock = Stock::where('produit_id', $produit->id)
                          ->where('quincaillerie_id', auth()->user()->quincaillerie_id)
                          ->first();

            if ($stock) {
                // Vérifier que la quantité demandée est disponible
                if ($stock->quantite_actuelle < $produitData['quantite']) {
                    return redirect()->back()->with('error', "Stock insuffisant pour le produit : {$produit->nom}.");
                }

                // Décrémenter le stock
                $stock->quantite_actuelle -= $produitData['quantite'];
                $stock->save();
            } else {
                return redirect()->back()->with('error', "Le produit : {$produit->nom} n'a pas de stock associé.");
            }
        }

        // Mettre à jour le solde de la caisse
        $caisse = Caisse::findOrFail($vente->caisse_id);
        $caisse->solde_actuel += $total; // Ajouter le total de la vente au solde actuel
        $caisse->save();

        return redirect()->back()->with('success', 'Vente effectuée avec succès et stock mis à jour !');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
