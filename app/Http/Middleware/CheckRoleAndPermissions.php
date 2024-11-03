<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleAndPermissions
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(Auth::id());
        
        if ($user && $user->hasRole('Administrador')) {
            // El usuario tiene el rol de Administrador, permitir acceso
            return $next($request);
        }
        if ($user && $user->hasRole('Propietario')) {
            // El usuario tiene el rol de Propietario, permitir el acceso
            return $next($request);
        }

        // Si el usuario no tiene el rol adecuado, redirigir o mostrar un error
        return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta página.');
    }

}

