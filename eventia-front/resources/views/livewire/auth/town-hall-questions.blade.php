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
                    <p class="text-sm text-text-secondary">Portal para Ayuntamientos</p>
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
                            <label for="name" class="block text-sm font-medium text-text-main">Nombre del Ayuntamiento</label>
                            <input type="text" wire:model="name" id="name" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                placeholder="Ej: Ayto. de Madrid">
                        </div>

                        <!-- Profile Image Upload -->
                        <div class="space-y-1">
                            <label for="profileImg" class="block text-sm font-medium text-text-main">Cargar imagen de perfil</label>
                            <div class="flex items-center gap-4">
                                <label class="cursor-pointer bg-gray-50 border border-gray-200 hover:border-primary/50 hover:bg-primary/5 rounded-xl px-4 py-3 flex-1 transition-all text-sm text-text-secondary flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <span>Seleccionar imagen</span>
                                    <input type="file" wire:model="profileImg" id="profileImg" class="hidden" accept="image/*">
                                </label>
                                @if ($profileImg)
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden border border-gray-200">
                                        <img src="{{ $profileImg->temporaryUrl() }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="phone" class="block text-sm font-medium text-text-main">Teléfono de contacto</label>
                        <input type="tel" wire:model="phone" id="phone"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                            placeholder="600 000 000">
                    </div>

                    <!-- Location Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-text-main">Comunidad autónoma</label>
                            <div class="relative">
                                <input list="regions-list" wire:model.live="region" 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                    placeholder="Buscar...">
                                <datalist id="regions-list">
                                    @foreach(array_keys($regions_data) as $region_name)
                                        <option value="{{ $region_name }}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-text-main">Provincia</label>
                            <div class="relative">
                                <input list="provinces-list" wire:model.live="province" 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                    placeholder="Buscar...">
                                <datalist id="provinces-list">
                                    @foreach($this->provinces as $province_name)
                                        <option value="{{ $province_name }}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="town" class="block text-sm font-medium text-text-main">Localidad</label>
                        <input type="text" wire:model="town" id="town" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                            placeholder="Escribe tu ciudad o pueblo">
                    </div>
                </div>

                <!-- Section: Tipo de eventos -->
                <div class="space-y-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-secondary rounded-full"></div>
                        <h3 class="text-lg font-bold text-text-main">Tipo de eventos</h3>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-text-main">¿Qué tipos de eventos organizáis habitualmente?</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach(['Festivales', 'Ferias', 'Conciertos', 'Otro'] as $type)
                            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 cursor-pointer hover:bg-secondary/5 hover:border-secondary/30 transition-all">
                                <input type="checkbox" wire:model="eventTypes" value="{{ strtolower($type) }}" class="rounded border-gray-300 text-secondary focus:ring-secondary uppercase-none">
                                <span class="text-sm text-text-main font-medium">{{ $type }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-text-main">Frecuencia de eventos</label>
                        <select wire:model="frequency" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all cursor-pointer">
                            <option value="">Selecciona una</option>
                            <option value="ocasional">Ocasionalmente</option>
                            <option value="varias_año">Varias veces al año</option>
                            <option value="mensual">Mensualmente</option>
                            <option value="semanal">Semanalmente</option>
                        </select>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-text-main">¿En qué tipos de espacios suelen realizarse?</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach(['Plaza pública', 'Auditorio', 'Recinto cerrado', 'Parque', 'Estadio'] as $space)
                            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 cursor-pointer hover:bg-secondary/5 hover:border-secondary/30 transition-all">
                                <input type="checkbox" wire:model="spaces" value="{{ strtolower($space) }}" class="rounded border-gray-300 text-secondary focus:ring-secondary">
                                <span class="text-sm text-text-main font-medium">{{ $space }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Section: Accesibilidad -->
                <div class="space-y-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-accent rounded-full"></div>
                        <h3 class="text-lg font-bold text-text-main">Accesibilidad</h3>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-text-main">Incluir opciones de accesibilidad en los eventos:</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(['Entradas adaptadas', 'Transporte accesible', 'Zonas de descanso', 'Intérprete de signos'] as $opt)
                            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 cursor-pointer hover:bg-accent/5 hover:border-accent/30 transition-all">
                                <input type="checkbox" wire:model="accessibilityOptions" value="{{ strtolower($opt) }}" class="rounded border-gray-300 text-accent focus:ring-accent">
                                <span class="text-sm text-text-main font-medium">{{ $opt }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Section: Facturación -->
                <div class="space-y-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-primary rounded-full"></div>
                        <h3 class="text-lg font-bold text-text-main">Facturación y contratación</h3>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-text-main">¿Cómo preferís recibir facturas y contratos?</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div wire:click="$set('billingPreference', 'platform')" class="cursor-pointer flex items-center gap-3 p-4 rounded-xl border {{ $billingPreference === 'platform' ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-gray-100 bg-gray-50' }} transition-all">
                                <div class="w-4 h-4 rounded-full border-2 border-primary flex items-center justify-center">
                                    @if($billingPreference === 'platform') <div class="w-2 h-2 rounded-full bg-primary"></div> @endif
                                </div>
                                <span class="text-sm font-medium">Desde la plataforma</span>
                            </div>
                            <div wire:click="$set('billingPreference', 'email')" class="cursor-pointer flex items-center gap-3 p-4 rounded-xl border {{ $billingPreference === 'email' ? 'border-primary bg-primary/5 ring-1 ring-primary' : 'border-gray-100 bg-gray-50' }} transition-all">
                                <div class="w-4 h-4 rounded-full border-2 border-primary flex items-center justify-center">
                                    @if($billingPreference === 'email') <div class="w-2 h-2 rounded-full bg-primary"></div> @endif
                                </div>
                                <span class="text-sm font-medium">Por correo electrónico</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Recursos y logística -->
                <div class="space-y-6 pt-4 border-t border-gray-100 text-sm">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-secondary rounded-full"></div>
                        <h3 class="text-lg font-bold text-text-main">Recursos y logística</h3>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-text-main">¿Disponéis de infraestructura técnica propia?</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach(['Sonido', 'Iluminación', 'Escenario', 'Personal seguridad', 'Backstage'] as $infra)
                            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 cursor-pointer hover:bg-secondary/5 hover:border-secondary/30 transition-all">
                                <input type="checkbox" wire:model="technicalInfrastructure" value="{{ strtolower($infra) }}" class="rounded border-gray-300 text-secondary focus:ring-secondary">
                                <span class="text-sm text-text-main font-medium">{{ $infra }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-primary via-secondary to-accent hover:opacity-90 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-primary/30 flex items-center justify-center transform hover:-translate-y-0.5 mt-8">
                    Crear perfil de Ayuntamiento
                </button>
            </form>
        </div>
    </div>
</div>
