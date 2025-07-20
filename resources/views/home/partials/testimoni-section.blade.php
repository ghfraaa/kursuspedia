<section id="testimoni" class="py-12 px-8 bg-white">
    <div class="mb-12 text-start">
        <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">Apa Kata<span
                class="text-indigo-600"> Mereka?</span></h2>
    </div>

    @if($testimoni_reviews->count() > 0)
    <div id="default-carousel" class="relative w-full max-w-5xl mx-auto" data-carousel="slide">
        <div class="relative h-[450px] overflow-hidden rounded-lg md:h-[600px]">
            {{-- Slide pertama - menampilkan 3 review pertama --}}
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    @foreach($testimoni_reviews->take(3) as $review)
                    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center border border-indigo-100">
                        {{-- Avatar User --}}
                        @if($review->user->avatar)
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="{{ asset('storage/' . $review->user->avatar) }}" 
                                alt="{{ $review->user->name }}">
                        @else
                            <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                                <span class="text-indigo-600 text-2xl font-bold">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        
                        {{-- Komentar Review --}}
                        <p class="text-gray-700 text-lg mb-4 italic line-clamp-4">
                            "{{ $review->komentar ?: 'Review yang sangat memuaskan untuk kursus ini!' }}"
                        </p>
                        
                        {{-- Nama User --}}
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $review->user->name }}</h3>
                        
                        {{-- Info tambahan user jika ada --}}
                        <p class="text-gray-600 text-sm mb-4">
                            {{ $review->user->email ? 'Peserta Kursus' : 'Member' }}
                        </p>
                        
                        {{-- Badge Kursus yang direview --}}
                        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full mb-3 mt-2">
                            <i class="fa-solid fa-graduation-cap mr-1"></i> {{ $review->kursus->nama }}
                        </span>
                        
                        {{-- Rating Bintang --}}
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Slide kedua - menampilkan 3 review berikutnya jika ada --}}
            @if($testimoni_reviews->count() > 3)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    @foreach($testimoni_reviews->skip(3)->take(3) as $review)
                    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center text-center border border-indigo-100">
                        {{-- Avatar User --}}
                        @if($review->user->avatar)
                            <img class="w-24 h-24 rounded-full object-cover mb-4"
                                src="{{ asset('storage/' . $review->user->avatar) }}" 
                                alt="{{ $review->user->name }}">
                        @else
                            <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                                <span class="text-indigo-600 text-2xl font-bold">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        
                        {{-- Komentar Review --}}
                        <p class="text-gray-700 text-lg mb-4 italic line-clamp-4">
                            "{{ $review->komentar ?: 'Review yang sangat memuaskan untuk kursus ini!' }}"
                        </p>
                        
                        {{-- Nama User --}}
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $review->user->name }}</h3>
                        
                        {{-- Info tambahan user --}}
                        <p class="text-gray-600 text-sm mb-4">
                            {{ $review->user->email ? 'Peserta Kursus' : 'Member' }}
                        </p>
                        
                        {{-- Badge Kursus yang direview --}}
                        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full mb-3 mt-2">
                            <i class="fa-solid fa-graduation-cap mr-1"></i> {{ $review->kursus->nama }}
                        </span>
                        
                        {{-- Rating Bintang --}}
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.927 8.73c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Carousel navigation dots - hanya tampil jika ada lebih dari 3 review --}}
        @if($testimoni_reviews->count() > 3)
        <div class="absolute z-30 p-1 rounded-lg bg-gray-300 flex -translate-x-1/2 bottom-2 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
        </div>
        @endif
    </div>

    @else
    {{-- Fallback jika belum ada review --}}
    <div class="text-center py-12">
        <div class="max-w-md mx-auto">
            <i class="fa-solid fa-comments text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Testimoni</h3>
            <p class="text-gray-500">Jadilah yang pertama memberikan review untuk kursus kami!</p>
        </div>
    </div>
    @endif
</section>

{{-- Custom CSS untuk line-clamp --}}
<style>
    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>