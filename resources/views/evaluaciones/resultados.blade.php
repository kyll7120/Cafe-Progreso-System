@extends('layouts.plantilla')

@section('tituloPagina', 'Resultados de Evaluaciones')

@section('tituloSeccion', 'Desempeño')

@section('tituloContenido', 'Resultados de Evaluaciones')

<!--Vista de la lista de resultados de evaluaciones-->
@section('contenidoPagina')

    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <!--El usuario Empleado no tiene permiso de ver esta parte-->
            <div class="sm:col-span-3">
                <a href="{{ route('home') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-gray-500 py-2 px-4 mb-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Ir al inicio
                    </button>
                </a>
            </div>
        </div>
    </div>

    @if ($evaluaciones->isEmpty())
        <div class="mt-5 pb-2">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <div class="sm:col-span-3 font-bold">No hay evaluaciones disponibles.</div>
            </div>
        </div>
    @else
        <!-- Tabla de Evaluaciones -->
        <table class="border-collapse w-full">
            <!-- Encabezado de tabla -->
            <thead>
                <tr>
                    <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300">Título</th>
                    <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300">Acciones</th>
                </tr>
            </thead>

            <!-- Contenido de la tabla -->
            <tbody>
                @foreach ($evaluaciones as $evaluacion)
                    <tr class="bg-white hover:bg-gray-100">
                        <!-- Título de Evaluación -->
                        <td class="p-2 text-principal text-center border border-b">
                            {{ $evaluacion->titulo }}
                        </td>

                        <!-- Acciones -->
                        <td class="p-2 text-principal text-center border border-b">
                            @if (auth()->user()->hasRole('Propietario') || auth()->user()->hasRole('Administrador'))
                                <a href="{{ route('evaluaciones.verUsuarios', $evaluacion->id) }}"
                                    class="text-blue-600 hover:underline">
                                    Ver Usuarios que Respondieron
                                </a>
                                <span class="mx-2">|</span> <!-- Separador -->
                                @if ($evaluacion->preguntas->isEmpty())
                                    <span class="text-gray-500">No hay preguntas</span>
                                @else
                                    <a href="{{ route('evaluaciones.graficos', $evaluacion->id) }}"
                                        class="text-blue-600 hover:underline">
                                        Ver Gráfico
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('evaluaciones.verRespuestas', ['evaluacion' => $evaluacion->id, 'user' => auth()->user()->id]) }}"
                                    class="text-blue-600 hover:underline">
                                    Ver Respuesta
                                </a>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación de Evaluaciones -->
        <div class="mt-4 flex justify-between items-center">
            <div>
                {{-- Mostrar el texto de paginación --}}
                Mostrando {{ $evaluaciones->firstItem() }} a {{ $evaluaciones->lastItem() }} de {{ $evaluaciones->total() }}
                evaluaciones
            </div>

            <div class="flex space-x-2">
                {{-- Botón para ir a la primera página --}}
                @if ($evaluaciones->onFirstPage())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
                @else
                    <a href="{{ $evaluaciones->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
                @endif

                {{-- Botón anterior --}}
                @if ($evaluaciones->onFirstPage())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
                @else
                    <a href="{{ $evaluaciones->previousPageUrl() }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
                @endif

                {{-- Botón siguiente --}}
                @if ($evaluaciones->hasMorePages())
                    <a href="{{ $evaluaciones->nextPageUrl() }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
                @else
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
                @endif

                {{-- Botón para ir a la última página --}}
                @if (!$evaluaciones->hasMorePages())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
                @else
                    <a href="{{ $evaluaciones->url($evaluaciones->lastPage()) }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
                @endif
            </div>
        </div>

    @endif

@endsection
