<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Penyedia extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'penyedia';
    protected $primaryKey = 'id_penyedia';

    protected $fillable = [
        'nama_perusahaan',
        'email_penyedia',
        'password_penyedia',
        'nib',
        'id_sistem'
    ];

    protected $hidden = [
        'password_penyedia',
    ];

    public function getAuthPasswordName()
    {
        return 'password_penyedia';
    }

    public function sistem()
    {
        return $this->belongsTo(Sistem::class, 'id_sistem', 'id_sistem');
    }
}
