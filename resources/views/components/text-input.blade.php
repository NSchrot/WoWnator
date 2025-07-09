@props(['disabled' => false])

@php
$classes = ($disabled ?? false)
            ? 'border-stone-600 bg-stone-800 text-gray-400 shadow-sm cursor-not-allowed'
            : 'border-stone-600 bg-stone-900/50 text-gray-300 shadow-sm focus:border-wow-gold focus:ring-wow-gold';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes . ' rounded-md']) !!}>