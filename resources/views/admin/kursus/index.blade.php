@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Manajemen Kursus</h1>
            <p class="text-blue-100 mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="hidden md:block">
                <div class="text-right mb-2">
                    <p class="text-sm text-blue-100" id="date-display"></p>
                    <p class="text-xs text-blue-200" id="time-display"></p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ url('/') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded">
                        Beranda
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.kursus.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded">
                        Kelola Kursus
                    </a>
                    <a href="{{ route('admin.transaksi.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded">
                        Kelola Transaksi
                    </a>
                    <div class="relative">
                        <button id="user-dropdown-button"
                            class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-dropdown-menu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button"
                        class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded focus:outline-none"
                        aria-label="Toggle menu">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-blue-500 pt-4 pb-4 px-6">
                <div class="space-y-2">
                    <!-- Time Display Mobile -->
                    <div class="text-center mb-4">
                        <p class="text-sm text-blue-100" id="mobile-date-display"></p>
                        <p class="text-xs text-blue-200" id="mobile-time-display"></p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                        class="block bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded text-center">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.kursus.index') }}"
                        class="block bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded text-center">
                        Kelola Kursus
                    </a>
                    <a href="{{ route('admin.transaksi.index') }}"
                        class="block bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded text-center">
                        Kelola Transaksi
                    </a>

                    <!-- Mobile User Menu -->
                    <div class="border-t border-blue-500 pt-2 mt-4">
                        <div class="text-center text-white text-sm mb-2">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="space-y-2">
                            <a href="{{ route('profile.edit') }}"
                                class="block bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded text-center">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk update waktu real-time dengan zona waktu WIT (Indonesia Timur)
        function updateTime() {
            const now = new Date();

            // Convert to WIT (UTC+9) - Indonesia Timur
            const witOffset = 9 * 60; // WIT is UTC+9
            const localOffset = now.getTimezoneOffset(); // Get local timezone offset in minutes
            const witTime = new Date(now.getTime() + (witOffset + localOffset) * 60 * 1000);

            // Format tanggal dalam bahasa Indonesia
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[witTime.getDay()];
            const day = witTime.getDate();
            const month = months[witTime.getMonth()];
            const year = witTime.getFullYear();

            // Format waktu
            const hours = String(witTime.getHours()).padStart(2, '0');
            const minutes = String(witTime.getMinutes()).padStart(2, '0');
            const seconds = String(witTime.getSeconds()).padStart(2, '0');

            // Update DOM elements (desktop and mobile)
            const dateElement = document.getElementById('date-display');
            const timeElement = document.getElementById('time-display');
            const mobileDateElement = document.getElementById('mobile-date-display');
            const mobileTimeElement = document.getElementById('mobile-time-display');

            if (dateElement && timeElement) {
                dateElement.textContent = `${dayName}, ${day} ${month} ${year}`;
                timeElement.textContent = `${hours}:${minutes}:${seconds} WIT`;
            }

            if (mobileDateElement && mobileTimeElement) {
                mobileDateElement.textContent = `${dayName}, ${day} ${month} ${year}`;
                mobileTimeElement.textContent = `${hours}:${minutes}:${seconds} WIT`;
            }
        }

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const userDropdownButton = document.getElementById('user-dropdown-button');
            const userDropdownMenu = document.getElementById('user-dropdown-menu');

            // Mobile menu toggle
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');

                    // Toggle icon
                    const svg = mobileMenuButton.querySelector('svg path');
                    if (mobileMenu.classList.contains('hidden')) {
                        svg.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                    } else {
                        svg.setAttribute('d', 'M6 18L18 6M6 6l12 12');
                    }
                });
            }

            // User dropdown toggle (desktop)
            if (userDropdownButton && userDropdownMenu) {
                userDropdownButton.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userDropdownMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function () {
                    if (!userDropdownMenu.classList.contains('hidden')) {
                        userDropdownMenu.classList.add('hidden');
                    }
                });

                userDropdownMenu.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            }

            // Initialize time and set interval for real-time updates
            updateTime();
            setInterval(updateTime, 1000); // Update every second

            // Close mobile menu when window is resized to desktop size
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 768 && mobileMenu) { // 768px is md breakpoint
                    mobileMenu.classList.add('hidden');
                    const svg = mobileMenuButton.querySelector('svg path');
                    svg.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                }
            });
        });
    </script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Kursus</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $kursuses->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-green-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Kursus Aktif</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $kursuses->where('tanggal_mulai', '<=', today()->toDateString())
                                    ->where('tanggal_selesai', '>=', today()->toDateString())
                                    ->count() }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-yellow-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $kursuses->sum('siswa_terdaftar') }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-purple-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($kursuses->sum(function($k) { return $k->harga * $k->siswa_terdaftar; }), 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

        <!-- Search and Filter -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
            <!-- Search and Filter Card (Left) -->
            <div class="lg:col-span-10 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="GET" action="{{ route('admin.kursus.index') }}">
                    <div class="space-y-4">
                        <!-- Search Input -->
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kursus..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Filters Row -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <select name="kategori" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Kategori</option>
                                <option value="Programming" {{ request('kategori') == 'Programming' ? 'selected' : '' }}>Programming</option>
                                <option value="Marketing" {{ request('kategori') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Language" {{ request('kategori') == 'Language' ? 'selected' : '' }}>Language</option>
                                <option value="Design" {{ request('kategori') == 'Design' ? 'selected' : '' }}>Design</option>
                                <option value="Business" {{ request('kategori') == 'Business' ? 'selected' : '' }}>Business</option>
                            </select>
                            <select name="status" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="akan_datang" {{ request('status') == 'akan_datang' ? 'selected' : '' }}>Akan Datang</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors whitespace-nowrap">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.kursus.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors whitespace-nowrap">
                                <svg class="w-4 h-4 inline mr-2" fill="#ffffff" stroke="currentColor" viewBox="0 0 512 512">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160 352 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l111.5 0c0 0 0 0 0 0l.4 0c17.7 0 32-14.3 32-32l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1L16 432c0 17.7 14.3 32 32 32s32-14.3 32-32l0-35.1 17.6 17.5c0 0 0 0 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.8c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352l34.4 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L48.4 288c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"></path>
                                </svg>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Actions Card (Right) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="space-y-3">
                    <a href="{{ route('admin.kursus.create') }}" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah
                    </a>
                    <a href="{{ route('admin.kursus.export', request()->all()) }}" class="w-full bg-green-600 font-medium hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="#ffffff" stroke="currentColor" viewBox="0 0 512 512">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM200 352l16 0c22.1 0 40 17.9 40 40l0 8c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-8c0-4.4-3.6-8-8-8l-16 0c-4.4 0-8 3.6-8 8l0 80c0 4.4 3.6 8 8 8l16 0c4.4 0 8-3.6 8-8l0-8c0-8.8 7.2-16 16-16s16 7.2 16 16l0 8c0 22.1-17.9 40-40 40l-16 0c-22.1 0-40-17.9-40-40l0-80c0-22.1 17.9-40 40-40zm133.1 0l34.9 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-34.9 0c-7.2 0-13.1 5.9-13.1 13.1c0 5.2 3 9.9 7.8 12l37.4 16.6c16.3 7.2 26.8 23.4 26.8 41.2c0 24.9-20.2 45.1-45.1 45.1L304 512c-8.8 0-16-7.2-16-16s7.2-16 16-16l42.9 0c7.2 0 13.1-5.9 13.1-13.1c0-5.2-3-9.9-7.8-12l-37.4-16.6c-16.3-7.2-26.8-23.4-26.8-41.2c0-24.9 20.2-45.1 45.1-45.1zm98.9 0c8.8 0 16 7.2 16 16l0 31.6c0 23 5.5 45.6 16 66c10.5-20.3 16-42.9 16-66l0-31.6c0-8.8 7.2-16 16-16s16 7.2 16 16l0 31.6c0 34.7-10.3 68.7-29.6 97.6l-5.1 7.7c-3 4.5-8 7.1-13.3 7.1s-10.3-2.7-13.3-7.1l-5.1-7.7c-19.3-28.9-29.6-62.9-29.6-97.6l0-31.6c0-8.8 7.2-16 16-16z"></path>
                        </svg>
                        Export
                    </a>
                </div>
            </div>
        </div>
    
    <!-- Kursus Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kursus</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kursuses as $kursus)
                    <tr class="hover:bg-gray-50">
                        <td class="px-2 py-4 whitespace-nowrap text-right text-sm text-gray-900">
                            #{{ $kursus->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($kursus->gambar)
                                        <img class="h-12 w-12 rounded-lg object-cover" src="{{ asset('storage/kursus/' . $kursus->gambar) }}" alt="{{ $kursus->nama }}">
                                    @else
                                        <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ Str::limit($kursus->nama, 30) }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($kursus->deskripsi, 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $kursus->kategori }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>{{ \Carbon\Carbon::parse($kursus->tanggal_mulai)->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($kursus->tanggal_selesai)->format('d/m/Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="text-sm font-medium">{{ $kursus->siswa_terdaftar }}/{{ $kursus->jumlah_siswa }}</div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $kursus->jumlah_siswa > 0 ? ($kursus->siswa_terdaftar / $kursus->jumlah_siswa) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($kursus->harga, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $now = now();
                                $start = \Carbon\Carbon::parse($kursus->tanggal_mulai);
                                $end = \Carbon\Carbon::parse($kursus->tanggal_selesai);
                            @endphp
                            
                            @if($now < $start)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Akan Datang
                                </span>
                            @elseif($now >= $start && $now <= $end)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.kursus.show', $kursus) }}" class="text-blue-600 hover:text-blue-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.kursus.edit', $kursus) }}" class="text-yellow-500 hover:text-yellow-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.kursus.destroy', $kursus) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500">Belum ada kursus yang tersedia</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($kursuses->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $kursuses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection