//todo: ------SCRIPTS de la vista CREATE.INSUMO y EDIT.INSUMO-----*/

//* Script para aumentar las existencias y el precio unitario con el scroll del mouse-->
//! Se usa en la vista de registrar productos para el input de existencias y precio unitario

// Función para manejar el scroll en los inputs
function handleScroll(event) {
    var input = event.currentTarget;
    var delta = Math.sign(event.deltaY);
    delta > 0 ? input.stepDown() : input.stepUp();
    event.preventDefault();
}

// Obtener y configurar los inputs
document.getElementById("existencias").addEventListener("wheel", handleScroll);
document
    .getElementById("precio_unitario")
    .addEventListener("wheel", handleScroll);


//* Script para validar que No se escriban "-" ni "." en las existencias-->
//! Se usa en la vista de registrar productos para el input de existencias
document.getElementById("existencias").addEventListener("input", function (e) {
    var value = this.value;

    // Remove any '-' or '.' characters from the input value
    this.value = value.replace(/[-.]/g, "");
});

// Prevent '-' and '.' from being entered into the input
document
    .getElementById("existencias")
    .addEventListener("keydown", function (e) {
        if (e.key === "-" || e.key === ".") {
            e.preventDefault();
        }
    });

//* Script para validar que No se escriban "-" en el precio unitario-->
//! Se usa en la vista de registrar productos para el input de precio unitario
// Evento 'keydown' para prevenir la entrada del carácter '-'
document
    .getElementById("precio_unitario")
    .addEventListener("keydown", function (e) {
        if (e.key === "-") {
            e.preventDefault();
        }
    });
