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
        // Pakai 'transaksis' agar seragam dengan standar Laravel
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_invoice')->unique();
            $table->foreignId('pencari_id')->constrained('users')->onDelete('cascade');
            
            // Pastikan ini me-referensi ke tabel 'kamars' (pakai 's') 
            // jika lo ngikutin saran gue di tabel sebelumnya
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
            
            $table->date('tanggal_masuk');
            $table->integer('durasi_bulan');
            $table->integer('total_harga');
            
            // INI TAMBAHAN WAJIB KITA:
            $table->enum('metode_pembayaran', ['qris', 'va', 'transfer', 'cash'])->nullable();
            
            $table->enum('status_booking', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->enum('status_pembayaran', ['unpaid', 'menunggu_verifikasi', 'paid', 'cancelled'])->default('unpaid');
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};