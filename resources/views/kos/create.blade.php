<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Properti Kos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('kos.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Nama Kos -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kos</label>
                                <input type="text" name="nama_kos" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Kos Mawar Indah" required>
                            </div>
                            
                            <!-- Tipe Kos -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kos</label>
                                <select name="tipe_kos" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="" disabled selected>Pilih Tipe</option>
                                    <option value="putra">Putra</option>
                                    <option value="putri">Putri</option>
                                    <option value="campur">Campur</option>
                                </select>
                            </div>

                            <!-- Kota -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kota</label>
                                <input type="text" name="kota" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Jakarta Selatan" required>
                            </div>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" rows="3" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..." required></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Properti</label>
                                <textarea name="deskripsi" rows="4" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Ceritakan keunggulan kos ini..."></textarea>
                            </div>

                            <!-- Aturan Kos -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Aturan Kos</label>
                                <textarea name="aturan_kos" rows="4" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Dilarang bawa hewan, jam malam pukul 23:00..."></textarea>
                            </div>
                        </div>

                        <!-- Fasilitas Umum -->
                        <div class="mb-8 border-t pt-6 border-gray-100">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Fasilitas Umum (Gratis untuk semua penyewa)</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach(['WiFi', 'Dapur Bersama', 'Parkir Motor', 'Parkir Mobil', 'Ruang Tamu', 'Kulkas Bersama', 'Mesin Cuci', 'CCTV'] as $fasilitas)
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="fasilitas_umum[]" value="{{ $fasilitas }}" class="rounded text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm text-gray-600">{{ $fasilitas }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end gap-4 border-t pt-6 border-gray-100">
                            <a href="{{ route('dashboard') }}" class="py-2.5 px-6 text-gray-600 hover:text-gray-900 font-medium">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-all">
                                Simpan Properti Kos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>