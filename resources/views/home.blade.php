@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-green-900 to-blue-900 opacity-80"></div>
        <div class="relative z-10 text-center text-white px-4">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">Las mejores computadoras <span class="text-green-400">a los mejores precios</span></h1>
            <p class="text-xl md:text-3xl mb-8">Encuentra laptops, desktops y accesorios gaming de las mejores marcas</p>
            <a href="#categorias" class="bg-green-500 hover:bg-green-600 hover:shadow-neon px-10 py-5 rounded-lg text-2xl font-bold transition">Explorar Ahora</a>
        </div>
    </section>

    <!-- BENEFICIOS -->
    <section class="py-16 bg-gray-800">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 text-center text-white">
            <div class="beneficio">
                <i class="fas fa-truck text-6xl text-green-400 mb-4"></i>
                <h3 class="text-2xl font-bold">Envío Gratis</h3>
                <p>En compras mayores a S/.500</p>
            </div>
            <div class="beneficio">
                <i class="fas fa-shield-alt text-6xl text-green-400 mb-4"></i>
                <h3 class="text-2xl font-bold">Garantía</h3>
                <p>Hasta 3 años</p>
            </div>
            <div class="beneficio">
                <i class="fas fa-headset text-6xl text-green-400 mb-4"></i>
                <h3 class="text-2xl font-bold">Soporte 24/7</h3>
                <p>Asistencia técnica siempre</p>
            </div>
            <div class="beneficio">
                <i class="fas fa-credit-card text-6xl text-green-400 mb-4"></i>
                <h3 class="text-2xl font-bold">Financiamiento</h3>
                <p>Hasta 24 meses sin intereses</p>
            </div>
        </div>
    </section>

    <!-- CATEGORÍAS DINÁMICAS AGRUPADAS -->
    <section id="categorias" class="py-16">
        <h2 class="text-4xl font-bold text-center mb-12 text-green-400">Explora por Categorías</h2>
        
        @php
            // Cargar solo categorías visibles (no ocultas desde el admin)
            $categoriasVisibles = \App\Models\Categoria::where('oculta', false)->get();
            
            // Grupos principales con sus subcategorías (ajusta slugs si cambias nombres)
            $grupos = [
                'laptops' => [
                    'nombre' => 'Laptops',
                    'icono' => '💻',
                    'imagen' => 'https://media.officedepot.com/images/f_auto,q_auto,e_sharpen,h_450/products/7089358/7089358',
                    'categorias' => $categoriasVisibles->whereIn('slug', ['laptops-oficina', 'laptops-gaming'])
                ],
                'pcs' => [
                    'nombre' => 'PC de Escritorio',
                    'icono' => '🖥️',
                    'imagen' => 'https://geekawhat.com/wp-content/uploads/2022/11/Feature.jpg',
                    'categorias' => $categoriasVisibles->whereIn('slug', ['pcs-oficina', 'pcs-gaming'])
                ],
                'perifericos' => [
                    'nombre' => 'Periféricos Gaming',
                    'icono' => '🎮',
                    'imagen' => 'https://m.media-amazon.com/images/I/81lWNgidA3L._AC_UF894,1000_QL80_.jpg',
                    'categorias' => $categoriasVisibles->whereIn('slug', ['teclados-gaming', 'mouse-gaming', 'audifonos-gaming'])
                ],
                'accesorios' => [
                    'nombre' => 'Accesorios',
                    'icono' => '🔌',
                    'imagen' => 'https://cdn.thewirecutter.com/wp-content/media/2023/10/laptopstands-2048px-8263.jpg',
                    'categorias' => $categoriasVisibles->whereIn('slug', ['cables', 'adaptadores', 'mochilas', 'soportes'])
                ],
            ];
            
            // Filtrar grupos vacíos (si todas sus subcategorías están ocultas, no se muestra el bloque)
            $grupos = array_filter($grupos, fn($grupo) => $grupo['categorias']->isNotEmpty());
        @endphp

        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($grupos as $grupo)
                <div class="categoria-principal group relative rounded-xl overflow-hidden shadow-2xl hover:shadow-neon transition-all">
                    <img src="{{ $grupo['imagen'] }}" alt="{{ $grupo['nombre'] }}" class="w-full h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                    <div class="absolute bottom-0 p-8 text-white text-center w-full">
                        <div class="text-6xl mb-4">{{ $grupo['icono'] }}</div>
                        <h3 class="text-3xl font-bold">{{ $grupo['nombre'] }}</h3>
                        <ul class="mt-4 space-y-2">
                            @foreach($grupo['categorias'] as $cat)
                                <li>
                                    <a href="{{ route('categorias.show', $cat->slug) }}" class="hover:text-green-400 transition">
                                        {{ $cat->nombre }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-2xl text-gray-500">No hay categorías disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- PRODUCTOS DESTACADOS / OFERTAS -->
    <section class="py-16 bg-gray-800">
        <h2 class="text-4xl font-bold text-center mb-4 text-green-400">Productos en Oferta</h2>
        <p class="text-center text-xl mb-12 text-gray-300">Los mejores descuentos seleccionados para ti</p>

        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse(\App\Models\Producto::where('destacado', true)->take(8)->get() as $producto)
                <div class="tarjeta-producto relative bg-gray-900 rounded-xl shadow-xl hover:shadow-neon transition-all overflow-hidden">
                    <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-2 rounded-lg font-bold z-10">OFERTA</div>
                    
                    <!-- Imagen dinámica (placeholder si no tiene) -->
                    <img src="{{ $producto->imagen ?? 'https://via.placeholder.com/400x300?text=Oferta+Ctech' }}" 
                         alt="{{ $producto->nombre }}" 
                         class="w-full h-64 object-cover">

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 line-clamp-2">{{ $producto->nombre }}</h3>
                        <p class="text-green-400 text-3xl font-bold">
                            S/. {{ number_format($producto->precio * 0.9, 2) }} 
                            <span class="text-gray-500 line-through text-xl ml-2">S/. {{ number_format($producto->precio, 2) }}</span>
                        </p>
                        <p class="text-gray-400 text-sm mt-2">Stock: {{ $producto->stock }}</p>
                        
                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('productos.show', $producto->id) }}" 
                               class="flex-1 bg-gray-700 hover:bg-gray-600 text-center py-3 rounded-lg font-semibold transition">
                                Ver Detalle
                            </a>
                            <button class="flex-1 bg-green-500 hover:bg-green-600 py-3 rounded-lg font-bold transition">
                                Añadir al Carrito
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <i class="fas fa-tags text-8xl text-gray-600 mb-6"></i>
                    <p class="text-3xl text-gray-500 mb-4">Aún no hay productos en oferta</p>
                    <p class="text-xl text-gray-400">¡Vuelve pronto! Estamos preparando las mejores promociones para ti.</p>
                </div>
            @endforelse
        </div>

        @if(\App\Models\Producto::where('destacado', true)->count() > 8)
            <div class="text-center mt-12">
                <a href="#" class="bg-green-500 hover:bg-green-600 px-8 py-4 rounded-lg text-xl font-bold">Ver Más Ofertas</a>
            </div>
        @endif
    </section>

    <!-- NEWSLETTER -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-green-900">
        <div class="container mx-auto px-4 text-center text-white">
            <h2 class="text-4xl font-bold mb-4">¡Mantente Actualizado!</h2>
            <p class="text-xl mb-8">Recibe ofertas exclusivas y novedades gamer</p>
            <form class="max-w-md mx-auto flex">
                <input type="email" placeholder="Tu correo electrónico" class="px-6 py-4 rounded-l-lg w-full">
                <button type="submit" class="bg-green-500 hover:bg-green-600 px-8 py-4 rounded-r-lg font-bold">Suscribirme</button>
            </form>
        </div>
    </section>
@endsection