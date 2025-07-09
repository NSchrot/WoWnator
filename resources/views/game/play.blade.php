<x-app-layout>
    @php
        if (!function_exists('getComparisonClass')) {
            function getComparisonClass($guessValue, $correctValue) {
                return $guessValue == $correctValue ? 'bg-green-500' : 'bg-red-600';
            }
        }
    @endphp

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8" 
             x-data="{ activeTab: window.location.hash ? window.location.hash.substring(1) : 'character' }"
             x-init="$watch('activeTab', value => window.location.hash = value)">
            
            <div class="rounded-lg bg-stone-700 p-2 border-2 border-solid border-t-stone-500 border-l-stone-500 border-b-stone-900 border-r-stone-900 shadow-lg">
                <div class="bg-stone-800/95 rounded-sm backdrop-blur-sm">
                    <div class="p-6 text-gray-200">

                        @if(isset($noChallenge))
                            <h3 class="text-lg font-bold text-center">O desafio de hoje ainda não foi gerado. Volte mais tarde!</h3>
                        @else
                            <div class="border-b border-stone-700 mb-4">
                                <nav class="-mb-px flex justify-center space-x-4 md:space-x-8" aria-label="Tabs">
                                    <a href="#character" @click="activeTab = 'character'" :class="{ 'border-wow-gold text-wow-gold': activeTab === 'character', 'border-transparent text-stone-400 hover:text-stone-200 hover:border-stone-500': activeTab !== 'character' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">Personagem</a>
                                    <a href="#zone" @click="activeTab = 'zone'" :class="{ 'border-wow-gold text-wow-gold': activeTab === 'zone', 'border-transparent text-stone-400 hover:text-stone-200 hover:border-stone-500': activeTab !== 'zone' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">Zona</a>
                                    <a href="#mount" @click="activeTab = 'mount'" :class="{ 'border-wow-gold text-wow-gold': activeTab === 'mount', 'border-transparent text-stone-400 hover:text-stone-200 hover:border-stone-500': activeTab !== 'mount' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">Montaria</a>
                                    <a href="#skill" @click="activeTab = 'skill'" :class="{ 'border-wow-gold text-wow-gold': activeTab === 'skill', 'border-transparent text-stone-400 hover:text-stone-200 hover:border-stone-500': activeTab !== 'skill' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">Habilidade</a>
                                    <a href="#quote" @click="activeTab = 'quote'" :class="{ 'border-wow-gold text-wow-gold': activeTab === 'quote', 'border-transparent text-stone-400 hover:text-stone-200 hover:border-stone-500': activeTab !== 'quote' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">Citação</a>
                                </nav>
                            </div>

                            @if(session('feedback'))
                                <div x-data="{
                                        show: false,
                                        feedback: {{ json_encode(session('feedback')) }}
                                    }"
                                     x-init="
                                        show = (feedback.type === activeTab);
                                        $watch('activeTab', (value) => {
                                            show = (feedback.type === value);
                                        });
                                     "
                                     x-show="show"
                                     x-transition
                                     class="mb-4 p-4 rounded-lg flex justify-between items-center"
                                     :class="{
                                        'bg-green-900/50 text-green-300 border border-green-700': feedback.status === 'success',
                                        'bg-red-900/50 text-red-300 border border-red-700': feedback.status === 'error'
                                     }">
                                    
                                    <span x-text="feedback.message"></span>
                                    
                                    <button @click="show = false" class="text-xl leading-none text-gray-300 hover:text-white">&times;</button>
                                </div>
                            @endif

                            <div x-show="activeTab === 'character'">@include('game.partials.guess-character')</div>
                            <div x-show="activeTab === 'zone'">@include('game.partials.guess-zone')</div>
                            <div x-show="activeTab === 'mount'">@include('game.partials.guess-mount')</div>
                            <div x-show="activeTab === 'skill'">@include('game.partials.guess-skill')</div>
                            <div x-show="activeTab === 'quote'">@include('game.partials.guess-quote')</div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
