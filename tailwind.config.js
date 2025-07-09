import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                heading: ['Cinzel', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                'stone': {
                    '100': '#d1d1d1',
                    '300': '#a3a3a3',
                    '500': '#757575',
                    '700': '#474747',
                    '900': '#1f1f1f',
                },
                'wow-gold': '#ffd700',
                'horde-red': '#8c1616',
                'alliance-blue': '#1a3c8c',
            },
        },
    },

    plugins: [forms],
};
