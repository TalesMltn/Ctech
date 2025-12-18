@extends('layouts.app')

@section('content')
    <section class="py-0 bg-gray-900">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold text-green-400 mb-8">Servicio Técnico</h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-12">
                Reparamos laptops, PCs gaming, periféricos y más. Diagnóstico gratis y garantía en todas nuestras reparaciones.
            </p>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-gray-800 p-8 rounded-xl hover:shadow-neon transition">
                    <i class="fas fa-tools text-6xl text-green-400 mb-6"></i>
                    <h3 class="text-2xl font-bold text-white mb-4">Reparaciones</h3>
                    <p class="text-gray-300">Cambio de pantalla, teclado, batería, motherboard y más</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-xl hover:shadow-neon transition">
                    <i class="fas fa-microchip text-6xl text-green-400 mb-6"></i>
                    <h3 class="text-2xl font-bold text-white mb-4">Upgrades</h3>
                    <p class="text-gray-300">Mejora RAM, SSD, tarjeta gráfica para más rendimiento</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-xl hover:shadow-neon transition">
                    <i class="fas fa-headset text-6xl text-green-400 mb-6"></i>
                    <h3 class="text-2xl font-bold text-white mb-4">Soporte Remoto</h3>
                    <p class="text-gray-300">Asistencia rápida vía WhatsApp o TeamViewer</p>
                </div>
            </div>

            <div class="mt-16">
                <a href="https://wa.me/51999888777" target="_blank" class="bg-green-500 hover:bg-green-600 px-10 py-5 rounded-lg text-2xl font-bold inline-block">
                    <i class="fab fa-whatsapp mr-3"></i> Agendar Servicio por WhatsApp
                </a>
            </div>
        </div>
    </section>
@endsection