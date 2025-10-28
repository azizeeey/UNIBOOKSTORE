<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('cari');

            $bukus = Buku::with('penerbit')
                ->when($search, function ($query) use ($search) {
                    return $query->where('nama_buku', 'LIKE', '%' . $search . '%');
                })
                ->get();

            return view('index', compact('bukus', 'search'));
        } catch (QueryException $e) {
            Log::error("Database Connection Failed in index: " . $e->getMessage());
            return view('index', ['bukus' => collect(), 'search' => $request->query('cari'), 'db_error' => "Error: Gagal terhubung ke database. Cek konfigurasi ENV database di Vercel."]);
        }
    }

    public function admin()
    {
        try {
            // Ambil data buku dengan relasi penerbit untuk tampilan tabel
            $bukus = Buku::with('penerbit')->get();
            $penerbits = Penerbit::all();
            return view('admin', compact('bukus', 'penerbits'));
        } catch (QueryException $e) {
            Log::error("Database Connection Failed in admin: " . $e->getMessage());
            // Redirect ke home dengan pesan error jika koneksi database gagal
            return redirect('/')->with('status', 'error_db_connect')->with('db_error_message', "Gagal memuat data admin: Cek koneksi database Anda.");
        }
    }

    public function pengadaan()
    {
        // Since the user did not provide logic for this, I'll return the view.
        // I'll assume the view needs 'bukus' based on the other pages.
        try {
            $bukus = Buku::where('stok', '<', 5)->get(); // Example logic: find books with low stock
            return view('pengadaan', compact('bukus'));
        } catch (QueryException $e) {
            Log::error("Database Connection Failed in pengadaan: " . $e->getMessage());
            return redirect('/')->with('status', 'error_db_connect')->with('db_error_message', "Gagal memuat data pengadaan: Cek koneksi database Anda.");
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'nama_buku' => 'required',
        ]);

        try {
            Buku::create($request->all());
            return redirect()->route('buku.admin')->with('status', 'success_add');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('status', 'error_duplicate_id')->withInput();
            }
            return redirect()->back()->with('status', 'error');
        }
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'nama_buku' => 'required',
        ]);

        $buku->update($request->all());
        return redirect()->route('buku.admin')->with('status', 'success_update');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.admin')->with('status', 'success_delete');
    }
}