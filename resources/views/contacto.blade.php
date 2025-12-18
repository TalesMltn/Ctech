@extends('layouts.app')

@section('content')
    <section class="pt-4 pb-2 bg-gray-900">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-center text-green-400 mb-8">Contáctanos</h1>

            <div class="max-w-sm mx-auto"> <!-- Más estrecho para que quepa todo -->
                <div class="bg-gray-800 p-4 rounded-2xl shadow-2xl" x-data="contactForm()">
                    <h2 class="text-xl md:text-2xl font-bold text-white text-center mb-3">Envíanos tu consulta</h2>

                    <!-- Mensaje de éxito compacto -->
                    <div x-show="success" 
                         x-transition 
                         x-cloak
                         class="mb-3 p-2 bg-green-900 border border-green-600 rounded-lg text-center text-green-300 text-xs font-medium">
                        ¡Consulta enviada! Pronto nos pondremos en contacto.
                    </div>

                    <!-- Formulario ultra compacto -->
                    <form x-on:submit.prevent="submit()">
                        <input 
                            x-model="form.name"
                            type="text" 
                            placeholder="Tu nombre" 
                            required
                            class="w-full p-2.5 mb-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 transition text-sm"
                        >

                        <input 
                            x-model="form.email"
                            type="email" 
                            placeholder="Tu correo" 
                            required
                            class="w-full p-2.5 mb-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 transition text-sm"
                        >

                        <select 
                            x-model="form.motivo"
                            required
                            class="w-full p-2.5 mb-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 transition text-sm"
                        >
                            <option value="" disabled selected>Motivo de la consulta</option>
                            <option value="consulta-general">1. Consulta general</option>
                            <option value="info-productos">2. Información sobre productos</option>
                            <option value="estado-pedido">3. Estado de pedido</option>
                            <option value="problemas-pedido">4. Problemas con un pedido</option>
                            <option value="devoluciones">5. Devoluciones o garantías</option>
                            <option value="facturacion">6. Facturación y pagos</option>
                        </select>

                        <textarea 
                            x-model="form.message"
                            placeholder="Tu mensaje detallado..." 
                            rows="4" 
                            required
                            class="w-full p-2.5 mb-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 transition resize-none text-sm"
                        ></textarea>

                        <button 
                            type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 hover:shadow-neon py-3 rounded-lg font-bold text-base transition transform hover:scale-105"
                        >
                            Enviar Consulta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function contactForm() {
            return {
                success: false,
                form: {
                    name: '',
                    email: '',
                    motivo: '',
                    message: ''
                },
                submit() {
                    this.success = true;
                    
                    // Limpiar formulario
                    this.form = {
                        name: '',
                        email: '',
                        motivo: '',
                        message: ''
                    };

                    setTimeout(() => {
                        this.success = false;
                    }, 5000);
                }
            }
        }
    </script>
@endsection