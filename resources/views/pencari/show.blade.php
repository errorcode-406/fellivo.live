<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Kos -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $kos->nama_kos }}</h1>
                <p class="text-gray-600 mb-4">📍 {{ $kos->alamat_lengkap }}, {{ $kos->kota }}</p>
                <div class="text-gray-700 text-sm leading-relaxed mb-6">
                    {{ $kos->deskripsi }}
                </div>
                
                @if($kos->aturan_kos)
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-xs text-yellow-800">
                    <strong>Aturan Kos:</strong> {{ $kos->aturan_kos }}
                </div>
                @endif
            </div>

            <!-- Daftar Unit Kamar Fisik & Foto Spesifik -->
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Pilihan Unit Kamar Tersedia</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($kos->kamars as $kamar)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <!-- Foto Asli Kamar Fisik Tersebut -->
                    <div class="h-56 bg-gray-200 relative">
                        @if($kamar->foto_kamar)
                            <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" alt="{{ $kamar->nama_kamar }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 text-sm">Foto belum tersedia</div>
                        @endif
                        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-white text-xs font-semibold px-3 py-1.5 rounded-lg">
                            {{ $kamar->nama_kamar }}
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $kamar->nama_kamar }}</h3>
                                    <p class="text-xs text-gray-500">Luas: {{ $kamar->luas_kamar ?? 'Standar' }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-blue-600">Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-500 block">per bulan</span>
                                </div>
                            </div>

                            <!-- Fasilitas Kamar -->
                            @if(!empty($kamar->fasilitas_kamar))
                            <div class="mb-6">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Fasilitas Kamar:</span>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($kamar->fasilitas_kamar as $fasilitas)
                                        <span class="bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-lg">{{ $fasilitas }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Tombol Booking (Sementara berupa alert) -->
                        <button onclick="alert('Fitur sewa/booking akan segera hadir!')" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-xl transition-all text-center">
                            Ajukan Sewa Kamar Ini
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-2 bg-white rounded-2xl p-8 text-center text-gray-500 border border-gray-100">
                    Belum ada unit kamar fisik yang didaftarkan untuk kos ini.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>