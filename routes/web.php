<?php
// routes/web.php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

// Halaman HOME (index.php lama)
Route::get('/', [BukuController::class, 'index']);

// Halaman Admin dan Pengadaan (Perlu ditambahkan setelah membuat metodenya di Controller)
// Route::get('/admin', [BukuController::class, 'admin']);
// Route::get('/pengadaan', [BukuController::class, 'pengadaan']);
