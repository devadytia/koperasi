<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'kode' => 'M001',
                'nama_item' => 'Minyak Goreng 1 kg',
                'harga' => 23000,
            ],
            [
                'kode' => 'M002',
                'nama_item' => 'Beras 5kg',
                'harga' => 60000,
            ],
            [
                'kode' => 'M003',
                'nama_item' => 'Gula 1 kg',
                'harga' => 15000,
            ],
            [
                'kode' => 'M004',
                'nama_item' => 'Mie Goreng',
                'harga' => 2500,
            ],
        ]);
    }
}
