<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-xl font-bold">Mi Aplicación</a>
                <ul class="flex gap-6">
                    <li><a href="/" class="hover:text-gray-300">Inicio</a></li>
                    <li><a href="{{ route('tags.create') }}" class="hover:text-gray-300">Crear Tag</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white text-center py-4 mt-12">
        <p>&copy; 2026 Mi Aplicación. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
