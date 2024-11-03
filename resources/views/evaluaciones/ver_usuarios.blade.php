@extends('layouts.plantilla')

@section('tituloPagina', 'Usuarios que Respondieron')

@section('tituloSeccion', 'Desempeño')

@section('tituloContenido', 'Usuarios que Respondieron a la Evaluación')

<!--Vista de la lsita de usuario que respindieron a una evaluacion-->
@section('contenidoPagina')

    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <div class="sm:col-span-3">
                <a href="{{ route('resultados') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-gray-500 py-2 px-4 mb-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Ir a resultados
                    </button>
                </a>
            </div>
        </div>
    </div>

    @if ($usuariosQueRespondieron->isEmpty())
        <div class="mt-5 pb-2">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <div class="sm:col-span-3 font-bold">No hay respuestas disponibles para esta evaluación.</div>
            </div>
        </div>
    @else
        <!-- Tabla de Usuarios -->
        <table class="border-collapse w-full">
            <!-- Encabezado de tabla -->
            <thead>
                <tr>
                    <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300">Usuario</th>
                    <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300">Acciones</th>
                </tr>
            </thead>

            <!-- Contenido de la tabla -->
            <tbody>
                @foreach ($usuariosQueRespondieron as $usuario)
                    <tr class="bg-white hover:bg-gray-100">
                        <!-- Nombre del Usuario -->
                        <td class="p-2 text-principal text-center border border-b">
                            {{ $usuario->name }}
                        </td>

                        <!-- Acciones -->
                        <td class="p-2 text-principal text-center border border-b">
                            <a href="{{ route('evaluaciones.verRespuestas', ['evaluacion' => $evaluacion->id, 'user' => $usuario->id]) }}"
                                class="text-blue-600 hover:underline">
                                Ver Respuestas
                            </a>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación de Usuarios -->
        <div class="mt-4 flex justify-between items-center">
            <div>
                {{-- Mostrar el texto de paginación --}}
                Mostrando {{ $usuariosQueRespondieron->firstItem() }} a {{ $usuariosQueRespondieron->lastItem() }} de
                {{ $usuariosQueRespondieron->total() }} usuarios
            </div>

            <div class="flex space-x-2">
                {{-- Botón para ir a la primera página --}}
                @if ($usuariosQueRespondieron->onFirstPage())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
                @else
                    <a href="{{ $usuariosQueRespondieron->url(1) }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
                @endif

                {{-- Botón anterior --}}
                @if ($usuariosQueRespondieron->onFirstPage())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
                @else
                    <a href="{{ $usuariosQueRespondieron->previousPageUrl() }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
                @endif

                {{-- Botón siguiente --}}
                @if ($usuariosQueRespondieron->hasMorePages())
                    <a href="{{ $usuariosQueRespondieron->nextPageUrl() }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
                @else
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
                @endif

                {{-- Botón para ir a la última página --}}
                @if (!$usuariosQueRespondieron->hasMorePages())
                    <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
                @else
                    <a href="{{ $usuariosQueRespondieron->url($usuariosQueRespondieron->lastPage()) }}"
                        class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
                @endif
            </div>
        </div>

    @endif

@endsection
