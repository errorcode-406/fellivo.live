<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fellivo - Cari Kos Idamanmu</title>
    <!-- Memanggil Tailwind CSS dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Fellivo" class="h-12 w-auto">
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition shadow-sm">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Rekomendasi Kos untuk Kamu</h2>
            <p class="text-gray-500 mt-2">Temukan tempat tinggal yang nyaman dan sesuai *budget*.</p>
        </div>

        <!-- Grid untuk Card Kos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Looping data dari HomeController -->
            @forelse ($daftarKos as $kos)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                    
                    <!-- Area Gambar (Masih Dummy) -->
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 font-medium">Foto Kos (Segera Hadir)</span>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $kos->nama_kos }}</h3>
                                <p class="text-sm text-gray-500 mt-1 flex items-center">
                                    <!-- Ikon Pin Lokasi -->
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $kos->kota }}
                                </p>
                            </div>
                            <!-- Badge Tipe Kos -->
                            <span class="bg-blue-50 text-blue-700 border border-blue-200 text-xs font-bold px-3 py-1 rounded-full capitalize">
                                {{ $kos->tipe_kos }}
                            </span>
                        </div>

                        <!-- Harga -->
                        <div class="mt-5">
                            <p class="text-2xl font-extrabold text-blue-600">
                                @if($kos->kamar->count() > 0)
                                    Rp {{ number_format($kos->kamar->first()->harga_per_bulan, 0, ',', '.') }} 
                                    <span class="text-sm text-gray-500 font-normal">/ bln</span>
                                @else
                                    <span class="text-lg">Harga tidak tersedia</span>
                                @endif
                            </p>
                        </div>

                        <!-- Info Pemilik -->
                        <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <p class="text-sm text-gray-600">
                                Pemilik: <span class="font-semibold text-gray-900">{{ $kos->pemilik->name ?? 'Tidak diketahui' }}</span>
                            </p>
                            <button class="text-sm font-medium text-blue-600 hover:text-blue-800">Detail &rarr;</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
                    <p class="text-gray-500 text-lg font-medium">Belum ada data kos yang tersedia.</p>
                </div>
            @endforelse

        </div>
    </main>

</body>
</html>