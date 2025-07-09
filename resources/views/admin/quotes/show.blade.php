<x-admin-layout>
    <x-slot:title>
        WoWnator - Admin - Citação: {{ $quote->character->name }}
    </x-slot:title>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3">
                    <img src="{{ $quote->character->splash_url }}" alt="{{ $quote->character->name }}" class="rounded-lg w-full object-cover">
                </div>
                <div class="md:w-2/3 space-y-4">
                    <div>
                        <p class="text-stone-400">Citação de:</p>
                        <h1 class="text-3xl font-bold text-white">{{ $quote->character->name }}</h1>
                    </div>
                    <blockquote class="border-l-4 border-green-500 pl-4">
                        <p class="text-xl italic text-gray-300">"{{ $quote->text }}"</p>
                    </blockquote>
                    <div class="border-t border-stone-700 my-4"></div>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.quotes.edit', $quote) }}" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Editar</a>
                        <a href="{{ route('admin.quotes.index') }}" class="bg-stone-600 text-white font-bold py-2 px-4 rounded hover:bg-stone-500 transition">Voltar à Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>