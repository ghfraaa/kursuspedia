@extends('layouts.app')

@section('content')

<!-- Navbar -->
@include('layouts.navbar')

<!-- Hero Section with Course Image -->
<section class="relative py-12 px-8 bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="container mx-auto">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ url('/') }}#kursus" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Kursus</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $kursus->nama }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Main Content -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Course Image Header -->
                <div class="relative h-64 md:h-80 lg:h-96">
                    <img src="{{ asset('storage/kursus/' . $kursus->gambar) }}" alt="{{ $kursus->nama }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    
                    <!-- Status Badge -->
                    <div class="absolute top-6 right-6">
                        @php
                            $siswa_terdaftar = $kursus->siswa_terdaftar ?? 0;
                            $jumlah_siswa = $kursus->jumlah_siswa ?? 0;
                            $is_full = $siswa_terdaftar >= $jumlah_siswa;
                        @endphp
                        
                        @if($is_full)
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-red-100 border border-red-700 text-red-700 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Kelas Penuh
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-green-100 border border-green-700 text-green-700 shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Tersedia
                            </span>
                        @endif
                    </div>

                    <!-- Course Title Overlay -->
                    <div class="absolute bottom-6 left-6 right-6">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-2 leading-tight">
                            {{ $kursus->nama }}
                        </h1>
                        <div class="flex items-center text-white/90">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7.07 7.07a2.5 2.5 0 010 3.536l-2.5 2.5a2.5 2.5 0 01-3.536 0l-7.07-7.07A2.5 2.5 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="text-lg font-semibold">{{ $kursus->kategori ?? 'Umum' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Course Content -->
                <div class="p-8 md:p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            <!-- Description -->
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Deskripsi Kursus
                                </h2>
                                <p class="text-lg text-gray-700 leading-relaxed">{{ $kursus->deskripsi }}</p>
                            </div>

                            <!-- Course Details Grid -->
                            <div class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Detail Kursus
                                </h2>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6 rounded-2xl border border-indigo-100">
                                        <div class="flex items-center mb-3">
                                            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16L2 12l4-4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Metode Pembelajaran</h3>
                                                <p class="text-gray-700">{{ $kursus->metode ?? 'Online' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-2xl border border-green-100">
                                        <div class="flex items-center mb-3">
                                            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Lokasi</h3>
                                                <p class="text-gray-700">{{ $kursus->lokasi ?? 'Fleksibel' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-6 rounded-2xl border border-blue-100">
                                        <div class="flex items-center mb-3">
                                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Tanggal Mulai</h3>
                                                <p class="text-gray-700">{{ \Carbon\Carbon::parse($kursus->tanggal_mulai)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-2xl border border-purple-100">
                                        <div class="flex items-center mb-3">
                                            <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Tanggal Selesai</h3>
                                                <p class="text-gray-700">{{ \Carbon\Carbon::parse($kursus->tanggal_selesai)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Certificate Info -->
                            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-2xl border border-yellow-200">
                                <div class="flex items-center">
                                    @if($kursus->sertifikat ?? false)
                                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900">Sertifikat Tersedia</h3>
                                            <p class="text-gray-700">Dapatkan sertifikat setelah menyelesaikan kursus ini</p>
                                        </div>
                                    @else
                                        <div class="w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900">Tanpa Sertifikat</h3>
                                            <p class="text-gray-700">Kursus ini tidak menyediakan sertifikat</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Price Card -->
                            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white p-8 rounded-3xl shadow-2xl mb-8 transform hover:scale-105 transition-transform duration-300">
                                <div class="text-center">
                                    <div class="text-4xl font-black mb-2">
                                        IDR {{ number_format($kursus->harga ?? 0, 0, ',', '.') }}
                                    </div>
                                    <p class="text-indigo-100 mb-6">Harga kursus lengkap</p>
                                    
                                    @if($is_full)
                                        <button disabled class="w-full bg-gray-500 text-white px-8 py-4 rounded-2xl text-lg font-bold cursor-not-allowed transition-all duration-300">
                                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Kelas Penuh
                                        </button>
                                    @else
                                        <form action="{{ route('kursus.enroll', $kursus->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full bg-white text-indigo-600 px-8 py-4 rounded-2xl text-lg font-bold hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                                Gabung Sekarang
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <!-- Stats Card -->
                            <div class="bg-white border-2 border-gray-100 rounded-3xl p-8 shadow-xl">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Statistik Kursus
                                </h3>
                                
                                <div class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Siswa Terdaftar</span>
                                        <span class="text-2xl font-bold text-indigo-600">{{ $siswa_terdaftar }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Kapasitas Total</span>
                                        <span class="text-2xl font-bold text-gray-900">{{ $jumlah_siswa }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Sisa Kursi</span>
                                        <span class="text-2xl font-bold {{ $is_full ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $jumlah_siswa - $siswa_terdaftar }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mt-6">
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>Tingkat Okupansi</span>
                                        <span>{{ $jumlah_siswa > 0 ? round(($siswa_terdaftar / $jumlah_siswa) * 100) : 0 }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-3 rounded-full transition-all duration-500" 
                                             style="width: {{ $jumlah_siswa > 0 ? ($siswa_terdaftar / $jumlah_siswa) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection