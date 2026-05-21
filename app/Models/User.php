<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_user',
        'email_user',
        'password_user',
        'status_user',
        'id_sistem',
        'id_role',
    ];

    protected $hidden = [
        'password_user',
        'remember_token',
    ];

    public function getAuthPasswordName()
    {
        return 'password_user';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function sistem()
    {
        return $this->belongsTo(Sistem::class, 'id_sistem', 'id_sistem');
    }
}
