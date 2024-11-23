<?php

namespace App\Models;

use App\Models\Vente;
use App\Models\Depense;
use App\Models\Quincaillerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'solde_initial',
        'solde_actuel',
        'quincaillerie_id',
    ];

    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }
}
