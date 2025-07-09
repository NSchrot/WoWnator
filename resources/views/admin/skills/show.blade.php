<x-admin-layout>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/4 flex justify-center">
                    <img src="{{ $skill->image_url }}" alt="{{ $skill->name }}" class="rounded-lg h-40 w-40 object-cover border-4 border-stone-700">
                </div>
                <div class="md:w-3/4 space-y-4">
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $skill->name }}</h1>
                        <p class="text-lg text-green-400">{{ $skill->class }}</p>
                    </div>
                    <div class="border-t border-stone-700 my-4"></div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div><p class="text-stone-400">Tipo</p><p class="font-semibold">{{ $skill->type ?? 'N/A' }}</p></div>
                        <div><p class="text-stone-400">Raça</p><p class="font-semibold">{{ $skill->race ?? 'N/A' }}</p></div>
                        <div><p class="text-stone-400">Expansão</p><p class="font-semibold">{{ $skill->xpac ?? 'N/A' }}</p></div>
                    </div>
                    <div>
                        <p class="text-stone-400">Descrição</p>
                        <p class="font-semibold">{{ $skill->description }}</p>
                    </div>
                    <div class="border-t border-stone-700 my-4"></div>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Editar</a>
                        <a href="{{ route('admin.skills.index') }}" class="bg-stone-600 text-white font-bold py-2 px-4 rounded hover:bg-stone-500 transition">Voltar à Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>