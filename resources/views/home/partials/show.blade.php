@extends('layouts.app')

@section('content')

<!-- Navbar -->
@include('layouts.navbar')

<!-- Hero Section with Course Image -->
<section class="relative mt-10 py-12 px-8 bg-white">
    <div class="container mx-auto">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
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
            <div class="bg-white rounded-3xl shadow-md overflow-hidden">
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
                            use App\Models\Transaction;
                            
                            // PERBAIKAN: Untuk tombol "Sudah Bergabung", cek semua status kecuali 'ditolak'
                            $sudah_terdaftar_button = Transaction::where('user_id', auth()->id())
                                ->where('kursus_id', $kursus->id)
                                ->whereIn('status', ['pending', 'diterima']) // Hanya pending dan diterima untuk tombol
                                ->exists();
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
                <div class="p-3 md:p-8 lg:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <div class="lg:col-span-2">
                            <div class="mb-6">
                                <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 flex items-center"> {{-- text-lg for mobile, md:text-xl for larger screens --}}
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Deskripsi Kursus
                                </h2>
                                <p class="text-sm md:text-base text-gray-700 leading-relaxed">{{ $kursus->deskripsi }}</p> {{-- text-sm for mobile, md:text-base for larger screens --}}
                            </div>

                            <div class="mb-6">
                                <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center"> {{-- text-lg for mobile, md:text-xl for larger screens --}}
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Detail Kursus
                                </h2>

                                <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-100">
                                    <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16L2 12l4-4"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900 text-sm md:text-base">Metode Pembelajaran</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                        </div>
                                        <span class="text-gray-600 text-xs md:text-sm">{{ $kursus->metode ?? 'Online' }}</span> {{-- text-xs for mobile, md:text-sm for larger screens --}}
                                    </div>

                                    <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900 text-sm md:text-base">Lokasi</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                        </div>
                                        <span class="text-gray-600 text-xs md:text-sm">{{ $kursus->lokasi ?? 'Fleksibel' }}</span> {{-- text-xs for mobile, md:text-sm for larger screens --}}
                                    </div>

                                    <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900 text-sm md:text-base">Periode Kursus</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                        </div>
                                        <div class="text-right">
                                            <div class="text-gray-600 text-xs md:text-sm">{{ \Carbon\Carbon::parse($kursus->tanggal_mulai)->format('d M Y') }}</div> {{-- text-xs for mobile, md:text-sm for larger screens --}}
                                            <div class="text-gray-500 text-xxs md:text-xs">s/d {{ \Carbon\Carbon::parse($kursus->tanggal_selesai)->format('d M Y') }}</div> {{-- text-xxs for mobile, md:text-xs for larger screens --}}
                                        </div>
                                    </div>

                                    <div class="p-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            @if($kursus->sertifikat ?? false)
                                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <span class="font-medium text-gray-900 text-sm md:text-base">Sertifikat</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                            @else
                                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </div>
                                                <span class="font-medium text-gray-900 text-sm md:text-base">Sertifikat</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                            @endif
                                        </div>
                                        <div class="flex items-center">
                                            @if($kursus->sertifikat ?? false)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xxs md:text-xs font-medium bg-green-100 text-green-800"> {{-- text-xxs for mobile, md:text-xs for larger screens --}}
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Tersedia
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xxs md:text-xs font-medium bg-gray-100 text-gray-800"> {{-- text-xxs for mobile, md:text-xs for larger screens --}}
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Tidak Tersedia
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white p-6 md:p-8 rounded-3xl shadow-xl mb-8 transform hover:scale-105 transition-transform duration-300"> {{-- Reduced padding for mobile --}}
                                <div class="text-center">
                                    <div class="text-3xl md:text-4xl font-black mb-2"> {{-- text-3xl for mobile, md:text-4xl for larger screens --}}
                                        IDR {{ number_format($kursus->harga ?? 0, 0, ',', '.') }}
                                    </div>
                                    <p class="text-xs md:text-sm text-indigo-100 mb-6">Harga kursus lengkap</p> {{-- text-xs for mobile, md:text-sm for larger screens --}}

                                    @if($sudah_terdaftar_button)
                                        <button disabled class="w-full bg-gray-500 text-white px-3 py-3 md:px-4 md:py-4 rounded-2xl text-sm md:text-md font-bold cursor-not-allowed transition-all duration-300"> {{-- Reduced padding and text size for mobile --}}
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> {{-- Adjusted SVG size --}}
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Sudah Bergabung
                                        </button>
                                    @elseif ($is_full)
                                        <button disabled class="w-full bg-gray-500 text-white px-3 py-3 md:px-4 md:py-4 rounded-2xl text-sm md:text-md font-bold cursor-not-allowed transition-all duration-300"> {{-- Reduced padding and text size for mobile --}}
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> {{-- Adjusted SVG size --}}
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Kelas Penuh
                                        </button>
                                    @else
                                        <button onclick="openPaymentModal()" type="button" class="w-full bg-white text-indigo-600 px-3 py-3 md:px-4 md:py-4 rounded-2xl text-sm md:text-md font-bold hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105 shadow-lg"> {{-- Reduced padding and text size for mobile --}}
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> {{-- Adjusted SVG size --}}
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Gabung Sekarang
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-white border-2 border-gray-100 rounded-3xl p-6 md:p-8 shadow-md"> {{-- Reduced padding for mobile --}}
                                <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center"> {{-- text-lg for mobile, md:text-xl for larger screens, adjusted mb --}}
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> {{-- Adjusted SVG size --}}
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Statistik Kursus
                                </h3>

                                <div class="space-y-4 md:space-y-6"> {{-- Adjusted space-y for mobile --}}
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm md:text-base text-gray-600">Siswa Terdaftar</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                        <span class="text-xl md:text-2xl font-bold text-indigo-600">{{ $siswa_terdaftar }}</span> {{-- text-xl for mobile, md:text-2xl for larger screens --}}
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-sm md:text-base text-gray-600">Kapasitas Total</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                        <span class="text-xl md:text-2xl font-bold text-gray-900">{{ $jumlah_siswa }}</span> {{-- text-xl for mobile, md:text-2xl for larger screens --}}
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-sm md:text-base text-gray-600">Sisa Kursi</span> {{-- text-sm for mobile, md:text-base for larger screens --}}
                                        <span class="text-xl md:text-2xl font-bold {{ $is_full ? 'text-red-600' : 'text-green-600' }}"> {{-- text-xl for mobile, md:text-2xl for larger screens --}}
                                            {{ $jumlah_siswa - $siswa_terdaftar }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-4 md:mt-6"> {{-- Adjusted margin-top for mobile --}}
                                    <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-1 md:mb-2"> {{-- text-xs for mobile, md:text-sm for larger screens --}}
                                        <span>Tingkat Okupansi</span>
                                        <span>{{ $jumlah_siswa > 0 ? round(($siswa_terdaftar / $jumlah_siswa) * 100) : 0 }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 md:h-3"> {{-- Adjusted height for mobile --}}
                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2 md:h-3 rounded-full transition-all duration-500" {{-- Adjusted height for mobile --}}
                                            style="width: {{ $jumlah_siswa > 0 ? ($siswa_terdaftar / $jumlah_siswa) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Payment -->
                        <div id="paymentModal" class="fixed inset-0 z-50 hidden overflow-y-auto modal-overlay">
                            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <div id="modalContent" class="inline-block align-bottom bg-white rounded-2xl md:rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-enter"> {{-- Smaller rounded for mobile --}}
                                    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-4 py-3 md:px-6 md:py-4"> {{-- Reduced padding for mobile --}}
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg md:text-xl font-bold text-white flex items-center"> {{-- text-lg for mobile, md:text-xl for larger screens --}}
                                                <svg class="w-5 h-5 mr-2 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Smaller SVG for mobile --}}
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                </svg>
                                                Informasi Pembayaran
                                            </h3>
                                            <button onclick="closePaymentModal()" class="text-white hover:text-gray-200 transition-colors">
                                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Smaller SVG for mobile --}}
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="px-4 py-4 md:px-6 md:py-6"> {{-- Reduced padding for mobile --}}
                                        <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-400 p-3 md:p-4 rounded-lg mb-4 md:mb-6"> {{-- Reduced padding and margin for mobile --}}
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-green-600 mr-2 md:w-6 md:h-6 md:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Smaller SVG for mobile --}}
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-xs md:text-sm text-green-800 font-medium">Total Pembayaran</p> {{-- text-xs for mobile, md:text-sm for larger screens --}}
                                                    <p class="text-xl md:text-2xl font-bold text-green-900">IDR {{ number_format($kursus->harga ?? 0, 0, ',', '.') }}</p> {{-- text-xl for mobile, md:text-2xl for larger screens --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-3 md:space-y-4"> {{-- Reduced space-y for mobile --}}
                                            <h4 class="text-base md:text-lg font-semibold text-gray-900 flex items-center"> {{-- text-base for mobile, md:text-lg for larger screens --}}
                                                <svg class="w-4 h-4 mr-2 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Smaller SVG for mobile --}}
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                Transfer ke Rekening Bank
                                            </h4>

                                            <div class="bg-gray-50 p-3 md:p-4 rounded-lg md:rounded-xl border border-gray-200"> {{-- Reduced padding and rounded for mobile --}}
                                                <div class="space-y-2 md:space-y-3"> {{-- Reduced space-y for mobile --}}
                                                    <div class="flex justify-between">
                                                        <span class="text-sm text-gray-600 font-medium">Bank:</span> {{-- text-sm for mobile --}}
                                                        <span class="text-sm text-gray-900 font-semibold">Bank Central Asia (BCA)</span> {{-- text-sm for mobile --}}
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-sm text-gray-600 font-medium">No. Rekening:</span> {{-- text-sm for mobile --}}
                                                        <span class="text-sm text-gray-900 font-semibold font-mono">1234567890</span> {{-- text-sm for mobile --}}
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-sm text-gray-600 font-medium">Atas Nama:</span> {{-- text-sm for mobile --}}
                                                        <span class="text-sm text-gray-900 font-semibold">PT. KursusPedia Indonesia</span> {{-- text-sm for mobile --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bg-gray-50 p-3 md:p-4 rounded-lg md:rounded-xl border border-gray-200"> {{-- Reduced padding and rounded for mobile --}}
                                                <div class="space-y-2 md:space-y-3"> {{-- Reduced space-y for mobile --}}
                                                    <div class="flex justify-between">
                                                        <span class="text-sm text-gray-600 font-medium">Bank:</span> {{-- text-sm for mobile --}}
                                                        <span class="text-sm text-gray-900 font-semibold">Bank Mandiri</span> {{-- text-sm for mobile --}}
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-sm text-gray-600 font-medium">No. Rekening:</span> {{-- text-sm for mobile --}}
                                                        <span class="text-sm text-gray-900 font-semibold font-mono">0987654321</span> {{-- text-sm for mobile --}}
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-sm text-gray-600 font-medium">Atas Nama:</span> {{-- text-sm for mobile --}}
                                                        <span class="text-sm text-gray-900 font-semibold">PT. KursusPedia Indonesia</span> {{-- text-sm for mobile --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 md:mt-6 bg-blue-50 border border-blue-200 rounded-lg md:rounded-xl p-3 md:p-4"> {{-- Reduced padding and margin, rounded for mobile --}}
                                            <div class="flex items-start">
                                                <svg class="w-4 h-4 text-blue-900 mt-0.5 mr-2 md:w-5 md:h-5 md:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Smaller SVG for mobile --}}
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-blue-800 font-medium">Instruksi Pembayaran</p> {{-- text-sm for mobile --}}
                                                    <p class="text-xs text-blue-800"><span class="text-blue-800">•</span> Transfer sesuai dengan jumlah yang tertera</p> {{-- text-xs for mobile --}}
                                                    <p class="text-xs text-blue-800"><span class="text-blue-800">•</span> Simpan bukti transfer sebagai konfirmasi</p> {{-- text-xs for mobile --}}
                                                    <p class="text-xs text-blue-800"><span class="text-blue-800">•</span> Pembayaran akan diverifikasi dalam 1x24 jam</p> {{-- text-xs for mobile --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 md:mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-3 md:p-4 rounded-lg"> {{-- Reduced padding and margin for mobile --}}
                                            <div class="flex items-start">
                                                <svg class="w-4 h-4 text-yellow-600 mt-0.5 mr-2 md:w-5 md:h-5 md:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"> {{-- Smaller SVG for mobile --}}
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-yellow-800 font-medium">Penting!</p> {{-- text-sm for mobile --}}
                                                    <p class="text-xs text-yellow-800">Setelah melakukan pembayaran, kirim bukti pembayaran di halaman dashboard anda dan tunggu konfirmasi admin. Status pendaftaran akan diperbarui setelah pembayaran terverifikasi.</p> {{-- text-xs for mobile --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 md:px-6 md:py-4 flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3"> {{-- Reduced padding for mobile --}}
                                        <button onclick="closePaymentModal()" type="button" class="w-full sm:w-auto px-4 py-2 md:px-6 md:py-3 bg-gray-300 text-gray-700 rounded-lg md:rounded-xl font-medium hover:bg-gray-400 transition-all duration-300 flex items-center justify-center text-sm md:text-base"> {{-- Reduced padding, rounded, and text size for mobile --}}
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Batal
                                        </button>
                                        <form action="{{ route('kursus.enroll', $kursus->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full sm:w-auto px-4 py-2 md:px-6 md:py-3 bg-gradient-to-r from-indigo-600 to-purple-700 text-white rounded-lg md:rounded-xl font-medium hover:from-indigo-700 hover:to-purple-800 transition-all duration-300 transform hover:scale-105 flex items-center justify-center shadow-lg text-sm md:text-base"> {{-- Reduced padding, rounded, and text size for mobile --}}
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Saya Sudah Transfer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function openPaymentModal() {
                                const modal = document.getElementById('paymentModal');
                                const modalContent = document.getElementById('modalContent');
                                
                                modal.classList.remove('hidden');
                                
                                // Add entrance animation
                                setTimeout(() => {
                                    modalContent.classList.remove('modal-enter');
                                    modalContent.classList.add('modal-enter-active');
                                }, 10);
                            }

                            function closePaymentModal() {
                                const modal = document.getElementById('paymentModal');
                                const modalContent = document.getElementById('modalContent');
                                
                                // Add exit animation
                                modalContent.classList.remove('modal-enter-active');
                                modalContent.classList.add('modal-leave-active');
                                
                                setTimeout(() => {
                                    modal.classList.add('hidden');
                                    modalContent.classList.remove('modal-leave-active');
                                    modalContent.classList.add('modal-enter');
                                }, 300);
                            }

                            function confirmPayment() {
                                // Di sini Anda bisa menambahkan logika untuk submit form
                                alert('Terima kasih! Pembayaran Anda akan segera diverifikasi. Silakan cek dashboard untuk status terbaru.');
                                closePaymentModal();
                                
                                // Contoh redirect ke dashboard atau submit form
                                // window.location.href = '/dashboard';
                                // atau submit form enrollment
                            }

                            // Close modal when clicking outside
                            document.getElementById('paymentModal').addEventListener('click', function(e) {
                                if (e.target === this) {
                                    closePaymentModal();
                                }
                            });

                            // Close modal with Escape key
                            document.addEventListener('keydown', function(e) {
                                if (e.key === 'Escape') {
                                    closePaymentModal();
                                }
                            });
                        </script>
                    </div>
                    <div class="mt-2 px-4 sm:px-6 lg:px-8 py-8">
                        <div class="mb-8 text-center">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Ulasan & Rating</h2>
                            <p class="text-sm sm:text-base text-gray-600">Bagikan pengalaman Anda atau baca ulasan dari peserta lain</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                            {{-- Form Rating (Left Side) --}}
                            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-6">
                                    <div class="w-9 h-9 sm:w-10 sm:h-10 bg-indigo-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-900">Berikan Ulasan</h3>
                                </div>

                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 text-center">
                                            <div class="w-14 h-14 sm:w-16 sm:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.25-7a4.5 4.5 0 00-7.5 0v6.75H8.25A2.25 2.25 0 006 11.25V9a4.5 4.5 0 119 0v2.25z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-base sm:text-lg text-blue-700 font-medium">Admin tidak dapat memberikan ulasan</p>
                                            <p class="text-sm text-blue-600 mt-1">Hanya peserta kursus yang dapat memberikan rating dan ulasan</p>
                                        </div>
                                    @elseif($belum_beli)
                                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center">
                                            <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-base sm:text-lg text-gray-700 font-medium">Gabung kursus ini</p>
                                            <p class="text-sm text-gray-600 mt-1">Anda perlu bergabung dengan kursus ini sebelum dapat memberikan ulasan</p>
                                        </div>
                                    @elseif(!$sudah_terdaftar)
                                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
                                            <div class="w-14 h-14 sm:w-16 sm:h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-base sm:text-lg text-amber-700 font-medium">Pembayaran Perlu Konfirmasi</p>
                                            <p class="text-sm text-amber-600 mt-1">Pembayaran Anda harus dikonfirmasi admin sebelum dapat memberikan ulasan</p>
                                        </div>
                                    @elseif($sudah_memberi_review)
                                        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                                            <div class="flex items-start space-x-4">
                                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="text-base sm:text-lg text-green-800 font-semibold mb-2">Ulasan Anda Sudah Terkirim!</h4>
                                                    <div class="bg-white p-4 rounded-lg border border-green-100">
                                                        <div class="flex items-center mb-2">
                                                            <span class="text-xs sm:text-sm text-gray-600 mr-2">Rating:</span>
                                                            <div class="flex items-center">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <svg class="w-4 h-4 {{ $i <= $review_user->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                    </svg>
                                                                @endfor
                                                                <span class="text-xs sm:text-sm text-gray-600 ml-2">{{ $review_user->rating }}/5</span>
                                                            </div>
                                                        </div>
                                                        <p class="text-sm text-gray-700">{{ $review_user->komentar }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <form method="POST" action="{{ route('review.store', $kursus->id) }}" class="space-y-6">
                                            @csrf
                                            <div>
                                                <label for="rating" class="block text-sm sm:text-base font-semibold text-gray-700 mb-3">Rating Anda</label>
                                                <div class="flex items-center space-x-2 mb-4">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <button type="button" class="rating-star w-7 h-7 sm:w-8 sm:h-8 text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors" data-rating="{{ $i }}">
                                                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                            </svg>
                                                        </button>
                                                    @endfor
                                                </div>
                                                <input type="hidden" name="rating" id="rating" value="5">
                                                <p class="text-xs sm:text-sm text-gray-500 mb-4">Klik bintang untuk memberikan rating</p>
                                            </div>

                                            <div>
                                                <label for="komentar" class="block text-sm sm:text-base font-semibold text-gray-700 mb-3">Komentar</label>
                                                <textarea
                                                    name="komentar"
                                                    id="komentar"
                                                    rows="4"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none text-sm sm:text-base"
                                                    placeholder="Bagikan pengalaman Anda tentang kursus ini..."></textarea>
                                            </div>

                                            <button
                                                type="submit"
                                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg text-base sm:text-lg">
                                                Kirim Ulasan
                                                <svg class="w-5 h-5 inline ml-2 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const stars = document.querySelectorAll('.rating-star');
                                                const ratingInput = document.getElementById('rating');

                                                function updateStars(selectedRating) {
                                                    stars.forEach((s, i) => {
                                                        if (i < selectedRating) {
                                                            s.classList.remove('text-gray-300');
                                                            s.classList.add('text-yellow-400');
                                                        } else {
                                                            s.classList.remove('text-yellow-400');
                                                            s.classList.add('text-gray-300');
                                                        }
                                                    });
                                                }

                                                stars.forEach((star, index) => {
                                                    star.addEventListener('click', function() {
                                                        const rating = parseInt(this.dataset.rating);
                                                        ratingInput.value = rating;
                                                        updateStars(rating);
                                                    });

                                                    star.addEventListener('mouseenter', function() {
                                                        const rating = parseInt(this.dataset.rating);
                                                        updateStars(rating);
                                                    });

                                                    star.addEventListener('mouseleave', function() {
                                                        const currentRating = parseInt(ratingInput.value);
                                                        updateStars(currentRating);
                                                    });
                                                });

                                                // Set default rating to 5 stars on load
                                                updateStars(parseInt(ratingInput.value)); // Use current value (default 5)
                                            });
                                        </script>
                                    @endif
                                @else
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center">
                                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-base sm:text-lg text-gray-700 font-medium mb-2">Login Diperlukan</p>
                                        <p class="text-sm text-gray-600 mb-4">Silakan login untuk memberikan ulasan dan rating</p>
                                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            Login Sekarang
                                        </a>
                                    </div>
                                @endauth
                            </div>

                            {{-- Daftar Ulasan (Right Side) --}}
                            <div class="bg-white p-6 sm:p-8 rounded-2xl border-gray-200 border shadow-sm">
                                <div class="flex items-center mb-6">
                                    <div class="w-9 h-9 sm:w-10 sm:h-10 bg-purple-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-900">Ulasan Peserta</h3>
                                        <p class="text-sm text-gray-600">{{ count($all_reviews) ?? 0 }} ulasan dari peserta</p> {{-- Tambahkan ?? 0 jika all_reviews bisa null --}}
                                    </div>
                                </div>

                                <div class="space-y-6 max-h-96 overflow-y-auto pr-2"> {{-- Added pr-2 for scrollbar spacing --}}
                                    @forelse ($all_reviews as $review)
                                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                            <div class="flex items-start space-x-4">
                                                {{-- Avatar --}}
                                                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <span class="text-white font-bold text-base sm:text-lg">
                                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                                    </span>
                                                </div>

                                                {{-- Review Content --}}
                                                <div class="flex-1 min-w-0"> {{-- Added min-w-0 to prevent overflow --}}
                                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2">
                                                        <div class="mb-1 sm:mb-0">
                                                            <p class="text-sm sm:text-base font-semibold text-gray-900 truncate">{{ $review->user->name }}</p> {{-- Truncate long names --}}
                                                            <p class="text-xs text-gray-500 truncate">{{ $review->user->email }}</p> {{-- Truncate long emails --}}
                                                        </div>
                                                        <div class="text-left sm:text-right flex-shrink-0">
                                                            <div class="flex items-center justify-start sm:justify-end">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                    </svg>
                                                                @endfor
                                                            </div>
                                                            <p class="text-xs text-gray-500 mt-1">{{ $review->created_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>

                                                    @if($review->komentar)
                                                        <p class="text-sm text-gray-700 mt-3 leading-relaxed">{{ $review->komentar }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-12">
                                            <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-base sm:text-lg text-gray-500 font-medium">Belum ada ulasan</p>
                                            <p class="text-sm text-gray-400 mt-1">Jadilah yang pertama memberikan ulasan untuk kursus ini!</p>
                                        </div>
                                    @endforelse
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