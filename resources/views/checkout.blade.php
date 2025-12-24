@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-5xl font-bold text-center text-green-400 mb-12 neon-glow">
            Finalizar Compra
        </h1>

        <div class="max-w-4xl mx-auto bg-gray-800 rounded-xl shadow-2xl p-8">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-8"
                  action="{{ route('checkout.process') }}"
                  method="POST">
                @csrf

                <!-- ================= DATOS CLIENTE ================= -->
                <div class="space-y-6">
                    <!-- Nombre completo -->
                    <div>
                        <label class="block text-lg font-bold text-gray-300 mb-2">
                            Nombre completo
                        </label>
                        <input type="text"
                               name="name"
                               placeholder="Ej: Andrew Reyes"
                               required
                               pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                               title="Solo letras y espacios"
                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                               class="w-full p-4 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-green-500 transition">
                    </div>

                    <!-- Correo electrónico -->
                    <div>
                        <label class="block text-lg font-bold text-gray-300 mb-2">
                            Correo electrónico
                        </label>
                        <div class="flex items-center gap-2">
                            <input id="email_user"
                                   type="text"
                                   placeholder="andrew_rko56"
                                   required
                                   class="flex-1 p-4 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-green-500 transition">
                            <span class="text-white text-xl">@</span>
                            <select id="email_domain"
                                    required
                                    class="p-4 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-green-500 transition">
                                <option value="" disabled selected>Dominio</option>
                                <option value="gmail.com">gmail.com</option>
                                <option value="hotmail.com">hotmail.com</option>
                                <option value="outlook.com">outlook.com</option>
                                <option value="yahoo.com">yahoo.com</option>
                                <option value="live.com">live.com</option>
                                <option value="icloud.com">icloud.com</option>
                                <option value="proton.me">proton.me</option>
                            </select>
                        </div>
                        <input type="hidden" name="email" id="email">
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label class="block text-lg font-bold text-gray-300 mb-2">
                            Teléfono
                        </label>
                        <input type="tel"
                               name="phone"
                               placeholder="999 999 999"
                               required
                               pattern="[0-9]{9}"
                               maxlength="9"
                               minlength="9"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               class="w-full p-4 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-green-500 transition">
                    </div>
                </div>

                <!-- ================= MÉTODO DE PAGO + QR ================= -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-lg font-bold text-gray-300 mb-2">
                            Método de pago
                        </label>
                        <select id="payment_method"
                                name="payment_method"
                                required
                                class="w-full p-4 bg-gray-900 border border-gray-700 rounded-lg text-white focus:outline-none focus:border-green-500 transition">
                            <option value="" disabled selected>Selecciona un método</option>
                            <option value="card">Tarjeta</option>
                            <option value="yape">Yape</option>
                            <option value="plin">Plin</option>
                            <option value="transfer">Transferencia</option>
                        </select>
                    </div>

                    <!-- Bloque QR dinámico -->
                    <div id="qr-box" class="hidden text-center p-8 bg-gradient-to-b from-gray-900 to-black rounded-xl border-4 border-dashed border-green-600 shadow-2xl">
                        <p id="qr-title" class="text-3xl font-bold text-green-400 mb-8"></p>

                        <!-- Imagen QR dinámica -->
                        <div id="qr-image-container" class="hidden">
                            <img id="qr-image"
                                 src=""
                                 alt="QR de pago"
                                 class="w-80 h-80 mx-auto mb-8 object-contain rounded-xl shadow-neon-strong">
                        </div>

                        <div class="space-y-4">
                            <p class="text-2xl text-gray-300">
                                <strong class="text-green-400">Número:</strong>
                                <span id="pay-phone" class="font-bold text-green-400 text-3xl"></span>
                            </p>
                            <p class="text-2xl text-gray-300">
                                <strong class="text-green-400">Titular:</strong>
                                <span id="pay-owner" class="font-bold text-green-400 text-2xl"></span>
                            </p>
                        </div>
                        <small class="block mt-8 text-gray-400 text-lg">
                            Escanea el QR o paga al número indicado
                        </small>
                    </div>
                </div>

                <!-- Botón confirmar -->
                <div class="md:col-span-2 text-center mt-16">
                    <button type="submit"
                            class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white px-24 py-8 rounded-2xl font-bold text-4xl transition shadow-2xl hover:shadow-green-500/80 transform hover:scale-110 neon-glow-strong">
                        Confirmar Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Carga los datos desde config.json -->
    @php
        $configPath = storage_path('app/pagos/config.json');
        $paymentData = file_exists($configPath)
            ? json_decode(file_get_contents($configPath), true)
            : [
                'qr_yape'     => 'qr-yape.png',
                'phone_yape'  => '927573591',
                'owner_yape'  => 'Tech Merch SAC',
                'qr_plin'     => 'qr-plin.png',
                'phone_plin'  => '927573591',
                'owner_plin'  => 'Tech Merch SAC'
            ];
    @endphp

    <!-- JavaScript corregido y optimizado -->
    <script>
        const paymentData = @json($paymentData);

        // Elementos del DOM
        const paymentSelect     = document.getElementById('payment_method');
        const qrBox             = document.getElementById('qr-box');
        const qrTitle           = document.getElementById('qr-title');
        const payPhone          = document.getElementById('pay-phone');
        const payOwner          = document.getElementById('pay-owner');
        const qrImageContainer  = document.getElementById('qr-image-container');
        const qrImage           = document.getElementById('qr-image');

        const emailUser         = document.getElementById('email_user');
        const emailDomain       = document.getElementById('email_domain');
        const emailHidden       = document.getElementById('email');

        // Actualizar campo email oculto
        function updateEmail() {
            const user   = emailUser.value.trim();
            const domain = emailDomain.value;
            emailHidden.value = user && domain ? `${user}@${domain}` : '';
        }

        emailUser.addEventListener('input', updateEmail);
        emailDomain.addEventListener('change', updateEmail);

        // Cambio en método de pago
        paymentSelect.addEventListener('change', function () {
            const method = this.value;

            if (method === 'yape' || method === 'plin') {
                // Mostrar caja completa
                qrBox.classList.remove('hidden');

                // Título
                qrTitle.textContent = method === 'yape' ? 'Paga con YAPE' : 'Paga con PLIN';

                // Datos de pago
                const phone = paymentData['phone_' + method] || 'No configurado';
                const owner = paymentData['owner_' + method] || 'No configurado';

                payPhone.textContent = phone;
                payOwner.textContent = owner;

                // QR dinámico
                const qrFile = paymentData['qr_' + method];
                if (qrFile) {
                    qrImage.src = `/storage/pagos/qr/${qrFile}?t=${Date.now()}`;
                    qrImageContainer.classList.remove('hidden');
                } else {
                    qrImageContainer.classList.add('hidden');
                }
            } else {
                // Ocultar todo si no es Yape o Plin
                qrBox.classList.add('hidden');
                qrImageContainer.classList.add('hidden');
            }
        });
    </script>

    <!-- Estilos adicionales -->
    <style>
        .neon-glow {
            text-shadow: 0 0 10px #22c55e, 0 0 20px #22c55e;
        }
        .neon-glow-strong {
            box-shadow: 0 0 30px #22c55e, 0 0 60px #22c55e;
        }
    </style>
@endsection