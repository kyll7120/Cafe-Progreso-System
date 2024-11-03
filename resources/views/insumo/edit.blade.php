@extends('layouts.plantilla')

@section('tituloPagina', 'Edición de insumo')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Edición de insumo')

@section('contenidoPagina')

    <form method="POST" action="{{ route('insumos.update', $insumo->id) }}" class="form1" role="form"
        enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Nombre -->
                <div class="sm:col-span-3">
                    <label for="nombre" id="texto">Nombre:</label>
                    <div class="mt-2">
                        <input type="text" required name="nombre" id="nombre"
                            class="form-control @error('nombre') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            value="{{ old('nombre', $insumo?->nombre) }}" placeholder="Ingrese el nombre" required>
                    </div>
                </div>

                <!-- Existencias -->
                <div class="sm:col-span-3">
                    <label for="existencias" id="texto">Existencias:</label>
                    <div class="mt-2">
                        <input type="number" id="existencia" min="0" name="existencias"
                            class="form-control @error('existencias') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            value="{{ old('existencias', $insumo?->existencias) }}" placeholder="Ingrese la cantidad" step="any"
                            required>
                    </div>
                </div>

                <!-- Unidad de medida -->
                <div class="sm:col-span-3">
                    <label for="unidad" id="texto">Unidad de medida:</label>
                    <div class="mt-2">
                        <select id="unidad" name="unidad"
                            class="form-control @error('unidad') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                            <option value="" disabled>Seleccione una unidad</option>
                            <option value="Gramos" {{ old('unidad', $insumo->unidad) == 'gramos' ? 'selected' : '' }}>Gramos
                            </option>
                            <option value="Kilogramos"
                                {{ old('unidad', $insumo->unidad) == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                            <option value="Litros" {{ old('unidad', $insumo->unidad) == 'litros' ? 'selected' : '' }}>Litros
                            </option>
                            <option value="Mililitros"
                                {{ old('unidad', $insumo->unidad) == 'mililitros' ? 'selected' : '' }}>Mililitros</option>
                        </select>
                    </div>
                    @error('unidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Precio unitario -->
                <div class="sm:col-span-3">
                    <label for="precio_unitario" id="texto">Precio unitario:</label>
                    <div class="mt-2">
                        <input type="number" id="precio_unitario" name="precio_unitario" min="0"
                            class="form-control @error('precio_unitario') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            value="{{ old('precio_unitario', $insumo?->precio_unitario) }}"
                            placeholder="Ingrese el precio unitario" step="any" required>
                    </div>
                </div>
            </div>
        </div>
        <!--Botones-->
        <div>
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--button editar insumo-->
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
                        <a href="{{ route('insumos.index') }}">
                            <button type="button"
                                class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
