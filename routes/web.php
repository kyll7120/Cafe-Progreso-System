<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\LineaDeVentaAuxiliarController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DescuentosController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\ReporteEmpleadosController;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Ruta de inicio ('home')
    Route::get('/', [AdministracionController::class, 'showCurrentUser'])->name('home');

    // Rutas del controlador VentasController       !!!!PARA EL SEGUNDO SPRINT
    Route::controller(VentasController::class)->group(function () {
        Route::get('ventas/registrar', 'RegistrarVenta')->name('ventas.registrar');
        Route::get('ventas/reportes', 'ReportesVentas')->name('ventas.reportes');
        Route::get('ventas/historial', 'HistorialVentas')->name('ventas.historial');
        Route::get('ventas/detalles/{id}', 'DetalleVentas')->name('ventas.detalles');
        Route::post('/ventas_guardar', 'CrearVenta')->name('crear_venta');
	Route::get('/ventas/{id}/editar','EditarVenta')->name('ventas.editar');
        Route::put('/ventas/{id}/actualizar', 'ActualizarVenta')->name('ventas.actualizar');
    });

    //Rutas del controlador RectaController
    Route::controller(RecetaController::class)->group(function () {
        Route::get('listar_recetas', 'index')->name('listar.recetas');
        Route::post('/receta/registrar', 'store')->name('receta.store');
        Route::put('/receta/{id}/actualizar', 'update')->name('receta.update');
        Route::get('/receta/{id}/editar', 'edit')->name('receta.edit');
        Route::get('receta/ver/{idProducto}', 'show')->name('receta.show');
        Route::delete('/receta_delete/{id}', 'destroy')->name('receta.destroy');
        Route::post('/receta/show-modal', 'showRecetaModal')->name('receta.showModal');
        Route::delete('/receta/eliminar-insumo/{receta}', 'eliminarInsumoReceta')->name('receta.eliminarInsumo');
    });

    //Ruta del controlador auxiliar para LineaDeVenta
    Route::post('/linea_venta_guardar', [LineaDeVentaAuxiliarController::class, 'guardarLineaAuxiliar'])->name('guardar_linea_auxiliar');
    Route::delete('/linea_venta_delete/{id}', [LineaDeVentaAuxiliarController::class, 'eliminarLinea'])->name('eliminar.linea');

    //Rutas de administración (se chequean los permisos de Administrador)
    Route::middleware(['auth', 'checkroleandpermissions'])->group(function () {
        Route::get('/administracion/registrar_empleado', [AdministracionController::class, 'cuentas'])->name('registrar_empleado');
        Route::post('/guardar_empleado', [AdministracionController::class, 'store'])->name('empleados.store');
        Route::get('/listar_empleados', [AdministracionController::class, 'listar_empleados'])->name('listar_empleados');
        Route::delete('/listar_empleados/{id}', [AdministracionController::class, 'destroy'])->name('usuario.destroy');
        Route::get('/editar_empleado/{id}', [AdministracionController::class, 'updateView'])->name('usuario.updateView');
        Route::put('/editarFunc/{id}', [AdministracionController::class, 'update'])->name('usuario.update');
        Route::get('/ver/{id}', [AdministracionController::class, 'show'])->name('usuario.show');
    });

    //Se chequea que tenga cuenta Propietario
    Route::middleware(['auth', 'checkown'])->group(function () {
        Route::post('/asignar_rol/confirmacion/{id}', [AdministracionController::class, 'asignacion'])->name('roles.asignar');
        Route::get('/asignar_rol/{id}', [AdministracionController::class, 'asignarRol'])->name('usuario.asignarRol');
    });

    //Rutas para la asistencia
    Route::controller(AsistenciaController::class)->group(function () {
        Route::get('/asistencia', 'asistencia')->name('asistencia');
        Route::post('/asistencia/check-in/{userId}', 'checkIn')->name('asistencia.check-in');
        Route::post('/asistencia/check-out/{userId}', 'checkOut')->name('asistencia.check-out');
        Route::get('/asistencia/listado', 'listadoAsistencias')->name('asistencia.listado');
    });

    //Rutas para la modificación de las existencias
    Route::get('/inventario/no-preparados', [AdministracionController::class, 'listarProductosEInsumos'])->name('administracion.listarProductosEInsumos');
    Route::put('/inventario/update-existencias', [AdministracionController::class, 'updateExistencias'])->name('administracion.updateExistencias');

    //Ruta de la gestión de insumos
    Route::resource('insumos', InsumoController::class);
    Route::get('/insumo/reporte', [InsumoController::class, 'verReporte'])->name('insumo.vistaReporte');
    Route::get('insumo/tabla', [InsumoController::class, 'generarReporte'])->name('insumo.reporte');
    Route::get('insumo/grafico', [InsumoController::class, 'mostrarGrafico'])->name('insumo.grafico');
    //Ruta de gestión de productos
    Route::resource('productos', ProductoController::class);
    //Ruta de gestión de descuentos
    Route::resource('descuentos', DescuentosController::class);
    //Ruta para el reporte de empleados
    Route::get('/reporte_empleados', [ReporteEmpleadosController::class, 'reportesEmpleados'])->name('administracion.ReporteEmpleados');


    //Rutas de Evaluaciones
    // Ruta de gestión de evaluaciones
    Route::resource('evaluaciones', EvaluacionController::class);
    // Ruta para responder las preguntas   
    Route::get('evaluaciones/{id}/responder', [EvaluacionController::class, 'miRespuesta'])->name('evaluaciones.responder');
    // Ruta para almacenar las respuestas
    Route::post('evaluaciones/responder', [EvaluacionController::class, 'responder'])->name('respuestas.store');


    //Rutas de Resultados
    // Ruta para mostrar los resultados
    Route::get('resultados', [EvaluacionController::class, 'resultados'])->name('resultados');
    // Ruta para ver los usuarios que han respondido una evaluación
    Route::get('evaluaciones/{evaluacion}/usuarios', [EvaluacionController::class, 'verUsuarios'])->name('evaluaciones.verUsuarios');
    // Ruta para ver las respuestas de un usuario específico
    Route::get('evaluaciones/{evaluacion}/user/{user}/respuestas', [EvaluacionController::class, 'verRespuestasUsuario'])->name('evaluaciones.verRespuestas');
    // Ruta para ver las gráficas de una evaluación
    Route::get('graficos/{evaluacion}', [EvaluacionController::class, 'graficos'])->name('evaluaciones.graficos');


    //Ruta que llama a la vista de No disponible
    Route::get('/not-available', function () {
        return view('no_disponible');
    })->name('no_disponible');
});

//Ruta para cerrar sesión  NO TOCAR NI MOVER NI NADA!!! >:/
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
