@extends('layouts.plantilla')

@section('tituloPagina', 'Productos')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Lista de productos')

@section('contenidoPagina')

    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-2 sm:grid-cols-9 ">
            <!--button agregar Productos-->
            <div class="sm:col-span-3">
                <a href="{{ route('productos.create') }}"
                    class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Registrar
                    producto</a>
            </div>

            <!--boton recetas-->
            <div class="sm:col-span-3">
                <a href="{{ route('listar.recetas') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Ver
                        recetas
                    </button>
                </a>
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
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    N°</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Nombre</th>
                </th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Categoría
                </th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Precio unitario
                </th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Existencia
                </th>
                <th colspan="2"
                    class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Acciones
                </th>

            </tr>
        </thead>
        <!--Contenido de la tabla-->
        <tbody>
            @foreach ($productos as $product)
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
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre</span>{{ $product->nombre }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Categoria</span>
                        {{ $product->categoria->nombreCategoria ?? 'N/A' }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Precio
                            unitario</span>${{ $product->precio_unitario }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Existencia</span>
                        {{ $product->es_preparado ? 'N/A' : $product->existencias }}
                    </td>

                    <!--Acciones-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>


                        <form action="{{ route('productos.destroy', $product->id) }}" method="POST">
                            <!--Opcion de ver detalles-->
                            <a class="btn btn-show " href="{{ route('productos.show', $product->id) }}"><i
                                    class="fa fa-fw fa-eye"></i>Detalles</a>
                            <!--Boton de editar-->
                            <a class="btn btn-edit " href="{{ route('productos.edit', $product->id) }}">
                                <i class="fa fa-fw fa-edit"></i>Editar
                            </a>

                            @csrf
                            @method('DELETE')
                            <!--Boton de eliminar-->
                            <button class="mx-1 btn btn-delete" type="submit"
                                onclick="return confirm('¿Seguro de que desea eliminar este producto?')">
                                <i class="fa fa-fw fa-trash mx"></i>Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación de Productos -->
    <div class="mt-4 flex justify-between items-center">
        <div>
            {{-- Mostrar el texto de paginación --}}
            Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de {{ $productos->total() }} productos
        </div>

        <div class="flex space-x-2">
            {{-- Botón para ir a la primera página --}}
            @if ($productos->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
            @else
                <a href="{{ $productos->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
            @endif

            {{-- Botón anterior --}}
            @if ($productos->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
            @else
                <a href="{{ $productos->previousPageUrl() }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
            @endif

            {{-- Botón siguiente --}}
            @if ($productos->hasMorePages())
                <a href="{{ $productos->nextPageUrl() }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
            @else
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
            @endif

            {{-- Botón para ir a la última página --}}
            @if (!$productos->hasMorePages())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
            @else
                <a href="{{ $productos->url($productos->lastPage()) }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
            @endif
        </div>
    </div>

@endsection
