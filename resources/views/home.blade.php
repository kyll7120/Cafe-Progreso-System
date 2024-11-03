@extends('layouts.plantilla')

@section('tituloPagina', 'Inicio')

@section('tituloSeccion', 'Inicio')

@section('tituloContenido', '')

@section('contenidoPagina')
    <header class="bg-principal w-full py-6 mb-6 shadow-lg">
        <h1 class="text-4xl text-white text-center font-bold">Cafe Progreso System</span></h1>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

        <!-- Tarjeta 1 Ventas-->
        <a href="" class="bg-white rounded-lg shadow-lg flex flex-col items-center">
            <div class="flex-grow flex flex-col items-center justify-center text-blue-500 p-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                    <path
                        d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                </svg>
            </div>
            <div class="bg-blue-100 w-full p-4 rounded-b-lg">
                <p class="text-gray-700 text-center"><strong>Ventas</strong></p>
            </div>
        </a>
        <!-- Tarjeta 2 Productos e Insumos-->
        <a href="" class="bg-white rounded-lg shadow-lg flex flex-col items-center">
            <div class="flex-grow flex flex-col items-center justify-center text-green-500 p-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                    <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                    <path
                        d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                    <path
                        d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                    <path
                        d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
                </svg>

            </div>
            <div class="bg-green-100 w-full p-4 rounded-b-lg">
                <p class="text-gray-700 text-center"><strong>Productos e Insumos</strong></p>
            </div>
        </a>
        <!-- Tarjeta 3 Descuentos -->
        <a href="" class="bg-white rounded-lg shadow-lg flex flex-col items-center">
            <div class="flex-grow flex flex-col items-center justify-center text-yellow-500 p-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                    <path
                        d="M9.375 3a1.875 1.875 0 0 0 0 3.75h1.875v4.5H3.375A1.875 1.875 0 0 1 1.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0 1 12 2.753a3.375 3.375 0 0 1 5.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 1 0-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3ZM11.25 12.75H3v6.75a2.25 2.25 0 0 0 2.25 2.25h6v-9ZM12.75 12.75v9h6.75a2.25 2.25 0 0 0 2.25-2.25v-6.75h-9Z" />
                </svg>

            </div>
            <div class="bg-yellow-100 w-full p-4 rounded-b-lg">
                <p class="text-gray-700 text-center"><strong>Descuentos</strong></p>
            </div>
        </a>
        <!-- Tarjeta 4 Usuarios -->
        <a href="" class="bg-white rounded-lg shadow-lg flex flex-col items-center">
            <div class="flex-grow flex flex-col items-center justify-center text-purple-500 p-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                    <path fill-rule="evenodd"
                        d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                        clip-rule="evenodd" />
                    <path
                        d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                </svg>

            </div>
            <div class="bg-purple-100 w-full p-4 rounded-b-lg">
                <p class="text-gray-700 text-center"><Strong>Usuarios</Strong></p>
            </div>
        </a>
        <!-- Tarjeta 5 Reportes -->
        <a href="" class="bg-white rounded-lg shadow-lg flex flex-col items-center">
            <div class="flex-grow flex flex-col items-center justify-center text-orange-500 p-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                    <path fill-rule="evenodd"
                        d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                        clip-rule="evenodd" />
                    <path fill-rule="evenodd"
                        d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>

            </div>
            <div class="bg-orange-100 w-full p-4 rounded-b-lg">
                <p class="text-gray-700 text-center"><strong>Reportes</strong></p>
            </div>
        </a>
        <!-- Tarjeta 6 Seguridad -->
        <a href="" class="bg-white rounded-lg shadow-lg flex flex-col items-center">
            <div class="flex-grow flex flex-col items-center justify-center text-red-500 p-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                    <path fill-rule="evenodd"
                        d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                        clip-rule="evenodd" />
                </svg>

            </div>
            <div class="bg-red-100 w-full p-4 rounded-b-lg">
                <p class="text-white-700 text-center"><Strong>Seguridad</Strong></p>
            </div>
        </a>
    </div>
    <br><br>
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xl">
        <div class="form-group mb-2 mb20">
            <strong>Nombre:</strong>
            {{ $user->name }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Rol:</strong>
            {{ $role }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Fecha Actual:</strong>
            {{ $date }}
        </div>
        <div class="form-group mb-2 mb20">
            <strong>Hora Actual:</strong>
            <span id="current-time">{{ $time }}</span>
        </div>        
    </div>
    <script>
        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var ampm = hours >= 12 ? 'pm' : 'am';
    
            // Convertir el formato de 24 horas a 12 horas
            hours = hours % 12;
            hours = hours ? hours : 12; // La hora '0' debe ser '12'
            
            // Agrega un cero delante de los números de un solo dígito
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;
    
            var formattedTime = hours + ":" + minutes + ":" + seconds + " " + ampm;
            document.getElementById('current-time').innerText = formattedTime;
        }
    
        // Llama a updateTime cada segundo
        setInterval(updateTime, 1000);
    </script>
    
    
    
@endsection()
