<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;

class HomeController extends Controller
{
    public function index()
    {
        // Tarik semua data kos beserta data kamar dan pemiliknya dari database
        $daftarKos = Kos::with(['kamar', 'pemilik'])->latest()->get();
        
        // Kirim datanya ke halaman depan (welcome.blade.php)
        return view('welcome', compact('daftarKos'));
    }
}