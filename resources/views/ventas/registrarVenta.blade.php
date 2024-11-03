@extends('layouts.plantilla')

@section('tituloPagina', 'Registro de ventas')

@section('tituloSeccion', 'Ventas')

@section('tituloContenido', 'Registro de ventas')

@section('contenidoPagina')

    <!--Formulario de datos del cliente-->
    <form id="formDatosCliente" method = "POST" action="{{ route('crear_venta') }}" autocomplete="off">
        @csrf
        <!--Datos cliente-->
        <div class="pb-4">
            <h2 id="textoSeccion">Datos cliente:</h2>
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--Nombre-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Nombre:</p>
                    <div class="mt-2 ">
                        <input type="text" name="nombre_cliente" id="nombre_cliente" placeholder="Manuel Arévalo"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--Telefono-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Teléfono:</p>
                    <div class="mt-2">
                        <input type="tel" name="telefono_cliente" id="telefono_cliente" placeholder="0000-0000"
                            minlength="9" maxlength="9"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>
            </div>
        </div>

        <!--Esta parte del form esta oculta al usuario y solo se usa para guardar algunos datos de la venta-->
        <!--Total descuento-->
        <div class="hidden sm:col-span-3">
            <p id="texto" for="total_descuento">Total descuento:</p>
            <div class="mt-2 ">
                <input name="total_descuento" id="total_descuento" value="${{ $totalDescuentos }}" required
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            </div>
        </div>
        <!--Total venta-->
        <div class="hidden sm:col-span-3">
            <p id="texto" for="total_venta">Total venta:</p>
            <div class="mt-2 ">
                <input name="total_venta" id="total_venta" value="${{ $totalSubtotales }}" required
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            </div>
        </div>
        <!--Aca terminan los datos ocultos del form-->

    </form>

    <!--Formulario de datos de los productos-->
    <form method="POST" action ="{{ route('guardar_linea_auxiliar') }}">
        @csrf
        <!--Datos productos-->
        <div class="pb-6">
            <h2 id="textoSeccion">Datos productos:</h2>
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--Producto-->
                <div class="sm:col-span-3">
                    <p id="texto" for="producto">Producto:</p>
                    <div class="mt-2">
                        <select name="producto" id="producto"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                            <!--For que recorre todos los productos existentes-->
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!--Cantidad-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Cantidad:</p>
                    <div class="mt-2">
                        <!--Pediente de mofidicar el max segun lo que diga el cliente-->
                        <input type="number" name="cantidad" id="cantidadProducto" min="1" max="25"
                            placeholder="1"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                <!--button agregar producto-->
                <div class="sm:col-span-3">
                    <div class="mt-2">
                        <button type="submit"
                            class=" mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Tabla -->
    <table class="border-collapse w-full">
        <!--Encabezado de tabla-->
        <thead>
            <tr>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Id</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Producto</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Cantidad</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Precio Unitario</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Descuento</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Subtotal</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <!--Contenido de la tabla-->
        <tbody>
            @foreach ($lineasDeVenta as $linea)
                <!--Pendiente de acomodar la tabla al estilo responsive-->
                <tr
                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Id de
                            producto</span>{{ $linea->producto_id }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre</span>
                        {{ $linea->producto->nombre }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Cantidad</span>
                        {{ $linea->cantidad }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Precio
                            Unitario</span>
                        ${{ number_format($linea->producto->precio_unitario, 2) }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Descuento</span>
                        ${{ number_format($linea->descuento, 2) }}
                    </td>
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Subtotal</span>
                        ${{ number_format($linea->subtotal, 2) }}
                    </td>
                    <td class="text-center w-full lg:w-auto p-2border border-b block lg:table-cell relative lg:static">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>
                        <form action="{{ route('eliminar.linea', $linea->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"
                                class="mx-auto">
                                    <path fill="#B91C1C"
                                        d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM7 6v13zm5 7.9l1.9 1.9q.275.275.7.275t.7-.275t.275-.7t-.275-.7l-1.9-1.9l1.9-1.9q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275L12 11.1l-1.9-1.9q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7l1.9 1.9l-1.9 1.9q-.275.275-.275.7t.275.7t.7.275t.7-.275z" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 flex justify-between items-center">
        <div>
            Mostrando {{ $lineasDeVenta->firstItem() }} a {{ $lineasDeVenta->lastItem() }} de {{ $lineasDeVenta->total() }} resultados
        </div>
        <div class="flex space-x-2">
            @if ($lineasDeVenta->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
            @else
                <a href="{{ $lineasDeVenta->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
            @endif

            @if ($lineasDeVenta->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
            @else
                <a href="{{ $lineasDeVenta->previousPageUrl() }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
            @endif

            @if ($lineasDeVenta->hasMorePages())
                <a href="{{ $lineasDeVenta->nextPageUrl() }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
            @else
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
            @endif

            @if (!$lineasDeVenta->hasMorePages())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
            @else
                <a href="{{ $lineasDeVenta->url($lineasDeVenta->lastPage()) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
            @endif
        </div>
    </div>

    <!---Totales-->
    <div class="pb-6 mt-3 flex justify-end">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">

            <!--Botón agregar descuentos DESACTIVADO-->
            <div class="hidden sm:col-span-3">
                <div class="mt-7">
                    <button type="submit"
                        class="rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Agregar
                        descuentos</button>
                </div>
            </div>
            <!--Total descuento-->
            <div class="sm:col-span-3">
                <div class="mt-2">
                    <p id="texto" for="total_descuento">Total descuento:</p>

                    <span
                        class="p-2 font-bold bg-gray-300 text-principal font-lato block w-full py-1.5">${{ $totalDescuentos }}</span>
                </div>
            </div>
            <!--Total venta-->
            <div class="sm:col-span-3">
                <div class="mt-2">
                    <p id="texto" for="total_venta">Total venta:</p>

                    <span
                        class="p-2 font-bold bg-gray-300 text-principal font-lato block w-full py-1.5">${{ $totalSubtotales }}</span>
                </div>
            </div>
        </div>
    </div>

    <!--Botones Guardar y Cancelar-->
    <div>
        <div class=" 
         grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">

            <!-- Botón guardar fuera del formulario -->
            <div class="sm:col-span-3">
                <div class="">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md bg-guardar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-green-800 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Guardar</button>
                </div>
            </div>

            <!--Botón limpiar-->
            <!--
            <div class="sm:col-span-3">
                <div class="">
                    <button type="submit"
                        class="rounded-md bg-cancelar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-red-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Limpiar</button>
                </div>
            </div>
            -->
            <div class="sm:col-span-3">
                <a href="{{ route('home') }}">
                    <button id="enviarDatosClientes" type="button"
                    class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                </a>
            </div>
        </div>
    </div>

    <!--Script para el input de numero de telefono-->
    <script>
        // Obtener el input del teléfono
        var telefonoInput = document.getElementById('telefono_cliente');

        // Escuchar el evento 'input' para validar el contenido del input
        telefonoInput.addEventListener('input', function() {
            // Obtener el valor del input
            var valor = telefonoInput.value;

            // Reemplazar todos los caracteres no numéricos
            valor = valor.replace(/\D/g, '');

            // Formatear el número en el formato ####-####
            var numeroFormateado = '';
            for (var i = 0; i < valor.length; i++) {
                numeroFormateado += valor[i];
                if (i == 3) {
                    numeroFormateado += '-';
                }
            }

            // Actualizar el valor del input con el número formateado
            telefonoInput.value = numeroFormateado;

            // Validar si el número es válido (8 dígitos)
            if (valor.length === 8) {
                telefonoInput.setCustomValidity('');
            } else {
                telefonoInput.setCustomValidity('El número de teléfono debe tener 8 dígitos');
            }
        });
    </script>

    <!--Script para validar que solo se escriban letras en el nombre-->
    <script>
        // Obtener el campo de entrada por su ID
        var nombreInput = document.getElementById('nombre_cliente');

        // Escuchar el evento 'input' en el campo de entrada
        nombreInput.addEventListener('input', function() {
            // Obtener el valor del campo de entrada
            var valor = nombreInput.value;
            // Reemplazar cualquier caracter que no sea una letra, espacio, vocal tildada o la letra ñ por una cadena vacía
            valor = valor.replace(/[^A-Za-zÁÉÍÓÚáéíóúüÜñÑ\s]/g, '');
            // Actualizar el valor del campo de entrada
            nombreInput.value = valor;
        });
    </script>

    <!--Script para mandar form con boton fuera del form-->
    <script>
        // Obtener el botón y el formulario
        var enviarBtn = document.getElementById('enviarDatosClientes');
        var form = document.getElementById('formDatosCliente');

        // Escuchar el evento 'click' en el botón
        enviarBtn.addEventListener('click', function() {
            // Validar el formulario
            if (form.checkValidity()) {
                // Si el formulario es válido, enviarlo
                form.submit();
            } else {
                // Si el formulario no es válido, activar la validación y mostrar mensajes de error
                form.reportValidity();
            }
        });
    </script>

    <!--Script para validar que no se escriban decimales u otros simbolos-->
    <script>
        // Obtener el input
        var inputNumero = document.getElementById('cantidadProducto');

        // Escuchar el evento 'keydown' para interceptar las teclas presionadas
        inputNumero.addEventListener('keydown', function(event) {
            // Obtener el código de la tecla presionada
            var key = event.key;

            // Verificar si la tecla presionada es el punto decimal y otros simbolos
            if (key === '.' || key == '-' || key == '+') {
                // Prevenir la acción por defecto (escribir el punto decimal)
                event.preventDefault();
            }
        });
    </script>

    <!--Script para aumentar la cantidad con el scroll del mouse-->
    <script>
        // Obtener el input
        var inputNumber = document.getElementById('cantidadProducto');

        // Escuchar el evento 'wheel' para detectar el scroll del mouse
        inputNumber.addEventListener('wheel', function(event) {
            // Verificar si se está haciendo scroll hacia arriba o hacia abajo
            var delta = Math.sign(event.deltaY);

            // Incrementar o decrementar el valor del input según el scroll
            if (delta > 0) {
                inputNumber.stepDown();
            } else {
                inputNumber.stepUp();
            }

            // Prevenir el comportamiento por defecto del scroll
            event.preventDefault();
        });
    </script>
@endsection()
