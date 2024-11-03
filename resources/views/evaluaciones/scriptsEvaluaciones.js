//todo: SCRIPTS de la vista CREATE.EVALUACIONES y EDIT.EVALUACIONES*/

//* Inicializar flatpickr para la fecha de inicio
flatpickr("#fecha_inicio, #fecha_fin", {
    enableTime: false,
    dateFormat: "d-m-Y",
    locale: "es",
    minDate: new Date(), //? la fecha de inicio no puede ser en el pasado
});

document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript cargado");

    //* Manejar el evento de clic en el contenedor de preguntas para eliminar una pregunta
    document
        .getElementById("preguntas")
        .addEventListener("click", function (e) {
            if (e.target.classList.contains("removePregunta")) {
                e.target.parentElement.remove();
            }
        });

    //* Función para agregar preguntas
    document
        .getElementById("addPregunta")
        .addEventListener("click", function () {
            var preguntasDiv = document.getElementById("preguntas");
            var preguntaCount =
                preguntasDiv.querySelectorAll(".pregunta-group").length;
            var preguntaGroup = document.createElement("div");
            preguntaGroup.classList.add(
                "pregunta-group",
                "flex",
                "items-center",
                "mb-2"
            );
            preguntaGroup.innerHTML =
                '<input type="text" class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500" name="preguntas[' +
                preguntaCount +
                ']" placeholder="Texto de la pregunta">' +
                '<button type="button" class="btn btn-delete ml-2 removePregunta">Eliminar</button>';
            preguntasDiv.appendChild(preguntaGroup);
        });

    //* Función para ocultar todas las preguntas con el checkbox
    const togglePreguntas = document.getElementById("togglePreguntas");
    const preguntasContainer = document.getElementById("preguntas-container");

    function togglePreguntasVisibility() {
        if (togglePreguntas.checked) {
            preguntasContainer.style.display = "block";
        } else {
            preguntasContainer.style.display = "none";
        }
    }

    // Inicializar el estado del checkbox basándote en si se deben mostrar las preguntas
    togglePreguntas.addEventListener("change", togglePreguntasVisibility);

    // Asegurar que las preguntas se muestren cuando se carga la página si el checkbox está marcado
    togglePreguntasVisibility();
});
