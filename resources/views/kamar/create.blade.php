<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Unit Kamar Baru') }} - {{ $kos->nama_kos }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('kamar.store', $kos->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Nama / Nomor Kamar -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama / Nomor Kamar</label>
                                <input type="text" name="nama_kamar" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Kamar VIP 01 / Kamar 102" required>
                            </div>
                            
                            <!-- Harga per Bulan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga per Bulan (Rp)</label>
                                <input type="number" name="harga_per_bulan" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 1500000" required>
                            </div>

                            <!-- Luas Kamar -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Luas Kamar (Opsional)</label>
                                <input type="text" name="luas_kamar" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 3x4 meter">
                            </div>
                        </div>

                        <!-- Upload Foto Kamar Fisik Ini -->
                        <div class="mb-6 border-t pt-6 border-gray-100">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kamar Ini (Wajib, Maks 2MB)</label>
                            <input type="file" name="foto_kamar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-xl cursor-pointer" required>
                            <p class="text-xs text-gray-400 mt-1">Foto ini khusus merepresentasikan kamar fisik tersebut.</p>
                        </div>

                        <!-- Fasilitas Kamar -->
                        <div class="mb-8 border-t pt-6 border-gray-100">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Fasilitas Kamar</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach(['AC', 'WiFi Kamar', 'Kasur', 'Lemari Pakaian', 'Meja Belajar', 'Kamar Mandi Dalam', 'Water Heater', 'TV'] as $fasilitas)
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="fasilitas_kamar[]" value="{{ $fasilitas }}" class="rounded text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm text-gray-600">{{ $fasilitas }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end gap-4 border-t pt-6 border-gray-100">
                            <a href="{{ route('dashboard') }}" class="py-2.5 px-6 text-gray-600 hover:text-gray-900 font-medium">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-all">
                                Simpan Kamar & Foto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>