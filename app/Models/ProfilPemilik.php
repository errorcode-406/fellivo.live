<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPemilik extends Model
{
    protected $table = 'profil_pemilik'; // Kasih tahu nama tabel aslinya
    protected $guarded = ['id'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}