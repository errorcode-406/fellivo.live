<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\GaleriKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriKosController extends Controller
{
    // Menampilkan halaman kelola galeri khusus KAMAR
    public function index($kamar_id)
    {
        // Ambil data kamar beserta data kos-nya untuk dicek otorisasi
        $kamar = Kamar::with('kos')->findOrFail($kamar_id);

        if (Auth::user()->role !== 'admin' && $kamar->kos->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Cari galeri berdasarkan kamar_id
        $galeri = GaleriKos::where('kamar_id', $kamar_id)->get();
        
        return view('galeri.index', compact('kamar', 'galeri'));
    }

    // Proses upload dan simpan foto
    public function store(Request $request, $kamar_id)
    {
        $kamar = Kamar::with('kos')->findOrFail($kamar_id);

        if (Auth::user()->role !== 'admin' && $kamar->kos->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('foto')->store('galeri_kos', 'public');

        // Cek foto pertama
        $is_cover = GaleriKos::where('kamar_id', $kamar_id)->count() === 0 ? true : false;

        GaleriKos::create([
            'kamar_id' => $kamar_id,
            'url_foto' => $path,
            'is_cover' => $is_cover,
        ]);

        return back()->with('success', 'Mantap! Foto berhasil ditambahkan ke tipe kamar ini.');
    }
}