<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // liste des agences
        $agences =Agence::orderBy('id', 'desc')->get();
        $statut = ['actif', 'inactif','en traitement'];
        return view('admin.agences.index',compact("agences","statut"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statut = ['actif', 'inactif','en traitement'];
        return view('admin.agences.index',compact("statut"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* validation des champs du formulaire */
        /* $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:table_name|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ],[
            'name.required' => 'Le champ est requis.',
            'string' => 'Le champ doit être une chaîne de caractères.',
            'max' => 'Le champ ne peut pas dépasser :max caractères.',
            'email' => 'Le champ doit être une adresse e-mail valide.',
        ]); */

        try {
        $agence = new Agence();
        $agence->name = $request->name;
        $agence->email = $request->email;
        $agence->telephone = $request->telephone;
        $agence->adresse = $request->adresse;
        $agence->ville = $request->ville;
        $agence->code_postal = $request->code_postal;
        $agence->pays = $request->pays;
        $agence->description = $request->description;
        //$agence->photo = $request->photo;
        // Vérifiez si une image est téléchargée (votre code reste inchangé ici)
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Vérifier si une ancienne photo existe
            if ($agence->photo) {
                // Supprimer l'ancienne photo du répertoire de stockage
                unlink(public_path('agenceImages/' . $agence->photo));
            }
            // Obtenez le chemin du fichier temporaire
            $file = $request->file('photo');
            // Générez un nom unique pour la nouvelle image
            $imageName = time() . '_' . $file->getClientOriginalName();
            // Déplacez la nouvelle image vers le répertoire de stockage
            $file->move(public_path('agenceImages'), $imageName);
            // Enregistrez le nom du fichier de la nouvelle image dans la base de données
            $agence->photo = $imageName;
        }

        $agence->statut = $request->statut;
        $agence->site_web = $request->site_web;
        $agence->horaires_ouverture = $request->horaires_ouverture;

        $agence->save();
        ($agence);
        //return
        //Session::flash('success', "L'agence a été ajoutée avec succès");
        //return redirect()->route('admin.agences');
        return redirect()->route('admin.agences')->with('success', 'Agence créée avec succès.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Capture de l'exception de base de données en cas de violation de contrainte
            // Retourner un message d'erreur explicatif à l'utilisateur
            return redirect()->route('admin.agences')->with('error', 'Erreur lors de la création de l\'agence : ' . $e->getMessage());
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
        $agence = Agence::find($id);
        $statut = ['actif', 'inactif','en traitement'];
        return view('admin.agences.index',compact("agence","statut"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:table_name|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'pays' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'statut' => 'required|in:actif,inactif,en traitement',
            'site_web' => 'nullable|string|url|max:255',
            'horaires_ouverture' => 'nullable|string|max:255',
        ],[
            'name.required' => 'Le nom est requis.',
        ]);

        try {
        // Récupérer l'agence à mettre à jour par son identifiant
        $agence = Agence::findOrFail($id);

        // Mettre à jour les champs avec les nouvelles valeurs
        $agence->name = $request->name;
        $agence->email = $request->email;
        $agence->telephone = $request->telephone;
        $agence->adresse = $request->adresse;
        $agence->ville = $request->ville;
        $agence->code_postal = $request->code_postal;
        $agence->pays = $request->pays;
        $agence->description = $request->description;

        // Vérifier et traiter le téléchargement d'une nouvelle photo (comme dans la méthode store)
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file = $request->file('photo');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('agenceImages'), $imageName);
            $agence->photo = $imageName;
        }

        // Mettre à jour les autres champs comme dans la méthode store
        $agence->statut = $request->statut;
        $agence->site_web = $request->site_web;
        $agence->horaires_ouverture = $request->horaires_ouverture;

        // Sauvegarder les modifications dans la base de données
        $agence->save();

        // Rediriger vers la liste des agences après la mise à jour
        //return redirect()->route('admin.agences');
        return redirect()->route('admin.agences')->with('success', 'Agence mise à jour avec succès.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Capture de l'exception de base de données en cas de violation de contrainte
            // Retourner un message d'erreur explicatif à l'utilisateur
            return redirect()->route('admin.agences')->with('error', 'Erreur lors de la mise à jour de l\'agence : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        // Rechercher l'agence correspondante au paramètre "$id"
        $agence = Agence::findOrFail($id);
        // Supprimer l'agence de la base de données
        $agence->delete();
        // Retourner une réponse pour notifier que la suppression a bien été effectu
        //return redirect()->route('admin.agences');
        return redirect()->route('admin.agences')->with('success', 'Agence supprimée avec succès.');
        }  catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si l'agence n'est pas trouvé, redirectionner vers la page d'accueil avec un message d'erreur
            return redirect('/')->with('error', "L'agence demandée est introuvable.");
        }
    }
}
