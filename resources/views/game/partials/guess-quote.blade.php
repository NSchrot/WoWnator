<div class="p-4 mt-2 rounded-lg">
        <div class="mb-8 animate-fade-in">
            <div class="bg-stone-900/50 p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-bold text-center mb-4 text-wow-gold font-heading">Quem disse esta citação?</h3>
                <blockquote class="text-center">
                    <p class="text-2xl italic font-serif text-white">"{{ $challenge->quote->text }}"</p>
                </blockquote>
            </div>
        
            @if(!$hasGuessedCorrectly['quote'])
                <div class="text-center text-stone-400 mb-4">
                    Tentativas restantes: 
                    <span class="font-bold text-wow-gold">{{ 15 - $guesses['quote']->count() }}</span>
                </div>

                @php 
                    $quoteCharacterOptions = json_encode($allCharacters->map(fn($c) => ['id' => $c->id, 'name' => $c->name, 'image_url' => $c->image_url])); 
                    $guessedQuoteIds = json_encode($guessedIds['quote']); 
                @endphp
        
                <div x-data="{
                        searchTerm: '',
                        selectedId: null,
                        options: {{ $quoteCharacterOptions }},
                        guessedIds: {{ $guessedQuoteIds }},
                        open: false,
                        get filteredOptions() {
                            if (this.searchTerm === '') return [];
                            return this.options.filter(option => 
                                option.name.toLowerCase().includes(this.searchTerm.toLowerCase()) && 
                                !this.guessedIds.includes(option.id)
                            ).slice(0, 5);
                        },
                        selectOption(option) {
                            this.searchTerm = option.name;
                            this.selectedId = option.id;
                            this.open = false;
                        },
                        reset() {
                            this.searchTerm = '';
                            this.selectedId = null;
                            this.open = false;
                        },
                        positionDropdown() {
                            const input = this.$refs.searchInput;
                            const dropdown = document.getElementById('quote-dropdown-container');
                            if (!dropdown || !input) return;
        
                            const rect = input.getBoundingClientRect();
                            dropdown.style.left = `${rect.left}px`;
                            dropdown.style.top = `${rect.bottom + window.scrollY}px`;
                            dropdown.style.width = `${rect.width}px`;
                        }
                    }"
                     x-init="
                        $watch('open', isOpen => {
                            if (isOpen) {
                                $nextTick(() => positionDropdown());
                                window.addEventListener('scroll', positionDropdown, true);
                                window.addEventListener('resize', positionDropdown);
                            } else {
                                window.removeEventListener('scroll', positionDropdown, true);
                                window.removeEventListener('resize', positionDropdown);
                            }
                        });
                     "
                     x-on:click.outside="open = false"
                     class="relative max-w-sm mx-auto">
        
                    <form x-on:submit.prevent="if(selectedId) $el.submit()" action="{{ route('game.guess.quote') }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input type="hidden" name="tab" value="quote">
                        <input type="hidden" name="character_id" x-model="selectedId">
                        <x-text-input type="text" class="w-full" placeholder="Digite o nome de um personagem..."
                            x-ref="searchInput"
                            x-model="searchTerm"
                            @input.debounce.300ms="selectedId = null; open = true"
                            @focus="open = true"
                            @keydown.escape.prevent="reset()"
                            @keydown.down.prevent="$focus.wrap($refs.dropdown).next()" />
                        <x-primary-button x-bind:disabled="!selectedId">{{ __('Adivinhar') }}</x-primary-button>
                    </form>
        
                    <template x-teleport="body">
                        <div x-show="open" x-transition id="quote-dropdown-container" class="absolute mt-2 bg-stone-900 border border-stone-700 rounded-md shadow-xl max-h-60 overflow-y-auto" style="z-index: 9999;">
                            <template x-if="filteredOptions.length > 0">
                                <ul class="py-1" x-ref="dropdown">
                                    <template x-for="option in filteredOptions" :key="option.id">
                                        <li class="px-4 py-2 text-white cursor-pointer hover:bg-stone-700 transition-colors duration-150 flex items-center gap-3" tabindex="-1" @click="selectOption(option)" @keydown.enter.prevent="selectOption(option)">
                                            <img :src="option.image_url" :alt="option.name" class="w-10 h-10 rounded-md object-cover">
                                            <span x-text="option.name"></span>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                            <template x-if="searchTerm.length > 0 && filteredOptions.length === 0">
                                <div class="px-4 py-2 text-gray-400">Nenhum personagem encontrado.</div>
                            </template>
                        </div>
                    </template>
                </div>
            @else
                <div class="text-center p-4 bg-green-900/50 border border-green-700 rounded-lg animate-fade-in">
                    <p class="text-lg text-gray-200">
                        Você acertou na 
                        <span class="font-bold text-wow-gold">{{ $guesses['quote']->count() }}ª</span> tentativa!
                    </p>
                    <div class="flex flex-col items-center mt-2">
                        <img src="{{ $challenge->quote->character->splash_url }}" alt="{{ $challenge->quote->character->name }}" class="h-52 rounded-lg object-cover border-4 border-wow-gold mb-2" onerror="this.src='https://placehold.co/600x400/2d3748/ffffff?text=Personagem'; this.onerror=null;">
                        <p class="text-2xl font-bold text-white font-heading">{{ $challenge->quote->character->name }}</p>
                    </div>
                </div>
            @endif
        </div>
        
        @if($guesses['quote']->isNotEmpty())
            <div class="mt-8 space-y-3 max-w-md mx-auto">
                @foreach($guesses['quote']->reverse() as $guess)
                    <div class="p-3 rounded-lg shadow-md flex items-center text-white animate-fade-in {{ $guess->is_correct ? 'bg-green-600/80' : 'bg-red-800/80' }}">
                        @php $guessedCharacter = \App\Models\Character::find($guess->guess_id); @endphp
                        <img src="{{ $guessedCharacter->image_url }}" alt="{{ $guessedCharacter->name }}" class="h-12 w-12 rounded-full object-cover border-2 border-stone-700" onerror="this.style.display='none'">
                        <span class="ml-4 text-xl font-bold">{{ $guessedCharacter->name }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 flex justify-center items-center space-x-4 text-sm">
                <div class="flex items-center"><div class="w-5 h-5 bg-green-500 rounded-md mr-2"></div><span>Correto</span></div>
                <div class="flex items-center"><div class="w-5 h-5 bg-red-600 rounded-md mr-2"></div><span>Incorreto</span></div>
            </div>
        @endif
    </div>