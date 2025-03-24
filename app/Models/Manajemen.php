<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lowongan_id', 'jenis_kontrak',
        'tanggal_mulai', 'tanggal_selesai', 'status', 'catatan'
    ];

    public function users()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'user_id');
    }

    public function lowongans()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }
}