<?php

namespace App\Http\Controllers;

use App\Models\LineaDeVenta;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\LineaDeVentaAuxiliar;
use App\Models\Insumo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{

    public function RegistrarVenta()
    {
        $empleadoId = auth()->user()->id;
        $totalSubtotales = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->sum('subtotal');
        $totalDescuentos = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->sum('descuento');
        $productos = Producto::all();
    
        // Aplicar paginación a las líneas de venta
        $lineasDeVenta = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->paginate(10); // Cambia 10 por el número deseado de elementos por página
        
        dd($productos, $lineasDeVenta, $totalDescuentos, $totalSubtotales);
        return view('ventas.registrarVenta', compact('productos', 'lineasDeVenta', 'totalDescuentos', 'totalSubtotales'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Ajuste para el número de la lista
    }
    

    //Braian
    public function ReportesVentas(Request $request)
    {
        $query = Venta::with('lineas');
        $lineaVenta = LineaDeVenta::with('producto')->get();
        $productos = Producto::all();
        $empleados = User::all();
        $mensaje = "";
        $nombreProducto = 'N/A';
        $productoName = 'N/A';
        $nombreEmpleado = 'N/A';
        $cantidadMasVendida = 0;
        $productoMasVendido = null;
        $totalVentas = 0.0;
        $totalCantidad = 0;
        $productoID = 0;

        
        // Obtener la fecha actual
        $today = Carbon::now()->setTimezone('America/El_Salvador')->format('Y-m-d');
        
        // Filtrar por la fecha actual al cargar la página
        if (!$request->filled('fechaInicioVenta') && !$request->filled('fechaFinVenta')) {
            $request->merge(['fechaInicioVenta' => $today, 'fechaFinVenta' => $today]);
        };
        
        //Filtra por el nombre del cliente
        if ($request->filled('nombreClienteInput')) {

            $query->where('nombre_cliente', 'like', '%' . $request->input('nombreClienteInput') . '%');
     
        };


        //Filtra las ventas por producto
        if ($request->filled('producto')) {

                
            $query->whereHas('lineas', function ($q) use ($request) {
                $q->where('producto_id', $request->input('producto'));
            });

            
            $startDate = null;
            $endDate = null;
            //Obtiene la fecha para filtrar en ese periodo los productos
            if ($request->filled('fechaInicioVenta') && $request->filled('fechaFinVenta')) {
                $startDate = Carbon::createFromFormat('Y-m-d', $request->input('fechaInicioVenta'))->format('Y-m-d');
                $endDate = Carbon::createFromFormat('Y-m-d', $request->input('fechaFinVenta'))->format('Y-m-d');

                $mensaje = 'Desde '.$startDate.' hasta'.$endDate;
                
                $query->whereBetween(DB::raw('DATE(fecha_hora_venta)'), [$startDate, $endDate]);
            }

            // Obtener la cantidad total vendida del producto especificado en el rango de fechas
            $totalCantidad = LineaDeVenta::where('producto_id', $request->input('producto'))
                ->whereHas('venta', function($q) use ($startDate, $endDate) {
                    $q->whereBetween(DB::raw('DATE(fecha_hora_venta)'), [$startDate, $endDate]);
                    })->sum('cantidad');
            
            //Obtiene el nombre del producto filtrado
            $productoN = Producto::find($request->input('producto'));
            if ($productoN) {
                $nombreProducto = $productoN->nombre;
            }
    
        };

        //Filtra las ventas por empleado
        if ($request->filled('empleado')) {
           
            $query->where('empleado_id', $request->input('empleado'));

            //Sirve para obtener el nombre del empleado
            $empleadoN = User::find($request->input('empleado'));
            if ($empleadoN) {
                $nombreEmpleado = $empleadoN->name;
            }
     
        };

        if ($request->filled('fechaInicioVenta') && $request->filled('fechaFinVenta')) {
            
            //le da formato de aaaa/mm/dd a la fecha
            $formatoFechaInicio = Carbon::createFromFormat('Y-m-d', $request->input('fechaInicioVenta'))->format('Y/m/d');
            $formatoFechaFin = Carbon::createFromFormat('Y-m-d', $request->input('fechaFinVenta'))->format('Y/m/d');

            $mensaje = 'Desde '.$formatoFechaInicio.' hasta '.$formatoFechaFin;

            $query->whereBetween(DB::raw('DATE(fecha_hora_venta)'), [$formatoFechaInicio, $formatoFechaFin]);

            //Aqui comienza

            //Verifica que no este seleccionado ningun producto en el filtro
            if(!$request->filled('producto')){

                // Obtiene el producto más vendido en el rango de fechas
                $productoMasVendido = LineaDeVenta::whereHas('venta', function ($q) use ($formatoFechaInicio, $formatoFechaFin) {
                    $q->whereBetween(DB::raw('DATE(fecha_hora_venta)'), [$formatoFechaInicio, $formatoFechaFin]);
                })
                ->select('producto_id', DB::raw('SUM(cantidad) as total_vendida'))
                ->groupBy('producto_id')
                ->orderByDesc('total_vendida')
                ->first();
            
                    if ($productoMasVendido) {

                        $cantidadMasVendida = $productoMasVendido->total_vendida;
                        $productoID = $productoMasVendido->producto_id;

                        $productooo = Producto::find($productoID);
                        if ($productooo) {
                            $productoName = $productooo->nombre;
                        }else{
                            $productoName = "N/A";
                        }
                
                }
                //Aqui terminar
            }
             
        };
        
        
        $VentasFiltradas= $query->get();

        //Calcula el monto total vendido en las ventas filtradas
        $totalVentas = $query->with('lineas')->get()->pluck('lineas.*.subtotal')->flatten()->sum();
        

        return view('ventas.reportesVenta', compact('VentasFiltradas', 'productoName','cantidadMasVendida', 'productoMasVendido', 'nombreProducto', 'nombreEmpleado','productos', 'empleados', 'lineaVenta', 'mensaje', 'totalVentas', 'totalCantidad'));
    }

    //Historial de Ventas
    public function HistorialVentas()
    {
        // Aplicar paginación a las ventas
        $ventas = Venta::with('lineas.producto')->orderBy('fecha_hora_venta')->paginate(10); // Cambia 10 por el número deseado de elementos por página
    
        return view('ventas.historialVenta', compact('ventas'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Ajuste para el número de la lista
    }
    

    //Ver detalles de la venta
    public function DetalleVentas($id)
    {
        $venta = Venta::with('lineas.producto')->findOrFail($id);
        $empleado = User::find($venta->empleado_id);
        $nombre = $empleado->name;
        return view('ventas.detallesVenta', compact('venta', 'nombre'))->with('i');
    }


    public function Menu()
    {
        return view('ventas.menuVentas');
    }

    public function crear_venta_view()
    {
        return view('ventas.creacionVenta');
    }

    public function CrearVenta(Request $request)
    {
        // Obtener solo las líneas auxiliares que pertenecen al empleado logueado
        $empleadoId = auth()->user()->id;
        $lineasAuxiliares = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->get();

        // Crear una nueva venta
        $venta = new Venta();
        $venta->nombre_cliente = $request->nombre_cliente;
        $venta->telefono_cliente = $request->telefono_cliente;
        $venta->descuento_total_venta = 0;
        $venta->total_venta = 0;
        $venta->fecha_hora_venta = now()->setTimezone('America/El_Salvador');
        $venta->empleado_id = auth()->user()->id; // Asignar el ID del empleado logueado
        $venta->save();

        foreach ($lineasAuxiliares as $lineaAuxiliar) {
            // Crear una nueva línea de venta
            $lineaVenta = new LineaDeVenta();
            $lineaVenta->venta_id = $venta->id; // Relacionar con la venta
            $lineaVenta->producto_id = $lineaAuxiliar->producto_id;

            $lineaVenta->cantidad = $lineaAuxiliar->cantidad;
            $lineaVenta->descuento = $lineaAuxiliar->descuento;
            $lineaVenta->subtotal = $lineaAuxiliar->subtotal;
            //$lineaVenta->empleado_id = $empleadoId; // Asignar el ID del empleado logueado a la línea de venta
            $lineaVenta->save();

            $producto = Producto::find($lineaAuxiliar->producto_id);
        }

        // Actualizar los totales de la venta
        $venta->descuento_total_venta = $venta->lineas()->sum('descuento');
        $venta->total_venta = $venta->lineas()->sum('subtotal');
        $venta->save();

        // Limpiar las líneas auxiliares del empleado logueado
        LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->delete();
        return redirect()->back()->with('success', 'Venta creada exitosamente.');
    }

    public function EditarVenta($id)
    {
        $venta = Venta::with('lineas.producto')->findOrFail($id);
        $productos = Producto::all();

        return view('ventas.editarVenta', compact('venta', 'productos'))->with('i');
    }

    public function ActualizarVenta(Request $request, $id)
    {
        $request->validate([
            'nombre_cliente' => 'required|string',
            'telefono_cliente' => 'required|string',
            'lineas.*.id' => 'required|exists:linea_de_ventas,id',
            'lineas.*.producto_id' => 'required|exists:productos,id',
            'lineas.*.cantidad' => 'required|numeric|min:1',
            'lineas.*.descuento' => 'nullable|numeric|min:0',
        ]);

        $venta = Venta::findOrFail($id);
        $erroresStock = [];

        // Validar existencias de cada línea
        foreach ($request->lineas as $lineaData) {
            $producto = Producto::find($lineaData['producto_id']);
            $cantidad = $lineaData['cantidad'];
            $cantidadAnterior = LineaDeVenta::findOrFail($lineaData['id'])->cantidad;

            // Validar existencias para productos no preparados
            if (!$producto->es_preparado) {
                $diferenciaCantidad = $cantidad - $cantidadAnterior;

                if ($producto->existencias < $diferenciaCantidad) {
                    $erroresStock[] = "No hay suficiente stock de {$producto->nombre}. Disponible: {$producto->existencias}, Requerido: {$diferenciaCantidad}.";
                }
            } else {
                // Validar existencias de insumos para productos preparados
                foreach ($producto->insumos as $insumo) {
                    $cantidadUsadaAnterior = $insumo->pivot->cantidad_requerida * $cantidadAnterior;
                    $cantidadUsadaNueva = $insumo->pivot->cantidad_requerida * $cantidad;
                    $diferenciaInsumo = $cantidadUsadaNueva - $cantidadUsadaAnterior;

                    if ($insumo->existencias < $diferenciaInsumo) {
                        $erroresStock[] = "No hay suficiente stock de {$insumo->nombre}. Disponible: {$insumo->existencias}, Requerido: {$diferenciaInsumo}.";
                    }
                }
            }
        }

        // Detener y mostrar errores de inventario si los hay
        if (!empty($erroresStock)) {
            return redirect()->back()->withErrors($erroresStock)->withInput();
        }

        // Actualizar los datos de la venta
        $venta->nombre_cliente = $request->nombre_cliente;
        $venta->telefono_cliente = $request->telefono_cliente;
        $venta->save();

        // Actualizar existencias y detalles de cada línea de la venta
        foreach ($request->lineas as $lineaData) {
            $lineaVenta = LineaDeVenta::findOrFail($lineaData['id']);
            $producto = Producto::find($lineaData['producto_id']);
            $cantidadAnterior = $lineaVenta->cantidad;
            $cantidad = $lineaData['cantidad'];

            // Ajuste de existencias para productos preparados y no preparados
            if ($producto->es_preparado) {
                foreach ($producto->insumos as $insumoPivot) {
                    $insumo = Insumo::find($insumoPivot->id);
                    $cantidadUsadaAnterior = $insumoPivot->pivot->cantidad_requerida * $cantidadAnterior;
                    $cantidadUsadaNueva = $insumoPivot->pivot->cantidad_requerida * $cantidad;

                    $insumo->existencias += $cantidadUsadaAnterior; // Devolver existencias anteriores
                    $insumo->existencias -= $cantidadUsadaNueva; // Reducir existencias nuevas
                    $insumo->save();
                }
            } else {
                // Ajuste de existencias para productos no preparados
                $diferenciaCantidad = $cantidad - $cantidadAnterior;
                $producto->existencias -= $diferenciaCantidad;
                $producto->save();
            }

            // Actualizar los detalles de la línea de venta
            $precioUnitario = $producto->precio_unitario;
            $descuento = $lineaData['descuento'] ?? 0;
            $subtotal = $precioUnitario * $cantidad - $descuento;

            $lineaVenta->producto_id = $lineaData['producto_id'];
            $lineaVenta->cantidad = $cantidad;
            $lineaVenta->descuento = $descuento;
            $lineaVenta->subtotal = $subtotal;
            $lineaVenta->save();
        }

        // Actualizar totales de la venta
        $venta->descuento_total_venta = $venta->lineas()->sum('descuento');
        $venta->total_venta = $venta->lineas()->sum('subtotal');
        $venta->save();

        return redirect()->route('ventas.historial')->with('success', 'Venta actualizada exitosamente.');
    }
}
