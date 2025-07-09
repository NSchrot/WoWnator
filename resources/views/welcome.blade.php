<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoWnator</title>

    <link rel="icon" type="image/png" href="https://assets-bwa.worldofwarcraft.blizzard.com/static/wow-icon-32x32.1a38d7c1c3d8df560d53f5c2ad5442c0401edf83.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        html, body {
            scroll-behavior: smooth;
        }
        .video-background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -10;
        }
        .video-background {
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
        
        .font-heading { font-family: 'Cinzel', serif; }
        .font-body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="font-body bg-stone-900 text-gray-200">

    <div class="video-background-container">
        <video autoplay muted loop playsinline class="video-background">
            <source src="https://res.cloudinary.com/dpebql3aj/video/upload/v1752031983/videoplayback_1_betwh0.webm" type="video/webm">
        </video>
    </div>
    
    <div class="relative min-h-screen bg-black/60 backdrop-blur-sm">

        <header class="absolute top-0 left-0 right-0 z-10">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <a href="#">
                    <h1 class="text-3xl font-bold text-wow-gold font-heading">WOWNATOR</h1>
                </a>
                
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-semibold transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-wow-gold text-stone-900 font-bold py-2 px-4 rounded-md hover:bg-yellow-400 transition">Registrar</a>
                </div>
            </nav>
        </header>

        <main>
            <section class="min-h-screen flex items-center justify-center text-center">
                <div class="max-w-3xl px-4">
                    <h2 class="text-5xl md:text-7xl font-black text-white font-heading uppercase tracking-wider" style="text-shadow: 0 0 15px rgba(250, 204, 21, 0.5);">Teste o seu Conhecimento</h2>
                    <p class="text-xl md:text-2xl text-wow-gold mt-4 font-semibold">O desafio diário para os heróis de Azeroth.</p>
                    <p class="mt-6 text-lg text-gray-300 max-w-2xl mx-auto">Adivinhe o personagem, a montaria, a zona e mais. Um novo desafio todos os dias. Você está à altura?</p>
                    <a href="{{ route('login') }}" class="mt-8 inline-block bg-wow-gold text-stone-900 font-bold py-4 px-8 rounded-lg text-lg uppercase hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300">
                        Jogar Agora
                    </a>
                </div>
            </section>

            <section id="modos-de-jogo" class="py-20 bg-stone-900/80">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h3 class="text-4xl font-bold text-white font-heading">Modos de Jogo</h3>
                        <p class="text-gray-400 mt-2">Cinco desafios únicos para testar a sua sabedoria.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8">
                        <div class="bg-stone-800 p-6 rounded-lg text-center border border-stone-700">
                            <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752033605/ExpansionIcon_WrathoftheLichKing_a7u9wp.png" class="h-20 w-20 mx-auto mb-4">
                            <h4 class="text-xl font-bold text-wow-gold">Personagem</h4>
                            <p class="text-gray-400 mt-2 text-sm">Adivinhe o personagem do dia com base nas suas características.</p>
                        </div>
                        
                        <div class="bg-stone-800 p-6 rounded-lg text-center border border-stone-700">
                            <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752032957/mount_ymq1qv.png" class="h-20 w-20 mx-auto mb-4">
                            <h4 class="text-xl font-bold text-wow-gold">Montaria</h4>
                            <p class="text-gray-400 mt-2 text-sm">Identifique a montaria através da sua imagem.</p>
                        </div>
                        
                        <div class="bg-stone-800 p-6 rounded-lg text-center border border-stone-700">
                            <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752032958/zone_yyc6cs.png" class="h-20 w-20 mx-auto mb-4">
                            <h4 class="text-xl font-bold text-wow-gold">Zona</h4>
                            <p class="text-gray-400 mt-2 text-sm">Reconheça a zona por uma paisagem icónica.</p>
                        </div>
                        
                        <div class="bg-stone-800 p-6 rounded-lg text-center border border-stone-700">
                            <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752032958/skill_rjtsbe.png" class="h-20 w-20 mx-auto mb-4">
                            <h4 class="text-xl font-bold text-wow-gold">Habilidade</h4>
                            <p class="text-gray-400 mt-2 text-sm">Adivinhe a habilidade pelo seu ícone.</p>
                        </div>
                        
                        <div class="bg-stone-800 p-6 rounded-lg text-center border border-stone-700">
                            <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752032957/quote_qwjgyy.png" class="h-20 w-20 mx-auto mb-4">
                            <h4 class="text-xl font-bold text-wow-gold">Citação</h4>
                            <p class="text-gray-400 mt-2 text-sm">Descubra quem proferiu a citação do dia.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="como-funciona" class="relative py-20 overflow-hidden">
                <div class="absolute inset-0 z-0">
                    <video autoplay muted loop playsinline class="video-background">
                        <source src="https://res.cloudinary.com/dpebql3aj/video/upload/v1752033206/videoplayback_2_idrwz8.webm" type="video/webm">
                    </video>
                    <div class="absolute inset-0 bg-black/70"></div>
                </div>
                
                <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h3 class="text-4xl font-bold text-white font-heading">Como Funciona?</h3>
                        <p class="text-gray-400 mt-2">Três passos simples para se tornar uma lenda.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                        
                        <div class="bg-stone-800/50 p-8 rounded-lg border border-stone-700 backdrop-blur-sm">
                            <div class="text-5xl font-black text-wow-gold font-heading">1</div>
                            <h4 class="text-2xl font-bold text-white mt-2 font-heading">Crie sua Conta</h4>
                            <p class="text-gray-400 mt-2">Junte-se à Horda ou à Aliança e prepare-se para o desafio diário.</p>
                        </div>
                        
                        <div class="bg-stone-800/50 p-8 rounded-lg border border-stone-700 backdrop-blur-sm">
                            <div class="text-5xl font-black text-wow-gold font-heading">2</div>
                            <h4 class="text-2xl font-bold text-white mt-2 font-heading">Acerte os Alvos</h4>
                            <p class="text-gray-400 mt-2">Use seu conhecimento para adivinhar os 5 desafios de cada dia.</p>
                        </div>
                        
                        <div class="bg-stone-800/50 p-8 rounded-lg border border-stone-700 backdrop-blur-sm">
                            <div class="text-5xl font-black text-wow-gold font-heading">3</div>
                            <h4 class="text-2xl font-bold text-white mt-2 font-heading">Suba no Ranking</h4>
                            <p class="text-gray-400 mt-2">Ganhe pontos e lute pela glória da sua facção no ranking global.</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
        
        <footer class="bg-stone-900 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} WOWNATOR. Todos os direitos reservados.</p>
                <p class="text-xs mt-1">World of Warcraft e Blizzard Entertainment são marcas comerciais ou marcas registadas da Blizzard Entertainment, Inc.</p>
            </div>
        </footer>
        
    </div>

</body>
</html>
