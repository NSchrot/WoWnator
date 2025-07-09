<div class="max-w-5xl w-full">
    @php 
        $correct = $guess->dailyChallenge->character;
        $guessed = $guess->details;
    @endphp
    <div class="grid grid-cols-2 md:grid-cols-8 gap-1 text-white text-center text-xs rounded-lg">
        <div class="hidden md:flex items-center justify-center p-1 bg-stone-700 rounded-md"><img src="{{ $guessed->image_url }}" alt="{{ $guessed->name }}" class="h-full w-full object-cover rounded-md" onerror="this.style.display='none'"></div>
        <div class="col-span-2 md:col-span-1 flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->id, $correct->id) }}"><img src="{{ $guessed->image_url }}" alt="{{ $guessed->name }}" class="h-8 w-8 object-cover rounded-md inline-block mr-2 md:hidden" onerror="this.style.display='none'"><span class="font-bold">{{ $guessed->name }}</span></div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->gender, $correct->gender) }}">{{ $guessed->gender }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->class, $correct->class) }}">{{ $guessed->class }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->race, $correct->race) }}">{{ $guessed->race }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->faction, $correct->faction) }}">{{ $guessed->faction }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->xpac, $correct->xpac) }}">{{ $guessed->xpac }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->realm, $correct->realm) }}">{{ $guessed->realm }}</div>
    </div>
</div>