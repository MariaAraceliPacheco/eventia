<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: Solicitudes + Info Artistas -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Pending Requests -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-amber-50/30">
                    <h3 class="text-xl font-bold text-text-main flex items-center gap-2">
                        Solicitudes
                        @if($solicitudes->count() > 0)
                            <span class="flex h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                        @endif
                    </h3>
                    <span class="text-xs font-bold text-amber-600 bg-amber-100 px-2 py-1 rounded-lg">
                        {{ $solicitudes->count() }} pendientes
                    </span>
                </div>
                <div class="p-6 space-y-4 max-h-[400px] overflow-y-auto custom-scrollbar">
                    @forelse($solicitudes as $solicitud)
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center overflow-hidden">
                                    @if($solicitud->artista->img_logo)
                                        <img src="{{ asset('profiles/artistas/' . $solicitud->artista->img_logo) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-primary font-bold">{{ substr($solicitud->artista->nombre_artistico, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-text-main truncate">{{ $solicitud->artista->nombre_artistico }}</h4>
                                    <p class="text-[10px] text-text-secondary truncate">Para: <b>{{ $solicitud->evento->nombre_evento }}</b></p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="aceptarSolicitud({{ $solicitud->id }})" 
                                    class="flex-1 py-2 bg-green-500 text-white text-xs font-bold rounded-xl hover:bg-green-600 transition-colors">
                                    Aceptar
                                </button>
                                <button wire:click="rechazarSolicitud({{ $solicitud->id }})" 
                                    class="flex-1 py-2 bg-white text-gray-400 text-xs font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors">
                                    Rechazar
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400 text-sm italic">
                            No hay solicitudes pendientes en este momento.
                        </div>
                    @endforelse
                </div>
            </div>

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
                                <div
                                    class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                    @if($artista->img_logo)
                                        <img src="{{ asset('profiles/artistas/' . $artista->img_logo) }}"
                                            alt="{{ $artista->nombre_artistico }}" class="w-full h-full object-cover">
                                    @else
                                        <span
                                            class="text-primary font-bold text-xl">{{ substr($artista->nombre_artistico, 0, 1) }}</span>
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
                            @if($ayuntamiento->imagen)
                                <img src="{{ asset('profiles/ayuntamientos/' . $ayuntamiento->imagen) }}"
                                    alt="{{ $ayuntamiento->nombre_institucion }}"
                                    class="w-full h-full object-cover rounded-[14px]">
                            @else
                                <span class="text-4xl">🏛️</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <h2 class="text-2xl font-bold text-text-main">{{ $ayuntamiento->nombre_institucion }}</h2>
                            <button wire:click="editProfile"
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
                                        <p class="text-xs text-text-secondary">
                                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} •
                                            {{ $evento->localidad }}</p>
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


    <!-- Edit Profile Modal -->
    @if($showProfileModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Backdrop -->

                <!-- Trick to center contents -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Panel -->
                <div
                    class="inline-block align-middle bg-white rounded-[32px] text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10 overflow-hidden border border-gray-100">
                    <div class="bg-white px-8 pt-8 pb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-black text-text-main font-heading" id="modal-title">Editar Perfil de
                                Ayuntamiento</h3>
                            <button wire:click="cancelProfileEdit"
                                class="text-gray-400 hover:text-gray-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre Institución -->
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Nombre
                                    de la Institución</label>
                                <input type="text" wire:model="nombre_institucion"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>

                            <!-- Imagen -->
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Imagen
                                    / Escudo</label>
                                <div class="flex items-center gap-4">
                                    @if($editImagen)
                                        <img src="{{ $editImagen->temporaryUrl() }}"
                                            class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                                    @else
                                        <img src="{{ asset('profiles/ayuntamientos/' . $ayuntamiento->imagen) }}"
                                            class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                                    @endif
                                    <input type="file" wire:model="editImagen"
                                        class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all">
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Teléfono</label>
                                <input type="text" wire:model="telefono"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>

                            <!-- Comunidad Autónoma -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Comunidad
                                    Autónoma</label>
                                <select wire:model.live="comunidad_autonoma"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                    <option value="">Selecciona una comunidad</option>
                                    @foreach(array_keys($regions_data) as $region)
                                        <option value="{{ $region }}">{{ $region }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Provincia -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Provincia</label>
                                <select wire:model.live="provincia"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                    <option value="">Selecciona una provincia</option>
                                    @foreach($this->provinces as $prov)
                                        <option value="{{ $prov }}">{{ $prov }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Localidad -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Localidad</label>
                                <input type="text" wire:model="localidad"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>

                            <!-- Tipo Evento -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Tipo
                                    de Eventos</label>
                                <input type="text" wire:model="tipo_evento"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>

                            <!-- Frecuencia -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Frecuencia</label>
                                <input type="text" wire:model="frecuencia"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>

                            <!-- Tipo Espacio -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Tipo
                                    de Espacio</label>
                                <input type="text" wire:model="tipo_espacio"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>

                            <!-- Accesibilidad -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Accesibilidad</label>
                                <input type="text" wire:model="opciones_accesibilidad"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>

                            <!-- Facturación -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Facturación</label>
                                <select wire:model="tipo_facturacion"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                    <option value="plataforma">Plataforma</option>
                                    <option value="externo">Externo</option>
                                </select>
                            </div>

                            <!-- Logística -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Logística
                                    Propia</label>
                                <input type="text" wire:model="logistica_propia"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-6 flex flex-col md:flex-row gap-3">
                        <button wire:click="saveProfile"
                            class="flex-1 bg-primary text-white font-black py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Guardar
                            Cambios</button>
                        <button wire:click="cancelProfileEdit"
                            class="flex-1 bg-white text-text-secondary font-bold py-4 rounded-2xl border border-gray-200 hover:bg-gray-100 transition-all">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>