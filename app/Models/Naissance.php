<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Naissance extends Model
{
    protected $fillable = [
        'enfant_nom',
        'enfant_prenom',
        'date_naissance',
        'pere_prenom',
        'mere_prenom',
        'lieu',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];
}