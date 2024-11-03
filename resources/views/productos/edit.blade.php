@extends('layouts.plantilla')

@section('tituloPagina', 'Edición de producto')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Edición de producto')

@section('contenidoPagina')

    <form id="form-1" action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--Nombre-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Nombre:</p>
                    <div class="mt-2 ">
                        <input type="text" name="nombre" id="nombre" placeholder="Cafe"
                            value="{{ $producto->nombre }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--Precio unitario-->
                <div class="sm:col-span-3">
                    <p for="precio_unitario" id="texto">Precio unitario:</p>
                    <div class="mt-2">
                        <input type="number" id="precio_unitario" name="precio_unitario" min="0.00"
                            value="{{ $producto->precio_unitario }}"
                            class="w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            placeholder="Ingrese el precio" required step="any">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <!--Categoria-->
                <div class="sm:col-span-3">
                    <p id="texto" for="id_categoria">Categoria:</p>
                    <div class="mt-2">
                        <select name="id_categoria"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ $categoria->id == $producto->id_categoria ? 'selected' : '' }}>
                                    {{ $categoria->nombreCategoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Es Preparado -->
                <div class="sm:col-span-3">
                    <p id="texto" for="es_preparado">¿Es preparado?</p>
                    <div class="mt-2">
                        <input type="hidden" name="es_preparado" value="0">
                        <input type="checkbox" id="es_preparado" name="es_preparado" value="1"
                            class="rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            {{ $producto->es_preparado ? 'checked' : '' }}>
                        <label for="es_preparado" class="text-gray-700">Sí</label>
                    </div>
                </div>

                <!-- Existencias -->
                <div class="sm:col-span-3" id="existencias-field">
                    <p id="texto" for="existencias">Existencias:</p>
                    <div class="mt-2">
                        <input type="number" id="existencias" name="existencias" value="{{ $producto->existencias }}"
                            min="0"
                            class="w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            placeholder="Ingrese las existencias" required>
                    </div>
                </div>
            </div>

            <!--Botones Guardar-->
            <div>
                <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                    <!--button agregar insumo-->
                    <div class="sm:col-span-3">
                        <div class="">
                            <button type="submit"
                                class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Editar</button>
                        </div>
                    </div>

                    <!-- Botón Regresar-->
                    <div class="sm:col-span-3">
                        <div class="">
                            <!--Pendiente-->
                            <a href="{{ route('productos.index') }}">
                                <button type="button"
                                    class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    
@endsection
