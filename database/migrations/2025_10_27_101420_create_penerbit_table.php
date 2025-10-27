<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('penerbit', function (Blueprint $table) {
        $table->char('id_penerbit', 5)->primary();
        $table->string('nama_penerbit', 100);
        $table->string('alamat', 200)->nullable();
        $table->string('kota', 100)->nullable();
        $table->string('telepon', 30)->nullable();
        // $table->timestamps(); // Tambahkan jika perlu
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbit');
    }
};
