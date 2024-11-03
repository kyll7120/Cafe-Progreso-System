import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',               // Archivo CSS de entrada
                'resources/js/app.js',                  // Archivo JS de entrada principal
                'resources/views/administracion/scriptAdministracion.js',
                'resources/views/administracion/scriptAsistencia.js',
                'resources/views/evaluaciones/scriptsEvaluaciones.js',
                'resources/views/insumo/scriptsInsumo.js',
                'resources/views/productos/scriptsProductos.js',
            ],
            refresh: true,                             
        }),
    ],
    build: {
        outDir: 'public/build',                     // Directorio de salida para los archivos compilados
    },
});
