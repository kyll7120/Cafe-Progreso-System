<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assignRole(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Buscar el usuario y el rol correspondientes en la base de datos
        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        // Asignar el rol al usuario
        $user->roles()->attach($role);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }

    public function asistencia()
    {
        return $this->hasMany(Asistencia::class);
    }
    
}
