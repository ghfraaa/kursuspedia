@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Unggah Bukti Pembayaran</h1>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <p class="text-gray-700 mb-4">
                Silakan unggah bukti pembayaran untuk transaksi kursus **{{ $transaction->kursus->nama ?? 'Kursus Tidak Ditemukan' }}** dengan jumlah **IDR {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}**.
            </p>

            <form action="{{ route('transactions.upload_proof', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">Pilih File Bukti Pembayaran</label>
                    <input type="file" name="payment_proof" id="payment_proof" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('payment_proof') border-red-500 @enderror">
                    @error('payment_proof')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200 shadow-md">Unggah Bukti</button>
            </form>
        </div>
    </div>
</div>
@endsection
