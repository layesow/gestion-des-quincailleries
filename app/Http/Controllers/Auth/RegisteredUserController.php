<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Agence;
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
        // pour agence

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
            'ville' => ['required', 'string', 'max:255'],
            'date_naissance' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    // Calculer l'âge de l'utilisateur
                    $age = Carbon::parse($value)->age;

                    // Vérifier si l'âge est inférieur à 18 ans
                    if ($age < 18) {
                        // Si l'utilisateur a moins de 18 ans, renvoyer un message d'erreur
                        $fail('Vous devez avoir au moins 18 ans pour vous inscrire.');
                    }
                },
            ],
            'role' => ['required', 'in:client,agence'],
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
            'ville.required' => 'La ville est requise.',
            'ville.string' => 'La ville doit être une chaîne de caractères.',
            'ville.max' => 'La ville ne doit pas dépasser 255 caractères.',
            'date_naissance.required' => 'La date de naissance est requise.',
            'date_naissance.date' => 'La date de naissance doit être une date valide.',
            'role.required' => 'Le rôle est requis.',
            'role.in' => 'Le rôle doit être soit "client" soit "agence".',
        ]);


        // Valider les champs spécifiques à l'agence si le rôle est agence
        if ($request->role === 'agence') {
            $request->validate([
                'agence_name' => ['required', 'string', 'max:255'],
                'agence_email' => ['nullable', 'email', 'unique:agences,email', 'max:255'],
                'agence_telephone' => ['nullable','max:20'],
                'agence_adresse' => ['nullable', 'string', 'max:255'],
            ],[
                'agence_name.required' => 'Le nom de l\'agence est requis.',
                /* 'agence_email.nullable' => 'L\'adresse e-mail de l\'agence est requise.',
                'agence_telephone.required' => 'Le numéro de téléphone de l\'agence est requis.',
                'agence_telephone.max' => 'Le numéro de téléphone de l\'agence ne doit pas dépasser 20 caractères.',
                'agence_adresse.required' => 'L\'adresse de l\'agence est requise.',
                'agence_adresse.string' => 'L\'adresse de l\'agence doit être une chaîne de caractères.',
                'agence_adresse.max' => 'L\'adresse de l\'agence ne doit pas dépasser 255 caractères.', */
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
            'ville' => $request->ville,
            'pays' => $request->pays,
            'date_naissance' => Carbon::createFromFormat('d/m/Y', $request->date_naissance)->format('Y-m-d'),
        ]);
        // Ajoute cette condition pour définir le statut en fonction du rôle
        if ($request->role === 'agence') {
            //$user->statut = 'inactif';
            $user->statut = 'actif';
        } else {
            $user->statut = 'actif';
        }

        $user->save();

        // Gérer les champs spécifiques à l'agence si le rôle est "agence"
        if ($request->role === 'agence') {
            $existingAgence = $user->agence; // Récupérer l'agence existante de l'utilisateur

            // Vérifier si l'utilisateur a déjà une agence
            if ($existingAgence) {
                // Gérer le cas où l'utilisateur est déjà associé à une agence
                // Vous pouvez retourner une erreur, afficher un message, etc.
                // Exemple :
                return redirect()->back()->with('error', 'L\'utilisateur est déjà associé à une agence.');
            } else {
                // Si l'utilisateur n'a pas encore d'agence, créer une nouvelle agence
                $agence = Agence::create([
                    'name' => $request->agence_name,
                    'email' => $request->agence_email,
                    'telephone' => $request->agence_telephone,
                    'adresse' => $request->agence_adresse,
                    'ville' => $request->agence_ville,
                    'code_postal' => $request->agence_code_postal,
                    'pays' => $request->agence_pays,
                    'description' => $request->agence_description,
                    'photo' => $request->agence_photo,
                    //'statut' => $request->agence_statut,
                    'site_web' => $request->agence_site_web,
                    //'horaires_ouverture' => $request->agence_horaires_ouverture,
                    // Ajoutez d'autres champs spécifiques à l'agence ici
                ]);
                // Associer l'agence créée à l'utilisateur
                $user->agence()->associate($agence);
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
        $redirectRoute = $user->hasRole('admin') || $user->hasRole('agence') ? 'admin.index' : 'accueil';

        return redirect()->route($redirectRoute);
    }
}
