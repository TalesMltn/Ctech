@extends('layouts.app')

@section('content')
<!-- HERO SECTION ULTRA COMPACTO -->
<section class="relative h-80 flex items-center justify-center overflow-hidden"> <!-- h-96 → h-80 (320px altura) -->
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-green-900 to-blue-900 opacity-80"></div>
    
    <div class="relative z-10 text-center text-white px-4">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">Las mejores computadoras <span class="text-green-400">a los mejores precios</span></h1>
        <p class="text-base md:text-xl mb-6">Encuentra laptops, desktops y accesorios gaming de las mejores marcas</p>
        <a href="#categorias" class="bg-green-500 hover:bg-green-600 hover:shadow-neon px-7 py-3 rounded-lg text-lg font-bold transition transform hover:scale-105">
            Explorar Ahora
        </a>
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

    <!-- CATEGORÍAS 100% DINÁMICAS DESDE LA BASE DE DATOS -->
    <section id="categorias" class="py-16">
        <h2 class="text-4xl font-bold text-center mb-12 text-green-400">Explora por Categorías</h2>
        
        @php
            // Cargar grupos principales ordenados por 'orden' descendente y solo los no ocultos
            $gruposPrincipales = \App\Models\GrupoCategoria::where('oculta', false)
                ->orderByDesc('orden')
                ->get();

            // Cargar subcategorías visibles, con su grupo y ordenadas
            $subcategorias = \App\Models\Categoria::where('oculta', false)
                ->with('grupoCategoria')
                ->orderByDesc('orden')
                ->get();
        @endphp

        @if($gruposPrincipales->isNotEmpty())
            <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @foreach($gruposPrincipales as $grupo)
                    @php
                        $subsDelGrupo = $subcategorias->where('grupo_categoria_id', $grupo->id);
                    @endphp

                    @if($subsDelGrupo->isNotEmpty())
                        <div class="categoria-principal group relative rounded-xl overflow-hidden shadow-2xl hover:shadow-neon transition-all">
                            <img src="{{ $grupo->imagen ? asset('storage/' . $grupo->imagen) : 'https://via.placeholder.com/1200x800?text=' . urlencode($grupo->nombre) }}" 
                                 alt="{{ $grupo->nombre }}" 
                                 class="w-full h-96 object-cover">

                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                            
                            <div class="absolute bottom-0 p-8 text-white text-center w-full">
                                <div class="text-5xl mb-4">
                                    <x-dynamic-component 
                                        :component="$grupo->icono ?? 'heroicon-o-cpu-chip'" 
                                        class="w-32 h-32 text-blue-400 mx-auto" 
                                    />
                                </div>
                                <h3 class="text-3xl font-bold">{{ $grupo->nombre }}</h3>
                                <ul class="mt-4 space-y-2">
                                    @foreach($subsDelGrupo as $sub)
                                        <li>
                                            <a href="{{ route('categorias.show', $sub->slug) }}" class="hover:text-green-400 transition">
                                                {{ $sub->nombre }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-2xl text-gray-500">No hay categorías disponibles en este momento.</p>
            </div>
        @endif
    </section>

    <!-- PRODUCTOS EN OFERTA - COMPACTA -->
<section class="py-10 bg-gray-800">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-green-400 mb-3">Productos en Oferta</h2>
        <p class="text-center text-lg text-gray-300 mb-8">Los mejores descuentos seleccionados para ti</p>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse(\App\Models\Producto::where('destacado', true)->take(8)->get() as $producto)
                <div class="bg-gray-900 rounded-xl shadow-xl hover:shadow-neon transition-all overflow-hidden">
                    <div class="absolute top-3 left-3 bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm font-bold z-10">OFERTA</div>
                    
                    <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://via.placeholder.com/400x300?text=' . urlencode($producto->nombre) }}" 
     alt="{{ $producto->nombre }}" 
     class="w-full h-56 object-cover">

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-2 line-clamp-2">{{ $producto->nombre }}</h3>
                        <p class="text-green-400 text-2xl font-bold mb-1">
                            S/. {{ number_format($producto->precio * 0.9, 2) }} 
                            <span class="text-gray-500 line-through text-base ml-2">S/. {{ number_format($producto->precio, 2) }}</span>
                        </p>
                        <p class="text-gray-400 text-xs mb-4">Stock: {{ $producto->stock }}</p>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('productos.show', $producto->id) }}" 
                               class="flex-1 bg-gray-700 hover:bg-gray-600 text-center py-2.5 rounded-lg text-sm font-semibold transition">
                                Ver Detalle
                            </a>
                            <button class="flex-1 bg-green-500 hover:bg-green-600 py-2.5 rounded-lg text-sm font-bold transition">
                                Añadir al Carrito
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-tags text-6xl text-gray-600 mb-4"></i>
                    <p class="text-2xl text-gray-500 mb-2">Aún no hay productos en oferta</p>
                    <p class="text-base text-gray-400">¡Vuelve pronto! Estamos preparando las mejores promociones para ti.</p>
                </div>
            @endforelse
        </div>

        @if(\App\Models\Producto::where('destacado', true)->count() > 8)
            <div class="text-center mt-8">
                <a href="#" class="bg-green-500 hover:bg-green-600 px-6 py-3 rounded-lg text-lg font-bold transition">
                    Ver Más Ofertas
                </a>
            </div>
        @endif
    </div>
</section>

<!-- NEWSLETTER COMPACTA -->
<section class="py-10 bg-gradient-to-r from-blue-900 to-green-900">
    <div class="container mx-auto px-4 text-center text-white">
        <h2 class="text-4xl font-bold mb-2">¡Mantente Actualizado!</h2>
        <p class="text-lg mb-6">Recibe ofertas exclusivas y novedades gamer</p>

        <form class="max-w-sm mx-auto flex flex-col sm:flex-row gap-0 shadow-lg rounded-lg overflow-hidden">
            <input 
                type="email" 
                placeholder="Tu correo electrónico" 
                required
                class="px-6 py-4 bg-white text-gray-800 focus:outline-none w-full"
            >
            <button 
                type="submit" 
                class="bg-green-500 hover:bg-green-600 px-8 py-4 font-bold text-lg transition"
            >
                Suscribirme
            </button>
        </form>
    </div>
</section>
@endsection