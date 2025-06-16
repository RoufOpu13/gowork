<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $pendaftaranData = [];
        $statuses = ['Menunggu'];
        $pengalamanList = [
            '1 tahun sebagai buruh pabrik',
            '2 tahun sebagai teknisi',
            '3 tahun sebagai tukang kayu',
            '4 tahun sebagai mekanik',
            '5 tahun sebagai mandor proyek',
            '6 bulan sebagai asisten bangunan',
            '1,5 tahun sebagai tukang cat',
            '2,5 tahun sebagai tukang listrik',
            '3,5 tahun sebagai pekerja harian'
        ];
        $keahlianList = [
            'Pertukangan, Perakitan',
            'Instalasi listrik, Pemeliharaan',
            'Pengecatan, Pengukuran',
            'Las listrik, Pemotongan besi',
            'Pemeliharaan mesin, Perbaikan alat berat',
            'Konstruksi bangunan, Pemasangan bata',
            'Pengelasan, Pemipaan',
            'Perawatan gedung, Renovasi ringan',
            'Pengepakan barang, Bongkar muat'
        ];

        for ($i = 0; $i < 30; $i++) {
            // Membuat tanggal acak antara 1 Januari 2024 sampai hari ini
            $startDate = Carbon::create(2024, 1, 1);
            $endDate = Carbon::now();
            $randomDate = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));

            $pendaftaranData[] = [
                'user_id' => rand(7, 14),
                'lowongan_id' => rand(1, 15),
                'pengalaman' => $pengalamanList[array_rand($pengalamanList)],
                'keahlian' => $keahlianList[array_rand($keahlianList)],
                'status' => $statuses[array_rand($statuses)],
                'tanggal_pendaftaran' => $randomDate->toDateString(), // Format: YYYY-MM-DD
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ];
        }


        DB::table('pendaftarans')->insert($pendaftaranData);
    }
}
