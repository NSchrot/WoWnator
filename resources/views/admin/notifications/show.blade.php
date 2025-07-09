<x-admin-layout>
    <x-slot:title>
        WoWnator - Admin - Notificação: {{ $notification->title }}
    </x-slot:title>
    <div x-data="{ show: false }" x-init="$nextTick(() => show = true)">
        <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-5" x-transition:enter-end="opacity-100 translate-y-0" class="bg-stone-800/70 backdrop-blur-sm p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-white mb-2 font-heading">{{ $notification->title }}</h1>
            <p class="text-sm text-stone-400 mb-4 border-b border-stone-700 pb-4">
                Enviado para: <span class="font-semibold text-green-400">{{ $notification->user->name ?? 'Todos os Utilizadores' }}</span> em {{ $notification->created_at->format('d/m/Y \à\s H:i') }}
            </p>
            <div class="prose prose-invert max-w-none text-gray-300">
                {{ $notification->message }}
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.notifications.index') }}" class="bg-stone-600 text-white font-bold py-2 px-4 rounded hover:bg-stone-500 transition">Voltar à Lista</a>
            </div>
        </div>
    </div>
</x-admin-layout>