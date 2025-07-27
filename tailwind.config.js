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
                'kuning-polisi': '#ebcf85',
                'coklat-polisi': '#362F2E',
                'muda-polisi': '#e5a53a',
                'coklat-footer-nav': '#362F2E',
                'coklat-nav': '#ffffff',
            },
        },
    },

    plugins: [forms],
};
