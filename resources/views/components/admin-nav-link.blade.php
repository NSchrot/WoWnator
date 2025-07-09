@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full text-left px-3 py-2 rounded-md bg-orange-900/50 text-orange-400 font-bold'
            : 'block w-full text-left px-3 py-2 rounded-md text-stone-300 hover:bg-stone-700 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
