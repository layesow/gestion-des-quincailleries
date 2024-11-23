<?php

namespace App\Models;

use App\Models\User;
use App\Models\Caisse;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\ModePaiement;
use App\Models\Quincaillerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_nom',
        'client_telephone',
        'quincaillerie_id',
        'user_id',
        'caisse_id',
        'date_vente',
        'total',
        'modes_paiement_id',
        'type_vente',
    ];

    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function modePaiement()
    {
        return $this->belongsTo(ModePaiement::class, 'modes_paiement_id');
    }

    public function produits()
    {
        //return $this->belongsToMany(Produit::class)->withPivot('quantite', 'prix_unitaire', 'total');
        return $this->belongsToMany(Produit::class, 'vente_produit')  // Spécifiez le nom de la table pivot
                    ->withPivot('quantite', 'prix_unitaire', 'total');
    }

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
}
