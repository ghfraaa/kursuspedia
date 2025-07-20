@extends('layouts.app')
@section('content')

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Hero Section -->
    <section id="home" class="flex flex-col lg:flex-row items-center justify-between px-8 mt-12 mb-16">
        <div class="lg:w-1/2 text-center lg:text-left p-4">
            <div
                class="bg-green-100 text-green-700 text-sm font-medium px-3 py-1 rounded-full inline-flex items-center mb-4">
                <i class="fi fi-ss-rocket-lunch"></i>
                <span class="ms-2">Kuasai Skill Baru, Tanpa Ribet</span>
            </div>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">Advance your <span
                    class="text-indigo-600">skills</span> <span class="lg:text-5xl">with us.</span></h1>
            <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto lg:mx-0 text-justify">Jelajahi berbagai kursus pilihan yang dirancang
                untuk membantu kamu berkembang dan siap menghadapi dunia nyata.</p>

            <div id="search-form-hero" class="flex items-center max-w-xl lg:mx-0 mx-auto mt-8">
                <a href="#kursus"
                    class="flex inline-flex p-4 ms-2 text-md font-medium text-white bg-[linear-gradient(to_right,_#a855f7,_#4f46e5)] hover:bg-[linear-gradient(to_right,_#4f46e5,_#a855f7)] rounded-full border border-transparent focus:ring-4 focus:outline-none focus:ring-indigo-300 transition-all duration-700 ease-in-out transform hover:scale-105">
                    Mulai Jelajahi Kursus <i class="fi fi-sr-arrow-circle-right text-xl ms-2 w-6 h-6"></i>
                </a>
            </div>

            <div class="flex flex-wrap justify-center lg:justify-start gap-6 mt-8">
                <div class="flex items-center space-x-2 text-gray-700">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Fleksibel</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-700">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Materi Terstruktur</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-700">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Sertifikat</span>
                </div>
            </div>
        </div>

        <div class="lg:w-1/2 relative p-4 mt-8 lg:mt-0">
            <img src="{{ asset('image/hero-image.png') }}" alt="Woman studying" class="w-full h-auto object-cover">
        </div>
    </section>

    <!-- About Section -->
    @include('home.partials.about-section')

    <!-- Courses Section -->
    @include('home.partials.course-section')

    <!-- Testimoni Section -->
    @include('home.partials.testimoni-section')

    <!-- Team Section -->
    @include('home.partials.team-section')

    <!-- Subscribe Section -->
    @include('home.partials.subcribe-section')

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
                    <li><a href="#testimoni" class="hover:text-indigo-600 transition-colors duration-200">Testimoni</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Other</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="#about" class="hover:text-indigo-600 transition-colors duration-200">Tentang Kami</a></li>
                    <li><a href="#team" class="hover:text-indigo-600 transition-colors duration-200">Tim Kami</a></li>
                </ul>
            </div>

            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-phone text-indigo-600 text-lg"></i>
                    <p class="text-gray-600">+12345678</p>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-indigo-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M1.5 4.5A2.25 2.25 0 013.75 2.25h16.5A2.25 2.25 0 0122.5 4.5v15a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 19.5v-15zM20.25 7.5L12 12.75 3.75 7.5V6h16.5v1.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-gray-600">info@kursuspedia.id</p>
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


@endsection