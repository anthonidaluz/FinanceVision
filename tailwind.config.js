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
            sans: ['Poppins', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            'primary': '#3498DB', 
            'danger': '#e74c3c',  
            'success': '#28a745', 
        },
    },
},

    plugins: [forms],
};
