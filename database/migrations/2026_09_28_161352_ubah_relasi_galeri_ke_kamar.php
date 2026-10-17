<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri_kos', function (Blueprint $table) {
            // Hapus relasi lama
            $table->dropForeign(['kos_id']);
            $table->dropColumn('kos_id');
            
            // Tambahkan relasi baru ke kamar
            $table->foreignId('kamar_id')->after('id')->constrained('kamars')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('galeri_kos', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
            $table->dropColumn('kamar_id');
            $table->foreignId('kos_id')->constrained('kos')->onDelete('cascade');
        });
    }
};