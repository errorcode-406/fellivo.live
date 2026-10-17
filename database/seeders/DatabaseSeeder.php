<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProfilPemilik;
use App\Models\Kos;
use App\Models\Kamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 0. Buat Akun Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@fellivo.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        
        // 1. Buat Akun Pemilik
        $pemilik = User::create([
            'name' => 'Bapak Kos',
            'email' => 'pemilik@fellivo.com',
            'password' => Hash::make('password123'),
            'role' => 'pemilik',
        ]);

        ProfilPemilik::create([
            'user_id' => $pemilik->id,
            'nama_lengkap' => 'Bapak Kos Baik Hati',
            'no_hp' => '081234567890',
        ]);

        // 2. Buat Data Kos
        $kos = Kos::create([
            'pemilik_id' => $pemilik->id,
            'nama_kos' => 'Kos Fellivo Sejahtera',
            'tipe_kos' => 'campur',
            'kota' => 'Jakarta Selatan',
            'alamat_lengkap' => 'Jl. Kebahagiaan No. 1, Jakarta Selatan',
            'deskripsi' => 'Kos nyaman, aman, dan dekat dengan kampus.',
            'fasilitas_umum' => ['WiFi', 'Dapur Bersama', 'Parkir Motor', 'CCTV'],
            'status_verifikasi' => 'approved',
        ]);

        // 3. Buat Data Kamar
        Kamar::create([
            'kos_id' => $kos->id,
            'nama_tipe' => 'Kamar Standar AC',
            'harga_per_bulan' => 1500000,
            'stok_kamar' => 5,
            'ukuran_kamar' => '3x4',
            'fasilitas_kamar' => ['AC', 'Kasur Springbed', 'Lemari Pakaian', 'Kamar Mandi Dalam'],
        ]);
    }
}