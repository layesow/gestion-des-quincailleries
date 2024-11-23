<?php

namespace Database\Seeders;

use App\Models\PlanAbonnement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanAbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //php artisan db:seed --class=PlanAbonnementSeeder
        PlanAbonnement::create([
            'nom' => 'Abonnement Mensuel',
            'description' => 'Abonnement valable pour un mois.',
            'duree_jours' => 30, // 1 mois
            'prix' => 5000, // Prix en unités monétaires
            'statut' => 'actif',
        ]);

        PlanAbonnement::create([
            'nom' => 'Abonnement Semestriel',
            'description' => 'Abonnement valable pour six mois.',
            'duree_jours' => 180, // 6 mois
            'prix' => 30000, // Prix en unités monétaires
            'statut' => 'actif',
        ]);

        PlanAbonnement::create([
            'nom' => 'Abonnement Annuel',
            'description' => 'Abonnement valable pour un an.',
            'duree_jours' => 365, // 1 an
            'prix' => 60000, // Prix en unités monétaires
            'statut' => 'actif',
        ]);
    }
}
