@extends('layouts.plantilla')

@section('tituloPagina', 'Reportes de ventas')

@section('tituloSeccion', 'Reportes de ventas')

@section('tituloContenido', 'Filtros')

@section('contenidoPagina')



    
    <form method="GET" action="{{ route('ventas.reportes') }}" class="form1" role="form" enctype="multipart/form-data">
        <!-- Comieza los input de los filtros -->
        <div class="grid grid-cols-6 grid-rows-3 gap-4">
            <div class="col-span-2">
                <!-- Listado de empleados para filtrar -->
                <div class="sm:col-span-3">
                    <p id="texto" for="producto">Empleado:</p>
                    <div class="mt-2">
                        <select name="empleado" id="empleado"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                            <!--For que recorre todos los productos existentes-->
                            <option value="">Seleccione al empleado</option>
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-2 col-start-3">
                <!-- Select del listado de productos -->
                <div class="mt-2">
                    <p id="texto" for="producto">Producto:</p>
                    <select name="producto" id="producto"
                        class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <!--For que recorre todos los productos existentes-->
                        <option value="">Seleccione el producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-2 col-start-5">
                <!-- Input para el nombre del cliente -->
                <div class="sm:col-span-3">
                    <label for="nombre" id="texto">Nombre del cliente:</label>
                    <div class="mt-2">
                        <input type="text" name="nombreClienteInput" id="nombreClienteInput"
                            class="form-control @error('nombreClienteInput') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            placeholder="Ingrese el nombre">
                    </div>
                </div>
            </div>
            <div class="col-span-2 row-start-2">
                <!-- Filtrar la fecha de inicio de la venta -->
                <div class="sm:col-span-3">
                    <label for="fechaV" id="texto">fecha de inicio:</label>
                    <div class="mt-2">
                        <input type="date" name="fechaInicioVenta" id="fechaInicioVenta" max='' value = ""
                            class="form-control @error('nombreClienteInput') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    </div>
                </div>
            </div>
            <div class="col-span-2 col-start-3 row-start-2">
                <!-- Filtrar la fecha de fin de la venta -->
                <div class="sm:col-span-3">
                    <label for="fechaV" id="texto">fecha de finalizacion:</label>
                    <div class="mt-2">
                        <input type="date" name="fechaFinVenta" id="fechaFinVenta" max="" value= ""
                            class="form-control @error('nombreClienteInput') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    </div>
                </div>
            </div>
            <div class="col-start-5 row-start-2">
                <!-- Boton -->
                <div class="sm:col-span-3">
                    <label id="texto"></label>
                    <div class="mt-2">
                        <button type="submit"
                        class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Buscar
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-start-6 row-start-2">
                <label id="texto"></label>
                <div class="mt-2">
                    <a href="{{ route('ventas.reportes') }}">
                        <button id="limpiarVentas" type="button"
                            class="mt-5 rounded-md bg-gray-500  w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                            Limpiar</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Terminan los input de los filtros -->
 
    </form>

    <!-- Resultados de la Consulta-->
    <div class="grid grid-cols-5 grid-rows-4 gap-4">
        <div class="col-span-5">
            <h1 class="mb-2 text-2xl font-mont font-semibold"> Resultados de la Consulta </h1>
        </div>
        <div class="row-start-2">
            <div class="sm:col-span-3">
                <p id="texto" for="producto">Periodo:</p>
                <div class="mt-2">
                    {{$mensaje}}
                </div>
            </div>
        </div>
        <div class="col-start-1 row-start-3">
            <div class="sm:col-span-3">
                <p id="texto" for="producto">Producto mas vendido en el periodo:</p>
                <div class="mt-2">
                    {{$productoName}}
                </div>
            </div>
        </div>
        <div class="col-start-2 row-start-3">
            <div class="sm:col-span-3">
                <p id="texto" for="producto">Cantidad del producto mas vendido en el periodo:</p>
                <div class="mt-2">
                    {{$cantidadMasVendida}}
                </div>
            </div>
        </div>
        <div class="col-start-2 row-start-2">
            <div class="sm:col-span-3">
                <p id="texto" for="producto">Monto total de las ventas en el periodo:</p>
                <div class="mt-2">
                    $ {{$totalVentas}}
                </div>
            </div>
        </div>
        <div class="col-start-3 row-start-2">
            <div class="sm:col-span-3">
                <p id="texto" for="producto">Producto filtrado:</p>
                <div class="mt-2">
                    {{$nombreProducto}}
                </div>
            </div>
        </div>
        <div class="col-start-4 row-start-2">
            <div class="sm:col-span-3">
                <p id="texto" for="producto">Cantidad del producto:</p>
                <div class="mt-2">
                    {{$totalCantidad}}
                </div>
            </div>
        </div>
        <div class="col-start-5 row-start-2">
            <div class="sm:col-span-3">
                <p id="texto" for="producto">Empleado:</p>
                <div class="mt-2">
                    {{$nombreEmpleado}}
                </div>
            </div>
        </div>
    </div>

    <!-- Fin Resultados de consulta -->

    <!-- Tabla de ventas -->
    <h1 class="mb-2 text-2xl font-mont font-semibold"> Listado de las ventas </h1>
    <div class="scroll-container">
    @forelse ($VentasFiltradas as $venta)
    <p>Venta</p>
    <div class="contenedor-transparente">
    <table class="border-collapse w-full">
        <!--Encabezado de tabla-->
        <thead>
            <tr>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Id</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Nombre del Cliente</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Telefono del cliente</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    fecha y hora de la venta</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Total de la venta</th>
                    
            </tr>
        </thead>
        <!--Contenido de la tabla-->
        <tbody>
            
                <tr
                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <!--id de la venta-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                        {{ $venta->id }}
                    </td>
                    <!--Nombre del cliente-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Cantidad</span>
                        {{ $venta->nombre_cliente }}
                    </td>
                    <!--Telefono del cliente-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Sub total</span>
                        {{ $venta->telefono_cliente }}
                    </td>

                    <!--fecha y hora de la venta-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Precio
                            unitario</span>
                        {{ $venta->fecha_hora_venta }}
                    </td>

                    <!--Total de la venta-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">
                            id Venta
                        </span>
                        $ {{ $venta->total_venta }}
                    </td>
                    
                </tr>
                
                    
            <!-- Aqui iba la tabla de la linea -->
                
            
        </tbody>
    </table>
    <p>Detalle de la venta</p>
                    
                    <!-- Tabla para la linea de venta -->
                    
                    <table class="border-collapse w-full">
                        <!--Encabezado de tabla-->
                        <thead>
                            <tr>
                                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                    Id linea</th>
                                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                    Producto</th>
                                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                    Cantidad</th>
                                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                    descuento</th>
                                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                                    subtotal</th>
                                    
                            </tr>
                        </thead>
                        
                        <!--Contenido de la tabla linea de venta-->
                        <tbody>
                            @foreach ($lineaVenta as $linea)
                    
                            @if($venta->id == $linea->venta_id)
                                <tr
                                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <!--id de la venta-->
                                    <td
                                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                                        {{ $linea->id }}
                                    </td>
                                    <!--Nombre del cliente-->
                                    <td
                                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Cantidad</span>
                                        {{ $linea->producto->nombre }}
                                    </td>
                                    <!--Telefono del cliente-->
                                    <td
                                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                                        <span
                                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Sub total</span>
                                        {{ $linea->cantidad }}
                                    </td>

                                    <!--fecha y hora de la venta-->
                                    <td
                                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Precio
                                            unitario</span>
                                        {{ $linea->descuento }}
                                    </td>

                                    <!--Total de la venta-->
                                    <td
                                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">
                                            id Venta
                                        </span>
                                        $ {{ $linea->subtotal }}
                                    </td>
                                    
                                    </tr>
                                    
                                
                                @endif
                                @endforeach
                            
                        </tbody>
                    </table>
                
                    <!-- Fin de la tabla de la linea de venta -->
    </div>
    @empty
                
    <h1 class="mb-2 text-2xl font-mont font-semibold"> No se encontraron registros! </h1>
    
    @endforelse
    </div>

    <!-- Script para obtener la fecha actual -->
    <script>
        // Obtener la fecha actual
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
        var yyyy = today.getFullYear();
    
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('fechaInicioVenta').setAttribute('max', today);
        document.getElementById('fechaInicioVenta').setAttribute('value', today);
        document.getElementById('fechaFinVenta').setAttribute('max', today);
        document.getElementById('fechaFinVenta').setAttribute('value', today);
    </script>

@endsection()


