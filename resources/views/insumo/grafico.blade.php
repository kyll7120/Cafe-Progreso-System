@extends('layouts.plantilla')

@section('tituloPagina', 'Gráfico de Insumos')
@section('tituloSeccion', 'Gráfico de Insumos Utilizados')
@section('contenidoPagina')

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Gráfico de Insumos Utilizados</h2>

        <div id="grafico" class="mt-4">
            <!-- Aquí se generará el gráfico -->
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = @json($data); // Asegúrate de pasar los datos desde el controlador
            const labels = data.map(item => item.nombre);
            const cantidades = data.map(item => item.cantidad_usada);

            // Configuración del gráfico Highcharts
            Highcharts.chart('grafico', {
                chart: {
                    type: 'bar', // Tipo de gráfico
                },
                title: {
                    text: 'Análisis de insumos para el mes de {{ $mesNombre }} del {{ $año }}' // Título dinámico
                },
                xAxis: {
                    categories: labels,
                    title: {
                        text: 'Insumos'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad Usada'
                    },
                    tickInterval: 0.5 // Ajusta la escala del eje Y
                },
                series: [{
                    name: 'Cantidad Usada',
                    data: cantidades
                }]
            });
        });
    </script>
    <div class="flex justify-left mt-10 space-x-10" class="w-full">
        <!--button regresar a vista de reportes-->
        <a href="{{ route('insumo.vistaReporte') }}" class="w-full">
            <button id="enviarDatosClientes" type="button"
                class="rounded-md bg-gray-500 py-2 px-4 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 w-full">
                Regresar </button>
        </a>
        <!-- Botón Ir al inicio -->
        <a href="{{ route('home') }}" class="w-full">
            <button id="enviarDatosClientes" type="button"
                class="rounded-md bg-gray-500 py-2 px-4 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 w-full">
                Ir al inicio
            </button>
        </a>
    </div>


@endsection
