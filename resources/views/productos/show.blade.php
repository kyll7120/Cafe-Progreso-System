@extends('layouts.plantilla')

@section('tituloPagina', 'Detalle de producto')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Detalle de producto')

@section('contenidoPagina')
    <div class="container mx-auto">
        <div class="form-group mb-2 mb20">
            <strong>Nombre:</strong>
            {{ $producto->nombre }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Categoria:</strong>
            {{ $producto->categoria->nombreCategoria }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Existencias:</strong>
            {{ $producto->existencias }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Precio Unitario:</strong>
            {{ $producto->precio_unitario }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>¿Es Preparado?:</strong>
            {{ $producto->es_preparado ? 'Sí' : 'No' }}
        </div>

        <!--Botones Guardar y Regresar-->
        <div>
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Botón regresar-->
                <div class="sm:col-span-3">
                    <div class="">
                        <a href="{{ route('productos.index') }}">
                            <button type="button"
                                class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
