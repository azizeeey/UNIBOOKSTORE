{{-- resources/views/buku/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-top: 2rem;">
<h2>Daftar Buku</h2>

{{-- Form Pencarian --}}
<form method="GET" action="{{ url('/') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="cari" class="form-control" placeholder="Cari nama buku..." value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </div>
</form>

{{-- Tabel Data --}}
<div class="card">
<table class="table table-striped table-hover">
    {{-- Header Tabel... --}}
    <tbody>
    @foreach ($bukus as $buku)
        <tr>
            <td>{{ $buku->id_buku }}</td>
            <td>{{ $buku->kategori }}</td>
            <td>{{ $buku->nama_buku }}</td>
            {{-- Menggunakan number_format bawaan PHP --}}
            <td>Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
            <td>{{ $buku->stok }}</td>
            {{-- Mengakses relasi Model --}}
            <td>{{ $buku->penerbit->nama_penerbit }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
@endsection
