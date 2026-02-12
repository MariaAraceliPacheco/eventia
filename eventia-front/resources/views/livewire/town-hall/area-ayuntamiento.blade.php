<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: Info Artistas -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-text-main">Info Artistas</h3>
                    <div class="h-1 w-12 bg-primary rounded-full"></div>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Search Artist -->
                    <div class="relative">
                        <input type="text" wire:model.live="searchArtist"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all"
                            placeholder="Explorar artistas...">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Artists List (Real Data) -->
                    <div class="space-y-3 h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($artistas as $artista)
                            <a href="{{ route('public.artist-profile', ['id' => $artista->id]) }}"
                                class="group flex items-center gap-4 p-3 rounded-2xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all cursor-pointer">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                    @if($artista->img_logo)
                                        <img src="{{ asset('storage/' . $artista->img_logo) }}" alt="{{ $artista->nombre_artistico }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-primary font-bold text-xl">{{ substr($artista->nombre_artistico, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-text-main group-hover:text-primary transition-colors">
                                        {{ $artista->nombre_artistico }}
                                    </h4>
                                    <p class="text-xs text-text-secondary">{{ $artista->genero_musical }}</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-primary transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @empty
                            <div class="text-center py-10 text-gray-400 text-sm">
                                No se encontraron artistas.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle/Right Column: Perfil + Eventos -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Perfil Ayuntamiento -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16"></div>

                <div class="flex flex-col md:flex-row gap-6 items-start md:items-center relative">
                    <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary to-secondary p-1">
                        <div class="w-full h-full rounded-[14px] bg-white flex items-center justify-center text-3xl">
                            <img src="{{ asset('storage/' . $ayuntamiento->imagen) }}" alt="{{ $ayuntamiento->nombre_institucion }}">
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <h2 class="text-2xl font-bold text-text-main">{{ $ayuntamiento->nombre_institucion }}</h2>
                            <button
                                class="text-xs font-medium px-2 py-1 bg-gray-100 text-text-secondary rounded-lg hover:bg-gray-200 transition">Editar</button>
                        </div>
                        <div class="flex items-center gap-6 mt-5">
                            <div class="flex flex-col">
                                <span
                                    class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Comunidad
                                    autonoma:</span>
                                <span
                                    class="text-xl font-bold text-text-main">{{ $ayuntamiento->comunidad_autonoma }}</span>
                            </div>
                            <div class="h-8 w-px bg-gray-200"></div>
                            <div class="flex flex-col">
                                <span
                                    class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Provincia:</span>
                                <span class="text-xl font-bold text-text-main">{{ $ayuntamiento->provincia }}</span>
                            </div>
                            <div class="h-8 w-px bg-gray-200"></div>
                            <div class="flex flex-col">
                                <span
                                    class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Localidad:</span>
                                <span class="text-xl font-bold text-text-main">{{ $ayuntamiento->localidad }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Eventos Creados -->
                <div class="mt-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-text-main">Eventos creados anteriormente</h3>
                        <span class="text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full">3
                            activos</span>
                    </div>

                    <div class="space-y-3">
                        @forelse($eventos as $evento)
                            <div
                                class="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-2xl hover:bg-white hover:shadow-md transition-all group">
                                <a href="{{ route('public.event-detail', ['id' => $evento->id]) }}"
                                    class="flex items-center gap-4 flex-1">
                                    <div class="w-2 h-8 bg-secondary rounded-full"></div>
                                    <div>
                                        <h4
                                            class="text-sm font-bold text-text-main group-hover:text-primary transition-colors">
                                            {{ $evento->nombre_evento }}
                                        </h4>
                                        <p class="text-xs text-text-secondary">{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} • {{ $evento->localidad }}</p>
                                    </div>
                                </a>
                                <div class="flex gap-2">
                                    <button wire:click="editEvent({{ $evento->id }})"
                                        class="p-2 text-text-secondary hover:text-primary transition-colors bg-white rounded-lg shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="deleteEvent({{ $evento->id }})"
                                        wire:confirm="¿Estás seguro de que quieres eliminar este evento?"
                                        class="p-2 text-text-secondary hover:text-red-500 transition-colors bg-white rounded-lg shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-500">
                                No tienes eventos creados aún.
                            </div>
                        @endforelse
                    </div>

                    <button wire:click="createEvent"
                        class="w-full mt-6 bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 rounded-2xl shadow-lg shadow-primary/20 hover:shadow-primary/30 transition-all transform hover:-translate-y-1">
                        + Crear nuevo evento
                    </button>
                </div>
            </div>

            <!-- Bottom Section: Premium & Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Estadísticas -->
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100/50 p-6 flex flex-col items-center text-center group hover:border-accent/30 transition-all">
                    <div
                        class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center text-accent mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-text-main">Estadísticas</h4>
                    <p class="text-xs text-text-secondary mt-1">Impacto de tus eventos en tiempo real</p>
                    <div
                        class="mt-4 px-4 py-1.5 bg-accent/5 text-accent text-[10px] font-bold rounded-full uppercase tracking-wider">
                        Premium</div>
                </div>

                <!-- Panel Ayuntamiento -->
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100/50 p-6 flex flex-col items-center text-center group hover:border-primary/30 transition-all">
                    <div
                        class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-text-main">Panel de Gestión</h4>
                    <p class="text-xs text-text-secondary mt-1">Configuración avanzada del ayuntamiento</p>
                    <div
                        class="mt-4 px-4 py-1.5 bg-primary/5 text-primary text-[10px] font-bold rounded-full uppercase tracking-wider">
                        Ayuntamiento</div>
                </div>
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

    <!-- Edit Event Modal -->
    @if($showEditModal)
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[30px] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8 space-y-6">
                <!-- Modal Header -->
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-text-main font-heading">Editar Evento</h3>
                        <p class="text-sm text-text-secondary mt-1">Modifica los detalles del evento</p>
                    </div>
                    <button wire:click="cancelEdit" class="p-2 hover:bg-gray-100 rounded-xl transition-colors">
                        <svg class="w-6 h-6 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Form Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-text-main mb-2">Nombre del Evento</label>
                        <input wire:model="editEventName" type="text"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Fecha</label>
                            <input wire:model="editEventDate" type="date"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Ubicación</label>
                            <input wire:model="editEventLocation" type="text"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-text-main mb-2">Descripción</label>
                        <textarea wire:model="editEventDescription" rows="4"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all resize-none"></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-4">
                    <button wire:click="cancelEdit"
                        class="flex-1 px-6 py-3 bg-gray-100 text-text-main font-bold rounded-xl hover:bg-gray-200 transition-colors">
                        Cancelar
                    </button>
                    <button wire:click="saveEvent"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/30 transition-all">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>