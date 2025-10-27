@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin-top: 2rem;">
<h2>Pengelolaan Data</h2>

{{-- Notifikasi Status --}}
@if (session('status'))
    @php
        $status = session('status');
        $msg = '';
        $type = 'success';
        if ($status === 'success_add') {$msg = 'Buku berhasil ditambahkan.';}
        elseif ($status === 'success_update') {$msg = 'Buku berhasil diupdate.';}
        elseif ($status === 'success_delete') {$msg = 'Buku berhasil dihapus.'; $type = 'danger';}
        elseif ($status === 'error_duplicate_id') {$msg = 'Gagal: ID Buku sudah terdaftar.'; $type = 'danger';}
        elseif ($status === 'success_add_penerbit') {$msg = 'Penerbit berhasil ditambahkan.';}
        elseif ($status === 'success_update_penerbit') {$msg = 'Penerbit berhasil diupdate.';}
        elseif ($status === 'success_delete_penerbit') {$msg = 'Penerbit berhasil dihapus.'; $type = 'danger';}
        elseif ($status === 'error_duplicate_id_penerbit') {$msg = 'Gagal: ID Penerbit sudah terdaftar.'; $type = 'danger';}
        elseif ($status === 'error_delete_penerbit_has_books') {$msg = 'Gagal: Penerbit tidak dapat dihapus karena masih memiliki buku terkait.'; $type = 'danger';}
        else {$msg = 'Terjadi kesalahan.'; $type = 'danger';}
    @endphp
    <div class="notification {{ $type }} show"><span class="icon">✔</span><span class="msg">{{ $msg }}</span><button type="button" class="close-btn">&times;</button></div>
@endif

{{-- Navigasi Tab --}}
<ul class="nav nav-tabs" id="adminTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="buku-tab" data-bs-toggle="tab" data-bs-target="#buku-pane" type="button" role="tab" aria-controls="buku-pane" aria-selected="true">Buku</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="penerbit-tab" data-bs-toggle="tab" data-bs-target="#penerbit-pane" type="button" role="tab" aria-controls="penerbit-pane" aria-selected="false">Penerbit</button>
    </li>
</ul>

{{-- Konten Tab --}}
<div class="tab-content" id="adminTabContent">
    {{-- Tab Buku --}}
    <div class="tab-pane fade" id="buku-pane" role="tabpanel" aria-labelledby="buku-tab" tabindex="0">
        <div class="py-3">
            <p>
                <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
            </p>
            <div class="card">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Buku</th>
                            <th>Penerbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($bukus as $buku)
                    <tr>
                        <td>{{ $buku->id_buku }}</td>
                        <td>{{ $buku->nama_buku }}</td>
                        <td>{{ $buku->penerbit->nama_penerbit }}</td>
                        <td>
                            <a href="{{ route('buku.edit', $buku->id_buku) }}" title="Edit" class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('buku.destroy', $buku->id_buku) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus {{ $buku->nama_buku }}?');">
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
    </div>

    {{-- Tab Penerbit --}}
    <div class="tab-pane fade" id="penerbit-pane" role="tabpanel" aria-labelledby="penerbit-tab" tabindex="0">
        <div class="py-3">
            {{-- Form Tambah Penerbit --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Tambah Penerbit Baru</h5>
                    <form action="{{ route('penerbit.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id_penerbit" class="form-label">ID Penerbit</label>
                            <input type="text" class="form-control" id="id_penerbit" name="id_penerbit" value="{{ old('id_penerbit') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
                            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="{{ old('nama_penerbit') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Penerbit</button>
                    </form>
                </div>
            </div>

            {{-- Tabel Daftar Penerbit --}}
            <div class="card">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Penerbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($penerbits as $penerbit)
                    <tr>
                        <td>{{ $penerbit->id_penerbit }}</td>
                        <td>{{ $penerbit->nama_penerbit }}</td>
                        <td>
                            <form action="{{ route('penerbit.destroy', $penerbit->id_penerbit) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus {{ $penerbit->nama_penerbit }}?');">
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
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab persistence
        var triggerTabList = [].slice.call(document.querySelectorAll('#adminTab button'));
        triggerTabList.forEach(function(triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl);

            triggerEl.addEventListener('click', function(event) {
                event.preventDefault();
                tabTrigger.show();
                localStorage.setItem('activeAdminTab', triggerEl.getAttribute('data-bs-target'));
            });
        });

        var activeTab = localStorage.getItem('activeAdminTab');
        var status = "{{ session('status') ?? '' }}";

        // If there's a status message for publishers, switch to the publisher tab
        if (status.includes('penerbit')) {
            activeTab = '#penerbit-pane';
            localStorage.setItem('activeAdminTab', activeTab);
        }

        if (activeTab) {
            var someTabTriggerEl = document.querySelector('button[data-bs-target="' + activeTab + '"]');
            if(someTabTriggerEl) {
                var tab = new bootstrap.Tab(someTabTriggerEl);
                tab.show();
            }
        } else {
            // Show the first tab by default if nothing is in localStorage
            var firstTab = new bootstrap.Tab(triggerTabList[0]);
            firstTab.show();
        }
    });
</script>
@endsection
