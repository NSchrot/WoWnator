<nav x-data="{ open: false }" class="relative z-50 bg-stone-900/80 border-b border-stone-700 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('game.play') }}">
                        <h1 class="text-wow-gold text-2xl font-heading font-bold">WOWNATOR</h1>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('game.play')" :active="request()->routeIs('game.play')">
                        {{ __('Jogar') }}
                    </x-nav-link>
                    <x-nav-link :href="route('game.ranking')" :active="request()->routeIs('game.ranking')">
                        {{ __('Ranking') }}
                    </x-nav-link>
                    @if(Auth::user()->role_id == 1)
                        <x-nav-link :href="route('admin.characters.index')" :active="request()->routeIs('admin.*')">
                            {{ __('Admin') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
            <div class="relative" x-data="{ 
                    open: false, 
                    hasUnread: {{ isset($unreadNotifications) && $unreadNotifications->count() > 0 ? 'true' : 'false' }} 
                }">
                <button @click="
                    open = !open; 
                    if (open && hasUnread) {
                        fetch('{{ route('notifications.markAsRead') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                console.error('Falha ao marcar notificações como lidas. Status:', response.status);
                                return; 
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data && data.status === 'success') {
                                hasUnread = false;
                            }
                        })
                        .catch(error => {
                            console.error('Erro de rede ao marcar notificações:', error);
                        });
                    }
                " class="p-2 text-gray-400 hover:text-white focus:outline-none">
                    
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span x-show="hasUnread" class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-stone-800"></span>
                </button>

                <div x-show="open" 
                    @click.away="open = false" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-stone-800 rounded-md shadow-lg overflow-hidden z-20" 
                    x-cloak>
                    <div class="py-2">
                        <div class="px-4 py-2 font-bold text-white border-b border-stone-700">Notificações</div>
                        <div class="max-h-64 overflow-y-auto">
                            @forelse($unreadNotifications ?? [] as $notification)
                                <div class="px-4 py-2 border-b border-stone-700">
                                    <p class="font-bold text-gray-200">{{ $notification->title }}</p>
                                    <p class="text-sm text-gray-400">{{ $notification->message }}</p>
                                </div>
                            @empty
                                <p class="px-4 py-2 text-gray-400">Nenhuma notificação nova.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-400 bg-stone-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full object-cover">
                                <div>{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Meu Perfil') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.history')">
                            {{ __('Meu Histórico') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Terminar Sessão') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('game.play')" :active="request()->routeIs('game.play')">
                {{ __('Jogar') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('game.ranking')" :active="request()->routeIs('game.ranking')">
                {{ __('Ranking') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Terminar Sessão') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>