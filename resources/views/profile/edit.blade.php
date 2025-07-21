@extends('layouts.app')

@section('header')
    {{-- Memeriksa role pengguna --}}
    @if(Auth::user()->role === 'siswa')
        {{-- Header untuk role 'siswa' --}}
        @include('layouts.navbar')

    @elseif(Auth::user()->role === 'admin')
        {{-- Header untuk role 'admin' --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">Informasi Akun</h1>
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
                </div>
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
            <div id="mobile-menu" class="hidden md:hidden border-t border-blue-500 pt-4 pb-4 px-6">
                <div class="space-y-2">
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

        <script>
            // Fungsi untuk update waktu real-time dengan zona waktu WIT (Indonesia Timur)
            function updateTime() {
                const now = new Date();

                // Convert to WIT (UTC+9) - Indonesia Timur
                const witOffset = 9 * 60; // WIT is UTC+9
                const localOffset = now.getTimezoneOffset();
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
                    if (window.innerWidth >= 768 && mobileMenu)
                        mobileMenu.classList.add('hidden');
                        const svg = mobileMenuButton.querySelector('svg path');
                        svg.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                    }
                });
            });
        </script>
    @else
        {{-- Opsional: Header default atau pesan error jika role tidak dikenali --}}
        <div class="relative px-4 py-16 text-center text-white bg-red-600">
            <h1 class="text-3xl font-bold">Akses Ditolak</h1>
            <p class="mt-2">Anda tidak memiliki izin untuk melihat halaman ini.</p>
        </div>
    @endif
@endsection

@section('content')
    <div class="py-12 bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Profile Navigation --}}
            <div class="mb-8">
                <nav class="flex space-x-1 bg-white/70 backdrop-blur-sm p-1 rounded-2xl shadow-sm border border-white/20">
                    <button class="flex-1 px-4 py-2 text-sm font-medium text-blue-600 bg-white rounded-xl shadow-sm">
                        Informasi Profil
                    </button>
                    <button class="flex-1 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-xl hover:bg-white/50 transition-all duration-200">
                        Keamanan
                    </button>
                    <button class="flex-1 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-xl hover:bg-white/50 transition-all duration-200">
                        Pengaturan
                    </button>
                </nav>
            </div>

            <div class="space-y-8">
                
                {{-- Update Profile Information Form --}}
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl border border-white/20 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900">Informasi Profil</h3>
                                <p class="text-gray-600">Perbarui informasi profil dan alamat email akun Anda</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Update Password Form --}}
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl border border-white/20 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900">Keamanan Kata Sandi</h3>
                                <p class="text-gray-600">Pastikan akun Anda menggunakan kata sandi yang kuat</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Delete User Form --}}
                <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl border border-red-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-50 to-rose-50 px-8 py-6 border-b border-red-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900">Zona Berbahaya</h3>
                                <p class="text-gray-600">Tindakan ini tidak dapat dibatalkan, harap berhati-hati</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
