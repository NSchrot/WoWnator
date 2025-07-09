<x-guest-layout>
    <style>
        .faction-radio:checked + label { border-color: #facc15; box-shadow: 0 0 15px rgba(250, 204, 21, 0.5); }
        .faction-radio:checked + label img { transform: scale(1.1); filter: saturate(1.2); }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div>
            <x-input-label for="name" :value="__('Nickname')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label :value="__('Escolha sua Facção')" />
            <div class="flex justify-around items-center mt-2 gap-4">
                <input type="radio" name="faction" id="horde" value="Horde" class="hidden faction-radio" {{ old('faction') == 'Horde' ? 'checked' : '' }} required>
                <label for="horde" class="cursor-pointer border-4 border-transparent rounded-lg p-2 transition-all duration-300 hover:border-red-500">
                    <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752000409/INV_Tabard_HordeWarEffort_tcggzc.png" alt="Horde" class="h-20 w-20 transition-transform duration-300">
                </label>
                <input type="radio" name="faction" id="alliance" value="Alliance" class="hidden faction-radio" {{ old('faction') == 'Alliance' ? 'checked' : '' }} required>
                <label for="alliance" class="cursor-pointer border-4 border-transparent rounded-lg p-2 transition-all duration-300 hover:border-blue-500">
                    <img src="https://res.cloudinary.com/dpebql3aj/image/upload/v1752000409/INV_Tabard_AllianceWarEffort_ezgec9.png" alt="Alliance" class="h-20 w-20 transition-transform duration-300">
                </label>
            </div>
            <x-input-error :messages="$errors->get('faction')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" class="text-white bg-yellow-600 hover:bg-yellow-500 font-semibold py-2 px-4 rounded-md transition-colors duration-200 text-xs uppercase tracking-widest">
                {{ __('Já tem registro?') }}
            </a>
            <x-primary-button class="ms-3">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>