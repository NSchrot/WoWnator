<x-admin-layout>
    <div x-data="{ deleteModalOpen: false, deleteUrl: '', show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white font-heading">Personagens</h1>
            <a href="{{ route('admin.characters.create') }}" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Adicionar Personagem</a>
        </div>
        <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-stone-700 text-left">
                    <tr>
                        <th class="px-6 py-3">Nome</th>
                        <th class="px-6 py-3">Raça</th>
                        <th class="px-6 py-3">Classe</th>
                        <th class="px-6 py-3">Facção</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($characters as $character)
                    <tr class="hover:bg-stone-700/50 border-t border-stone-700">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <img src="{{ $character->image_url }}" class="h-10 w-10 rounded-full object-cover">
                            {{ $character->name }}
                        </td>
                        <td class="px-6 py-4">{{ $character->race }}</td>
                        <td class="px-6 py-4">{{ $character->class }}</td>
                        <td class="px-6 py-4">{{ $character->faction }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end items-center gap-2 text-sm">
                                <a href="{{ route('admin.characters.show', $character) }}" class="px-3 py-1 border border-green-500 text-green-400 rounded-md hover:bg-green-500 hover:text-stone-900 transition font-semibold">Ver</a>
                                <a href="{{ route('admin.characters.edit', $character) }}" class="px-3 py-1 border border-blue-500 text-blue-400 rounded-md hover:bg-blue-500 hover:text-white transition font-semibold">Editar</a>
                                <button @click.prevent="deleteUrl = '{{ route('admin.characters.destroy', $character) }}'; deleteModalOpen = true" class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition font-semibold">Apagar</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="deleteModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click.away="deleteModalOpen = false" x-cloak>
            <div class="bg-stone-800 rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-white">Confirmar Exclusão</h2>
                <p class="text-gray-400 mt-2">Tem a certeza de que deseja apagar este personagem? Esta ação não pode ser revertida.</p>
                <div class="mt-6 flex justify-end gap-4">
                    <form :action="deleteUrl" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 rounded hover:bg-red-500 transition">Sim, Apagar</button>
                    </form>
                    <button @click="deleteModalOpen = false" class="bg-stone-600 text-white font-bold py-2 px-4 rounded hover:bg-stone-500 transition">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>