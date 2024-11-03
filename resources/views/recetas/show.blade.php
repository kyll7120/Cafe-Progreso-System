@extends('layouts.plantilla')

@section('tituloPagina', 'Detalles de la Receta')

@section('tituloSeccion', 'Inventario')

@section('contenidoPagina')
    <div class="container mx-auto p-4">
        <h3 class="text-lg font-semibold mb-2">Detalles de la Receta para: {{ $producto->nombre }}</h3>

        <h6 class="text-md font-semibold mb-2">Insumos Asociados:</h6>
        <table class="border-collapse w-full">
            <!-- Encabezado de la tabla -->
            <thead>
                <tr>
                    <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Insumo
                    </th>
                    <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Cantidad Requerida
                    </th>
                </tr>
            </thead>

            <!-- Contenido de la tabla -->
            <tbody>
                @forelse ($recetas as $receta)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <!-- Insumo -->
                        <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Insumo</span>
                            {{ $receta->insumo->nombre }}
                        </td>

                        <!-- Cantidad Requerida -->
                        <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Cantidad Requerida</span>
                            {{ $receta->cantidad_requerida }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static font-bold">
                            No hay insumos asociados a este producto.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('listar.recetas') }}" class="mt-4 inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Volver</a>
    </div>
@endsection
