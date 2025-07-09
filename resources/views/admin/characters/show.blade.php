<x-admin-layout>
    <x-slot:title>
            WoWnator - Admin - Personagem: {{ $character->name }}
    </x-slot:title>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" 
             x-transition:enter="transition ease-out duration-500" 
             x-transition:enter-start="opacity-0 translate-y-5" 
             x-transition:enter-end="opacity-100 translate-y-0" 
             class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
            <div class="flex flex-col md:flex-row gap-6">
                
                <div class="md:w-1/3">
                    <img src="{{ $character->splash_url }}" alt="{{ $character->name }}" class="rounded-lg w-full object-cover">
                </div>

                <div class="md:w-2/3 space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-white">{{ $character->name }}</h1>
                            <p class="text-lg text-wow-gold">{{ $character->race }} {{ $character->class }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $character->faction === 'Horde' ? 'bg-red-800 text-red-200' : 'bg-blue-800 text-blue-200' }}">
                                {{ $character->faction }}
                            </span>
                        </div>
                    </div>

                    <div class="border-t border-stone-700 my-4"></div>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-stone-400">Gênero</p>
                            <p class="font-semibold">{{ $character->gender }}</p>
                        </div>
                        <div>
                            <p class="text-stone-400">Reino</p>
                            <p class="font-semibold">{{ $character->realm }}</p>
                        </div>
                        <div>
                            <p class="text-stone-400">Expansão de Origem</p>
                            <p class="font-semibold">{{ $character->xpac }}</p>
                        </div>
                    </div>

                    <div class="border-t border-stone-700 my-4"></div>
                        <a href="{{ route('admin.characters.edit', $character) }}" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Editar</a>
                        <a href="{{ route('admin.characters.index') }}" class="bg-stone-600 text-white font-bold py-2 px-4 rounded hover:bg-stone-500 transition">Voltar à Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
