@extends('layouts.plantilla')

@section('tituloPagina', 'Registro de empleado')

@section('tituloSeccion', 'Empleados')

@section('tituloContenido', 'Registro de empleado')

@section('contenidoPagina')

    <!--Formulario-->
    <form id="registroForm" action="{{ route('empleados.store') }}" method="POST" autocomplete="off">
        @csrf
        <!--Nombre, Apellidos y Fecha de Nacimiento-->
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--Nombre-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Nombres:</p>
                    <div class="mt-2 ">
                        <input type="text" name="name" id="name" placeholder="Manuel Alberto"
                            value="{{ old('name') }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--Apellidos-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Apellidos:</p>
                    <div class="mt-2 ">
                        <input type="text" name="apellido" id="apellido" placeholder="Arevalo Molina"
                            value="{{ old('apellido') }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--Fecha de Nacimiento-->
                <div class="sm:col-span-3">
                    <p id="texto" for="fecha_nacimiento">Fecha de Nacimiento:</p>
                    <div class="mt-2">
                        <input name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            placeholder="dd/mm/aaaa" required>
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
                        <select name="sexo" id="sexo" value="{{ old('sexo') }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                            <option value="">Seleccione una opcion</option>
                            <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino
                            </option>

                        </select>
                    </div>
                </div>

                <!--Telefono-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Teléfono:</p>
                    <div class="mt-2">
                        <input type="tel" name="telefono" id="telefono" placeholder="0000-0000" minlength="9"
                            value="{{ old('telefono') }}" maxlength="9"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--Correo-->
                <div class="sm:col-span-3">
                    <p id="texto" for="email">Correo:</p>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" placeholder="ejemplo@dominio.com"
                            value="{{ old('email') }}"
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
                            maxlength="10" value="{{ old('dui') }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--Departamento-->
                <div class="sm:col-span-3">
                    <p id="texto" for="producto">Departamento:</p>
                    <div class="mt-2">
                        <select name="depto" id="depto"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                            <option value="">Seleccionar departamento</option>
                            <option value="San Salvador" {{ old('depto') == 'San Salvador' ? 'selected' : '' }}>San
                                Salvador</option>
                            <option value="Santa Ana" {{ old('depto') == 'Santa Ana' ? 'selected' : '' }}>Santa Ana
                            </option>
                            <option value="Sonsonate" {{ old('depto') == 'Sonsonate' ? 'selected' : '' }}>Sonsonate
                            </option>
                            <option value="Ahuachapan" {{ old('depto') == 'Ahuachapan' ? 'selected' : '' }}>Ahuachapan
                            </option>
                            <option value="La Libertad" {{ old('depto') == 'La Libertad' ? 'selected' : '' }}>La Libertad
                            </option>
                            <option value="Chalatenango" {{ old('depto') == 'Chalatenango' ? 'selected' : '' }}>
                                Chalatenango</option>
                            <option value="Cuscatlan" {{ old('depto') == 'Cuscatlan' ? 'selected' : '' }}>Cuscatlan
                            </option>
                            <option value="La Paz" {{ old('depto') == 'La Paz' ? 'selected' : '' }}>La Paz</option>
                            <option value="Cabañas" {{ old('depto') == 'Cabañas' ? 'selected' : '' }}>Cabañas</option>
                            <option value="San Vicente" {{ old('depto') == 'San Vicente' ? 'selected' : '' }}>San Vicente
                            </option>
                            <option value="Usulutan" {{ old('depto') == 'Usulutan' ? 'selected' : '' }}>Usulutan</option>
                            <option value="Morazan" {{ old('depto') == 'Morazan' ? 'selected' : '' }}>Morazan</option>
                            <option value="La Union" {{ old('depto') == 'La Union' ? 'selected' : '' }}>La Union</option>
                        </select>

                    </div>
                </div>

                <!--Municipio-->
                <div class="sm:col-span-3">
                    <p id="texto" for="producto">Municipio:</p>
                    <div class="mt-2">
                        <select name="municipio" id="municipio"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                            <option value="">Seleccionar municipio</option>
                            <option value="San Salvador" {{ old('municipio') == 'San Salvador' ? 'selected' : '' }}>San
                                Salvador</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!--Contraseña-->
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--Contraseña-->
                <div class="sm:col-span-3">
                    <p id="texto" for="password">Contraseña:</p>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--Confirmar Contraseña-->
                <div class="sm:col-span-3">
                    <p id="texto" for="password_confirmation">Confirmar contraseña:</p>
                    <div class="mt-2">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            value="{{ old('password_confirmation') }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>
            </div>
        </div>

        <!--Botones Guardar y Regresar-->
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
            <!--button agregar producto-->
            <div class="sm:col-span-3">
                <div class="">
                    <button type="submit"
                        class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Registrar</button>
                </div>
            </div>

            <!-- Botón regresar-->
            <div class="sm:col-span-3">
                <div class="">
                    <a href="{{ route('listar_empleados') }}">
                        <button id="enviarDatosClientes" type="button"
                            class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                    </a>
                </div>
            </div>
        </div>
    </form>
    <script>
        //Script para cargar municipios (marlon)
        const municipiosPorDepartamento = {
            "San Salvador": [
                "San Salvador",
                "Aguilares",
                "Apopa",
                "Ayutuxtepeque",
                "Cuscatancingo",
                "Delgado",
                "El Paisnal",
                "Guazapa",
                "Ilopango",
                "Mejicanos",
                "Nejapa",
                "Panchimalco",
                "Rosario de Mora",
                "San Marcos",
                "San Martín",
                "Santiago Texacuangos",
                "Santo Tomás",
                "Soyapango",
                "Tonacatepeque",
            ],
            "Santa Ana": [
                "Santa Ana",
                "Candelaria de la Frontera",
                "Chalchuapa",
                "Coatepeque",
                "El Congo",
                "El Porvenir",
                "Masahuat",
                "Metapán",
                "San Antonio Pajonal",
                "San Sebastián Salitrillo",
                "Santa Rosa Guachipilín",
                "Santiago de la Frontera",
                "Texistepeque",
            ],
            Sonsonate: [
                "Sonsonate",
                "Acajutla",
                "Armenia",
                "Caluco",
                "Cuisnahuat",
                "Izalco",
                "Juayúa",
                "Nahuizalco",
                "Nahulingo",
                "Salcoatitán",
                "San Antonio del Monte",
                "San Julián",
                "Santa Catarina Masahuat",
                "Santa Isabel Ishuatán",
                "Santo Domingo de Guzmán",
                "Sonzacate",
            ],
            Ahuachapan: [
                "Ahuachapán",
                "Apaneca",
                "Atiquizaya",
                "Concepción de Ataco",
                "El Refugio",
                "Guaymango",
                "Jujutla",
                "San Francisco Menéndez",
                "San Lorenzo",
                "San Pedro Puxtla",
                "Tacuba",
                "Turín",
            ],
            "La Libertad": [
                "Santa Tecla",
                "Antiguo Cuscatlán",
                "Chiltiupán",
                "Ciudad Arce",
                "Colón",
                "Comasagua",
                "Huizúcar",
                "Jayaque",
                "Jicalapa",
                "La Libertad",
                "Nuevo Cuscatlán",
                "Quezaltepeque",
                "San Juan Opico",
                "Sacacoyo",
                "San José Villanueva",
                "San Matías",
                "San Pablo Tacachico",
                "Talnique",
                "Tamanique",
                "Teotepeque",
                "Tepecoyo",
                "Zaragoza",
            ],
            Chalatenango: [
                "Chalatenango",
                "Agua Caliente",
                "Arcatao",
                "Azacualpa",
                "Cancasque",
                "Citalá",
                "Comalapa",
                "Concepción Quezaltepeque",
                "Dulce Nombre de María",
                "El Carrizal",
                "El Paraíso",
                "La Laguna",
                "La Palma",
                "La Reina",
                "Las Vueltas",
                "Nombre de Jesús",
                "Nueva Concepción",
                "Nueva Trinidad",
                "Ojos de Agua",
                "Potonico",
                "San Antonio de la Cruz",
                "San Antonio Los Ranchos",
                "San Fernando",
                "San Francisco Lempa",
                "San Francisco Morazán",
                "San Ignacio",
                "San Isidro Labrador",
                "San José Cancasque",
                "San José Las Flores",
                "San Luis del Carmen",
                "San Miguel de Mercedes",
                "San Rafael",
                "Santa Rita",
                "Tejutla",
            ],
            Cuscatlan: [
                "Cojutepeque",
                "Candelaria",
                "El Carmen",
                "El Rosario",
                "Monte San Juan",
                "Oratorio de Concepción",
                "San Bartolomé Perulapía",
                "San Cristóbal",
                "San José Guayabal",
                "San Pedro Perulapán",
                "San Rafael Cedros",
                "San Ramón",
                "Santa Cruz Analquito",
                "Santa Cruz Michapa",
                "Suchitoto",
                "Tenancingo",
            ],
            "La Paz": [
                "Zacatecoluca",
                "Cuyultitán",
                "El Rosario",
                "Jerusalén",
                "Mercedes La Ceiba",
                "Olocuilta",
                "Paraíso de Osorio",
                "San Antonio Masahuat",
                "San Emigdio",
                "San Francisco Chinameca",
                "San Juan Nonualco",
                "San Juan Talpa",
                "San Juan Tepezontes",
                "San Luis La Herradura",
                "San Luis Talpa",
                "San Miguel Tepezontes",
                "San Pedro Masahuat",
                "San Pedro Nonualco",
                "San Rafael Obrajuelo",
                "Santa María Ostuma",
                "Santiago Nonualco",
                "Tapalhuaca",
            ],
            Cabañas: [
                "Sensuntepeque",
                "Cinquera",
                "Dolores",
                "Guacotecti",
                "Ilobasco",
                "Jutiapa",
                "San Isidro",
                "Tejutepeque",
                "Victoria",
            ],
            "San Vicente": [
                "San Vicente",
                "Apastepeque",
                "Guadalupe",
                "San Cayetano Istepeque",
                "San Esteban Catarina",
                "San Ildefonso",
                "San Lorenzo",
                "San Sebastián",
                "Santa Clara",
                "Santo Domingo",
                "Tecoluca",
                "Tepetitán",
                "Verapaz",
            ],
            Usulutan: [
                "Usulután",
                "Alegría",
                "Berlín",
                "California",
                "Concepción Batres",
                "El Triunfo",
                "Ereguayquín",
                "Estanzuelas",
                "Jiquilisco",
                "Jucuapa",
                "Jucuarán",
                "Mercedes Umaña",
                "Nueva Granada",
                "Ozatlán",
                "Puerto El Triunfo",
                "San Agustín",
                "San Buenaventura",
                "San Dionisio",
                "San Francisco Javier",
                "Santa Elena",
                "Santa María",
                "Santiago de María",
                "Tecapán",
                "Usulután",
            ],
            Morazan: [
                "San Francisco Gotera",
                "Arambala",
                "Cacaopera",
                "Chilanga",
                "Corinto",
                "Delicias de Concepción",
                "El Divisadero",
                "El Rosario",
                "Gualococti",
                "Guatajiagua",
                "Joateca",
                "Jocoaitique",
                "Jocoro",
                "Lolotiquillo",
                "Meanguera",
                "Osicala",
                "Perquín",
                "San Carlos",
                "San Fernando",
                "San Isidro",
                "San Simón",
                "Sensembra",
                "Sociedad",
                "Torola",
                "Yamabal",
                "Yoloaiquín",
            ],
            "La Union": [
                "La Unión",
                "Anamorós",
                "Bolívar",
                "Concepción de Oriente",
                "Conchagua",
                "El Carmen",
                "El Sauce",
                "Intipucá",
                "Lislique",
                "Meanguera del Golfo",
                "Nueva Esparta",
                "Pasaquina",
                "Polorós",
                "San Alejo",
                "San José",
                "Santa Rosa de Lima",
                "Yayantique",
            ],
            "San Miguel": [
                "San Miguel",
                "Carolina",
                "Chapeltique",
                "Chinameca",
                "Chirilagua",
                "Ciudad Barrios",
                "Comacarán",
                "El Tránsito",
                "Lolotique",
                "Moncagua",
                "Nueva Guadalupe",
                "Nuevo Edén de San Juan",
                "Quelepa",
                "San Antonio del Mosco",
                "San Gerardo",
                "San Jorge",
                "San Luis de la Reina",
                "San Rafael Oriente",
                "Sesori",
                "Uluazapa",
            ],
        };

        function cargarMunicipios() {
            const departamentoSeleccionado = document.getElementById("depto").value;
            const selectMunicipio = document.getElementById("municipio");
            const municipioSeleccionado = "{{ old('municipio') }}";

            selectMunicipio.innerHTML =
                "<option value=''>Seleccionar municipio</option>";

            if (municipiosPorDepartamento.hasOwnProperty(departamentoSeleccionado)) {
                municipiosPorDepartamento[departamentoSeleccionado].forEach(
                    (municipio) => {
                        const option = document.createElement("option");
                        option.value = municipio;
                        option.textContent = municipio;
                        if (municipio === municipioSeleccionado) {
                            option.selected = true;
                        }
                        selectMunicipio.appendChild(option);
                    }
                );
            }
        }

        document.getElementById("depto").addEventListener("change", cargarMunicipios);
        cargarMunicipios();

        //No se que hace xd
        var primeraVez = true;

        function actualizarMunicipios() {
            var departamentoSeleccionado = document.getElementById("depto").value;
            var opciones = document.getElementsByTagName("optgroup");
            for (var i = 0; i < opciones.length; i++) {
                opciones[i].style.display = "none";
            }
            document.getElementById("grupo_" + departamentoSeleccionado).style.display =
                "block";

            // Si no es la primera vez, deseleccionar el municipio
            if (!primeraVez) {
                document.getElementById("municipio").selectedIndex = 0;
            }

            // Cambiar el estado de primeraVez después de la primera ejecución
            primeraVez = false;
        }

        document.addEventListener("DOMContentLoaded", function() {
            actualizarMunicipios(); // Llama a la función al cargar la página
            document
                .getElementById("depto")
                .addEventListener("change", actualizarMunicipios); // Llama a la función al cambiar la selección
        });
    </script>
@endsection
