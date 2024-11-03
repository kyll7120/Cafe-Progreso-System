@extends('layouts.plantilla')

@section('tituloPagina', $titulo)

@section('tituloSeccion', 'Desempeño')

@section('tituloContenido', $titulo)

<!--Vista para responder una evaluacion-->
@section('contenidoPagina')
    <div class="container mx-auto">
        <div class="form-group mb-3 mb20">
            <strong>Indicaciones:</strong>
            Para cada actividad o aspecto evaluado, selecciona un número del 1 al 10, donde 1 representa una calificación
            muy baja y 10 representa una calificación excelente.
        </div>
        <div class="form-group mb-3 mb20">
            <p><strong>Preguntas:</strong></p>


            <form action="{{ route('respuestas.store') }}" method="POST">
                @csrf
                <input type="hidden" name="evaluacion_id" value="{{ $evaluacion->id }}">

                @foreach ($preguntas as $pregunta)
                    <div class="form-group mb-4 mb20">
                        <label for="pregunta{{ $pregunta->id }}">{{ $pregunta->texto }}</label>

                        <!-- Checkboxes para calificación 1 a 10 -->
                        <div class="flex items-center mt-2">
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="mr-8">
                                    <input type="radio" id="pregunta{{ $pregunta->id }}-{{ $i }}"
                                        name="respuestas[{{ $pregunta->id }}]" value="{{ $i }}" required>
                                    <label for="pregunta{{ $pregunta->id }}-{{ $i }}"
                                        class="ml-1">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endforeach
        </div>

        <!--Botones Guardar y Regresar-->
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
            <!--Botón Registrar evaluación-->
            <div class="sm:col-span-3">
                <div class="">
                    <button type="submit"
                        class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Enviar
                        Respuestas</button>
                </div>
            </div>

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
        </form>
    </div>
@endsection
