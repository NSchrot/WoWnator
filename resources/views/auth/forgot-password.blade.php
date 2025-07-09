<x-guest-layout>
    <x-slot:title>
        WoWnator - Esqueci minha senha
    </x-slot:title>
    <div class="mb-4 text-sm text-white">
        {{ __('Esqueceu-se da sua senha? Sem problemas. Diga-nos o seu endereço de e-mail e nós enviaremos um link para redefinir a senha que lhe permitirá escolher uma nova.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-wow-gold">
                {{ __('Voltar para Login') }}
            </a>
            <x-primary-button>
                {{ __('Enviar Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>