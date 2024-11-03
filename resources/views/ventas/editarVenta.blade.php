@extends('layouts.plantilla')

@section('tituloPagina', 'Editar Venta')

@section('tituloSeccion', 'Ventas')

@section('tituloContenido', 'Editar Venta')

@section('contenidoPagina')

<div class="container">
    @if (session('success'))
    <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('ventas.actualizar', $venta->id) }}" method="POST" id="ventaForm">
        @csrf
        @method('PUT')
        <!-- Datos del cliente -->
        <div class="pb-4">
            <h2 id="textoSeccion">Datos cliente:</h2>
            <!-- Nombre -->
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Nombre:</p>
                    <div class="mt-2">
                        <input type="text" name="nombre_cliente" id="nombre_cliente" value="{{ old('nombre_cliente', $venta->nombre_cliente) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        @error('nombre_cliente')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Teléfono -->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Teléfono:</p>
                    <div class="mt-2">
                        <input type="text" name="telefono_cliente" id="telefono_cliente" value="{{ old('telefono_cliente', $venta->telefono_cliente) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        @error('telefono_cliente')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Líneas de venta -->
            <h3 class="text-lg font-semibold mt-6">Líneas de Venta</h3>
            <div id="lineas-container">
                @foreach ($venta->lineas as $linea)
                <div class="flex items-center mb-4 linea" data-linea-id="{{ $linea->id }}">
                    <!-- Productos y Precios -->
                    <input type="hidden" name="lineas[{{ $loop->index }}][id]" value="{{ $linea->id }}">
                    <select name="lineas[{{ $loop->index }}][producto_id]" class="mr-2 border rounded-md producto" required>
                        <option value="">Seleccionar Producto</option>
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" {{ $linea->producto_id == $producto->id ? 'selected' : '' }} data-precio="{{ $producto->precio_unitario }}" data-descuento="{{ $producto->descuento ?? 0 }}">
                            {{ $producto->nombre }} - ${{ number_format($producto->precio_unitario, 2) }}
                        </option>
                        @endforeach
                    </select>
                    <!-- Cantidad de productos -->
                    <input type="number" name="lineas[{{ $loop->index }}][cantidad]" value="{{ old('lineas.'.$loop->index.'.cantidad', $linea->cantidad) }}" class="mr-2 border rounded-md w-20 cantidad" min="1" required>
                    <!-- Se actualiza si tiene descuento -->
                    <input type="text" name="lineas[{{ $loop->index }}][descuento]" value="{{ $linea->descuento > 0 ? number_format($linea->descuento, 2) : '0.00' }}" class="mr-2 border rounded-md w-20 text-gray-500" readonly>
                    <!-- Subtotal -->
                    <span class="subtotal text-lg font-semibold">${{ number_format($linea->subtotal, 2) }}</span>
                </div>
                @endforeach
            </div>
            <!-- Cálculo del total y descuento (Si los hay) -->
            <div class="grid grid-cols-1 gap-x-5 gap-y-4 sm:grid-cols-9">
                <div class="sm:col-span-1">
                    <div class="mt-2">
                        <p id="texto">Total venta:</p>
                        <span id="total" class="text-xl font-bold">${{ number_format($venta->total_venta, 2) }}</span>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <div class="mt-2">
                        <p id="texto">Total descuentos:</p>
                        <span id="total-descuento" class="text-xl font-bold">$0.00</span>
                    </div>
                </div>
            </div>
            <br><br>
            <!-- Botones -->
            <div class=" grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
            <div class="sm:col-span-3">
                <button type="submit" class="rounded-md bg-guardar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-green-800 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Guardar</button>
            </div>
            <div class="sm:col-span-3">
                <a href="{{ route('ventas.historial') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                </a>
            </div>
        </div>
    </form>     
</div>

<script>
    // Calcular el subtotal y descuento en tiempo real
    document.querySelectorAll('.producto, .cantidad').forEach(input => {
        input.addEventListener('input', updateTotals);
    });

    function updateTotals() {
        let total = 0;
        let totalDescuento = 0; // Acumulador para el total de descuentos

        document.querySelectorAll('#lineas-container .linea').forEach(linea => {
            const productoSelect = linea.querySelector('.producto');
            const cantidadInput = linea.querySelector('.cantidad');
            const subtotalSpan = linea.querySelector('.subtotal');
            const descuentoInput = linea.querySelector('input[name*="[descuento]"]');

            const productoPrecio = parseFloat(productoSelect.options[productoSelect.selectedIndex].dataset.precio) || 0;
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const descuento = parseFloat(productoSelect.options[productoSelect.selectedIndex].dataset.descuento) || 0;

            const subtotal = (productoPrecio * cantidad) - descuento;

            // Actualizar el subtotal y el descuento visualmente
            total += subtotal;
            totalDescuento += descuento * cantidad; // Sumar el descuento total de esta línea
            subtotalSpan.textContent = '$' + subtotal.toFixed(2);
            descuentoInput.value = descuento.toFixed(2); // Mostrar el descuento correspondiente
        });

        // Mostrar los totales
        document.getElementById('total').textContent = '$' + total.toFixed(2);
        document.getElementById('total-descuento').textContent = '$' + totalDescuento.toFixed(2); // Mostrar el total de descuento
    }
</script>
@endsection