<div class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gradient-to-b from-background to-white py-12 px-4 sm:px-6 lg:px-8">
    <!-- Card -->
    <div class="w-full max-w-3xl bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 relative">
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary via-secondary to-accent"></div>
        
        <div class="p-8 sm:p-10">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                 <!-- Eventia Logo (Small) -->
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-secondary text-white font-bold text-2xl shadow-lg shadow-primary/30">
                    E
                </div>
                <div class="text-right">
                    <h2 class="text-2xl font-bold font-heading text-text-main tracking-tight">Personaliza tu perfil</h2>
                    <p class="text-sm text-text-secondary">Información para artistas y bandas</p>
                </div>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="submit" class="space-y-8">
                
                <!-- Section: Datos Básicos -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-primary rounded-full"></div>
                        <h3 class="text-lg font-bold text-text-main">Datos básicos</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="space-y-1">
                            <label for="name" class="block text-sm font-medium text-text-main">Nombre del artista/banda</label>
                            <input type="text" wire:model="name" id="name" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                placeholder="Ej: Los Rockeros">
                        </div>

                        <!-- Logo Upload -->
                        <div class="space-y-1">
                            <label for="logo" class="block text-sm font-medium text-text-main">Cargar logo de la banda</label>
                            <div class="flex items-center gap-4">
                                <label class="cursor-pointer bg-gray-50 border border-gray-200 hover:border-primary/50 hover:bg-primary/5 rounded-xl px-4 py-3 flex-1 transition-all text-sm text-text-secondary flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <span>Seleccionar imagen</span>
                                    <input type="file" wire:model="logo" id="logo" class="hidden" accept="image/*">
                                </label>
                                @if ($logo)
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden border border-gray-200">
                                        <img src="{{ $logo->temporaryUrl() }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-1">
                        <label for="description" class="block text-sm font-medium text-text-main">Descripción</label>
                        <textarea wire:model="description" id="description" rows="3"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all resize-none" 
                            placeholder="Cuéntanos un poco sobre tu trayectoria y estilo..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Type -->
                        <div class="space-y-1">
                            <label for="type" class="block text-sm font-medium text-text-main">¿Banda o Solista?</label>
                            <select wire:model.live="type" id="type"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all cursor-pointer">
                                <option value="solista">Solista</option>
                                <option value="banda">Banda / Grupo</option>
                            </select>
                        </div>

                        <!-- Genre -->
                        <div class="space-y-1">
                            <label for="genre" class="block text-sm font-medium text-text-main">Género musical</label>
                            <select wire:model="genre" id="genre"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all cursor-pointer">
                                <option value="">Selecciona uno</option>
                                <option value="rock">Rock</option>
                                <option value="pop">Pop</option>
                                <option value="reggaeton">Reggaeton</option>
                                <option value="metal">Metal</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Member Count -->
                        @if ($type === 'banda')
                        <div class="space-y-1">
                            <label for="memberCount" class="block text-sm font-medium text-text-main">Nº de integrantes</label>
                            <input type="number" wire:model="memberCount" id="memberCount" min="2"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        </div>
                        @else
                        <div class="hidden md:block"></div>
                        @endif

                        <!-- Phone -->
                        <div class="space-y-1">
                            <label for="phone" class="block text-sm font-medium text-text-main">Teléfono de contacto</label>
                            <input type="tel" wire:model="phone" id="phone"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                placeholder="600 000 000">
                        </div>

                        <!-- Price -->
                        <div class="space-y-1">
                            <label for="referencePrice" class="block text-sm font-medium text-text-main">Precio referencia (€)</label>
                            <input type="text" wire:model="referencePrice" id="referencePrice"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                placeholder="Ej: 500€/sesión">
                        </div>
                    </div>
                </div>

                <!-- Section: Logística -->
                <div class="space-y-6 pt-4">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-secondary rounded-full"></div>
                        <h3 class="text-lg font-bold text-text-main">Logística</h3>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white rounded-lg shadow-sm">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                </svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-text-main">Equipo técnico propio</span>
                                <span class="text-xs text-text-secondary">¿Dispones de sonido, luces, etc.?</span>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="hasTechnicalEquipment" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-secondary"></div>
                        </label>
                    </div>
                </div>

                <!-- Section: Facturación -->
                <div class="space-y-6 pt-4">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-accent rounded-full"></div>
                        <h3 class="text-lg font-bold text-text-main">Facturación y contratación</h3>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-text-main">¿Cómo prefieres recibir facturas y contratos?</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div wire:click="$set('billingPreference', 'platform')" class="cursor-pointer flex items-center gap-3 p-4 rounded-xl border {{ $billingPreference === 'platform' ? 'border-accent bg-accent/5 ring-1 ring-accent' : 'border-gray-100 bg-gray-50' }} transition-all">
                                <div class="w-4 h-4 rounded-full border-2 border-accent flex items-center justify-center">
                                    @if($billingPreference === 'platform') <div class="w-2 h-2 rounded-full bg-accent"></div> @endif
                                </div>
                                <span class="text-sm font-medium">Desde la plataforma</span>
                            </div>
                            <div wire:click="$set('billingPreference', 'email')" class="cursor-pointer flex items-center gap-3 p-4 rounded-xl border {{ $billingPreference === 'email' ? 'border-accent bg-accent/5 ring-1 ring-accent' : 'border-gray-100 bg-gray-50' }} transition-all">
                                <div class="w-4 h-4 rounded-full border-2 border-accent flex items-center justify-center">
                                    @if($billingPreference === 'email') <div class="w-2 h-2 rounded-full bg-accent"></div> @endif
                                </div>
                                <span class="text-sm font-medium">Por correo electrónico</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-primary via-secondary to-accent hover:opacity-90 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-primary/30 flex items-center justify-center transform hover:-translate-y-0.5">
                    Crear perfil de artista
                </button>
            </form>
        </div>
    </div>
</div>
