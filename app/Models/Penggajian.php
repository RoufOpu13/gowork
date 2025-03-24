<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'gaji',
        'tanggal_pembayaran',
        'status'
    ];

    // Relasi ke User (Pekerja)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manajemen()
{
    return $this->belongsTo(Manajemen::class, 'manajemen_id');
}
    // Relasi ke Lowongan
  
}
