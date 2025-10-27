<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data PENERBIT dari data.sql
        DB::table('penerbit')->insert([
            ['id_penerbit' => 'SP01', 'nama_penerbit' => 'Penerbit Informatika', 'alamat' => 'Jl. Buah Batu No. 121', 'kota' => 'Bandung', 'telepon' => '0813-2220-1946'],
            ['id_penerbit' => 'SP02', 'nama_penerbit' => 'Andi Offset', 'alamat' => 'Jl. Suryalaya IX No.3', 'kota' => 'Bandung', 'telepon' => '0878-3903-0688'],
            ['id_penerbit' => 'SP03', 'nama_penerbit' => 'Danendra', 'alamat' => 'Jl. Moch. Toha 44', 'kota' => 'Bandung', 'telepon' => '022-5201215'],
        ]);
    }
}
