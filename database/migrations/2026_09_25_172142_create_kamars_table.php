<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kos_id')->constrained('kos')->onDelete('cascade');
            
            // 1. Diganti jadi nama_kamar (karena per unit fisik)
            $table->string('nama_kamar'); 
            
            $table->integer('harga_per_bulan');
            
            // 2. stok_kamar DIHAPUS karena 1 row = 1 kamar fisik
            
            // 3. Kolom ukuran_kamar dipertahankan
            $table->string('ukuran_kamar')->nullable(); 
            
            $table->json('fasilitas_kamar')->nullable();
            
            // 4. INI YANG BARU: Kolom untuk menyimpan path foto
            $table->string('foto_kamar')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};