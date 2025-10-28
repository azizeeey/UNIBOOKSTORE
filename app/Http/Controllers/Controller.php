<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;

abstract class Controller
{
    //home dan search function bisa ditaruh di sini jika diperlukan
    public function index(Request $request)
    {
        $search = $request->query('cari');

        $bukus = Buku::with('penerbit')
            ->when($search, function ($query) use ($search) {
                return $query->where('nama_buku', 'LIKE', '%' . $search . '%');
            })
            ->get();

        return view('buku.index', compact('bukus', 'search'));
    }

    //admin dashboard function bisa ditaruh di sini jika diperlukan
    public function admin()
    {
        $bukus = Buku::with('penerbit')->get();
        $penerbits = Penerbit::all();
        return view('buku.admin', compact('bukus', 'penerbits'));
    }

    //pengadaan function bisa ditaruh di sini jika diperlukan
    public function pengadaan()
    {
        $stok_limit = 20;
        $bukus = Buku::with('penerbit')
            ->where('stok', '<=', $stok_limit)
            ->orderBy('stok', 'asc')
            ->get();

        return view('buku.pengadaan', compact('bukus', 'stok_limit'));
    }
}
