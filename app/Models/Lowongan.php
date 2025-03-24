<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongans';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'kategori',
        'lokasi',
        'gaji',
        'status',
    ];

    /**
     * Relasi ke tabel users (Pemberi kerja)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }
    /**
     * Relasi ke tabel pendaftarans
     */
    public function pendaftarans()
{
    return $this->hasMany(Pendaftaran::class);
}
}
