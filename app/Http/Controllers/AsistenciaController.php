<?php

// app/Http/Controllers/AsistenciaController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;


class AsistenciaController extends Controller
{
    public function asistencia()
    {        
        // Obtener todos los empleados
        $empleados = User::paginate(10); // Cambia 10 por el número deseado de elementos por página
        $horaActual = now()->setTimezone('America/El_Salvador'); // Hora actual

        return view('administracion.asistenciaEmpleado', compact('empleados', 'horaActual'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Ajuste para el número de la lista
    }



    public function checkIn(Request $request, $userId)
    {
        $modo = $request->input('modo', 'rapido'); // 'rápido' o 'personalizado'
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        // Obtener la última asistencia del usuario
        $ultimaAsistencia = Asistencia::where('user_id', $userId)->latest()->first();

        if ($ultimaAsistencia && !$ultimaAsistencia->check_out) {
            // Si la última asistencia no tiene check_out, no permitir otro check_in
            return back()->withErrors(['asistencia' => 'No se puede registrar otra entrada sin registrar una salida.'])->withInput();
        }

        // Si el modo es rápido, usar la fecha y hora actual
        if ($modo === 'rapido') {
            $fecha = now()->setTimezone('America/El_Salvador')->format('Y-m-d'); // Aseguramos formato Y-m-d para MySQL
            $hora = now()->setTimezone('America/El_Salvador')->format('H:i'); // Hora en formato 24 horas
        } else {
            // Validar la fecha y la hora si el modo es personalizado
            $request->validate([
                'fecha' => 'required|date_format:d-m-Y|after_or_equal:01-01-2024|before_or_equal:today',
                'hora' => 'required|date_format:H:i' 
            ]);

            // Convertimos la fecha personalizada al formato Y-m-d para MySQL
            $fecha = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');

            // Validación de hora mayor a la actual para el día actual
            if (Carbon::parse($fecha)->isSameDay(Carbon::today())) {
                $horaActual = now()->setTimezone('America/El_Salvador')->format('H:i');
                if ($hora > $horaActual) {
                    return back()->withErrors(['hora' => 'La hora no puede ser mayor a la hora actual si la fecha es hoy.'])->withInput();
                }
            }
        }

        // Crear y guardar la nueva entrada de asistencia
        $asistencia = new Asistencia();
        $asistencia->user_id = $userId;
        $asistencia->fecha = $fecha; // Fecha en formato Y-m-d
        $asistencia->check_in = "$fecha $hora"; // Fecha y hora combinadas en el formato correcto
        $asistencia->save();

        return redirect()->route('asistencia')->with('success', 'Entrada registrada correctamente');
    }



    public function checkOut(Request $request, $userId)
    {
        $modo = $request->input('modo', 'rapido'); // 'rápido' o 'personalizado'
        $hora = $request->input('hora');

        // Obtener la última asistencia del usuario
        $ultimaAsistencia = Asistencia::where('user_id', $userId)->latest()->first();

        if (!$ultimaAsistencia || $ultimaAsistencia->check_out) {
            // Si no hay asistencia previa o la última asistencia ya tiene check_out, no permitir check_out
            return back()->withErrors(['asistencia' => 'No se puede registrar la salida sin haber registrado una entrada.'])->withInput();
        }

        $fecha = $ultimaAsistencia->fecha; // Usar la fecha del último check_in

        if ($modo === 'rapido') {
            $fecha = $ultimaAsistencia->fecha; // Usar la fecha del último check_in
            $hora = now()->setTimezone('America/El_Salvador')->format('H:i');
        } else {
            $request->validate([
                'hora' => 'required',
            ]);

            // Validar que la hora no sea futura
            $fechaHora = Carbon::parse("$fecha $hora");
            if ($fechaHora->isFuture()) {
                return back()->withErrors(['asistencia' => 'No se puede registrar una salida en el futuro.'])->withInput();
            }

            // Validar que la hora de salida sea mayor que la de entrada
            if (Carbon::parse($ultimaAsistencia->check_in)->gte(Carbon::parse("$hora"))) {
                return back()->withErrors(['asistencia' => 'La hora de salida debe ser mayor que la de entrada.'])->withInput();
            }
        }

        // Registrar check-out
        $ultimaAsistencia->check_out = "$fecha $hora";
        $ultimaAsistencia->save();

        return redirect()->route('asistencia')->with('success', 'Salida registrada correctamente');
    }


    public function listadoAsistencias(Request $request)
    {
        // Convertir fechas de entrada al formato Y-m-d si están en otro formato
        $fechaInicio = $request->fecha_inicio ? Carbon::createFromFormat('d-m-Y', $request->fecha_inicio)->format('Y-m-d') : null;
        $fechaFin = $request->fecha_fin ? Carbon::createFromFormat('d-m-Y', $request->fecha_fin)->format('Y-m-d') : null;

        // Obtén las asistencias filtradas según el request
        $asistencias = Asistencia::with('user')
            ->when($fechaInicio, function ($query) use ($fechaInicio) {
                return $query->whereDate('fecha', '>=', $fechaInicio);
            })
            ->when($fechaFin, function ($query) use ($fechaFin) {
                return $query->whereDate('fecha', '<=', $fechaFin);
            })
            ->get()
            ->map(function ($asistencia) {
                $asistencia->fecha = Carbon::parse($asistencia->fecha)->format('d-m-Y');
                $asistencia->check_in = Carbon::parse($asistencia->check_in)->format('h:i a');
                $asistencia->check_out = $asistencia->check_out ? Carbon::parse($asistencia->check_out)->format('h:i a') : null;
                return $asistencia;
            });

        return view('administracion.listadoAsistencias', compact('asistencias'));
    }   

}
