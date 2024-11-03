@extends('layouts.plantilla')

@section('tituloPagina', 'Evaluaciones')

@section('tituloSeccion', 'Desempeño ')

@section('tituloContenido', 'Lista de evaluaciones')

<!--Vista de listado de evaluaciones-->
@section('contenidoPagina')

    <!--Boton de registrar y volver al inicio-->
    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <!--El usuario Empleado no tiene permiso de ver esta parte-->
            @canany(['Administrador', 'Propietario'])
                <div class="sm:col-span-3">
                    <a href="{{ route('evaluaciones.create') }}"
                        class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">
                        Registrar evaluación
                    </a>
                </div>
                <div class="sm:col-span-3">
                    <a href="{{ route('home') }}">
                        <button id="enviarDatosClientes" type="button"
                            class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                            Ir al inicio
                        </button>
                    </a>
                </div>
            @endcan

        </div>
    </div>

    @if ($evaluaciones->isEmpty())
        <div class="mt-5 pb-2">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <div class="sm:col-span-3 font-bold">No hay evaluaciones disponibles.</div>
            </div>
        </div>
    @else
        <!-- Tabla -->
        <table class="border-collapse w-full">
            <!--Encabezado de tabla-->
            <thead>
                <tr>
                    <th
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Título</th>
                    <th
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        N. preguntas</th>
                    <th colspan="2"
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Fecha
                        <div class="flex justify-around text-sm font-medium">
                            <p>Inicio</p>
                            <p>Fin</p>
                        </div>
                    </th>
                    <th
                        class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                        Acciones</th>
                </tr>
            </thead>

            <!--Contenido de la tabla-->
            <tbody>
                @foreach ($evaluaciones as $evaluacion)
                    <tr
                        class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <!--Nombre-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                            <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Título</span>
                            {{ $evaluacion->titulo }}
                        </td>

                        <!--N. preguntas-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N.
                                preguntas</span>
                            {{ count($evaluacion->preguntas) }}
                        </td>

                        <!--Fecha-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Fecha
                                inicio</span>
                            {{ \Carbon\Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y') }}
                        </td>
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                            <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Fecha
                                fin</span>
                            {{ \Carbon\Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y') }}
                        </td>

                        <!--Acciones-->
                        <td
                            class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                            <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>

                            <form action="{{ route('evaluaciones.destroy', $evaluacion->id) }}" method="POST"
                                class="flex justify-center space-x-1">
                                @php
                                    $haRespondido = $evaluacion->respuestas
                                        ->where('user_id', auth()->user()->id)
                                        ->isNotEmpty();
                                @endphp

                                @if (!$haRespondido)
                                    <a href="{{ route('evaluaciones.responder', $evaluacion->id) }}"
                                        class="btn btn-ins">Responder</a>
                                @else
                                    <span class="text-gray-500">Ya respondido</span>
                                @endif

                                @canany(['Administrador', 'Propietario'])
                                    <a class="btn btn-show" href="{{ route('evaluaciones.show', $evaluacion->id) }}">
                                        <i class="fa fa-fw fa-show"></i>Detalles
                                    </a>
                                    <a class="btn btn-edit" href="{{ route('evaluaciones.edit', $evaluacion->id) }}">
                                        <i class="fa fa-fw fa-edit"></i>Editar
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete"
                                        onclick="return confirm('¿Seguro de que desea eliminar esta evaluación?')">
                                        <i class="fa fa-fw fa-trash mx"></i>Eliminar
                                    </button>
                                @endcan
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4 flex justify-between items-center">
            <div>
                {{-- Mostrar el texto de paginación --}}
                Mostrando {{ $evaluaciones->firstItem() }} a {{ $evaluaciones->lastItem() }} de {{ $evaluaciones->total() }}
                resultados
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
