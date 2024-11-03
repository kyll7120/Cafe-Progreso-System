//todo:------SCRIPTS DE LA VISTA DE EMPLEADO------*/
//* Inicializar flatpickr para la fecha de nacimiento
flatpickr("#fecha_nacimiento", {
    enableTime: false,
    dateFormat: "d-m-Y",
    minDate: "01.01.1900",
    maxDate: getMaxDate(),
    locale: "es",
});

//* Función para calcular la fecha máxima permitida (18 años atrás desde hoy)
function getMaxDate() {
    let today = new Date();
    let maxDate = new Date(
        today.getFullYear() - 18,
        today.getMonth(),
        today.getDate()
    );
    return maxDate.toLocaleDateString("es-ES").replace(/\//g, ".");
}

//?--------VALIDACIONES----------*/
//*Script para validar que solo se escriban letras en el nombre y apellido
// Obtener el campo de entrada por su ID
var nombreInput = document.getElementById("name");
var apellidoInput = document.getElementById("apellido");

// Escuchar el evento 'input' en el campo de entrada
nombreInput.addEventListener("input", function () {
    // Obtener el valor del campo de entrada
    var valor = nombreInput.value;
    // Reemplazar cualquier caracter que no sea una letra, espacio, vocal tildada o la letra ñ por una cadena vacía
    valor = valor.replace(/[^A-Za-zÁÉÍÓÚáéíóúüÜñÑ\s]/g, "");
    // Actualizar el valor del campo de entrada
    nombreInput.value = valor;
});

// Escuchar el evento 'input' en el campo de entrada
apellidoInput.addEventListener("input", function () {
    // Obtener el valor del campo de entrada
    var valor = apellidoInput.value;
    // Reemplazar cualquier caracter que no sea una letra, espacio, vocal tildada o la letra ñ por una cadena vacía
    valor = valor.replace(/[^A-Za-zÁÉÍÓÚáéíóúüÜñÑ\s]/g, "");
    // Actualizar el valor del campo de entrada
    apellidoInput.value = valor;
});

//*Script para validar que solo se ingresen números enteros
function validarEntero(e) {
    const charCode = e.which ? e.which : e.keyCode;
    if (charCode < 49 || charCode > 57) {
        e.preventDefault(); // Evita que se ingrese el carácter
    }
}

//*Script para el input de numero de teléfono
// Obtener el input del teléfono
var telefonoInput = document.getElementById("telefono");

// Escuchar el evento 'input' para validar el contenido del input
telefonoInput.addEventListener("input", function () {
    // Obtener el valor del input
    var valor = telefonoInput.value;

    // Reemplazar todos los caracteres no numéricos
    valor = valor.replace(/\D/g, "");

    // Formatear el número en el formato ####-####
    var numeroFormateado = "";
    for (var i = 0; i < valor.length; i++) {
        numeroFormateado += valor[i];
        if (i == 3) {
            numeroFormateado += "-";
        }
    }

    // Actualizar el valor del input con el número formateado
    telefonoInput.value = numeroFormateado;

    // Validar si el número es válido (8 dígitos)
    if (valor.length === 8) {
        telefonoInput.setCustomValidity("");
    } else {
        telefonoInput.setCustomValidity(
            "El número de teléfono debe tener 8 dígitos"
        );
    }
});

//*Script para el input de numero de DUI
// Obtener el input del dui
var duiInput = document.getElementById("dui");

// Escuchar el evento 'input' para validar el contenido del input
duiInput.addEventListener("input", function () {
    // Obtener el valor del input
    var valor = duiInput.value;

    // Reemplazar todos los caracteres no numéricos
    valor = valor.replace(/\D/g, "");

    // Formatear el número en el formato ########-#
    var numeroFormateado = "";
    for (var i = 0; i < valor.length; i++) {
        numeroFormateado += valor[i];
        if (i == 7) {
            numeroFormateado += "-";
        }
    }

    // Actualizar el valor del input con el número formateado
    duiInput.value = numeroFormateado;

    // Validar si el número es válido (9 dígitos)
    if (valor.length === 9) {
        duiInput.setCustomValidity("");
    } else {
        duiInput.setCustomValidity(
            "El número de teléfono debe tener 9 dígitos"
        );
    }
});

//*Script para validar contraseña
// Obtener referencias a los campos de contraseña
var passwordInput = document.getElementById("password");
var confirmPasswordInput = document.getElementById("password_confirmation");

// Función para validar los campos de contraseña
function validarContraseña() {
    // Obtener los valores de los campos de contraseña
    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput.value;

    // Verificar si las contraseñas son iguales y tienen al menos 8 caracteres
    if (password === confirmPassword && password.length >= 8) {
        // Contraseñas válidas
        confirmPasswordInput.setCustomValidity("");
    } else {
        // Contraseñas inválidas
        confirmPasswordInput.setCustomValidity(
            "Las contraseñas deben ser iguales y tener al menos 8 caracteres"
        );
    }
}

// Escuchar el evento de cambio en ambos campos de contraseña
passwordInput.addEventListener("input", validarContraseña);
confirmPasswordInput.addEventListener("input", validarContraseña);