<x-admin-layout>
    @php
        if (!function_exists('getComparisonClass')) {
            function getComparisonClass($guessValue, $correctValue) {
                return $guessValue == $correctValue ? 'bg-green-500' : 'bg-red-600';
            }
        }
        $translations = [
            'character' => 'Personagem', 'mount' => 'Montaria',
            'zone' => 'Zona', 'skill' => 'Habilidade', 'quote' => 'Citação',
        ];
    @endphp

    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
            <div class="flex items-center gap-4 border-b border-stone-700 pb-4">
                <img src="{{ $user->profile_photo_url }}" class="h-24 w-24 rounded-full object-cover">
                <div>
                    <h1 class="text-3xl font-bold text-white font-heading">{{ $user->name }}</h1>
                    <p class="text-lg text-green-400">{{ $user->email }}</p>
                    <p class="text-md text-stone-300">Membro da <span class="font-bold {{ $user->faction === 'Horde' ? 'text-red-500' : 'text-blue-500' }}">{{ $user->faction }}</span> com <span class="font-bold text-wow-gold">{{ number_format($user->rating) }}</span> de rating.</p>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-bold text-white mb-4">Histórico de Palpites</h2>
                <div class="space-y-6">
                    @forelse($groupedGuesses as $date => $dailyGuesses)
                        <div x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }" class="bg-stone-900/50 rounded-lg">
                            <div @click="open = !open" class="p-4 cursor-pointer flex justify-between items-center border-b border-stone-700">
                                <h3 class="text-lg font-bold text-wow-gold">
                                    Desafios de {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                                </h3>
                                <svg class="w-6 h-6 text-gray-400 transition-transform" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div x-show="open" x-transition class="p-4 space-y-8">
                                @foreach($dailyGuesses->groupBy('type') as $type => $guessesForType)
                                    <div>
                                        <h4 class="text-lg font-semibold text-wow-gold mb-4 text-center border-b-2 border-wow-gold/20 pb-2">
                                            {{ $translations[$type] ?? ucfirst($type) }}
                                        </h4>
                                        <div class="space-y-2 flex flex-col items-center">
                                            @foreach($guessesForType as $guess)
                                                @if($guess->type === 'character' && $guess->details)
                                                    @include('profile.history.partials.character-guess', ['guess' => $guess])
                                                @elseif($guess->type === 'mount' && $guess->details)
                                                    @include('profile.history.partials.mount-guess', ['guess' => $guess])
                                                @elseif($guess->type === 'skill' && $guess->details)
                                                    @include('profile.history.partials.skill-guess', ['guess' => $guess])
                                                @elseif($guess->type === 'zone' && $guess->details)
                                                    @include('profile.history.partials.zone-guess', ['guess' => $guess])
                                                @elseif($guess->type === 'quote' && $guess->details)
                                                    @include('profile.history.partials.quote-guess', ['guess' => $guess])
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400">Este utilizador ainda não fez nenhum palpite.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
