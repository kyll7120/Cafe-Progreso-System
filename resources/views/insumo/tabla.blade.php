@extends('layouts.plantilla')

@section('tituloPagina', 'Registro de insumos')
@section('tituloSeccion', 'Inventario')
@section('tituloContenido', 'Uso de Insumos en Ventas')

@section('contenidoPagina')

    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
            <!-- Botón para generar gráfico -->
            <div class="sm:col-span-3">
                <form method="GET" action="{{ route('insumo.grafico') }}" id="formGrafico">
                    @csrf
                    <input type="hidden" name="insumos_usados" value="{{ json_encode(session('insumosUsados', [])) }}">
                    <button type="submit" id="btnGrafico"
                        class="rounded-md w-full bg-agregar py-2 px-4 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center"
                        @if (!session('insumosUsados') || count(session('insumosUsados')) === 0) disabled @endif>
                        Generar Gráfico
                    </button>
                </form>
            </div>

            <!--button regresar a vista de reportes-->
            <div class="sm:col-span-3">
                <a href="{{ route('insumo.vistaReporte') }}"
                    class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Regresar
                </a>
            </div>

            <!-- Botón para regresar al inicio -->
            <div class="sm:col-span-3">
                <a href="{{ route('home') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-gray-500 py-2 px-4 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Ir al inicio
                    </button>
                </a>
            </div>
        </div>
    </div>


    <!-- Tabla de insumos usados -->
    @if (isset($insumosUsados) && count($insumosUsados) > 0)
        <table class="border-collapse w-full mt-4">
            <!-- Encabezado de tabla -->
            <thead>
                <tr>
                    <th
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Insumo</th>
                    <th
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Cantidad Usada</th>
                    <th
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Cantidad Disponible</th>
                    <th
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Porcentaje de Uso</th>
                </tr>
            </thead>

            <!-- Contenido de la tabla -->
            <tbody>
                @foreach ($insumosUsados as $insumo)
                    <tr
                        class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Insumo</span>
                            {{ $insumo['nombre'] }}
                        </td>
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Cantidad
                                Usada</span>
                            {{ $insumo['cantidad_usada'] }}
                        </td>
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Cantidad
                                Disponible</span>
                            {{ $insumo['cantidad_disponible'] }}
                        </td>
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Porcentaje
                                de Uso</span>
                            {{ $insumo['porcentaje_uso'] }}%
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-4">No hay registros aún.</p>
    @endif
@endsection
