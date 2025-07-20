@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-white">Detail Kursus</h1>
        <p class="text-blue-100 mt-1">Informasi lengkap kursus {{ $kursus->nama }}</p>
    </div>
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.kursus.edit', $kursus) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-yellow-600 transition-colors">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
        </a>
        <a href="{{ route('admin.kursus.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Kursus Information Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Header dengan gambar -->
                @if($kursus->gambar)
                <div class="relative h-64 bg-gray-200">
                    <img src="{{ asset('storage/kursus/' . $kursus->gambar) }}" alt="{{ $kursus->nama }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        @php
                            $now = now();
                            $start = \Carbon\Carbon::parse($kursus->tanggal_mulai);
                            $end = \Carbon\Carbon::parse($kursus->tanggal_selesai);
                        @endphp
                        
                        @if($now < $start)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                Akan Datang
                            </span>
                        @elseif($now >= $start && $now <= $end)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Selesai
                            </span>
                        @endif
                    </div>
                </div>
                @endif

                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $kursus->nama }}</h2>
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $kursus->kategori }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                    </svg>
                                    {{ ucfirst($kursus->metode) }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $kursus->lokasi }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-blue-600">Rp {{ number_format($kursus->harga, 0, ',', '.') }}</div>
                            <div class="text-sm text-gray-500">per siswa</div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Kursus</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $kursus->deskripsi }}</p>
                    </div>
                </div>
            </div>

            <!-- Jadwal & Detail -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Jadwal</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <div class="flex items-center text-gray-900">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ \Carbon\Carbon::parse($kursus->tanggal_mulai)->format('d F Y') }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <div class="flex items-center text-gray-900">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ \Carbon\Carbon::parse($kursus->tanggal_selesai)->format('d F Y') }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Durasi Kursus</label>
                        <div class="flex items-center text-gray-900">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ \Carbon\Carbon::parse($kursus->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($kursus->tanggal_selesai)) + 1 }} hari
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sertifikat</label>
                        <div class="flex items-center text-gray-900">
                            @if($kursus->sertifikat)
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Ya, Dengan Sertifikat
                            @else
                                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tidak Ada Sertifikat
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Pendaftaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Pendaftaran</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Siswa Terdaftar</span>
                        <span class="text-sm font-bold text-gray-900">{{ $kursus->siswa_terdaftar }} / {{ $kursus->jumlah_siswa }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $kursus->jumlah_siswa > 0 ? ($kursus->siswa_terdaftar / $kursus->jumlah_siswa) * 100 : 0 }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-600">
                        <span>{{ $kursus->jumlah_siswa > 0 ? round(($kursus->siswa_terdaftar / $kursus->jumlah_siswa) * 100, 1) : 0 }}% terisi</span>
                        <span>Sisa {{ $kursus->jumlah_siswa - $kursus->siswa_terdaftar }} slot</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.kursus.edit', $kursus) }}" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Kursus
                    </a>
                    <a href="#daftar_siswa" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Lihat Siswa
                    </a>
                    <form action="{{ route('admin.kursus.destroy', $kursus) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kursus ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Kursus
                        </button>
                    </form>
                </div>
            </div>

            <!-- Ringkasan Kursus -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Total Pendapatan</span>
                        <span class="text-sm font-medium text-gray-900">Rp {{ number_format($kursus->harga * $kursus->siswa_terdaftar, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Dibuat</span>
                        <span class="text-sm font-medium text-gray-900">{{ $kursus->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Terakhir Update</span>
                        <span class="text-sm font-medium text-gray-900">{{ $kursus->updated_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm text-gray-600">ID Kursus</span>
                        <span class="text-sm font-medium text-gray-900">#{{ $kursus->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Kursus</h3>
                <div class="text-center">
                    @php
                        $now = now();
                        $start = \Carbon\Carbon::parse($kursus->tanggal_mulai);
                        $end = \Carbon\Carbon::parse($kursus->tanggal_selesai);
                    @endphp
                    
                    @if($now < $start)
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-lg font-medium text-gray-900">Akan Datang</p>
                        <p class="text-sm text-gray-600">Dimulai {{ $start->diffForHumans() }}</p>
                    @elseif($now >= $start && $now <= $end)
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-lg font-medium text-gray-900">Sedang Berlangsung</p>
                        <p class="text-sm text-gray-600">Berakhir {{ $end->diffForHumans() }}</p>
                    @else
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-lg font-medium text-gray-900">Selesai</p>
                        <p class="text-sm text-gray-600">Berakhir {{ $end->diffForHumans() }}</p>
                    @endif
                </div>
            </div>
            <div id="daftar_siswa" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Peserta Terdaftar</h3>
                @if($siswa_terdaftar->isEmpty())
                    <p class="text-sm text-gray-600 text-center">Belum ada peserta yang mendaftar.</p>
                @else
                    <ul class="divide-y divide-gray-100">
                        @foreach($siswa_terdaftar as $siswa)
                            <li class="py-2 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-semibold uppercase">
                                        {{ strtoupper(substr($siswa->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $siswa->name }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $siswa->email }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection