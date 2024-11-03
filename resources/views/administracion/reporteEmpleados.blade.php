@extends('layouts.plantilla')

@section('tituloPagina', 'Reportes de empleados')

@section('tituloSeccion', 'Reportes de empleados')

@section('tituloContenido', 'Filtros')

@section('contenidoPagina')


<form method="GET" action="{{ route('administracion.ReporteEmpleados') }}" class="form1" role="form" enctype="multipart/form-data">
    
    <!-- Input filtros -->
    <div class="grid grid-cols-6 grid-rows-3 gap-4">
        <div class="col-span-2">
            <p id="texto" for="producto">Empleado:</p>
            <div class="mt-2">
                <select name="empleado" id="empleado"
                    class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <!--For que recorre todos los empleados para listarlos-->
                    <option value="">Seleccione al empleado</option>
                    @foreach($empleados as $empleado )
                        <option value= {{$empleado->id}} >{{$empleado->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-start-3">
            <!-- Hora de entrada -->
            <label for="nombre" id="texto">Hora de entrada:</label>
            <div class="mt-2">
                <input type="time" name="horaEntrada" id="horaEntrada"
                    class="form-control @error('horaEntrada') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    placeholder="00:00">
                    
            </div>
        </div>
        <div class="col-start-4">
            <!-- Select para saber si quiere filtras antes o despues de la hora filtrada -->
            <label for="nombre" id="texto">Antes o despues:</label>
            <div class="mt-2">
                <select name="antesDespuesEntrada" id="antesDespuesEntrada" class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <option value="">Seleccione una opcion</option>
                    <option value="1">Antes de</option>
                    <option value="2">Despues de</option>
                </select>
            </div>
        </div>
        <div class="col-start-5">
            <!-- Hora de salida -->
            <label for="nombre" id="texto">Hora de salida:</label>
            <div class="mt-2">
                <input type="time" name="horaSalida" id="horaSalida"
                    class="form-control @error('horaSalida') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    placeholder="00:00">
                     
            </div>
        </div>
        <div class="col-start-6">
             <!-- Select para saber si quiere filtras antes o despues de la hora filtrada (Salida)-->
             <label for="nombre" id="texto">Antes o despues:</label>
             <div class="mt-2">
                 <select name="antesDespuesSalida" id="antesDespuesSalida" class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                     <option value="">Seleccione una opcion</option>
                     <option value="1">Antes de</option>
                     <option value="2">Despues de</option>
                 </select>
             </div>
        </div>
        <div class="col-span-2 row-start-2">
            <!-- Fecha de inicio -->
            <label for="fechaV" id="texto">fecha de inicio:</label>
            <div class="mt-2">
                <input type="date" name="fechaInicioAsistencia" id="fechaInicioAsistencia" max='' value = ""
                    class="form-control @error('nombreClienteInput') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            </div>
        </div>
        <div class="col-span-2 col-start-3 row-start-2">
            <!-- Fecha de finalizacion -->
            <label for="fechaV" id="texto">fecha de finalizacion:</label>
            <div class="mt-2">
                <input type="date" name="fechaFinAsistencia" id="fechaFinAsistencia" max="" value= ""
                    class="form-control @error('nombreClienteInput') is-invalid @enderror block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            </div>
        </div>
        <div class="col-start-5 row-start-2">
            <!-- Boton de buscar -->
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
            <!-- Boton de limpiar -->
            <label id="texto"></label>
            <div class="mt-2">
                <a href="{{ route('administracion.ReporteEmpleados') }}">
                    <button id="limpiarVentas" type="button"
                        class="mt-5 rounded-md bg-gray-500  w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Limpiar</button>
                </a>
            </div>
        </div>
    </div>
    <!-- FIN de los filtros -->

</form>

<!-- Inicio resultados de la consulta -->

<div class="grid grid-cols-4 grid-rows-3 gap-4">
    <div class="col-span-4">
        <h1 class="mb-2 text-2xl font-mont font-semibold"> Resultados de la Consulta </h1>
    </div>
    <div class="row-start-2">
        <p>Periodo</p>
        <div class="mt-2">
            {{$mensajePeriodo}}
        </div>
    </div>
    <div class="row-start-2">
        <p>Empleado</p>
        <div class="mt-2">
            {{$nombreEmpleado}}
        </div>
    </div>
    <div class="row-start-2">
        <p>Total de horas trabajadas en el periodo</p>
        <div class="mt-2">
            {{$empleadoTotalHoras}}
        </div>
    </div>
    <div class="row-start-2">
        <p>Ventas realizadas en el periodo</p>
        <div class="mt-2">
            {{$totalVentasEmpleado}}
        </div>
    </div>
</div>
    
<!-- Fin resultados de la consulta -->

<!-- Tabla de asistencias -->
<h1 class="mb-2 text-2xl font-mont font-semibold"> Listado de asistencias </h1>
<div class="scroll-container">
@forelse ($asistenciasFiltradas as $q)
<p>Asistencia</p>
<div class="contenedor-transparente">
<table class="border-collapse w-full">
    <!--Encabezado de tabla-->
    <thead>
        <tr>
            <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                Id</th>
            <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                Empleado</th>
            <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                Entrada</th>
            <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                Salida</th>
            <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                Tiempo trabajado</th>
            <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                Fecha</th>
                
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
                    {{ $q->id }}
                </td>
                <!--Nombre del cliente-->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Cantidad</span>
                    {{ $q->user->name }}
                </td>
                <!--Telefono del cliente-->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                    <span
                        class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Sub total</span>
                    {{ $q->check_in }}
                </td>

                <!--fecha y hora de la venta-->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Precio
                        unitario</span>
                    {{ $q->check_out }}
                </td>

                <!--Tiempo trabajado-->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">
                        horas trabajadas
                    </span>
                    {{ $q->horasTrabajadas }}
                </td>
                <!--fecha y hora-->
                <td
                    class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                    <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">
                        horas trabajadas
                    </span>
                    {{ $q->fecha }}
                </td>

                
            </tr>
            
                
        <!-- Aqui iba la tabla de la linea -->
            
        
    </tbody>
</table>
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
    document.getElementById('fechaInicioAsistencia').setAttribute('max', today);
    document.getElementById('fechaInicioAsistencia').setAttribute('value', today);
    document.getElementById('fechaFinAsistencia').setAttribute('max', today);
    document.getElementById('fechaFinAsistencia').setAttribute('value', today);
</script>

@endsection()