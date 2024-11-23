<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Agence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // tous les users
        //$users = User::doesntHave('agence')->orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();
        $statut = ['actif', 'inactif'];
        $roles = Role::all();
        $agences =Agence::all();

        return view('admin.utilisateurs.index', compact('users','statut','roles','agences'));
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
            return view('admin.utilisateursAgences.create', compact('statut', 'agence'));
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
        // Validation des données de la requête
        $request->validate([
            'prenom' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'date_naissance' => 'nullable|date',
            'password' => 'required|string|min:8',
            'agence_id' => 'nullable|exists:agences,id',
            'role_id' => 'required|exists:roles,id',
        ], [
            'prenom.required' => 'Le prénom est obligatoire.',
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'ville.required' => 'La ville est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'role_id.required' => 'Le rôle est obligatoire.',
            'role_id.exists' => 'Le rôle sélectionné n\'existe pas.',
        ]);
        try {
        $user = new User();
        $user->prenom = $request->prenom;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= Hash::make($request->password);
        $user->telephone= $request->telephone;
        $user->adresse= $request->adresse;
        $user->ville= $request->ville;
        $user->date_naissance= $request->date_naissance;
        $user->agence_id= $request->agence_id;

        $user->save();
        // Assigner le rôle à l'utilisateur
        $user->attachRole($request->role_id);

        //dd($user);
        //dd($request->role_id);
        //return redirect()->route('user.index');
        return redirect()->route('user.index')->with('success', 'Utilisateur créé avec succès.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Capture de l'exception de base de données
            // Afficher un message d'erreur à l'utilisateur
            return redirect()->route('user.index')->with('error', 'Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
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
        $user = User::find($id);
        $statut = ['actif', 'inactif'];
        $roles = Role::all();
        $agences =Agence::all();
        return view('admin.utilisateurs.index',compact('user','statut','roles','agences'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données de la requête
        $request->validate([
            'prenom' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'statut' => 'required|in:actif,inactif',
            'date_naissance' => 'nullable|date',
            'password' => 'nullable|string|min:8',
            'agence_id' => 'nullable|exists:agences,id',
            'role_id' => 'required|exists:roles,id',
        ], [
            'prenom.required' => 'Le prénom est obligatoire.',
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'ville.required' => 'La ville est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
            'role_id.required' => 'Le rôle est obligatoire.',
            'role_id.exists' => 'Le rôle sélectionné n\'existe pas.',
        ]);

        try {
        $user = User::findOrFail($id);
        $user->prenom = $request->prenom;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
        $user->ville = $request->ville;
        $user->statut = $request->statut;
        $user->date_naissance = $request->date_naissance;
        $user->agence_id = $request->agence_id;

        // Mettez à jour le mot de passe uniquement s'il est fourni
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Mettez à jour les rôles de l'utilisateur
        $user->syncRoles([$request->role_id]);
        //return redirect()->route('user.index');
        return redirect()->route('user.index')->with('success', 'Utilisateur mis à jour avec succès.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Capture de l'exception de base de données
            // Afficher un message d'erreur à l'utilisateur
            return redirect()->route('user.index')->with('error', 'Erreur lors de la mise à jour de l\'utilisateur : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        // Rechercher l'utilisateur correspondant à l'ID
        $user = User::findOrFail($id);
        // Détacher tous les rôles de l'utilisateur
        $user->detachRoles();
        // Supprimer l'utilisateur de la base de données
        $user->delete();
        // Rediriger vers la route 'user.index'
        //return redirect()->route('user.index');
        return redirect()->route('user.index')->with('success', 'Utilisateur supprimé avec succès.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Capture de l'exception de base de données
            // Afficher un message d'erreur à l'utilisateur
            return redirect()->route('user.index')->with('error', 'Erreur lors de la suppression de l\'utilisateur : ' . $e->getMessage());
        }
    }
}
