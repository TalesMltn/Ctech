<x-filament-panels::page>
    @if(!$authorized)
        <!-- PANTALLA DE CONTRASEÑA -->
        <div class="min-h-screen bg-gradient-to-b from-slate-950 to-black flex items-center justify-center py-16 px-4">
            <div class="max-w-md w-full">
                <div class="bg-gray-900 p-12 rounded-3xl shadow-2xl border border-green-900">
                    <div class="text-center mb-10">
                        <i class="fas fa-lock text-6xl text-green-500 mb-6"></i>
                        <h2 class="text-4xl font-bold text-green-400">Acceso Restringido</h2>
                        <p class="text-gray-400 mt-4 text-lg">Información sensible de pagos</p>
                    </div>

                    <div class="space-y-6">
                        <div class="relative">
                            <input
                                wire:model.live="master_password"
                                type="{{ $showPassword ? 'text' : 'password' }}"
                                placeholder="Contraseña maestra"
                                class="w-full p-5 bg-gray-800 border border-gray-700 rounded-xl text-white text-lg placeholder-gray-500 focus:border-green-500 focus:ring-4 focus:ring-green-500/30 transition"
                            />
                            <button
                                type="button"
                                wire:click="$toggle('showPassword')"
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-400 text-xl"
                            >
                                <i class="fas {{ $showPassword ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                            </button>
                        </div>

                        <button
                            wire:click="authorizeAccess"
                            wire:loading.attr="disabled"
                            class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white py-5 rounded-xl font-bold text-xl transition transform hover:scale-105 shadow-xl"
                        >
                            <span wire:loading.remove>Verificar Acceso</span>
                            <span wire:loading>Verificando...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- EDITOR DE QR -->
        <div class="min-h-screen bg-gradient-to-b from-slate-950 to-black py-12 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-5xl font-bold text-green-400 neon-glow">Editar QR del Dueño</h2>
                    <p class="text-gray-300 mt-4 text-xl">Configura los métodos de pago visibles para los clientes</p>
                </div>

                <div class="bg-gray-900 rounded-3xl shadow-2xl p-10 border border-gray-800">
                    <!-- Aquí renderizamos el formulario Filament directamente -->
                    {{ $this->form }}

                    <div class="flex flex-col sm:flex-row justify-center gap-8 mt-16">
                        <button
                            type="button"
                            wire:click="cancel"
                            class="px-16 py-6 bg-gray-700 hover:bg-gray-600 text-white rounded-xl font-bold text-2xl transition shadow-xl"
                        >
                            Cancelar
                        </button>

                        <button
                            type="button"
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="px-20 py-6 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white rounded-xl font-bold text-2xl transition shadow-2xl hover:shadow-green-500/50 transform hover:scale-105"
                        >
                            <span wire:loading.remove>Guardar Cambios</span>
                            <span wire:loading>Guardando...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .neon-glow {
            text-shadow: 0 0 20px #22c55e, 0 0 40px #22c55e;
        }
    </style>

    <!-- Font Awesome para el ojo de la contraseña -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</x-filament-panels::page>