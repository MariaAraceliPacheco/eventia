<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Profile Header -->
    <div
        class="bg-white rounded-[32px] shadow-sm border border-gray-100/50 p-8 mb-10 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-6">
            <div
                class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-3xl shadow-lg shadow-primary/20 text-white">
                👤
            </div>
            <div>
                <h2 class="text-3xl font-black text-text-main font-heading">{{ $user->nombre }}</h2>
                <p class="text-text-secondary font-medium">Panel de Usuario •
                    {{ $publico->localidad ?? 'Sin ubicación' }}
                </p>
            </div>
        </div>
        <button wire:click="editProfile"
            class="cursor-pointer px-6 py-3 bg-gray-50 text-text-secondary font-bold rounded-xl border border-gray-100 hover:bg-gray-100 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Featured Events List -->
                    <div class="space-y-4 h-[550px] overflow-y-auto pr-3 custom-scrollbar">
                        <!-- Featured Events List -->
                        <div class="space-y-4 h-[550px] overflow-y-auto pr-3 custom-scrollbar">
                            @forelse($events as $event)
                                <a href="{{ route('public.event-detail', ['id' => $event->id]) }}"
                                    class="block group relative bg-gray-50 rounded-2xl p-5 border border-transparent hover:border-primary/30 hover:bg-white hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 cursor-pointer overflow-hidden">
                                    <div
                                        class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-150">
                                    </div>

                                    <div class="flex items-center gap-5 relative">
                                        <div
                                            class="w-16 h-16 rounded-xl bg-white shadow-sm flex items-center justify-center text-2xl group-hover:rotate-12 transition-transform">
                                            @if ($event->foto)
                                                <img src="{{ asset('storage/profiles/eventos/' . $event->foto) }}"
                                                    class="w-full h-full object-cover rounded-2xl">
                                            @else
                                                🎟️
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <h4
                                                    class="text-base font-bold text-text-main group-hover:text-primary transition-colors">
                                                    {{ $event->nombre_evento }}
                                                </h4>
                                                @if($event->estado === 'FINALIZADO')
                                                    <span
                                                        class="text-[9px] bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded font-black">SOLDOUT</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-3 mt-1">
                                                <span class="text-xs text-text-secondary flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($event->fecha_inicio)->format('d M') }}
                                                </span>
                                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                                <span class="text-xs text-text-secondary flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    {{ $event->localidad }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-right flex flex-col items-end gap-2">
                                            <span
                                                class="cursor-pointer text-lg font-black text-primary">{{ number_format($event->precio, 2) }}€</span>

                                            @if($user->id === auth()->id())
                                                <button wire:click.prevent="toggleSelection({{ $event->id }})"
                                                    class="cursor-pointer px-3 py-1 text-[10px] font-bold rounded-lg transition-all {{ in_array($event->id, $selectedTickets) ? 'cursor-pointer bg-gray-100 text-text-secondary hover:bg-gray-200' : 'cursor-pointer bg-accent text-white hover:bg-accent/90 shadow-sm shadow-accent/20' }}">
                                                    {{ in_array($event->id, $selectedTickets) ? 'Eliminar del Carrito' : 'Añadir al Carrito' }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-20 text-gray-400">
                                    <p class="text-sm italic">No se encontraron eventos disponibles.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Mis Entradas -->
        <div class="space-y-8">
            <div class="bg-white rounded-[32px] shadow-sm border border-gray-100/50 p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-text-main font-heading">
                        @if($user->id === auth()->id())
                            Mis Entradas
                        @else
                            Entradas de {{ $user->nombre }}
                        @endif
                    </h3>
                    <div class="flex gap-2">
                        <span
                            class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase">Ticket
                            Pass</span>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Próximos Eventos (Highlighted) -->
                    @if(count($upcomingEvents) > 0)
                        <div>
                            <h4
                                class="text-xs font-black text-primary uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                                <span class="flex h-2 w-2 relative">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                                </span>
                                Próximos Eventos (Esta semana)
                            </h4>
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($upcomingEvents as $upEvent)
                                    <a href="{{ route('public.event-detail', $upEvent->id) }}"
                                        class="group relative bg-gradient-to-br from-primary/5 to-white border border-primary/20 p-5 rounded-3xl transition-all hover:shadow-lg hover:shadow-primary/5">
                                        <div class="flex items-center gap-5">
                                            <div
                                                class="w-14 h-14 bg-white rounded-2xl shadow-sm flex flex-col items-center justify-center border border-primary/10">
                                                <span
                                                    class="text-[10px] font-black text-primary uppercase">{{ \Carbon\Carbon::parse($upEvent->fecha_inicio)->translatedFormat('M') }}</span>
                                                <span
                                                    class="text-xl font-black text-text-main -mt-1">{{ \Carbon\Carbon::parse($upEvent->fecha_inicio)->format('d') }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <h5
                                                    class="text-sm font-black text-text-main group-hover:text-primary transition-colors">
                                                    {{ $upEvent->nombre_evento }}
                                                </h5>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span
                                                        class="text-[10px] font-bold text-text-secondary flex items-center gap-1">
                                                        <svg class="w-3 h-3 text-secondary" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Quedan
                                                        {{ \Carbon\Carbon::parse($upEvent->fecha_inicio)->diffForHumans(null, true) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div
                                                class="p-2 bg-white rounded-xl shadow-sm group-hover:bg-primary group-hover:text-white transition-all">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="h-px bg-gray-100 my-6"></div>
                    @endif
                    <!-- Compradas -->
                    <div>
                        <h4
                            class="text-sm font-bold text-text-secondary uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                            Compradas
                        </h4>
                        <div class="space-y-3 max-h-[220px] overflow-y-auto pr-2 custom-scrollbar">
                            @forelse($purchasedTickets as $ticket)
                                <div
                                    class="p-4 bg-gray-50 border border-gray-100 rounded-2xl flex items-center justify-between group hover:bg-white hover:shadow-md transition-all">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-xl shadow-sm italic font-bold text-primary">
                                            {{ substr($ticket->evento->nombre_evento, 0, 1) }}
                                        </div>
                                        <div>
                                            <h5 class="text-sm font-bold text-text-main">
                                                {{ $ticket->evento->nombre_evento }}
                                            </h5>
                                            <p class="text-[11px] text-text-secondary">{{ $ticket->categoria }} • ID:
                                                {{ $ticket->codigo_ticket }}
                                            </p>
                                        </div>
                                    </div>
                                    <button wire:click="downloadTicket({{ $ticket->id }})"
                                        class="cursor-pointer text-primary hover:text-secondary transition-colors"
                                        title="Descargar Entrada">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                    </button>
                                </div>
                            @empty
                                <div class="text-center py-10 text-gray-400">
                                    <p class="text-[11px] italic">
                                        @if($user->id === auth()->id())
                                            Aún no has comprado ninguna entrada.
                                        @else
                                            Este usuario aún no tiene entradas compradas.
                                        @endif
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if($user->id === auth()->id())
                        <!-- En el carrito -->
                        <div class="pt-6 border-t border-gray-50">
                            <h4
                                class="text-sm font-bold text-text-secondary uppercase tracking-widest mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 bg-accent rounded-full"></span>
                                En el carrito
                            </h4>
                            <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                                @forelse($cartItems as $item)
                                    <div wire:click="$set('selectedCartEventId', {{ $item->id }})"
                                        class="group relative p-4 rounded-2xl border-2 transition-all cursor-pointer {{ $selectedCartEventId == $item->id ? 'bg-primary/5 border-primary shadow-lg shadow-primary/5' : 'bg-gray-50 border-transparent hover:border-gray-200' }}">

                                        <div class="flex items-center justify-between gap-4">
                                            <div class="flex items-center gap-4">
                                                <!-- Selection Indicator -->
                                                <div
                                                    class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all {{ $selectedCartEventId == $item->id ? 'border-primary bg-primary' : 'border-gray-300' }}">
                                                    @if($selectedCartEventId == $item->id)
                                                        <div class="w-2 h-2 rounded-full bg-white"></div>
                                                    @endif
                                                </div>

                                                <div
                                                    class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                                                    🛒
                                                </div>
                                                <div>
                                                    <h5
                                                        class="text-sm font-bold text-text-main group-hover:text-primary transition-colors">
                                                        {{ $item->nombre_evento }}
                                                    </h5>
                                                    <p
                                                        class="text-[10px] {{ $selectedCartEventId == $item->id ? 'text-primary font-bold' : 'text-text-secondary' }}">
                                                        {{ $selectedCartEventId == $item->id ? 'Seleccionada para comprar' : 'En el carrito' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <button wire:click.stop="toggleSelection({{ $item->id }})"
                                                class="p-2 text-gray-400 hover:text-accent transition-colors"
                                                title="Eliminar del carrito"
                                                onmouseover="this.querySelector('svg').style.transform='rotate(90deg)'"
                                                onmouseout="this.querySelector('svg').style.transform='rotate(0deg)'">
                                                <svg class="w-5 h-5 transition-transform duration-300" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                        <p class="text-[11px] italic text-gray-400">No tienes entradas en tu carrito.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Final Button -->
                        <button wire:click="goToPurchase" @if(!$selectedCartEventId) disabled @endif
                            class="cursor-pointer w-full mt-10 inline-flex items-center justify-center gap-3 {{ $selectedCartEventId ? 'bg-gradient-to-r from-primary via-secondary to-accent shadow-primary/20 hover:shadow-primary/40' : 'bg-gray-200 cursor-not-allowed opacity-50' }} text-white font-bold py-5 rounded-2xl shadow-xl transition-all transform {{ $selectedCartEventId ? 'hover:-translate-y-1' : '' }} group">
                            <span>Ir a Comprar Entradas</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    @else
                        <!-- Espacio adicional o info para admin -->
                        <div class="mt-10 p-6 bg-gray-50 rounded-[28px] border border-gray-100">
                            <p class="text-xs text-text-secondary font-medium leading-relaxed italic">
                                Estas visualizando el panel de usuario de <strong>{{ $user->nombre }}</strong> como
                                administrador. Tienes acceso a sus tickets y compras activas.
                            </p>
                        </div>
                    @endif
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
                    <div
                        class="inline-block align-middle bg-white rounded-[32px] text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10 overflow-hidden border border-gray-100">
                        <div class="bg-white px-8 pt-8 pb-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-black text-text-main font-heading" id="modal-title">Editar Perfil
                                </h3>
                                <button wire:click="cancelEdit" class="text-gray-400 hover:text-gray-500 transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="space-y-6">
                                <!-- Nombre de usuario -->
                                <div>
                                    <label
                                        class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Nombre
                                        de usuario</label>
                                    <input type="text" wire:model="nombre"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                                        placeholder="Tu nombre de usuario">
                                    @error('nombre') <span class="text-xs text-red-500 font-bold mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Comunidad Autónoma -->
                                <div>
                                    <label
                                        class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Comunidad
                                        Autónoma</label>
                                    <select wire:model.live="comunidad_autonoma"
                                        class="cursor-pointer w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
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
                                        class="cursor-pointer w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
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
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                                        placeholder="Ej: Madrid">
                                    @error('localidad') <span class="text-xs text-red-500 font-bold mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gustos Musicales -->
                                <div>
                                    <label
                                        class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Gustos
                                        Musicales</label>
                                    <select wire:model="gustos_musicales"
                                        class="cursor-pointer w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                        <option value="">¿Qué música te gusta?</option>
                                        @foreach(\App\Models\Publico::GUSTOS_MUSICALES as $gusto)
                                            <option value="{{ $gusto }}">{{ ucfirst($gusto) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tipo de Eventos -->
                                <div>
                                    <label
                                        class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Tipo
                                        de Eventos Favoritos</label>
                                    <select wire:model="tipo_eventos_favoritos"
                                        class="cursor-pointer w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                        <option value="">¿A qué eventos sueles ir?</option>
                                        @foreach(\App\Models\Publico::TIPO_EVENTOS_FAVORITOS as $tipo)
                                            <option value="{{ $tipo }}">{{ ucfirst($tipo) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Notificaciones -->
                                <div class="flex items-center gap-3 bg-primary/5 p-4 rounded-2xl border border-primary/10">
                                    <input type="checkbox" wire:model="notificaciones"
                                        class="cursor-pointer w-5 h-5 text-primary rounded border-gray-300 focus:ring-primary">
                                    <label class="text-sm font-bold text-text-main">Recibir notificaciones de eventos
                                        similares</label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-8 py-6 flex flex-col md:flex-row gap-3">
                            <button wire:click="saveProfile"
                                class="cursor-pointer flex-1 bg-primary text-white font-black py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Guardar
                                Cambios</button>
                            <button wire:click="cancelEdit"
                                class="cursor-pointer flex-1 bg-white text-text-secondary font-bold py-4 rounded-2xl border border-gray-200 hover:bg-gray-100 transition-all">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>