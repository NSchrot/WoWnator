<x-admin-layout>
    <x-slot:title>
            WoWnator - Admin - Editar Personagem
    </x-slot:title>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" 
             x-transition:enter="transition ease-out duration-500" 
             x-transition:enter-start="opacity-0 translate-y-5" 
             x-transition:enter-end="opacity-100 translate-y-0">
            
            <div class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
                <h1 class="text-2xl font-bold text-white mb-4 border-b border-stone-700 pb-4 font-heading">Editar Personagem: {{ $character->name }}</h1>
                <form action="{{ route('admin.characters.update', $character) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    @include('admin.characters.partials.form', ['character' => $character])
                    <div class="mt-6 flex items-center gap-4">
                        <button type="submit" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Atualizar Personagem</button>
                        <a href="{{ url()->previous() }}" class="bg-stone-600 text-white font-bold py-2 px-4 rounded hover:bg-stone-500 transition">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>