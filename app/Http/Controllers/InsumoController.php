<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class InsumoController extends Controller
{
    /**
     * Muestra el listado de los insumos.
     */
    public function index(Request $request): View
{
    $insumos = Insumo::paginate(10); // Cambia 10 por el número deseado de elementos por página

    return view('insumo.index', compact('insumos'))
        ->with('i', ($request->input('page', 1) - 1) * $insumos->perPage());
}


    /**
     * Muestra el formulario para crear un nuevo insumo
     */
    public function create(): View
    {
        $insumo = new Insumo();

        return view('insumo.create', compact('insumo'));
    }

    /**
     * Guarda un insumo creado
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'existencias' => 'required|numeric',
            'precio_unitario' => 'required|numeric|min:0',
            'unidad' => 'required|string'
        ]);

        Insumo::create($validatedData);

        return Redirect::route('insumos.index')
            ->with('success', 'Insumo registrado con éxito!');
    }


    /**
     * Muestra los detalles de un insumo. NO SE USA, pero por si las moscas
     */
    public function show($id): View
    {
        $insumo = Insumo::findOrFail($id);

        return view('insumo.show', compact('insumo'));
    }

    /**
     * Muestra el formulario para editar un insumo.
     */
    public function edit($id): View
    {
        $insumo = Insumo::findOrFail($id);

        return view('insumo.edit', compact('insumo'));
    }

    /**
     * Actualiza un insumo en especifico
     */
    public function update(Request $request, Insumo $insumo): RedirectResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'existencias' => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'unidad' => 'required'
        ]);

        $insumo->update($validatedData);

        return Redirect::route('insumos.index')
            ->with('success', 'Insumo editado con éxito!');
    }

    /**
     * Elimina un insumo en especifico
     */
    public function destroy($id): RedirectResponse
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->delete();

        return Redirect::route('insumos.index')
            ->with('success', 'Insumo eliminado con éxito!');
    }

    public function verReporte()
    {
        return view('insumo.reporte');
        // return Redirect::route('insumo.reporte');
    }

    public function generarReporte(Request $request)
    {
        // Validar el campo de mes (formato YYYY-MM)
        $request->validate([
            'mes' => 'required|date_format:Y-m',
        ]);
        // Obtener el mes y el año del formulario
        $mesSeleccionado = $request->input('mes');
        $año = substr($mesSeleccionado, 0, 4); // Extraer el año
        $mes = substr($mesSeleccionado, 5, 2); // Extraer el mes en formato numérico

        // Consulta para obtener los insumos usados en las ventas filtradas por mes y año
        $insumosUsados = Insumo::join('recetas', 'insumos.id', '=', 'recetas.insumo_id')
            ->join('productos', 'recetas.producto_id', '=', 'productos.id')
            ->join('linea_de_ventas', 'productos.id', '=', 'linea_de_ventas.producto_id')
            ->join('ventas', 'linea_de_ventas.venta_id', '=', 'ventas.id')
            ->select(
                'insumos.nombre',
                DB::raw('SUM(linea_de_ventas.cantidad * recetas.cantidad_requerida) as cantidad_usada'),
                'insumos.existencias'
            )
            ->whereYear('ventas.fecha_hora_venta', $año)   // Filtrar por año
            ->whereMonth('ventas.fecha_hora_venta', $mes)   // Filtrar por mes
            ->groupBy('insumos.nombre', 'insumos.existencias')
            ->orderBy('cantidad_usada', 'desc')
            ->get()
            ->map(function ($insumo) {
                return [
                    'nombre' => $insumo->nombre,
                    'cantidad_usada' => $insumo->cantidad_usada,
                    'cantidad_disponible' => $insumo->existencias,
                    'porcentaje_uso' => $insumo->existencias ? number_format(($insumo->cantidad_usada / ($insumo->cantidad_usada + $insumo->existencias)) * 100, 2) : 0,
                ];
            });

        // Guardar los datos en la sesión
        session(['insumosUsados' => $insumosUsados, 'mes-anio' => $mesSeleccionado]);

        // Retornar la vista con los datos obtenidos
        return view('insumo.tabla', compact('insumosUsados'));
    }


    public function mostrarGrafico(Request $request)
    {
        $insumosUsados = session('insumosUsados');
        $mesAnio = session('mes-anio');

        if (!$insumosUsados) {
            return redirect()->route('insumo.reporte')->with('error', 'No hay datos disponibles para generar el gráfico.');
        }

        // Convertir los resultados en un array para enviarlo a la vista
        $data = collect($insumosUsados)->map(function ($insumo) {
            return [
                'nombre' => $insumo['nombre'],
                'cantidad_usada' => $insumo['cantidad_usada'],
            ];
        });

        //aqui
        $mesNombre = Carbon::parse($mesAnio)->translatedFormat('F');
        $año = Carbon::parse($mesAnio)->format('Y');

        return view('insumo.grafico', compact('data', 'mesNombre', 'año'));
    }
}
