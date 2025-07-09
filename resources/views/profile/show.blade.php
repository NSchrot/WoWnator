<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-bold text-2xl text-wow-gold leading-tight">
            {{ __('Meu Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-stone-800/70 shadow sm:rounded-lg" x-data="{photoName: null, photoPreview: null}">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-100">
                            {{ __('Informações do Perfil') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-400">
                            {{ __("Atualize as informações do seu perfil, e-mail e avatar.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('user-profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div class="col-span-6 sm:col-span-4">
                            <x-input-label for="photo" value="{{ __('Foto') }}" />
                            <div class="mt-2 flex items-center">
                                <span class="inline-block h-20 w-20 rounded-full overflow-hidden bg-gray-100">
                                    <img x-show="!photoPreview" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-full w-full object-cover">
                                    <span x-show="photoPreview" class="block rounded-full w-full h-full bg-cover bg-no-repeat bg-center" :style="'background-image: url(\'' + photoPreview + '\');'"></span>
                                </span>
                                
                                <input type="file" name="photo" id="photo" class="hidden" x-ref="photo" @change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { photoPreview = e.target.result; };
                                    reader.readAsDataURL($refs.photo.files[0]);
                                ">
                                <x-secondary-button class="ms-5" type="button" @click.prevent="$refs.photo.click()">
                                    {{ __('Selecionar Nova Foto') }}
                                </x-secondary-button>
                            </div>
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-400">{{ __('Guardado.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
            
            <div class="p-4 sm:p-8 bg-stone-800/70 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
