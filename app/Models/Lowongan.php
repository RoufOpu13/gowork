<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongans';

    protected $fillable = [
        'user_id', 'judul', 'deskripsi', 'kategori', 'lokasi', 'gaji', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}