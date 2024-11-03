@extends('layouts.plantilla')

@section('tituloPagina', 'Asistencia')

@section('tituloSeccion', 'Empleados')

@section('tituloContenido', 'Lista de Asistencias')

@section('contenidoPagina')

    <!-- Formulario de filtrado -->
    <form method="GET" action="{{ route('asistencia.listado') }}" class="mb-4">
        <div class="grid grid-cols-1 gap-x-10 sm:grid-cols-9">
            <!-- Fecha de inicio -->
            <div class="sm:col-span-3">
                <label for="fecha_inicio" class="block text-gray-700">Fecha de Inicio:</label>
                <input type="date" id="fecha_historial" name="fecha_inicio" value="{{ request('fecha_inicio') }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            </div>
            <!-- Fecha de fin -->
            <div class="sm:col-span-3">
                <label for="fecha_fin" class="block text-gray-700">Fecha de Fin:</label>
                <input type="date" id="fecha_historial" name="fecha_fin" value="{{ request('fecha_fin') }}"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            </div>
            <!-- Botón de filtrar -->
            <div class="sm:col-span-3 flex items-end">
                <button type="submit"
                    class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Filtrar</button>
            </div>

            <!-- Botón Regresar -->
            <div class="sm:col-span-3">
                <a href="{{ route('asistencia') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                </a>
            </div>
        </div>
    </form>

    <!-- Tabla de asistencias -->
    <table class="border-collapse w-full">
        <!-- Encabezado de tabla -->
        <thead>
            <tr>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Empleado</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Fecha</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Entrada</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Salida</th>
            </tr>
        </thead>
        <!-- Contenido de la tabla -->
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <!-- Empleado -->
                    <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Empleado</span>
                        {{ $asistencia->user->name }} {{ $asistencia->user->apellido }}
                    </td>

                    <!-- Fecha -->
                    <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Fecha</span>
                        {{ $asistencia->fecha }}
                    </td>

                    <!-- Entrada -->
                    <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Entrada</span>
                        {{ $asistencia->check_in }}
                    </td>

                    <!-- Salida -->
                    <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Salida</span>
                        {{ $asistencia->check_out }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection