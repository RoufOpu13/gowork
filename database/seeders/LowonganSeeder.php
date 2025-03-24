<?php

namespace Database\Seeders;

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
            // Data Lama (5 Data Pertama)
            [
                'id' => 1,
                'user_id' => 4,
                'judul' => 'Kuli Bangunan',
                'deskripsi' => 'Membantu dalam pembangunan rumah dan gedung.',
                'kategori' => 'Konstruksi',
                'lokasi' => 'Jakarta',
                'gaji' => '3500000',
                'status' => 'Aktif'
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'judul' => 'Tukang Kayu',
                'deskripsi' => 'Mengerjakan pembuatan dan perbaikan furnitur kayu.',
                'kategori' => 'Pertukangan',
                'lokasi' => 'Bandung',
                'gaji' => '4000000',
                'status' => 'Ditutup'
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'judul' => 'Buruh Harian Pabrik',
                'deskripsi' => 'Membantu proses produksi dan pengepakan barang.',
                'kategori' => 'Buruh Harian',
                'lokasi' => 'Surabaya',
                'gaji' => '3200000',
                'status' => 'Aktif'
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'judul' => 'Pekerja Proyek Jalan',
                'deskripsi' => 'Mengerjakan pembangunan dan perbaikan jalan.',
                'kategori' => 'Konstruksi',
                'lokasi' => 'Medan',
                'gaji' => '3700000',
                'status' => 'Ditutup'
            ],
            [
                'id' => 5,
                'user_id' => 5,
                'judul' => 'Tukang Las',
                'deskripsi' => 'Mengerjakan pengelasan untuk konstruksi besi.',
                'kategori' => 'Pertukangan',
                'lokasi' => 'Semarang',
                'gaji' => '4500000',
                'status' => 'Aktif'
            ],

            // Data Tambahan (10 Data)
            [
                'id' => 6,
                'user_id' => 2,
                'judul' => 'Teknisi AC',
                'deskripsi' => 'Memperbaiki dan merawat AC.',
                'kategori' => 'Teknisi',
                'lokasi' => 'Jakarta',
                'gaji' => '5000000',
                'status' => 'Aktif'
            ],
            [
                'id' => 7,
                'user_id' => 3,
                'judul' => 'Supir Truk',
                'deskripsi' => 'Mengantarkan barang ke berbagai lokasi.',
                'kategori' => 'Transportasi',
                'lokasi' => 'Surabaya',
                'gaji' => '5500000',
                'status' => 'Aktif'
            ],
            [
                'id' => 8,
                'user_id' => 4,
                'judul' => 'Petani Sayur',
                'deskripsi' => 'Bercocok tanam dan merawat tanaman sayuran.',
                'kategori' => 'Pertanian',
                'lokasi' => 'Bogor',
                'gaji' => '3000000',
                'status' => 'Aktif'
            ],
            [
                'id' => 9,
                'user_id' => 5,
                'judul' => 'Penjahit',
                'deskripsi' => 'Menjahit pakaian sesuai pesanan pelanggan.',
                'kategori' => 'Tekstil',
                'lokasi' => 'Yogyakarta',
                'gaji' => '3800000',
                'status' => 'Ditutup'
            ],
            [
                'id' => 10,
                'user_id' => 2,
                'judul' => 'Montir Motor',
                'deskripsi' => 'Memperbaiki dan merawat kendaraan bermotor.',
                'kategori' => 'Otomotif',
                'lokasi' => 'Jakarta',
                'gaji' => '6000000',
                'status' => 'Aktif'
            ],
            [
                'id' => 11,
                'user_id' => 3,
                'judul' => 'Asisten Tukang Batu',
                'deskripsi' => 'Membantu dalam pekerjaan konstruksi batu bata.',
                'kategori' => 'Konstruksi',
                'lokasi' => 'Bandung',
                'gaji' => '3500000',
                'status' => 'Aktif'
            ],
            [
                'id' => 12,
                'user_id' => 4,
                'judul' => 'Pembersih Rumah',
                'deskripsi' => 'Membersihkan dan merapikan rumah tangga.',
                'kategori' => 'Jasa',
                'lokasi' => 'Medan',
                'gaji' => '2500000',
                'status' => 'Aktif'
            ],
            [
                'id' => 13,
                'user_id' => 5,
                'judul' => 'Koki Restoran',
                'deskripsi' => 'Memasak makanan untuk pelanggan di restoran.',
                'kategori' => 'Kuliner',
                'lokasi' => 'Bali',
                'gaji' => '7000000',
                'status' => 'Ditutup'
            ],
            [
                'id' => 14,
                'user_id' => 2,
                'judul' => 'Pelayan Cafe',
                'deskripsi' => 'Melayani pelanggan di kafe dan restoran.',
                'kategori' => 'Pelayanan',
                'lokasi' => 'Jakarta',
                'gaji' => '2800000',
                'status' => 'Aktif'
            ],
            [
                'id' => 15,
                'user_id' => 3,
                'judul' => 'Teknisi Listrik',
                'deskripsi' => 'Memasang dan memperbaiki instalasi listrik.',
                'kategori' => 'Teknisi',
                'lokasi' => 'Surabaya',
                'gaji' => '5000000',
                'status' => 'Aktif'
            ]
        ]);
    }
}
