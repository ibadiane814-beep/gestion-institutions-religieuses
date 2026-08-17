<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
        'institution_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isResponsable()
    {
        return $this->role === 'responsable';
    }

    public function isCitoyen()
    {
        return $this->role === 'citoyen';
    }
}