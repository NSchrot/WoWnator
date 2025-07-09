<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
    
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-wow-gold shadow-sm focus:ring-wow-gold dark:focus:ring-wow-gold dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Lembrar-me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-white-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-wow-gold" href="{{ route('password.request') }}">
                    {{ __('Esqueceu-se da sua senha?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('register') }}" class="text-white bg-yellow-600 hover:bg-yellow-500 font-semibold py-2 px-4 rounded-md transition-colors duration-200 text-xs uppercase tracking-widest">
                {{ __('Registrar') }}
            </a>
            <x-primary-button class="ms-3">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>