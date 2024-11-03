@extends('layouts.plantilla')

@section('tituloPagina', 'No Disponible')

@section('tituloSeccion', 'Opción no disponible')

@section('tituloContenido', 'Esta opción no está disponible')

@section('contenidoPagina')
    <div class="container mx-auto text-center mt-10">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Ups!</strong>
            <span class="block sm:inline">Esta opción no está disponible actualmente. Estará disponible en el siguiente sprint.</span>
        </div>
    </div>
@endsection
