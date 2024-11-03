@extends('layouts.plantilla')

@section('tituloPagina', 'Crear Receta')

@section('tituloSeccion', 'Inventario')

@section('tituloContenido', 'Crea tu receta')

@section('contenidoPagina')
    <div class="container mx-auto p-4">
        <!-- Dropdown para seleccionar un producto -->
        <div class="mb-4">
            <label for="productoSelect" class="block text-sm font-medium text-gray-700">Selecciona un Producto:</label>
            <select id="productoSelect"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="setProductoId(this.value)">
                <option value="" disabled selected>-- Selecciona un Producto --</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" {{ (session('producto_id') == $producto->id) ? 'selected' : '' }}>
                        {{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para abrir el modal -->
        <button onclick="toggleModal()" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Crear Receta
        </button>

        <!-- Tabla para mostrar las recetas -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Lista de Recetas</h3>
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">N°</th>
                        <th class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">Producto</th>
                        <th colspan="2" class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                            <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                                {{ $loop->iteration }}
                            </td>
                            <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Producto</span>
                                {{ $producto->nombre }}
                            </td>
                            <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                                @if ($producto->recetas->isNotEmpty())
                                    <a class="btn btn-show" href="{{ route('receta.show', $producto->recetas->first()->id) }}"><i class="fa fa-fw fa-eye"></i>Ver</a>
                                    <a class="btn btn-edit mx-1" href="{{ route('receta.edit', $producto->recetas->first()->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                    <form method="POST" action="{{ route('receta.destroy', $producto->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-delete" type="submit" onclick="return confirm('¿Seguro de que desea eliminar esta receta?')">
                                            <i class="fa fa-fw fa-trash"></i>Eliminar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Sin recetas</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para crear y editar receta -->
    <div id="myModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b flex justify-between">
                <h5 class="text-lg font-semibold">Crear Nueva Receta</h5>
                <button onclick="finalizarReceta()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <div class="p-4">
                <form id="recetaForm" method="POST" action="{{ route('receta.store') }}">
                    @csrf
                    <input type="hidden" name="producto_id" id="producto_id" value="{{ session('producto_id') }}">
                    
                    <!-- Seleccionar insumo -->
                    <div class="mb-4">
                        <label for="insumo" class="block text-sm font-medium text-gray-700">Insumo:</label>
                        <select name="insumo_id" id="insumo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>-- Selecciona un Insumo --</option>
                            @foreach ($insumos as $insumo)
                                <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cantidad requerida -->
                    <div class="mb-4">
                        <label for="cantidad_requerida" class="block text-sm font-medium text-gray-700">Cantidad Requerida:</label>
                        <input type="number" name="cantidad_requerida" id="cantidad_requerida" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Guardar Receta</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Función para abrir y cerrar el modal
        function toggleModal() {
            const modal = document.getElementById('myModal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        // Función para finalizar la receta y cerrar el modal
        function finalizarReceta() {
            toggleModal();
            // Opcional: Puedes agregar lógica aquí si necesitas realizar alguna acción adicional al cerrar el modal
        }

        // Configurar el estado inicial del modal basado en la sesión
        document.addEventListener('DOMContentLoaded', () => {
            if ('{{ session('modalOpen') }}' === '1') {
                toggleModal();
            }
        });

        // Establecer el ID del producto seleccionado
        function setProductoId(id) {
            document.getElementById('producto_id').value = id;
        }
    </script>
@endsection
