@extends('layouts.app')

@section('header')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-2">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Transaksi #{{ $transaction->id }}</h1>
                    <p class="text-blue-100/80 text-sm sm:text-base">Detail lengkap transaksi dan informasi pembayaran</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2">
                <div class="w-2 h-2 rounded-full {{ $transaction->status == 'diterima' ? 'bg-green-400' : ($transaction->status == 'pending' ? 'bg-yellow-400' : 'bg-red-400') }}"></div>
                <span class="text-white text-sm font-medium">
                    {{ $transaction->status == 'belum_dibayar' ? 'Belum Dibayar' : ($transaction->status == 'pending' ? 'Menunggu Konfirmasi' : 'Diterima') }}
                </span>
            </div>
            <a href="{{ route('admin.transaksi.index') }}" 
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg font-medium transition-all duration-200 border border-white/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-xl p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Transaction Overview -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Ringkasan Transaksi</h2>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-sm font-medium text-gray-500">ID Transaksi</span>
                                <span class="text-sm font-semibold text-gray-900 font-mono">#{{ $transaction->id }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-sm font-medium text-gray-500">Total Pembayaran</span>
                                <span class="text-lg font-bold text-emerald-600">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-medium text-gray-500">Status Pembayaran</span>
                                <div>
                                    @if($transaction->status == 'belum_dibayar')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 border border-red-200">
                                            <div class="w-1.5 h-1.5 bg-red-500 rounded-full"></div>
                                            Belum Dibayar
                                        </span>
                                    @elseif($transaction->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700 border border-amber-200">
                                            <div class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></div>
                                            Butuh Konfirmasi
                                        </span>
                                    @elseif($transaction->status == 'diterima')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div>
                                            Diterima
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-sm font-medium text-gray-500">Tanggal Transaksi</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $transaction->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-sm font-medium text-gray-500">Waktu Transaksi</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $transaction->created_at->format('H:i') }} WIB</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-medium text-gray-500">Metode Pembayaran</span>
                                <span class="text-sm font-semibold text-gray-900">Transfer Bank</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Detail Kursus</h2>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="flex-shrink-0">
                            @if($transaction->kursus->gambar)
                                <img class="h-24 w-24 sm:h-32 sm:w-32 rounded-2xl object-cover shadow-md" 
                                     src="{{ asset('storage/kursus/' . $transaction->kursus->gambar) }}" 
                                     alt="{{ $transaction->kursus->nama }}">
                            @else
                                <div class="h-24 w-24 sm:h-32 sm:w-32 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-md">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $transaction->kursus->nama }}</h3>
                                <p class="text-gray-600 mt-2 leading-relaxed">{{ Str::limit($transaction->kursus->deskripsi, 150) }}</p>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 bg-blue-50 rounded-lg">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Kategori</p>
                                            <span class="text-sm font-semibold text-blue-700">{{ $transaction->kursus->kategori }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 bg-emerald-50 rounded-lg">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Harga Kursus</p>
                                            <span class="text-sm font-bold text-emerald-700">Rp {{ number_format($transaction->kursus->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 bg-purple-50 rounded-lg">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Kapasitas</p>
                                            <span class="text-sm font-semibold text-purple-700">{{ $transaction->kursus->siswa_terdaftar }}/{{ $transaction->kursus->jumlah_siswa }} siswa</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="p-1.5 bg-amber-50 rounded-lg">
                                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 4v6m-4-6h8"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Durasi</p>
                                            <span class="text-sm font-semibold text-amber-700">{{ \Carbon\Carbon::parse($transaction->kursus->tanggal_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($transaction->kursus->tanggal_selesai)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Proof -->
            @if($transaction->payment_proof)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-100 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Bukti Pembayaran</h2>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="relative group cursor-pointer" onclick="openModal('{{ asset('storage/' . $transaction->payment_proof) }}')">
                        <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                             alt="Bukti Pembayaran" 
                             class="w-full max-w-md mx-auto h-auto rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 rounded-2xl transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/90 backdrop-blur-sm rounded-lg px-4 py-2">
                                <p class="text-sm font-medium text-gray-800 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                    Klik untuk memperbesar
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- User Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Pengguna</h2>
                    </div>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="text-center pb-4 border-b border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-auto flex items-center justify-center text-white text-xl font-bold shadow-lg">
                            {{ substr($transaction->user->name, 0, 1) }}
                        </div>
                        <h3 class="mt-3 text-lg font-semibold text-gray-900">{{ $transaction->user->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $transaction->user->email }}</p>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="p-2 bg-white rounded-lg shadow-sm">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 4v6m-4-6h8"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Bergabung sejak</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $transaction->user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="p-2 bg-white rounded-lg shadow-sm">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Total Transaksi</p>
                                <p class="text-sm font-semibold text-gray-900">1 Kursus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Panel -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-orange-100 rounded-lg">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Aksi Transaksi</h2>
                    </div>
                </div>
                
                <div class="p-6 space-y-4">
                    @if($transaction->status == 'pending')
                        <form action="{{ route('admin.transaksi.approve', $transaction) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white px-4 py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Terima Transaksi
                            </button>
                        </form>
                        <form action="{{ route('admin.transaksi.reject', $transaction) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-4 py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tolak Transaksi
                            </button>
                        </form>
                    @elseif($transaction->status == 'diterima')
                        <div class="bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-center">
                            <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold">Transaksi telah diterima</span>
                        </div>
                    @endif
                    
                    <!-- Delete Button -->
                    <div class="pt-4 border-t border-gray-100">
                        <form action="{{ route('admin.transaksi.destroy', $transaction) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.')"
                              class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-4 py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 group">
                                <svg class="w-5 h-5 inline mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus Transaksi
                            </button>
                        </form>
                        <p class="text-xs text-gray-500 text-center mt-2">Harap berhati-hati, tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-teal-50 to-cyan-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-teal-100 rounded-lg">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900">Statistik Cepat</h2>
                    </div>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-600 font-medium">Pendapatan</p>
                                    <p class="text-lg font-bold text-blue-700">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-purple-600 font-medium">Status</p>
                                    <p class="text-sm font-bold text-purple-700">
                                        {{ $transaction->status == 'belum_dibayar' ? 'Belum Dibayar' : ($transaction->status == 'pending' ? 'Menunggu' : 'Selesai') }}
                                    </p>
                                </div>
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <div class="w-3 h-3 rounded-full {{ $transaction->status == 'diterima' ? 'bg-green-500' : ($transaction->status == 'pending' ? 'bg-yellow-500 animate-pulse' : 'bg-red-500') }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal for Image Preview -->
<div id="imageModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
        <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-emerald-100 rounded-lg">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Bukti Pembayaran - Transaksi #{{ $transaction->id }}</h3>
            </div>
            <button onclick="closeModal()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-auto max-h-[calc(90vh-120px)]">
            <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto rounded-xl shadow-lg">
        </div>
    </div>
</div>

<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Restore background scrolling
    }

    // Close modal when clicking outside the content
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('imageModal').classList.contains('hidden')) {
            closeModal();
        }
    });
</script>
@endsection