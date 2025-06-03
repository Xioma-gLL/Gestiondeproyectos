<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Gestión de Proyectos')</title>
    
    <!-- Tailwind CSS via CDN (temporal) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('clientes.index') }}" class="text-white text-xl font-bold">
                        Gestión Proyectos
                    </a>
                    <a href="{{ route('clientes.index') }}" class="text-white hover:text-blue-200">
                        Clientes
                    </a>
                    <a href="{{ route('proyectos.index') }}" class="text-white hover:text-blue-200">
                        Proyectos
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>