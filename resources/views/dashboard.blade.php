<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- KHUSUS PEMILIK KOS -->
            @if(Auth::user()->role === 'pemilik')
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Properti Kos Saya</h3>
                    <a href="{{ route('kos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-md transition">
                        + Tambah Properti Baru
                    </a>
                </div>

                @if($kos_milik_user->isEmpty())
                    <div class="bg-white p-12 rounded-2xl shadow-sm text-center border border-gray-100">
                        <p class="text-gray-500 text-lg mb-4">Anda belum mendaftarkan properti kos satupun.</p>
                        <p class="text-sm text-gray-400">Klik tombol di atas untuk mulai menyewakan properti Anda.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @foreach($kos_milik_user as $k)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-xl font-bold text-gray-800 truncate">{{ $k->nama_kos }}</h4>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $k->status_verifikasi == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($k->status_verifikasi == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($k->status_verifikasi) }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mb-1 font-medium">{{ $k->kota }}</p>
                                    <p class="text-gray-500 text-sm mb-5 line-clamp-2">{{ $k->alamat_lengkap }}</p>
                                    
                                    <hr class="my-4 border-gray-100">
                                    
                                    <!-- LIST UNIT KAMAR FISIK & TOMBOL EDIT/HAPUS -->
                                    <h5 class="text-md font-bold text-gray-800 mb-3">Daftar Unit Kamar</h5>
                                    
                                    @if(isset($k->kamars) && $k->kamars->isEmpty())
                                        <div class="bg-gray-50 rounded-xl p-4 text-center border border-gray-100 mb-4">
                                            <p class="text-sm text-gray-500">Belum ada unit kamar. Tambahkan sekarang!</p>
                                        </div>
                                    @else
                                        <div class="flex flex-col gap-3 mb-4">
                                            @foreach($k->kamars as $kamar)
                                                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border border-gray-100">
                                                    
                                                    <div class="flex items-center gap-4">
                                                        <!-- Tampilkan foto kamar kecil -->
                                                        @if($kamar->foto_kamar)
                                                            <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" alt="{{ $kamar->nama_kamar }}" class="w-12 h-12 rounded object-cover">
                                                        @else
                                                            <div class="w-12 h-12 rounded bg-gray-200 flex items-center justify-center text-[10px] text-gray-400">No Pic</div>
                                                        @endif
                                                        
                                                        <div>
                                                            <!-- Sesuaikan nama kolom jadi nama_kamar -->
                                                            <p class="font-semibold text-gray-800 text-sm">{{ $kamar->nama_kamar }}</p>
                                                            <p class="text-xs text-gray-500">Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}/bln</p>
                                                        </div>
                                                    </div>

                                                    <!-- Tombol Edit & Hapus per Kamar -->
                                                    <div class="flex items-center gap-2">
                                                        <a href="{{ route('kamar.edit', $kamar->id) }}" class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-lg hover:bg-yellow-200 transition">
                                                            Edit
                                                        </a>
                                                        
                                                        <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kamar ini? Foto kamar juga akan terhapus secara permanen.');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 transition">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <!-- Tombol Tambah Kamar Baru -->
                                    <div class="flex flex-col gap-3 mt-2">
                                        <a href="{{ route('kamar.create', $k->id) }}" class="text-center w-full bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold py-2 px-4 rounded-lg border border-indigo-200 transition">
                                            + Tambah Unit Kamar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            <!-- KHUSUS PENCARI KOS -->
            @elseif(Auth::user()->role === 'pencari')
                <div class="space-y-6">
                    <!-- Banner Selamat Datang -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                            <p class="text-gray-600">Selamat datang di dashboard pencari kos. Yuk temukan hunian nyaman dengan foto asli hari ini.</p>
                        </div>
                        <a href="{{ route('pencari.index') }}" class="w-full md:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl shadow-md transition-all">
                            🔍 Cari Kos Sekarang
                        </a>
                    </div>

                    <!-- Grid Placeholder Fitur Selanjutnya -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kotak Status Pengajuan Sewa -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h4 class="text-lg font-bold text-gray-800">Status Pengajuan Sewa</h4>
                                <span class="bg-indigo-50 text-indigo-600 text-xs font-bold px-3 py-1 rounded-full border border-indigo-100">Segera Hadir</span>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-10 text-center border-2 border-dashed border-gray-200">
                                <div class="text-5xl mb-4">🏠</div>
                                <p class="text-gray-600 font-medium mb-1">Belum ada pengajuan sewa</p>
                                <p class="text-sm text-gray-400">Kamar yang kamu ajukan akan muncul dan dapat dipantau di sini.</p>
                            </div>
                        </div>

                        <!-- Kotak Favorit -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h4 class="text-lg font-bold text-gray-800">Kos Favorit Tersimpan</h4>
                                <span class="bg-pink-50 text-pink-600 text-xs font-bold px-3 py-1 rounded-full border border-pink-100">Segera Hadir</span>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-10 text-center border-2 border-dashed border-gray-200">
                                <div class="text-5xl mb-4">❤️</div>
                                <p class="text-gray-600 font-medium mb-1">Belum ada kos favorit</p>
                                <p class="text-sm text-gray-400">Simpan properti kos yang kamu suka untuk dilihat lagi nanti.</p>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- KHUSUS ADMIN -->
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                    <div class="p-8 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Dashboard Admin</h3>
                        <p class="text-gray-600">Selamat datang, Admin! Fitur kelola data sedang dikembangkan.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>