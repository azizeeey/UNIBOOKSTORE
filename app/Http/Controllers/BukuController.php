<?php

// app/Http/Controllers/BukuController.php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('cari');

        // Logika Pengambilan Data dan Search menggunakan Eloquent ORM
        $bukus = Buku::with('penerbit')
            ->when($search, function ($query) use ($search) {
                // Where clause untuk pencarian Nama Buku (sesuai index.php lama)
                return $query->where('nama_buku', 'LIKE', '%' . $search . '%');
            })
            ->get();

        // Mengirimkan hasil data ($bukus) dan kata kunci pencarian ($search) ke View
        return view('buku.index', compact('bukus', 'search'));
    }

    // Metode lain untuk admin(), pengadaan(), store(), update(), dan destroy() akan ditambahkan di sini...
}
