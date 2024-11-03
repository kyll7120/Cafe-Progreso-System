@extends('layouts.plantilla')

@section('tituloPagina', 'Empleados')

@section('tituloSeccion', 'Empleados')

@section('tituloContenido', 'Lista de empleados')

@section('contenidoPagina')

    <!--Boton de registrar y volver al inicio-->
    <div class="mt-5 pb-2">
        <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9 ">
            <!--button agregar empleado-->
            <div class="sm:col-span-3">
                <a href="{{ route('registrar_empleado') }}"
                    class="rounded-md w-full bg-agregar text-medium font-lato shadow-sm hover:bg-sky-900 hover:font-semibold text-fondo font-medium py-2 px-4 mb-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 flex justify-center items-center">Registrar
                    empleado</a>
            </div>
            <!--boton regresar-->
            <div class="sm:col-span-3">
                <a href="{{ route('home') }}">
                    <button id="enviarDatosClientes" type="button"
                        class="rounded-md w-full bg-gray-500 py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Ir
                        al inicio</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <table class="border-collapse w-full">
        <!--Encabezado de tabla-->
        <thead>
            <tr>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    N°</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Nombre</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Apellido</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Email</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Rol</th>
                <th class="p-2 font-bold  bg-gray-200 text-principal font-lato border border-gray-300 hidden lg:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <!--Contenido de la tabla-->
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr
                    class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <!--Numero-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">N°</span>
                        {{ ++$i }}
                    </td>
                    <!--Nombre-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Nombre</span>
                        {{ $usuario->name }}
                    </td>
                    <!--Apellido-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Apellido</span>
                        {{ $usuario->apellido }}
                    </td>

                    <!--Email-->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Email</span>
                        {{ $usuario->email }}
                    </td>
                    <!-- Rol -->
                    <td
                        class="w-full lg:w-auto p-2 text-principal text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Rol</span>
                        @if ($usuario->roles->isEmpty())
                            <span
                                class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Empleado</span>
                        @else
                            @foreach ($usuario->roles as $role)
                                <span
                                    class="inline-block rounded-full px-3 py-1 text-sm font-semibold {{ $role->name === 'Propietario' ? 'text-white bg-yellow-300' : ' bg-gray-200 text-blue-700' }} mr-2">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        @endif
                    </td>


                    <!--Acciones-->
                    <td
                        class="text-center w-full lg:w-auto p-2 border border-b block lg:table-cell relative lg:static whitespace-nowrap">
                        <!--Opcion de ver detalles-->
                        <a class="btn btn-show " href="{{ route('usuario.show', $usuario->id) }}"><i
                                class="fa fa-fw fa-eye"></i>Detalles</a>
                        <!--Opcion de Asignar rol-->
                        @can('Propietario')
                            @if (!$usuario->roles->contains('name', 'Propietario'))
                                <a class="btn btn-light bg-yellow-300 text-white"
                                    href="{{ route('usuario.asignarRol', ['id' => $usuario->id]) }}">
                                    <i class="fa fa-fw fa-edit bg-yellow-300"></i>Asignar rol</a>
                            @endif
                        @endcan
                        @if (auth()->user()->hasRole('Propietario'))
                            @if (!$usuario->roles->contains('name', 'Propietario'))
                                <!--Opcion de editar-->
                                <a class="btn btn-edit" href="{{ route('usuario.updateView', ['id' => $usuario->id]) }}">
                                    <i class="fa fa-fw fa-edit"></i>Editar</a>

                                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <!--Boton de eliminar-->
                                    <button type="submit" class="btn btn-delete"
                                        onclick="return confirm('¿Seguro de que desea eliminar este empleado?')"><i
                                            class="fa fa-fw fa-trash mx"></i>Eliminar</button>
                                </form>
                            @endif
                        @else
                            @if (!$usuario->roles->contains('name', 'Administrador') && !$usuario->roles->contains('name', 'Propietario'))
                                <!--Opcion de editar-->
                                <a class="btn btn-edit" href="{{ route('usuario.updateView', ['id' => $usuario->id]) }}">
                                    <i class="fa fa-fw fa-edit"></i>Editar</a>

                                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <!--Boton de eliminar-->
                                    <button type="submit" class="btn btn-delete"
                                        onclick="return confirm('¿Seguro de que desea eliminar este empleado?')"><i
                                            class="fa fa-fw fa-trash mx"></i>Eliminar</button>
                                </form>
                            @endif
                        @endif
                        <span
                            class="lg:hidden absolute top-0 left-0 bg-gray-300 px-2 py-1 text-xs font-bold">Acciones</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación de Empleados -->
    <div class="mt-4 flex justify-between items-center">
        <div>
            {{-- Mostrar el texto de paginación --}}
            Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} empleados
        </div>

        <div class="flex space-x-2">
            {{-- Botón para ir a la primera página --}}
            @if ($usuarios->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Primera</span>
            @else
                <a href="{{ $usuarios->url(1) }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Primera</a>
            @endif

            {{-- Botón anterior --}}
            @if ($usuarios->onFirstPage())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Anterior</span>
            @else
                <a href="{{ $usuarios->previousPageUrl() }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Anterior</a>
            @endif

            {{-- Botón siguiente --}}
            @if ($usuarios->hasMorePages())
                <a href="{{ $usuarios->nextPageUrl() }}" class="bg-blue-500 text-white py-1 px-2 rounded-md">Siguiente</a>
            @else
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Siguiente</span>
            @endif

            {{-- Botón para ir a la última página --}}
            @if (!$usuarios->hasMorePages())
                <span class="disabled bg-gray-300 text-gray-600 py-1 px-2 rounded-md">Última</span>
            @else
                <a href="{{ $usuarios->url($usuarios->lastPage()) }}"
                    class="bg-blue-500 text-white py-1 px-2 rounded-md">Última</a>
            @endif
        </div>
    </div>

@endsection
