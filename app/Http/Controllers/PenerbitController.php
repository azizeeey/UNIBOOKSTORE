<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_penerbit' => 'required',
            'nama_penerbit' => 'required',
        ]);

        try {
            Penerbit::create($request->all());
            return redirect()->route('buku.admin')->with('status', 'success_add_penerbit');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('status', 'error_duplicate_id_penerbit')->withInput();
            }
            return redirect()->back()->with('status', 'error');
        }
    }

    public function edit(Penerbit $penerbit)
    {
        return redirect()->route('buku.admin')->with('edit_penerbit', $penerbit);
    }

    public function update(Request $request, Penerbit $penerbit)
    {
        $request->validate([
            'nama_penerbit' => 'required',
        ]);

        $penerbit->update($request->all());
        return redirect()->route('buku.admin')->with('status', 'success_update_penerbit');
    }

    public function destroy(Penerbit $penerbit)
    {
        if ($penerbit->buku()->exists()) {
            return redirect()->route('buku.admin')->with('status', 'error_delete_penerbit_has_books');
        }

        $penerbit->delete();
        return redirect()->route('buku.admin')->with('status', 'success_delete_penerbit');
    }
}
