<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{

    /**
     * Muestra el listado de los productos.
     */
    public function index(Request $request)
    {
        $productos = Producto::with('categoria', 'insumos')->paginate(10); // Cambia 10 por el número deseado de elementos por página

        // Calcular existencias para productos preparados
        foreach ($productos as $producto) {
            if ($producto->es_preparado) {
                $producto->existencias = $producto->calcularExistencias();
            }
        }

        return view('productos.index', compact('productos'))
            ->with('i', ($request->input('page', 1) - 1) * $productos->perPage());
    }



    /**
     * Muestra el formulario para crear un nuevo producto
     */
    public function create()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();

        return view('productos.create', compact('productos', 'categorias'));
    }

    /**
     * Guarda un producto creado
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_categoria' => 'nullable|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric',
            'existencias' => 'integer',
            'es_preparado' => 'boolean',
        ]);

        // Establecer valor predeterminado de 0 para existencias si es nulo
        if (!isset($validatedData['existencias'])) {
            $validatedData['existencias'] = 0;
        }

        if ($request->es_preparado) {
            $producto = new Producto($validatedData);
            $producto->existencias = $producto->calcularExistencias();
            $producto->save();
        } else {
            Producto::create($validatedData);
        }

        return redirect()->route('productos.index')->with('success', 'Producto registrado con éxito!');
    }

    /**
     * Muestra los detalles de un producto.
     */
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);

        return view('productos.show', compact('producto'));
    }


    /**
     * Muestra el formulario para editar un producto.
     */
    public function edit($id)
    {
        $producto = Producto::with('insumos')->findOrFail($id);
        $categorias = Categoria::all();

        if ($producto->es_preparado) {
            $producto->existencias = $producto->calcularExistencias();
        }

        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza un producto en especifico
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_categoria' => 'nullable|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric',
            'existencias' => 'integer',
            'es_preparado' => 'boolean',
        ]);

        $producto = Producto::findOrFail($id);

        if ($request->es_preparado) {
            $producto->fill($validatedData);
            $producto->existencias = $producto->calcularExistencias();
            $producto->save();
        } else {
            $producto->update($validatedData);
        }


        return redirect()->route('productos.index')->with('success', 'Producto editado con éxito!');
    }


    /**
     * Elimina un insumo en especifico
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Verificar si el producto está asociado a algún descuento
        if ($producto->descuentos->isNotEmpty()) {
            $descuentos = $producto->descuentos->pluck('nombre')->toArray();
            $descuentosLista = implode(', ', $descuentos);
            return back()->withErrors(['productos.index' => 'No se puede eliminar el producto porque pertenece a los siguientes descuentos: ' . $descuentosLista])->withInput();
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito!');
    }
}
