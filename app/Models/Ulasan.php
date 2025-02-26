<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasans';

    protected $fillable = [
        'lowongan_id', 'pemberi_id', 'pekerja_id', 'rating', 'komentar'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function pemberi()
    {
        return $this->belongsTo(User::class, 'pemberi_id');
    }

    public function pekerja()
    {
        return $this->belongsTo(User::class, 'pekerja_id');
    }
}
