@extends('layouts.plantilla')

@section('tituloPagina', 'Crear Receta')
@section('tituloSeccion', 'Inventario')
@section('tituloContenido', 'Crea tu receta')

@section('contenidoPagina')
    <div class="container mx-auto p-4">
        <div class="mb-4">
            <label for="productoSelect" class="block text-sm font-medium text-gray-700">Selecciona un Producto:</label>
            <select id="productoSelect" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>-- Selecciona un Producto --</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button onclick="toggleModal()" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Crear Receta
        </button>

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
                            <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">{{ $loop->iteration }}</td>
                            <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">{{ $producto->nombre }}</td>
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

    <div id="myModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b flex justify-between">
                <h5 class="text-lg font-semibold">Crear Nueva Receta</h5>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <div class="p-4">
                <form id="recetaForm" method="POST" action="{{ route('receta.store') }}">
                    @csrf
                    <input type="hidden" name="producto_id" id="producto_id">

                    <div class="mb-4">
                        <label for="insumo" class="block text-sm font-medium text-gray-700">Insumo:</label>
                        <select name="insumo_id" id="insumo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="" disabled selected>-- Selecciona un Insumo --</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="cantidad_requerida" class="block text-sm font-medium text-gray-700">Cantidad Requerida:</label>
                        <input type="number" step="0.01" name="cantidad_requerida" id="cantidad_requerida" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Agregar</button>
                </form>

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
                        <tbody id="insumosAgregados">
                            @if (session('recetasProducto') && session('recetasProducto')->isNotEmpty())
                                @foreach (session('recetasProducto') as $receta)
                                    <tr>
                                        <td class="border px-4 py-2 text-center">{{ $receta->insumo->nombre }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $receta->cantidad_requerida }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="{{ route('receta.eliminarInsumo', $receta->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-delete" type="submit" onclick="return confirm('¿Seguro de que desea eliminar este insumo?')">
                                                    <i class="fa fa-fw fa-trash"></i>Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="border px-4 py-2 text-center font-bold">No hay insumos agregados a la receta.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <button onclick="finalizarReceta()" class="w-full mt-4 px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Finalizar Receta</button>
            </div>
        </div>
    </div>

    <script>
        function toggleModal() {
            const productoSelect = document.getElementById('productoSelect');
            const productoId = productoSelect.value;

            if (!productoId) {
                alert('Por favor, selecciona un producto antes de crear una receta.');
                return;
            }

            document.getElementById('producto_id').value = productoId;
            loadInsumos(productoId); // Cargar insumos mediante AJAX
            document.getElementById('myModal').classList.remove('hidden');
        }

        function loadInsumos(productoId) {
            fetch(`/insumos/${productoId}`)
                .then(response => response.json())
                .then(data => {
                    const insumoSelect = document.getElementById('insumo');
                    insumoSelect.innerHTML = '<option value="" disabled selected>-- Selecciona un Insumo --</option>';
                    data.insumos.forEach(insumo => {
                        insumoSelect.innerHTML += `<option value="${insumo.id}">${insumo.nombre}</option>`;
                    });
                })
                .catch(error => console.error('Error al cargar insumos:', error));
        }

        function closeModal() {
            document.getElementById('myModal').classList.add('hidden');
        }

        function finalizarReceta() {
            // Aquí puedes agregar lógica para finalizar la receta
            alert('Receta finalizada.');
            closeModal();
        }
    </script>
@endsection
