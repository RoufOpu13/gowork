<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManajemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('manajemens')->insert([
            [
                'id' => 1,
                'lowongan_id' => 6,
                'user_id' => 7,
                'jenis_kontrak' => 'mingguan',
                'tanggal_mulai' => Carbon::now()->subDays(10),
                'tanggal_selesai' => Carbon::now()->addDays(20),
                'status' => 'aktif',
                'catatan' => 'Kontrak diperpanjang jika performa bagus.'
            ],
            [
                'id' => 2,
                'lowongan_id' => 6,
                'user_id' => 11,
                'jenis_kontrak' => 'harian',
                'tanggal_mulai' => Carbon::now()->subDays(2),
                'tanggal_selesai' => Carbon::now()->addDays(5),
                'status' => 'aktif',
                'catatan' => 'Kontrak sementara, bisa diperpanjang.'
            ],
            [
                'id' => 3,
                'lowongan_id' => 2,
                'user_id' => 11,
                'jenis_kontrak' => 'bulanan',
                'tanggal_mulai' => Carbon::now()->subMonths(1),
                'tanggal_selesai' => Carbon::now()->addMonths(2),
                'status' => 'aktif',
                'catatan' => 'Pekerja tetap, evaluasi setiap 3 bulan.'
            ],
        ]);
    }
}
