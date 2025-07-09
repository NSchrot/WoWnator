@props(['type' => 'button', 'disabled' => false])

<button {{ $attributes->merge([
    'type' => $type,
    'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-wow-gold focus:ring-offset-2 dark:focus:ring-offset-stone-800 transition ease-in-out duration-150' . ($disabled ? ' opacity-25' : ''),
    'disabled' => $disabled
]) }}>
    {{ $slot }}
</button>
