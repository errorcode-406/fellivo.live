<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Unit Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb / Header -->
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800">Edit Kamar: {{ $kamar->nama_kamar }}</h3>
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium flex items-center gap-1">
                   &larr; Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                <div class="p-8">
                    
                    <!-- BLOK NOTIFIKASI ERROR VALIDASI -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <strong class="text-sm font-medium text-red-800">Ada kesalahan dalam pengisian form:</strong>
                            </div>
                            <ul class="list-disc pl-7 text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Grid Layout untuk Form -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Kolom Kiri -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama/Nomor Kamar <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_kamar" value="{{ old('nama_kamar', $kamar->nama_kamar) }}" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 transition-colors" 
                                        placeholder="Misal: Kamar 101" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Bulan (Rp) <span class="text-red-500">*</span></label>
                                    <input type="number" name="harga_per_bulan" value="{{ old('harga_per_bulan', $kamar->harga_per_bulan) }}" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 transition-colors" 
                                        placeholder="Contoh: 1500000" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Kamar (Opsional)</label>
                                    <input type="text" name="luas_kamar" value="{{ old('luas_kamar', $kamar->luas_kamar) }}" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 transition-colors" 
                                        placeholder="Misal: 3x4 meter">
                                </div>
                            </div>

                            <!-- Kolom Kanan (Foto) -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kamar (Biarkan kosong jika tidak diganti)</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">
                                        <div class="space-y-1 text-center">
                                            @if($kamar->foto_kamar)
                                                <div class="mb-4 flex flex-col items-center">
                                                    <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" alt="Foto Lama" class="h-32 w-48 object-cover rounded-md shadow-sm border border-gray-200">
                                                    <p class="text-xs text-gray-500 mt-2">Foto saat ini</p>
                                                </div>
                                            @endif
                                            <div class="mt-3">
                                                <input type="file" name="foto_kamar" accept="image/*" class="block w-full text-sm text-gray-500
                                                    file:mr-4 file:py-2 file:px-4
                                                    file:rounded-md file:border-0
                                                    file:text-sm file:font-semibold
                                                    file:bg-blue-100 file:text-blue-700
                                                    hover:file:bg-blue-200 cursor-pointer
                                                ">
                                            </div>
                                            <p class="text-xs text-gray-400 mt-2">PNG, JPG, WEBP maksimal 2MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fasilitas Kamar -->
                        <div class="mt-6 border-t pt-6 border-gray-100">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Fasilitas Kamar (Opsional)</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @php 
                                    $fasilitasLama = is_array($kamar->fasilitas_kamar) ? $kamar->fasilitas_kamar : (json_decode($kamar->fasilitas_kamar, true) ?? []); 
                                @endphp
                                @foreach(['AC', 'WiFi Kamar', 'Kasur', 'Lemari Pakaian', 'Meja Belajar', 'Kamar Mandi Dalam', 'Water Heater', 'TV'] as $fasilitas)
                                <label class="flex items-center space-x-3 cursor-pointer bg-gray-50 px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                    <input type="checkbox" name="fasilitas_kamar[]" value="{{ $fasilitas }}" 
                                        {{ in_array($fasilitas, $fasilitasLama) ? 'checked' : '' }} 
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 h-4 w-4">
                                    <span class="text-sm text-gray-700 font-medium">{{ $fasilitas }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Area Tombol -->
                        <div class="pt-8 border-t border-gray-100 flex justify-end gap-3">
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                                Batal
                            </a>
                            <button type="submit" class="px-5 py-2.5 bg-blue-600 rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors shadow-md">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>