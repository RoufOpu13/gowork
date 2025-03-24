<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Utama',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Admin'
            ],
            [
                'name' => 'Agen Kuli Mandiri',
                'email' => 'perekrut1@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'Agen Kuli Sejahtera',
                'email' => 'perekrut2@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'Agen Kuli Nusantara',
                'email' => 'perekrut3@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'Agen Kuli Berkah',
                'email' => 'perekrut4@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'Agen Kuli Jaya',
                'email' => 'perekrut5@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Andi Saputra',
                'email' => 'andi.saputra@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi.hartono@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Lina Kurniawati',
                'email' => 'lina.kurniawati@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Tono Wijaya',
                'email' => 'tono.wijaya@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Rina Setiawan',
                'email' => 'rina.setiawan@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
        ]);
    }
}
