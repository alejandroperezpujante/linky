import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'vendor/picocss/pico/css/pico.css'],
            refresh: true,
        }),
    ],
});
