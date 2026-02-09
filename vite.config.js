import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        tailwindcss(),
    ],
    //addition to fix WebSocket connection to 'ws://[::1]:5173/' failed:
    server: {
        hmr: {
            host: 'localhost',
            protocol: 'ws://', 
        },
    },
});
