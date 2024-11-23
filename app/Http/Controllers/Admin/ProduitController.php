<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /* public function index()
    {
        $quincaillerie_id = Auth::user()->quincaillerie_id;
        $produits = Produit::where('quincaillerie_id', $quincaillerie_id)->latest()->get();
        $categories = Categorie::all();
        $statut = ['public', 'prive'];
        $codeBarre = 'PRD-' . strtoupper(substr(uniqid(), -8));  // Prend seulement les 8 derniers caractères

        return view('admin.produits.index', compact('produits', 'categories', 'statut','codeBarre'));
    } */
    public function index()
    {
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        $produits = Produit::where('quincaillerie_id', $quincaillerie_id)
            ->with(['stocks' => function ($query) use ($quincaillerie_id) {
                $query->where('quincaillerie_id', $quincaillerie_id);
            }])
            ->latest()
            ->get();

        $categories = Categorie::all();
        $statut = ['public', 'prive'];
        $codeBarre = 'PRD-' . strtoupper(substr(uniqid(), -8));  // Prend seulement les 8 derniers caractères

        return view('admin.produits.index', compact('produits', 'categories', 'statut', 'codeBarre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $quincaillerie_id = Auth::user()->quincaillerie_id;
        $categories = Categorie::where('quincaillerie_id', $quincaillerie_id)->get();
        $codeBarre = 'PRD-' . strtoupper(substr(uniqid(), -8));  // Prend seulement les 8 derniers caractères


        return view('admin.produits.create', compact('categories','codeBarre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'nom' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer|min:0',
            'description' => 'required|string',
            'statut' => 'required|in:public,prive',
            'code_barre' => 'nullable|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $imageName = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file = $request->file('photo');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('produitImages'), $imageName);
        }

        // Générer un code-barres unique
        $codeBarre = 'PRD-' . strtoupper(substr(uniqid(), -8));

        // Créer un nouveau produit
        $produit = Produit::create([
            'nom' => $request->input('nom'),
            'photo' => $imageName,
            'prix' => $request->input('prix'),
            'quantite' => $request->input('quantite'),
            'description' => $request->input('description'),
            'statut' => $request->input('statut'),
            'code_barre' => $codeBarre,
            'categorie_id' => $request->input('categorie_id'),
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
        ]);

        // Ajouter une entrée dans la table des stocks
        Stock::create([
            'produit_id' => $produit->id,
            'quantite_actuelle' => $request->input('quantite'),
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
        ]);

        return redirect()->route('admin.produit')
                         ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produit = Produit::where('id', $id)
                          ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                          ->firstOrFail();
        $categories = Categorie::where('quincaillerie_id', Auth::user()->quincaillerie_id)->get();

        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    /* public function update(Request $request, string $id)
    {
        $produit = Produit::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer|min:0',
            'description' => 'required|string',
            'statut' => 'required|in:public,prive',
            'code_barre' => 'nullable|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if ($produit->photo) {
                $oldImagePath = public_path('produitImages/' . $produit->photo);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('photo');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('produitImages'), $imageName);
            $produit->photo = $imageName;
        }

        $produit->update([
            'nom' => $request->input('nom'),
            'prix' => $request->input('prix'),
            'quantite' => $request->input('quantite'),
            'description' => $request->input('description'),
            'statut' => $request->input('statut'),
            'code_barre' => $request->input('code_barre'),
            'categorie_id' => $request->input('categorie_id'),
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
        ]);

        // Mettre à jour le stock
        $stock = Stock::where('produit_id', $id)
                      ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                      ->first();

        if ($stock) {
            $stock->update([
                'quantite_actuelle' => $request->input('quantite'),
            ]);
        } else {
            Stock::create([
                'produit_id' => $produit->id,
                'quantite_actuelle' => $request->input('quantite'),
                'quincaillerie_id' => Auth::user()->quincaillerie_id,
            ]);
        }

        return redirect()->route('admin.produit')
                         ->with('success', 'Produit mis à jour avec succès.');
    } */
    public function update(Request $request, string $id)
    {
        $produit = Produit::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer|min:0', // Le champ "quantite" doit toujours être un entier positif
            'description' => 'required|string',
            'statut' => 'required|in:public,prive',
            'code_barre' => 'nullable|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Gestion de la photo
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if ($produit->photo) {
                $oldImagePath = public_path('produitImages/' . $produit->photo);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('photo');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('produitImages'), $imageName);
            $produit->photo = $imageName;
        }

        // Mise à jour des autres données du produit
        $produit->update([
            'nom' => $request->input('nom'),
            'prix' => $request->input('prix'),
            'description' => $request->input('description'),
            'statut' => $request->input('statut'),
            'code_barre' => $request->input('code_barre'),
            'categorie_id' => $request->input('categorie_id'),
            'quincaillerie_id' => Auth::user()->quincaillerie_id,
        ]);

        // Ajout au stock si une quantité supérieure à 0 est saisie
        $quantiteAjoutee = $request->input('quantite');

        if ($quantiteAjoutee > 0) {
            $stock = Stock::where('produit_id', $id)
                          ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                          ->first();

            if ($stock) {
                $stock->update([
                    'quantite_actuelle' => $stock->quantite_actuelle + $quantiteAjoutee,
                ]);
            } else {
                Stock::create([
                    'produit_id' => $produit->id,
                    'quantite_actuelle' => $quantiteAjoutee,
                    'quincaillerie_id' => Auth::user()->quincaillerie_id,
                ]);
            }
        }

        return redirect()->route('admin.produit')
                         ->with('success', 'Produit mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produit = Produit::findOrFail($id);

        if ($produit->photo) {
            $imagePath = public_path('produitImages/' . $produit->photo);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $produit->delete();

        // Supprimer l'entrée correspondante dans la table des stocks
        Stock::where('produit_id', $id)
             ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
             ->delete();

        return redirect()->route('admin.produit')
                        ->with('success', 'Produit supprimé avec succès.');
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            Produit::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Produits supprimés avec succès.');
        }
        return redirect()->back()->with('error', 'Aucun produit sélectionné.');
    }





}
