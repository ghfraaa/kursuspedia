@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Detail Transaksi #{{ $transaction->id }}</h1>
            <p class="text-blue-100 mt-1">Informasi lengkap transaksi</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.transaksi.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

    <!-- Transaction Details -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Informasi Transaksi</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Transaction Info -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Detail Transaksi</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">ID Transaksi:</span>
                            <span class="text-sm font-medium text-gray-900">#{{ $transaction->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Jumlah:</span>
                            <span class="text-sm font-medium text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Status:</span>
                            <span class="text-sm font-medium">
                                @if($transaction->status == 'belum_dibayar')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Belum Dibayar
                                    </span>
                                @elseif($transaction->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Butuh Konfirmasi
                                    </span>
                                @elseif($transaction->status == 'diterima')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Diterima
                                    </span>
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Tanggal:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- User Info -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Informasi Pengguna</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Nama:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaction->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Email:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaction->user->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Bergabung:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaction->user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Details -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Informasi Kursus</h2>
        </div>
        
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    @if($transaction->kursus->gambar)
                        <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset('storage/kursus/' . $transaction->kursus->gambar) }}" alt="{{ $transaction->kursus->nama }}">
                    @else
                        <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-gray-900">{{ $transaction->kursus->nama }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $transaction->kursus->deskripsi }}</p>
                    <div class="mt-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <span class="text-sm text-gray-600">Kategori:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                {{ $transaction->kursus->kategori }}
                            </span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Harga:</span>
                            <span class="text-sm font-medium text-gray-900 ml-2">Rp {{ number_format($transaction->kursus->harga, 0, ',', '.') }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Siswa:</span>
                            <span class="text-sm font-medium text-gray-900 ml-2">{{ $transaction->kursus->siswa_terdaftar }}/{{ $transaction->kursus->jumlah_siswa }}</span>
                        </div>
                    </div>
                    <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm text-gray-600">Tanggal Mulai:</span>
                            <span class="text-sm font-medium text-gray-900 ml-2">{{ \Carbon\Carbon::parse($transaction->kursus->tanggal_mulai)->format('d/m/Y') }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Tanggal Selesai:</span>
                            <span class="text-sm font-medium text-gray-900 ml-2">{{ \Carbon\Carbon::parse($transaction->kursus->tanggal_selesai)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Proof -->
    @if($transaction->payment_proof)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Bukti Pembayaran</h2>
        </div>
        
        <div class="p-6">
            <div class="text-center">
                <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                     alt="Bukti Pembayaran" 
                     class="max-w-full h-auto mx-auto rounded-lg shadow-md cursor-pointer"
                     onclick="openModal('{{ asset('storage/' . $transaction->payment_proof) }}')">
                <p class="text-sm text-gray-500 mt-2">Klik gambar untuk memperbesar</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Aksi</h2>
        </div>
        
        <div class="p-6">
            <div class="flex flex-wrap gap-3">
                @if($transaction->status == 'pending')
                    <form action="{{ route('admin.transaksi.approve', $transaction) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Terima Transaksi
                        </button>
                    </form>
                    <form action="{{ route('admin.transaksi.reject', $transaction) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Tolak Transaksi
                        </button>
                    </form>
                @elseif($transaction->status == 'diterima')
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-lg">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Transaksi telah diterima
                    </div>
                @endif
                
                <form action="{{ route('admin.transaksi.destroy', $transaction) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Preview -->
<div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-lg w-full max-h-screen overflow-auto">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Bukti Pembayaran</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto">
        </div>
    </div>
</div>

<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection