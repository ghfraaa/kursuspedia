<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KursusPedia - Advance Your Skills</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Anda bisa menambahkan kustomisasi CSS di sini jika diperlukan */
        /* Misalnya, warna background body */
        body {
            background-color: #FDF2F8;
            /* Warna pink sangat muda */
        }
    </style>
</head>

<body class="font-sans">
    <nav class="flex items-center justify-between px-8 py-4">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('image/KURSUSPEDIAlogo.png') }}" alt="KursusPedia Logo" class="h-10 w-10"> <span
                class="text-2xl font-bold text-gray-800">KursusPedia<span class="text-indigo-600">.</span></span>
        </div>
        <div class="hidden lg:flex items-center space-x-8">
            <a href="#home" class="text-gray-600 hover:text-indigo-600 font-medium">Beranda</a>
            <a href="#kursus" class="text-gray-600 hover:text-indigo-600 font-medium">Kursus</a>
            <a href="#testimoni" class="text-gray-600 hover:text-indigo-600 font-medium">Testimoni</a>
            <a href="#team" class="text-gray-600 hover:text-indigo-600 font-medium">Tim Kami</a>
        </div>
        <header class="hidden lg:flex items-center space-x-4">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-indigo-600 hover:text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Dashboard
                        </a>
                                    <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-indigo-600 hover:text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
    </nav>
    <div class="hidden w-full lg:hidden" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 space-y-2">
            <li><a href="#home" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Beranda</a></li>
            <li><a href="#kursus" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Kursus</a></li>
            <li><a href="#testimoni" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Testimoni</a></li>
            <li><a href="#team" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Tim Kami</a></li>
            <li><button type="button"
                    class="w-full text-left text-indigo-600 bg-indigo-100 hover:bg-indigo-200 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5">Sign
                    In</button></li>
            <li><button type="button"
                    class="w-full text-left text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5">Sign
                    Up</button></li>
        </ul>
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

    </div>

    <!-- Hero Section -->
    <section id="home" class="flex flex-col lg:flex-row items-center justify-between px-8 mt-12 mb-16">
        <div class="lg:w-1/2 text-center lg:text-left p-4">
            <div
                class="bg-green-100 text-green-700 text-sm font-medium px-3 py-1 rounded-full inline-flex items-center mb-4">
                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                Get 30% off on first enroll
            </div>
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-6">Advance your <span
                    class="text-indigo-600">engineering skills</span> with us.</h1>
            <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto lg:mx-0">Build skills with our courses and mentor from
                world-class companies.</p>

            <form id="search-form-hero" class="flex items-center max-w-xl lg:mx-0 mx-auto mt-8">
                <label for="search-input" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="search-input-hero"
                        class="bg-white border border-gray-300 text-gray-900 text-base rounded-full focus:ring-indigo-500 focus:border-indigo-500 block w-full ps-10 p-4 shadow-md"
                        placeholder="Cari kursus..." required />
                </div>
                <a href="#kursus"
                    class="p-4 ms-2 text-md font-medium text-white bg-indigo-600 rounded-full border border-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 transition-colors duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </a>
            </form>

            <div class="flex flex-wrap justify-center lg:justify-start gap-6 mt-8">
                <div class="flex items-center space-x-2 text-gray-700">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Flexible</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-700">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Learning path</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-700">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Community</span>
                </div>
            </div>
        </div>

        <div class="lg:w-1/2 relative p-4 mt-8 lg:mt-0">
            <img src="{{ asset('image/hero-image.png') }}" alt="Woman studying" class="w-full h-auto object-cover">
        </div>
    </section>


    <!-- Courses Section -->
    <section id="kursus" class="relative py-20 px-8 section-overlay overflow-hidden">
        <!-- Enhanced Header Section -->
        <div class="relative mb-12">

            <div class="flex flex-col md:flex-row md:items-end md:justify-center gap-y-8 md:gap-y-0">
                <div class="max-w-4xl relative">
                    <!-- Background Text Effect -->
                    <div class="absolute -top-4 -left-4 text-8xl font-black text-gray-100 select-none opacity-50 z-0">
                        Popular
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-4xl lg:text-5xl font-black mb-6 text-center">
                            <span class="text-gradient">Popular</span>
                            <span class="text-indigo-600"> Courses</span>
                            <span class="text-4xl">✨</span>
                        </h2>

                        <p class="text-lg text-gray-600 leading-relaxed max-w-3xl text-center">
                            Temukan kursus terbaik yang telah dipilih oleh ribuan siswa untuk meningkatkan skill dan
                            karier Anda. Semua kursus diajarkan oleh mentor profesional dan berpengalaman.
                        </p>

                        <!-- Stats -->
                        <div class="flex flex-wrap gap-8 mt-8 justify-center">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-gray-600">1000+ Students Active</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-gray-600">50+ Expert Mentors</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-gray-600">95% Success Rate</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <form id="search-form-courses" class="flex items-center pt-6 w-full max-w-2xl">
                                <label for="search-input-courses" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search-input-courses"
                                        class="bg-white border border-gray-300 text-gray-900 text-base rounded-full focus:ring-indigo-500 focus:border-indigo-500 block w-full ps-10 p-4 shadow-md"
                                        placeholder="Cari kursus..." required />
                               hidden lg:flex items-center space-x-4 </div>
                                <button type="submit"
                                    class="p-4 ms-2 text-md font-medium text-white bg-indigo-600 rounded-full border border-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 transition-colors duration-200 transform hover:scale-105">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="courses-list-title" class="text-2xl font-bold mb-6 text-center"></div>
        <div id="courses-list" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Cards will be injected here -->
        </div>

    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-12 px-8 bg-white">
        <div class="mb-12 text-center">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">What our <span
                    class="text-indigo-600">students say.</span></h2>
        </div>

        <div id="default-carousel" class="relative w-full max-w-5xl mx-auto" data-carousel="slide">
            <div class="relative h-[450px] overflow-hidden rounded-lg md:h-[600px]">
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                        <div
                            class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center border border-indigo-100">
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="https://i.pinimg.com/736x/8e/20/89/8e20893c0a3ce653e3764b660fe9afd8.jpg"
                                alt="Cody Fisher">
                            <p class="text-gray-700 text-lg mb-4 italic">"Membantu aku memulai karir! Glints ExpertClass
                                sangat membantuku untuk memulai karir. Dari topik yang membahas career starter pack
                                sampai topik spesifik bikin aku jadi tahu banyak hal dan bisa diimplementasikan."</p>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Mutiara Khairunnisa</h3>
                            <p class="text-gray-600 text-sm mb-4">Mahasiswa at Politeknik Negeri Jakarta</p>
                            <span
                                class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1  rounded-full mb-3 mt-2">
                                <i class="fa-solid fa-school-dot mr-1"></i> Glints ExpertClass
                            </span>
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center border border-indigo-100">
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="https://myedusolve.com/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FTesti4.f0a3dfbf.webp&w=1920&q=75"
                                alt="Robert Fox">
                            <p class="text-gray-700 text-lg mb-4 italic">"Di dunia pekerjaan saya dituntut untuk mampu
                                beradaptasi dengan perubahan teknologi yang sedemikian cepat berubah. Dengan
                                sertifikasi, maka saya bisa membuktikan kompetensi saya dalam bidang TI yang saya tekuni
                                dan meningkatkan kredibilitas saya di mata klien, peserta training, dan rekan kerja."
                            </p>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Mohammad Afdhal Jauhari</h3>
                            <p class="text-gray-600 text-sm mb-4">IT Consultant - PT NetSolution</p>
                            <span
                                class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1  rounded-full mb-3 mt-2">
                                <i class="fa-solid fa-school-dot mr-1"></i> MyEduSolve
                            </span>
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center border border-indigo-100">
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="https://cdn.sekolah.mu/assets/background/homepage/v4/testimony/avatar-3.png"
                                alt="Leslie Alexander">
                            <p class="text-gray-700 text-lg mb-4 italic">"Sebelum kelas mulai, ada exercise dancing atau
                                games yang bikin semangat belajar. Suasana kelasnya juga fun dan gurunya ramah. Metode
                                belajar interaktif dan penggunaan teknologi yang bikin aku jadi semangat untuk selalu
                                masuk kelas."</p>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Mayo</h3>
                            <p class="text-gray-600 text-sm mb-4">Peserta Living English</p>
                            <span
                                class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1  rounded-full mb-3 mt-2">
                                <i class="fa-solid fa-school mr-1"></i> Sekolah.mu
                            </span>
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                        <div
                            class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center border border-indigo-100">
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="https://bahaso.com/_ipx/f_webp/images/bahaso-photo-testi-1.png" alt="Jane Doe">
                            <p class="text-gray-700 text-lg mb-4 italic">"“Kerjasama yang luar biasa! Penguasaan bahasa
                                era sekarang ini mutlak dan penting sekali untuk kita memasuki pasar internasional.
                                Kerjasama ini berkesan karena Bahaso dapat banyak menyediakan infrastruktur yang dapat
                                membantu mahasiswa-mahasiswi melakukan asesmen tes.”"</p>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Jane Doe</h3>
                            <p class="text-gray-600 text-sm mb-4">Lead Developer, Tech Solutions</p>
                            <span
                                class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1  rounded-full mb-3 mt-2">
                                <i class="fa-solid fa-school mr-1"></i> bahaso
                            </span>
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center border border-indigo-100">
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="https://cakap.com/wp-content/uploads/2022/01/pp2-min-1.png.webp" alt="John Doe">
                            <p class="text-gray-700 text-lg mb-4 italic">"Saya sangat senang belajar di Cakap, materinya
                                menyenangkan, walaupun byk sekali はっぴょう 😅 Guru2 nya juga asik2 dan yg paling pnting
                                fleksibel, shingga jadwalnya bisa kita sesuaikan sendiri, ini sgt mmbantu untuk yg punya
                                kesibukan lainnya 😊😊"</p>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Muhammad Furqan</h3>
                            <p class="text-gray-600 text-sm mb-4">Android Developer</p>
                            <span
                                class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1  rounded-full mb-3 mt-2">
                                <i class="fa-solid fa-school mr-1"></i> Cakap
                            </span>
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div
                            class="hidden lg:flex bg-white p-6 rounded-lg shadow-md flex-col items-center text-center border border-indigo-100">
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="https://i.pinimg.com/originals/57/f1/59/57f159f404b0c082134689c0ee0a5024.jpg"
                                alt="Another User">
                            <p class="text-gray-700 text-lg mb-4 italic">"Saya pernah mengikuti kelas online lainnya,
                                tapi cenderung membosankan dan monoton seperti melihat vlog biasa. Tapi kelas.com
                                menawarkan hal yang berbeda. Praktek yang Riomotret lakukan dan disertai hasil
                                jepretannya dan kualitas videonya sangat bagus."</p>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">Vindy Cloudia Anddie</h3>
                            <p class="text-gray-600 text-sm mb-4">-</p>
                            <span
                                class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1  rounded-full mb-3 mt-2">
                                <i class="fa-solid fa-school mr-1"></i> Kelas.com
                            </span>
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div
                class="absolute z-30 p-1 rounded-lg bg-gray-300 flex -translate-x-1/2 bottom-2 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
            </div>

        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="px-8 bg-blue-50">
        <div class="py-12">
            <div class="mb-12 text-center lg:text-left">
                <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">Meet with our <span
                        class="text-indigo-600">team.</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-5xl mx-auto">
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/jeje.jpg" alt="Mentor 1">
                        <a href="https://www.instagram.com/_nvels/?utm_source=ig_web_button_share_sheet"
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Jesulin N N Wattilete</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101084</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/ghefira.jpg" alt="Mentor 2">
                        <a href="https://www.instagram.com/ghfrvt/?utm_source=ig_web_button_share_sheet"
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Ghefira Novita Putri</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101035</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/dila.jpg" alt="Mentor 2">
                        <a href="#"
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Andi Nurlilah Darsiah</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101011</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/melda.jpg" alt="Mentor 2">
                        <a href="https://www.instagram.com/mlsbtta__/?utm_source=ig_web_button_share_sheet"
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Melda Olivia Lesbatta</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101053</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/fahmi.jpg" alt="Mentor 2">
                        <a href="https://www.instagram.com/amigoxsz/?utm_source=ig_web_button_share_sheet"
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Fahmi Ahmad</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101057</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/noval.jpg" alt="Mentor 2">
                        <a href="#"
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">LinkedIn</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Novaldy Brayn Rumteh</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101068</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/kevin.jpg" alt="Mentor 2">
                        <a href="https://www.instagram.com/kevinlay43/?utm_source=ig_web_button_share_sheet"
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Christhoper Kevin Lay</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101058</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="w-40 h-40 rounded-full object-cover ring-4 ring-indigo-200"
                            src="assets/img/dani.jpg" alt="Mentor 3">
                        <a href="https://www.instagram.com/dnnythemvp_?utm_source=ig_web_button_share_sheet&igsh=MThvbDB6dTRpOXYzNg=="
                            class="absolute bottom-2 right-2 flex items-center justify-center flex items-center justify-center bg-indigo-600 text-white w-8 h-8 rounded-full hover:bg-indigo-700 transition-colors">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Danny F B Tahir</h3>
                    <p class="text-indigo-600 text-sm font-semibold">220101060</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe Section -->
    <section class="py-12 px-8">
        <div class="relative bg-gradient-to-r from-indigo-600 to-blue-500 rounded-lg p-8 md:p-12 lg:p-16 text-white text-center overflow-hidden"
            style="clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);">
            <h2 class="text-4xl lg:text-5xl font-extrabold mb-4">Newsletter.</h2>
            <p class="text-lg md:text-xl mb-8 opacity-90 max-w-2xl mx-auto">Subscribe our newsletter for discounts,
                promo and many more.</p>
            <div class="max-w-md mx-auto">
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Enter your email address"
                        class="flex-grow p-4 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent">
                    <button type="submit"
                        class="bg-white text-indigo-600 font-bold py-4 px-8 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-blue-100 py-12 px-8 mt-12">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="space-y-4">
                <a href="index.html" class="flex items-center space-x-2 text-xl font-bold text-gray-900">
                    <img src="{{ asset('image/KURSUSPEDIAlogo.png') }}" alt="KursusPedia Logo" class="h-10">
                    <span>KursusPedia<span class="text-indigo-600">.</span></span>
                </a>
                <p class="text-gray-600">
                    @2025 Agency. All Rights Reserved by GetNextJsTemplates.com
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33V22C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.002 3.797.048.843.04 1.15.148 1.465.247.54.185.92.356 1.356.672.435.317.75.7.96 1.165.21.465.344.92.395 1.425.051.505.071.676.071 4.22 0 .505-.02 1.425-.07 1.93-.05.505-.184.96-.394 1.425-.21.465-.525.848-.96 1.165-.436.317-.817.488-1.356.672-.315.099-.62.207-1.465.247-1.013.047-1.367.048-3.797.048S9.52 22.002 8.507 21.956c-.843-.04-1.15-.148-1.465-.247-.54-.185-.92-.356-1.356-.672-.435-.317-.75-.7-.96-1.165-.21-.465-.344-.92-.395-1.425-.051-.505-.071-.676-.071-4.22 0-.505.02-1.425.07-1.93.05-.505.184-.96.394-1.425.21-.465.525-.848.96-1.165.436-.317.817-.488 1.356-.672.315-.099.62-.207 1.465-.247C9.52 1.998 9.874 2 12.315 2zm0 0l.005 3.518c0 2.457-1.357 3.557-3.798 3.557-.59 0-1.18-.002-1.77-.004-.59-.002-1.18-.004-1.77-.006-.59-.002-1.18-.004-1.77-.006V6.002h.005c.59 0 1.18.002 1.77.004.59.002 1.18.004 1.77.006.59.002 1.18.004 1.77.006z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2c2.716 0 3.058.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.217.592 1.774 1.148.557.557.895 1.114 1.148 1.774.247.638.415 1.363.465 2.428.047 1.065.06 1.407.06 4.122s-.01 3.058-.06 4.122c-.05 1.065-.217 1.79-.465 2.428-.254.66-.592 1.217-1.148 1.774-.557.557-1.114.895-1.774 1.148-.638.247-1.363.415-2.428.465-1.065.047-1.407.06-4.122.06s-3.058-.01-4.122-.06c-1.065-.05-1.79-.217-2.428-.465-.66-.254-1.217-.592-1.774-1.148-.557-.557-.895-1.114-1.148-1.774-.247-.638-.415-1.363-.465-2.428C2.01 15.058 2 14.716 2 12s.01-3.058.06-4.122c.05-1.065.217-1.79.465-2.428.254-.66.592-1.217 1.148-1.774.557-.557 1.114-.895 1.774-1.148.638-.247 1.363-.415 2.428-.465C8.942 2.01 9.284 2 12 2zm0 5.866c-2.345 0-4.246 1.901-4.246 4.246s1.901 4.246 4.246 4.246 4.246-1.901 4.246-4.246-1.901-4.246-4.246-4.246zM12 16.5c-2.485 0-4.5-2.015-4.5-4.5S9.515 7.5 12 7.5s4.5 2.015 4.5 4.5-2.015 4.5-4.5 4.5zm7.403-10.012c-.754 0-1.365-.611-1.365-1.365s.611-1.365 1.365-1.365 1.365.611 1.365 1.365-.611 1.365-1.365 1.365z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Instagram</span>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Links</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="#home" class="hover:text-indigo-600 transition-colors duration-200">Beranda</a></li>
                    <li><a href="#kursus" class="hover:text-indigo-600 transition-colors duration-200">Kursus</a></li>
                    <li><a href="#testimoni" class="hover:text-indigo-600 transition-colors duration-200">Testimoni</a>
                    </li>
                    <li><a href="#team" class="hover:text-indigo-600 transition-colors duration-200">Tim Kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Other</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="#home" class="hover:text-indigo-600 transition-colors duration-200">About Us</a></li>
                    <li><a href="#team" class="hover:text-indigo-600 transition-colors duration-200">Our Team</a></li>
                </ul>
            </div>

            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-phone text-indigo-600 text-lg"></i>
                    <p class="text-gray-600">+45 3411-4411</p>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-indigo-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M1.5 4.5A2.25 2.25 0 013.75 2.25h16.5A2.25 2.25 0 0122.5 4.5v15a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 19.5v-15zM20.25 7.5L12 12.75 3.75 7.5V6h16.5v1.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-600">info@gmail.com</p>
                </div>
            </div>
        </div>

        <div
            class="max-w-6xl mx-auto border-t border-gray-300 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
            <div class="mb-4 md:mb-0">
                <a href="#" class="hover:text-indigo-600 transition-colors duration-200 mr-4">Privacy policy</a>
                <a href="#" class="hover:text-indigo-600 transition-colors duration-200">Terms & conditions</a>
            </div>
            <div class="mb-4 md:mb-0 text-center">
                Made with ❤️ by Team 6
            </div>
            <div>
                Distributed by <a href="https://themewagon.com/" target="_blank"
                    class="hover:text-indigo-600 transition-colors duration-200">ThemeWagon</a>
            </div>
        </div>
    </footer>

    <button id="scrollToTopBtn"
        class="fixed bottom-6 right-6 bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-75 transition-all duration-300 transform scale-0 opacity-0"
        aria-label="Scroll to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <script>
        // Smooth Scroll to Top JavaScript
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        // Show/hide button based on scroll position
        window.onscroll = function () {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollToTopBtn.classList.remove("scale-0", "opacity-0");
                scrollToTopBtn.classList.add("scale-100", "opacity-100");
            } else {
                scrollToTopBtn.classList.remove("scale-100", "opacity-100");
                scrollToTopBtn.classList.add("scale-0", "opacity-0");
            }
        };

        // Smooth scroll when button is clicked
        scrollToTopBtn.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth" // This makes the scroll smooth
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchForm = document.getElementById('search-form-courses');
            const searchInput = document.getElementById('search-input-courses');
            const coursesList = document.getElementById('courses-list');
            const coursesListTitle = document.getElementById('courses-list-title');
            let allCoursesData = [];

            // Fungsi untuk mengambil data kursus dari kursus2.json
            const fetchCourses = async () => {
                try {
                    const response = await fetch('assets/data/kursus2.json');
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    allCoursesData = await response.json();
                    performSearch(); // Panggil performSearch untuk menampilkan semua kursus secara default
                } catch (error) {
                    console.error('There was a problem fetching the course data:', error);
                    coursesList.innerHTML = '<p class="text-red-500 text-center col-span-full">Gagal memuat data kursus. Silakan coba lagi nanti.</p>';
                }
            };

            // Panggil fungsi fetchCourses saat halaman dimuat
            fetchCourses();

            // Tangani submit form pencarian
            searchForm.addEventListener('submit', (event) => {
                event.preventDefault(); // Mencegah halaman reload
                performSearch();
            });

            // Tangani input real-time
            searchInput.addEventListener('input', () => {
                // Trigger pencarian jika ada minimal 2 karakter atau jika input dikosongkan
                if (searchInput.value.length >= 2 || searchInput.value.length === 0) {
                    performSearch();
                }
            });

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let coursesToDisplay = [];

                if (searchTerm === "") {
                    // Jika input kosong, tampilkan semua kursus
                    coursesToDisplay = allCoursesData;
                } else {
                    // Filter kursus berdasarkan nama, deskripsi, kategori, lokasi, fokus, atau tipe
                    coursesToDisplay = allCoursesData.filter(course =>
                        (course.nama && course.nama.toLowerCase().includes(searchTerm)) ||
                        (course.deskripsi && course.deskripsi.toLowerCase().includes(searchTerm)) ||
                        (course.kategori && course.kategori.toLowerCase().includes(searchTerm)) ||
                        (course.lokasi && Array.isArray(course.lokasi) && course.lokasi.some(loc => loc.toLowerCase().includes(searchTerm))) ||
                        (course.fokus && Array.isArray(course.fokus) && course.fokus.some(foc => foc.toLowerCase().includes(searchTerm))) ||
                        (course.tipe && course.tipe.toLowerCase().includes(searchTerm))
                    );
                }
                renderCourses(coursesToDisplay, searchTerm);
            }

            // Fungsi untuk menentukan badge mode kursus (Online/Offline/Hybrid)
            function getCourseModeBadge(course) {
                const locations = course.lokasi || [];
                const isExplicitOnline = course.online === true; // Check for explicit boolean field
                const isExplicitOffline = course.offline === true; // Check for explicit boolean field

                // Check locations array for presence of 'online' and physical locations
                const isLocationOnline = locations.some(loc => loc.toLowerCase() === 'online');
                const hasPhysicalLocation = locations.some(loc => loc.toLowerCase() !== 'online');

                let badgeText = [];
                let badgeColorClass = '';

                // Prioritize explicit 'Online' and 'offline' boolean flags
                if (isExplicitOnline && isExplicitOffline) {
                    // Render two separate badges in a container for "Online" and "Offline"
                    return `
                        <div class="absolute top-4 right-4 flex flex-row  items-end space-x-1 z-20">
                            <span class="inline-flex items-center bg-gradient-to-r from-green-100 via-green-200 to-green-300 text-green-900 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm"><i class="fa-solid fa-globe mr-1"></i> Online</span>
                            <span class="inline-flex items-center bg-gradient-to-r from-indigo-200 via-indigo-300 to-indigo-400 text-indigo-900 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm"><i class="fa-solid fa-building mr-1"></i> Offline</span>
                        </div>
                    `;
                } else if (isExplicitOnline) {
                    return `<div class="absolute top-4 right-4 bg-gradient-to-r from-green-100 via-green-200 to-green-300 text-green-900 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm"><i class="fa-solid fa-globe mr-1"></i>Online</div>`;
                } else {
                    return `<div class="absolute top-4 right-4 bg-gradient-to-r from-indigo-200 via-indigo-300 to-indigo-400 text-indigo-900 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm"><i class="fa-solid fa-building mr-1"></i>Offline</div>`;
                }
                return '';
            }

            function renderCourses(coursesToRender, searchTerm = "") {
                coursesList.innerHTML = ''; // Kosongkan hasil sebelumnya

                if (coursesToRender.length === 0 && searchTerm !== "") {
                    coursesList.innerHTML = `
                        <div class="col-span-full text-center py-8">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172A4 4 0 0112 20c.707 0 1.397-.194 2-.547m-4-10.895L10 3m0 0l-1.828 1.828M12 20a4 4 0 004-4h-4zm0 0a4 4 0 01-4-4h4z"></path>
                            </svg>
                            <h3 class="mt-2 text-xl font-semibold text-gray-900">Tidak ada kursus ditemukan</h3>
                            <p class="mt-1 text-base text-gray-500">Kami tidak dapat menemukan kursus yang cocok dengan "<span class="font-bold">${searchTerm}</span>". Coba kata kunci lain.</p>
                        </div>
                    `;
                    return;
                }

                if (coursesToRender.length === 0 && searchTerm === "") {
                    coursesList.innerHTML = `
                        <p class="text-center text-gray-500 col-span-full">Tidak ada kursus tersedia saat ini.</p>
                    `;
                    return;
                }

                coursesList.innerHTML = coursesToRender.map(course => `
                    <div class="relative bg-white rounded-lg shadow-md overflow-hidden transition-shadow duration-300 hover:shadow-lg transform hover:scale-105" style="transition: transform 0.2s;">
                        <p class="hidden text-indigo-700"> ${course.id}</p>
                        <img class="w-full h-48 object-cover" src="${course.gambar || 'https://via.placeholder.com/400x200?text=No+Image'}" alt="${course.nama || 'No Title'}">
                        
                        ${getCourseModeBadge(course)}

                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">${course.nama ?? 'Untitled Course'}</h3>
                            <p class="text-gray-600 text-sm mb-2">${course.kategori ?? 'Unknown Category'}</p>
                            <div class="flex items-center text-gray-500 text-sm mb-2">
                                <i class="fa-solid fa-tag mr-1"></i>
                                <span>${course.biaya ?? 'N/A'}</span>
                                ${course.fokus && Array.isArray(course.fokus) && course.fokus.length > 0 ? `<span class="ml-1">• ${course.fokus[0]}</span>` : ''}
                            </div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-400 font-semibold mr-1 text-xs">${course.rating ?? 0}</span>
                                    <div class="flex">
                                        ${(() => {
                        const rating = course.rating ?? 0;
                        const stars = [];
                        const fullStars = Math.floor(rating);
                        const fractional = rating - fullStars;
                        const percentage = Math.round(fractional * 100);

                        for (let i = 0; i < 5; i++) {
                            if (i < fullStars) {
                                // Full star
                                stars.push(`
                                                        <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                                        </svg>`);
                            } else if (i === fullStars && fractional > 0) {
                                // Partial star using gradient mask
                                stars.push(`
                                                        <svg class="w-3 h-3" viewBox="0 0 20 20">
                                                            <defs>
                                                                <linearGradient id="grad${course.id}">
                                                                    <stop offset="${percentage}%" stop-color="#facc15" />
                                                                    <stop offset="${percentage}%" stop-color="#d1d5db" />
                                                                </linearGradient>
                                                            </defs>
                                                            <path fill="url(#grad${course.id})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                                        </svg>
                                                    `);
                            } else {
                                // Empty star
                                stars.push(`
                                                        <svg class="w-3 h-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                                        </svg>`);
                            }
                        }
                        return stars.join("");
                    })()}
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-indigo-600">
                                    ${course.harga_min != null && course.harga_min !== '' ? 'Rp ' + course.harga_min : 'Rp -'}
                                </span>
                            </div>
                            
                            <div class="flex justify-end text-gray-500 text-xs">
                                <div class="flex items-center space-x-1">
                                    <i class="fa-solid fa-users"></i>
                                    <span>${course.jumlah_siswa ?? 0} students</span>
                                </div>
                        
                            </div>
                            <a href="detail.html?id=${course.id}" class="absolute inset-0 z-10"></a>
                        </div>
                    </div>
                `).join('');
            }
        });
    </script>

</body>

</html>