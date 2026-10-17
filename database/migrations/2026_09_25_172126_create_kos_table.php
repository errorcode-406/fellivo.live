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
        Schema::create('kos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pemilik_id')->constrained('users')->onDelete('cascade');
    $table->string('nama_kos');
    $table->enum('tipe_kos', ['putra', 'putri', 'campur']);
    $table->string('kota');
    $table->text('alamat_lengkap');
    $table->decimal('latitude', 10, 8)->nullable();
    $table->decimal('longitude', 11, 8)->nullable();
    $table->text('deskripsi')->nullable();
    $table->json('fasilitas_umum')->nullable();
    $table->text('aturan_kos')->nullable();
    $table->enum('status_verifikasi', ['pending', 'approved', 'rejected'])->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
