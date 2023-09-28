import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                //'resources/css/tailwind.css',
                //'resources/assets/js/vendor.js',

                'resources/js/app.js',

                'resources/css/app-frontend.css',
                'resources/js/app-frontend.js',


            ],
            //refresh: true,
            refresh: [
                'resources/routes/**',
                'routes/**',
                'resources/views/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '@': path.resolve(__dirname, 'resources/assets'),
            '@nm': path.resolve(__dirname, 'node_modules'),
        }
    },
});
