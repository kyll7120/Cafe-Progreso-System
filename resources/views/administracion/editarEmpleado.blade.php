@extends('layouts.plantilla')

@section('tituloPagina', 'Edición de empleados')

@section('tituloSeccion', 'Empleados')

@section('tituloContenido', 'Edición de empleado')

@section('contenidoPagina')
<?php

$municipiosPorDepartamento = [
    "San Salvador" => ["San Salvador", "Aguilares", "Apopa", "Ayutuxtepeque", "Cuscatancingo", "Delgado", "El Paisnal", "Guazapa", "Ilopango", "Mejicanos", "Nejapa", "Panchimalco", "Rosario de Mora", "San Marcos", "San Martín", "Santiago Texacuangos", "Santo Tomás", "Soyapango", "Tonacatepeque"],
    "Santa Ana" => ["Santa Ana", "Candelaria de la Frontera", "Chalchuapa", "Coatepeque", "El Congo", "El Porvenir", "Masahuat", "Metapán", "San Antonio Pajonal", "San Sebastián Salitrillo", "Santa Rosa Guachipilín", "Santiago de la Frontera", "Texistepeque"],
    "Sonsonate" => ["Sonsonate", "Acajutla", "Armenia", "Caluco", "Cuisnahuat", "Izalco", "Juayúa", "Nahuizalco", "Nahulingo", "Salcoatitán", "San Antonio del Monte", "San Julián", "Santa Catarina Masahuat", "Santa Isabel Ishuatán", "Santo Domingo de Guzmán", "Sonzacate"],
    "Ahuachapan" => ["Ahuachapán", "Apaneca", "Atiquizaya", "Concepción de Ataco", "El Refugio", "Guaymango", "Jujutla", "San Francisco Menéndez", "San Lorenzo", "San Pedro Puxtla", "Tacuba", "Turín"],
    "La Libertad" => ["Santa Tecla", "Antiguo Cuscatlán", "Chiltiupán", "Ciudad Arce", "Colón", "Comasagua", "Huizúcar", "Jayaque", "Jicalapa", "La Libertad", "Nuevo Cuscatlán", "Quezaltepeque", "San Juan Opico", "Sacacoyo", "San José Villanueva", "San Matías", "San Pablo Tacachico", "Talnique", "Tamanique", "Teotepeque", "Tepecoyo", "Zaragoza"],
    "Chalatenango" => ["Chalatenango", "Agua Caliente", "Arcatao", "Azacualpa", "Cancasque", "Citalá", "Comalapa", "Concepción Quezaltepeque", "Dulce Nombre de María", "El Carrizal", "El Paraíso", "La Laguna", "La Palma", "La Reina", "Las Vueltas", "Nombre de Jesús", "Nueva Concepción", "Nueva Trinidad", "Ojos de Agua", "Potonico", "San Antonio de la Cruz", "San Antonio Los Ranchos", "San Fernando", "San Francisco Lempa", "San Francisco Morazán", "San Ignacio", "San Isidro Labrador", "San José Cancasque", "San José Las Flores", "San Luis del Carmen", "San Miguel de Mercedes", "San Rafael", "Santa Rita", "Tejutla"],
    "Cuscatlan" => ["Cojutepeque", "Candelaria", "El Carmen", "El Rosario", "Monte San Juan", "Oratorio de Concepción", "San Bartolomé Perulapía", "San Cristóbal", "San José Guayabal", "San Pedro Perulapán", "San Rafael Cedros", "San Ramón", "Santa Cruz Analquito", "Santa Cruz Michapa", "Suchitoto", "Tenancingo"],
    "La Paz" => ["Zacatecoluca", "Cuyultitán", "El Rosario", "Jerusalén", "Mercedes La Ceiba", "Olocuilta", "Paraíso de Osorio", "San Antonio Masahuat", "San Emigdio", "San Francisco Chinameca", "San Juan Nonualco", "San Juan Talpa", "San Juan Tepezontes", "San Luis La Herradura", "San Luis Talpa", "San Miguel Tepezontes", "San Pedro Masahuat", "San Pedro Nonualco", "San Rafael Obrajuelo", "Santa María Ostuma", "Santiago Nonualco", "Tapalhuaca"],
    "Cabañas" => ["Sensuntepeque", "Cinquera", "Dolores", "Guacotecti", "Ilobasco", "Jutiapa", "San Isidro", "Tejutepeque", "Victoria"],
    "San Vicente" => ["San Vicente", "Apastepeque", "Guadalupe", "San Cayetano Istepeque", "San Esteban Catarina", "San Ildefonso", "San Lorenzo", "San Sebastián", "Santa Clara", "Santo Domingo", "Tecoluca", "Tepetitán", "Verapaz"],
    "Usulutan" => ["Usulután", "Alegría", "Berlín", "California", "Concepción Batres", "El Triunfo", "Ereguayquín", "Estanzuelas", "Jiquilisco", "Jucuapa", "Jucuarán", "Mercedes Umaña", "Nueva Granada", "Ozatlán", "Puerto El Triunfo", "San Agustín", "San Buenaventura", "San Dionisio", "San Francisco Javier", "Santa Elena", "Santa María", "Santiago de María", "Tecapán", "Usulután"],
    "Morazan" => ["San Francisco Gotera", "Arambala", "Cacaopera", "Chilanga", "Corinto", "Delicias de Concepción", "El Divisadero", "El Rosario", "Gualococti", "Guatajiagua", "Joateca", "Jocoaitique", "Jocoro", "Lolotiquillo", "Meanguera", "Osicala", "Perquín", "San Carlos", "San Fernando", "San Isidro", "San Simón", "Sensembra", "Sociedad", "Torola", "Yamabal", "Yoloaiquín"],
    "La Union" => ["La Unión", "Anamorós", "Bolívar", "Concepción de Oriente", "Conchagua", "El Carmen", "El Sauce", "Intipucá", "Lislique", "Meanguera del Golfo", "Nueva Esparta", "Pasaquina", "Polorós", "San Alejo", "San José", "Santa Rosa de Lima", "Yayantique"],
    "San Miguel" => ["San Miguel", "Carolina", "Chapeltique", "Chinameca", "Chirilagua", "Ciudad Barrios", "Comacarán", "El Tránsito", "Lolotique", "Moncagua", "Nueva Guadalupe", "Nuevo Edén de San Juan", "Quelepa", "San Antonio del Mosco", "San Gerardo", "San Jorge", "San Luis de la Reina", "San Rafael Oriente", "Sesori", "Uluazapa"]
];

?>
@if ($errors->any())
<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <div class="font-medium">
        ¡Ups! Algo salió mal.
    </div>
    <ul class="mt-3 list-disc list-inside text-sm">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('success'))
<div class="bg-green-200 bg-opacity-75 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
    role="alert">
    <strong class="font-bold">¡Éxito!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif


<!--Formulario-->
<form id="registroForm" action="{{ route('usuario.update', $usuario->id) }}" method="POST" autocomplete="off">
@csrf
@method('PUT')
<div class="pb-4">
    <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
        <input type="text" name="id" value="{{ $usuario->id }}" hidden>
        <!--Nombre-->
        <div class="sm:col-span-3">
            <p id="texto" for="first-name">Nombres:</p>
            <div class="mt-2 ">
                <input type="text" name="name" id="name" placeholder="Manuel Alberto" value="{{ $usuario->name }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div>

        <!--Apellidos-->
        <div class="sm:col-span-3">
            <p id="texto" for="first-name">Apellidos:</p>
            <div class="mt-2 ">
                <input type="text" name="apellido" id="apellido" placeholder="Arevalo Molina" value="{{ $usuario->apellido }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="sm:col-span-3">
            <p id="texto" for="fecha_nacimiento">Fecha de Nacimiento:</p>
            <div class="mt-2">
                <input type="text" name="fecha_nacimiento" id="fecha_nacimiento"
                    value="{{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('d-m-Y') }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div> 
    </div>
</div>

<!--Datos Sexo, Telefono y Correo-->
<div class="pb-4">
    <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
        <!--Sexo-->
        <div class="sm:col-span-3">
            <p id="texto" for="producto">Sexo:</p>
            <div class="mt-2">
                <select name="sexo" id="sexo"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
                    <option value="">Seleccione una opcion</option>
                    <option value="Femenino" {{ $usuario->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="Masculino" {{ $usuario->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                </select>
            </div>
        </div>

        <!--Telefono-->
        <div class="sm:col-span-3">
            <p id="texto" for="first-name">Teléfono:</p>
            <div class="mt-2">
                <input type="tel" name="telefono" id="telefono" placeholder="0000-0000" minlength="9"
                    maxlength="9" value="{{ $usuario->telefono }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div>

        <!--Correo-->
        <div class="sm:col-span-3">
            <p id="texto" for="email">Correo:</p>
            <div class="mt-2">
                <input type="email" name="email" id="email" placeholder="example@domain.com" value="{{ $usuario->email }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div>
    </div>
</div>

<!--Datos DUI, Departamento y Municipio-->
<div class="pb-4">
    <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
        <!--DUI-->
        <div class="sm:col-span-3">
            <p id="texto" for="dui">DUI:</p>
            <div class="mt-2 ">
                <input type="text" name="dui" id="dui" placeholder="00000000-0" minlength="10"
                    maxlength="10" value="{{ $usuario->dui }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div>
        @php
            {{ 
            $partes = explode(',', $usuario->direccion);
            $departamento = trim($partes[0]);
            $municipio = isset($partes[1]) ? trim($partes[1]) : '';
        }}
        @endphp
        <!--Departamento-->
        <div class="sm:col-span-3">
            <p id="texto" for="producto">Departamento:</p>
            <div class="mt-2">
                <select name="depto" id="depto"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
                    <option value="">Seleccionar departamento</option>
                    <option value="San Salvador" {{ $departamento == 'San Salvador' ? 'selected' : '' }}>San Salvador</option>
                    <option value="Santa Ana" {{ $departamento == 'Santa Ana' ? 'selected' : '' }}>Santa Ana</option>
                    <option value="Sonsonate" {{ $departamento == 'Sonsonate' ? 'selected' : '' }}>Sonsonate</option>
                    <option value="Ahuachapan" {{ $departamento == 'Ahuachapan' ? 'selected' : '' }}>Ahuachapan</option>
                    <option value="La Libertad" {{ $departamento == 'La Libertad' ? 'selected' : '' }}>La Libertad</option>
                    <option value="Chalatenango" {{ $departamento == 'Chalatenango' ? 'selected' : '' }}>Chalatenango</option>
                    <option value="Cuscatlan" {{ $departamento == 'Cuscatlan' ? 'selected' : '' }}>Cuscatlan</option>
                    <option value="La Paz" {{ $departamento == 'La Paz' ? 'selected' : '' }}>La Paz</option>
                    <option value="Cabañas" {{ $departamento == 'Cabañas' ? 'selected' : '' }}>Cabañas</option>
                    <option value="San Vicente" {{ $departamento == 'San Vicente' ? 'selected' : '' }}>San Vicente</option>
                    <option value="Usulutan" {{ $departamento == 'Usulutan' ? 'selected' : '' }}>Usulutan</option>
                    <option value="Morazan" {{ $departamento == 'Morazan' ? 'selected' : '' }}>Morazan</option>
                    <option value="La Union" {{ $departamento == 'La Union' ? 'selected' : '' }}>La Union</option>
                    <option value="San Miguel" {{ $departamento == 'San Miguel' ? 'selected' : '' }}>San Miguel</option>
                </select>
            </div>
        </div>

        <!--Municipio-->
        <div class="sm:col-span-3">
            <p id="texto" class="block text-gray-700 text-sm font-bold mb-2">Municipio:</p>
            <div class="mt-2">
                <select name="municipio" id="municipio"
                    class="block w-full rounded-md border py-2 px-3 text-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Seleccionar municipio</option>
                    <?php foreach ($municipiosPorDepartamento as $departamento => $municipios) : ?>
                        <optgroup id="grupo_<?php echo $departamento; ?>" label="<?php echo $departamento; ?>" style="display: none;">
                            <?php foreach ($municipios as $municipioVar) : ?>
                                <option value="<?php echo $municipioVar; ?>" <?php echo ($municipio == $municipioVar) ? 'selected' : ''; ?>><?php echo $municipioVar; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="pb-4">
    <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
        <!--Contraseña-->
        <div class="sm:col-span-3">
            <p id="texto" for="password">Contraseña:</p>
            <div class="mt-2">
                <input type="password" name="password" id="password"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div>

        <!--Confirmar Contraseña-->
        <div class="sm:col-span-3">
            <p id="texto" for="password_confirmation">Confirmar contraseña:</p>
            <div class="mt-2">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    required>
            </div>
        </div>
    </div>
</div>


<!--Botones Guardar y Regresar-->
<div>
    <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
        <div class="sm:col-span-3">
            <div class="">
                <button type="submit"
                    class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Enviar</button>
            </div>
        </div>

        <div class="sm:col-span-3">
            <div class="">
                <a href="{{ route('listar_empleados') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                </a>
            </div>
        </div>
    </div>
</div>
</form>


<!--Script para validar que solo se escriban letras en el nombre y apellido-->
<script>
// Obtener el campo de entrada por su ID
var nombreInput = document.getElementById('name');
var apellidoInput = document.getElementById('apellido');


// Escuchar el evento 'input' en el campo de entrada
nombreInput.addEventListener('input', function() {
    // Obtener el valor del campo de entrada
    var valor = nombreInput.value;
    // Reemplazar cualquier caracter que no sea una letra, espacio, vocal tildada o la letra ñ por una cadena vacía
    valor = valor.replace(/[^A-Za-zÁÉÍÓÚáéíóúüÜñÑ\s]/g, '');
    // Actualizar el valor del campo de entrada
    nombreInput.value = valor;
});

// Escuchar el evento 'input' en el campo de entrada
apellidoInput.addEventListener('input', function() {
    // Obtener el valor del campo de entrada
    var valor = apellidoInput.value;
    // Reemplazar cualquier caracter que no sea una letra, espacio, vocal tildada o la letra ñ por una cadena vacía
    valor = valor.replace(/[^A-Za-zÁÉÍÓÚáéíóúüÜñÑ\s]/g, '');
    // Actualizar el valor del campo de entrada
    apellidoInput.value = valor;
});
</script>

<!--Script para aumentar la edad con el scroll del mouse-->
<script>
// Obtener el input
var inputNumber = document.getElementById('edad');

// Escuchar el evento 'wheel' para detectar el scroll del mouse
inputNumber.addEventListener('wheel', function(event) {
    // Verificar si se está haciendo scroll hacia arriba o hacia abajo
    var delta = Math.sign(event.deltaY);

    // Incrementar o decrementar el valor del input según el scroll
    if (delta > 0) {
        inputNumber.stepDown();
    } else {
        inputNumber.stepUp();
    }

    // Prevenir el comportamiento por defecto del scroll
    event.preventDefault();
});
</script>

<!--Script para el input de numero de telefono-->
<script>
// Obtener el input del teléfono
var telefonoInput = document.getElementById('telefono');

// Escuchar el evento 'input' para validar el contenido del input
telefonoInput.addEventListener('input', function() {
    // Obtener el valor del input
    var valor = telefonoInput.value;

    // Reemplazar todos los caracteres no numéricos
    valor = valor.replace(/\D/g, '');

    // Formatear el número en el formato ####-####
    var numeroFormateado = '';
    for (var i = 0; i < valor.length; i++) {
        numeroFormateado += valor[i];
        if (i == 3) {
            numeroFormateado += '-';
        }
    }

    // Actualizar el valor del input con el número formateado
    telefonoInput.value = numeroFormateado;

    // Validar si el número es válido (8 dígitos)
    if (valor.length === 8) {
        telefonoInput.setCustomValidity('');
    } else {
        telefonoInput.setCustomValidity('El número de teléfono debe tener 8 dígitos');
    }
});
</script>

<!--Script para el input de numero de DUI-->
<script>
// Obtener el input del dui
var duiInput = document.getElementById('dui');

// Escuchar el evento 'input' para validar el contenido del input
duiInput.addEventListener('input', function() {
    // Obtener el valor del input
    var valor = duiInput.value;

    // Reemplazar todos los caracteres no numéricos
    valor = valor.replace(/\D/g, '');

    // Formatear el número en el formato ########-#
    var numeroFormateado = '';
    for (var i = 0; i < valor.length; i++) {
        numeroFormateado += valor[i];
        if (i == 7) {
            numeroFormateado += '-';
        }
    }

    // Actualizar el valor del input con el número formateado
    duiInput.value = numeroFormateado;

    // Validar si el número es válido (9 dígitos)
    if (valor.length === 9) {
        duiInput.setCustomValidity('');
    } else {
        duiInput.setCustomValidity('El número de teléfono debe tener 9 dígitos');
    }
});
</script>


<!--Script para validar contraseña-->
<script>
// Obtener referencias a los campos de contraseña
var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('password_confirmation');

// Función para validar los campos de contraseña
function validarContraseña() {
    // Obtener los valores de los campos de contraseña
    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput.value;

    // Verificar si las contraseñas son iguales y tienen al menos 8 caracteres
    if (password === confirmPassword && password.length >= 8) {
        // Contraseñas válidas
        confirmPasswordInput.setCustomValidity('');
    } else {
        // Contraseñas inválidas
        confirmPasswordInput.setCustomValidity('Las contraseñas deben ser iguales y tener al menos 8 caracteres');
    }
}

// Escuchar el evento de cambio en ambos campos de contraseña
passwordInput.addEventListener('input', validarContraseña);
confirmPasswordInput.addEventListener('input', validarContraseña);
</script>

<script>
    var primeraVez = true;

    function actualizarMunicipios() {
        var departamentoSeleccionado = document.getElementById('depto').value;
        var opciones = document.getElementsByTagName('optgroup');
        for (var i = 0; i < opciones.length; i++) {
            opciones[i].style.display = 'none';
        }
        document.getElementById('grupo_' + departamentoSeleccionado).style.display = 'block';

        // Si no es la primera vez, deseleccionar el municipio
        if (!primeraVez) {
            document.getElementById('municipio').selectedIndex = 0;
        }

        // Cambiar el estado de primeraVez después de la primera ejecución
        primeraVez = false;
    }

    document.addEventListener('DOMContentLoaded', function() {
        actualizarMunicipios(); // Llama a la función al cargar la página
        document.getElementById('depto').addEventListener('change', actualizarMunicipios); // Llama a la función al cambiar la selección
    });
</script>

<script>
const municipiosPorDepartamento = {
    "San Salvador": ["San Salvador", "Aguilares", "Apopa", "Ayutuxtepeque", "Cuscatancingo", "Delgado",
        "El Paisnal", "Guazapa", "Ilopango", "Mejicanos", "Nejapa", "Panchimalco", "Rosario de Mora",
        "San Marcos", "San Martín", "Santiago Texacuangos", "Santo Tomás", "Soyapango", "Tonacatepeque"
    ],
    "Santa Ana": ["Santa Ana", "Candelaria de la Frontera", "Chalchuapa", "Coatepeque", "El Congo",
        "El Porvenir", "Masahuat", "Metapán", "San Antonio Pajonal", "San Sebastián Salitrillo",
        "Santa Rosa Guachipilín", "Santiago de la Frontera", "Texistepeque"
    ],
    "Sonsonate": ["Sonsonate", "Acajutla", "Armenia", "Caluco", "Cuisnahuat", "Izalco", "Juayúa", "Nahuizalco",
        "Nahulingo", "Salcoatitán", "San Antonio del Monte", "San Julián", "Santa Catarina Masahuat",
        "Santa Isabel Ishuatán", "Santo Domingo de Guzmán", "Sonzacate"
    ],
    "Ahuachapan": ["Ahuachapán", "Apaneca", "Atiquizaya", "Concepción de Ataco", "El Refugio", "Guaymango",
        "Jujutla", "San Francisco Menéndez", "San Lorenzo", "San Pedro Puxtla", "Tacuba", "Turín"
    ],
    "La Libertad": ["Santa Tecla", "Antiguo Cuscatlán", "Chiltiupán", "Ciudad Arce", "Colón", "Comasagua",
        "Huizúcar", "Jayaque", "Jicalapa", "La Libertad", "Nuevo Cuscatlán", "Quezaltepeque",
        "San Juan Opico", "Sacacoyo", "San José Villanueva", "San Matías", "San Pablo Tacachico",
        "Talnique", "Tamanique", "Teotepeque", "Tepecoyo", "Zaragoza"
    ],
    "Chalatenango": ["Chalatenango", "Agua Caliente", "Arcatao", "Azacualpa", "Cancasque", "Citalá", "Comalapa",
        "Concepción Quezaltepeque", "Dulce Nombre de María", "El Carrizal", "El Paraíso", "La Laguna",
        "La Palma", "La Reina", "Las Vueltas", "Nombre de Jesús", "Nueva Concepción", "Nueva Trinidad",
        "Ojos de Agua", "Potonico", "San Antonio de la Cruz", "San Antonio Los Ranchos", "San Fernando",
        "San Francisco Lempa", "San Francisco Morazán", "San Ignacio", "San Isidro Labrador",
        "San José Cancasque", "San José Las Flores", "San Luis del Carmen", "San Miguel de Mercedes",
        "San Rafael", "Santa Rita", "Tejutla"
    ],
    "Cuscatlan": ["Cojutepeque", "Candelaria", "El Carmen", "El Rosario", "Monte San Juan",
        "Oratorio de Concepción", "San Bartolomé Perulapía", "San Cristóbal", "San José Guayabal",
        "San Pedro Perulapán", "San Rafael Cedros", "San Ramón", "Santa Cruz Analquito",
        "Santa Cruz Michapa", "Suchitoto", "Tenancingo"
    ],
    "La Paz": ["Zacatecoluca", "Cuyultitán", "El Rosario", "Jerusalén", "Mercedes La Ceiba", "Olocuilta",
        "Paraíso de Osorio", "San Antonio Masahuat", "San Emigdio", "San Francisco Chinameca",
        "San Juan Nonualco", "San Juan Talpa", "San Juan Tepezontes", "San Luis La Herradura",
        "San Luis Talpa", "San Miguel Tepezontes", "San Pedro Masahuat", "San Pedro Nonualco",
        "San Rafael Obrajuelo", "Santa María Ostuma", "Santiago Nonualco", "Tapalhuaca"
    ],
    "Cabañas": ["Sensuntepeque", "Cinquera", "Dolores", "Guacotecti", "Ilobasco", "Jutiapa", "San Isidro",
        "Tejutepeque", "Victoria"
    ],
    "San Vicente": ["San Vicente", "Apastepeque", "Guadalupe", "San Cayetano Istepeque", "San Esteban Catarina",
        "San Ildefonso", "San Lorenzo", "San Sebastián", "Santa Clara", "Santo Domingo", "Tecoluca",
        "Tepetitán", "Verapaz"
    ],
    "Usulutan": ["Usulután", "Alegría", "Berlín", "California", "Concepción Batres", "El Triunfo",
        "Ereguayquín", "Estanzuelas", "Jiquilisco", "Jucuapa", "Jucuarán", "Mercedes Umaña",
        "Nueva Granada", "Ozatlán", "Puerto El Triunfo", "San Agustín", "San Buenaventura", "San Dionisio",
        "San Francisco Javier", "Santa Elena", "Santa María", "Santiago de María", "Tecapán", "Usulután"
    ],
    "Morazan": ["San Francisco Gotera", "Arambala", "Cacaopera", "Chilanga", "Corinto",
        "Delicias de Concepción", "El Divisadero", "El Rosario", "Gualococti", "Guatajiagua", "Joateca",
        "Jocoaitique", "Jocoro", "Lolotiquillo", "Meanguera", "Osicala", "Perquín", "San Carlos",
        "San Fernando", "San Isidro", "San Simón", "Sensembra", "Sociedad", "Torola", "Yamabal",
        "Yoloaiquín"
    ],
    "La Union": ["La Unión", "Anamorós", "Bolívar", "Concepción de Oriente", "Conchagua", "El Carmen",
        "El Sauce", "Intipucá", "Lislique", "Meanguera del Golfo", "Nueva Esparta", "Pasaquina", "Polorós",
        "San Alejo", "San José", "Santa Rosa de Lima", "Yayantique"
    ],
};

document.getElementById("depto").addEventListener("change", cargarMunicipios);
cargarMunicipios();
</script>
<!--Script para validar que No se escriban "-" ni "." en las edades-->
<script>
    document.getElementById('edad').addEventListener('input', function(e) {
        var value = this.value;

        // Remove any '-' or '.' characters from the input value
        this.value = value.replace(/[-.]/g, '');
    });

    // Prevent '-' and '.' from being entered into the input
    document.getElementById('edad').addEventListener('keydown', function(e) {
        if (e.key === '-' || e.key === '.') {
            e.preventDefault();
        }
    });
</script>
@endsection()