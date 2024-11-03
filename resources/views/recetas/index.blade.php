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
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>-- Selecciona un Producto --</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
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
                <!-- Encabezado de la tabla -->
                <thead>
                    <tr>
                        <th
                            class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                            N°</th>
                        <th
                            class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                            Producto</th>
                        <th colspan="2"
                            class="p-2 font-bold bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                            Acciones</th>
                    </tr>
                </thead>

                <!-- Contenido de la tabla -->
                <tbody>
                    @foreach ($productos as $producto)
                        <tr
                            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                            <!-- Número -->
                            <td
                                class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                                {{ $loop->iteration }}
                            </td>

                            <!-- Producto -->
                            <td
                                class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Producto</span>
                                {{ $producto->nombre }}
                            </td>

                            <!-- Acciones -->
                            <td
                                class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>

                                @if ($producto->recetas->isNotEmpty())
                                    <a class="btn btn-show"
                                        href="{{ route('receta.show', $producto->recetas->first()->id) }}"><i
                                            class="fa fa-fw fa-eye"></i>Ver</a>
                                    <a class="btn btn-edit mx-1"
                                        href="{{ route('receta.edit', $producto->recetas->first()->id) }}"><i
                                            class="fa fa-fw fa-edit"></i>Editar</a>
                                    <form method="POST"
                                        action="{{ route('receta.destroy', $producto->id) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-delete" type="submit"
                                            onclick="return confirm('¿Seguro de que desea eliminar esta receta?')">
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



    <!-- Modal para crear y editar receta-->
    <div id="myModal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b flex justify-between">
                <h5 class="text-lg font-semibold">Crear Nueva Receta</h5>
                <button onclick="finalizarReceta()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <div class="p-4">
                <form id="recetaForm" method="POST" action="{{ route('receta.store') }}">
                    @csrf
                    <!-- Seleccionar producto -->
                    <input type="hidden" name="producto_id" id="producto_id">

                    <!-- Seleccionar insumo -->
                    <div class="mb-4">
                        <label for="insumo" class="block text-sm font-medium text-gray-700">Insumo:</label>
                        <select name="insumo_id" id="insumo"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="" disabled selected>-- Selecciona un Insumo --</option>
                            @foreach ($insumos as $insumo)
                                <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cantidad requerida -->
                    <div class="mb-4">
                        <label for="cantidad_requerida" class="block text-sm font-medium text-gray-700">Cantidad
                            Requerida:</label>
                        <input type="number" step="0.01" name="cantidad_requerida" id="cantidad_requerida"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <button type="submit" onclick=""
                        class="w-full px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Agregar</button>
                </form>

                <!-- Tabla para mostrar insumos agregados -->
                <div class="mt-4">
                    <h6 class="text-lg font-semibold mb-2">Insumos Agregados</h6>
                    <table class="min-w-full border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Insumo</th>
                                <th class="border px-4 py-2">Cantidad</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('recetasProducto') && session('recetasProducto')->isNotEmpty())
                                @foreach (session('recetasProducto') as $receta)
                                    <tr>
                                        <td class="border px-4 py-2 text-center">{{ $receta->insumo->nombre }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $receta->cantidad_requerida }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="{{ route('receta.eliminarInsumo', $receta->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-delete" type="submit"
                                                    onclick="return confirm('¿Seguro de que desea eliminar este insumo?')">
                                                    <i class="fa fa-fw fa-trash"></i>Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="border px-4 py-2 text-center font-bold">No hay insumos
                                        agregados a la receta.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <button onclick="finalizarReceta()"
                    class="w-full mt-4 px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Finalizar
                    Receta</button>
            </div>
        </div>
    </div>

    <script>
        function toggleModal() {
            const productoSelect = document.getElementById('productoSelect');
            const productoId = productoSelect.value;

            // Verificar que se ha seleccionado un producto
            if (!productoId) {
                alert('Por favor, selecciona un producto antes de crear una receta.');
                return; // No abrir el modal si no hay producto seleccionado
            }

            // Realizar la petición POST para obtener los insumos del producto seleccionado
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('receta.showModal') }}';
            form.style.display = 'none';

            const inputProductoId = document.createElement('input');
            inputProductoId.type = 'hidden';
            inputProductoId.name = 'producto_id';
            inputProductoId.value = productoId;

            form.appendChild(inputProductoId);

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}'; // Token CSRF

            form.appendChild(csrfInput);

            document.body.appendChild(form);
            form.submit(); // Enviar formulario al controlador para obtener las recetas
        }


        function closeModal() {
            // Lógica específica para cerrar el modal
            const modal = document.getElementById('myModal');
            modal.classList.add('hidden');
        }

        function finalizarReceta() {
            // Aquí puedes agregar la lógica para finalizar la receta si es necesario
            alert('Receta finalizada.');

            // Restablecer el selector de producto y ocultar el modal
            const productoSelect = document.getElementById('productoSelect');
            productoSelect.selectedIndex = 0; // Restablecer el selector de productos

            // Cerrar el modal
            closeModal();
        }


        function restablecer() {
            const selectInsumo = document.getElementById("insumo");
            selectInsumo.selectedIndex = 0;
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('modalOpen'))
                const modal = document.getElementById('myModal');
                modal.classList.remove('hidden'); // Asegura que el modal esté visible
                // Establece el producto previamente seleccionado
                const productoId = "{{ session('producto_id') }}";
                if (productoId) {
                    document.getElementById('productoSelect').value = productoId;
                    document.getElementById('producto_id').value = productoId;
                }
            @endif
        });
    </script>
@endsection
