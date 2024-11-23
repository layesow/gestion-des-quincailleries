<?php

namespace App\Models;

use App\Models\Quincaillerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'quincaillerie_id',
        'titre',
        'description',
        'date_rapport',
    ];

    public function quincaillerie()
    {
        return $this->belongsTo(Quincaillerie::class);
    }
}
