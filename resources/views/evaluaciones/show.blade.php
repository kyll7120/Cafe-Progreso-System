@extends('layouts.plantilla')

@section('tituloPagina', 'Detalle de evaluación')

@section('tituloSeccion', 'Desempeño')

@section('tituloContenido', 'Detalle de evaluación')

@section('contenidoPagina')
    <div class="container mx-auto">
        <div class="form-group mb-2 mb20">
            <strong>Nombre:</strong>
            {{ $evaluacion->titulo }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Descripcion:</strong>
            {{ $evaluacion->descripcion }}
        </div>

        <div class="form-group mb-2 mb20">
            <strong>Fecha de Inicio:</strong>
            {{ \Carbon\Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y') }}

        </div>
        <div class="form-group mb-2 mb20">
            <strong>Fecha de Fin:</strong>
            {{ \Carbon\Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y') }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Preguntas:</strong>
            @if ($evaluacion->preguntas->isEmpty())
                <p>No hay preguntas asociadas a esta evaluación.</p>
            @else
                <ul>
                    @foreach ($evaluacion->preguntas as $index => $pregunta)
                        <li>{{ $index + 1 }}. {{ $pregunta->texto }}</li>
                    @endforeach
                </ul>
            @endif

            <!--Botones Actualizar y Regresar-->
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Botón regresar-->
                <div class="sm:col-span-3">
                    <div class="">
                        <a href="{{ route('evaluaciones.index') }}">
                            <button id="enviarDatosClientes" type="button"
                                class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
