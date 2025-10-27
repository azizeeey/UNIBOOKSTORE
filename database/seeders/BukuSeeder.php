<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data BUKU dari data.sql
        DB::table('buku')->insert([
            ['id_buku' => 'K1001', 'kategori' => 'Keilmuan', 'nama_buku' => 'Analisis & Perancangan Sistem Informasi', 'harga' => 50000.00, 'stok' => 60, 'id_penerbit' => 'SP01'],
            ['id_buku' => 'K1002', 'kategori' => 'Keilmuan', 'nama_buku' => 'Artifical Intelligence', 'harga' => 45000.00, 'stok' => 60, 'id_penerbit' => 'SP01'],
            ['id_buku' => 'K2003', 'kategori' => 'Keilmuan', 'nama_buku' => 'Autocad 3 Dimensi', 'harga' => 40000.00, 'stok' => 25, 'id_penerbit' => 'SP01'],
            ['id_buku' => 'B1001', 'kategori' => 'Bisnis', 'nama_buku' => 'Bisnis Online', 'harga' => 75000.00, 'stok' => 9, 'id_penerbit' => 'SP01'],
            ['id_buku' => 'K3004', 'kategori' => 'Keilmuan', 'nama_buku' => 'Cloud Computing Technology', 'harga' => 85000.00, 'stok' => 15, 'id_penerbit' => 'SP01'],
            ['id_buku' => 'B1002', 'kategori' => 'Bisnis', 'nama_buku' => 'Etika Bisnis dan Tanggung Jawab Sosial', 'harga' => 67500.00, 'stok' => 20, 'id_penerbit' => 'SP01'],
            ['id_buku' => 'N1001', 'kategori' => 'Novel', 'nama_buku' => 'Cahaya Di Penjuru Hati', 'harga' => 68000.00, 'stok' => 10, 'id_penerbit' => 'SP02'],
            ['id_buku' => 'N1002', 'kategori' => 'Novel', 'nama_buku' => 'Aku Ingin Cerita', 'harga' => 48000.00, 'stok' => 12, 'id_penerbit' => 'SP03'],
        ]);
    }
}
