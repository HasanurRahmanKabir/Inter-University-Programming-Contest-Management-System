import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        // Tailwind v4 এর প্লাগইনটি লারাভেলের আগে থাকা ভালো
        tailwindcss(), 
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.tsx'
            ],
            ssr: 'resources/js/ssr.tsx',
            refresh: true,
        }),
        react({
            babel: {
                plugins: [
                    // React 19 ব্যবহার করলে এটি চমৎকার কাজ করে
                    'babel-plugin-react-compiler'
                ],
            },
        }),
    ],
    resolve: {
        alias: {
            // এটি আপনার প্রোজেক্টের পাথ রেজোলিউশন নিশ্চিত করবে
            '@': path.resolve(__dirname, './resources/js'),
            'ziggy-js': path.resolve(__dirname, 'vendor/tightenco/ziggy'),
        },
    },
    // বিল্ড অপ্টিমাইজেশন
    build: {
        chunkSizeWarningLimit: 1600,
    },
    esbuild: {
        jsx: 'automatic',
    }
});