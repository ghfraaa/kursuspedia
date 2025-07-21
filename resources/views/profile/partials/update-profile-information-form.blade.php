<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                    {{ __('Nama Lengkap') }}
                </label>
                <div class="relative">
                    <input id="name" name="name" type="text" 
                           class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 shadow-sm" 
                           value="{{ old('name', $user->name) }}" 
                           required autofocus autocomplete="name"
                           placeholder="Masukkan nama lengkap Anda">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                @if($errors->get('name'))
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $errors->get('name')[0] }}
                    </p>
                @endif
            </div>

            <div class="sm:col-span-2">
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                    {{ __('Alamat Email') }}
                </label>
                <div class="relative">
                    <input id="email" name="email" type="email" 
                           class="w-full px-4 py-3 text-gray-900 bg-white border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 placeholder-gray-400 shadow-sm" 
                           value="{{ old('email', $user->email) }}" 
                           required autocomplete="username"
                           placeholder="nama@example.com">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                @if($errors->get('email'))
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $errors->get('email')[0] }}
                    </p>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-4 bg-amber-50 border border-amber-200 rounded-2xl">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-amber-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-amber-800 font-medium">
                                    {{ __('Email Anda belum diverifikasi.') }}
                                </p>
                                <button form="send-verification" 
                                        class="mt-2 text-sm text-amber-700 hover:text-amber-900 underline font-medium focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 rounded">
                                    {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-sm text-green-600 font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
            <div class="flex items-center">
                @if (session('status') === 'profile-updated')
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-init="setTimeout(() => show = false, 3000)"
                         class="flex items-center px-4 py-2 text-sm text-green-700 bg-green-100 rounded-2xl">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Berhasil disimpan!') }}
                    </div>
                @endif
            </div>
            <button type="submit" 
                    class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('Simpan Perubahan') }}
            </button>
        </div>
    </form>
</section>
