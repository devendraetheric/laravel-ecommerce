import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'node_modules/swiper/swiper.min.css',
                'node_modules/select2/dist/css/select2.min.css',
                'resources/css/admin.css',
                'resources/js/admin.js',
                'resources/css/app.css',
                'resources/css/responsive.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
