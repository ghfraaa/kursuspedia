@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Tambah Kursus Baru</h1>
            <p class="text-blue-100 mt-1">Buat kursus baru untuk siswa</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.kursus.index') }}"
                class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Informasi Kursus</h3>
                <p class="text-sm text-gray-600 mt-1">Lengkapi form berikut untuk menambahkan kursus baru</p>
            </div>

            <form action="{{ route('admin.kursus.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Kursus -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kursus *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan nama kursus">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                        <select name="kategori" id="kategori"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kategori') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="Programming" {{ old('kategori') == 'Programming' ? 'selected' : '' }}>Programming</option>
                            <option value="Marketing" {{ old('kategori') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Language" {{ old('kategori') == 'Language' ? 'selected' : '' }}>Language</option>
                            <option value="Design" {{ old('kategori') == 'Design' ? 'selected' : '' }}>Design</option>                          
                            <option value="Office" {{ old('kategori') == 'Office' ? 'selected' : '' }}>Office</option>
                            <option value="Photography" {{ old('kategori') == 'Photography' ? 'selected' : '' }}>Photography</option>
                            <option value="Finance" {{ old('kategori') == 'Finance' ? 'selected' : '' }}>Finance</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Metode -->
                    <div>
                        <label for="metode" class="block text-sm font-medium text-gray-700 mb-2">Metode Pembelajaran
                            *</label>
                        <select name="metode" id="metode"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('metode') border-red-500 @enderror">
                            <option value="">Pilih Metode</option>
                            <option value="online" {{ old('metode') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ old('metode') == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid" {{ old('metode') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('metode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('lokasi') border-red-500 @enderror"
                            placeholder="Masukkan lokasi kursus">
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" name="harga" id="harga" value="{{ old('harga') }}"
                                class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('harga') border-red-500 @enderror"
                                placeholder="0" min="0">
                        </div>
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai
                            *</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_mulai') border-red-500 @enderror">
                        @error('tanggal_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai
                            *</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_selesai') border-red-500 @enderror">
                        @error('tanggal_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Siswa -->
                    <div>
                        <label for="jumlah_siswa" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Siswa Maksimal
                            *</label>
                        <input type="number" name="jumlah_siswa" id="jumlah_siswa" value="{{ old('jumlah_siswa') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jumlah_siswa') border-red-500 @enderror"
                            placeholder="Maksimal siswa" min="1">
                        @error('jumlah_siswa')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sertifikat -->
                    <div>
                        <label for="sertifikat" class="block text-sm font-medium text-gray-700 mb-2">Sertifikat *</label>
                        <select name="sertifikat" id="sertifikat"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sertifikat') border-red-500 @enderror">
                            <option value="">Pilih Opsi</option>
                            <option value="1" {{ old('sertifikat') == '1' ? 'selected' : '' }}>Ya, Dengan Sertifikat</option>
                            <option value="0" {{ old('sertifikat') == '0' ? 'selected' : '' }}>Tidak Ada Sertifikat</option>
                        </select>
                        @error('sertifikat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="md:col-span-2">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar Kursus</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="gambar"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span>
                                        atau drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG atau GIF (MAX. 5MB)</p>
                                </div>
                                <input id="gambar" name="gambar" type="file" class="hidden" accept="image/*"
                                    onchange="previewImage(event)">
                            </label>
                        </div>
                        <div id="imagePreview" class="mt-4 hidden">
                            <img id="preview" class="w-full h-48 object-cover rounded-lg" alt="Preview">
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Kursus
                            *</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror"
                            placeholder="Masukkan deskripsi lengkap kursus...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.kursus.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    const imagePreview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection