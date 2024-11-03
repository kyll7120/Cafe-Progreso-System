@extends('layouts.plantilla')

@section('tituloPagina', 'Detalle de empleado')

@section('tituloSeccion', 'Empleados')

@section('tituloContenido', 'Detalle de empleado')

@section('contenidoPagina')
    <div class="container mx-auto">
        <div class="form-group mb-2 mb20">
            <strong>Nombre:</strong>
            {{ $usuario->name }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Apellido:</strong>
            {{ $usuario->apellido }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Fecha de nacimiento:</strong>
            {{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('d-m-Y') }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Edad:</strong>
            {{ $usuario->edad }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Sexo:</strong>
            {{ $usuario->sexo }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>DUI:</strong>
            {{ $usuario->dui }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Dirección:</strong>
            {{ $usuario->direccion }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Teléfono:</strong>
            {{ $usuario->telefono }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Email:</strong>
            {{ $usuario->email }}
        </div>

        <!--Botones Guardar y Regresar-->
        <div>
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Botón regresar-->
                <div class="sm:col-span-3">
                    <div class="">
                        <a href="{{ route('listar_empleados') }}">
                            <button type="button"
                                class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
