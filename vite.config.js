import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        outDir: 'public/build',
        emptyOutDir: true, // bersihkan hasil lama setiap build
    },
    server: {
        cors: true,
//        host: '192.168.100.171',
//        hmr: {
//            host: '192.168.100.171',
//        },
    },
});
