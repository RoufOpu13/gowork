<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendaftarans')->insert([
            [
                'user_id' => 7,
                'lowongan_id' => 2,
                'pengalaman' => '2 tahun sebagai tukang kayu',
                'keahlian' => 'Pertukangan, Perakitan',
                'status' => 'Menunggu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'lowongan_id' => 3,
                'pengalaman' => '3 tahun sebagai teknisi listrik',
                'keahlian' => 'Instalasi listrik, Pemeliharaan',
                'status' => 'Diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'lowongan_id' => 1,
                'pengalaman' => '1 tahun sebagai asisten bangunan',
                'keahlian' => 'Pengecatan, Pengukuran',
                'status' => 'Ditolak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
