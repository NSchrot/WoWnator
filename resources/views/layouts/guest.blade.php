<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .video-background-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: -10; }
            .video-background { position: absolute; top: 50%; left: 50%; min-width: 100%; min-height: 100%; width: auto; height: auto; transform: translateX(-50%) translateY(-50%); object-fit: cover; }
            .font-heading { font-family: 'Cinzel', serif; }
        </style>
    </head>
    <body class="font-sans text-gray-300 antialiased">
        <div class="video-background-container">
            <video autoplay muted loop playsinline class="video-background">
                <source src="https://res.cloudinary.com/dpebql3aj/video/upload/v1752035066/videoplayback_3_r5jene.webm" type="video/webm">
            </video>
        </div>

        <div class="relative min-h-screen bg-stone-900/40">
            
            <header class="fixed top-0 left-0 right-0 z-10 bg-black/20 backdrop-blur-lg border-b border-stone-500/30">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-center items-center">
                    <div class="text-center">
                        <a href="/">
                            <h1 class="text-3xl font-bold text-wow-gold font-heading">WOWNATOR</h1>
                        </a>
                    </div>
                </nav>
            </header>

            <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
                <div class="w-full sm:max-w-md px-6 py-8 bg-black/20 backdrop-blur-lg border border-stone-500/50 shadow-2xl overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>