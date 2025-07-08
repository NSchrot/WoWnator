<div class="mb-8 animate-fade-in">
    <h3 class="text-2xl font-bold text-center mb-4 font-heading text-wow-gold">Adivinhe o Personagem</h3>

    @if(!$hasGuessedCorrectly['character'])
        @php
            $characterOptions = json_encode($allCharacters->map(fn($c) => ['id' => $c->id, 'name' => $c->name]));
            $guessedCharacterIds = json_encode($guessedIds['character']);
        @endphp

        <div x-data="{
                searchTerm: '',
                selectedId: null,
                options: {{ $characterOptions }},
                guessedIds: {{ $guessedCharacterIds }},
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
                    const dropdown = document.getElementById('character-dropdown-container');
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
                        window.addEventListener('scroll', positionDropdown);
                        window.addEventListener('resize', positionDropdown);
                    } else {
                        window.removeEventListener('scroll', positionDropdown);
                        window.removeEventListener('resize', positionDropdown);
                    }
                });
             "
             x-on:click.outside="open = false"
             class="relative max-w-sm mx-auto">

            <form x-on:submit.prevent="if(selectedId) $el.submit()" action="{{ route('game.guess.character') }}" method="POST" class="flex items-center gap-2">
                @csrf
                <input type="hidden" name="character_id" x-model="selectedId">

                <x-text-input type="text" class="w-full" placeholder="Digite o nome de um personagem..."
                    x-ref="searchInput"
                    x-model="searchTerm"
                    @input.debounce.300ms="selectedId = null; open = true"
                    @focus="open = true"
                    @keydown.escape.prevent="reset()"
                    @keydown.down.prevent="$focus.wrap($refs.dropdown).next()" />

                <x-primary-button x-bind:disabled="!selectedId">Adivinhar</x-primary-button>
            </form>

            <template x-teleport="body">
                <div x-show="open"
                     x-transition
                     id="character-dropdown-container"
                     class="absolute mt-2 bg-stone-900 border border-stone-700 rounded-md shadow-xl max-h-60 overflow-y-auto"
                     style="z-index: 9999;">
                    <template x-if="filteredOptions.length > 0">
                        <ul class="py-1" x-ref="dropdown">
                            <template x-for="option in filteredOptions" :key="option.id">
                                <li class="px-4 py-2 text-white cursor-pointer hover:bg-stone-700 transition-colors duration-150"
                                    tabindex="-1"
                                    x-text="option.name"
                                    @click="selectOption(option)"
                                    @keydown.enter.prevent="selectOption(option)">
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
        <div class="text-center p-4 bg-green-900/50 border border-green-700 rounded-lg max-w-md mx-auto animate-fade-in">
            <p class="text-lg text-gray-200">Você já acertou o personagem de hoje!</p>
            <div class="flex flex-col items-center mt-2">
                <img src="{{ $challenge->character->splash_url }}" alt="{{ $challenge->character->name }}" class="h-52 rounded-lg object-cover border-4 border-wow-gold">
                <p class="text-2xl font-bold text-white mt-2 font-heading">{{ $challenge->character->name }}</p>
            </div>
        </div>
    @endif
</div>

@if($guesses['character']->isNotEmpty())
    <div class="mt-8 space-y-2">
        <div class="hidden md:grid md:grid-cols-8 gap-2 text-center font-bold text-xs uppercase text-stone-300"><div class="p-2"></div><div class="p-2">Nome</div><div class="p-2">Gênero</div><div class="p-2">Classe</div><div class="p-2">Raça</div><div class="p-2">Facção</div><div class="p-2">Expansão</div><div class="p-2">Reino</div></div>
        @foreach($guesses['character']->reverse() as $guess)
            @php $correctCharacter = $challenge->character; $guessedCharacter = $guess->details; @endphp
            <div class="grid grid-cols-2 md:grid-cols-8 gap-1 md:gap-2 text-white text-center text-sm rounded-lg animate-fade-in">
                <div class="hidden md:flex items-center justify-center p-1 bg-stone-700 rounded-md"><img src="{{ $guessedCharacter->image_url }}" alt="{{ $guessedCharacter->name }}" class="h-full w-full object-cover rounded-md" onerror="this.style.display='none'"></div>
                <div class="col-span-2 md:col-span-1 flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedCharacter->id, $correctCharacter->id) }}"><img src="{{ $guessedCharacter->image_url }}" alt="{{ $guessedCharacter->name }}" class="h-10 w-10 object-cover rounded-md inline-block mr-2 md:hidden" onerror="this.style.display='none'"><span class="font-bold">{{ $guessedCharacter->name }}</span></div>
                <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedCharacter->gender, $correctCharacter->gender) }}">{{ $guessedCharacter->gender }}</div>
                <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedCharacter->class, $correctCharacter->class) }}">{{ $guessedCharacter->class }}</div>
                <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedCharacter->race, $correctCharacter->race) }}">{{ $guessedCharacter->race }}</div>
                <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedCharacter->faction, $correctCharacter->faction) }}">{{ $guessedCharacter->faction }}</div>
                <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedCharacter->xpac, $correctCharacter->xpac) }}">{{ $guessedCharacter->xpac }}</div>
                <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedCharacter->realm, $correctCharacter->realm) }}">{{ $guessedCharacter->realm }}</div>
            </div>
        @endforeach
    </div>
    <div class="mt-8 flex justify-center items-center space-x-4 text-sm"><div class="flex items-center"><div class="w-5 h-5 bg-green-500 rounded-md mr-2"></div><span>Correto</span></div><div class="flex items-center"><div class="w-5 h-5 bg-red-600 rounded-md mr-2"></div><span>Incorreto</span></div></div>
@endif
