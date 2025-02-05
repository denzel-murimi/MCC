import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    '50': '#fcf3ff',
                    '100': '#f7e6ff',
                    '200': '#efccff',
                    '300': '#e7a4ff',
                    '400': '#d96fff',
                    '500': '#c438fd',
                    '600': '#9e16d0',
                    '700': '#9110bb',
                    '800': '#780f99',
                    '900': '#66137c',
                    '950': '#420054',
                },
                secondary: {
                    '50': '#f0f0ff',
                    '100': '#e5e6ff',
                    '200': '#cecfff',
                    '300': '#a7a6ff',
                    '400': '#7d74ff',
                    '500': '#523cff',
                    '600': '#3d15ff',
                    '700': '#2a01f9',
                    '800': '#2502d5',
                    '900': '#2104ae',
                    '950': '#0e0077',
                },
                accent: {
                    '50': '#effef1',
                    '100': '#dafee0',
                    '200': '#b8fac2',
                    '300': '#81f494',
                    '400': '#31e34e',
                    '500': '#1acd38',
                    '600': '#0faa29',
                    '700': '#108524',
                    '800': '#126921',
                    '900': '#11561e',
                    '950': '#03300d',
                },
            },
        },
    },
    plugins: [],
};
