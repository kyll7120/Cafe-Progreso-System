<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\Producto;
use App\Models\Insumo;

class RecetaController extends Controller
{
    public function index()
    {
        // Obtener todas las recetas y productos
        $recetas = Receta::with('producto')->get()->groupBy(function ($receta) {
            return $receta->producto->id;
        });

        // Obtener todos los productos preparados, independientemente de si tienen recetas o no
        $productos = Producto::select('id', 'nombre')
            ->where('es_preparado', true)
            ->get(); // Quitar el whereIn para incluir todos los productos preparados

        $insumos = Insumo::select('id', 'nombre')->get();

        return view('recetas.index', compact('recetas', 'productos', 'insumos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'insumo_id' => 'required|exists:insumos,id',
            'cantidad_requerida' => 'required|numeric|min:0',
        ]);

        // Crear el registro en la tabla receta sin redirigir
        Receta::create([
            'producto_id' => $request->producto_id,
            'insumo_id' => $request->insumo_id,
            'cantidad_requerida' => $request->cantidad_requerida,
        ]);

        // Obtener todas las recetas relacionadas al producto seleccionado
        $recetasProducto = Receta::where('producto_id', $request->producto_id)->get();

        // Mantener la página abierta para agregar más insumos
        session()->flash('modalOpen', true);
        session()->flash('producto_id', $request->producto_id);
        session()->flash('recetasProducto', $recetasProducto);

        // Recargar la misma vista
        return redirect()->route('receta.showModal'); // Ajusta esta ruta si es necesario
    }


    public function showRecetaModal(Request $request)
    {
        // Validar que el producto_id esté presente
        $productoId = $request->input('producto_id');

        // Obtener las recetas asociadas al producto
        $recetasProducto = Receta::where('producto_id', $productoId)->get();

        // Pasar las recetas filtradas a la vista y abrir el modal
        return redirect()->route('listar.recetas')->with([
            'modalOpen' => true,
            'producto_id' => $productoId,
            'recetasProducto' => $recetasProducto,
        ]);
    }

    public function eliminarInsumoReceta($recetaId)
    {
        $receta = Receta::findOrFail($recetaId);
        $productoId = $receta->producto_id;

        // Eliminar el insumo de la receta
        $receta->delete();

        // Obtener todas las recetas restantes para el producto
        $recetasProducto = Receta::where('producto_id', $productoId)->get();

        // Redirigir de nuevo al modal con la lista actualizada de insumos
        return redirect()->route('listar.recetas')->with([
            'modalOpen' => true,
            'producto_id' => $productoId,
            'recetasProducto' => $recetasProducto,
        ]);
    }

    public function edit($id)
    {
        $receta = Receta::findOrFail($id);
        $producto = Producto::with('recetas.insumo')->findOrFail($receta->producto_id); // Cargar insumos con recetas

        return view('recetas.edit', compact('receta', 'producto'));
    }


    public function update(Request $request, $id)
    {
        // Validar las cantidades de los insumos
        $request->validate([
            'cantidades' => 'required|array', // Validar que se envíe un array de cantidades
            'cantidades.*' => 'required|numeric|min:0', // Validar cada cantidad
        ]);

        // Encontrar la receta original
        $receta = Receta::findOrFail($id);
        $productoId = $receta->producto_id;

        // Actualizar las cantidades de cada insumo
        foreach ($request->cantidades as $insumoId => $cantidad) {
            // Buscar la receta correspondiente para el insumo
            $recetaIns = Receta::where('producto_id', $productoId)
                ->where('insumo_id', $insumoId)
                ->first();

            if ($recetaIns) {
                // Actualizar la cantidad requerida de la receta
                $recetaIns->update(['cantidad_requerida' => $cantidad]);
            }
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('listar.recetas')->with('success', 'Receta actualizada con éxito');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Eliminar todas las recetas asociadas al producto
        Receta::where('producto_id', $producto->id)->delete();

        return redirect()->route('listar.recetas')->with('success', 'Receta del producto eliminada con éxito');
    }

    public function show($id)
    {
        // Obtener la receta por su ID (solo para obtener el producto)
        $receta = Receta::with('producto')->findOrFail($id);

        // Obtener todas las recetas asociadas al producto de esta receta
        $recetas = Receta::with('insumo')->where('producto_id', $receta->producto->id)->get();

        // Pasar el producto y todas las recetas con sus insumos a la vista
        return view('recetas.show', [
            'producto' => $receta->producto,
            'recetas' => $recetas
        ]);
    }



    // public function show($id)
    // {
    //     // Obtener la receta con los insumos asociados
    //     $receta = Receta::with('insumo')->findOrFail($id);
    //     $producto = Producto::findOrFail($receta->producto_id);

    //     // Pasar la información a la vista
    //     return view('recetas.show', compact('receta', 'producto'));
    // }
}
