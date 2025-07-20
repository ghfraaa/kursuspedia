<x-guest-layout>

    <form method="POST" action="{{ route('login') }}" class="w-full max-w-md mx-auto">
        {{-- Logo --}}
        <div class="mb-6 flex justify-center items-center">
            <a href="/" class="flex items-center space-x-2">
                <x-application-logo class="w-16 h-16 text-indigo-600" />
                <span class="text-3xl font-bold text-gray-800">{{ config('app.name', 'KursusPedia') }}<span class="text-indigo-600">.</span></span>
            </a>
        </div>
        @csrf

        <!-- Heading -->
        <div class="mb-6 text-center">
            <h3 class="text-2xl font-bold text-indigo-700">Masuk ke Akun Anda</h3>
            <p class="text-gray-600 text-sm mt-2">Silakan masukkan detail akun Anda untuk melanjutkan.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="flex items-center text-sm text-gray-600">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-indigo-600 hover:underline transition duration-200">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div>
            <x-primary-button class="w-full justify-center py-2 text-lg font-semibold bg-indigo-600 hover:bg-indigo-700">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Additional Links -->
    <div class="mt-6 text-center text-sm text-gray-600 space-y-2">
        <a href="{{ route('kursus.index') }}"
            class="hover:text-indigo-600 hover:underline transition duration-200">
            ← Kembali ke Beranda
        </a>
        <br>
        <a href="{{ route('register') }}"
            class="hover:text-indigo-600 hover:underline transition duration-200">
            Belum punya akun? <span class="font-semibold text-indigo-700">Daftar sekarang</span>
        </a>
    </div>
</x-guest-layout>
