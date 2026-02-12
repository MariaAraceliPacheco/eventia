@php
    /** @var \App\Models\Artista[]|\App\Models\Ayuntamiento[]|\App\Models\Evento[] $results */
@endphp

<!-- 
    CONTENEDOR DEL MODAL (Alpine.js)
    - x-show="showSearch": Controla la visibilidad con la variable definida en el layout.
    - x-transition: Añade animaciones suaves de entrada y salida (fundido y escala).
    - x-cloak: Evita que el modal sea visible un instante antes de que cargue Alpine.
-->
<div x-show="showSearch" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-95"
     class="fixed inset-0 z-[100] overflow-y-auto" 
     role="dialog" 
     aria-modal="true"
     x-cloak>
    
    <!-- BACKGROUND (Fondo oscuro con desenfoque) -->
    <div class="fixed inset-0 bg-zinc-950/40 backdrop-blur-sm transition-opacity" @click="showSearch = false"></div>

    <div class="flex min-h-full items-start justify-center p-4 sm:p-6 lg:p-20">
        <div class="relative w-full max-w-2xl transform overflow-hidden rounded-[32px] bg-white shadow-2xl ring-1 ring-zinc-200 transition-all">
            
            <!-- HEADER DEL BUSCADOR: Input de búsqueda -->
            <div class="relative border-b border-zinc-100 p-6">
                <!-- Icono de lupa -->
                <div class="absolute inset-y-0 left-10 flex items-center pointer-events-none text-zinc-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                
                <!-- 
                    INPUT DE BÚSQUEDA (Livewire)
                    - wire:model.live.debounce.300ms: Sincroniza el texto con el servidor en tiempo real cada 300ms de pausa.
                    - @keydown.escape.window: Permite cerrar el modal pulsando la tecla Esc.
                    - x-ref="searchInput": Referencia para Alpine si quisiéramos darle el foco vía JS.
                -->
                <input type="text" 
                       wire:model.live.debounce.300ms="query"
                       class="w-full pl-14 pr-12 py-4 text-xl font-medium text-zinc-900 placeholder-zinc-400 bg-zinc-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all outline-none"
                       placeholder="Busca artistas, ayuntamientos o eventos..."
                       @keydown.escape.window="showSearch = false"
                       x-ref="searchInput">
                
                <!-- Botón de cerrar -->
                <button @click="showSearch = false" class="absolute right-10 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- CUERPO DE RESULTADOS -->
            <div class="max-h-[60vh] overflow-y-auto p-2 custom-scrollbar">
                @if(empty($query))
                    <!-- Mensaje inicial cuando el input está vacío -->
                    <div class="p-12 text-center text-zinc-500">
                        <p class="font-medium">Empieza a escribir para buscar banda, ayuntamiento o evento...</p>
                    </div>
                @elseif(count($results['artistas']) === 0 && count($results['ayuntamientos']) === 0 && count($results['eventos']) === 0)
                    <!-- Mensaje cuando no hay coincidencias en la base de datos -->
                    <div class="p-12 text-center text-zinc-500">
                        <p>No se han encontrado resultados para "<span class="font-bold text-zinc-900">{{ $query }}</span>"</p>
                    </div>
                @else
                    <!-- LISTADO DE RESULTADOS CATEGORIZADO -->
                    <div class="p-4 space-y-8">
                        
                        <!-- SECCIÓN: ARTISTAS -->
                        @if(count($results['artistas']) > 0)
                            <section>
                                <h4 class="text-xs font-black uppercase tracking-widest text-zinc-400 mb-4 px-2">Artistas y Bandas</h4>
                                <div class="grid gap-2">
                                    @foreach($results['artistas'] as $artista)
                                        <a href="{{ route('public.artist-profile', ['id' => $artista->id]) }}" 
                                           class="flex items-center gap-4 p-3 rounded-2xl hover:bg-zinc-50 border border-transparent hover:border-zinc-100 transition-all group">
                                            <div class="w-12 h-12 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary shadow-sm overflow-hidden">
                                                @if($artista->img_logo)
                                                    <img src="{{ asset('profiles/artistas/' . $artista->img_logo) }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-xl">🎤</span>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-zinc-900 group-hover:text-secondary transition-colors">{{ $artista->nombre_artistico }}</div>
                                                <div class="text-[10px] text-zinc-400 uppercase font-bold tracking-tighter">{{ $artista->genero_musical }} • {{ $artista->tipo }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        <!-- SECCIÓN: AYUNTAMIENTOS -->
                        @if(count($results['ayuntamientos']) > 0)
                            <section>
                                <h4 class="text-xs font-black uppercase tracking-widest text-zinc-400 mb-4 px-2">Ayuntamientos e Instituciones</h4>
                                <div class="grid gap-2">
                                    @foreach($results['ayuntamientos'] as $ayto)
                                        <a href="{{ route('public.town-hall-profile', ['id' => $ayto->id]) }}" 
                                           class="flex items-center gap-4 p-3 rounded-2xl hover:bg-zinc-50 border border-transparent hover:border-zinc-100 transition-all group">
                                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary shadow-sm overflow-hidden">
                                                @if($ayto->imagen)
                                                    <img src="{{ asset('profiles/ayuntamientos/' . $ayto->imagen) }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-xl">🏛️</span>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-zinc-900 group-hover:text-primary transition-colors">{{ $ayto->nombre_institucion }}</div>
                                                <div class="text-[10px] text-zinc-400 uppercase font-bold tracking-tighter">{{ $ayto->localidad }}, {{ $ayto->provincia }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        <!-- SECCIÓN: EVENTOS -->
                        @if(count($results['eventos']) > 0)
                            <section>
                                <h4 class="text-xs font-black uppercase tracking-widest text-zinc-400 mb-4 px-2">Eventos y Programación</h4>
                                <div class="grid gap-2">
                                    @foreach($results['eventos'] as $evento)
                                        <a href="{{ route('public.event-detail', ['id' => $evento->id]) }}" 
                                           class="flex items-center gap-4 p-3 rounded-2xl hover:bg-zinc-50 border border-transparent hover:border-zinc-100 transition-all group">
                                            <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center text-accent shadow-sm">
                                                <span class="text-xl">📅</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-zinc-900 group-hover:text-accent transition-colors">{{ $evento->nombre_evento }}</div>
                                                <div class="text-[10px] text-zinc-400 uppercase font-bold tracking-tighter">{{ $evento->localidad }} • {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    </div>
                @endif
            </div>

            <!-- FOOTER DEL MODAL -->
            <div class="bg-zinc-50 px-6 py-4 border-t border-zinc-100 flex items-center justify-between">
                <span class="text-[10px] text-zinc-400 font-black uppercase tracking-widest">Esc para cerrar modal</span>
                <span class="text-primary font-bold text-xs tracking-tighter italic">Eventia Search Engenie</span>
            </div>
        </div>
    </div>

    <!-- ESTILOS LOCALES -->
    <style>
        /* Oculta el componente antes de que Alpine se inicialice para evitar parpadeos */
        [x-cloak] { display: none !important; }
        
        /* Barra de scroll personalizada y fina para un aspecto más premium */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</div>