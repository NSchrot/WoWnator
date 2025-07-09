<x-guest-layout>
    <div class="mb-4 text-sm text-white">
        {{ __('Obrigado por se registrar! Antes de começar, confirme seu endereço de e-mail clicando no link que enviamos para você. Caso não tenha recebido o e-mail, podemos reenviá-lo.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-400">
            {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                {{ __('Reenviar E-mail de Verificação') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-white underline hover:text-wow-gold transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-wow-gold">
                {{ __('Sair') }}
            </button>
        </form>
    </div>
</x-guest-layout>