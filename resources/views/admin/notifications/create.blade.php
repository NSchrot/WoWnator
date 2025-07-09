<x-admin-layout>
    <x-slot:title>
            WoWnator - Admin - Criar Notificação
    </x-slot:title>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
                <h1 class="text-2xl font-bold text-white mb-4 border-b border-stone-700 pb-4 font-heading">Enviar Notificação</h1>
                <form action="{{ route('admin.notifications.store') }}" method="POST" class="mt-4 space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="user_id" value="Destinatário" />
                        <select name="user_id" id="user_id" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500 rounded-md shadow-sm text-gray-300">
                            <option value="all">Todos os Utilizadores</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="title" value="Título" />
                        <x-text-input id="title" name="title" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" required />
                    </div>
                    <div>
                        <x-input-label for="message" value="Mensagem" />
                        <textarea id="message" name="message" rows="5" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500 rounded-md shadow-sm text-gray-300" required></textarea>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-500 transition">Enviar Notificação</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>