import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import path from 'path'; // এটি যোগ করা হয়েছে পাথ রেজোলিউশনের জন্য
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            ssr: 'resources/js/ssr.tsx',
            refresh: true,
        }),
        react({
            babel: {
                plugins: ['babel-plugin-react-compiler'],
            },
        }),
        tailwindcss(),
        // Wayfinder যদি প্রয়োজন হয় তবে আনকমেন্ট করতে পারেন, তবে আপাতত অফ থাকাই ভালো
        /* wayfinder({
            formVariants: true,
        }), */
    ],
    resolve: {
        alias: {
            // এই অংশটি সবথেকে গুরুত্বপূর্ণ। এটি ছাড়া রেলওয়েতে বিল্ড হবে না।
            '@': path.resolve(__dirname, './resources/js'),
        },
    },
    esbuild: {
        jsx: 'automatic',
    },
});