<x-admin-layout>
    <x-slot:title>
        WoWnator - Admin - Jogadores
    </x-slot:title>
    <div x-data="{ deleteModalOpen: false, deleteUrl: '', show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white font-heading">Jogadores</h1>
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="flex">
                    <x-text-input name="search" class="!bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" placeholder="Pesquisar por nome ou email..." value="{{ request('search') }}" />
                    <button type="submit" class="ml-2 bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Pesquisar</button>
                </div>
            </form>
        </div>

        <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-stone-700 text-left">
                    <tr>
                        <th class="px-6 py-3">Nome</th>
                        <th class="px-6 py-3">Facção</th>
                        <th class="px-6 py-3">Rating</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-stone-700/50 border-t border-stone-700">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <img src="{{ $user->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">{{ $user->faction }}</td>
                        <td class="px-6 py-4 font-bold text-wow-gold">{{ number_format($user->rating) }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.users.show', $user) }}" class="px-3 py-1 border border-orange-500 text-orange-400 rounded-md hover:bg-orange-500 hover:text-white transition font-semibold">Ver Desempenho</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>