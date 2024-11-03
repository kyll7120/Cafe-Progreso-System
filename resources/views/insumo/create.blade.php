@extends('layouts.plantilla')

@section('tituloPagina', 'Registro de insumo')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Registro de insumo')

@section('contenidoPagina')
    <!--Formulario de creacion de insumos-->
    <form method="POST" action="{{ route('insumos.store') }}" class="form1" role="form" enctype="multipart/form-data">
        @csrf
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Nombre -->
                <div class="sm:col-span-3">
                    <label for="nombre" id="texto">Nombre:</label>
                    <div class="mt-2">
                        <input type="text" required name="nombre" id="nombre"
                            class="form-control @error('nombre') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            placeholder="Café en polvo" required>
                    </div>
                </div>

                <!-- Precio unitario -->
                <div class="sm:col-span-3">
                    <label for="precio_unitario" id="texto">Precio unitario:</label>
                    <div class="mt-2">
                        <input type="number" id="precio_unitario" name="precio_unitario" min="0"
                            class="form-control @error('precio_unitario') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            placeholder="5.50" step="any" required>
                    </div>
                </div>

                <!-- Existencias -->
                <div class="sm:col-span-3">
                    <label for="existencias" id="texto">Existencias:</label>
                    <div class="mt-2">
                        <input type="number" id="existencia" min="0" name="existencias"
                            class="form-control @error('existencias') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            placeholder="0.01" step="any" required>
                    </div>
                </div>

                <!-- Unidad -->
                <div class="sm:col-span-3">
                    <label for="unidad" id="texto">Unidad de medida:</label>
                    <div class="mt-2">
                        <select id="unidad" name="unidad"
                            class="form-control @error('unidad') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                            <option value="" disabled selected>Seleccione una unidad</option>
                            <option value="Gramos">Gramos</option>
                            <option value="Kilogramos">Kilogramos</option>
                            <option value="Litros">Litros</option>
                            <option value="Mililitros">Mililitros</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <!-- Botones -->
        <div>
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Botón agregar insumo -->
                <div class="sm:col-span-3">
                    <button type="submit"
                        class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Registrar
                    </button>
                </div>

                <!-- Botón Regresar -->
                <div class="sm:col-span-3">
                    <a href="{{ route('insumos.index') }}">
                        <button type="button"
                            class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                            Regresar
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </form>





@endsection
