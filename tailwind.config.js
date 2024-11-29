import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        // './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            // fontFamily: {
            //     sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            // },

            keyframes: {
                slideInFromLeft: {
                    '0%': { transform: 'translateX(-50%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                slideInFromRight: {
                    '0%': { transform: 'translateX(50%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                slideInFromRight2: {
                    '0%': { transform: 'translateX(50%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                fromTopLeft: {
                    '0%': { transform: 'translate(-50%, -50%)', opacity: '0' },
                    '100%': { transform: 'translate(0, 0)', opacity: '1' },
                },
                fromTopRight: {
                    '0%': { transform: 'translate(50%, -50%)', opacity: '0' },
                    '100%': { transform: 'translate(0, 0)', opacity: '1' },
                },
                fromBottomLeft: {
                    '0%': { transform: 'translate(-50%, 50%)', opacity: '0' },
                    '100%': { transform: 'translate(0, 0)', opacity: '1' },
                },
                fromBottomRight: {
                    '0%': { transform: 'translate(50%, 50%)', opacity: '0' },
                    '100%': { transform: 'translate(0, 0)', opacity: '1' },
                },
            },


            animation: {
                slideInFromLeft: 'slideInFromLeft 1s ease-out forwards',
                slideInFromRight: 'slideInFromRight 1s ease-out forwards',
                slideInFromRight2: 'slideInFromRight2 0.5s ease-in-out forwards',
                fromTopLeft: 'fromTopLeft 1s ease-out forwards',
                fromTopRight: 'fromTopRight 1s ease-out forwards',
                fromBottomLeft: 'fromBottomLeft 1s ease-out forwards',
                fromBottomRight: 'fromBottomRight 1s ease-out forwards',
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
