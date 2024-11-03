@extends('layouts.plantilla')


@section('tituloPagina', 'Historial de ventas')

@section('tituloSeccion', 'Ventas')

@section('tituloContenido', 'Historial de ventas')

@section('contenidoPagina')

    <!--boton regresar-->
    <div class="mt-5 pb-4">
        <div class="grid grid-cols-1 gap-x-10 gap-y-2 sm:grid-cols-9 ">
            <!--boton Registrar venta-->
            <div class="sm:col-span-3">
                <a href="{{ route('ventas.registrar') }}"
                    class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Registrar
                    venta</a>
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

    @if ($ventas->isEmpty())
        <strong>No hay ventas registradas.</strong>
    @else
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th
                        class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Nº</th>
                    <th
                        class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Cliente</th>
                    <th
                        class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Fecha y hora</th>
                    <th
                        class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Total de venta</th>
                    <th
                        class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr
                        class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <!--Número-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                            {{ ++$i }}
                        </td>
                        <!--Nombre del cliente-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                            {{ $venta->nombre_cliente }}
                        </td>
                        <!--Fecha y hora-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                            {{ $venta->fecha_hora_venta }}
                        </td>
                        <!--Total de venta-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                            ${{ $venta->total_venta }}
                        </td>
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>
                            <!-- Botón a la vista de detalles -->
                            <a class="btn btn-show" href="{{ route('ventas.detalles', $venta->id) }}"><i
                                    class="fa fa-fw fa-eye"></i>Detalles</a>
                            <!-- Botón a la vista de detalles -->
                            <a class="btn btn-edit" href="{{ route('ventas.editar', $venta->id) }}"><i
                                    class="fa fa-fw fa-eye"></i>Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4 flex justify-between items-center">
            <div>
                Mostrando {{ $ventas->firstItem() }} a {{ $ventas->lastItem() }} de {{ $ventas->total() }} resultados
            </div>
            <div class="flex space-x-2">
                @if ($ventas->onFirstPage())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
                @else
                    <a href="{{ $ventas->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
                @endif

                @if ($ventas->onFirstPage())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
                @else
                    <a href="{{ $ventas->previousPageUrl() }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
                @endif

                @if ($ventas->hasMorePages())
                    <a href="{{ $ventas->nextPageUrl() }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
                @else
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
                @endif

                @if (!$ventas->hasMorePages())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
                @else
                    <a href="{{ $ventas->url($ventas->lastPage()) }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
                @endif
            </div>
        </div>
    @endif




@endsection()
