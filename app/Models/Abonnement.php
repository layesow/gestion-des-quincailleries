<?php

namespace App\Models;

use App\Models\Paiement;
use App\Models\Quincaillerie;
use App\Models\PlanAbonnement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'quincaillerie_id',
        'plan_abonnement_id', // Assurez-vous que ce champ est défini ici
        'date_debut',
        'date_fin',
        'statut', // Changer 'status' en 'statut'
    ];

    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function planAbonnement()
    {
        return $this->belongsTo(PlanAbonnement::class, 'plan_abonnement_id');
    }
}
