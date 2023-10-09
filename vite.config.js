import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: [
                'resources/css/app.css',
                //'resources/css/tailwind.css',
                //'resources/assets/js/vendor.js',

                'resources/js/app.js',

                'resources/css/app-frontend.css',
                'resources/js/app-frontend.js',
                'resources/js/connect-wallet.jsx',
                'resources/js/deposit.jsx',
                'resources/js/deposit-wallet.jsx',
                'resources/js/ModalWallet.jsx',
                'resources/js/connect-wallet-admin.jsx',
            ],
            // refresh: true,
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
