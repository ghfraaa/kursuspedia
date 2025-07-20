<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md mx-auto">
        @csrf

        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Masuk ke Akun Anda</h2>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:underline transition-all duration-200"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Link Tambahan -->
    <div class="mt-6 text-center space-y-2">
        <a href="{{ route('kursus.index') }}"
            class="text-sm text-gray-600 hover:text-indigo-600 hover:underline transition-all duration-200">
            ← Kembali ke Beranda
        </a>
        <br>
        <a href="{{ route('register') }}"
            class="text-sm text-gray-600 hover:text-indigo-600 hover:underline transition-all duration-200">
            Belum punya akun? <span class="font-medium">Daftar sekarang</span>
        </a>
    </div>
</x-guest-layout>
