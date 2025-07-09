<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('name', $character->name ?? '')" required />
    </div>
    <div>
        <x-input-label for="gender" value="Gênero" />
        <x-text-input id="gender" name="gender" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('gender', $character->gender ?? '')" required />
    </div>
    <div>
        <x-input-label for="class" value="Classe" />
        <x-text-input id="class" name="class" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('class', $character->class ?? '')" required />
    </div>
    <div>
        <x-input-label for="race" value="Raça" />
        <x-text-input id="race" name="race" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('race', $character->race ?? '')" required />
    </div>
    <div>
        <x-input-label for="faction" value="Facção" />
        <x-text-input id="faction" name="faction" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('faction', $character->faction ?? '')" required />
    </div>
    <div>
        <x-input-label for="realm" value="Reino" />
        <x-text-input id="realm" name="realm" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('realm', $character->realm ?? '')" required />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="xpac" value="Expansão" />
        <x-text-input id="xpac" name="xpac" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('xpac', $character->xpac ?? '')" required />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="image_url" value="URL do Ícone" />
        <x-text-input id="image_url" name="image_url" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('image_url', $character->image_url ?? '')" />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="splash_url" value="URL da Splash Art" />
        <x-text-input id="splash_url" name="splash_url" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('splash_url', $character->splash_url ?? '')" />
    </div>
</div>
