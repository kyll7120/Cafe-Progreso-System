<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Descuento;
use App\Models\Producto;


use Illuminate\Http\Request;

class DescuentosController extends Controller
{
    public function show($id)
    {
        $descuentos = Descuento::findOrFail($id);
        return view('descuentos.show', compact('descuentos'));
    }

    public function index()
    {
        $descuentos = Descuento::paginate(10); // Cambia 10 por el número deseado de elementos por página
        return view('descuentos.listardescuentos', compact('descuentos'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Ajuste para el número de la lista
    }

    public function create()
    {
        $descuentos = Descuento::all();
        $productos = Producto::all();

        return view('descuentos.crearDescuento', compact('descuentos', 'productos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0|max:100', // Validar que el porcentaje esté entre 0 y 100
            'productos' => 'nullable|array',
            'productos.*' => 'exists:productos,id',
        ]);

        // Convertir el porcentaje a decimal
        $validatedData['porcentaje'] = $validatedData['porcentaje'] / 100;

        $descuento = Descuento::create($validatedData);

        if ($request->has('productos')) {
            $descuento->productos()->sync($request->productos);
        }

        return redirect()->route('descuentos.index')->with('success', 'Descuento registrado con éxito!');
    }

    public function edit($id)
    {
        $descuento = Descuento::with('productos')->findOrFail($id);
        $productos = Producto::all();

        return view('descuentos.editarDescuento', compact('descuento', 'productos'));
    }

    public function destroy($id)
    {
        $descuento = Descuento::findOrFail($id);
        $descuento->delete();

        return redirect()->route('descuentos.index')->with('success', 'Descuento eliminado con éxito!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|min:0|max:100', // Validar que el porcentaje esté entre 0 y 100
            'productos' => 'nullable|array',
            'productos.*' => 'exists:productos,id',
        ]);

        // Convertir el porcentaje a decimal
        $validatedData['porcentaje'] = $validatedData['porcentaje'] / 100;

        $descuento = Descuento::findOrFail($id);
        $descuento->update($validatedData);

        if ($request->has('productos')) {
            $descuento->productos()->sync($request->productos);
        } else {
            $descuento->productos()->detach();
        }

        return redirect()->route('descuentos.index')->with('success', 'Descuento editado con éxito!');
    }
}
