<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ctech - Tu Tienda Gamer y de Oficina</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Alpine.js para el carousel y efectos interactivos -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Estilos personalizados (glow neón) - MANTENIDOS -->
    <style>
        .shadow-neon {
            box-shadow: 0 0 20px 5px rgba(0, 255, 100, 0.6);
        }
        .hover\:shadow-neon:hover {
            box-shadow: 0 0 30px 10px rgba(0, 255, 100, 0.8);
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <!-- Navbar Nuevo - Estilo limpio como TecMerch + Efectos Neón -->
    <header class="bg-gradient-to-r from-blue-700 via-blue-800 to-blue-900 text-white py-4 fixed w-full top-0 z-50 shadow-lg">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <!-- Logo a la izquierda con glow neón -->
            <a href="{{ route('home') }}" class="flex items-center space-x-4">
                <div class="bg-green-500 rounded-lg p-3 shadow-neon">
                    <i class="fas fa-microchip text-3xl"></i>
                </div>
                <span class="text-3xl font-bold tracking-wide">Ctech</span>
            </a>

            <!-- Menú central simple -->
            <nav class="hidden lg:flex items-center space-x-12 text-lg font-medium">
                <a href="{{ route('home') }}" class="hover:text-green-400 transition duration-200">Inicio</a>
                <a href="#" class="hover:text-green-400 transition duration-200">Productos</a>
                <a href="#" class="hover:text-green-400 transition duration-200">Contacto</a>
                <a href="#" class="hover:text-green-400 transition duration-200">Servicio Técnico</a>
            </nav>

            <!-- Carrito y Login a la derecha -->
            <div class="flex items-center space-x-6">
                <!-- Carrito con fondo oscuro -->
                <a href="#" class="flex items-center bg-gray-900 hover:bg-gray-800 px-6 py-3 rounded-lg transition shadow-inner">
                    <i class="fas fa-shopping-cart text-xl mr-3"></i>
                    <span class="font-semibold">Carrito (<span class="text-green-400 font-bold">0</span>)</span>
                </a>

                <!-- Botón Iniciar Sesión verde con glow neón al hover -->
                <a href="#" class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 hover:shadow-neon px-8 py-3 rounded-lg font-bold text-lg shadow-md transition transform hover:scale-105">
                    Iniciar Sesión
                </a>
            </div>

            <!-- Botón menú móvil (futuro) -->
            <button class="lg:hidden text-3xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Espacio para que el contenido no quede debajo del navbar fijo -->
    <div class="pt-20"></div>

    <!-- Contenido principal -->
    <main class="flex-1 container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer limpio -->
    <footer class="bg-gradient-to-r from-gray-900 to-black py-10 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; 2025 <span class="text-green-400 font-bold">Ctech</span> - Todos los derechos reservados</p>
            <p class="text-sm text-gray-500 mt-2">Laptops • PCs Gamer • Periféricos • Accesorios</p>
        </div>
    </footer>
</body>
</html>