@extends('layouts.plantilla')

@section('tituloPagina', 'Edición de evaluación')

@section('tituloSeccion', 'Desempeño')

@section('tituloContenido', 'Edición de evaluación')

<!--Vista de ediacion de evaluaciones-->
@section('contenidoPagina')


    <!--Formulario de edición de evaluaciones-->
    <form method="POST" action="{{ route('evaluaciones.update', $evaluacion->id) }}" class="form1" autocomplete="off">
        @csrf
        @method('PUT')

        <!--Datos Título, Descripción y Fecha de Inicio-->
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Título -->
                <div class="sm:col-span-3">
                    <p for="titulo" id="texto">Título:</p>
                    <div class="mt-2">
                        <input type="text"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="titulo" name="titulo" value="{{ $evaluacion->titulo }}"
                            {{ $tieneRespuestas ? 'readonly' : 'required' }}>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="sm:col-span-3">
                    <p for="descripcion" id="texto">Descripción:</p>
                    <div class="mt-2">
                        <textarea
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="descripcion" name="descripcion" {{ $tieneRespuestas ? 'readonly' : 'required' }}>{{ $evaluacion->descripcion }}</textarea>
                    </div>
                </div>

                <!-- Fecha de Inicio -->
                <div class="sm:col-span-3">
                    <p for="fecha_inicio" id="texto">Fecha de Inicio:</p>
                    <div class="mt-2">
                        <input
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="fecha_inicio" name="fecha_inicio"
                            value="{{ \Carbon\Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y') }}"
                            placeholder="dd/mm/aaaa" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-3">
                <!-- Fecha de Fin -->
                <div class="col-span-1">
                    <p id="texto" for="fecha_fin">Fecha de Fin:</p>
                    <div class="mt-2">
                        <input
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="fecha_fin" name="fecha_fin"
                            value="{{ \Carbon\Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y') }}"
                            placeholder="dd/mm/aaaa" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preguntas (solo si no tiene respuestas) -->
        @if (!$tieneRespuestas)
            <div id="preguntas-container" class="col-span-2">
                <p id="texto">Preguntas:</p>
                <div id="preguntas" class="mt-2">
                    @foreach ($evaluacion->preguntas as $index => $pregunta)
                        <div class="pregunta-group flex items-center mb-2">
                            <input type="text"
                                class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                name="preguntas[{{ $pregunta->id }}]"
                                value="{{ old('preguntas.' . $pregunta->id, $pregunta->texto) }}"
                                placeholder="Texto de la pregunta">
                            <input type="hidden" name="preguntas_ids[]" value="{{ $pregunta->id }}">
                            <button type="button" class="btn btn-delete ml-2 removePregunta">Eliminar</button>
                        </div>
                    @endforeach

                    @foreach (old('preguntas', []) as $index => $texto)
                        @if (!isset($evaluacion->preguntas->pluck('id')->toArray()[$index]))
                            <div class="pregunta-group flex items-center mb-2">
                                <input type="text"
                                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                    name="preguntas[{{ $index }}]" value="{{ $texto }}"
                                    placeholder="Texto de la pregunta">
                                <button type="button" class="btn btn-delete ml-2 removePregunta">Eliminar</button>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="button" id="addPregunta" class="btn btn-edit mb-3">Agregar Pregunta</button>
            </div>
        @endif

        <!--Botones Actualizar y Regresar-->
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
            <!--Botón Actualizar evaluación-->
            <div class="sm:col-span-3">
                <div class="">
                    <button type="submit"
                        class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Editar</button>
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
@endsection
