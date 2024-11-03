@extends('layouts.plantilla')
@if (auth()->user()->hasRole('Propietario') || auth()->user()->hasRole('Administrador'))
@section('tituloPagina', 'Respuestas del Usuario')
@else
    @section('tituloPagina', 'Respuestas')
@endif

@section('tituloSeccion', 'Desempeño')

@if (auth()->user()->hasRole('Propietario') || auth()->user()->hasRole('Administrador'))
@section('tituloContenido', 'Respuestas de "' . $usuario->name . '" a la Evaluación "' . $evaluacion->titulo . '"')
@else
    @section('tituloContenido', 'Respuestas a la Evaluación "' . $evaluacion->titulo . '"')
@endif

@section('contenidoPagina')

    <div>
        <div class="form-group mb-5">
            <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
            <p><strong>Fecha de Resolución:</strong> {{ $respuestas->first()->created_at->format('d-m-Y') }}</p>
            <p><strong>Hora de Resolución:</strong> {{ $respuestas->first()->created_at->format('h:i a') }}</p>
        </div>
        <div class="form-group mb-5">
            <p><strong>Preguntas:</strong></p>

            <form>
                @foreach ($evaluacion->preguntas as $pregunta)
                    <div class="form-group mb-2 mb20">
                        <label>{{ $pregunta->texto }}</label>
                        <div class="flex items-center mt-2">
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="mr-8">
                                    <input type="radio" id="pregunta{{ $pregunta->id }}-{{ $i }}"
                                        name="respuestas[{{ $pregunta->id }}]" value="{{ $i }}"
                                        @if ($respuestas->where('pregunta_id', $pregunta->id)->first()->respuesta == $i) checked @endif disabled>
                                    <label for="pregunta{{ $pregunta->id }}-{{ $i }}"
                                        class="ml-1">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </form>
        </div>

        <!-- Botón regresar -->
        <div class="mt-4">
            @if (auth()->user()->hasRole('Propietario') || auth()->user()->hasRole('Administrador'))
            <a href="{{ route('evaluaciones.verUsuarios', $evaluacion->id) }}" class="text-blue-600 hover:underline">
                    <button type="button" class="rounded-md bg-gray-500 py-2 px-4 text-white hover:bg-gray-700">
                        Volver a Usuarios que respondieron
                    </button>
                </a>
            @else
                <a href="{{ route('resultados') }}">
                    <button type="button" class="rounded-md bg-gray-500 py-2 px-4 text-white hover:bg-gray-700">
                        Volver a Evaluaciones
                    </button>
                </a>
            @endif

        </div>
    </div>

@endsection
