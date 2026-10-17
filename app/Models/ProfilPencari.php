<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPencari extends Model
{
    protected $table = 'profil_pencari';
    protected $guarded = ['id'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}