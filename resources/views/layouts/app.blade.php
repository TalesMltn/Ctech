<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ctech - Tu Tienda Gamer y de Oficina</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Estilos neón -->
    <style>
        .neon-glow {
            text-shadow: 0 0 10px rgba(0, 255, 100, 0.8),
                         0 0 20px rgba(0, 255, 100, 0.6),
                         0 0 30px rgba(0, 255, 100, 0.4);
        }
        .neon-glow-strong {
            box-shadow: 0 0 20px rgba(0, 255, 100, 0.8),
                        0 0 40px rgba(0, 255, 100, 0.6),
                        0 0 60px rgba(0, 255, 100, 0.4);
        }
        .hover\:neon-glow:hover {
            text-shadow: 0 0 15px rgba(0, 255, 200, 1),
                         0 0 30px rgba(0, 255, 200, 0.8);
            transition: all 0.3s ease;
        }
        @keyframes pulse-neon {
            0%, 100% { box-shadow: 0 0 10px rgba(0, 255, 100, 0.3); }
            50% { box-shadow: 0 0 30px rgba(0, 255, 100, 0.6); }
        }
        .animate-pulse-neon {
            animation: pulse-neon 4s infinite ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-gradient-to-r from-blue-950 via-blue-900 to-blue-950 text-white py-4 fixed w-full top-0 z-50 shadow-2xl animate-pulse-neon">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-4">
                <div class="bg-green-500 rounded-lg p-3 neon-glow-strong">
                    <i class="fas fa-microchip text-4xl text-white"></i>
                </div>
                <span class="text-4xl font-bold tracking-wide neon-glow">Ctech</span>
            </a>

            <!-- Menú central -->
            <nav class="hidden lg:flex items-center space-x-12 text-lg font-medium">
                <a href="{{ route('home') }}" class="hover:text-green-400 hover:neon-glow transition duration-200">Inicio</a>
                <a href="{{ route('producto.index') }}" class="hover:text-green-400 hover:neon-glow transition duration-200">Productos</a>
                <a href="{{ route('contacto') }}" class="hover:text-green-400 hover:neon-glow transition duration-200">Contacto</a>
                <a href="{{ route('servicio') }}" class="hover:text-green-400 hover:neon-glow transition duration-200">Servicio Técnico</a>
            </nav>

            <!-- Carrito y Login -->
            <div class="flex items-center space-x-6">
                <a href="#" class="flex items-center bg-gray-900 hover:bg-gray-800 px-6 py-3 rounded-lg transition shadow-inner">
                    <i class="fas fa-shopping-cart text-xl mr-3"></i>
                    <span class="font-semibold">Carrito (<span class="text-green-400 font-bold">0</span>)</span>
                </a>

                @auth('filament')
                    <a href="{{ url('/admin') }}" class="bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 hover:shadow-neon px-8 py-3 rounded-lg font-bold text-lg shadow-md transition transform hover:scale-105">
                        Panel Admin
                    </a>
                    <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="ml-4 bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-bold transition shadow-md">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 hover:shadow-neon px-8 py-3 rounded-lg font-bold text-lg shadow-md transition transform hover:scale-105">
                        Iniciar Sesión
                    </a>
                @endauth
            </div>

            <button class="lg:hidden text-3xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Espacio para navbar fijo -->
    <div class="pt-20"></div>

    <!-- Contenido -->
    <main class="flex-1 container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-black py-10 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; 2025 <span class="text-green-400 font-bold">Ctech</span> - Todos los derechos reservados</p>
            <p class="text-sm text-gray-500 mt-2">Laptops • PCs Gamer • Periféricos • Accesorios</p>
        </div>
    </footer>
</body>
</html>