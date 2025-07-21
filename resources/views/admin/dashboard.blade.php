@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
            <p class="text-blue-100 mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="hidden md:block">
                <div class="text-right mb-2">
                    <p class="text-sm text-blue-100" id="date-display"></p>
                    <p class="text-xs text-blue-200" id="time-display"></p>
                </div>
                <div class="flex space-x-2">
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Kursus -->
            <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Kursus</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalKursus) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-xl shadow-sm border border-green-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalUser) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Siswa Terdaftar -->
            <div class="bg-white rounded-xl shadow-sm border border-yellow-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Siswa Terdaftar</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalSiswaTerdaftar) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="bg-white rounded-xl shadow-sm border border-purple-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">Rp
                            {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Chart Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">                            
                            <svg class="mr-2 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Pendaftaran Bulanan</h3>
                        </div>

                        <div class="flex items-center space-x-2">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                +12% dari bulan lalu
                            </span>
                        </div>
                    </div>
                    <div style="height: 200px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>

                <!-- Category Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">                            
                            <svg class="mr-2 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Komposisi Kursus</h3>
                        </div>
                        <span class="text-sm text-gray-500">Total: {{ $totalKursus }} kursus</span>
                    </div>
                    <div class="flex items-center justify-center" style="height: 300px;">
                        <canvas id="categoryChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Kursus Populer -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">                            
                        <svg class="mr-2 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Kursus Populer</h3>
                    </div>
                    <a href="{{ route('admin.kursus.index') }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @foreach($kursusPopuler as $index => $kursus)
                        <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ $index + 1 }}</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $kursus->nama }}</p>
                                <p class="text-xs text-gray-500">{{ $kursus->kategori }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $kursus->siswa_terdaftar }}</p>
                                <p class="text-xs text-gray-500">siswa</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Data Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <!-- Tabel Kursus -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">                            
                        <svg class="mr-2 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Kursus Terbaru</h3>
                    </div>
                    <a href="{{ route('admin.kursus.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Kelola Kursus</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Kursus</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($semuaKursus as $kursus)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($kursus->nama, 30) }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $kursus->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $kursus->siswa_terdaftar }}/{{ $kursus->jumlah_siswa }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($kursus->harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Transaksi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">                            
                        <svg class="mr-2 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Transaksi Terbaru</h3>
                    </div>
                    <a href="{{ route('admin.transaksi.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Kelola Transaksi</a>
                </div>
                @foreach($transaksiTerbaru as $transaksi)
                    <div class="flex items-center space-x-4 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                                {{-- Pastikan relasi 'kursus' sudah dimuat dan ada --}}
                                <span class="text-white text-sm font-medium">
                                    {{ substr($transaksi->kursus->nama ?? 'N/A', 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            {{-- Nama Kursus --}}
                            <p class="text-sm font-medium text-gray-900">
                                {{ $transaksi->kursus->nama ?? 'Kursus Tidak Ditemukan' }}
                            </p>
                            {{-- Nama User --}}
                            <p class="text-xs text-gray-500">
                                {{ $transaksi->user->name ?? 'User Tidak Ditemukan' }}
                            </p>
                        </div>
                        <div class="text-right">
                            {{-- Waktu Transaksi --}}
                            <p class="text-xs text-gray-500">{{ $transaksi->created_at->diffForHumans() }}</p>
                            {{-- Status Transaksi --}}
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs
                                @if($transaksi->status == 'diterima') bg-green-100 text-green-800
                                @elseif($transaksi->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($transaksi->status == 'belum_dibayar') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ 
                                    $transaksi->status == 'diterima' ? 'Diterima' : (
                                        $transaksi->status == 'pending' ? 'Menunggu Konfirmasi' : (
                                            $transaksi->status == 'belum_dibayar' ? 'Belum Dibayar' : ucfirst($transaksi->status)
                                        )
                                    )
                                }}
                            </span>
                        </div>
                    </div>
                @endforeach
                {{-- Jika tidak ada transaksi --}}
                @if($transaksiTerbaru->isEmpty())
                    <p class="text-center text-gray-500 py-4">Belum ada transaksi terbaru.</p>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <div class="flex items-center mb-4">                            
                <svg class="mr-2 h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <button
                    class="flex flex-col items-center p-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                    <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500 mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Tambah Kursus</span>
                </button>

                <button
                    class="flex flex-col items-center p-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-green-500 hover:bg-green-50 transition-colors group">
                    <svg class="w-8 h-8 text-gray-400 group-hover:text-green-500 mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-green-700">Tambah User</span>
                </button>

                <button
                    class="flex flex-col items-center p-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-yellow-500 hover:bg-yellow-50 transition-colors group">
                    <svg class="w-8 h-8 text-gray-400 group-hover:text-yellow-500 mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-yellow-700">Lihat Report</span>
                </button>

                <button
                    class="flex flex-col items-center p-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-purple-500 hover:bg-purple-50 transition-colors group">
                    <svg class="w-8 h-8 text-gray-400 group-hover:text-purple-500 mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-purple-700">Settings</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Monthly Chart Configuration
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyChartData['labels']),
                    datasets: [{
                        label: 'Pendaftaran',
                        data: @json($monthlyChartData['data']),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                title: function (context) {
                                    return 'Bulan ' + context[0].label;
                                },
                                label: function (context) {
                                    return context.parsed.y + ' siswa terdaftar';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });

            // Category Chart Configuration
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            const categoryChart = new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($categoryChart['labels']),
                    datasets: [{
                        data: @json($categoryChart['data']),
                        backgroundColor: @json($categoryChart['colors']),
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 12
                                },
                                color: '#6B7280'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return label + ': ' + value + ' kursus (' + percentage + '%)';
                                }
                            }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    </script>
@endsection