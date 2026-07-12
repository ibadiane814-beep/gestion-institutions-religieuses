<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'responsable_id',
        'nom',
        'type',
        'adresse',
        'telephone',
        'email',
        'site_web',
        'description',
        'latitude',
        'longitude',
    ];
}
