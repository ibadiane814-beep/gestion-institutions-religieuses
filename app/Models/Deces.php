<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Deces extends Model
{
    protected $fillable = [
        'defunt_nom',
        'defunt_prenom',
        'date_deces',
        'lieu',
        'cause',
    ];

    protected $casts = [
        'date_deces' => 'date',
    ];
}