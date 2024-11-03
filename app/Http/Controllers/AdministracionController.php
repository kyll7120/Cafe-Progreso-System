<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producto;
use App\Models\Insumo;
use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;


class AdministracionController extends Controller
{
    public function showCurrentUser()
    {
        $user = Auth::user();
        $role = $user->roles->pluck('name')->first(); // Asumiendo que el usuario tiene roles y utilizamos 'pluck' para obtener el nombre del primer rol.
        $date = Carbon::now()->format('d-m-Y');
        $time = Carbon::now()->format('h:i:s a');

        return view('home', compact('user', 'role', 'date', 'time'));
    }

    /**
     * Muestra el listado de los empleados.
     */
    public function listar_empleados(Request $request)
    {
        $usuarios = User::with('roles')->paginate(10); // Cambia 10 por el número deseado de elementos por página

        return view('administracion.index', compact('usuarios'))
            ->with('i', ($request->input('page', 1) - 1) * $usuarios->perPage());
    }


    //No se que hace
    public function administracion()
    {
        return view('administracion.administracion_view');
    }

    /**
     * Muestra el formulario para crear un nuevo empleado
     */
    public function cuentas()
    {
        return view('administracion.crearEmpleado');
    }

    /**
     * Guarda un empleado creado
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no puede tener más de 255 caracteres.',
            'fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
            'edad.min' => 'Debes tener al menos 18 años.',
            'sexo.required' => 'El campo sexo es obligatorio.',
            'sexo.string' => 'El sexo debe ser una cadena de texto.',
            'sexo.in' => 'El sexo debe ser Femenino o Masculino.',
            'dui.required' => 'El campo DUI es obligatorio.',
            'dui.string' => 'El DUI debe ser una cadena de texto.',
            'dui.unique' => 'El DUI ya está registrado.',
            'depto.required' => 'El campo departamento es obligatorio.',
            'depto.string' => 'El departamento debe ser una cadena de texto.',
            'municipio.required' => 'El campo municipio es obligatorio.',
            'municipio.string' => 'El municipio debe ser una cadena de texto.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.nullable' => 'El campo contraseña es opcional.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|in:Femenino,Masculino',
            'dui' => 'required|string|unique:users,dui',
            'depto' => 'required|string',
            'municipio' => 'required|string',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);

        $fechaNacimiento = Carbon::createFromFormat('d-m-Y', $request->fecha_nacimiento)->format('Y-m-d');
        $empleado = new User();
        $empleado->name = $request->name;
        $empleado->apellido = $request->apellido;
        $empleado->fecha_nacimiento = $fechaNacimiento;
        $empleado->edad = Carbon::parse($fechaNacimiento)->age;
        $empleado->sexo = $request->sexo;
        $empleado->dui = $request->dui;
        $empleado->direccion = $request->depto . ', ' . $request->municipio;
        $empleado->telefono = $request->telefono;
        $empleado->email = $request->email;
        $empleado->password = bcrypt($request->password);
        $empleado->save();

        return redirect()->route('listar_empleados')->with('success', 'Empleado registrado con éxito!');
    }

    /**
     * Muestra los detalles de un empleado.
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('administracion.verEmpleado', compact('usuario'));
    }

    /**
     * Muestra el formulario para editar un empleado.
     */
    public function updateView($id)
    {
        $usuario = User::findOrFail($id);
        $user = Auth::user();
        if (!$role = $user->roles->pluck('name')->first() == 'Propietario') {
            if ($usuario->roles->contains('name', 'Administrador') || $usuario->roles->contains('name', 'Propietario')) {
                return redirect()->route('listar_empleados')->with('error', 'No puedes editar a este usuario');
            } else {
                return view('administracion.editarEmpleado', compact('usuario'));
            }
        } else {
            if ($usuario->roles->contains('name', 'Own')) {
                return redirect()->route('listar_empleados')->with('error', 'No puedes editar un Propietario');
            }
            return view('administracion.editarEmpleado', compact('usuario'));
        }
    }

    /**
     * Actualiza un empleado en especifico
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $user = Auth::user();
        if ($usuario->roles->contains('name', 'Administrador') and !$user->roles->contains('name', 'Propietario')) {
            return redirect()->route('administracion')->with('error', 'No puedes editar un administrador');
        }
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no puede tener más de 255 caracteres.',
            'fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
            'sexo.required' => 'El campo sexo es obligatorio.',
            'sexo.string' => 'El sexo debe ser una cadena de texto.',
            'sexo.in' => 'El sexo debe ser Femenino o Masculino.',
            'dui.required' => 'El campo DUI es obligatorio.',
            'dui.string' => 'El DUI debe ser una cadena de texto.',
            'dui.unique' => 'El DUI ya está registrado.',
            'depto.required' => 'El campo departamento es obligatorio.',
            'depto.string' => 'El departamento debe ser una cadena de texto.',
            'municipio.required' => 'El campo municipio es obligatorio.',
            'municipio.string' => 'El municipio debe ser una cadena de texto.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.nullable' => 'El campo contraseña es opcional.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|in:Femenino,Masculino',
            'dui' => 'required|string|unique:users,dui,' . $usuario->id,
            'depto' => 'required|string',
            'municipio' => 'required|string',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
        ], $messages);

        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $fecha_nacimiento = \Carbon\Carbon::createFromFormat('d-m-Y', $request->fecha_nacimiento)->format('Y-m-d');
        $usuario->sexo = $request->sexo;
        $usuario->dui = $request->dui;
        $usuario->direccion = $request->depto . ', ' . $request->municipio;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return redirect()->route('listar_empleados')->with('success', 'Empleado editado con éxito!');
    }

    /**
     * Elimina un insumo en empleado
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $user = Auth::user();
        if (!$role = $user->roles->pluck('name')->first() == 'Own') {
            if ($usuario->roles->contains('name', 'Administrador') || $usuario->roles->contains('name', 'Propietario')) {
                return redirect()->route('listar_empleados')->with('error', 'No puedes eliminar a este usuario');
            }
        } else {
            if ($usuario->roles->contains('name', 'Propietario')) {
                return redirect()->route('listar_empleados')->with('error', 'No puedes eliminar un Propietario');
            }
        }
        $usuario->delete();
        return redirect()->route('listar_empleados')->with('success', 'Empleado eliminado con éxito!');
    }

    /**
     * Lista los productos que no son preparados y los insumos
     */
    public function listarProductosEInsumos()
    {
        // Obtener productos que no son preparados y paginarlos
        $productos = Producto::where('es_preparado', false)->paginate(10); // Cambia 10 por el número deseado de elementos por página
        $insumos = Insumo::paginate(10); // Paginación de insumos

        return view('administracion.noPreparados', compact('productos', 'insumos'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Ajuste para el número de la lista
    }

    /**
     * Actualiza las existencias de los productos no preparados y de los insumos
     */
    public function updateExistencias(Request $request)
    {
        // Actualizar existencias de productos
        if ($request->has('productos')) {
            foreach ($request->input('productos') as $id => $existencias) {
                $producto = Producto::findOrFail($id);
                $producto->existencias = $existencias;
                $producto->save();
            }
        }

        // Actualizar existencias de insumos
        if ($request->has('insumos')) {
            foreach ($request->input('insumos') as $id => $existencias) {
                $insumo = Insumo::findOrFail($id);
                $insumo->existencias = $existencias;
                $insumo->save();
            }
        }

        return redirect()->route('administracion.listarProductosEInsumos')->with('success', 'Existencias actualizadas con éxito!');
    }

    /**
     * Muestra el listado de los empleados.
     */
    public function asignarRol(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        if ($usuario->roles->contains('name', 'Own')) {
            return redirect()->back()->with('error', 'No se puede modificar el rol de un usuario con rol Own.');
        }
        return view('administracion.asignarRole', compact('usuario'));
    }

    public function asignacion(Request $request, $id)
    {
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $usuario = User::findOrFail($id);
        $rol = $request->rol;

        if ($usuario->roles->contains('name', 'Propietario')) {
            return redirect()->back()->with('error', 'No se puede modificar el rol de un usuario con rol Propietario.');
        }

        if ($rol == 'Empleado') {
            $usuario->roles()->detach();
        } elseif ($rol == 'Administrador') {
            $usuario->roles()->detach();
            $usuario->roles()->attach($adminRole);
        }

        $usuarios = User::with('roles')->paginate();

        return view('administracion.index', compact('usuarios'))
            ->with('i', ($request->input('page', 1) - 1) * $usuarios->perPage())
            ->with('success', 'Acción realizada con éxito');
    }
}
