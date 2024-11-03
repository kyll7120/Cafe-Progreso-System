@extends('layouts.plantilla')

@section('tituloPagina', 'Existencias')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Lista de existencias')

@section('contenidoPagina')

    <form id="actualizar-existencias-form" action="{{ route('administracion.updateExistencias') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mt-5 pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!-- Botón actualizar existencias -->
                <div class="sm:col-span-3">
                    <button type="submit"
                        class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">
                        Actualizar existencias
                    </button>
                </div>
                <!--boton Regresar-->
                <div class="sm:col-span-3">
                    <a href="{{ route('home') }}">
                        <button type="button"
                            class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Ir
                            al inicio</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Columna Izquierda -->
            <div class="p-4 bg-white shadow-md rounded-lg">
                <h2 class="text-xl font-bold mb-4">Productos no preparados</h2>
                <table class="border-collapse w-full">
                    <thead>
                        <tr>
                            <th
                                class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                Nombre</th>
                            <th
                                class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                Existencias</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr
                                class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <!--Nombre-->
                                <td
                                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre</span>
                                    {{ $producto->nombre }}
                                </td>
                                <!--Existencias-->
                                <td
                                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Existencias</span>
                                    <input type="number" min="0" name="productos[{{ $producto->id }}]"
                                        value="{{ $producto->existencias }}"
                                        class="existencias-input rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación de Productos -->
                <div class="mt-4 flex justify-between items-center">
                    <div>
                        {{-- Mostrar el texto de paginación de productos --}}
                        Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de {{ $productos->total() }}
                        productos
                    </div>

                    <div class="flex space-x-2">
                        {{-- Botón para ir a la primera página de productos --}}
                        @if ($productos->onFirstPage())
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
                        @else
                            <a href="{{ $productos->url(1) }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
                        @endif

                        {{-- Botón anterior de productos --}}
                        @if ($productos->onFirstPage())
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
                        @else
                            <a href="{{ $productos->previousPageUrl() }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
                        @endif

                        {{-- Botón siguiente de productos --}}
                        @if ($productos->hasMorePages())
                            <a href="{{ $productos->nextPageUrl() }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
                        @else
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
                        @endif

                        {{-- Botón para ir a la última página de productos --}}
                        @if (!$productos->hasMorePages())
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
                        @else
                            <a href="{{ $productos->url($productos->lastPage()) }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Columna Derecha -->
            <div class="p-4 bg-white shadow-md rounded-lg">
                <h2 class="text-xl font-bold mb-4">Insumos</h2>
                <table class="border-collapse w-full">
                    <thead>
                        <tr>
                            <th
                                class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                Nombre</th>
                            <th
                                class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                Existencias</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($insumos as $insumo)
                            <tr
                                class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <!--Nombre-->
                                <td
                                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre</span>
                                    {{ $insumo->nombre }}
                                </td>
                                <!--Existencias-->
                                <td
                                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Existencias</span>
                                    <input type="number" min="0" step="any" name="insumos[{{ $insumo->id }}]"
                                        value="{{ $insumo->existencias }}"
                                        class="existencias-input rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginación de Insumos -->
                <div class="mt-4 flex justify-between items-center">
                    <div>
                        {{-- Mostrar el texto de paginación de insumos --}}
                        Mostrando {{ $insumos->firstItem() }} a {{ $insumos->lastItem() }} de {{ $insumos->total() }}
                        insumos
                    </div>

                    <div class="flex space-x-2">
                        {{-- Botón para ir a la primera página de insumos --}}
                        @if ($insumos->onFirstPage())
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
                        @else
                            <a href="{{ $insumos->url(1) }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
                        @endif

                        {{-- Botón anterior de insumos --}}
                        @if ($insumos->onFirstPage())
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
                        @else
                            <a href="{{ $insumos->previousPageUrl() }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
                        @endif

                        {{-- Botón siguiente de insumos --}}
                        @if ($insumos->hasMorePages())
                            <a href="{{ $insumos->nextPageUrl() }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
                        @else
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
                        @endif

                        {{-- Botón para ir a la última página de insumos --}}
                        @if (!$insumos->hasMorePages())
                            <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
                        @else
                            <a href="{{ $insumos->url($insumos->lastPage()) }}"
                                class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Función para manejar el scroll en los inputs
        function handleScroll(event) {
            var input = event.currentTarget;
            var delta = Math.sign(event.deltaY);
            delta > 0 ? input.stepDown() : input.stepUp();
            event.preventDefault();
        }

        // Obtener y configurar los inputs de existencias
        document.querySelectorAll('.existencias-input').forEach(input => {
            input.addEventListener('wheel', handleScroll);
        });
    </script>
@endsection
