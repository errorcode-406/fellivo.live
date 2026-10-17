<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    public function create($kos_id)
    {
        $kos = Kos::findOrFail($kos_id);

        if (Auth::user()->role !== 'admin' && $kos->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('kamar.create', compact('kos'));
    }

    public function store(Request $request, $kos_id)
    {
        $kos = Kos::findOrFail($kos_id);

        if (Auth::user()->role !== 'admin' && $kos->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'harga_per_bulan' => 'required|numeric|min:0',
            'luas_kamar' => 'nullable|string',
            'fasilitas_kamar' => 'nullable|array',
            'foto_kamar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_kamar')) {
            $fotoPath = $request->file('foto_kamar')->store('foto_kamar', 'public');
        }

        Kamar::create([
            'kos_id' => $kos_id,
            'nama_kamar' => $request->nama_kamar,
            'harga_per_bulan' => $request->harga_per_bulan,
            'luas_kamar' => $request->luas_kamar,
            'fasilitas_kamar' => $request->fasilitas_kamar ?? [],
            'foto_kamar' => $fotoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Kamar fisik beserta fotonya berhasil ditambahkan!');
    }

    // --- TAMBAHKAN METHOD EDIT DI SINI ---
    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kos = Kos::findOrFail($kamar->kos_id);

        // Proteksi hak akses
        if (Auth::user()->role !== 'admin' && $kos->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('kamar.edit', compact('kamar', 'kos'));
    }

    // --- TAMBAHKAN METHOD UPDATE DI SINI ---
    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);
        $kos = Kos::findOrFail($kamar->kos_id);

        if (Auth::user()->role !== 'admin' && $kos->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'harga_per_bulan' => 'required|numeric|min:0',
            'luas_kamar' => 'nullable|string',
            'fasilitas_kamar' => 'nullable|array',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Nullable karena foto tidak wajib diganti saat edit
        ]);

        $fotoPath = $kamar->foto_kamar;
        
        // Cek jika ada upload foto baru
        if ($request->hasFile('foto_kamar')) {
            // Hapus foto lama jika ada
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto_kamar')->store('foto_kamar', 'public');
        }

        $kamar->update([
            'nama_kamar' => $request->nama_kamar,
            'harga_per_bulan' => $request->harga_per_bulan,
            'luas_kamar' => $request->luas_kamar,
            'fasilitas_kamar' => $request->fasilitas_kamar ?? [],
            'foto_kamar' => $fotoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data kamar berhasil diperbarui!');
    }
}