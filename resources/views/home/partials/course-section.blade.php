<!-- Courses Section -->
<section id="kursus" class="relative py-20 px-8 section-overlay overflow-hidden">
    <!-- Enhanced Header Section -->
    <div class="relative mb-12">

        <div class="flex flex-col md:flex-row md:items-end md:justify-center gap-y-8 md:gap-y-0">
            <div class="max-w-4xl relative">

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
                            </div>
                            <button type="submit"
                                class="p-4 ms-2 text-md font-medium text-white bg-indigo-600 rounded-full border border-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-300 transition-colors duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
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
    <div id="courses-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($kursuses as $kursus)
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
    <img src="{{ asset('storage/kursus/' . $kursus->gambar) }}" alt="{{ $kursus->nama }}"
        class="w-full h-48 object-cover rounded-t-2xl">

    <div class="p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $kursus->nama }}</h3>

        <div class="flex items-center text-sm text-gray-600 mb-1">
            <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7.07 7.07a2.5 2.5 0 010 3.536l-2.5 2.5a2.5 2.5 0 01-3.536 0l-7.07-7.07A2.5 2.5 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span>{{ $kursus->kategori ?? 'Umum' }}</span>
        </div>

        <div class="flex items-center text-sm text-gray-600 mb-1">
            <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 20l4-16m4 4l4 4-4 4M6 16L2 12l4-4" />
            </svg>
            <span>{{ $kursus->metode ?? 'Online' }}</span>
        </div>

        <div class="flex items-center text-sm text-gray-600 mb-3">
            <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>{{ $kursus->lokasi ?? 'Fleksibel' }}</span>
        </div>

        <div class="mb-3">
            @if($kursus->sertifikat ?? false)
            <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Sertifikat
            </span>
            @else
            <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Tanpa Sertifikat
            </span>
            @endif
        </div>

        <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
            <span><strong>{{ $kursus->siswa_terdaftar ?? 0 }}</strong> Siswa</span>
            <span><strong>{{ $kursus->jumlah_siswa ?? 0 }}</strong> Kapasitas</span>
        </div>

        <div class="flex justify-between items-center mt-2">
            <span class="text-lg font-bold text-indigo-600">IDR {{ number_format($kursus->harga ?? 0, 0, ',', '.') }}</span>
            <a href="{{ route('kursus.show', $kursus->id) }}"
                class="bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-indigo-700 transition duration-200 shadow">
                Detail
            </a>
        </div>
    </div>
</div>
@endforeach

    </div>

</section>
