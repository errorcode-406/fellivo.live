<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = ['id'];

    public function pencari() {
        return $this->belongsTo(User::class, 'pencari_id');
    }

    public function kamar() {
        return $this->belongsTo(Kamar::class);
    }
}