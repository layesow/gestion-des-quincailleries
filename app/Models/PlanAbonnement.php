<?php

namespace App\Models;

use App\Models\Abonnement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanAbonnement extends Model
{
    use HasFactory;

    // Nom de la table associée au modèle
    protected $table = 'plan_abonnements';

    // Attributs pouvant être remplis en masse
    protected $fillable = [
        'nom',          // Nom du plan d'abonnement
        'description',  // Description du plan d'abonnement
        'duree_jours',  // Durée de l'abonnement en jours
        'prix',         // Prix de l'abonnement
        'statut',       // Statut du plan (actif, inactif)
    ];

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }
}
