<?php
// routes/web.php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;

// Halaman HOME (index.php)
Route::get('/', [BukuController::class, 'index'])->name('buku.index');

// Halaman Pengadaan (pengadaan.php)
Route::get('/pengadaan', [BukuController::class, 'pengadaan'])->name('buku.pengadaan');

// Rute ADMIN / CRUD (Resource Routing)
Route::get('/admin', [BukuController::class, 'admin'])->name('buku.admin'); // Dashboard utama

// Buku CRUD
Route::post('/admin', [BukuController::class, 'store'])->name('buku.store');
Route::put('/admin/{buku}', [BukuController::class, 'update'])->name('buku.update');
Route::delete('/admin/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');

// Penerbit CRUD
Route::post('/admin/penerbit', [PenerbitController::class, 'store'])->name('penerbit.store');
Route::put('/admin/penerbit/{penerbit}', [PenerbitController::class, 'update'])->name('penerbit.update');
Route::delete('/admin/penerbit/{penerbit}', [PenerbitController::class, 'destroy'])->name('penerbit.destroy');
