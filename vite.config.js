import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
//import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5174, // Paksa ke 5174 agar konsisten dengan terminal Anda
        strictPort: true,
        hmr: {
            host: '192.168.1.6', // Alamat IP komputer Anda
        },
    },
});
