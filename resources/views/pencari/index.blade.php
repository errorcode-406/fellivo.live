<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900">Cari Kos Idamanmu</h1>
                <p class="text-gray-600 mt-2">Temukan hunian nyaman dengan foto asli di setiap unit kamar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($listKos as $kos)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all">
                    <!-- Ambil foto kamar pertama sebagai sampul kos jika ada -->
                    @php
                        $coverKamar = $kos->kamars->first();
                    @endphp
                    
                    <div class="h-48 bg-gray-200 relative">
                        @if($coverKamar && $coverKamar->foto_kamar)
                            <img src="{{ asset('storage/' . $coverKamar->foto_kamar) }}" alt="{{ $kos->nama_kos }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 text-sm">Tidak ada foto</div>
                        @endif
                        <span class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            {{ ucfirst($kos->tipe_kos ?? 'Campur') }}
                        </span>
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $kos->nama_kos }}</h3>
                        <p class="text-sm text-gray-500 mb-4">📍 {{ $kos->kota }}</p>
                        <p class="text-xs text-gray-600 mb-4 line-clamp-2">{{ $kos->deskripsi }}</p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-xs text-gray-400 block">Mulai dari</span>
                                <span class="text-base font-bold text-blue-600">
                                    @if($kos->kamars->count() > 0)
                                        Rp {{ number_format($kos->kamars->min('harga_per_bulan'), 0, ',', '.') }}<span class="text-xs font-normal text-gray-500">/bln</span>
                                    @else
                                        Hubungi Pemilik
                                    @endif
                                </span>
                            </div>
                            <a href="{{ route('pencari.show', $kos->id) }}" class="bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white text-sm font-semibold px-4 py-2 rounded-xl transition-all">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    Belum ada properti kos yang terdaftar saat ini.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>