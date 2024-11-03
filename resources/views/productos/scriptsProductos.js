//*todo ---------SCRIPTS usados en la vista CREATE.PRODUCTO y EDIT.PRODUCTO----------*/

//* Script para el check box de es preparado
document.getElementById("es_preparado").addEventListener("change", function () {
    var existenciasField = document.getElementById("existencias");
    if (this.checked) {
        existenciasField.value = 0;
        existenciasField.removeAttribute("required");
    } else {
        existenciasField.value = "";
        existenciasField.setAttribute("required", "required");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const esPreparadoCheckbox = document.getElementById("es_preparado");
    const existenciasField = document.getElementById("existencias-field");

    function toggleExistenciasField() {
        if (esPreparadoCheckbox.checked) {
            existenciasField.style.display = "none";
        } else {
            existenciasField.style.display = "block";
        }
    }

    esPreparadoCheckbox.addEventListener("change", toggleExistenciasField);

    toggleExistenciasField();
});
