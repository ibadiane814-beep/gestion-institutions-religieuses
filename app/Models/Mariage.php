<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mariage extends Model
{
    protected $fillable = [
        'conjoint1_nom',
        'conjoint1_prenom',
        'conjoint2_nom',
        'conjoint2_prenom',
        'date_mariage',
        'lieu',
        'officiant',
    ];
}
