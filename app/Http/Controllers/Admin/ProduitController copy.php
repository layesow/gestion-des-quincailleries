<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        // Récupérer les produits associés à cette quincaillerie
        $produits = Produit::where('quincaillerie_id', $quincaillerie_id)->get();

        // Renvoyer la vue avec les produits filtrés
        $categories =Categorie::all();
        $statut = ['public', 'prive'];
        return view('admin.produits.index', compact('produits','categories','statut'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer l'ID de la quincaillerie associée à l'utilisateur connecté
        $quincaillerie_id = Auth::user()->quincaillerie_id;

        // Récupérer les catégories associées à cette quincaillerie pour le formulaire
        $categories = Categorie::where('quincaillerie_id', $quincaillerie_id)->get();

        // Afficher le formulaire de création
        return view('admin.produits.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation des données de la requête
    $request->validate([
        /* 'nom' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'prix' => 'required|numeric',
        'quantite' => 'required|integer|min:0',
        'description' => 'required|string',
        'statut' => 'required|in:public,prive',
        'code_barre' => 'nullable|string|max:255',
        'categorie_id' => 'required|exists:categories,id', */
    ]);

    // Initialisation du nom de l'image
    $imageName = null;

    // Gérer le téléchargement de l'image si disponible
    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        // Obtenez le fichier de l'image
        $file = $request->file('photo');
        // Générez un nom unique pour la nouvelle image
        $imageName = time() . '_' . $file->getClientOriginalName();
        // Déplacez la nouvelle image vers le répertoire de stockage
        $file->move(public_path('produitImages'), $imageName);
    }

    // Créer un nouveau produit associé à la quincaillerie de l'utilisateur connecté
    Produit::create([
        'nom' => $request->input('nom'),
        'photo' => $imageName, // Enregistrez le nom de l'image si téléchargée
        'prix' => $request->input('prix'),
        'quantite' => $request->input('quantite'),
        'description' => $request->input('description'),
        'statut' => $request->input('statut'),
        'code_barre' => $request->input('code_barre'),
        'categorie_id' => $request->input('categorie_id'),
        'quincaillerie_id' => Auth::user()->quincaillerie_id,
    ]);

    // Rediriger avec un message de succès
    return redirect()->route('admin.produit')
                     ->with('success', 'Produit créé avec succès.');
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
        // Récupérer le produit en utilisant l'ID et vérifier l'appartenance
        $produit = Produit::where('id', $id)
                          ->where('quincaillerie_id', Auth::user()->quincaillerie_id)
                          ->firstOrFail();

        // Récupérer les catégories associées à la quincaillerie pour le formulaire
        $categories = Categorie::where('quincaillerie_id', Auth::user()->quincaillerie_id)->get();

        // Afficher le formulaire d'édition
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trouver le produit à mettre à jour
        $produit = Produit::findOrFail($id);

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

        // Gérer le téléchargement de l'image si disponible
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Supprimer l'ancienne photo si elle existe
            if ($produit->photo) {
                $oldImagePath = public_path('produitImages/' . $produit->photo);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // Obtenez le fichier de la nouvelle image
            $file = $request->file('photo');
            // Générez un nom unique pour la nouvelle image
            $imageName = time() . '_' . $file->getClientOriginalName();
            // Déplacez la nouvelle image vers le répertoire de stockage
            $file->move(public_path('produitImages'), $imageName);
            // Mettre à jour le nom de l'image dans le produit
            $produit->photo = $imageName;
        }

        // Mettre à jour les autres champs du produit
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

        // Rediriger avec un message de succès
        return redirect()->route('admin.produit')
                         ->with('success', 'Produit mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver le produit à supprimer
        $produit = Produit::findOrFail($id);

        // Vérifier si une photo existe et la supprimer du répertoire de stockage
        if ($produit->photo) {
            $imagePath = public_path('produitImages/' . $produit->photo);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Supprimer le produit de la base de données
        $produit->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.produit')
                        ->with('success', 'Produit supprimé avec succès.');
    }

}
