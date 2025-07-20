<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="w-full max-w-md mx-auto">
        {{-- Logo --}}
        <div class="mb-6 flex justify-center items-center">
            <a href="/" class="flex items-center space-x-2">
                <x-application-logo class="w-16 h-16 text-indigo-600" />
                <span class="text-3xl font-bold text-gray-800">{{ config('app.name', 'KursusPedia') }}<span
                        class="text-indigo-600">.</span></span>
            </a>
        </div>

        @csrf

        <!-- Heading -->
        <div class="mb-6 text-center">
            <h3 class="text-2xl font-bold text-indigo-700">Buat Akun Baru</h3>
            <p class="text-gray-600 text-sm mt-2">Isi informasi berikut untuk membuat akun Anda.</p>
        </div>

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700" />
            <x-text-input id="name"
                class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex item-start space-x-4 justify-between">
            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                <x-text-input id="password"
                    class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700" />
                <x-text-input id="password_confirmation"
                    class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Submit -->
        <div>
            <x-primary-button
                class="w-full justify-center py-2 text-lg font-semibold bg-indigo-600 hover:bg-indigo-700">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Additional Links -->
    <div class="mt-6 text-center text-sm text-gray-600 space-y-2">
        <a href="{{ route('kursus.index') }}" class="hover:text-indigo-600 hover:underline transition duration-200">
            ← Kembali ke Beranda
        </a>
        <br>
        <a href="{{ route('login') }}" class="hover:text-indigo-600 hover:underline transition duration-200">
            Sudah punya akun? <span class="font-semibold text-indigo-700">Masuk di sini</span>
        </a>
    </div>
</x-guest-layout>