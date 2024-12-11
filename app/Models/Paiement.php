<?php

namespace App\Models;

use App\Models\Abonnement;
use App\Models\ModePaiement;
use App\Models\ModePaiementAbonne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'abonnement_id',
        'date_paiement',
        'montant',
        'mode_paiement_abonne_id',
        'statut',
    ];

    /**
     * Get the abonnement associated with the paiement.
     */
    public function abonnement()
    {
        return $this->belongsTo(Abonnement::class);
    }

    /**
     * Get the mode de paiement associated with the paiement.
     */
    public function modePaiementAbonne()
    {
        return $this->belongsTo(ModePaiementAbonne::class, 'mode_paiement_abonne_id');
        
    }
}
