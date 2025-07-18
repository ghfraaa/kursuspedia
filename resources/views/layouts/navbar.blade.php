<nav class="flex items-center justify-between px-8 py-4">
    <div class="flex items-center space-x-2">
        <img src="{{ asset('image/KURSUSPEDIAlogo.png') }}" alt="KursusPedia Logo" class="h-10 w-10"> <span
            class="text-2xl font-bold text-gray-800">KursusPedia<span class="text-indigo-600">.</span></span>
    </div>
    <div class="hidden lg:flex items-center space-x-8">
        <a href="{{ url('/') }}#home" class="text-gray-600 hover:text-indigo-600 font-medium">Beranda</a>
        <a href="{{ url('/') }}#kursus" class="text-gray-600 hover:text-indigo-600 font-medium">Kursus</a>
        <a href="{{ url('/') }}#testimoni" class="text-gray-600 hover:text-indigo-600 font-medium">Testimoni</a>
        <a href="{{ url('/') }}#team" class="text-gray-600 hover:text-indigo-600 font-medium">Tim Kami</a>
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
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
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

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
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
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="w-full text-left text-indigo-600 bg-indigo-100 hover:bg-indigo-200 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5">Dashboard
                </a>

                <!-- Settings Dropdown -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="w-full text-left text-indigo-600 bg-indigo-100 hover:bg-indigo-200 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5">Log
                    in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="w-full text-left text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-3 py-2.5">Register
                    </a>
                @endif
            @endauth
        @endif
    </ul>
</div>