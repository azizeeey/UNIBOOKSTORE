<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
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

 //   public function edit(Buku $buku)
 //   {
 //       return redirect()->route('buku.admin')->with('edit_buku', $buku);
 //   }

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
