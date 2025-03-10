<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lowongans')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'judul' => 'Lowongan Operator Produksi',
                'deskripsi' => 'Membantu proses produksi di pabrik',
                'kategori' => 'Produksi',
                'lokasi' => 'Jakarta',
                'gaji' => '5000000',
                'status' => 'Aktif'
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'judul' => 'Lowongan Staff Administrasi',
                'deskripsi' => 'Mengelola administrasi perusahaan',
                'kategori' => 'Administrasi',
                'lokasi' => 'Bandung',
                'gaji' => '4500000',
                'status' => 'Ditutup'
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'judul' => 'Lowongan Sales Marketing',
                'deskripsi' => 'Menjual produk perusahaan',
                'kategori' => 'Pemasaran',
                'lokasi' => 'Surabaya',
                'gaji' => '5500000',
                'status' => 'Aktif'
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'judul' => 'Lowongan Teknisi Mesin',
                'deskripsi' => 'Memperbaiki dan merawat mesin produksi',
                'kategori' => 'Teknik',
                'lokasi' => 'Medan',
                'gaji' => '6000000',
                'status' => 'Ditutup'
            ],
            [
                'id' => 5,
                'user_id' => 5,
                'judul' => 'Lowongan Driver Ekspedisi',
                'deskripsi' => 'Mengantarkan barang ke pelanggan',
                'kategori' => 'Transportasi',
                'lokasi' => 'Semarang',
                'gaji' => '5000000',
                'status' => 'Aktif'
            ]
        ]);
    }
}