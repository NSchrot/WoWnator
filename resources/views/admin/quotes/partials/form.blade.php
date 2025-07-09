<div class="space-y-6">
    <div>
        <x-input-label for="character_id" value="Personagem" />
        <select name="character_id" id="character_id" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500 rounded-md shadow-sm text-gray-300" required>
            @foreach($characters as $character)
                <option value="{{ $character->id }}" @selected(old('character_id', $quote->character_id ?? '') == $character->id)>
                    {{ $character->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <x-input-label for="text" value="Texto da Citação" />
        <textarea id="text" name="text" rows="4" class="w-full mt-1 !bg-stone-900/50 !border-stone-600 focus:!border-green-500 focus:!ring-green-500 rounded-md shadow-sm text-gray-300" required>{{ old('text', $quote->text ?? '') }}</textarea>
    </div>
</div>
