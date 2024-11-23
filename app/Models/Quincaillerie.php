<?php

namespace App\Models;

use App\Models\User;
use App\Models\Stock;
use App\Models\Caisse;
use App\Models\Depense;
use App\Models\Produit;
use App\Models\Rapport;
use App\Models\Categorie;
use App\Models\Abonnement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quincaillerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'statut',
    ];


    //relation des tables
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public function caisses()
    {
        return $this->hasMany(Caisse::class);
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
