<?php

namespace App\Models;

use App\Models\Vente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'vente_id',
        'numero_facture',
        'date',
        'montant_total',
        'etat',
    ];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }
}
