<?php

namespace Database\Seeders;


use App\Models\ModePaiement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModePaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Remplacer 1 par un quincaillerie_id valide si nécessaire
        $quincaillerieId = 1; // Assurez-vous que cette valeur existe dans la table 'quincailleries'

        $modesPaiement = [
            ['nom' => 'Carte de Crédit', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Virement Bancaire', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'PayPal', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Wave', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Orange  Money', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Espéce', 'quincaillerie_id' => $quincaillerieId],
        ];

        foreach ($modesPaiement as $mode) {
            DB::table('modes_paiement')->insert($mode);
        }
    }
}
