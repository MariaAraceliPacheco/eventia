<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header: Event Hero -->
    <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden border border-gray-100/50 relative mb-10">
        <div class="relative h-80 overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-tr from-text-main to-secondary opacity-90"></div>
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1459749411177-042180ce673c?q=80&w=2070')] bg-cover bg-center mix-blend-overlay blur-[2px]"></div>
            
            <div class="relative h-full px-10 flex flex-col justify-center text-white">
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="w-48 h-48 rounded-3xl bg-white/10 backdrop-blur-md p-2 shadow-2xl flex-shrink-0">
                        <div class="w-full h-full rounded-2xl bg-white flex items-center justify-center text-5xl">🎸</div>
                    </div>
                    
                    <div class="flex-1 space-y-4 text-center md:text-left">
                        <div class="flex flex-wrap items-center gap-2 justify-center md:justify-start">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-[10px] font-black uppercase tracking-widest text-secondary">Evento Destacado</span>
                            <a href="{{ route('public.area') }}" class="text-xs font-bold text-white/80 hover:text-white transition-colors underline decoration-secondary/50">Ver más conciertos</a>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black font-heading tracking-tight leading-tight">{{ $evento->nombre_evento }}</h1>
                        
                        <div class="flex flex-wrap items-center gap-6 justify-center md:justify-start">
                             <div class="flex items-center gap-2">
                                <span class="p-2 bg-white/10 rounded-xl"><svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg></span>
                                <span class="font-bold text-sm">{{ $evento->localidad }}, {{ $evento->provincia }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="p-2 bg-white/10 rounded-xl"><svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></span>
                                <span class="font-bold text-sm">{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y • H:i\h') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-8 right-8 flex flex-col items-center gap-2">
                        <button class="p-4 bg-white/10 backdrop-blur-md rounded-2xl text-white hover:bg-secondary transition-all group/btn">
                            <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        </button>
                        <span class="text-[10px] font-bold uppercase text-white/60">Recordatorio</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Left Section: Description, Map, Organizer -->
        <div class="lg:col-span-2 space-y-10">
            
            <!-- Comprar Entradas Link (Visible only to Public or Guests) -->
            @if(!auth()->check() || auth()->user()->tipo_usuario === 'publico')
            <div class="flex items-center justify-between p-8 bg-gradient-to-r from-primary to-secondary rounded-[32px] text-white shadow-xl shadow-primary/20 group cursor-pointer hover:-translate-y-1 transition-all">
                <div>
                    <h3 class="text-2xl font-black font-heading italic">¡No te quedes fuera!</h3>
                    <p class="text-sm font-bold opacity-80">Entradas limitadas para la categoría Pista</p>
                </div>
                <a href="{{ route('public.buy-ticket') }}" class="bg-white text-text-main px-8 py-4 rounded-2xl font-black shadow-lg hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                    Comprar entradas
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
            @endif

            <!-- Solicitar participación (Visible only to Artistas) -->
            @if(auth()->check() && auth()->user()->tipo_usuario === 'artista')
            <div class="flex items-center justify-between p-8 bg-gradient-to-r from-secondary to-accent rounded-[32px] text-white shadow-xl shadow-secondary/20 group cursor-pointer hover:-translate-y-1 transition-all">
                <div>
                    <h3 class="text-2xl font-black font-heading italic">¿Quieres actuar aquí?</h3>
                    <p class="text-sm font-bold opacity-80">Envía tu propuesta al ayuntamiento para este evento</p>
                </div>
                <button class="bg-white text-text-main px-8 py-4 rounded-2xl font-black shadow-lg hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                    Solicitar participación
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                </button>
            </div>
            @endif

            <!-- Description -->
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-10 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-accent rounded-full"></div>
                    <h3 class="text-2xl font-bold text-text-main font-heading">Descripción</h3>
                </div>
                <div class="text-text-secondary leading-relaxed space-y-4">
                    {!! nl2br(e($evento->descripcion)) !!}
                </div>
            </div>

            <!-- Map Location -->
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden group">
                <div class="p-10 border-b border-gray-50 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="h-8 w-1.5 bg-primary rounded-full"></div>
                        <h3 class="text-2xl font-bold text-text-main font-heading">Ubicación</h3>
                    </div>
                </div>
                <!-- Placeholder for Map -->
                <div class="h-80 bg-gray-100 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/-3.688,40.436,13,0/800x400?access_token=YOUR_TOKEN')] bg-cover bg-center grayscale group-hover:grayscale-0 transition-all duration-700"></div>
                    <div class="relative z-10 bg-white/90 backdrop-blur p-6 rounded-3xl shadow-xl border border-gray-100 flex flex-col items-center">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white shadow-lg mb-3 animate-bounce">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </div>
                        <span class="font-bold text-text-main">{{ $evento->localidad }}</span>
                        <span class="text-xs text-text-secondary italic">{{ $evento->provincia }}</span>
                    </div>
                </div>
            </div>

            <!-- Organizer Info -->
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-10 flex items-center gap-8 group hover:border-secondary/30 transition-all">
                <div class="w-20 h-20 rounded-2xl bg-secondary/10 flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">🏛️</div>
                <div class="flex-1">
                    <h4 class="text-xl font-bold text-text-main font-heading mb-1">Organizado por {{ $evento->ayuntamiento->nombre_institucion }}</h4>
                    <p class="text-sm text-text-secondary leading-relaxed">Ayuntamiento comprometido con la cultura en {{ $evento->localidad }}, {{ $evento->provincia }}.</p>
                </div>
                <a href="{{ route('public.town-hall-profile', ['id' => $evento->id_ayuntamiento]) }}" class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-bold text-text-main hover:bg-gray-50 transition-colors">Ver perfil</a>
            </div>

            <!-- Artists Participating -->
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-10 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-secondary rounded-full"></div>
                    <h3 class="text-2xl font-bold text-text-main font-heading">Artistas Participantes</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach([
                        ['name' => 'Los Rockeros', 'genre' => 'Rock', 'id' => 1],
                        ['name' => 'DJ Spark', 'genre' => 'Electrónica', 'id' => 2],
                        ['name' => 'Voz de Angel', 'genre' => 'Pop', 'id' => 3]
                    ] as $artist)
                    <a href="{{ route('public.artist-profile', ['id' => $artist['id']]) }}" class="flex items-center gap-4 p-5 bg-gray-50 border border-gray-100 rounded-2xl hover:bg-white hover:shadow-lg hover:-translate-y-1 transition-all group">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-secondary/10 to-accent/10 flex items-center justify-center text-secondary font-bold text-xl group-hover:scale-110 transition-transform">
                            {{ substr($artist['name'], 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-text-main group-hover:text-secondary transition-colors">{{ $artist['name'] }}</h4>
                            <p class="text-xs text-text-secondary">{{ $artist['genre'] }}</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-secondary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Section: Chat IA -->
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-[40px] shadow-sm border border-gray-100 p-8 h-[calc(100vh-160px)] sticky top-10 flex flex-col">
                <div class="mb-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-primary text-xl">✨</div>
                    <div>
                        <h3 class="text-lg font-bold text-text-main font-heading">Eventia AI Chat</h3>
                        <p class="text-[10px] uppercase font-bold text-primary tracking-widest">Experto en este evento</p>
                    </div>
                </div>

                <!-- Chat Display (Mock) -->
                <div class="flex-1 space-y-4 overflow-y-auto pr-2 custom-scrollbar mb-6">
                    <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-text-main italic">
                        ¡Hola! Soy el asistente de Eventia. ¿Tienes alguna duda sobre el **Summer Indie Festival**? Puedo informarte sobre horarios, accesos, transporte o el cartel.
                    </div>
                    <div class="bg-primary/10 p-4 rounded-2xl rounded-tr-none text-sm text-text-main text-right font-medium">
                        ¿Hay opciones de comida vegana en el recinto?
                    </div>
                    <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-text-main leading-relaxed">
                        ¡Sí! El recinto contará con un **Gastro-Space** con más de 12 food trucks, incluyendo 3 opciones 100% veganas y platos sin gluten. 🥗
                    </div>
                </div>

                <!-- Input area -->
                <div class="relative">
                    <input type="text" 
                        class="w-full pl-5 pr-12 py-4 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm italic text-sm" 
                        placeholder="Pregunta lo que sea...">
                    <button class="absolute inset-y-2 right-2 px-3 bg-text-main text-white rounded-xl shadow-lg hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                    </button>
                </div>
            </div>
            
            @if(!auth()->check() || auth()->user()->tipo_usuario === 'publico')
            <div class="bg-white rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-lg">
                <div class="flex items-center gap-4">
                    <span class="text-lg font-black text-primary">{{ number_format($evento->precio, 2) }}€</span>
                    <span class="text-xs text-text-secondary font-bold">Precio Entrada</span>
                </div>
                <div class="h-6 w-px bg-gray-100"></div>
                <div class="text-sm font-black text-secondary">Agotándose</div>
            </div>
            @endif

            @if(auth()->check() && auth()->user()->tipo_usuario === 'artista')
            <div class="bg-white rounded-3xl p-6 border border-secondary/30 flex flex-col gap-4 transition-all hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-black text-secondary">Solicitud</span>
                    <span class="px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold rounded-full uppercase">Abierto</span>
                </div>
                <button class="w-full py-4 bg-secondary text-white rounded-2xl font-black shadow-lg hover:bg-secondary-dark transition-all">
                    Enviar propuesta
                </button>
            </div>
            @endif
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
