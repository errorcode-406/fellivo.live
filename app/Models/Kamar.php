<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    protected $fillable = [
        'kos_id',
        'nama_kamar',
        'harga_per_bulan',
        'luas_kamar',
        'fasilitas_kamar',
        'foto_kamar',
    ];

    protected $casts = [
        'fasilitas_kamar' => 'array',
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class, 'kos_id');
    }
}