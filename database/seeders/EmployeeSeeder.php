<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'npk' => '10428',
                'nama' => 'Ari',
                'alamat' => 'Jakarta',
            ],
            [
                'npk' => '19020',
                'nama' => 'Syahrul',
                'alamat' => 'Purbalingga',
            ],
            [
                'npk' => '19999',
                'nama' => 'Budiman',
                'alamat' => 'Subang',
            ],
        ]);
    }
}
