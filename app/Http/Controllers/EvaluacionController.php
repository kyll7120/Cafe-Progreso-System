<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;

class EvaluacionController extends Controller
{
    /**
     * Muestra una lista de evaluaciones para el usuario autenticado.
     * - Los administradores pueden ver todas las evaluaciones.
     * - Los empleados sólo ven las evaluaciones activas según la fecha.
     * 
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Obtener el usuario actual
        $user = auth()->user();

        // Asumir que el usuario tiene un único rol y obtener su ID, usando un valor por defecto
        $roleId = $user->roles->first()->id ?? null;

        // Verificar si el usuario es administrador (mejor usar un método como isAdmin())
        if ($roleId === 1) {
            $evaluaciones = Evaluacion::paginate(10); // Admin ve todas las evaluaciones
        } else {
            // Los empleados solo pueden ver evaluaciones activas basadas en la fecha
            $today = now()->toDateString();
            $evaluaciones = Evaluacion::where('fecha_inicio', '<=', $today)
                ->where('fecha_fin', '>=', $today)
                ->paginate(10);
        }

        // Retornar la vista con las evaluaciones y el rol del usuario
        return view('evaluaciones.index', compact('evaluaciones', 'roleId'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Ajuste para el número de la lists

    }

    /**
     * Muestra el formulario de creación de una nueva evaluación.
     * 
     * @return View
     */
    public function create(): View
    {
        // Crear una nueva instancia de Evaluacion (puede ser útil para el form binding)
        $evaluacion = new Evaluacion();

        // Renderizar la vista de creación de evaluaciones con los datos necesarios
        return view('evaluaciones.create', compact('evaluacion'));
    }


    /**
     * Almacena una nueva evaluación en la base de datos junto con sus preguntas asociadas.
     * - Se valida que las fechas sean correctas y que las preguntas sean opcionales.
     * - Crea la evaluación y asocia las preguntas no vacías a ella.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'preguntas.*' => 'nullable|string' // Las preguntas pueden ser cero o vacías
        ]);
        $validatedData['fecha_inicio'] = Carbon::createFromFormat('d-m-Y', $request->fecha_inicio)->format('Y-m-d');
        $validatedData['fecha_fin'] = Carbon::createFromFormat('d-m-Y', $request->fecha_fin)->format('Y-m-d');
        // Crear evaluación
        $evaluacion = Evaluacion::create($validatedData);

        // Crear preguntas asociadas a la evaluación
        $preguntas = $request->input('preguntas', []);
        foreach ($preguntas as $preguntaTexto) {
            if (!empty($preguntaTexto)) {
                $evaluacion->preguntas()->create(['texto' => $preguntaTexto]);
            }
        }

        return Redirect::route('evaluaciones.index')
            ->with('success', 'Evaluación registrada con éxito!');
    }

    /**
     * Muestra los detalles de una evaluación específica.
     * Utiliza el ID de la evaluación para buscarla en la base de datos.
     * 
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        // Buscar la evaluación o fallar con 404 si no se encuentra
        $evaluacion = Evaluacion::with('preguntas')->findOrFail($id);

        // Retornar la vista con los detalles de la evaluación
        return view('evaluaciones.show', compact('evaluacion'));
    }

    /**
     * Muestra el formulario de edición para una evaluación específica.
     * Verifica si la evaluación tiene respuestas asociadas para condicionar la edición de ciertos campos.
     * 
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        // Cargar la evaluación y verificar si tiene respuestas
        $evaluacion = Evaluacion::withCount('respuestas')->findOrFail($id);
        $tieneRespuestas = $evaluacion->respuestas_count > 0;

        // Retornar la vista de edición con la evaluación y si tiene respuestas
        return view('evaluaciones.edit', compact('evaluacion', 'tieneRespuestas'));
    }

    /**
     * Actualiza una evaluación existente en la base de datos.
     * Permite cambiar ciertos campos solo si la evaluación no tiene respuestas asociadas.
     * 
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date_format:d-m-Y',
            'fecha_fin' => 'required|date_format:d-m-Y|after_or_equal:fecha_inicio',
            'preguntas.*' => 'nullable|string'
        ]);

        // Convertir las fechas al formato Y-m-d para almacenar en la base de datos
        $validatedData['fecha_inicio'] = Carbon::createFromFormat('d-m-Y', $validatedData['fecha_inicio'])->format('Y-m-d');
        $validatedData['fecha_fin'] = Carbon::createFromFormat('d-m-Y', $validatedData['fecha_fin'])->format('Y-m-d');

        // Obtener evaluación
        $evaluacion = Evaluacion::findOrFail($id);
        $tieneRespuestas = $evaluacion->respuestas()->exists();

        // Solo permitir cambiar ciertos campos si ya tiene respuestas
        if (!$tieneRespuestas) {
            // Actualizar evaluación
            $evaluacion->update(array_merge(
                $request->only(['titulo', 'descripcion']),
                ['fecha_inicio' => $validatedData['fecha_inicio'], 'fecha_fin' => $validatedData['fecha_fin']]
            ));

            // Obtener IDs de preguntas existentes
            $preguntasIds = $request->input('preguntas_ids', []);
            $preguntasNuevas = array_filter($request->input('preguntas', []));

            // Actualizar preguntas existentes y eliminar preguntas no enviadas
            foreach ($evaluacion->preguntas as $pregunta) {
                if (in_array($pregunta->id, $preguntasIds)) {
                    // Actualizar preguntas existentes
                    $nuevoTexto = $request->input('preguntas')[$pregunta->id] ?? null;
                    if ($nuevoTexto) {
                        $pregunta->update(['texto' => $nuevoTexto]);
                    }
                } else {
                    // Eliminar preguntas que no están en el formulario
                    $pregunta->delete();
                }
            }

            // Crear nuevas preguntas si no están en la lista de IDs
            foreach ($preguntasNuevas as $index => $texto) {
                if (!empty($texto) && !in_array($texto, $evaluacion->preguntas->pluck('texto')->toArray())) {
                    $evaluacion->preguntas()->create(['texto' => $texto]);
                }
            }
        } else {
            // Solo se permite actualizar la fecha de fin y fecha inicio
            $evaluacion->update(['fecha_inicio' => $validatedData['fecha_inicio'], 'fecha_fin' => $validatedData['fecha_fin']]);
        }

        return Redirect::route('evaluaciones.index')
            ->with('success', 'Evaluación editada con éxito!');
    }


    /**
     * Elimina una evaluación específica de la base de datos.
     * 
     * @param int $id
     * @return RedirectResponse
     */

    public function destroy($id): RedirectResponse
    {
        try {
            $evaluacion = Evaluacion::findOrFail($id);

            // Eliminar evaluación
            $evaluacion->delete();

            return Redirect::route('evaluaciones.index')
                ->with('success', 'Evaluación eliminada con éxito!');
        } catch (\Exception $e) {
            return Redirect::route('evaluaciones.index')
                ->withErrors('Error al eliminar la evaluación: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para que el usuario responda a una evaluación específica.
     * Carga las preguntas asociadas a la evaluación y pasa la información necesaria a la vista.
     * 
     * @param int $id
     * @return View
     */
    public function miRespuesta($id): View
    {
        // Obtener la evaluación con preguntas relacionadas
        $evaluacion = Evaluacion::with('preguntas')->findOrFail($id);

        // Retornar la vista con los datos necesarios
        return view('evaluaciones.responder', [
            'evaluacion' => $evaluacion,
            'preguntas' => $evaluacion->preguntas,
            'titulo' => $evaluacion->titulo // Agrega el título aquí
        ]);
    }

    /**
     * Procesa las respuestas de un usuario para una evaluación específica.
     * Valida los datos del formulario y guarda las respuestas en la base de datos.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function responder(Request $request): RedirectResponse
    {
        // Validar los datos del formulario
        $request->validate([
            'evaluacion_id' => 'required|exists:evaluaciones,id', // Evaluación debe existir
            'respuestas.*' => 'required|integer|between:1,10', // Respuestas entre 1 y 10
        ]);


        $evaluacionId = $request->input('evaluacion_id');
        $respuestas = $request->input('respuestas'); // Un array de respuestas
        $userId = auth()->user()->id; // Obtener el ID del usuario autenticado

        // Comenzar una transacción para asegurar la integridad de los datos
        try {
            DB::transaction(function () use ($evaluacionId, $respuestas, $userId) {
                foreach ($respuestas as $preguntaId => $respuesta) {
                    // Buscar o crear una respuesta para la evaluación, pregunta y usuario correspondientes
                    \App\Models\Respuesta::updateOrCreate(
                        [
                            'evaluacion_id' => $evaluacionId,
                            'pregunta_id' => $preguntaId,
                            'user_id' => $userId,
                        ],
                        [
                            'respuesta' => $respuesta
                        ]
                    );
                }
            });

            return Redirect::route('evaluaciones.index')
                ->with('success', 'Respuestas enviadas con éxito!');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('Error al enviar las respuestas: ' . $e->getMessage());
        }
    }

    /**
     * Muestra los resultados de las evaluaciones.
     * Obtiene las evaluaciones y sus respuestas dependiendo del rol del usuario.
     * 
     * @return View
     */
    public function resultados(Request $request): View
    {
        // Obtener el usuario actual
        $user = auth()->user();

        // Obtener el rol del usuario (asumiendo que un usuario tiene un solo rol)
        $roleId = $user->roles->first()->id ?? null; // Obtiene el ID del primer rol o null si no tiene

        // Verificar si el usuario es administrador
        if ($roleId == 1 || $roleId == 2) {
            $evaluaciones = Evaluacion::with(['respuestas.user', 'respuestas.pregunta'])->paginate(10); // Cambia 10 por el número deseado de elementos por página
        } else {
            // Si no es admin, obtenemos solo las evaluaciones donde el usuario ha respondido
            $evaluaciones = Evaluacion::with(['respuestas.user', 'respuestas.pregunta'])
                ->whereHas('respuestas', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->paginate(10); // Cambia 10 por el número deseado de elementos por página
        }

        return view('evaluaciones.resultados', compact('evaluaciones'))
            ->with('i', ($request->input('page', 1) - 1) * $evaluaciones->perPage());
    }


    /**
     * Muestra las respuestas de un usuario específico en una evaluación.
     * Carga la evaluación junto con sus preguntas y las respuestas del usuario.
     *
     * @param int $evaluacionId
     * @param int $userId
     * @return View
     */
    public function verRespuestas(int $evaluacionId, int $userId): View
    {
        // Buscar la evaluación con sus preguntas
        $evaluacion = Evaluacion::with(['preguntas', 'respuestas' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->findOrFail($evaluacionId);

        // Buscar el usuario que respondió la evaluación
        $usuario = User::findOrFail($userId);

        // Obtener las respuestas del usuario para esta evaluación
        $respuestas = $evaluacion->respuestas;

        // Pasar los datos a la vista
        return view('evaluaciones.respuestas', compact('evaluacion', 'usuario', 'respuestas'));
    }

    /**
     * Muestra los usuarios que han respondido a una evaluación específica.
     * Busca la evaluación y obtiene los usuarios que tienen respuestas asociadas.
     *
     * @param int $evaluacionId
     * @return View
     */
    public function verUsuarios(int $evaluacionId, Request $request): View
    {
        // Encuentra la evaluación por ID o devuelve un error 404
        $evaluacion = Evaluacion::findOrFail($evaluacionId);

        // Obtener los usuarios que respondieron a la evaluación de manera única con paginación
        $usuariosQueRespondieron = User::whereHas('respuestas', function ($query) use ($evaluacionId) {
            $query->where('evaluacion_id', $evaluacionId);
        })->distinct()->paginate(10); // Cambia 10 por el número deseado de elementos por página

        // Retornar la vista con los datos correctos
        return view('evaluaciones.ver_usuarios', compact('evaluacion', 'usuariosQueRespondieron'))
            ->with('i', ($request->input('page', 1) - 1) * $usuariosQueRespondieron->perPage());
    }


    /**
     * Muestra las respuestas de un usuario específico para una evaluación.
     * Busca la evaluación y las respuestas del usuario asociado.
     *
     * @param int $evaluacionId
     * @param int $userId
     * @return View
     */
    public function verRespuestasUsuario(int $evaluacionId, int $userId): View
    {
        // Obtener la evaluación y las respuestas del usuario
        $evaluacion = Evaluacion::with('respuestas')->findOrFail($evaluacionId);
        $usuario = User::findOrFail($userId);

        // Obtener las respuestas del usuario para la evaluación
        $respuestas = $evaluacion->respuestas()->where('user_id', $userId)->get();

        return view('evaluaciones.respuestas_usuario', compact('evaluacion', 'usuario', 'respuestas'));
    }

    public function graficos($evaluacion): View
    {
        // Obtener la evaluación específica
        $evaluacion = Evaluacion::with(['preguntas', 'respuestas'])->findOrFail($evaluacion);

        // Procesar los datos para el gráfico
        $data = [];

        foreach ($evaluacion->preguntas as $pregunta) {
            $sumaPuntajes = $evaluacion->respuestas()
                ->where('pregunta_id', $pregunta->id)
                ->sum('respuesta');

            $data[] = [
                'name' => $pregunta->texto,
                'y' => (int)$sumaPuntajes,
            ];
        }

        return view('evaluaciones.graficos', compact('data', 'evaluacion'));
    }
}
