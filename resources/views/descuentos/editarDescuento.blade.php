@extends('layouts.plantilla')

@section('tituloPagina', 'Edición de descuento')

@section('tituloSeccion', 'Descuento')

@section('tituloContenido', 'Edición de descuento')

@section('contenidoPagina')

    <!--Formulario-->
    <form id="registroForm" action="{{ route('descuentos.update', $descuento->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="pb-4">
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--Nombre descuento-->
                <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Nombre:</p>
                    <div class="mt-2 ">
                        <input type="text" name="nombre" id="nombre" placeholder="Descuento de navidad"
                            value="{{ $descuento->nombre }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required>
                    </div>
                </div>

                 <!--Porcentaje del descuento-->
                 <div class="sm:col-span-3">
                    <p id="texto" for="first-name">Porcentaje del descuento:</p>
                    <div class="mt-2">
                        <input type="number" name="porcentaje" id="porcentaje" step="0.0" min="0.00"
                            max="100" value="{{ $descuento->porcentaje * 100 }}"
                            class="block w-full rounded-md border-1 py-1.5 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            required step="any">
                    </div>
                </div>

                <!--Productos-->
                <div class="sm:col-span-6">
                    <p id="texto" for="productos">Productos:</p>
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach ($productos as $producto)
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="productos[]" value="{{ $producto->id }}"
                                        class="form-checkbox h-5 w-5 text-indigo-600"
                                        {{ $descuento->productos->contains($producto->id) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $producto->nombre }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--Botones Guardar y Regresar-->
        <div>
            <div class="grid grid-cols-1 gap-x-10 gap-y-4 sm:grid-cols-9">
                <!--button agregar descuento-->
                <div class="sm:col-span-3">
                    <div class="">
                        <button type="submit"
                            class="mt-5 rounded-md bg-agregar w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-sky-900 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Actualizar</button>
                    </div>
                </div>

                <!-- Botón regresar-->
                <div class="sm:col-span-3">
                    <div class="">
                        <a href="{{ route('descuentos.index') }}">
                            <button id="enviarDatosClientes" type="button"
                                class="mt-5 rounded-md bg-gray-500 w-full py-2 text-medium font-lato text-fondo font-medium shadow-sm hover:bg-gray-700 hover:font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Regresar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Script para aumentar o disminuir las existencias con el scroll del mouse-->
    <script>
        // Obtener el input
        var inputNumber = document.getElementById('porcentaje');

        // Escuchar el evento 'wheel' para detectar el scroll del mouse
        inputNumber.addEventListener('wheel', function(event) {
            // Verificar si se está haciendo scroll hacia arriba o hacia abajo
            var delta = Math.sign(event.deltaY);

            // Incrementar o decrementar el valor del input según el scroll
            if (delta > 0) {
                inputNumber.stepDown();
            } else {
                inputNumber.stepUp();
            }

            // Prevenir el comportamiento por defecto del scroll
            event.preventDefault();
        });
    </script>

    <!--Script para validar que No se escriban "-" en el precio unitario-->
    <script>
        // Evento 'keydown' para prevenir la entrada del carácter '-'
        document.getElementById('porcentaje').addEventListener('keydown', function(e) {
            if (e.key === '-') {
                e.preventDefault();
            }
        });
    </script>
@endsection
