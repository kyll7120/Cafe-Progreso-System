import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',  // Archivo CSS de entrada
                'resources/js/app.js',     // Archivo JS de entrada
            ],
            refresh: true,                // Habilita el refresh automático durante el desarrollo
        }),
    ],
    build: {
        outDir: 'public/build',        // Directorio de salida para los archivos compilados
    },
});
