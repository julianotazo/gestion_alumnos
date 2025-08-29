<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logoUTN.png" sizes="2">
    <title>Gestor de Alumnos</title>
    {{-- Tipografía Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class="min-h-screen flex flex-col justify-between">

        {{-- Header --}}
        <header class="flex flex-col items-center text-center min-h-[70vh] px-4 justify-center space-y-6">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo TiendApp" class="h-40">

            <h1 class="text-3xl md:text-5xl font-bold" style="color: #2b7fff;">
                Gestión de Alumnos
            </h1>
            <p class="text-lg md:text-xl max-w-2xl">
                Bienvenido a la plataforma de registros de Programación IV, un espacio pensado para facilitar la
                organización, el seguimiento y la gestión de los estudiantes en la cursada.
            </p>

            {{-- Botón centrado con márgenes automáticos --}}
            <div class="flex justify-center">
                <a href="{{ route('login') }}"
                    class="bg-[#2b7fff] hover:bg-[#0065ff] transition-colors text-white px-8 py-4 rounded-xl text-lg shadow-md mt-5">
                    Comenzar ahora
                </a>
            </div>
        </header>



        {{-- Footer --}}
        <footer class="text-center text-sm text-gray-600 dark:text-gray-400 py-6">
            © {{ date('Y') }} Programacion IV - Gestion de Alumnos
        </footer>

    </div>

</body>

</html>