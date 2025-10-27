{{-- resources/views/buku/pengadaan.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-top: 2rem;">
<h2>Laporan Kebutuhan Buku</h2>
<p>Berikut daftar buku dengan stok paling sedikit (<= {{ $stok_limit }}):</p>

<div class="card">
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Nama Buku</th>
            <th>Penerbit</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($bukus as $buku)
    <tr>
        <td>{{ $buku->nama_buku }}</td>
        <td>{{ $buku->penerbit->nama_penerbit }}</td>
        <td>{{ $buku->stok }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
@endsection
