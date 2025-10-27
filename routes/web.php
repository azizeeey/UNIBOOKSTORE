<?php
// routes/web.php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

// Halaman HOME (index.php lama)
Route::get('/', [BukuController::class, 'index'])->name('buku.index');

// Halaman Pengadaan (pengadaan.php lama)
Route::get('/pengadaan', [BukuController::class, 'pengadaan'])->name('buku.pengadaan');

// Rute ADMIN / CRUD (Resource Routing)
// Note: Kita menggunakan metode get/post custom karena PK adalah string
Route::get('/admin', [BukuController::class, 'admin'])->name('buku.admin'); // Dashboard utama

// CREATE
Route::get('/admin/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/admin', [BukuController::class, 'store'])->name('buku.store');

// UPDATE
// {buku} adalah parameter yang akan digunakan Eloquent (Buku $buku)
Route::get('/admin/{buku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/admin/{buku}', [BukuController::class, 'update'])->name('buku.update');

// DELETE
Route::delete('/admin/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');

// PENERBIT CRUD
Route::post('/admin/penerbit', [PenerbitController::class, 'store'])->name('penerbit.store');
Route::get('/admin/penerbit/{penerbit}/edit', [PenerbitController::class, 'edit'])->name('penerbit.edit');
Route::put('/admin/penerbit/{penerbit}', [PenerbitController::class, 'update'])->name('penerbit.update');
Route::delete('/admin/penerbit/{penerbit}', [PenerbitController::class, 'destroy'])->name('penerbit.destroy');
