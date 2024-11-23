<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous que les catégories et les quincailleries existent avant de créer des produits
        $categorieId = DB::table('categories')->first()->id ?? null;
        $quincaillerieId = DB::table('quincailleries')->first()->id ?? null;

        // Vérifier que les IDs sont récupérés
        if (!$categorieId || !$quincaillerieId) {
            $this->command->error('Les catégories ou quincailleries sont manquantes. Veuillez les créer d\'abord.');
            return;
        }

        // Produits à insérer
        $produits = [
            [
                'nom' => 'Perceuse',
                'photo' => 'perceuse.jpg',
                'prix' => 199.99,
                'quantite' => 15,
                'description' => 'Perceuse électrique haute performance.',
                'statut' => 'public',
                'code_barre' => '1234567890123',
                'categorie_id' => $categorieId,
                'quincaillerie_id' => $quincaillerieId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Scie Circulaire',
                'photo' => 'scie_circulaire.jpg',
                'prix' => 299.99,
                'quantite' => 10,
                'description' => 'Scie circulaire robuste pour coupes précises.',
                'statut' => 'public',
                'code_barre' => '1234567890124',
                'categorie_id' => $categorieId,
                'quincaillerie_id' => $quincaillerieId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Marteau',
                'photo' => 'marteau.jpg',
                'prix' => 29.99,
                'quantite' => 50,
                'description' => 'Marteau en acier, durable et résistant.',
                'statut' => 'public',
                'code_barre' => '1234567890125',
                'categorie_id' => $categorieId,
                'quincaillerie_id' => $quincaillerieId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insérer les produits et récupérer leurs IDs
        foreach ($produits as $produit) {
            $produitId = DB::table('produits')->insertGetId($produit);

            // Insérer un stock pour chaque produit créé avec `quincaillerie_id`
            DB::table('stocks')->insert([
                'produit_id' => $produitId,
                'quantite_actuelle' => $produit['quantite'], // Utilise la quantité du produit pour initialiser le stock
                'quincaillerie_id' => $quincaillerieId, // Assurez-vous que ce champ est correct et requis
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
