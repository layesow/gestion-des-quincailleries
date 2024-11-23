<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caisse; // Assurez-vous que le modèle Caisse est importé
use App\Models\Quincaillerie; // Importation du modèle Quincaillerie

class CaisseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer une quincaillerie existante (vous pouvez ajuster selon vos besoins)
        $quincaillerie = Quincaillerie::first(); // Utilisez une quincaillerie par défaut ou modifiez pour plus de flexibilité

        // Vérifier si une quincaillerie existe pour éviter les erreurs
        if ($quincaillerie) {
            // Création d'une caisse avec des valeurs par défaut
            Caisse::create([
                'quincaillerie_id' => $quincaillerie->id, // Associez la caisse à une quincaillerie existante
                'nom' => 'Caisse Principale', // Nom de la caisse
                'solde_initial' => 10000, // Solde initial défini manuellement
                'solde_actuel' => 10000, // Solde actuel initialisé au même montant que le solde initial
            ]);
        } else {
            // Optionnel : Créer une quincaillerie par défaut si aucune n'existe
            $quincaillerie = Quincaillerie::create([
                'name' => 'Quincaillerie Démo', // Nom par défaut
                'statut' => 'actif',
            ]);

            // Créer la caisse pour la nouvelle quincaillerie
            Caisse::create([
                'quincaillerie_id' => $quincaillerie->id,
                'nom' => 'Caisse Principale',
                'solde_initial' => 10000,
                'solde_actuel' => 10000,
            ]);
        }
    }
}
