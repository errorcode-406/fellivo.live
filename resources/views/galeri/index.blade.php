<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Kelola Galeri Kamar</h2>
                        <!-- Menampilkan Nama Tipe Kamar & Nama Kos -->
                        <p class="text-blue-100 text-sm mt-1">Tipe: <strong>{{ $kamar->nama_tipe }}</strong> | Properti: {{ $kamar->kos->nama_kos }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        &larr; Kembali
                    </a>
                </div>

                <div class="p-8">
                    <!-- Ubah rute action ke kamar.id -->
                    <form action="{{ route('galeri.store', $kamar->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row items-end gap-4">
                        @csrf
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Foto (Maks 2MB)</label>
                            <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-xl cursor-pointer" required>
                        </div>
                        <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-all h-[46px]">
                            Upload Foto
                        </button>
                    </form>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-4">Koleksi Foto Kamar</h3>
            
            @if($galeri->isEmpty())
                <div class="bg-white p-12 rounded-2xl shadow-sm text-center border border-gray-100">
                    <p class="text-gray-500 text-lg mb-2">Belum ada foto yang diunggah untuk tipe kamar ini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($galeri as $foto)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden relative group">
                            @if($foto->is_cover)
                                <div class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10 shadow-md">
                                    Sampul Utama
                                </div>
                            @endif
                            <img src="{{ asset('storage/' . $foto->url_foto) }}" alt="Foto Kamar" class="w-full h-48 object-cover">
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>