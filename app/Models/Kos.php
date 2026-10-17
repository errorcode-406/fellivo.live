<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    // Pastikan kolom-kolom lo udah ada di sini
    protected $fillable = [
        'pemilik_id', 'nama_kos', 'tipe_kos', 'kota', 'alamat_lengkap', 'deskripsi', 'aturan_kos', 'fasilitas_umum'
    ];

    // ... (kode lain kalau ada)

    // 👇 TAMBAHKAN RELASI INI 👇
    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'kos_id');
    }
}