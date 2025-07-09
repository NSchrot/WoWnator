<div class="max-w-md w-full">
    @php 
        $guessed = $guess->details;
    @endphp
    <div class="p-3 rounded-lg shadow-md flex items-center text-white {{ $guess->is_correct ? 'bg-green-600/80' : 'bg-red-800/80' }}">
        <img src="{{ $guessed->image_url }}" alt="{{ $guessed->name }}" class="h-10 w-10 rounded-full object-cover border-2 border-stone-700" onerror="this.style.display='none'">
        <span class="ml-4 font-bold">{{ $guessed->name }}</span>
    </div>
</div>