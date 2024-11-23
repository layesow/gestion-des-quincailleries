<?php

namespace App\Models;

use App\Models\Produit;
use App\Models\Quincaillerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'quincaillerie_id',
        'quantite_actuelle',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }
}
