<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body
    class="bg-gradient-to-br from-indigo-100 via-white to-purple-100 min-h-screen font-sans antialiased text-gray-900">
    <div class="flex flex-col justify-center items-center min-h-screen px-4">

        {{-- Card Slot --}}
        <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-6 sm:p-8">
            {{ $slot }}
        </div>
    </div>
</body>

</html>