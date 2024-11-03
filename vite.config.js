import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',               // Archivo CSS de entrada
                'resources/js/app.js',                  // Archivo JS de entrada principal
                'resources/views/administracion/scriptAdministracion.js', // Agrega tu archivo scriptAdministracion.js aquí
            ],
            refresh: true,                             // Habilita el refresh automático durante el desarrollo
        }),
    ],
    build: {
        outDir: 'public/build',                     // Directorio de salida para los archivos compilados
    },
});
