<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    // Menampilkan form tambah kos
    public function create()
    {
        // Gembok lapis dua: Izinkan pemilik dan admin
        if (!in_array(Auth::user()->role, ['pemilik', 'admin'])) {
            abort(403, 'Akses ditolak. Hanya Pemilik Kos dan Admin yang bisa mengakses halaman ini.');
        }
        
        return view('kos.create');
    }

    // Menyimpan data kos ke database
    public function store(Request $request)
    {
        // Pastikan gembok yang sama dipasang saat data dikirim
        if (!in_array(Auth::user()->role, ['pemilik', 'admin'])) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'tipe_kos' => 'required|in:putra,putri,campur',
            'kota' => 'required|string|max:100', // Tambahan validasi kota
            'alamat_lengkap' => 'required|string', // Sesuai dengan database
            'deskripsi' => 'nullable|string',
            'aturan_kos' => 'nullable|string',
            'fasilitas_umum' => 'nullable|array',
        ]);

        Kos::create([
            'pemilik_id' => Auth::id(), // Sesuai dengan database
            'nama_kos' => $request->nama_kos,
            'tipe_kos' => $request->tipe_kos,
            'kota' => $request->kota,
            'alamat_lengkap' => $request->alamat_lengkap,
            'deskripsi' => $request->deskripsi,
            'aturan_kos' => $request->aturan_kos,
            'fasilitas_umum' => $request->fasilitas_umum ?? [], 
            'status_verifikasi' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Mantap! Data Kos berhasil didaftarkan dan sedang menunggu verifikasi Admin.');
    }
}