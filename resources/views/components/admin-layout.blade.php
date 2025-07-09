<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? (config('app.name', 'Laravel') . ' - Admin') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="icon" type="image/png" href="https://assets-bwa.worldofwarcraft.blizzard.com/static/wow-icon-32x32.1a38d7c1c3d8df560d53f5c2ad5442c0401edf83.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .video-background-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: -10; }
        #background-video { position: absolute; top: 50%; left: 50%; min-width: 100%; min-height: 100%; width: auto; height: auto; transform: translateX(-50%) translateY(-50%); object-fit: cover; }
    </style>
</head>
<body class="font-sans antialiased text-gray-300">
    <div class="video-background-container">
        <video autoplay muted loop id="background-video">
            <source src="https://res.cloudinary.com/dpebql3aj/video/upload/v1752012242/videoplayback_kocxn5.webm" type="video/webm">
        </video>
    </div>
    <div class="relative min-h-screen bg-stone-900/70">
        <div x-data="{ sidebarOpen: true }" class="flex h-screen">
            <aside class="bg-stone-800/80 backdrop-blur-sm text-gray-300 flex-shrink-0 flex flex-col justify-between transition-all duration-300"
                :class="sidebarOpen ? 'w-64 p-4' : 'w-0 p-0 overflow-hidden'">
                <div :class="{'opacity-0': !sidebarOpen}" class="transition-opacity duration-200">
                    <a href="{{ route('admin.dashboard') }}" class="text-orange-500 text-2xl font-bold font-heading mb-6 block">WOWNATOR ADMIN</a>
                    <nav class="space-y-2">
                        <x-admin-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-admin-nav-link>
                        <x-admin-nav-link :href="route('admin.characters.index')" :active="request()->routeIs('admin.characters.*')">Personagens</x-admin-nav-link>
                        <x-admin-nav-link :href="route('admin.mounts.index')" :active="request()->routeIs('admin.mounts.*')">Montarias</x-admin-nav-link>
                        <x-admin-nav-link :href="route('admin.skills.index')" :active="request()->routeIs('admin.skills.*')">Habilidades</x-admin-nav-link>
                        <x-admin-nav-link :href="route('admin.zones.index')" :active="request()->routeIs('admin.zones.*')">Zonas</x-admin-nav-link>
                        <x-admin-nav-link :href="route('admin.quotes.index')" :active="request()->routeIs('admin.quotes.*')">Citações</x-admin-nav-link>
                        <div class="pt-4 mt-4 border-t border-stone-700">
                            <x-admin-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">Jogadores</x-admin-nav-link>
                            <x-admin-nav-link :href="route('admin.notifications.index')" :active="request()->routeIs('admin.notifications.*')">Notificações</x-admin-nav-link>
                        </div>
                    </nav>
                </div>
                <div :class="{'opacity-0': !sidebarOpen}" class="transition-opacity duration-200">
                    <x-nav-link :href="route('dashboard')" class="block w-full text-left">Voltar ao Jogo</x-nav-link>
                </div>
            </aside>
            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="flex-shrink-0 bg-stone-900/50 backdrop-blur-sm shadow-md z-10">
                    <div class="flex justify-between items-center p-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-md hover:bg-stone-700 text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform duration-300" :class="{'rotate-90': sidebarOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        </button>
                        <div class="font-semibold text-gray-300">{{ Auth::user()->name }}</div>
                    </div>
                </header>
                
                <main class="flex-1 overflow-y-auto p-6 md:p-8">
                    @if (session('success'))
                        <div class="bg-green-800/50 border border-green-600 text-green-400 px-4 py-3 rounded-lg relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
        
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html>
