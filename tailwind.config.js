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
            },
            colors: {
                primary: {
                    50: '#fff5eb',
                    100: '#ffe4cc',
                    200: '#ffc399',
                    300: '#ffb380',
                    400: '#ff9d4d',
                    500: '#ff8833',
                    600: '#ff4f00',
                    700: '#e64600',
                    800: '#cc3d00',
                    900: '#b33500',
                },
            },
        },
    },

    plugins: [forms],
};
