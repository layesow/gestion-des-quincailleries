<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Vente;
use App\Models\Categorie;
use App\Models\Reservation;
use App\Models\Quincaillerie;
use App\Models\MouvementStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'photo',
        'prix',
        'quantite',
        'description',
        'statut',
        'code_barre',
        'categorie_id',
        'quincaillerie_id',
    ];

    // Relation avec l'agence
    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function ventes()
    {
        return $this->belongsToMany(Vente::class)->withPivot('quantite', 'prix_unitaire', 'total');
    }

    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class);
    }


}
