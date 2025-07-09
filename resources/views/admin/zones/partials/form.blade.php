<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input id="name" name="name" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('name', $zone->name ?? '')" required />
    </div>
    <div>
        <x-input-label for="continent" value="Continente" />
        <x-text-input id="continent" name="continent" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('continent', $zone->continent ?? '')" required />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="image_url" value="URL da Imagem" />
        <x-text-input id="image_url" name="image_url" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500" :value="old('image_url', $zone->image_url ?? '')" />
    </div>
</div>
