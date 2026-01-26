<div class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gradient-to-b from-background to-white py-12 px-4 sm:px-6 lg:px-8">
    <!-- Card -->
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 relative">
        
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
                    <p class="text-sm text-text-secondary">Queremos conocerte mejor</p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-bold text-text-main mb-2">Preferencias</h3>
                <div class="h-1 w-12 bg-primary rounded-full"></div>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="submit" class="space-y-6">
                <!-- Name -->
                <div class="space-y-1">
                    <label for="name" class="block text-sm font-medium text-text-main">Nombre</label>
                    <input type="text" wire:model="name" id="name" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                        placeholder="¿Cómo te llamas?">
                </div>

                <!-- Music Preferences -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-text-main">Preferencias musicales</label>
                    <div class="relative">
                        <select wire:model="musicPreferences" multiple
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all appearance-none cursor-pointer h-32">
                            <option value="pop">Pop</option>
                            <option value="rock">Rock</option>
                            <option value="reggaeton">Reggaeton</option>
                            <option value="metal">Metal</option>
                        </select>
                        <p class="mt-1 text-xs text-text-secondary">Mantén pulsado Ctrl (o Cmd) para seleccionar varios</p>
                    </div>
                </div>

                <!-- Event Types -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-text-main">Tipo de eventos preferidos</label>
                    <select wire:model="eventTypes" multiple
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all appearance-none cursor-pointer h-32">
                        <option value="festivales">Festivales</option>
                        <option value="ferias">Ferias</option>
                        <option value="conciertos">Conciertos</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <!-- Location Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-text-main">Comunidad autónoma</label>
                        <div class="relative">
                            <input list="regions-list" wire:model.live="region" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                placeholder="Escribe para buscar...">
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
                                placeholder="Escribe para buscar...">
                            <datalist id="provinces-list">
                                @foreach($this->provinces as $province_name)
                                    <option value="{{ $province_name }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                <!-- Locality -->
                <div class="space-y-1">
                    <label for="town" class="block text-sm font-medium text-text-main">Localidad</label>
                    <input type="text" wire:model="town" id="town" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                        placeholder="Tu ciudad o pueblo">
                </div>

                <!-- Alerts Toggle -->
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-main">Recibir alertas</span>
                            <span class="text-xs text-text-secondary">Te avisaremos de eventos que te interesen</span>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="wantsAlerts" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-primary/30 hover:shadow-primary/40 flex items-center justify-center transform hover:-translate-y-0.5">
                    Crear perfil
                </button>
            </form>
        </div>
    </div>
</div>
