@extends('layouts.plantilla')

@section('tituloPagina', 'Inventario - Reportes')
@section('tituloSeccion', 'Inventario')
@section('tituloContenido', 'Reporte de insumos usados en ventas')

@section('contenidoPagina')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Seleccionar periodo de análisis: </h2>

        <!-- Formulario de filtrado por mes y año -->
        <form method="GET" action="{{ route('insumo.reporte') }}" class="mb-4">
            @csrf
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Mes y Año -->
                <div class="sm:col-span-4">
                    <label for="mes" class="block mb-1">Mes y Año:</label>
                    <input type="month" id="mes" name="mes"
                        class="form-control block w-full rounded-md border py-2 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        required>
                </div>
            </div>

            <!-- Botones centrados en la misma línea -->
            <div class="flex justify-left mt-10 space-x-10">
                <!-- Botón Generar Reporte -->
                <button type="submit"
                    class="rounded-md bg-agregar py-2 px-4 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 w-full">
                    Generar Reporte
                </button>

                <!-- Botón Ir al inicio -->
                <a href="{{ route('home') }}" class="w-full">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md bg-gray-500 py-2 px-4 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 w-full">
                        Ir al inicio
                    </button>
                </a>
            </div>
        </form>
    </div>
@endsection
