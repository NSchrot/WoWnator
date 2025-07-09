<x-admin-layout>
    <x-slot:title>
        WoWnator - Admin - Notificações Enviadas
    </x-slot:title>
    <div x-data="{ deleteModalOpen: false, deleteUrl: '', show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white font-heading">Notificações Enviadas</h1>
            <a href="{{ route('admin.notifications.create') }}" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Enviar Nova</a>
        </div>

        <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm rounded-lg shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-stone-700 text-left">
                    <tr>
                        <th class="px-6 py-3">Título</th>
                        <th class="px-6 py-3">Destinatário</th>
                        <th class="px-6 py-3">Data</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                    <tr class="hover:bg-stone-700/50 border-t border-stone-700">
                        <td class="px-6 py-4 font-semibold">{{ $notification->title }}</td>
                        <td class="px-6 py-4">{{ $notification->user->name ?? 'Todos' }}</td>
                        <td class="px-6 py-4">{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end items-center gap-2 text-sm">
                                <a href="{{ route('admin.notifications.show', $notification) }}" class="px-3 py-1 border border-orange-500 text-orange-400 rounded-md hover:bg-orange-500 hover:text-white transition font-semibold">Ver</a>
                                <button @click.prevent="deleteUrl = '{{ route('admin.notifications.destroy', $notification) }}'; deleteModalOpen = true" class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition font-semibold">Apagar</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $notifications->links() }}</div>

        <div x-show="deleteModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click.away="deleteModalOpen = false" x-cloak>
            <div class="bg-stone-800 rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-white">Confirmar Exclusão</h2>
                <p class="text-gray-400 mt-2">Tem a certeza de que deseja apagar esta notificação?</p>
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