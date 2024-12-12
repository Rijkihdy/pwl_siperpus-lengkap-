<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Styles remain the same */
        </style>
    @endif
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col lg:flex-row items-center justify-center gap-6 px-6 py-10">
            <!-- Logo atau Gambar Perpustakaan -->
            <x-logo :src="'https://ucarecdn.com/d5fe1fcc-dc00-4d86-99a1-ee1c7dc4d525/x3p4eelg.png'" />

            <!-- Welcome dan Form Login/Register -->
            <div class="flex-1 text-center lg:text-left">
                <h1 class="text-4xl font-semibold mb-6">Welcome to Library</h1>

                <!-- Form Login/Register -->
                <div class="space-y-8"> <!-- Perbesar jarak antar tombol -->
                    <!-- Tombol Login -->
                    <x-button href="{{ route('login') }}" bgColor="bg-blue-500">
                        Login
                    </x-button>
                    <!-- Tombol Register -->
                    <x-button href="{{ route('register') }}" bgColor="bg-gray-500">
                        Register
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
