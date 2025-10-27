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
        Schema::create('buku', function (Blueprint $table) {
            // Kolom Primary Key
            $table->char('id_buku', 5)->primary();

            // Kolom Data
            $table->string('kategori', 50)->nullable();
            $table->string('nama_buku', 150)->notNull();
            $table->decimal('harga', 12, 2)->default(0.00);
            $table->integer('stok')->default(0);

            // Kolom Foreign Key ke tabel 'penerbit'
            $table->char('id_penerbit', 5);

            // Definisi Foreign Key
            $table->foreign('id_penerbit')
                  ->references('id_penerbit') // Mengacu pada kolom id_penerbit di tabel penerbit
                  ->on('penerbit') // Nama tabel yang diacu
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            // Jika Anda tidak memerlukan timestamps (created_at dan updated_at), Anda bisa menghapusnya.
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
