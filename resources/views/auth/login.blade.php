<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('logos2.png') }}" type="image/png" sizes="64x64">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('assets/img/fondo.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgba(0, 0, 0, 0.9); /* Color de fondo oscuro con transparencia */
        }

        /* Cambié el color de fondo del formulario a un gris oscuro */
        .login-container {
            background-color: rgba(0, 0, 0, 0.7); /* Color de fondo del contenedor */
            padding: 20px; /* Añadí espacio de relleno para separar del borde */
            border-radius: 10px; /* Bordes redondeados */
        }

        /* Cambié el color del texto y el enlace para mejor visibilidad */
        .text-light {
            color: rgba(255, 255, 255, 0.9); /* Color de texto claro */
        }

        .text-light:hover {
            color: rgba(255, 255, 255, 1); /* Cambio de color al pasar el mouse */
        }

        /* Añadí un estilo para el botón de iniciar sesión */
        .login-button {
            background-color: #374151; /* Color del botón */
        }

        .login-button:hover {
            background-color: #4b5563; /* Cambio de color al pasar el mouse */
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-black bg-opacity-75 shadow-md rounded-lg px-8 py-8 mb-4 text-white" style="box-shadow: 5px 5px 20px rgba(255, 255, 255, 0.842);">
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" class="mx-auto w-30 h-40 mb-4">
            <h1 class="text-2xl font-bold">Café Progreso System</h1>
        </div>

        <!-- Errores de validación y mensajes -->
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}" class="login-container">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold mb-2 text-light">Email</label>
                <input id="email" name="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" required autofocus autocomplete="username">
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold mb-2 text-light">Contraseña</label>
                <input id="password" name="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 mb-3 leading-tight focus:outline-none focus:shadow-outline" required autocomplete="current-password">
            </div>
            
            <!-- Botón iniciar sesión -->
            <div class="mb-6">
                <button type="submit" class="login-button hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Iniciar Sesión</button>
            </div>
        </div>
    </form>
</div>
</body>

</html>
