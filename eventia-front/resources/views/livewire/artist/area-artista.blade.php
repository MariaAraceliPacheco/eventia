<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: Invitaciones + Info Eventos -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Pending Invitations -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-primary/5">
                    <h3 class="text-xl font-bold text-text-main flex items-center gap-2">
                        Invitaciones
                        @if($invitaciones->count() > 0)
                            <span class="flex h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                        @endif
                    </h3>
                    <span class="text-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded-lg">
                        {{ $invitaciones->count() }} nuevas
                    </span>
                </div>
                <div class="p-6 space-y-4 max-h-[400px] overflow-y-auto custom-scrollbar">
                    @forelse($invitaciones as $invitacion)
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-xl">
                                    🏛️
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-text-main truncate">{{ $invitacion->evento->ayuntamiento->nombre_institucion }}</h4>
                                    <p class="text-[10px] text-text-secondary truncate">Te invita a: <b>{{ $invitacion->evento->nombre_evento }}</b></p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="aceptarInvitacion({{ $invitacion->id }})" 
                                    class="flex-1 py-2 bg-primary text-white text-xs font-bold rounded-xl hover:bg-primary-dark transition-colors shadow-sm">
                                    Aceptar
                                </button>
                                <button wire:click="rechazarInvitacion({{ $invitacion->id }})" 
                                    class="flex-1 py-2 bg-white text-gray-400 text-xs font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors">
                                    Rechazar
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400 text-sm italic">
                            No tienes invitaciones pendientes.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-text-main font-heading">Info Eventos</h3>
                    <div class="h-1 w-12 bg-secondary rounded-full"></div>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Search Event -->
                    <div class="relative">
                        <input type="text" wire:model.live="searchEvent"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary focus:bg-white outline-none transition-all"
                            placeholder="Explorar eventos...">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Events List (Real Data) -->
                    <div class="space-y-3 h-[450px] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($eventos as $evento)
                            <a href="{{ route('public.event-detail', ['id' => $evento->id]) }}"
                                class="group flex items-center gap-4 p-4 rounded-2xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all cursor-pointer">
                                <div
                                    class="w-14 h-14 rounded-xl bg-gradient-to-br from-secondary/10 to-accent/10 flex items-center justify-center text-secondary font-bold overflow-hidden">
                                    <span class="group-hover:scale-110 transition-transform duration-300">📅</span>
                                </div>
                                <div class="flex-1">
                                    <h4
                                        class="text-sm font-bold text-text-main group-hover:text-secondary transition-colors">
                                        {{ $evento->nombre_evento }}
                                    </h4>
                                    <p class="text-xs text-text-secondary">
                                        {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} •
                                        {{ $evento->localidad }}
                                    </p>
                                </div>
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-secondary transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @empty
                            <div class="text-center py-10 text-gray-400 text-sm italic">
                                No se encontraron eventos.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Perfil Artista -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Perfil Artista -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-secondary/5 rounded-full -mr-20 -mt-20"></div>

                <div class="flex flex-col md:flex-row gap-8 items-start relative">
                    <!-- Artist Image -->
                    <div class="relative">
                        <div
                            class="w-32 h-32 rounded-3xl bg-gradient-to-br from-secondary to-accent p-1 shadow-lg shadow-secondary/20">
                            <div
                                class="w-full h-full rounded-[22px] bg-white flex items-center justify-center text-4xl">
                                @if($artista->img_logo)
                                    <img src="{{ asset('profiles/artistas/' . $artista->img_logo) }}"
                                        alt="{{ $artista->nombre_artistico }}"
                                        class="w-full h-full object-cover rounded-[22px]">
                                @else
                                    <span class="text-5xl">🎵</span>
                                @endif
                            </div>
                        </div>
                        <button
                            class="absolute -bottom-2 -right-2 p-2 bg-white rounded-xl shadow-md border border-gray-100 text-text-secondary hover:text-secondary transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex-1 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-3xl font-bold text-text-main font-heading">
                                    {{ $artista->nombre_artistico }}
                                </h2>
                                <p class="text-secondary font-medium">{{ $artista->genero_musical }} •
                                    {{ $artista->tipo }}
                                </p>
                            </div>
                            <button wire:click="editProfile"
                                class="px-4 py-2 bg-gray-50 text-text-secondary font-bold rounded-xl border border-gray-100 hover:bg-gray-100 transition-all text-sm">Editar
                                perfil</button>
                        </div>


                        <div class="bg-gray-50/50 p-5 rounded-2xl border border-gray-50">
                            <p class="text-text-secondary text-sm leading-relaxed">
                                {{ $artista->descripcion }}
                            </p>
                        </div>

                        <div class="flex items-center gap-6">
                            <div class="flex flex-col">
                                <span class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Precio
                                    Referencia</span>
                                <span class="text-xl font-bold text-text-main"> {{ $artista->precio_referencia }} <small
                                        class="text-xs font-normal text-text-secondary">/ sesión</small></span>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trabajos Realizados -->
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-text-main font-heading">Trabajos realizados anteriormente</h3>
                        <div class="flex items-center gap-2">
                            <span
                                class="text-xs font-bold text-accent bg-accent/10 px-3 py-1 rounded-full">{{ $misEventos->count() }}
                                Eventos</span>
                            <div class="h-1 w-20 bg-accent rounded-full"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($misEventos as $evento)
                            <a href="{{ route('public.event-detail', ['id' => $evento->id]) }}"
                                class="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-2xl hover:bg-white hover:shadow-md transition-all group">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-lg shadow-sm">
                                        🎵</div>
                                    <div>
                                        <h4 class="text-sm font-bold text-text-main">{{ $evento->nombre_evento }}</h4>
                                        <p class="text-[11px] text-text-secondary">
                                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} •
                                            {{ $evento->localidad }}</p>
                                    </div>
                                </div>
                                <div class="p-2 text-text-secondary group-hover:text-accent transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-2 text-center py-10 bg-gray-50 rounded-2xl border border-gray-100">
                                <div class="text-4xl mb-3">🎭</div>
                                <p class="text-sm font-bold text-text-secondary">Aún no has participado en eventos</p>
                                <p class="text-xs text-text-secondary mt-1">Cuando seas seleccionado para un evento,
                                    aparecerá aquí.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Premium / Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Estadísticas -->
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100/50 p-8 flex flex-col items-center text-center group hover:border-secondary/30 transition-all cursor-pointer">
                    <div
                        class="w-14 h-14 rounded-2xl bg-secondary/10 flex items-center justify-center text-secondary mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-text-main font-heading">Estadísticas</h4>
                    <p class="text-xs text-text-secondary mt-1">Analiza tu alcance y popularidad</p>
                    <div
                        class="mt-4 px-4 py-1.5 bg-secondary/5 text-secondary text-[10px] font-bold rounded-full uppercase tracking-wider">
                        Premium</div>
                </div>

                <!-- Panel Artista -->
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100/50 p-8 flex flex-col items-center text-center group hover:border-accent/30 transition-all cursor-pointer">
                    <div
                        class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center text-accent mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-text-main font-heading">Panel de Artista</h4>
                    <p class="text-xs text-text-secondary mt-1">Configuración y recursos exclusivos</p>
                    <div
                        class="mt-4 px-4 py-1.5 bg-accent/5 text-accent text-[10px] font-bold rounded-full uppercase tracking-wider italic">
                        Exclusivo</div>
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
                <!-- Trick to center contents -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Panel -->
                <div
                    class="inline-block align-middle bg-white rounded-[32px] text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10 overflow-hidden border border-gray-100">
                    <div class="bg-white px-8 pt-8 pb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-black text-text-main font-heading" id="modal-title">Editar Perfil de
                                Artista</h3>
                            <button wire:click="cancelEdit" class="text-gray-400 hover:text-gray-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre Artístico -->
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Nombre
                                    Artístico</label>
                                <input type="text" wire:model="nombre_artistico"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all">
                            </div>

                            <!-- Logo -->
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Logo
                                    / Imagen</label>
                                <div class="flex items-center gap-4">
                                    @if($editImgLogo)
                                        <img src="{{ $editImgLogo->temporaryUrl() }}"
                                            class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                                    @else
                                        <img src="{{ asset('profiles/artistas/' . $artista->img_logo) }}"
                                            class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                                    @endif
                                    <input type="file" wire:model="editImgLogo"
                                        class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20 transition-all">
                                </div>
                            </div>

                            <!-- Tipo -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Tipo</label>
                                <select wire:model="tipo"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all">
                                    @foreach(\App\Models\Artista::TIPO as $t)
                                        <option value="{{ $t }}">{{ ucfirst($t) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Género Musical -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Género
                                    Musical</label>
                                <select wire:model="genero_musical"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all">
                                    @foreach(\App\Models\Artista::GENERO_MUSICAL as $g)
                                        <option value="{{ $g }}">{{ ucfirst($g) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Descripción
                                    / Biografía</label>
                                <textarea wire:model="descripcion" rows="3"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none"></textarea>
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Teléfono
                                    de contacto</label>
                                <input type="text" wire:model="telefono"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all">
                            </div>

                            <!-- Precio Referencia -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Precio
                                    de Referencia</label>
                                <input type="text" wire:model="precio_referencia"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all">
                            </div>

                            <!-- Equipo Propio -->
                            <div class="flex items-center gap-3 bg-secondary/5 p-4 rounded-2xl border border-secondary/10">
                                <input type="checkbox" wire:model="equipo_propio"
                                    class="w-5 h-5 text-secondary rounded border-gray-300 focus:ring-secondary">
                                <label class="text-sm font-bold text-text-main">Dispongo de equipo propio</label>
                            </div>

                            <!-- Recibir Facturas -->
                            <div>
                                <label
                                    class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Recibir
                                    Facturas mediante</label>
                                <select wire:model="recibir_facturas"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all">
                                    @foreach(\App\Models\Artista::RECIBIR_FACTURAS as $rf)
                                        <option value="{{ $rf }}">{{ ucfirst($rf) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-6 flex flex-col md:flex-row gap-3">
                        <button wire:click="saveProfile"
                            class="flex-1 bg-secondary text-white font-black py-4 rounded-2xl shadow-lg shadow-secondary/20 hover:scale-[1.02] active:scale-95 transition-all">Guardar
                            Cambios</button>
                        <button wire:click="cancelEdit"
                            class="flex-1 bg-white text-text-secondary font-bold py-4 rounded-2xl border border-gray-200 hover:bg-gray-100 transition-all">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>