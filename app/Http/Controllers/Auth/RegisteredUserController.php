<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Quincaillerie;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {   $roles = Role::all();
        $statuts = ['actif', 'inactif']; // Ajoute cette ligne
        // pour quincaillerie

        return view('auth.register', compact('roles', 'statuts'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Autres règles de validation
            'prenom' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required','max:20'],
            'adresse' => ['required', 'string'],
            //'role' => ['required', 'in:client,quincaillerie'],
        ], [
            // Messages d'erreur personnalisés
            'prenom.required' => 'Le nom est requis.',
            'prenom.string' => 'Le nom doit être une chaîne de caractères.',
            'prenom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'name.required' => 'Le nom est requis.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.string' => 'L\'adresse e-mail doit être une chaîne de caractères.',
            'email.lowercase' => 'L\'adresse e-mail doit être en minuscules.',
            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            'email.max' => 'L\'adresse e-mail ne doit pas dépasser 255 caractères.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'prenom.required' => 'Le prénom est requis.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'telephone.required' => 'Le numéro de téléphone est requis.',
            'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'adresse.required' => 'L\'adresse est requise.',
            'adresse.string' => 'L\'adresse doit être une chaîne de caractères.',
            'role.required' => 'Le rôle est requis.',
            //'role.in' => 'Le rôle doit être soit "client" soit "quincaillerie".',
        ]);


        // Valider les champs spécifiques à la quincaillerie si le rôle est quincaillerie
        if ($request->role === 'quincaillerie') {
            $request->validate([
                'quincaillerie_name' => ['required', 'string', 'max:255'],
                'quincaillerie_email' => ['nullable', 'email', 'unique:quincailleries,email', 'max:255'],
                'quincaillerie_telephone' => ['nullable','max:20'],
                'quincaillerie_adresse' => ['nullable', 'string', 'max:255'],
            ],[
                'quincaillerie_name.required' => 'Le nom de l\'quincaillerie est requis.',
                /* 'quincaillerie_email.nullable' => 'L\'adresse e-mail de l\'quincaillerie est requise.',
                'quincaillerie_telephone.required' => 'Le numéro de téléphone de l\'quincaillerie est requis.',
                'quincaillerie_telephone.max' => 'Le numéro de téléphone de l\'quincaillerie ne doit pas dépasser 20 caractères.',
                'quincaillerie_adresse.required' => 'L\'adresse de l\'quincaillerie est requise.',
                'quincaillerie_adresse.string' => 'L\'adresse de l\'quincaillerie doit être une chaîne de caractères.',
                'quincaillerie_adresse.max' => 'L\'adresse de l\'quincaillerie ne doit pas dépasser 255 caractères.', */
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);
        // Ajoute cette condition pour définir le statut en fonction du rôle
        if ($request->role === 'quincaillerie') {
            //$user->statut = 'inactif';
            $user->statut = 'actif';
        } else {
            $user->statut = 'actif';
        }

        $user->save();

        // Gérer les champs spécifiques à l'quincaillerie si le rôle est "quincaillerie"
        if ($request->role === 'quincaillerie') {
            $existingQuincaillerie = $user->quincaillerie; // Récupérer l'quincaillerie existante de l'utilisateur

            // Vérifier si l'utilisateur a déjà une quincaillerie
            if ($existingQuincaillerie) {
                // Gérer le cas où l'utilisateur est déjà associé à une quincaillerie
                // Vous pouvez retourner une erreur, afficher un message, etc.
                // Exemple :
                return redirect()->back()->with('error', 'L\'utilisateur est déjà associé à une quincaillerie.');
            } else {
                // Si l'utilisateur n'a pas encore d'quincaillerie, créer une nouvelle quincaillerie
                $quincaillerie = Quincaillerie::create([
                    'name' => $request->quincaillerie_name,
                    'email' => $request->quincaillerie_email,
                    'telephone' => $request->quincaillerie_telephone,
                    'adresse' => $request->quincaillerie_adresse,
                    'ville' => $request->quincaillerie_ville,
                    'code_postal' => $request->quincaillerie_code_postal,
                    'description' => $request->quincaillerie_description,
                    'photo' => $request->quincaillerie_photo,
                    //'statut' => $request->quincaillerie_statut,
                    'site_web' => $request->quincaillerie_site_web,
                    //'horaires_ouverture' => $request->quincaillerie_horaires_ouverture,
                    // Ajoutez d'autres champs spécifiques à l'quincaillerie ici
                ]);
                // Associer l'quincaillerie créée à l'utilisateur
                $user->quincaillerie()->associate($quincaillerie);
                $user->save();
            }
        }

        // Attachez le rôle à l'utilisateur
        $role = Role::where('name', $request->role)->first();

        if ($role) {
            $user->attachRole($role);
        } else {
            // Gérer le cas où le rôle n'existe pas (peut-être lever une exception ou effectuer une autre action)
        }

        event(new Registered($user));

        Auth::login($user);
        if ($user->statut === 'inactif') {
            Auth::logout(); // Déconnecter l'utilisateur inactif
            return redirect()->route('login')->with('success', 'Votre profil est en attente de validation. Vous serez informé dès que votre compte sera activé.');
            //return redirect()->route('login')->with('success', '');
            //return redirect()->route('page_inactif');
        }

        // Rediriger vers la page appropriée en fonction du rôle
        $redirectRoute = $user->hasRole('admin') || $user->hasRole('quincaillerie') ? 'admin.index' : 'accueil';

        return redirect()->route($redirectRoute);
    }
}
