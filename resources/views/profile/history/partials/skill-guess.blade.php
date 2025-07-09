<div class="max-w-3xl w-full">
    @php 
        $correct = $guess->dailyChallenge->skill;
        $guessed = $guess->details;
    @endphp
    <div class="grid grid-cols-2 md:grid-cols-6 gap-1 text-white text-center text-xs rounded-lg">
        <div class="hidden md:flex items-center justify-center p-1 bg-stone-700 rounded-md"><img src="{{ $guessed->image_url ?? '' }}" alt="{{ $guessed->name ?? '' }}" class="h-full w-full object-cover rounded-md" onerror="this.style.display='none'"></div>
        <div class="col-span-2 md:col-span-1 flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->id, $correct->id) }}"><img src="{{ $guessed->image_url ?? '' }}" alt="{{ $guessed->name ?? '' }}" class="h-8 w-8 object-cover rounded-md inline-block mr-2 md:hidden" onerror="this.style.display='none'"><span class="font-bold">{{ $guessed->name ?? 'N/A' }}</span></div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->type ?? null, $correct->type ?? null) }}">{{ $guessed->type ?? 'N/A' }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->race ?? null, $correct->race ?? null) }}">{{ $guessed->race ?? 'N/A' }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->class ?? null, $correct->class ?? null) }}">{{ $guessed->class ?? 'N/A' }}</div>
        <div class="flex items-center justify-center p-2 rounded-md {{ getComparisonClass($guessed->xpac ?? null, $correct->xpac ?? null) }}">{{ $guessed->xpac ?? 'N/A' }}</div>
    </div>
</div>
