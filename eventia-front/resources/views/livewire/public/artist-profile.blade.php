<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Info & Stats (Read Only) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-text-main font-heading">Información</h3>
                    <div class="h-1 w-12 bg-secondary rounded-full"></div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Género Musical</span>
                        <p class="text-sm font-bold text-text-main mt-1 italic">{{ $artist->genero_musical }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Tipo de Formación</span>
                        <p class="text-sm font-bold text-text-main mt-1">{{ $artist->tipo }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Precio de Referencia</span>
                        <p class="text-3xl font-black text-secondary mt-1">{{ $artist->precio_referencia }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-secondary/10 to-accent/10 rounded-3xl p-6 border border-secondary/10">
                <h4 class="text-sm font-black text-secondary uppercase tracking-tighter mb-2">Artista Verificado</h4>
                <p class="text-xs text-text-secondary leading-relaxed">Este perfil pertenece a un artista o banda registrada y cuya trayectoria ha sido verificada por Eventia.</p>
            </div>
        </div>

        <!-- Right Column: Profile & Events -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Perfil Card -->
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100/50 p-10 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-48 h-48 bg-secondary/5 rounded-full -mr-24 -mt-24 transition-transform group-hover:scale-110"></div>
                
                <div class="flex flex-col md:flex-row gap-8 items-center relative">
                    <div class="w-32 h-32 rounded-3xl bg-gradient-to-br from-secondary to-accent p-1 shadow-xl shadow-secondary/20">
                        <div class="w-full h-full rounded-[22px] bg-white flex items-center justify-center text-5xl overflow-hidden">
                            @if(isset($artist->img_logo) && $artist->img_logo)
                                <img src="{{ asset('storage/' . $artist->img_logo) }}" alt="{{ $artist->nombre_artistico }}" class="w-full h-full object-cover">
                            @else
                                🎤
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left space-y-2">
                        <h2 class="text-4xl font-black text-text-main tracking-tight font-heading">{{ $artist->nombre_artistico }}</h2>
                        <div class="flex items-center justify-center md:justify-start gap-4">
                            <span class="px-3 py-1 bg-gray-50 text-[10px] font-bold text-text-secondary rounded-lg border border-gray-100">Artista Profesional</span>
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                            <span class="text-[10px] font-bold text-green-600 uppercase">Disponible</span>
                        </div>
                    </div>
                </div>

                <div class="mt-10 bg-gray-50/50 p-8 rounded-[32px] border border-gray-100 italic">
                    <p class="text-text-secondary leading-relaxed">
                        {{ $artist->descripcion }}
                    </p>
                </div>

                <!-- Trabajos / Eventos -->
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="h-8 w-1.5 bg-accent rounded-full"></div>
                            <h3 class="text-2xl font-black text-text-main font-heading tracking-tight">Presentaciones Recientes</h3>
                        </div>
                        <span class="text-xs font-bold text-accent bg-accent/10 px-4 py-1.5 rounded-full">{{ $artist->eventos->count() }} Eventos</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($artist->eventos as $evento)
                        <a href="{{ route('public.event-detail', ['id' => $evento->id]) }}" class="flex items-center justify-between p-5 bg-white border border-gray-100 rounded-2xl hover:bg-gray-50 hover:shadow-lg hover:-translate-y-1 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🎵</div>
                                <div>
                                    <h4 class="text-sm font-bold text-text-main group-hover:text-secondary transition-colors">{{ $evento->nombre_evento }}</h4>
                                    <p class="text-[10px] text-text-secondary font-medium">{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} • {{ $evento->localidad }}</p>
                                </div>
                            </div>
                            <div class="p-2 text-text-secondary group-hover:text-secondary transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>
                        @empty
                        <div class="col-span-2 text-center py-10 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="text-4xl mb-3">🎭</div>
                            <p class="text-sm font-bold text-text-secondary">Aún no hay eventos registrados</p>
                            <p class="text-xs text-text-secondary mt-1">Este artista estará disponible próximamente en nuevos eventos.</p>
                        </div>
                        @endforelse
                    </div>
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
    </style>
</div>
