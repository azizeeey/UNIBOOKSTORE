{{-- resources/views/buku/admin.blade.php (Dashboard dan Tabel) --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-top: 2rem;">
<h2>Kelola Data Buku</h2>

{{-- Tambahkan notifikasi Laravel di sini --}}
@if (session('status'))
    @php
        $status = session('status');
        $msg = '';
        $type = 'success';
        if ($status === 'success_add') {$msg = 'Buku berhasil ditambahkan.';}
        elseif ($status === 'success_update') {$msg = 'Buku berhasil diupdate.';}
        elseif ($status === 'success_delete') {$msg = 'Buku berhasil dihapus.'; $type = 'danger';}
        elseif ($status === 'error_duplicate_id') {$msg = 'Gagal: ID Buku sudah terdaftar. Gunakan ID yang berbeda.'; $type = 'danger';}
        else {$msg = 'Terjadi kesalahan.'; $type = 'danger';}
    @endphp
    {{-- Render notifikasi custom dari kode PHP murni lama --}}
    <div class="notification {{ $type }} show"><span class="icon">✔</span><span class="msg">{{ $msg }}</span><button type="button" class="close-btn">&times;</button></div>
@endif

<p>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
</p>

{{-- Tabel Buku (READ) --}}
<div class="card">
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID Buku</th>
            <th>Kategori</th>
            <th>Nama Buku</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Penerbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($bukus as $buku)
    <tr>
        <td>{{ $buku->id_buku }}</td>
        <td>{{ $buku->kategori }}</td>
        <td>{{ $buku->nama_buku }}</td>
        <td>Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
        <td>{{ $buku->stok }}</td>
        <td>{{ $buku->penerbit->nama_penerbit }}</td>
        <td>
            {{-- Tombol Edit --}}
            <a href="{{ route('buku.edit', $buku->id_buku) }}" title="Edit" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                <i class="fas fa-edit"></i>
            </a>

            {{-- Tombol Delete (menggunakan form method DELETE) --}}
            <form action="{{ route('buku.destroy', $buku->id_buku) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus {{ $buku->nama_buku }}? Aksi ini tidak dapat dikembalikan.');">
                @csrf
                @method('DELETE')
                <button type="submit" title="Hapus" class="btn btn-sm btn-outline-danger" aria-label="Hapus">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
@endsection
