<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Header/Search Section -->
    <div class="relative bg-white rounded-[40px] shadow-2xl p-8 md:p-12 overflow-hidden border border-gray-100">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/5 rounded-full -ml-32 -mb-32 blur-3xl"></div>

        <div class="relative z-10 text-center max-w-3xl mx-auto space-y-6">
            <span class="px-4 py-1.5 bg-primary/10 text-primary text-xs font-black uppercase tracking-widest rounded-full">Buscador Global</span>
            <h1 class="text-4xl md:text-5xl font-black font-heading text-text-main leading-tight">Explora todos los <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">eventos</span></h1>
            <p class="text-text-secondary text-lg">Encuentra conciertos, festivales y cultura en cada rincón de España.</p>
        </div>

        <!-- Search Bar -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-4 relative z-10 p-2 bg-gray-50 rounded-[32px] border border-gray-100 shadow-inner">
            <div class="relative">
                <input type="text" wire:model.live="search" 
                    placeholder="¿Qué buscas? (Nombre del evento)" 
                    class="w-full pl-12 pr-4 py-5 bg-white border-none rounded-3xl shadow-sm focus:ring-2 focus:ring-primary/20 transition-all font-medium italic">
                <svg class="w-6 h-6 absolute left-4 top-1/2 -translate-y-1/2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <div class="relative">
                <input type="text" wire:model.live="localidad" 
                    placeholder="Localidad" 
                    class="w-full pl-12 pr-4 py-5 bg-white border-none rounded-3xl shadow-sm focus:ring-2 focus:ring-primary/20 transition-all font-medium italic">
                <svg class="w-6 h-6 absolute left-4 top-1/2 -translate-y-1/2 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
            </div>

            <div class="relative">
                <input type="text" wire:model.live="provincia" 
                    placeholder="Provincia" 
                    class="w-full pl-12 pr-4 py-5 bg-white border-none rounded-3xl shadow-sm focus:ring-2 focus:ring-primary/20 transition-all font-medium italic">
                <svg class="w-6 h-6 absolute left-4 top-1/2 -translate-y-1/2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Results Grid -->
    <div class="space-y-8">
        <div class="flex items-center justify-between px-4">
            <h2 class="text-2xl font-black text-text-main font-heading">Eventos encontrados <span class="text-primary font-black ml-2">{{ $eventos->total() }}</span></h2>
            <div class="h-1 w-24 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($eventos as $evento)
                <a href="{{ route('public.event-detail', $evento->id) }}"
                    class="bg-white rounded-[32px] overflow-hidden shadow-lg hover:shadow-2xl transition-all group border border-gray-100 flex flex-col hover:-translate-y-2 transform duration-300">
                    <div class="relative h-64 overflow-hidden">
                        @if($evento->foto)
                            <img src="{{ asset('storage/profiles/eventos/' . $evento->foto) }}"
                                alt="{{ $evento->nombre_evento }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-4xl">
                                🎸
                            </div>
                        @endif

                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-2xl text-sm font-black text-text-main shadow-lg border border-white/20">
                            {{ $evento->precio }}€
                        </div>
                        
                        <div class="absolute bottom-4 left-4 bg-black/40 backdrop-blur-md text-white px-4 py-2 rounded-2xl text-xs font-black border border-white/10 uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M') }}
                        </div>

                        @if($evento->estado === 'AGOTADO')
                            <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] flex items-center justify-center z-20">
                                <div class="bg-white/10 border border-white/20 px-6 py-3 rounded-3xl backdrop-blur-md transform -rotate-12">
                                    <span class="text-white font-black uppercase tracking-widest text-sm flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Agotado
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="p-8 space-y-4 flex-1 flex flex-col">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 bg-accent/10 text-accent text-[10px] font-black uppercase tracking-widest rounded-lg">
                                {{ $evento->categoria ?? 'Evento' }}
                            </span>
                            <div class="flex items-center text-text-secondary text-xs font-bold gap-1">
                                <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $evento->localidad }}
                            </div>
                        </div>

                        <h3 class="text-xl font-black font-heading text-text-main group-hover:text-primary transition-colors leading-tight">
                            {{ $evento->nombre_evento }}
                        </h3>

                        <p class="text-text-secondary text-sm line-clamp-2 flex-1 leading-relaxed italic">
                            {{ $evento->descripcion }}
                        </p>

                        <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                            <div class="flex -space-x-2">
                                @foreach($evento->artistas->take(3) as $artist)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 overflow-hidden shadow-sm">
                                        @if($artist->img_logo)
                                            <img src="{{ asset('profiles/artistas/' . $artist->img_logo) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] font-black text-text-secondary">
                                                {{ substr($artist->nombre_artistico, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                @if($evento->artistas->count() > 3)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-primary text-white flex items-center justify-center text-[10px] font-black shadow-sm">
                                        +{{ $evento->artistas->count() - 3 }}
                                    </div>
                                @endif
                            </div>
                            <span class="text-xs font-black text-primary uppercase tracking-tighter group-hover:translate-x-1 transition-transform">Ver detalles →</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[40px] border border-dashed border-gray-200 space-y-4">
                    <div class="text-6xl text-gray-200">🔍</div>
                    <h3 class="text-xl font-bold text-text-main">No hemos encontrado eventos con esos filtros</h3>
                    <p class="text-text-secondary">Prueba a buscar otros términos o borra los filtros.</p>
                    <button wire:click="$set('search', ''); $set('localidad', ''); $set('provincia', '');" 
                        class="px-8 py-3 bg-primary text-white font-black rounded-2xl shadow-lg shadow-primary/20 hover:scale-105 transition-all">Limpiar filtros</button>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $eventos->links() }}
        </div>
    </div>
</div>
