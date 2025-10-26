{{-- resources/views/buku/edit.blade.php --}}
@extends('layouts.app')

@section('content')

<h2>Edit Buku: {{ $buku->nama_buku }}</h2>

<div class="card" style="max-width:720px;">
{{-- Menggunakan method PUT untuk UPDATE di Laravel --}}
<form method="POST" action="{{ route('buku.update', $buku->id_buku) }}">
    @csrf
    @method('PUT')

    <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">

    <div class="mb-3">
        <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $buku->kategori) }}" required>
    </div>
    <div class="mb-3">
        <input type="text" name="nama_buku" class="form-control" value="{{ old('nama_buku', $buku->nama_buku) }}" required>
    </div>
    <div class="mb-3">
        <input type="number" name="harga" class="form-control" value="{{ old('harga', $buku->harga) }}" required>
    </div>
    <div class="mb-3">
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $buku->stok) }}" required>
    </div>
    <div class="mb-3">
        <select name="id_penerbit" class="form-select" required>
            @foreach ($penerbits as $p)
                @php
                    $isSelected = (old('id_penerbit', $buku->id_penerbit) == $p->id_penerbit);
                @endphp
                <option value="{{ $p->id_penerbit }}" {{ $isSelected ? 'selected' : '' }}>
                    {{ $p->nama_penerbit }}
                </option>
            @endforeach
        </select>
    </div>
    <div style="display:flex;gap:.5rem;">
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="{{ route('buku.admin') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
</div>

@endsection
