import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/colors.css',
                'resources/css/typography.css',
                'resources/css/layout.css',
                'resources/css/global.css',
                'resources/css/header.css',
                'resources/css/home.css',
                'resources/css/backgrounds-shapes.css',
                'resources/css/about.css',
                'resources/css/contact.css',
                'resources/css/cart.css',
                'resources/css/order.css',
                'resources/css/invoice.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
