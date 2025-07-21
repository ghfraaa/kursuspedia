<!-- Courses Section -->
<section id="kursus" class="relative py-20 px-8 section-overlay overflow-hidden">
    <!-- Enhanced Header Section -->
    <div class="relative mb-12">

        <div class="flex flex-col md:flex-row md:items-end md:justify-center gap-y-8 md:gap-y-0">
            <div class="max-w-4xl relative">

                <div class="relative z-10">
                    <h2 class="text-4xl lg:text-5xl font-black mb-6 text-center">
                        <span class="text-gradient">Daftar</span>
                        <span class="text-indigo-600"> Kursus</span>
                        <!-- <span class="text-4xl">✨</span> -->
                    </h2>

                    <p class="text-lg text-gray-600 leading-relaxed max-w-3xl text-center">
                        Jelajahi berbagai pilihan kursus dari <span
                            class="text-xl font-bold text-gray-800">KursusPedia<span
                                class="text-indigo-600">.</span></span> yang dirancang secara khusus untuk membantu
                        Anda meningkatkan keterampilan, memperluas pengetahuan, dan menunjang perkembangan karier di
                        berbagai bidang.
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

    @php
        $categories = $kursuses->pluck('kategori')->unique()->filter()->values();
    @endphp

    <div class="flex justify-center space-x-8 mb-12 border-b border-gray-200">
        <button data-category="all"
            class="tab-category text-gray-700 pb-2 border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-600 font-medium active">
            Semua
        </button>
        @foreach ($categories as $category)
            <button data-category="{{ Str::slug($category) }}"
                class="tab-category text-gray-700 pb-2 border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-600 font-medium">
                {{ $category }}
            </button>
        @endforeach
    </div>


<div id="courses-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    @foreach($kursuses as $kursus)
        <div data-kategori="{{ Str::slug($kursus->kategori ?? 'umum') }}" data-nama="{{ strtolower($kursus->nama) }}"
            data-metode="{{ strtolower($kursus->metode ?? 'online') }}"
            data-lokasi="{{ strtolower($kursus->lokasi ?? 'fleksibel') }}"
            data-deskripsi="{{ strtolower(strip_tags($kursus->deskripsi ?? '')) }}"
            class="group relative bg-white border-0 rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 overflow-hidden backdrop-blur-sm">
            
            <!-- Image Container with Overlay -->
            <div class="relative overflow-hidden rounded-t-3xl">
                <img src="{{ asset('storage/kursus/' . $kursus->gambar) }}" alt="{{ $kursus->nama }}"
                    class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <!-- Category Badge -->
                <div class="absolute top-4 left-4">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-sm text-gray-800 shadow-lg">
                        <svg class="w-3 h-3 mr-1.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7.07 7.07a2.5 2.5 0 010 3.536l-2.5 2.5a2.5 2.5 0 01-3.536 0l-7.07-7.07A2.5 2.5 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ $kursus->kategori ?? 'Umum' }}
                    </span>
                </div>
            </div>

            <!-- Content Container -->
            <div class="p-6 space-y-4">
                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-900 leading-tight line-clamp-2 group-hover:text-indigo-600 transition-colors duration-300">
                    {{ $kursus->nama }}
                </h3>

                <!-- Rating Section -->
                @php
                    $averageRating = $kursus->reviews->count() > 0 ? $kursus->reviews->avg('rating') : 0;
                    $totalReviews = $kursus->reviews->count();
                    $roundedRating = round($averageRating, 1);
                @endphp
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <!-- Star Rating -->
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($averageRating))
                                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                    </svg>
                                @elseif($i == ceil($averageRating) && $averageRating - floor($averageRating) >= 0.5)
                                    <div class="relative w-4 h-4">
                                        <svg class="absolute w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                        </svg>
                                        <div class="absolute top-0 left-0 w-1/2 overflow-hidden">
                                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        
                        <!-- Rating Text -->
                        <span class="text-sm font-semibold text-gray-700">
                            {{ $roundedRating > 0 ? $roundedRating : '0' }}
                        </span>
                        
                        @if($totalReviews > 0)
                            <span class="text-xs text-gray-500">({{ $totalReviews }} ulasan)</span>
                        @else
                            <span class="text-xs text-gray-500">(Belum ada ulasan)</span>
                        @endif
                    </div>

                    <!-- Certificate Badge -->
                    @if($kursus->sertifikat ?? false)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs font-medium text-emerald-600">Bersertifikat</span>
                        </div>
                    @else
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="text-xs font-medium text-red-600">Tanpa Sertifikat</span>
                        </div>
                    @endif
                </div>

                <!-- Course Info Grid -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Method -->
                    <div class="flex items-center space-x-2">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16L2 12l4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Metode</p>
                            <p class="text-xs font-semibold text-gray-900">{{ $kursus->metode ?? 'Online' }}</p>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="flex items-center space-x-2">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Lokasi</p>
                            <p class="text-xs font-semibold text-gray-900">{{ $kursus->lokasi ?? 'Fleksibel' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Students Info -->
                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <p class="text-sm font-bold text-indigo-600">{{ $kursus->siswa_terdaftar ?? 0 }}</p>
                            <p class="text-xs text-gray-600">Terdaftar</p>
                        </div>
                        <div class="w-px h-8 bg-gray-300"></div>
                        <div class="text-center">
                            <p class="text-sm font-bold text-gray-700">{{ $kursus->jumlah_siswa ?? 0 }}</p>
                            <p class="text-xs text-gray-600">Kapasitas</p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    @php
                        $progress = $kursus->jumlah_siswa > 0 ? (($kursus->siswa_terdaftar ?? 0) / $kursus->jumlah_siswa) * 100 : 0;
                    @endphp
                    <div class="flex-1 ml-4">
                        <div class="w-full bg-gray-200 rounded-full h-1">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-1 rounded-full transition-all duration-300" 
                                 style="width: {{ min($progress, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 text-right">{{ number_format($progress, 0) }}% penuh</p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex items-center justify-between pt-4 gap-3">
                    <!-- Harga -->
                    <span class="text-2xl font-bold text-indigo-600">
                        <span class="text-sm">IDR </span>
                        {{ number_format($kursus->harga ?? 0, 0, ',', '.') }}
                    </span>

                    <!-- Tombol Lihat Detail -->
                    <a href="{{ route('kursus.show', $kursus->id) }}"
                        class="relative inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300 hover:from-indigo-700 hover:to-purple-700 hover:scale-[1.03] shadow-lg hover:shadow-xl group">
                        
                        <span class="relative z-10">Lihat Detail</span>
                        <svg class="w-4 h-4 transition-transform duration-200 transform group-hover:translate-x-1" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>

                        <!-- Hover overlay animation -->
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                </div>

            </div>

            <!-- Hover Effect Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 to-purple-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none rounded-3xl"></div>
        </div>
    @endforeach
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .group:hover .shimmer {
        animation: shimmer 1.5s ease-in-out infinite;
    }
</style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.tab-category');
            const cards = document.querySelectorAll('[data-kategori]');
            const searchInput = document.getElementById('search-input-courses');

            let activeCategory = 'all';

            function filterCourses() {
                const keyword = searchInput.value.toLowerCase();

                cards.forEach(card => {
                    const kategori = card.getAttribute('data-kategori');
                    const nama = card.getAttribute('data-nama') || '';
                    const metode = card.getAttribute('data-metode') || '';
                    const lokasi = card.getAttribute('data-lokasi') || '';
                    const deskripsi = card.getAttribute('data-deskripsi') || '';

                    const cocokKategori = (activeCategory === 'all' || kategori === activeCategory);
                    const cocokKeyword =
                        nama.includes(keyword) ||
                        kategori.includes(keyword) ||
                        metode.includes(keyword) ||
                        lokasi.includes(keyword) ||
                        deskripsi.includes(keyword);

                    if (cocokKategori && cocokKeyword) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', function () {
                    activeCategory = this.getAttribute('data-category');

                    buttons.forEach(b => b.classList.remove('text-indigo-600', 'border-indigo-600'));
                    this.classList.add('text-indigo-600', 'border-indigo-600');

                    filterCourses();
                });
            });

            searchInput.addEventListener('input', filterCourses);
        });
    </script>

</section>