<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Récupérer les utilisateurs et les rôles
        $adminUser = User::where('email', 'admin@gmail.com')->first();
        $gestionnaireUser = User::where('email', 'gestionnaire@gmail.com')->first();
        $quincaillierUser = User::where('email', 'quincaillerie@gmail.com')->first();

        // Vérifier que les utilisateurs existent
        if ($adminUser && $gestionnaireUser && $quincaillierUser) {
            // Récupérer les rôles par leur nom
            $roleAdmin = Role::where('name', 'admin')->first();
            $roleGestionnaire = Role::where('name', 'gestionnaire')->first();
            $roleQuincaillier = Role::where('name', 'quincaillier')->first();

            // Vérifier que les rôles existent
            if ($roleAdmin && $roleGestionnaire && $roleQuincaillier) {
                // Attribuer des rôles spécifiques à chaque utilisateur
                $adminUser->roles()->sync([$roleAdmin->id]);
                $gestionnaireUser->roles()->sync([$roleGestionnaire->id]);
                $quincaillierUser->roles()->sync([$roleQuincaillier->id]);
            } else {
                echo "Certains rôles n'ont pas été trouvés.";
            }
        } else {
            // Gérer le cas où les utilisateurs ne sont pas trouvés
            echo "Certains utilisateurs n'ont pas été trouvés.";
        }
    }
}
