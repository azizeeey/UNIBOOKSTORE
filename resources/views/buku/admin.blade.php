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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBukuModal">
                    Tambah Buku
                </button>
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
                            <button type="button" class="btn btn-sm btn-outline-primary edit-buku-btn" 
                                    data-bs-toggle="modal" data-bs-target="#editBukuModal"
                                    data-id="{{ $buku->id_buku }}"
                                    data-kategori="{{ $buku->kategori }}"
                                    data-nama="{{ $buku->nama_buku }}"
                                    data-harga="{{ $buku->harga }}"
                                    data-stok="{{ $buku->stok }}"
                                    data-penerbit="{{ $buku->id_penerbit }}">
                                <i class="fas fa-edit"></i>
                            </button>
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
            <p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPenerbitModal">
                    Tambah Penerbit
                </button>
            </p>
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
                            <button type="button" class="btn btn-sm btn-outline-primary edit-penerbit-btn" 
                                    data-bs-toggle="modal" data-bs-target="#editPenerbitModal"
                                    data-id="{{ $penerbit->id_penerbit }}"
                                    data-nama="{{ $penerbit->nama_penerbit }}"
                                    data-alamat="{{ $penerbit->alamat }}"
                                    data-kota="{{ $penerbit->kota }}"
                                    data-telepon="{{ $penerbit->telepon }}">
                                <i class="fas fa-edit"></i>
                            </button>
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

{{-- Modal Tambah Buku --}}
<div class="modal fade" id="addBukuModal" tabindex="-1" aria-labelledby="addBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBukuModalLabel">Tambah Buku Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('buku.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="id_buku" class="form-label">ID Buku</label>
                        <input type="text" name="id_buku" class="form-control" value="{{ old('id_buku') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_buku" class="form-label">Nama Buku</label>
                        <input type="text" name="nama_buku" class="form-control" value="{{ old('nama_buku') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_penerbit" class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select" required>
                            <option value="">--Pilih Penerbit--</option>
                            @foreach ($penerbits as $p)
                                <option value="{{ $p->id_penerbit }}" {{ old('id_penerbit') == $p->id_penerbit ? 'selected' : '' }}>
                                    {{ $p->nama_penerbit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Buku --}}
<div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="editBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBukuModalLabel">Edit Data Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBukuForm" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_kategori" class="form-label">Kategori</label>
                        <input type="text" id="edit_kategori" name="kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nama_buku" class="form-label">Nama Buku</label>
                        <input type="text" id="edit_nama_buku" name="nama_buku" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_harga" class="form-label">Harga</label>
                        <input type="number" id="edit_harga" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_stok" class="form-label">Stok</label>
                        <input type="number" id="edit_stok" name="stok" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_id_penerbit" class="form-label">Penerbit</label>
                        <select id="edit_id_penerbit" name="id_penerbit" class="form-select" required>
                            @foreach ($penerbits as $p)
                                <option value="{{ $p->id_penerbit }}">{{ $p->nama_penerbit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tambah Penerbit --}}
<div class="modal fade" id="addPenerbitModal" tabindex="-1" aria-labelledby="addPenerbitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPenerbitModalLabel">Tambah Penerbit Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('penerbit.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="id_penerbit" class="form-label">ID Penerbit</label>
                        <input type="text" class="form-control" id="id_penerbit" name="id_penerbit" value="{{ old('id_penerbit') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
                        <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="{{ old('nama_penerbit') }}" required>
                    </div>
                     <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                    </div>
                     <div class="mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota') }}">
                    </div>
                     <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Penerbit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Penerbit --}}
<div class="modal fade" id="editPenerbitModal" tabindex="-1" aria-labelledby="editPenerbitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPenerbitModalLabel">Edit Data Penerbit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPenerbitForm" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_nama_penerbit" class="form-label">Nama Penerbit</label>
                        <input type="text" class="form-control" id="edit_nama_penerbit" name="nama_penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="edit_alamat" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="edit_kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="edit_kota" name="kota">
                    </div>
                    <div class="mb-3">
                        <label for="edit_telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="edit_telepon" name="telepon">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Penerbit</button>
                </div>
            </form>
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

        if (status.includes('penerbit')) {
            activeTab = '#penerbit-pane';
        } else if (status.includes('buku')) {
            activeTab = '#buku-pane';
        }

        if (activeTab) {
            localStorage.setItem('activeAdminTab', activeTab);
            var someTabTriggerEl = document.querySelector('button[data-bs-target="' + activeTab + '"]');
            if(someTabTriggerEl) { new bootstrap.Tab(someTabTriggerEl).show(); }
        } else {
            new bootstrap.Tab(triggerTabList[0]).show();
        }

        // Edit Buku Modal
        const editBukuModal = document.getElementById('editBukuModal');
        editBukuModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const form = document.getElementById('editBukuForm');
            let url = "{{ route('buku.update', ':id') }}";
            url = url.replace(':id', id);
            form.action = url;

            form.querySelector('#edit_kategori').value = button.getAttribute('data-kategori');
            form.querySelector('#edit_nama_buku').value = button.getAttribute('data-nama');
            form.querySelector('#edit_harga').value = button.getAttribute('data-harga');
            form.querySelector('#edit_stok').value = button.getAttribute('data-stok');
            form.querySelector('#edit_id_penerbit').value = button.getAttribute('data-penerbit');
            editBukuModal.querySelector('.modal-title').textContent = 'Edit Buku: ' + button.getAttribute('data-nama');
        });

        // Edit Penerbit Modal
        const editPenerbitModal = document.getElementById('editPenerbitModal');
        editPenerbitModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const form = document.getElementById('editPenerbitForm');
            let url = "{{ route('penerbit.update', ':id') }}";
            url = url.replace(':id', id);
            form.action = url;

            form.querySelector('#edit_nama_penerbit').value = button.getAttribute('data-nama');
            form.querySelector('#edit_alamat').value = button.getAttribute('data-alamat');
            form.querySelector('#edit_kota').value = button.getAttribute('data-kota');
            form.querySelector('#edit_telepon').value = button.getAttribute('data-telepon');
            editPenerbitModal.querySelector('.modal-title').textContent = 'Edit Penerbit: ' + button.getAttribute('data-nama');
        });
    });
</script>
@endsection