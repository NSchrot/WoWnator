<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-bold text-2xl text-wow-gold leading-tight">
            {{ __('Classificação das Facções') }}
        </h2>
    </x-slot>

    <div class="py-12" 
         x-data="{ show: false }" 
         x-init="
            const animate = () => {
                show = false;
                $nextTick(() => show = true);
            };
            animate();
            document.addEventListener('turbo:load', animate);
         ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div 
                class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 mb-12 transition-all duration-700"
                x-show="show" 
                x-transition:enter.duration.700ms>

                <div class="bg-red-900/80 p-6 rounded-lg border-2 border-red-700 text-center shadow-lg">
                    <h3 class="text-3xl font-bold text-white font-heading">HORDA</h3>
                    <p class="text-5xl font-bold text-red-300 mt-2">{{ number_format($hordeScore) }}</p>
                    <p class="text-red-400">Pontos Totais</p>
                </div>

                <div class="text-center">
                    <p class="text-6xl font-black text-stone-400 font-heading">VS</p>
                </div>

                <div class="bg-blue-900/80 p-6 rounded-lg border-2 border-blue-700 text-center shadow-lg">
                    <h3 class="text-3xl font-bold text-white font-heading">ALIANÇA</h3>
                    <p class="text-5xl font-bold text-blue-300 mt-2">{{ number_format($allianceScore) }}</p>
                    <p class="text-blue-400">Pontos Totais</p>
                </div>
            </div>

            <div x-show="show" x-transition:enter.delay.100ms.duration.700ms class="mb-12">
                <h3 class="text-xl font-bold text-center text-white mb-3 font-heading">Guerra das Facções</h3>
                <div class="flex w-full h-8 bg-stone-900 rounded-full overflow-hidden border-2 border-stone-600 shadow-lg">
                    <div class="flex items-center justify-center h-full bg-red-600 text-white font-bold text-sm transition-all duration-500" style="width: {{ $hordePercentage }}%;">
                       @if($hordePercentage > 10) {{ $hordePercentage }}% @endif
                    </div>
                    <div class="flex items-center justify-center h-full bg-blue-600 text-white font-bold text-sm transition-all duration-500" style="width: {{ $alliancePercentage }}%;">
                       @if($alliancePercentage > 10) {{ $alliancePercentage }}% @endif
                    </div>
                </div>
                <div class="text-center mt-2 text-lg font-semibold">
                    @if($hordeScore > $allianceScore)
                        <p class="text-red-500">A Horda está a dominar!</p>
                    @elseif($allianceScore > $hordeScore)
                        <p class="text-blue-500">A Aliança está na frente!</p>
                    @else
                        <p class="text-stone-400">A batalha está empatada!</p>
                    @endif
                </div>
            </div>
            
            <div 
                class="grid grid-cols-1 lg:grid-cols-2 gap-8 transition-all duration-700"
                x-show="show" 
                x-transition:enter.delay.200ms.duration.700ms>
                
                <div>
                    <h3 class="text-2xl font-bold text-red-500 mb-4 font-heading flex items-center gap-3">
                        <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752001391/INV_Jewelry_TrinketPVP_02_clxk6j.png" class="h-10">
                        Melhores da Horda
                    </h3>
                    <div class="bg-stone-800/70 rounded-lg shadow-md overflow-hidden">
                        <ul class="divide-y divide-stone-700">
                            @forelse($hordePlayers as $index => $player)
                                <li class="p-4 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <span class="text-lg font-bold text-stone-400 w-8 text-right">{{ $index + 1 }}.</span>
                                        <img src="{{ $player->profile_photo_url }}" alt="{{ $player->name }}" class="h-10 w-10 rounded-full object-cover">
                                        <span class="text-white font-semibold">{{ $player->name }}</span>
                                    </div>
                                    <span class="font-bold text-lg text-wow-gold">{{ number_format($player->rating) }} pts</span>
                                </li>
                            @empty
                                <li class="p-4 text-center text-stone-400">Nenhum guerreiro da Horda no ranking ainda.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-blue-500 mb-4 font-heading flex items-center gap-3">
                        <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752001390/INV_Jewelry_TrinketPVP_01_mbsoj2.png" class="h-10">
                        Melhores da Aliança
                    </h3>
                    <div class="bg-stone-800/70 rounded-lg shadow-md overflow-hidden">
                        <ul class="divide-y divide-stone-700">
                             @forelse($alliancePlayers as $index => $player)
                                <li class="p-4 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <span class="text-lg font-bold text-stone-400 w-8 text-right">{{ $index + 1 }}.</span>
                                        <img src="{{ $player->profile_photo_url }}" alt="{{ $player->name }}" class="h-10 w-10 rounded-full object-cover">
                                        <span class="text-white font-semibold">{{ $player->name }}</span>
                                    </div>
                                    <span class="font-bold text-lg text-wow-gold">{{ number_format($player->rating) }} pts</span>
                                </li>
                            @empty
                                <li class="p-4 text-center text-stone-400">Nenhum herói da Aliança no ranking ainda.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>