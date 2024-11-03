<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineaDeVentaAuxiliar;
use App\Models\Producto;
use App\Models\Descuento;
use App\Models\Insumo;
use App\Models\LineaDeVenta;

class LineaDeVentaAuxiliarController extends Controller
{
    public function guardarLineaAuxiliar(Request $request)
    {
        $producto = Producto::find($request->input('producto'));
        $empleadoId = auth()->user()->id; // Obtener el id del empleado logueado
        $cantidad = $request->cantidad;

        // ** Manejo de existencias de productos no preparados **
        $erroresStock = [];
        
        if (!$producto->es_preparado) {
            // Si el producto no es preparado, verificar si tiene suficiente stock
            if ($producto->existencias < $cantidad) {
                $erroresStock[] = "No hay suficiente stock de {$producto->nombre}. Disponible: {$producto->existencias}, Requerido: {$cantidad}.";
            }
        } else {
            // Si el producto es preparado, verificar existencias de insumos
            foreach ($producto->insumos as $insumo) {
                $cantidadUsada = $insumo->pivot->cantidad_requerida * $cantidad;

                if ($insumo->existencias < $cantidadUsada) {
                    $erroresStock[] = "No hay suficiente stock de {$insumo->nombre}. Disponible: {$insumo->existencias}, Requerido: {$cantidadUsada}.";
                }
            }
        }

        // Si hay errores de inventario, detener el guardado y mostrar el mensaje
        if (!empty($erroresStock)) {
            return redirect()->back()->withErrors($erroresStock)->withInput();
        }
        // ** FIN manejo de existencias **

        // Buscar si ya existe una línea para ese producto y ese empleado
        $idLinea = LineaDeVentaAuxiliar::where('producto_id', $producto->id)
            ->where('empleado_id', $empleadoId)
            ->first();

        $descuento = 0;
        $descuentoModel = $producto->descuentos()->first(); // Obtener el primer descuento
        if ($descuentoModel) {
            $descuento = $descuentoModel->porcentaje; // Asignar el porcentaje si hay un descuento
        }

        $precioUnitario = $producto->precio_unitario;
        $subtotal = $cantidad * $precioUnitario * (1 - $descuento);

        if ($idLinea) {
            // Si ya existe la línea, se actualiza
            $lineaVenta = LineaDeVentaAuxiliar::findOrFail($idLinea->id);
            $lineaVenta->cantidad += $cantidad;
            $lineaVenta->descuento += $descuento * $cantidad * $precioUnitario;
            $lineaVenta->subtotal += $subtotal;
            $lineaVenta->save();
        } else {
            // Si no existe la línea, se crea una nueva
            $lineaVenta = new LineaDeVentaAuxiliar();
            $lineaVenta->producto_id = $producto->id;
            $lineaVenta->cantidad = $cantidad;
            $lineaVenta->descuento = $descuento * $cantidad * $precioUnitario;
            $lineaVenta->subtotal = $subtotal;
            $lineaVenta->empleado_id = $empleadoId;
            $lineaVenta->save();
        }

        // ** Reducción de existencias de insumos al guardar la línea auxiliar **
        if ($producto->es_preparado) {
            foreach ($producto->insumos as $insumoPivot) {
                $insumo = Insumo::find($insumoPivot->id);
                $cantidadUsada = $insumoPivot->pivot->cantidad_requerida * $cantidad;

                $insumo->existencias -= $cantidadUsada;
                $insumo->save();
            }
        } else {
            // Si no es preparado, reducir existencias directamente del producto
            $producto->existencias -= $cantidad;
            $producto->save();
        }
        // ** FIN reducción de existencias **

        // Obtener totales solo de las líneas del empleado logueado
        $totalSubtotales = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->sum('subtotal');
        $totalDescuentos = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->sum('descuento');

        return redirect()->route('ventas.registrar')->with([
            'success' => 'Línea de venta guardada exitosamente.',
            'productos' => Producto::all(),
            'lineasDeVenta' => LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->get(),
            'totalSubtotales' => $totalSubtotales,
            'totalDescuentos' => $totalDescuentos,
        ]);
    }


    public function eliminarLinea($id)
    {
        $empleadoId = auth()->user()->id; // Obtener el id del empleado logueado
        $linea = LineaDeVentaAuxiliar::where('id', $id)
            ->where('empleado_id', $empleadoId) // Solo permite eliminar si la línea pertenece al empleado
            ->firstOrFail();

        // Obtener el producto relacionado con la línea de venta
        $producto = Producto::find($linea->producto_id);

        // Devolver existencias de insumos si el producto es elaborado
        if ($producto && $producto->es_preparado) {
            foreach ($producto->insumos as $insumoPivot) {
                $insumo = Insumo::find($insumoPivot->id);
                $cantidadUsada = $insumoPivot->pivot->cantidad_requerida * $linea->cantidad;

                // Devolver la cantidad de insumo
                $insumo->existencias += $cantidadUsada;
                $insumo->save();
            }
        } else {
            // Si no es elaborado, devolver existencias directamente del producto
            $producto->existencias += $linea->cantidad;
            $producto->save();
        }

        $linea->delete();

        // Obtener totales solo de las líneas del empleado logueado
        $totalSubtotales = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->sum('subtotal');
        $totalDescuentos = LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->sum('descuento');

        return redirect()->route('ventas.registrar')->with([
            'success' => 'Línea de venta eliminada.',
            'productos' => Producto::all(),
            'lineasDeVenta' => LineaDeVentaAuxiliar::where('empleado_id', $empleadoId)->get(), // Solo líneas del empleado logueado
            'totalSubtotales' => $totalSubtotales,
            'totalDescuentos' => $totalDescuentos,
        ]);
    }

}
