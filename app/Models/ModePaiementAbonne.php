<?php

namespace App\Models;

use App\Models\Vente;
use App\Models\Paiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModePaiementAbonne extends Model
{
    use HasFactory;


    protected $table = 'modes_paiement_abonne'; // Assurez-vous que ce nom correspond à celui de la table dans la base de données

    protected $fillable = [
        'nom',
        'quincaillerie_id',
    ];

    public function paiements()
    {
        //return $this->hasMany(Paiement::class);
        return $this->hasMany(Paiement::class, 'mode_paiement_abonne_id');

    }


}
