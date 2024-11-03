@extends('layouts.plantilla')

@section('tituloPagina', 'Descuentos')

@section('tituloSeccion', 'Descuentos')

@section('tituloContenido', 'Lista de descuentos')

@section('contenidoPagina')

    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <!--button agregar descuento-->
            <div class="sm:col-span-3">
                <a href="{{ route('descuentos.create') }}"
                    class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Registrar
                    descuento</a>
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

    <!-- Tabla -->
    <table class="border-collapse w-full">
        <!--Encabezado de tabla-->
        <thead>
            <tr>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    N°</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Nombre</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Porcentaje</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Productos</th>
                <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <!--Contenido de la tabla-->
        <tbody>
            @foreach ($descuentos as $descuento)
                <tr
                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <!--Numero-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                        {{ ++$i }}
                    </td>
                    <!--Nombre descuento-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre del
                            descuento</span>
                        {{ $descuento->nombre }}
                    </td>
                    <!--Porcentaje-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Porcentaje</span>
                        {{ $descuento->porcentaje * 100 }}%
                    </td>
                    <!--Productos-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Productos</span>
                        @if ($descuento->productos->isEmpty())
                            <span>N/A</span>
                        @else
                            <ul>
                                @foreach ($descuento->productos as $producto)
                                    <li>{{ $producto->nombre }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <!--Acciones-->
                    <td
                        class="text-center w-full lg:w-auto p-2 border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <!--Opcion de editar-->
                        <a class="btn btn-edit" href="{{ route('descuentos.edit', $descuento->id) }}">
                            <i class="fa fa-fw fa-edit"></i>Editar</a>

                        <form action="{{ route('descuentos.destroy', $descuento->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('¿Está seguro de que desea eliminar este descuento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Eliminar</button>
                        </form>
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-4 flex justify-between items-center">
        <div>
            {{-- Mostrar el texto de paginación --}}
            Mostrando {{ $descuentos->firstItem() }} a {{ $descuentos->lastItem() }} de {{ $descuentos->total() }}
            resultados
        </div>

        <div class="flex space-x-2">
            {{-- Botón para ir a la primera página --}}
            @if ($descuentos->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
            @else
                <a href="{{ $descuentos->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
            @endif

            {{-- Botón anterior --}}
            @if ($descuentos->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
            @else
                <a href="{{ $descuentos->previousPageUrl() }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
            @endif

            {{-- Botón siguiente --}}
            @if ($descuentos->hasMorePages())
                <a href="{{ $descuentos->nextPageUrl() }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
            @else
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
            @endif

            {{-- Botón para ir a la última página --}}
            @if (!$descuentos->hasMorePages())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
            @else
                <a href="{{ $descuentos->url($descuentos->lastPage()) }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
            @endif
        </div>
    </div>

@endsection
