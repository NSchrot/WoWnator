<div class="p-4 mt-2 rounded-lg">
        <div class="mb-8 animate-fade-in">
            <div class="bg-stone-900/50 p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-bold text-center mb-4 text-wow-gold font-heading">A que zona pertence esta imagem?</h3>
                <div class="flex justify-center">
                    <img src="{{ $challenge->zone->image_url }}" alt="Imagem da zona misteriosa" class="rounded-lg max-h-64 shadow-lg border-2 border-stone-700" onerror="this.src='https://placehold.co/600x400/2d3748/ffffff?text=Zona+Misteriosa'; this.onerror=null;">
                </div>
            </div>
        
            @if(!$hasGuessedCorrectly['zone'])
                <div class="text-center text-stone-400 mb-4">
                    Tentativas restantes: 
                    <span class="font-bold text-wow-gold">{{ 15 - $guesses['zone']->count() }}</span>
                </div>
        
                @php 
                    $zoneOptions = json_encode($allZones->map(fn($z) => ['id' => $z->id, 'name' => $z->name, 'image_url' => $z->image_url])); 
                    $guessedZoneIds = json_encode($guessedIds['zone']); 
                @endphp
        
                <div x-data="{
                        searchTerm: '', selectedId: null, options: {{ $zoneOptions }}, guessedIds: {{ $guessedZoneIds }}, open: false,
                        get filteredOptions() {
                            if (this.searchTerm === '') return [];
                            return this.options.filter(option => 
                                option.name.toLowerCase().includes(this.searchTerm.toLowerCase()) && 
                                !this.guessedIds.includes(option.id)
                            ).slice(0, 5);
                        },
                        selectOption(option) { this.searchTerm = option.name; this.selectedId = option.id; this.open = false; },
                        reset() { this.searchTerm = ''; this.selectedId = null; this.open = false; },
                        positionDropdown() {
                            const input = this.$refs.searchInput;
                            const dropdown = document.getElementById('zone-dropdown-container');
                            if (!dropdown || !input) return;
                            const rect = input.getBoundingClientRect();
                            dropdown.style.left = `${rect.left}px`;
                            dropdown.style.top = `${rect.bottom + window.scrollY}px`;
                            dropdown.style.width = `${rect.width}px`;
                        }
                    }"
                     x-init="$watch('open', isOpen => { if (isOpen) { $nextTick(() => positionDropdown()); window.addEventListener('scroll', positionDropdown, true); window.addEventListener('resize', positionDropdown); } else { window.removeEventListener('scroll', positionDropdown, true); window.removeEventListener('resize', positionDropdown); } });"
                     x-on:click.outside="open = false"
                     class="relative max-w-sm mx-auto">
        
                    <form x-on:submit.prevent="if(selectedId) $el.submit()" action="{{ route('game.guess.zone') }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input type="hidden" name="tab" value="zone">
                        <input type="hidden" name="zone_id" x-model="selectedId">
                        <x-text-input type="text" class="w-full" placeholder="Digite o nome de uma zona..."
                            x-ref="searchInput" x-model="searchTerm"
                            @input.debounce.300ms="selectedId = null; open = true"
                            @focus="open = true" @keydown.escape.prevent="reset()"
                            @keydown.down.prevent="$focus.wrap($refs.dropdown).next()" />
                        <x-primary-button x-bind:disabled="!selectedId">{{ __('Adivinhar') }}</x-primary-button>
                    </form>
        
                    <template x-teleport="body">
                        <div x-show="open" x-transition id="zone-dropdown-container" class="absolute mt-2 bg-stone-900 border border-stone-700 rounded-md shadow-xl max-h-60 overflow-y-auto" style="z-index: 9999;">
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
                                <div class="px-4 py-2 text-gray-400">Nenhuma zona encontrada.</div>
                            </template>
                        </div>
                    </template>
                </div>
            @else
                <div class="text-center p-4 bg-green-900/50 border border-green-700 rounded-lg animate-fade-in">
                    <p class="text-lg text-gray-200">Você acertou na <span class="font-bold text-wow-gold">{{ $guesses['zone']->count() }}ª</span> tentativa!</p>
                    <p class="text-2xl font-bold text-white font-heading mt-2">{{ $challenge->zone->name }}</p>
                </div>
            @endif
        </div>
        
        @if($guesses['zone']->isNotEmpty())
            <div class="mt-8 space-y-2">
                <div class="hidden md:grid md:grid-cols-3 gap-2 text-center font-bold text-xs uppercase text-stone-300">
                    <div class="p-2"></div>
                    <div class="p-2">Zona</div>
                    <div class="p-2">Continente</div>
                </div>
                @foreach($guesses['zone']->reverse() as $guess)
                    @php 
                        $correctZone = $challenge->zone;
                        $guessedZone = $guess->details; 
                    @endphp
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-2 text-white text-center text-sm rounded-lg animate-fade-in">
                        <div class="hidden md:flex items-center justify-center p-1 bg-stone-700 rounded-md">
                            <img src="{{ $guessedZone->image_url ?? '' }}" alt="{{ $guessedZone->name ?? '' }}" class="h-full w-full object-cover rounded-md" onerror="this.style.display='none'">
                        </div>
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedZone->id, $correctZone->id) }}">
                            <img src="{{ $guessedZone->image_url ?? '' }}" alt="{{ $guessedZone->name ?? '' }}" class="h-10 w-10 object-cover rounded-md inline-block mr-2 md:hidden" onerror="this.style.display='none'">
                            <span class="font-bold">{{ $guessedZone->name }}</span>
                        </div>
                        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessedZone->continent, $correctZone->continent) }}">{{ $guessedZone->continent }}</div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 flex justify-center items-center space-x-4 text-sm">
                <div class="flex items-center"><div class="w-5 h-5 bg-green-500 rounded-md mr-2"></div><span>Correto</span></div>
                <div class="flex items-center"><div class="w-5 h-5 bg-red-600 rounded-md mr-2"></div><span>Incorreto</span></div>
            </div>
        @endif
    </div>