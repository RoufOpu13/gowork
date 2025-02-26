<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'lowongan_id', 'user_id', 'tipe', 'deskripsi'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
