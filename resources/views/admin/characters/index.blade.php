<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Personagens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('admin.characters.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Adicionar Personagem
                        </a>
                    </div>
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 border border-green-400 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nome</th>
                                    <th scope="col" class="px-6 py-3">Gênero</th>
                                    <th scope="col" class="px-6 py-3">Classe</th>
                                    <th scope="col" class="px-6 py-3">Raça</th>
                                    <th scope="col" class="px-6 py-3">Facção</th>
                                    <th scope="col" class="px-6 py-3">Reino</th>
                                    <th scope="col" class="px-6 py-3">Expansão</th>
                                    <th scope="col" class="px-6 py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($characters as $character)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $character->name }}
                                        </th>
                                        <td class="px-6 py-4">{{ $character->gender }}</td>
                                        <td class="px-6 py-4">{{ $character->class }}</td>
                                        <td class="px-6 py-4">{{ $character->race }}</td>
                                        <td class="px-6 py-4">{{ $character->faction }}</td>
                                        <td class="px-6 py-4">{{ $character->realm }}</td>
                                        <td class="px-6 py-4">{{ $character->xpac }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.characters.show', $character) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                                <a href="{{ route('admin.characters.edit', $character) }}" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Editar</a>
                                                <form action="{{ route('admin.characters.destroy', $character) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este personagem?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="8" class="px-6 py-4 text-center">
                                            Nenhum personagem encontrado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $characters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
