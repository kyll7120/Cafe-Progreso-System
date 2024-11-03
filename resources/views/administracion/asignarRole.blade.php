@extends('layouts.plantilla')

@section('tituloPagina', 'Asignación de rol')

@section('tituloSeccion', 'Roles')

@section('tituloContenido', 'Asignar roles')

@section('contenidoPagina')
    <div class="max-w-xl mx-auto mt-8 p-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Asignar rol a {{ $usuario->name }}</h2>

        <form action="{{ route('roles.asignar', $usuario->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="rol" class="block text-sm font-medium text-gray-700 mb-2">
                    Rol actual:
                    @if ($usuario->roles->isEmpty())
                        <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                            Empleado
                        </span>
                    @else
                        @foreach ($usuario->roles as $role)
                            <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold {{ $role->name === 'Propietario' ? 'text-white bg-yellow-300' : 'bg-gray-200 text-blue-700' }} mr-2">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    @endif
                </label>
                
                <select name="rol" id="rol" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="Empleado" {{ $usuario->roles->isEmpty() || $role->name == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                    <option value="Administrador" {{ !$usuario->roles->isEmpty() && $role->name == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200">
                    Asignar Rol
                </button>
            </div>
        </form>
    </div>
@endsection
