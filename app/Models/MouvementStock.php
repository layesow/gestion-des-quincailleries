<?php

namespace App\Models;

use App\Models\Produit;
use App\Models\Quincaillerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MouvementStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'quincaillerie_id',
        'type',
        'quantite',
        'motif',
    ];

    /**
     * Relation avec le produit.
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    /**
     * Relation avec la quincaillerie.
     */
    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }
}
