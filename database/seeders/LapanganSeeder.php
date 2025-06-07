<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lapangans')->insert([
            ['nama_lapangan' => 'Lapangan Premium', 'tipe' => 'Sintetis', 'harga_per_jam' => 150000],
            ['nama_lapangan' => 'Lapangan Eksekutif', 'tipe' => 'Vinyl', 'harga_per_jam' => 200000],
            ['nama_lapangan' => 'Lapangan Santai', 'tipe' => 'Beton', 'harga_per_jam' => 100000],
        ]);
    }
}
