import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '10.10.16.73',
        port: 5173,
        hmr: {
            host: '10.10.16.73',
            port: 5173,
        },
        cors: true,
    },
    // pre-bundle alpinejs supaya Vite mengoptimalkan dependensi
    optimizeDeps: {
        include: ['alpinejs'],
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
