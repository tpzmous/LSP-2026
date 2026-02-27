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
                neon: {
                    blue: '#00E5FF', // Main cyan accent
                    dark: '#0B1220', // Background gradient start
                    gray: '#0F1B2D', // Background gradient end
                    card: 'rgba(15, 27, 45, 0.6)', // Glassmorphism background
                    border: 'rgba(0, 229, 255, 0.2)', // Cyan transparent border
                    text: '#E6EDF3', // Main text
                    subtext: '#8B9BB4', // Grayish blue subtext
                    purple: '#8B5CF6' // Soft purple glow
                }
            },
            boxShadow: {
                'neon-blue': '0 0 10px rgba(0, 229, 255, 0.3), 0 0 20px rgba(0, 229, 255, 0.15)',
                'neon-hover': '0 0 15px rgba(0, 229, 255, 0.5), 0 0 30px rgba(0, 229, 255, 0.3)',
                'neon-purple': '0 0 15px rgba(139, 92, 246, 0.4), 0 0 30px rgba(139, 92, 246, 0.2)',
                'glass': '0 8px 32px 0 rgba(0, 0, 0, 0.37)'
            },
            backgroundImage: {
                'radial-glow': 'radial-gradient(circle, rgba(0,229,255,0.15) 0%, rgba(11,18,32,0) 70%)',
                'radial-purple': 'radial-gradient(circle, rgba(139,92,246,0.15) 0%, rgba(11,18,32,0) 70%)',
            }
        },
    },

    plugins: [forms],
};
