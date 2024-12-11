<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Quincaillerie;
use App\Models\Caisse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Exécute les seeds de la base de données.
     */
    public function run(): void
    {
        // Créer les rôles s'ils n'existent pas déjà
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleGestionnaire = Role::firstOrCreate(['name' => 'gestionnaire']);
        $roleQuincaillier = Role::firstOrCreate(['name' => 'quincaillier']);

        // Créer la quincaillerie si elle n'existe pas
        $quincaillerie = Quincaillerie::firstOrCreate([
            'name' => 'Quincaillerie',
            'photo' => null, // Photo par défaut ou null
            'statut' => 'actif',
        ]);

        // Récupérer l'ID de la quincaillerie
        $quincaillerieId = $quincaillerie->id;

        // Récupérer l'ID de la caisse associée à la quincaillerie (ou null si inexistante)
        $caisse = Caisse::where('quincaillerie_id', $quincaillerieId)->first();

        // Créer les utilisateurs s'ils n'existent pas déjà
        $userAdmin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'prenom' => 'Admin',
                'telephone' => '987654321',
                'adresse' => '456 Rue de l\'Exemple',
                'statut' => 'actif',
                'quincaillerie_id' => null, // L'administrateur n'est pas forcément lié à une quincaillerie
                'caisse_id' => null, // Pas de caisse pour l'admin
                'password' => Hash::make('password'),
            ]
        );

        $userGestionnaire = User::firstOrCreate(
            ['email' => 'gestionnaire@gmail.com'],
            [
                'name' => 'Gestionnaire',
                'prenom' => 'Gestion',
                'telephone' => '987651321',
                'adresse' => '452 Rue de l\'Exemple',
                'statut' => 'actif',
                'quincaillerie_id' => $quincaillerieId, // Associer à la quincaillerie
                'caisse_id' => $caisse?->id, // Utilisation de l'opérateur null-safe
                'password' => Hash::make('password'),
            ]
        );

        $userQuincaillier = User::firstOrCreate(
            ['email' => 'quincaillier@gmail.com'],
            [
                'name' => 'Quincaillier',
                'prenom' => 'Quincaillier',
                'telephone' => '987654321',
                'adresse' => '456 Rue de l\'Exemple',
                'statut' => 'actif',
                'quincaillerie_id' => $quincaillerieId, // Associer à la quincaillerie
                'caisse_id' => $caisse?->id, // Utilisation de l'opérateur null-safe
                'password' => Hash::make('password'),
            ]
        );

        // Attacher les rôles aux utilisateurs
        $userAdmin->roles()->sync([$roleAdmin->id]);
        $userGestionnaire->roles()->sync([$roleGestionnaire->id]);
        $userQuincaillier->roles()->sync([$roleQuincaillier->id]);
    }
}
