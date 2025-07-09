<x-admin-layout>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/2">
                    <img src="{{ $zone->image_url }}" alt="{{ $zone->name }}" class="rounded-lg w-full object-cover">
                </div>
                <div class="md:w-1/2 space-y-4">
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $zone->name }}</h1>
                        <p class="text-lg text-green-400">{{ $zone->continent }}</p>
                    </div>
                    <div class="border-t border-stone-700 my-4"></div>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.zones.edit', $zone) }}" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Editar</a>
                        <a href="{{ route('admin.zones.index') }}" class="bg-stone-600 text-white font-bold py-2 px-4 rounded hover:bg-stone-500 transition">Voltar à Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>