<?php

namespace App\Models;

use App\Models\Produit;
use App\Models\Quincaillerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'quincaillerie_id',
    ];


    /* public function quincailleries()
    {
        return $this->hasMany(Quincaillerie::class);
    } */

    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
