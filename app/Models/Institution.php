<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'nom', 'type', 'adresse', 'telephone',
        'email', 'site_web', 'description', 'latitude', 'longitude'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function responsable()
    {
        return $this->hasOne(User::class)->where('role', 'responsable');
    }
}