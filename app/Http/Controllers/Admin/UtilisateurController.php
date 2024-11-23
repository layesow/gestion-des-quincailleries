<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer l'agence de l'utilisateur connecté
        $agence = auth()->user()->agence;

        // Vérifier si l'agence existe avant d'accéder à la relation 'users'
        if ($agence) {
            // Récupérer les utilisateurs liés à cette agence
            //$utilisateurs = $agence->users;
            $utilisateurs = $agence->users()->orderByDesc('id')->get();
            $statut = ['actif', 'inactif'];

            // Retourner la vue avec la liste des utilisateurs
            return view('admin.utilisateursAgenges.index', compact('utilisateurs','statut'));
        } else {
            // Gérer le cas où l'agence n'existe pas
            // Vous pouvez retourner une vue avec un message d'erreur, rediriger, etc.
            return view('admin.dashboard')->with('error', 'Aucune agence trouvée.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer l'agence de l'utilisateur connecté
        $agence = auth()->user()->agence;

        // Vérifier si l'agence existe avant de permettre la création
        if ($agence) {
            $statut = ['actif', 'inactif'];
            // Retourner la vue avec le formulaire de création d'utilisateur
            return view('admin.utilisateursAgenges.index', compact('statut'));
        } else {
            // Gérer le cas où l'agence n'existe pas
            // Vous pouvez retourner une vue avec un message d'erreur, rediriger, etc.
            return redirect()->route('admin.utilisateurs')->with('error', 'Aucune agence trouvée.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Récupérer l'agence de l'utilisateur connecté
            $agence = auth()->user()->agence;

            // Vérifier si l'agence existe avant de créer l'utilisateur
            if ($agence) {
                // Créer un nouvel utilisateur

                $nouvelUtilisateur = new User([
                    'prenom' => $request->input('prenom'),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'telephone' => $request->input('telephone'),
                    'adresse' => $request->input('adresse'),
                    'ville' => $request->input('ville'),
                    'date_naissance' => $request->input('date_naissance'),
                    'statut' => $request->input('statut'),
                ]);

                // Enregistrez l'utilisateur avec l'agence et le rôle "Agence"
                $agence->users()->save($nouvelUtilisateur);
                $nouvelUtilisateur->attachRole('agence');

                //dd($nouvelUtilisateur);

                // Rediriger avec un message de succès
                return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur ajouté avec succès');
            } else {
                // Gérer le cas où l'agence n'existe pas
                // Vous pouvez retourner une vue avec un message d'erreur, rediriger, etc.
                return redirect()->route('admin.utilisateurs')->with('error', 'Aucune agence trouvée.');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Capturer les exceptions de base de données
            return back()->with('error', 'Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
        }
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
        // Récupérer l'utilisateur à éditer par son identifiant
        $utilisateur = User::findOrFail($id);

        // Récupérer les informations nécessaires (si nécessaire)
        $statut = ['actif', 'inactif'];

        // Retourner la vue avec le formulaire d'édition et les informations de l'utilisateur
        return view('admin.utilisateursAgenges.index', compact('utilisateur', 'statut'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
        // Récupérer l'utilisateur à mettre à jour par son identifiant
        $utilisateur = User::findOrFail($id);

        // Valider les données du formulaire (ajoutez des règles de validation si nécessaire)

        // Mettre à jour les champs avec les nouvelles valeurs
        $utilisateur->prenom = $request->input('prenom');
        $utilisateur->name = $request->input('name');
        $utilisateur->email = $request->input('email');
        $utilisateur->telephone = $request->input('telephone');
        $utilisateur->adresse = $request->input('adresse');
        $utilisateur->ville = $request->input('ville');
        $utilisateur->date_naissance = $request->input('date_naissance');
        $utilisateur->statut = $request->input('statut');

        // Sauvegarder les modifications dans la base de données
        $utilisateur->save();


        // Rediriger avec un message de succès
        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur mis à jour avec succès');
        } catch (\Illuminate\Database\QueryException $e) {
            // Capturer les exceptions de base de données
            return back()->with('error', 'Erreur lors de la mise à jour de l\'utilisateur : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        // Rechercher l'utilisateur correspondant à l'ID
        $utilisateur = User::findOrFail($id);
        // Détacher tous les rôles de l'utilisateur
        $utilisateur->detachRoles();
        // Supprimer l'utilisateur de la base de données
        $utilisateur->delete();
        // Rediriger vers la route 'admin.utilisateurs'
        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur supprimé avec succès');
        } catch (\Illuminate\Database\QueryException $e) {
            // Capturer les exceptions de base de données
            return back()->with('error', 'Erreur lors de la suppression de l\'utilisateur : ' . $e->getMessage());
        }
    }
}
