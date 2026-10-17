<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriKos extends Model
{
    // Beritahu Laravel nama tabel yang benar sesuai migration
    protected $table = 'galeri_kos';

    // Buka gembok agar bisa simpan data
    protected $guarded = ['id'];

    // Pastikan is_cover dibaca sebagai tipe data boolean (true/false)
    protected $casts = [
        'is_cover' => 'boolean',
    ];

    // Relasi balik ke model Kos
    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}