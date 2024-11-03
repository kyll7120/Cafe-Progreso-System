@extends('layouts.plantilla')

@section('tituloPagina', 'Edición de receta')
@section('tituloSeccion', 'Recetas')
@section('tituloContenido', 'Edición de receta')

@section('contenidoPagina')
    <form action="{{ route('receta.update', $receta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">

                <!-- Nombre del producto asociado -->
                <div class="sm:col-span-9">
                    <p id="texto" for="producto_id">Producto:</p>
                    <div class="mt-2">
                        <input type="text" name="producto_id" id="producto_id" value="{{ $producto->nombre }}" readonly
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    </div>
                </div>

                <!-- Tabla de insumos -->
                <div class="sm:col-span-9">
                    <p id="texto" for="insumos">Insumos:</p>
                    <div class="mt-2">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">Insumo</th>
                                    <th class="px-4 py-2 text-left">Cantidad Requerida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receta->producto->recetas as $receta)
                                    <tr>
                                        <td class="px-4 py-2">
                                            <input type="text" value="{{ $receta->insumo->nombre }}" readonly
                                                class="block w-full rounded-md border-1 bg-gray-100 placeholder:text-gray-400">
                                        </td>
                                        <td class="px-4 py-2">
                                            <input type="number" name="cantidades[{{ $receta->insumo_id }}]" min="0"
                                                value="{{ $receta->cantidad_requerida }}"
                                                class="w-full rounded-md border-1 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                                required step="0.01">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Botones Guardar -->
            <div>
                <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                    <!-- Botón guardar -->
                    <div class="sm:col-span-3">
                        <button type="submit"
                            class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Actualizar</button>
                    </div>

                    <!-- Botón Regresar -->
                    <div class="sm:col-span-3">
                        <a href="{{ route('listar.recetas') }}">
                            <button type="button"
                                class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
