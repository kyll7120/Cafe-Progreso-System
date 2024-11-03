@extends('layouts.plantilla')

@section('tituloSeccion', 'Historial de ventas')

@section('tituloContenido', 'Detalle de venta')

@section('tituloPagina', 'Detalle de venta')

@section('contenidoPagina')

<div class="mt-5 pb-2">
    <table class="border-collapse w-full">
        <thead>
            <tr>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Empleado</th>
                <!--<th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Nº</th>-->
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Cliente</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Fecha y hora</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Total de venta</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Total de descuentos</th>
            </tr>
        </thead>
        <tbody>

            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                <!--ID-->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                    {{ $nombre }}
                </td>
                <!--Número-->
                <!--<td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                    {{ ++$i }}
                </td>-->
                <!--Nombre del cliente-->
                <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                    {{ $venta->nombre_cliente }}
                </td>
                <!--Fecha y hora-->
                <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                    {{ $venta->fecha_hora_venta }}
                </td>
                <!--Total de venta-->
                <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                    ${{ $venta->total_venta }}
                </td>
                <td class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold"></span>
                    ${{ $venta->descuento_total_venta }}
                </td>

            </tr>
        </tbody>
    </table>
</div>
<div class="mt-5 pb-4">
    <table class="border-collapse w-full">
        <thead>
            <tr>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Producto</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Cantidad</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Subtotal</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Descuento por producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->lineas as $linea)
            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                <!-- Producto -->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                    {{ $linea->producto->nombre }}
                </td>
                <!-- Cantidad -->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                    {{ $linea->cantidad }}
                </td>
                <!-- Subtotal -->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                    {{ $linea->subtotal }}
                </td>
                <!-- Descuento -->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                    {{ $linea->descuento }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-5 pb-2">
    <div class="grid grid-cols-1 gap-x-10 gap-y-2 sm:grid-cols-9 ">
        <!--boton regresar-->
        <div class="sm:col-span-3">
            <a href="{{ route('ventas.historial') }}">
                <button id="enviarDatosClientes" type="button"
                    class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Regresar</button>
            </a>
        </div>
    </div>
</div>

@endsection()