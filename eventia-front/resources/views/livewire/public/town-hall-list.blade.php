<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-16 space-y-4">
        <h1 class="text-5xl font-black font-heading text-text-main tracking-tight">Nuestros <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Ayuntamientos</span></h1>
        <p class="text-lg text-text-secondary max-w-2xl mx-auto italic">Explora las instituciones que hacen posible la magia. Descubre eventos únicos organizados por los ayuntamientos más activos de España.</p>
        <div class="flex justify-center pt-4">
            <div class="h-1.5 w-24 bg-gradient-to-r from-primary via-secondary to-accent rounded-full"></div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="max-w-3xl mx-auto mb-16 px-4">
        <div class="relative group">
            <input type="text" wire:model.live="search" 
                class="w-full pl-14 pr-4 py-5 bg-white border border-gray-100 rounded-[30px] shadow-sm focus:ring-4 focus:ring-primary/10 focus:border-primary focus:shadow-xl outline-none transition-all text-lg font-medium" 
                placeholder="Busca un ayuntamiento o provincia...">
            <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Town Hall Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($townHalls as $th)
        <div class="group relative bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-{{ $th['color'] }}/10 hover:-translate-y-2 transition-all duration-500">
            <!-- Decorative Accent -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $th['color'] }}/5 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-150"></div>
            
            <div class="p-10">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 relative">
                    <!-- Icon / Image -->
                    <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-{{ $th['color'] }} to-{{ $th['color'] === 'primary' ? 'secondary' : 'accent' }} p-1 flex-shrink-0 shadow-lg shadow-{{ $th['color'] }}/20">
                        <div class="w-full h-full rounded-[22px] bg-white flex items-center justify-center text-4xl group-hover:rotate-12 transition-transform duration-300">
                            @if($th['image'])
                                    <img src="{{ asset('profiles/ayuntamientos/' . $th['image']) }}"
                                        class="w-full h-full object-cover rounded-2xl">
                                @else
                                    <span class="text-xl">🏛️</span>
                                @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 text-center sm:text-left space-y-3">
                        <h2 class="text-2xl font-black font-heading text-text-main group-hover:text-{{ $th['color'] }} transition-colors">{{ $th['name'] }}</h2>
                        <p class="text-sm text-text-secondary leading-relaxed">{{ $th['description'] }}</p>
                        
                        <!-- Mini Badges -->
                        <div class="flex flex-wrap justify-center sm:justify-start gap-2 pt-2">
                            <span class="px-3 py-1 bg-gray-50 text-[10px] font-bold text-text-secondary rounded-lg border border-gray-100 italic">Oficial</span>
                            <span class="px-3 py-1 bg-{{ $th['color'] }}/10 text-[10px] font-bold text-{{ $th['color'] }} rounded-lg uppercase tracking-wider">Verificado</span>
                        </div>
                    </div>
                </div>

                <!-- Event List -->
                <div class="mt-10 space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                        <h3 class="text-xs font-black uppercase tracking-widest text-text-secondary">Host de eventos</h3>
                        <span class="text-[10px] font-bold text-primary px-2 py-0.5 bg-primary/5 rounded-md">Próximos</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($th['events'] as $event)
                        <div class="flex items-center gap-2 p-3 bg-gray-50/50 rounded-xl text-xs font-bold text-text-main group-hover:bg-white border border-transparent group-hover:border-gray-100 transition-all">
                            <div class="w-1.5 h-1.5 bg-{{ $th['color'] }} rounded-full"></div>
                            {{ $event }}
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Action -->
                <div class="mt-8 pt-6 border-t border-gray-50">
                    <a href="{{ route('public.town-hall-profile', ['id' => $th['id']]) }}" class="w-full py-4 inline-flex items-center justify-center gap-3 bg-{{ $th['color'] === 'primary' ? 'text-main' : 'gray-50' }} {{ $th['color'] === 'primary' ? 'text-white' : 'text-text-main' }} font-bold rounded-2xl shadow-lg shadow-text-main/5 hover:scale-[1.02] active:scale-95 transition-all group/btn">
                        <span>Ver Perfil Institucional</span>
                        <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- CTA Section -->
     @if (!Auth::check())
    <div class="mt-20 bg-gradient-to-tr from-text-main to-gray-800 rounded-[50px] p-12 sm:p-20 text-center text-white relative overflow-hidden shadow-2xl">
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary/10 rounded-full -ml-32 -mt-32"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-secondary/10 rounded-full -mr-32 -mb-32"></div>
        
        <div class="relative z-10 max-w-3xl mx-auto space-y-6">
            <h2 class="text-3xl sm:text-4xl font-black font-heading tracking-tight italic">¿Eres una institución pública?</h2>
            <p class="text-gray-400 text-lg">Únete a la plataforma líder en gestión de eventos culturales y conecta tu ayuntamiento con miles de ciudadanos.</p>
            <div class="pt-6">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-3 bg-white text-text-main font-black px-10 py-5 rounded-2xl shadow-xl hover:scale-105 transition-all">
                    Registra tu Ayuntamiento
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
