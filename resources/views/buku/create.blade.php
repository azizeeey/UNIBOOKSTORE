@extends('layouts.app')

@section('content')

<h2>Tambah Buku</h2>

<div class="card" style="max-width:720px;">
<form method="POST" action="{{ route('buku.store') }}">
    @csrf

    @if (session('status') === 'error_duplicate_id')
        <p style="color:red;">Gagal: ID Buku sudah terdaftar. Gunakan ID yang berbeda.</p>
    @endif

    <div class="mb-3">
        <input type="text" name="id_buku" class="form-control" placeholder="ID Buku" value="{{ old('id_buku') }}" required>
    </div>
    <div class="mb-3">
        <input type="text" name="kategori" class="form-control" placeholder="Kategori" value="{{ old('kategori') }}" required>
    </div>
    <div class="mb-3">
        <input type="text" name="nama_buku" class="form-control" placeholder="Nama Buku" value="{{ old('nama_buku') }}" required>
    </div>
    <div class="mb-3">
        <input type="number" name="harga" class="form-control" placeholder="Harga" value="{{ old('harga') }}" required>
    </div>
    <div class="mb-3">
        <input type="number" name="stok" class="form-control" placeholder="Stok" value="{{ old('stok') }}" required>
    </div>
    <div class="mb-3">
        <select name="id_penerbit" class="form-select" required>
            <option value="">--Pilih Penerbit--</option>
            @foreach ($penerbits as $p)
                <option value="{{ $p->id_penerbit }}" {{ old('id_penerbit') == $p->id_penerbit ? 'selected' : '' }}>
                    {{ $p->nama_penerbit }}
                </option>
            @endforeach
        </select>
    </div>
    <div style="display:flex;gap:.5rem;margin-top:1rem;">
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="{{ route('buku.admin') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
</div>

@endsection
