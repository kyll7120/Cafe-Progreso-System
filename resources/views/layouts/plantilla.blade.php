<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tituloPagina')</title>
    <!--Fuentes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!--Estilos y script de Flatpickr (calendario y hora)-->
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!--Script de traduccion-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <link rel="icon" href="{{ asset('logos2.png') }}" type="image/png" sizes="64x64">

    @vite(['resources/views/administracion/scriptAdministracion.js'])
    @vite(['resources/views/administracion/scriptAsistencia.js'])
    @vite(['resources/views/evaluaciones/scriptsEvaluaciones.js'])
    @vite(['resources/views/insumo/scriptsInsumo.js'])
    @vite(['resources/views/productos/scriptsProductos.js'])

    @vite('resources/css/app.css')
</head>

<body>
    <!--Barra lateral-->
    <nav id="menu" class="fixed bg-principal">
        <div id="menuLateral"
            class="overflow-hidden sidebar border-r border-fondo hover:shadow hover:text-fondo text-principal font-mont">
            <!--Boton inicio-->
            <div class="min-w-max movil:my-2 tablet:my-3 laptop:my-3 monitor:my-5">
                <ul id="listaIconosMenu">

                    <!--texto-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('home') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21">
                                <path fill="#F0F3FA"
                                    d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" />
                            </svg>
                            <!--texto-->
                            <span>Inicio</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!--Demas opciones-->
            <div class="flex h-screen flex-col movil:space-y-4 tablet:space-y-3 laptop:space-y-3 monitor:space-y-3">
                <!--Ventas  -->
                <ul id="listaIconosMenu">
                    <!--texto-->
                    <li class="min-w-max">
                        <p class="bg group text-sm flex items-center mx-5 font-mont font-semibold">Ventas</p>
                    </li>
                    <!--Opciones desplegables-->
                    <!--Registro-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('ventas.registrar') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                viewBox="0 0 24 24">
                                <path fill="#F0F3FA"
                                    d="M12.005 22.003c-5.523 0-10-4.477-10-10s4.477-10 10-10s10 4.477 10 10s-4.477 10-10 10m0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16m-3.5-6h5.5a.5.5 0 1 0 0-1h-4a2.5 2.5 0 1 1 0-5h1v-2h2v2h2.5v2h-5.5a.5.5 0 0 0 0 1h4a2.5 2.5 0 0 1 0 5h-1v2h-2v-2h-2.5z" />
                            </svg>
                            <!--texto-->
                            <span>Registro</span>
                        </a>
                    </li>

                    <!--El usuario Empleado no tiene permiso de ver esta parte-->
                    @canany(['Administrador', 'Propietario'])
                        <!--Historial-->
                        <li class="min-w-max hover:font-bold">
                            <a id="iconosMenu" href="{{ route('ventas.historial') }}">
                                <!--icono-->
                                <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#F0F3FA"
                                        d="M5.282 12.064c-.428.328-.72.609-.875.851c-.155.24-.249.498-.279.768h2.679v-.748H5.413c.081-.081.152-.151.212-.201c.062-.05.182-.142.361-.27c.303-.218.511-.42.626-.604c.116-.186.173-.375.173-.578a.898.898 0 0 0-.151-.512a.892.892 0 0 0-.412-.341c-.174-.076-.419-.111-.733-.111c-.3 0-.537.038-.706.114a.889.889 0 0 0-.396.338c-.094.143-.159.346-.194.604l.894.076c.025-.188.074-.317.147-.394a.375.375 0 0 1 .279-.108c.11 0 .2.035.272.108a.344.344 0 0 1 .108.258a.55.55 0 0 1-.108.297c-.074.102-.241.254-.503.453m.055 6.386a.398.398 0 0 1-.282-.105c-.074-.07-.128-.195-.162-.378L4 18.085c.059.204.142.372.251.506c.109.133.248.235.417.306c.168.069.399.103.692.103c.3 0 .541-.047.725-.14a1 1 0 0 0 .424-.403c.098-.175.146-.354.146-.544a.823.823 0 0 0-.088-.393a.708.708 0 0 0-.249-.261a1.015 1.015 0 0 0-.286-.11a.943.943 0 0 0 .345-.299a.673.673 0 0 0 .113-.383a.747.747 0 0 0-.281-.596c-.187-.159-.49-.238-.909-.238c-.365 0-.648.072-.847.219c-.2.143-.334.353-.404.626l.844.151c.023-.162.067-.274.133-.338s.151-.098.257-.098a.33.33 0 0 1 .241.089c.059.06.087.139.087.238c0 .104-.038.193-.117.27s-.177.112-.293.112a.907.907 0 0 1-.116-.011l-.045.649a1.13 1.13 0 0 1 .289-.056c.132 0 .237.041.313.126c.077.082.115.199.115.352c0 .146-.04.266-.119.354a.394.394 0 0 1-.301.134m.948-10.083V5h-.739a1.47 1.47 0 0 1-.394.523c-.168.142-.404.262-.708.365v.754a2.595 2.595 0 0 0 .937-.48v2.206zM9 6h11v2H9zm0 5h11v2H9zm0 5h11v2H9z" />
                                </svg>
                                <!--texto-->
                                <span>Historial</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['Administrador', 'Propietario'])
                        <!--Descuentos-->
                        <li class="min-w-max hover:font-bold">
                            <a id="iconosMenu" href="{{ route('descuentos.index') }}">
                                <!--icono-->
                                <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#F0F3FA"
                                        d="M19 3H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h14c1.11 0 2-.89 2-2V5a2 2 0 0 0-2-2m0 16H5V5h14zm-2-3.78c0 .98-.8 1.78-1.78 1.78s-1.77-.8-1.77-1.78s.79-1.77 1.77-1.77s1.78.79 1.78 1.77m-8.5 1.81L7 15.53L15.53 7l1.5 1.5zm-1.45-8.2c0-.99.79-1.78 1.78-1.78c.98 0 1.77.79 1.77 1.78c0 .98-.79 1.77-1.77 1.77c-.99 0-1.78-.79-1.78-1.77" />
                                </svg>
                                <!--texto-->
                                <span>Descuentos</span>
                            </a>
                        </li>
                    @endcan
                    <!--Reportes-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('ventas.reportes') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="none" stroke="#F0F3FA" stroke-width="1.5"
                                    d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                            </svg>
                            <!--texto-->
                            <span>Reportes</span>
                        </a>
                    </li>
                </ul>

                <!--Inventario-->
                <ul id="listaIconosMenu">
                    <!--texto-->
                    <li class="min-w-max">
                        <p class="bg group text-sm flex items-center mx-5 font-mont font-semibold">Inventario</p>
                    </li>

                    <!--Existencias-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('administracion.listarProductosEInsumos') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="#F0F3FA"
                                    d="m15.5 17.125l4.95-4.95q.275-.275.7-.275t.7.275t.275.7t-.275.7l-5.65 5.65q-.3.3-.7.3t-.7-.3l-2.85-2.85q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.175q.275-.875 1.075-1.437T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v4q0 .425-.288.713T20 10t-.712-.288T19 9V5h-2v2q0 .425-.288.713T16 8H8q-.425 0-.712-.288T7 7V5H5v14h5q.425 0 .713.288T11 20t-.288.713T10 21zm7-16q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5" />
                            </svg>
                            <!--texto-->
                            <span>Existencias</span>
                        </a>
                    </li>

                    @canany(['Administrador', 'Propietario'])
                        <!--Productos-->
                        <li class="min-w-max hover:font-bold">
                            <a id="iconosMenu" href="{{ route('productos.index') }}">
                                <!--icono-->
                                <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                    <path fill="#F0F3FA"
                                        d="M320 288v-22.336C320 154.688 405.504 64 512 64s192 90.688 192 201.664v22.4h131.072a32 32 0 0 1 31.808 28.8l57.6 576a32 32 0 0 1-31.808 35.2H131.328a32 32 0 0 1-31.808-35.2l57.6-576a32 32 0 0 1 31.808-28.8H320zm64 0h256v-22.336C640 189.248 582.272 128 512 128s-128 61.248-128 137.664v22.4zm-64 64H217.92l-51.2 512h690.56l-51.264-512H704v96a32 32 0 1 1-64 0v-96H384v96a32 32 0 0 1-64 0z" />
                                </svg>
                                <!--texto-->
                                <span>Productos</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['Administrador', 'Propietario'])
                        <!--Insumos-->
                        <li class="min-w-max hover:font-bold">
                            <a id="iconosMenu" href="{{ route('insumos.index') }}">
                                <!--icono-->
                                <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#F0F3FA" fill-rule="evenodd"
                                        d="M12 1.25c-.605 0-1.162.15-1.771.402c-.589.244-1.273.603-2.124 1.05L6.037 3.787c-1.045.548-1.88.987-2.527 1.418c-.668.447-1.184.917-1.559 1.554c-.374.635-.542 1.323-.623 2.142c-.078.795-.078 1.772-.078 3.002v.194c0 1.23 0 2.207.078 3.002c.081.82.25 1.507.623 2.142c.375.637.89 1.107 1.56 1.554c.645.431 1.481.87 2.526 1.418l2.068 1.085c.851.447 1.535.806 2.124 1.05c.61.252 1.166.402 1.771.402s1.162-.15 1.771-.402c.589-.244 1.273-.603 2.124-1.05l2.068-1.084c1.045-.549 1.88-.988 2.526-1.419c.67-.447 1.185-.917 1.56-1.554c.374-.635.542-1.323.623-2.142c.078-.795.078-1.772.078-3.001v-.196c0-1.229 0-2.206-.078-3.001c-.081-.82-.25-1.507-.623-2.142c-.375-.637-.89-1.107-1.56-1.554c-.645-.431-1.481-.87-2.526-1.418l-2.068-1.085c-.851-.447-1.535-.806-2.124-1.05c-.61-.252-1.166-.402-1.771-.402M8.77 4.046c.89-.467 1.514-.793 2.032-1.007c.504-.209.859-.289 1.198-.289c.34 0 .694.08 1.198.289c.518.214 1.141.54 2.031 1.007l2 1.05c1.09.571 1.855.974 2.428 1.356c.282.189.503.364.683.54l-3.331 1.665l-8.5-4.474zm-1.825.958l-.174.092c-1.09.571-1.855.974-2.427 1.356a4.646 4.646 0 0 0-.683.54L12 11.162l3.357-1.68l-8.206-4.318a.749.749 0 0 1-.206-.16M2.938 8.307c-.05.214-.089.457-.117.74c-.07.714-.071 1.617-.071 2.894v.117c0 1.278 0 2.181.071 2.894c.069.697.2 1.148.423 1.528c.222.377.543.696 1.1 1.068c.572.382 1.337.785 2.427 1.356l2 1.05c.89.467 1.513.793 2.031 1.007c.164.068.311.122.448.165v-8.663zm9.812 12.818c.137-.042.284-.096.448-.164c.518-.214 1.141-.54 2.031-1.007l2-1.05c1.09-.572 1.855-.974 2.428-1.356c.556-.372.877-.691 1.1-1.068c.223-.38.353-.83.422-1.528c.07-.713.071-1.616.071-2.893v-.117c0-1.278 0-2.181-.071-2.894a5.627 5.627 0 0 0-.117-.74L17.75 9.963V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75z"
                                        clip-rule="evenodd" />
                                </svg>
                                <!--texto-->
                                <span>Insumos</span>
                            </a>
                        </li>
                    @endcan
                    <!--Reportes-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('insumo.vistaReporte') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="none" stroke="#F0F3FA" stroke-width="1.5"
                                    d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                            </svg>
                            <!--texto-->
                            <span>Reportes</span>
                        </a>
                    </li>
                </ul>

                <!--Empleados-->
                <ul id="listaIconosMenu">
                    <!--texto-->
                    <li class="min-w-max">
                        <p class="bg group text-sm flex items-center mx-5 font-mont font-semibold">Empleados</p>
                    </li>
                    @canany(['Administrador', 'Propietario'])
                        <!--Asistencia-->
                        <li class="min-w-max hover:font-bold">
                            <a id="iconosMenu" href="{{ route('asistencia') }}">
                                <!--icono-->
                                <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#F0F3FA"
                                        d="M21 13.1c-.1 0-.3.1-.4.2l-1 1l2.1 2.1l1-1c.2-.2.2-.6 0-.8l-1.3-1.3c-.1-.1-.2-.2-.4-.2m-1.9 1.8l-6.1 6V23h2.1l6.1-6.1zM12.5 7v5.2l4 2.4l-1 1L11 13V7zM11 21.9c-5.1-.5-9-4.8-9-9.9C2 6.5 6.5 2 12 2c5.3 0 9.6 4.1 10 9.3c-.3-.1-.6-.2-1-.2s-.7.1-1 .2C19.6 7.2 16.2 4 12 4c-4.4 0-8 3.6-8 8c0 4.1 3.1 7.5 7.1 7.9l-.1.2z" />
                                </svg>
                                <!--texto-->
                                <span>Asistencia</span>
                            </a>
                        </li>
                    @endcan


                    @canany(['Administrador', 'Propietario'])
                        <!--Gestion-->
                        <li class="min-w-max hover:font-bold">
                            <a id="iconosMenu" href="{{ route('listar_empleados') }}">
                                <!--icono-->
                                <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                    <path fill="#F0F3FA"
                                        d="M243.6 148.8a6 6 0 0 1-8.4-1.2A53.58 53.58 0 0 0 192 126a6 6 0 0 1 0-12a26 26 0 1 0-25.18-32.5a6 6 0 0 1-11.62-3a38 38 0 1 1 59.91 39.63a65.7 65.7 0 0 1 29.69 22.27a6 6 0 0 1-1.2 8.4M189.19 213a6 6 0 0 1-2.19 8.2a5.9 5.9 0 0 1-3 .81a6 6 0 0 1-5.2-3a59 59 0 0 0-101.62 0a6 6 0 1 1-10.38-6a70.1 70.1 0 0 1 36.2-30.46a46 46 0 1 1 50.1 0A70.1 70.1 0 0 1 189.19 213M128 178a34 34 0 1 0-34-34a34 34 0 0 0 34 34m-58-58a6 6 0 0 0-6-6a26 26 0 1 1 25.18-32.51a6 6 0 1 0 11.62-3a38 38 0 1 0-59.91 39.63A65.7 65.7 0 0 0 11.2 140.4a6 6 0 1 0 9.6 7.2A53.58 53.58 0 0 1 64 126a6 6 0 0 0 6-6" />
                                </svg>
                                <!--texto-->
                                <span>Gestion</span>
                            </a>
                        </li>
                    @endcan
                    <!--Reportes-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('administracion.ReporteEmpleados') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="none" stroke="#F0F3FA" stroke-width="1.5"
                                    d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                            </svg>
                            <!--texto-->
                            <span>Reportes</span>
                        </a>
                    </li>
                </ul>

                <!--Desempeño-->
                <ul id="listaIconosMenu">
                    <!--texto-->
                    <li class="min-w-max">
                        <p class="text-sm bg group flex items-center mx-5 font-mont font-semibold">Desempeño</p>
                    </li>
                    <!--Evaluaciones-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('evaluaciones.index') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <path fill="#F0F3FA"
                                    d="M216 40H40a16 16 0 0 0-16 16v160a8 8 0 0 0 11.58 7.16L64 208.94l28.42 14.22a8 8 0 0 0 7.16 0L128 208.94l28.42 14.22a8 8 0 0 0 7.16 0L192 208.94l28.42 14.22A8 8 0 0 0 232 216V56a16 16 0 0 0-16-16m0 163.06l-20.42-10.22a8 8 0 0 0-7.16 0L160 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L96 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L40 203.06V56h176Zm-155.58-35.9a8 8 0 0 0 10.74-3.58L76.94 152h38.12l5.78 11.58a8 8 0 1 0 14.32-7.16l-32-64a8 8 0 0 0-14.32 0l-32 64a8 8 0 0 0 3.58 10.74M96 113.89L107.06 136H84.94ZM136 128a8 8 0 0 1 8-8h16v-16a8 8 0 0 1 16 0v16h16a8 8 0 0 1 0 16h-16v16a8 8 0 0 1-16 0v-16h-16a8 8 0 0 1-8-8" />
                            </svg>
                            <!--texto-->
                            <span>Evaluaciones</span>
                        </a>
                    </li>

                    <!--Resultados-->
                    <li class="min-w-max hover:font-bold">
                        <a id="iconosMenu" href="{{ route('resultados') }}">
                            <!--icono-->
                            <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                <g fill="none" stroke="#F0F3FA" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4">
                                    <path d="M20 10h24M20 24h24M20 38h24" />
                                    <circle cx="8" cy="24" r="4" />
                                    <circle cx="8" cy="38" r="4" />
                                    <path d="m4 10l3 3l6-6" />
                                </g>
                            </svg>
                            <!--texto-->
                            <span>Resultados</span>
                    </li>
                </ul>

                <!--Opcion Login-->
                <div class="w-max hover:font-bold ">
                    <a id="iconosMenu" href="{{ route('logout') }}">
                        <svg id="tamanioIconos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                            <path fill="#F0F3FA"
                                d="M234.38 210a123.36 123.36 0 0 0-60.78-53.23a76 76 0 1 0-91.2 0A123.36 123.36 0 0 0 21.62 210a12 12 0 1 0 20.77 12c18.12-31.32 50.12-50 85.61-50s67.49 18.69 85.61 50a12 12 0 0 0 20.77-12M76 96a52 52 0 1 1 52 52a52.06 52.06 0 0 1-52-52" />
                        </svg>
                        <span>Cerrar sesion</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Barra superior -->
    <header id="encabezado">
        <!-- Título de la seccion -->
        <h1 class="text-3xl font-mont font-semibold">@yield('tituloSeccion')</h1>
    </header>

    <!--Main-->
    <main class="movil:ml-[3.3rem] tablet:ml-[4.3rem] laptop:ml-[5.2rem] monitor:ml-[6.25rem] min-h-screen bg-fondo">

        <!-- Contenido -->
        <div class="mx-7 bg-contenido text-letra px-10 py-7">
            <!-- Modal de Notificación -->
            @if (session('success'))
                <div id="notification-modal"
                    class="bg-green-200 bg-opacity-75 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div id="notification-modal"
                    class="bg-red-200 bg-opacity-75 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">¡Ups! Algo salió mal.</strong>
                    <ul class="mt-3 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div id="notification-modal"
                    class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!--Titulo del contenido-->
            <h1 class="mb-2 text-2xl font-mont font-semibold">@yield('tituloContenido')</h1>
            @yield('contenidoPagina')

        </div>
    </main>

    <!--Pie de pagina-->
    <footer
        class="movil:ml-[3.3rem] tablet:ml-[4.3rem] laptop:ml-[5.2rem] monitor:ml-[6.25rem] bg-principal text-white px-6 py-5 text-center">
        <!-- Contenido del pie de página -->
        <p></p>
    </footer>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var modal = document.getElementById('notification-modal');
            if (modal) {
                modal.style.display = 'none';
            }
        }, 7000); // 70 segundos duracion de las notificaciones
    });
</script>

</html>
