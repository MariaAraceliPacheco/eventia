<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Profile Header -->
    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100/50 p-8 mb-10 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-3xl shadow-lg shadow-primary/20 text-white">
                👤
            </div>
            <div>
                <h2 class="text-3xl font-black text-text-main font-heading">{{ auth()->user()->name }}</h2>
                <p class="text-text-secondary font-medium">Panel de Usuario • {{ $publico->localidad ?? 'Sin ubicación' }}</p>
            </div>
        </div>
        <button wire:click="editProfile" class="px-6 py-3 bg-gray-50 text-text-secondary font-bold rounded-xl border border-gray-100 hover:bg-gray-100 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            Editar Perfil
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        
        <!-- Left Column: Info Eventos -->
        <div class="space-y-6">
            <div class="bg-white rounded-[32px] shadow-sm border border-gray-100/50 overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-text-main font-heading">Explorar Eventos</h3>
                    <div class="h-1.5 w-16 bg-primary rounded-full"></div>
                </div>
                
                <div class="p-8 space-y-6">
                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" wire:model.live="searchEvent" 
                            class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                            placeholder="¿Qué quieres vivir hoy?">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Featured Events List -->
                    <div class="space-y-4 h-[550px] overflow-y-auto pr-3 custom-scrollbar">
                        @foreach(['Festival de Verano 2026', 'Concierto Acústico: Indie Night', 'Feria de Tecnología & Ocio', 'Metal Bash: Open Air', 'Gastro-Fest: Sabores del Mundo'] as $index => $event)
                        <a href="{{ route('public.event-detail', ['id' => $index + 1]) }}" class="block group relative bg-gray-50 rounded-2xl p-5 border border-transparent hover:border-primary/30 hover:bg-white hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 cursor-pointer overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-150"></div>
                            
                            <div class="flex items-center gap-5 relative">
                                <div class="w-16 h-16 rounded-xl bg-white shadow-sm flex items-center justify-center text-2xl group-hover:rotate-12 transition-transform">
                                    🎟️
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-base font-bold text-text-main group-hover:text-primary transition-colors">{{ $event }}</h4>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-xs text-text-secondary flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            15 Ago
                                        </span>
                                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                        <span class="text-xs text-text-secondary flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            Madrid
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-black text-primary">Desde 25€</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Mis Entradas -->
        <div class="space-y-8">
            <div class="bg-white rounded-[32px] shadow-sm border border-gray-100/50 p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-text-main font-heading">Mis Entradas</h3>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase">Ticket Pass</span>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Compradas -->
                    <div>
                        <h4 class="text-sm font-bold text-text-secondary uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                            Compradas
                        </h4>
                        <div class="space-y-3 max-h-[220px] overflow-y-auto pr-2 custom-scrollbar">
                            <div class="p-4 bg-gray-50 border border-gray-100 rounded-2xl flex items-center justify-between group hover:bg-white hover:shadow-md transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-xl shadow-sm italic font-bold text-primary">E</div>
                                    <div>
                                        <h5 class="text-sm font-bold text-text-main">Feria de Abril 2026</h5>
                                        <p class="text-[11px] text-text-secondary">Vip Pass • ID: 29384-X</p>
                                    </div>
                                </div>
                                <button class="text-primary hover:text-secondary transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- En el carrito -->
                    <div class="pt-6 border-t border-gray-50">
                        <h4 class="text-sm font-bold text-text-secondary uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 bg-accent rounded-full"></span>
                            En el carrito
                        </h4>
                        <div class="space-y-3 max-h-[220px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach(['Rock Night' => 'R1', 'Tour Museos' => 'T1'] as $label => $id)
                            <div class="p-4 {{ in_array($id, $selectedTickets) ? 'bg-primary/5 border-primary shadow-md' : 'bg-accent/5 border-accent/10' }} border rounded-2xl flex items-center justify-between transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-xl shadow-sm">🛒</div>
                                    <div>
                                        <h5 class="text-sm font-bold text-text-main">{{ $label }}</h5>
                                        <p class="text-[11px] {{ in_array($id, $selectedTickets) ? 'text-primary' : 'text-accent' }}">{{ in_array($id, $selectedTickets) ? 'Seleccionada' : 'Pendiente de pago' }}</p>
                                    </div>
                                </div>
                                <button wire:click="toggleSelection('{{ $id }}')" class="p-1 px-3 {{ in_array($id, $selectedTickets) ? 'bg-primary' : 'bg-accent' }} text-white text-[10px] font-bold rounded-lg hover:opacity-90 transition-all">
                                    {{ in_array($id, $selectedTickets) ? 'Deseleccionar' : 'Seleccionar' }}
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Final Button -->
                <button 
                    wire:click="goToPurchase" 
                    @if(count($selectedTickets) === 0) disabled @endif
                    class="w-full mt-10 inline-flex items-center justify-center gap-3 {{ count($selectedTickets) > 0 ? 'bg-gradient-to-r from-primary via-secondary to-accent shadow-primary/20 hover:shadow-primary/40' : 'bg-gray-200 cursor-not-allowed opacity-50' }} text-white font-bold py-5 rounded-2xl shadow-xl transition-all transform {{ count($selectedTickets) > 0 ? 'hover:-translate-y-1' : '' }} group">
                    <span>Ir a Comprar Entradas</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #d1d5db;
    }
    </style>

    <!-- Edit Profile Modal -->
    @if($showProfileModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Trick to center contents -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel, show/hide based on modal state. -->
            <div class="inline-block align-middle bg-white rounded-[32px] text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10 overflow-hidden border border-gray-100">
                <div class="bg-white px-8 pt-8 pb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-black text-text-main font-heading" id="modal-title">Editar Perfil</h3>
                        <button wire:click="cancelEdit" class="text-gray-400 hover:text-gray-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="space-y-6">
                        <!-- Comunidad Autónoma -->
                        <div>
                            <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Comunidad Autónoma</label>
                            <select wire:model.live="comunidad_autonoma" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option value="">Selecciona una comunidad</option>
                                @foreach(array_keys($regions_data) as $region)
                                    <option value="{{ $region }}">{{ $region }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Provincia -->
                        <div>
                            <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Provincia</label>
                            <select wire:model.live="provincia" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option value="">Selecciona una provincia</option>
                                @foreach($this->provinces as $prov)
                                    <option value="{{ $prov }}">{{ $prov }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Localidad -->
                        <div>
                            <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Localidad</label>
                            <input type="text" wire:model="localidad" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Ej: Madrid">
                        </div>

                        <!-- Gustos Musicales -->
                        <div>
                            <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Gustos Musicales</label>
                            <select wire:model="gustos_musicales" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option value="">¿Qué música te gusta?</option>
                                @foreach(\App\Models\Publico::GUSTOS_MUSICALES as $gusto)
                                    <option value="{{ $gusto }}">{{ ucfirst($gusto) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de Eventos -->
                        <div>
                            <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Tipo de Eventos Favoritos</label>
                            <select wire:model="tipo_eventos_favoritos" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option value="">¿A qué eventos sueles ir?</option>
                                @foreach(\App\Models\Publico::TIPO_EVENTOS_FAVORITOS as $tipo)
                                    <option value="{{ $tipo }}">{{ ucfirst($tipo) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Notificaciones -->
                        <div class="flex items-center gap-3 bg-primary/5 p-4 rounded-2xl border border-primary/10">
                            <input type="checkbox" wire:model="notificaciones" class="w-5 h-5 text-primary rounded border-gray-300 focus:ring-primary">
                            <label class="text-sm font-bold text-text-main">Recibir notificaciones de eventos similares</label>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-8 py-6 flex flex-col md:flex-row gap-3">
                    <button wire:click="saveProfile" class="flex-1 bg-primary text-white font-black py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Guardar Cambios</button>
                    <button wire:click="cancelEdit" class="flex-1 bg-white text-text-secondary font-bold py-4 rounded-2xl border border-gray-200 hover:bg-gray-100 transition-all">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
