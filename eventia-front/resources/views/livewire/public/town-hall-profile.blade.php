<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: Info & Stats (Read Only) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100/50 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-text-main font-heading">Información</h3>
                    <div class="h-1 w-12 bg-primary rounded-full"></div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <span
                            class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Ubicación</span>
                        <p class="text-sm font-bold text-text-main mt-1 italic">{{ $ayuntamiento->localidad }},
                            {{ $ayuntamiento->provincia }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Eventos
                            Totales</span>
                        <p class="text-3xl font-black text-primary mt-1">{{ $ayuntamiento->eventos->count() }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-widest text-text-secondary font-bold">Próximo
                            Evento</span>
                        <p class="text-sm font-bold text-secondary mt-1">
                            {{ $eventos->first()->nombre_evento ?? 'Sin eventos programados' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-primary/10 to-secondary/10 rounded-3xl p-6 border border-primary/10">
                <h4 class="text-sm font-black text-primary uppercase tracking-tighter mb-2">Entidad Verificada</h4>
                <p class="text-xs text-text-secondary leading-relaxed">Este perfil pertenece a una entidad oficial
                    registrada y verificada por Eventia.</p>
            </div>
        </div>

        <!-- Right Column: Profile & Events -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Perfil Card -->
            <div
                class="bg-white rounded-[40px] shadow-sm border border-gray-100/50 p-10 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-48 h-48 bg-primary/5 rounded-full -mr-24 -mt-24 transition-transform group-hover:scale-110">
                </div>

                <div class="flex flex-col md:flex-row gap-8 items-center relative">
                    <div
                        class="w-32 h-32 rounded-3xl bg-gradient-to-br from-primary to-secondary p-1 shadow-xl shadow-primary/20">
                        <div
                            class="w-full h-full rounded-[22px] bg-white flex items-center justify-center text-5xl overflow-hidden">
                            @if(isset($ayuntamiento->imagen) && $ayuntamiento->imagen)
                                <img src="{{ asset('profiles/ayuntamientos/' . $ayuntamiento->imagen) }}"
                                    alt="{{ $ayuntamiento->nombre_institucion }}" class="w-full h-full object-cover">
                            @else
                                🏛️
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left space-y-2">
                        <h2 class="text-4xl font-black text-text-main tracking-tight font-heading">
                            {{ $ayuntamiento->nombre_institucion }}</h2>
                        <div class="flex items-center justify-center md:justify-start gap-4">
                            <span
                                class="px-3 py-1 bg-gray-50 text-[10px] font-bold text-text-secondary rounded-lg border border-gray-100">Ayuntamiento
                                Oficial</span>
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                            <span class="text-[10px] font-bold text-green-600 uppercase">Activo</span>
                        </div>
                    </div>
                </div>

                <div class="mt-10 bg-gray-50/50 p-8 rounded-[32px] border border-gray-100 italic">
                    <p class="text-text-secondary leading-relaxed">
                        {{ $ayuntamiento->descripcion ?? 'Bienvenidos al portal oficial de eventos de ' . $ayuntamiento->nombre_institucion . '. Nuestra misión es fomentar la cultura, el arte y el entretenimiento de calidad en ' . $ayuntamiento->localidad . '.' }}
                    </p>
                </div>

                <!-- Eventos Organizados -->
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="h-8 w-1.5 bg-secondary rounded-full"></div>
                            <h3 class="text-2xl font-black text-text-main font-heading tracking-tight">Próximos Eventos
                            </h3>
                        </div>
                        <span
                            class="text-xs font-bold text-secondary bg-secondary/10 px-4 py-1.5 rounded-full">Cartelera
                            Actualizada</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($eventos as $evento)
                            <a href="{{ route('public.event-detail', ['id' => $evento->id]) }}"
                                class="flex items-center justify-between p-5 bg-white border border-gray-100 rounded-2xl hover:bg-gray-50 hover:shadow-lg hover:-translate-y-1 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                                        @if($evento->foto)
                                            <img src="{{ asset('/profiles/eventos/' . $evento->foto) }}"
                                                alt="{{ $evento->nombre_evento }}" class="w-full h-full object-cover rounded-2xl">
                                        @else
                                            📅
                                        @endif
                                    </div>
                                    <div>
                                        <h4
                                            class="text-sm font-bold text-text-main group-hover:text-primary transition-colors">
                                            {{ $evento->nombre_evento }}</h4>
                                        <p class="text-[10px] text-text-secondary font-medium">
                                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} •
                                            {{ $evento->localidad }}</p>
                                    </div>
                                </div>
                                <div class="p-2 text-text-secondary group-hover:text-primary transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full py-10 text-center text-gray-400 italic text-sm">
                                Este ayuntamiento aún no tiene eventos programados.
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