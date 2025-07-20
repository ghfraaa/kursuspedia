<section id="about" class="py-16 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-6xl mx-auto px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-indigo-600 mb-4">
                Tentang <span class="text-4xl font-bold text-gray-800">KursusPedia<span
                        class="text-indigo-600">.</span></span>

            </h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start justify-between ">
            <div class="space-y-6">
                <p class="text-lg text-gray-700 leading-relaxed leading-relaxed text-justify">
                    <strong class="text-2xl font-bold text-gray-800">KursusPedia<span class="text-indigo-600">.</span>
                    </strong> adalah platform pembelajaran yang menyediakan berbagai metode belajar
                    fleksibel - online, offline, dan hybrid - untuk memenuhi keragaman kebutuhan pembelajaran setiap
                    individu. Kami berkomitmen untuk memberikan akses pendidikan berkualitas tinggi kepada semua
                    kalangan, dengan pilihan format pembelajaran yang sesuai dengan preferensi dan situasi Anda.
                </p>

            </div>
            <div class="relative max-w-md">
                <img src="{{ asset('image/ilustrasi.png') }}" alt="About KursusPedia"
                    class="w-full h-auto object-cover rounded-lg shadow-lg">
                <div class="absolute -bottom-4 -right-4 bg-indigo-600 text-white p-4 rounded-lg shadow-lg">
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <span class="font-semibold">4.8/5 Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Why Choose KursusPedia Section --}}
<section id="why-choose-us" class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold"> Mengapa <span class="text-indigo-600 mb-4">Memilih</span>
                <span class="text-4xl font-bold text-gray-800">KursusPedia<span class="text-indigo-600">.</span></span>

            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Kami memahami kebutuhan pembelajaran modern dan menyediakan solusi terbaik untuk pengembangan karier
                Anda
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 ">
            {{-- Reason 1 --}}
            <div
                class="group bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div
                    class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Pembelajaran Fleksibel</h3>
                <p class="text-gray-600 leading-relaxed">
                    Pilih metode belajar sesuai kebutuhan: online untuk fleksibilitas, offline untuk interaksi langsung,
                    atau hybrid untuk keduanya.</p>
            </div>

            {{-- Reason 2 --}}

            <div
                class="group bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div
                    class="w-16 h-16 bg-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Harga Terjangkau</h3>
                <p class="text-gray-600 leading-relaxed">
                    Investasi terbaik untuk masa depan karier Anda, cukup dengan sekali bayar tanpa biaya tambahan.
                </p>
            </div>

            {{-- Reason 3 --}}
            <div
                class="group bg-gradient-to-br from-yellow-50 to-orange-50 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div
                    class="w-16 h-16 bg-yellow-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Sertifikat Resmi</h3>
                <p class="text-gray-600 leading-relaxed">
                    Tingkatkan daya saing anda dengan sertifikat penyelesaian yang menandai keberhasilan dalam
                    menyelesaikan pelatihan.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Our Vision & Mission Section --}}
<section id="mission-vision" class="py-16 bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Visi & Misi Kami</h2>
            <p class="text-lg opacity-90 max-w-2xl mx-auto">
                Berkomitmen untuk menciptakan ekosistem pembelajaran yang mendukung transformasi digital Indonesia
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            {{-- Vision --}}
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 hover:bg-white/15 transition-all duration-300">
                <div class="flex items-center mb-5">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold">Visi Kami</h3>
                </div>
                <p class="text-base opacity-90 leading-relaxed">
                    Menjadi platform pembelajaran online terdepan di Asia Tenggara yang menghasilkan generasi
                    profesional kompeten, adaptif, dan inovatif dalam transformasi digital dan pembangunan ekonomi
                    berkelanjutan.
                </p>
            </div>

            {{-- Mission --}}
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 hover:bg-white/15 transition-all duration-300">
                <div class="flex items-center mb-5">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold">Misi Kami</h3>
                </div>
                <ul class="space-y-3 text-base">
                    @php
                        $missions = [
                            'Menyediakan akses pendidikan berkualitas dengan metode pembelajaran yang beragam dan fleksibel',
                            'Membangun jembatan antara dunia pendidikan dan industri untuk menciptakan talenta yang siap menghadapi tantangan era digital',
                            'Mengembangkan program pembelajaran yang adaptif sesuai kebutuhan industri terkini',
                        ];
                    @endphp
                    @foreach ($missions as $mission)
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-300 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ $mission }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>


{{-- Stats & Achievements Section --}}
<section id="stats" class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-indigo-600 mb-4">
                Pencapaian <span class="text-4xl font-bold text-gray-800">KursusPedia<span
                        class="text-indigo-600">.</span></span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Angka-angka yang membuktikan komitmen kami dalam memberikan pendidikan berkualitas
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="text-center group">
                <div
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="text-4xl font-bold text-indigo-600 mb-2" data-count="{{ $kursuses->count() }}">0</div>
                    <p class="text-gray-600 font-semibold">Kursus Tersedia</p>
                </div>
            </div>
            <div class="text-center group">
                <div
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="text-4xl font-bold text-green-600 mb-2" data-count="{{ $kursuses->sum('siswa_terdaftar') }}">0</div>
                    <p class="text-gray-600 font-semibold">Siswa Aktif</p>
                </div>
            </div>
            <div class="text-center group">
                <div
                    class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="text-4xl font-bold text-purple-600 mb-2" data-count="95">0</div>
                    <p class="text-gray-600 font-semibold">% Tingkat Kepuasan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Counter Animation for Stats
    function animateCounters() {
        const counters = document.querySelectorAll('[data-count]');

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const increment = target / 200;
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                }
            }, 10);
        });
    }

    // Trigger animation when stats section is visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.disconnect();
            }
        });
    });

    const statsSection = document.getElementById('stats');
    if (statsSection) {
        observer.observe(statsSection);
    }
</script>