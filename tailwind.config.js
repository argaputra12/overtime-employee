import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx,vue}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
                lato: ['Lato', ...defaultTheme.fontFamily.sans],
            },
            textColor: {
                'active-link': '#968172',
            },
            backgroundColor: {
                'primary': '#f6f2f0',
                'highlight': '#e3d5ca',
                'primary-dark': '#ddb892'
            },
            colors: {
                'border-gray': '#eeeae6',
            }
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
