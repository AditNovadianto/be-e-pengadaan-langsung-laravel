<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';
    protected $primaryKey = 'id_pengadaan';

    protected $fillable = [
        'nama_pengadaan',
        'pagu_anggaran',
        'nilai_penawaran',
        'nilai_kontrak',
        'status_pengadaan',
        'id_user',
        'id_penyedia'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function penyedia()
    {
        return $this->belongsTo(Penyedia::class, 'id_penyedia', 'id_penyedia');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_pengadaan', 'id_pengadaan');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_pengadaan', 'id_pengadaan');
    }
}
