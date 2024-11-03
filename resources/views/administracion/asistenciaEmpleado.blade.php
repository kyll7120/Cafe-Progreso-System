@extends('layouts.plantilla')

@section('tituloPagina', 'Asistencia')

@section('tituloSeccion', 'Empleados')

@section('tituloContenido', 'Registro de asistencia')

@section('contenidoPagina')

    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <!--button lista de asistencia-->
            <div class="sm:col-span-3">
                <a href="{{ route('asistencia.listado') }}"
                    class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Historial
                    de asistencias</a>
            </div>
            <!--boton regresar-->
            <div class="sm:col-span-3">
                <a href="{{ route('home') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Ir
                        al inicio</button>
                </a>
            </div>
        </div>
    </div>

    <!--Tabla de empleados-->
    <table class="border-collapse w-full">
        <!-- Encabezado de tabla -->
        <thead>
            <tr>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    ID</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Nombre</th>

                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Entrada</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Salida</th>
            </tr>
        </thead>
        <!-- Contenido de la tabla -->
        <tbody>
            @foreach ($empleados as $empleado)
                <tr
                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">ID</span>
                        {{ $empleado->id }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre</span>
                        {{ $empleado->name }} {{ $empleado->apellido }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Entrada</span>

                        <!-- Formulario de Entrada Rápida -->
                        <form id="formRapido-{{ $empleado->id }}" action="{{ route('asistencia.check-in', $empleado->id) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="modo" value="rapido">
                            <!--Este boton se desactiva cuando se esta fuera de horario laboral (7am - 8pm)-->
                            <button type="submit"
                                class="btn btn-show @if ($horaActual->hour < 7 || $horaActual->hour >= 20) opacity-50 cursor-not-allowed @endif"
                                @if ($horaActual->hour < 7 || $horaActual->hour >= 20) disabled  title="Desactivado hasta estar en horario laboral" @endif>
                                Rápida
                            </button>
                        </form>

                        <!-- Formulario de Entrada Personalizada -->
                        <form id="formPersonalizado-{{ $empleado->id }}" class="hidden"
                            action="{{ route('asistencia.check-in', $empleado->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="modo" value="personalizado">
                            <input class="flatpickr-input" name="fecha" id="fecha" value="{{ old('fecha') }}"
                                placeholder="Fecha" required>
                            <input class="flatpickr-input" name="hora" id="hora" value="{{ old('hora') }}"
                                placeholder="Hora" required>
                            <button type="submit" class="btn btn-show">Registrar</button>
                        </form>

                        <!-- Checkbox para seleccionar el modo de entrada -->
                        <label for="toggleForm-{{ $empleado->id }}">Personalizada</label>
                        <input type="checkbox" id="toggleForm-{{ $empleado->id }}">
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Salida</span>

                        <!-- Formulario de Salida Rápida -->
                        <form id="formSalidaRapida-{{ $empleado->id }}"
                            action="{{ route('asistencia.check-out', $empleado->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="modo" value="rapido">
                            <!--Este boton se desactiva cuando se esta fuera de horario laboral (7am - 8pm)-->
                            <button type="submit"
                                class="btn btn-delete @if ($horaActual->hour < 7 || $horaActual->hour >= 20) opacity-50 cursor-not-allowed @endif"
                                @if ($horaActual->hour < 7 || $horaActual->hour >= 20) disabled  title="Desactivado hasta estar en horario laboral" @endif>
                                Rápida
                            </button>
                        </form>

                        <!-- Formulario de Salida Personalizada -->
                        <form id="formSalidaPersonalizada-{{ $empleado->id }}" class="hidden"
                            action="{{ route('asistencia.check-out', $empleado->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="modo" value="personalizado">
                            <input class="flatpickr-input" id="hora" name="hora" value="{{ old('hora') }}"
                                placeholder="Hora" required>
                            <button type="submit" class="btn btn-delete">Registrar</button>
                        </form>

                        <!-- Checkbox para seleccionar el modo de salida -->
                        <label for="toggleFormSalida-{{ $empleado->id }}">Personalizada</label>
                        <input type="checkbox" id="toggleFormSalida-{{ $empleado->id }}">
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

<!-- Paginación -->
<div class="mt-4 flex justify-between items-center">
    <div>
        {{-- Mostrar el texto de paginación --}}
        Mostrando {{ $empleados->firstItem() }} a {{ $empleados->lastItem() }} de {{ $empleados->total() }}
        resultados
    </div>

    <div class="flex space-x-2">
        {{-- Botón para ir a la primera página --}}
        @if ($empleados->onFirstPage())
            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
        @else
            <a href="{{ $empleados->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
        @endif

        {{-- Botón anterior --}}
        @if ($empleados->onFirstPage())
            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
        @else
            <a href="{{ $empleados->previousPageUrl() }}"
                class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
        @endif

        {{-- Botón siguiente --}}
        @if ($empleados->hasMorePages())
            <a href="{{ $empleados->nextPageUrl() }}"
                class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
        @else
            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
        @endif

        {{-- Botón para ir a la última página --}}
        @if (!$empleados->hasMorePages())
            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
        @else
            <a href="{{ $empleados->url($empleados->lastPage()) }}"
                class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
        @endif
    </div>
</div>
    
    <style>
        .flatpickr-input {
            width: 100px;
            padding: 5px;
        }
    </style>
@endsection
