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
                'name' => 'Ini Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Admin'
            ],
            [
                'name' => 'PT. Wing',
                'email' => 'perekrut1@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'PT. Indofood',
                'email' => 'perekrut2@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'PT. Astra',
                'email' => 'perekrut3@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'PT. Garuda Food',
                'email' => 'perekrut4@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'PT. Unilever',
                'email' => 'perekrut5@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Perekrut'
            ],
            [
                'name' => 'Pekerja 1',
                'email' => 'pekerja1@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Pekerja 2',
                'email' => 'pekerja2@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
            [
                'name' => 'Pekerja 3',
                'email' => 'pekerja3@gmail.com',
                'password' => bcrypt('123456789'),
                'roles' => 'Pekerja'
            ],
        ]);
    }
}
