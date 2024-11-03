import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
    ],
    theme: {
        container: {
            center: true,
        },
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans], //borrar
                mont: ["Montserrat", "mont_medium"],
                lato: ["Lato", "lato"],
            },
            colors: {
                transparent: "transparent",
                current: "currentColor",
                letra: "#222E43", //Para las letras
                principal: "#374151", //Para el fondo del header
                secundario: "#D1D5DB", //Para el texto del header
                contenido: "#D5DEEF", //Para el fondo del container
                fondo: "#F0F3FA", //Fondo general y para hacer contraste en los inputs, y botones barra
                secciones: "#F2FBFF", //Fondo secciones
                cancelar: "#B91C1C", //Para los botones de cancelar o eliminar
                guardar: "#15803D", //Para botones de guardar o aceptar
                agregar: "#075985", //Para botones de agregar
            },
            screens: {
                movil: "300px", //para telefonos
                tablet: "400px", //telefonos grande y tablets
                laptop: "1024px", //laptop
                monitor: "1700px", //monitor
            },
            extend: {},
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("flowbite/plugin"),
        require("@tailwindcss/forms"),
    ],
};

//npm run dev para compilar
