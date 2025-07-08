<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap" rel="stylesheet">

        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .video-background-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: -100;
            }
            #background-video {
                position: absolute;
                top: 50%;
                left: 50%;
                min-width: 100%;
                min-height: 100%;
                width: auto;
                height: auto;
                transform: translateX(-50%) translateY(-50%);
                object-fit: cover;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="video-background-container">
            <video autoplay muted loop id="background-video">
                <source src="https://res.cloudinary.com/dpebql3aj/video/upload/v1751935023/8mb.video-SMW-ABuEUrsz_he8b4r.mp4" type="video/mp4">
                O seu browser não suporta vídeos HTML5.
            </video>
        </div>

        <div class="min-h-screen bg-stone-900/70">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-stone-900/75 shadow backdrop-blur-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="font-heading">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>