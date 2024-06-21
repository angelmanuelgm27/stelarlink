import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/leaflet.css',
                'resources/js/sweetalert2.all.js',
                'resources/css/sweetalert2.css',
                'resources/js/leaflet.js'
            ],
            refresh: true,
        }),
    ],
});
