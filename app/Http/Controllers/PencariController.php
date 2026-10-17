<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;

class PencariController extends Controller
{
    // Menampilkan daftar semua kos di halaman utama pencari
    public function index()
    {
        $listKos = Kos::with('kamars')->latest()->get();
        return view('pencari.index', compact('listKos'));
    }

    // Menampilkan detail kos beserta daftar kamar fisik dan foto-fotonya
    public function show($id)
    {
        $kos = Kos::with('kamars')->findOrFail($id);
        return view('pencari.show', compact('kos'));
    }
}