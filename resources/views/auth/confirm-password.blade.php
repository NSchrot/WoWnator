<x-guest-layout>
    <div class="mb-4 text-sm text-white">
        {{ __('Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('password.request') }}" class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-wow-gold">
                {{ __('Esqueceu sua senha?') }}
            </a>

            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
