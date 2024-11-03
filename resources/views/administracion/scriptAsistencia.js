//todo: -----SCRIPTS DE LA VISTA DE ASISTENCIA-----*/
//* Inicializar flatpickr para la hora y fecha
flatpickr("#hora", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    minTime: "07:30",
    maxTime: "17:30",
    time_24hr: false,
});

flatpickr("#fecha", {
    enableTime: false,
    dateFormat: "d-m-Y",
    minDate: "01.01.2024",
    locale: "es",
    maxDate: new Date(),
});

//*Fecha para el historial*/
flatpickr("#fecha_historial", {
    enableTime: false,
    dateFormat: "d-m-Y",
    minDate: "01.01.2024",
    locale: "es",
});

//* función para activar el formulario de entrada personalizada
document.querySelectorAll('[id^="toggleForm-"]').forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        var id = this.id.split("-")[1];
        var isChecked = this.checked;
        document
            .getElementById("formRapido-" + id)
            .classList.toggle("hidden", isChecked);
        document
            .getElementById("formPersonalizado-" + id)
            .classList.toggle("hidden", !isChecked);
    });
});

//* función para activar el formulario de salida personalizada
document
    .querySelectorAll('[id^="toggleFormSalida-"]')
    .forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            var id = this.id.split("-")[1];
            var isChecked = this.checked;
            document
                .getElementById("formSalidaRapida-" + id)
                .classList.toggle("hidden", isChecked);
            document
                .getElementById("formSalidaPersonalizada-" + id)
                .classList.toggle("hidden", !isChecked);
        });
    });
