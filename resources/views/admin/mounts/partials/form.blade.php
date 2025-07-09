<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500" :value="old('name', $mount->name ?? '')" required />
    </div>
    <div>
        <x-input-label for="type" value="Tipo" />
        <x-text-input id="type" name="type" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500" :value="old('type', $mount->type ?? '')" required />
    </div>
    <div>
        <x-input-label for="faction" value="Facção" />
        <x-text-input id="faction" name="faction" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500" :value="old('faction', $mount->faction ?? '')" />
    </div>
    <div>
        <x-input-label for="xpac" value="Expansão" />
        <x-text-input id="xpac" name="xpac" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500" :value="old('xpac', $mount->xpac ?? '')" />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="source" value="Fonte (Ex: Drop, Vendedor, etc.)" />
        <x-text-input id="source" name="source" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500" :value="old('source', $mount->source ?? '')" />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="description" value="Descrição" />
        <textarea id="description" name="description" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500 rounded-md shadow-sm text-gray-300">{{ old('description', $mount->description ?? '') }}</textarea>
    </div>
    <div>
        <x-input-label for="image_url" value="URL da Imagem (Grande)" />
        <x-text-input id="image_url" name="image_url" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500" :value="old('image_url', $mount->image_url ?? '')" />
    </div>
    <div>
        <x-input-label for="icon_url" value="URL do Ícone (Pequeno)" />
        <x-text-input id="icon_url" name="icon_url" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-orange-500 focus:!ring-orange-500" :value="old('icon_url', $mount->icon_url ?? '')" />
    </div>
</div>
