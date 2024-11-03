@extends('layouts.plantilla')

@section('tituloPagina', 'Registro de evaluación')

@section('tituloSeccion', 'Desempeño')

@section('tituloContenido', 'Registro de evaluación')

<!--Vista de creacion de evaluaciones-->
@section('contenidoPagina')
    <!--Formulario de creacion de evaluaciones-->
    <form method="POST" action="{{ route('evaluaciones.store') }}" role="form" enctype="multipart/form-data">
        @csrf
        <!--Datos Título, Descripción y Fecha de Inicio-->
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">

                <!-- Título -->
                <div class="sm:col-span-3">

                    <p for="titulo" id="texto">Título:</label>
                    <div class="mt-2">
                        <input type="text"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="titulo" name="titulo" placeholder="Evaluación 1" value="{{ old('titulo') }}" required>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="sm:col-span-3">
                    <p for="descripcion" id="texto">Descripción:</p>
                    <div class="mt-2">
                        <textarea
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="descripcion" name="descripcion" required>{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                <!-- Fecha de Inicio -->
                <div class="sm:col-span-3">
                    <p for="fecha_inicio" id="texto">Fecha de Inicio:</p>
                    <div class="mt-2">
                        <input
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="fecha_inicio" name="fecha_inicio"
                            value="{{ old('fecha_inicio', $evaluacion->fecha_inicio) }}" placeholder="dd/mm/aaaa" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Datos Fecha de Fin, Descripción y Fecha de Inicio -->
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-3">

                <!-- Fecha de Fin -->
                <div class="col-span-1">
                    <p id="texto" for="fecha_fin">Fecha de Fin:</p>
                    <div class="mt-2 ">
                        <input
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" placeholder="dd/mm/aaaa"
                            required>
                    </div>
                </div>

                <!-- Checkbox para ocultar/mostrar preguntas -->
                <div class="col-span-1">
                    <div class="mt-2 ">
                        <p id="texto">Mostrar Seccion de Preguntas:</p>
                        <input type="checkbox" id="togglePreguntas" class="form-checkbox">
                    </div>
                </div>
            </div>
        </div>

        <!-- Preguntas -->
        <div id="preguntas-container" class="col-span-2">
            <p id="texto">Preguntas:</p>
            <div id="preguntas" class="mt-2">
                @php
                    $preguntasOld = old('preguntas', []);
                @endphp

                @foreach ($evaluacion->preguntas as $index => $pregunta)
                    <div class="pregunta-group flex items-center mb-2">
                        <input type="text"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            name="preguntas[{{ $index }}]" value="{{ $preguntasOld[$index] ?? $pregunta->texto }}"
                            placeholder="Texto de la pregunta">
                        <input
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            type="hidden" name="preguntas_ids[]" value="{{ $pregunta->id }}">
                            <button type="button" class="btn btn-delete ml-2 removePregunta">Eliminar</button>
                        </div>
                @endforeach

                @for ($i = count($evaluacion->preguntas); $i < count($preguntasOld); $i++)
                    <div class="pregunta-group flex items-center mb-2">
                        <input type="text"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            name="preguntas[{{ $i }}]" value="{{ $preguntasOld[$i] }}"
                            placeholder="Texto de la pregunta">
                        <button type="button" class="btn btn-delete ml-2 removePregunta">Eliminar</button>
                    </div>
                @endfor
            </div>
            <button type="button" id="addPregunta" class="btn btn-edit mb-3">Agregar Pregunta</button>
        </div>

        <!--Botones Guardar y Regresar-->
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">

            <!--Botón Registrar evaluación-->
            <div class="sm:col-span-3">
                <div class="">
                    <button type="submit"
                        class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Registrar</button>
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
