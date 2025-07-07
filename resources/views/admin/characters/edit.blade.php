<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Personagem') }}: {{ $character->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.characters.update', $character) }}" method="POST">
                        @csrf
                        @method('PUT')                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Nome')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $character->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="gender" :value="__('Gênero')" />
                                <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full" :value="old('gender', $character->gender)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                            </div>
                            <div>
                                <x-input-label for="class" :value="__('Classe')" />
                                <x-text-input id="class" name="class" type="text" class="mt-1 block w-full" :value="old('class', $character->class)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('class')" />
                            </div>
                            <div>
                                <x-input-label for="race" :value="__('Raça')" />
                                <x-text-input id="race" name="race" type="text" class="mt-1 block w-full" :value="old('race', $character->race)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('race')" />
                            </div>
                            <div>
                                <x-input-label for="faction" :value="__('Facção')" />
                                <x-text-input id="faction" name="faction" type="text" class="mt-1 block w-full" :value="old('faction', $character->faction)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('faction')" />
                            </div>
                            <div>
                                <x-input-label for="realm" :value="__('Reino')" />
                                <x-text-input id="realm" name="realm" type="text" class="mt-1 block w-full" :value="old('realm', $character->realm)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('realm')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="xpac" :value="__('Expansão de Origem')" />
                                <x-text-input id="xpac" name="xpac" type="text" class="mt-1 block w-full" :value="old('xpac', $character->xpac)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('xpac')" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="image_url" :value="__('URL da Imagem (Opcional)')" />
                                <x-text-input id="image_url" name="image_url" type="url" class="mt-1 block w-full" :value="old('image_url', $character->image_url)" />
                                <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                            </div>
                        </div>
                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Atualizar') }}</x-primary-button>
                            <a href="{{ route('admin.characters.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
