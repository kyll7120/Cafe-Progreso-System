@extends('layouts.plantilla')

@section('tituloPagina', 'Respuestas de ' . $usuario->name)

<!--Vista de respuestas de una usuario a una evaluacion-->
@section('contenido')
    <h1>Respuestas de {{ $usuario->name }} para la evaluación: {{ $evaluacion->titulo }}</h1>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluacion->preguntas as $pregunta)
                <tr>
                    <td>{{ $pregunta->texto }}</td>
                    <td>
                        @php
                            $respuesta = $respuestas->firstWhere('pregunta_id', $pregunta->id);
                        @endphp
                        {{ $respuesta->respuesta ?? 'Sin respuesta' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('resultados') }}" class="btn btn-secondary mt-3">Volver a Resultados</a>
@endsection
