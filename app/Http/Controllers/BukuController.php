<?php

// app/Http/Controllers/BukuController.php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // --------------------------------------------------------
    // 1. HOME & SEARCH (Sesuai index.php lama)
    // --------------------------------------------------------
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

    // --------------------------------------------------------
    // 2. ADMIN DASHBOARD (admin.php lama)
    // --------------------------------------------------------
    public function admin()
    {
        // Ambil data buku dengan relasi penerbit untuk tampilan tabel
        $bukus = Buku::with('penerbit')->get();
        $penerbits = Penerbit::all();
        return view('buku.admin', compact('bukus', 'penerbits'));
    }

    // --------------------------------------------------------
    // 3. PENGADAAN REPORT (pengadaan.php lama)
    // --------------------------------------------------------
    public function pengadaan()
    {
        // Ambil buku dengan stok <= 20 dan urutkan dari yang paling sedikit
        $stok_limit = 20; // Sesuai logika where di pengadaan.php lama
        $bukus = Buku::with('penerbit')
            ->where('stok', '<=', $stok_limit)
            ->orderBy('stok', 'asc')
            ->get();

        return view('buku.pengadaan', compact('bukus', 'stok_limit'));
    }

    // --------------------------------------------------------
    // 4. CREATE (Form Tampil)
    // --------------------------------------------------------
    public function create()
    {
        $penerbits = Penerbit::all();
        return view('buku.create', compact('penerbits'));
    }

    // --------------------------------------------------------
    // 5. STORE (Simpan Data Baru)
    // --------------------------------------------------------
    public function store(Request $request)
    {
        // Note: Implementasi Validasi Form Laravel (optional tapi disarankan)
        $request->validate([
            'id_buku' => 'required|unique:buku,id_buku',
            'nama_buku' => 'required',
            // ... validasi lainnya ...
        ]);

        try {
            // Gunakan Eloquent untuk menyimpan data
            Buku::create($request->all());
            return redirect()->route('buku.admin')->with('status', 'success_add');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangani error duplicate entry (Primary Key)
            // Error code 23000 = Integritas data (biasanya Duplicate entry)
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('status', 'error_duplicate_id')->withInput();
            }
            return redirect()->back()->with('status', 'error');
        }
    }

    // --------------------------------------------------------
    // 6. EDIT (Form Tampil)
    // --------------------------------------------------------
    public function edit(Buku $buku)
    {
        $penerbits = Penerbit::all();
        return view('buku.edit', compact('buku', 'penerbits'));
    }

    // --------------------------------------------------------
    // 7. UPDATE (Simpan Perubahan)
    // --------------------------------------------------------
    public function update(Request $request, Buku $buku)
    {
        // [Implementasi Validasi Form Laravel di sini]

        $buku->update($request->all());
        return redirect()->route('buku.admin')->with('status', 'success_update');
    }

    // --------------------------------------------------------
    // 8. DESTROY (Hapus Data)
    // --------------------------------------------------------
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.admin')->with('status', 'success_delete');
    }
}
