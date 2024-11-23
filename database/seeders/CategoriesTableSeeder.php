<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous que la quincaillerie existe avant de créer des catégories
        $quincaillerieId = DB::table('quincailleries')->first()->id;

        // Créer des catégories s'ils n'existent pas déjà
        DB::table('categories')->insert([
            [
                'nom' => 'Électronique',
                'quincaillerie_id' => $quincaillerieId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Meubles',
                'quincaillerie_id' => $quincaillerieId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Outils',
                'quincaillerie_id' => $quincaillerieId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
