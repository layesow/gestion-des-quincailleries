<?php

namespace Database\Seeders;


use App\Models\ModePaiement;
use App\Models\Quincaillerie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModePaiementAbonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Définir les modes de paiement sans quincaillerie_id
        $modesPaiementAbonne = [
            ['nom' => 'Carte de Crédit'],
            ['nom' => 'Virement Bancaire'],
            ['nom' => 'Espèces'],
            ['nom' => 'Wave'],
            ['nom' => 'Orange Money'],
            ['nom' => 'Espèces'],
        ];

        // Insertion des données dans la table modes_paiement_abonne
        foreach ($modesPaiementAbonne as $mode) {
            DB::table('modes_paiement_abonne')->insert($mode);
        }
    }
    /* public function run()
    {
        // Remplacer 1 par un quincaillerie_id valide si nécessaire
        $quincaillerieId = 1; // Assurez-vous que cette valeur existe dans la table 'quincailleries'

        $modesPaiementAbonne = [
            ['nom' => 'Carte de Crédit', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Virement Bancaire', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'PayPal', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Wave', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Orange  Money', 'quincaillerie_id' => $quincaillerieId],
            ['nom' => 'Espéce', 'quincaillerie_id' => $quincaillerieId],
        ];

        foreach ($modesPaiementAbonne as $mode) {
            DB::table('modes_paiement')->insert($mode);
        }
    } */
}
