<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Asistencia;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ReporteEmpleadosController extends Controller
{
    public function reportesEmpleados(Request $request){

        $empleados = User::all();
        $query = Asistencia::with('user');
        $nombreEmpleado = 'N/A';
        $empleadoTotalHoras = 'N/A';
        $mensajePeriodo = '';
        $totalVentasEmpleado = 0;

        // Obtener la fecha actual
        $today = Carbon::now()->setTimezone('America/El_Salvador')->format('Y-m-d');
        
        // Filtrar por la fecha actual al cargar la página
        if (!$request->filled('fechaInicioAsistencia') && !$request->filled('fechaFinAsistencia')) {

            $request->merge(['fechaInicioAsistencia' => $today, 'fechaFinAsistencia' => $today]);
            
        }


        //Filtro de la hora de entrada
        if($request->filled('horaEntrada')){

            //Cambia el formato de la hora que trae el input
            $hora = Carbon::parse($request->input('horaEntrada'));

            if($request->input('antesDespuesEntrada') == "1"){

                //Filtra los registros con hora de entrada menor a la especificada
                $query->where('check_in','<', $hora);

            }elseif($request->input('antesDespuesEntrada')  == "2"){

                //Filtra los registros con hora de entrada mayor o igual a la especificada
                $query->where('check_in','>=', $hora);

            }

        }

        //Filtro de la hora de salida
        if($request->filled('horaSalida')){

            //Cambia el formato de la hora que trae el input
            $hora = Carbon::parse($request->input('horaSalida'));

            if($request->input('antesDespuesSalida') == "1"){

                //Filtra los registros con hora de entrada menor a la especificada
                $query->where('check_in','<', $hora);

            }elseif($request->input('antesDespuesSalida')  == "2"){

                //Filtra los registros con hora de entrada mayor o igual a la especificada
                $query->where('check_in','>=', $hora);

            }

        }

        //Filtro por fecha de inicio y fin
        if($request->filled('fechaInicioAsistencia') && $request->filled('fechaFinAsistencia')){

            //le da formato de aaaa/mm/dd a la fecha
            $formatoFechaInicio = Carbon::createFromFormat('Y-m-d', $request->input('fechaInicioAsistencia'))->format('Y/m/d');
            $formatoFechaFin = Carbon::createFromFormat('Y-m-d', $request->input('fechaFinAsistencia'))->format('Y/m/d');
 
            $query->whereBetween(DB::raw('DATE(fecha)'), [$formatoFechaInicio, $formatoFechaFin]);


            $mensajePeriodo = "Desde ".$formatoFechaInicio." hasta ".$formatoFechaFin ;

        }


        //Filtra las asistencias por empleado
        if($request->filled('empleado')){

            $query->where('user_id', $request->input('empleado'));

            $ventas = Venta::where('empleado_id',$request->input('empleado'));

            //le da formato de aaaa/mm/dd a la fecha
            $formatoFechaInicio = Carbon::createFromFormat('Y-m-d', $request->input('fechaInicioAsistencia'))->format('Y/m/d');
            $formatoFechaFin = Carbon::createFromFormat('Y-m-d', $request->input('fechaFinAsistencia'))->format('Y/m/d');
 
            //$mensaje = $formatoFechaInicio;

            $ventas->whereBetween(DB::raw('DATE(fecha_hora_venta)'), [$formatoFechaInicio, $formatoFechaFin]);

            $pivote = $ventas->get();

            $totalVentasEmpleado = $pivote->count();

        }

        $asistenciasFiltradas = $query->get();

        
        //Se utiliza para sacar los resultados de la consulta por empleado
        if($request->filled('empleado')){

            $idEmpleado = $request->input('empleado');


            //Obtener el nombre del empleado
            $listaUser = User::find($request->input('empleado'));
            $nombreEmpleado = $listaUser->name;

            $i = 0;

            //Calcula la diferencia de minutos entre la entrada y salida por asistencia
            //y la guarda en la variable i que es acumulativa
            //guarda las horas totales trabajas en el periodo del empleado
            foreach($asistenciasFiltradas as $q){

                $horaE = Carbon::parse($q->check_in);
                $horaS = Carbon::parse($q->check_out);

                $i += $horaS->diffInMinutes($horaE);

            }

            $horas = intdiv($i,60);
            $minutos = $i % 60;

            $empleadoTotalHoras = 'Horas: '.$horas.' Minutos: '.$minutos;

        }
        

        //Calcula las horas trabajas por asistencia
        if($asistenciasFiltradas){

            foreach($asistenciasFiltradas as $q){

                $horaE = Carbon::parse($q->check_in);
                $horaS = Carbon::parse($q->check_out);

                $totalMinutos = $horaS->diffInMinutes($horaE);
                $horas = intdiv($totalMinutos,60);
                $minutos = $totalMinutos % 60;

                $m = $horas.' horas y '.$minutos.' minutos';

                $q->setAttribute('horasTrabajadas',$m);

                

            }

        }

         

        return view('administracion.reporteEmpleados', compact( 'totalVentasEmpleado', 'nombreEmpleado', 'empleados','asistenciasFiltradas', 'empleadoTotalHoras', 'mensajePeriodo'));

    }
}
