<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemen extends Model
{
    use HasFactory;

    protected $table = 'manajemens';

    protected $fillable = [
        'lowongan_id', 'pekerja_id', 'status'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function pekerja()
    {
        return $this->belongsTo(User::class, 'pekerja_id');
    }
}
