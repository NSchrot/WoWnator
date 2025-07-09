<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('name', $skill->name ?? '')" required />
    </div>
    <div>
        <x-input-label for="class" value="Classe" />
        <x-text-input id="class" name="class" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('class', $skill->class ?? '')" required />
    </div>
    <div>
        <x-input-label for="type" value="Tipo (Ex: Passiva, Mágica)" />
        <x-text-input id="type" name="type" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('type', $skill->type ?? '')" />
    </div>
    <div>
        <x-input-label for="race" value="Raça (Se aplicável)" />
        <x-text-input id="race" name="race" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('race', $skill->race ?? '')" />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="xpac" value="Expansão" />
        <x-text-input id="xpac" name="xpac" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('xpac', $skill->xpac ?? '')" />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="description" value="Descrição" />
        <textarea id="description" name="description" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500 rounded-md shadow-sm text-gray-300" required>{{ old('description', $skill->description ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <x-input-label for="image_url" value="URL do Ícone" />
        <x-text-input id="image_url" name="image_url" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('image_url', $skill->image_url ?? '')" />
    </div>
</div>
