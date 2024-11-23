<?php

namespace App\Models;

use App\Models\Caisse;
use App\Models\Quincaillerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'quincaillerie_id',
        'caisse_id',
        'description',
        'montant',
        'date_depense',
    ];

    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }
}
