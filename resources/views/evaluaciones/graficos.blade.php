@extends('layouts.plantilla')

@section('tituloPagina', 'Gráfico de Respuestas')

@section('tituloSeccion', 'Desempeño')

@section('tituloContenido', 'Gráfico de la evaluación: ' . $evaluacion->titulo)

<!--Vista de los graficos de resultados de evaluaciones-->
@section('contenidoPagina')
    <!--Boton de registrar y volver al inicio-->
    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <!--El usuario Empleado no tiene permiso de ver esta parte-->
            <div class="sm:col-span-3">
                <a href="{{ route('resultados') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Ir a resultados
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Apartado de Preguntas con Más y Menos Puntaje -->
        <div class="mb-4" style="font-family: 'Montserrat', sans-serif;">
            @php
                $maxPregunta = collect($data)->sortByDesc('y')->first();
                $minPregunta = collect($data)->sortBy('y')->first();
            @endphp
            <p><strong>Mayor Puntaje:</strong> {{ $maxPregunta['name'] }} -<strong> {{ $maxPregunta['y'] }}</strong></p>
            <p><strong>Menor Puntaje:</strong> {{ $minPregunta['name'] }} -<strong> {{ $minPregunta['y'] }}</strong></p>
        </div>
        <div class="text-center" style="width: 75%; margin: auto;">
            <div id="grafico-respuestas" style="width: 100%; height: 400px;"></div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Highcharts.chart('grafico-respuestas', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Sumas de Puntajes por Pregunta',
                    style: {
                        fontFamily: 'Montserrat, sans-serif'
                    }
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        style: {
                            fontFamily: 'Montserrat, sans-serif'
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: 'Suma de Puntajes',
                        style: {
                            fontFamily: 'Montserrat, sans-serif'
                        }
                    }
                },
                series: [{
                    name: 'Preguntas',
                    colorByPoint: true,
                    data: @json($data)
                }],
                tooltip: {
                    pointFormat: '<b>{point.y}</b> en total',
                    style: {
                        fontFamily: 'Montserrat, sans-serif'
                    }
                },
                legend: {
                    itemStyle: {
                        fontFamily: 'Montserrat, sans-serif'
                    }
                }
            });
        });
    </script>
@endsection
