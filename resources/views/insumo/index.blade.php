@extends('layouts.plantilla')

@section('tituloPagina', 'Insumos')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Lista de insumos')

@section('contenidoPagina')

    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <!--button agregar insumo-->
            <div class="sm:col-span-3">
                <a href="{{ route('insumos.create') }}"
                    class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Registrar
                    insumo</a>
            </div>
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
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    N°</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Nombre</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Existencia</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Unidad</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Precio unitario</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <!--Contenido de la tabla-->
        <tbody>
            @foreach ($insumos as $insumo)
                <tr
                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <!--Numero-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                        {{ ++$i }}
                    </td>
                    <!--Nombre-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre</span>
                        {{ $insumo->nombre }}
                    </td>
                    <!--Existencia-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Existencia</span>
                        {{ $insumo->existencias }}
                    </td>

                    <!--Unidad-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">unidad</span>
                        {{ $insumo->unidad }}
                    </td>

                    <!--Precio unitario-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Precio
                            unitario</span>
                        ${{ $insumo->precio_unitario }}
                    </td>

                    <!--Acciones-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>

                        <form action="{{ route('insumos.destroy', $insumo->id) }}" method="POST">
                            <!--Boton de editar-->
                            <a class="btn btn-edit" href="{{ route('insumos.edit', $insumo->id) }}"><i
                                    class="fa fa-fw fa-edit"></i>Editar</a>
                            @csrf
                            @method('DELETE')
                            <!--Boton de eliminar-->
                            <button type="submit" class="btn btn-delete"
                                onclick="return confirm('¿Seguro de que desea eliminar este insumo?')"><i
                                    class="fa fa-fw fa-trash mx"></i>Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación de Insumos -->
    <div class="mt-4 flex justify-between items-center">
        <div>
            {{-- Mostrar el texto de paginación --}}
            Mostrando {{ $insumos->firstItem() }} a {{ $insumos->lastItem() }} de {{ $insumos->total() }} insumos
        </div>

        <div class="flex space-x-2">
            {{-- Botón para ir a la primera página --}}
            @if ($insumos->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
            @else
                <a href="{{ $insumos->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
            @endif

            {{-- Botón anterior --}}
            @if ($insumos->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
            @else
                <a href="{{ $insumos->previousPageUrl() }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
            @endif

            {{-- Botón siguiente --}}
            @if ($insumos->hasMorePages())
                <a href="{{ $insumos->nextPageUrl() }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
            @else
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
            @endif

            {{-- Botón para ir a la última página --}}
            @if (!$insumos->hasMorePages())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
            @else
                <a href="{{ $insumos->url($insumos->lastPage()) }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
            @endif
        </div>
    </div>


@endsection
