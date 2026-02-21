<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header: Event Hero -->
    <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden border border-gray-100/50 relative mb-10">
        <div class="relative h-80 overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-tr from-text-main to-secondary opacity-90"></div>
            <div
                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1459749411177-042180ce673c?q=80&w=2070')] bg-cover bg-center mix-blend-overlay blur-[2px]">
            </div>

            <div class="relative h-full px-10 flex flex-col justify-center text-white">
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="w-48 h-48 rounded-3xl bg-white/10 backdrop-blur-md p-2 shadow-2xl flex-shrink-0">
                        <div
                            class="w-full h-full rounded-2xl bg-white flex items-center justify-center text-5xl overflow-hidden">
                            @if($evento->foto)
                                <img src="{{ asset('storage/profiles/eventos/' . $evento->foto) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/profiles/ayuntamientos/' . $evento->ayuntamiento->imagen) }}"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>

                    <div class="flex-1 space-y-4 text-center md:text-left">
                        <div class="flex flex-wrap items-center gap-2 justify-center md:justify-start">
                            <span
                                class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-[10px] font-black uppercase tracking-widest text-secondary">Evento
                                Destacado</span>
                            <a href="{{ route('public.area') }}"
                                class="text-xs font-bold text-white/80 hover:text-white transition-colors underline decoration-secondary/50">Ver
                                más conciertos</a>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black font-heading tracking-tight leading-tight">
                            {{ $evento->nombre_evento }}</h1>

                        <div class="flex flex-wrap items-center gap-6 justify-center md:justify-start">
                            <div class="flex items-center gap-2">
                                <span class="p-2 bg-white/10 rounded-xl"><svg class="w-5 h-5 text-secondary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg></span>
                                <span class="font-bold text-sm">{{ $evento->localidad }},
                                    {{ $evento->provincia }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="p-2 bg-white/10 rounded-xl"><svg class="w-5 h-5 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg></span>
                                <span
                                    class="font-bold text-sm">{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y • H:i\h') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-8 right-8 flex flex-col items-center gap-2">
                        <button
                            class="p-4 bg-white/10 backdrop-blur-md rounded-2xl text-white hover:bg-secondary transition-all group/btn">
                            <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
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
                @if($evento->estado === 'AGOTADO')
                    <div
                        class="flex items-center justify-between p-8 bg-gradient-to-r from-red-500 to-red-600 rounded-[32px] text-white shadow-xl shadow-red-500/20 group transition-all">
                        <div>
                            <h3 class="text-2xl font-black font-heading italic">¡Entradas agotadas!</h3>
                            <p class="text-sm font-bold opacity-80">Este evento ya no tiene entradas disponibles.</p>
                        </div>
                        <div
                            class="bg-white/20 text-white px-8 py-4 rounded-2xl font-black shadow-lg flex items-center gap-3 cursor-not-allowed">
                            Agotado
                        </div>
                    </div>
                @else
                    <div
                        class="flex items-center justify-between p-8 bg-gradient-to-r from-primary to-secondary rounded-[32px] text-white shadow-xl shadow-primary/20 group cursor-pointer hover:-translate-y-1 transition-all">
                        <div>
                            <h3 class="text-2xl font-black font-heading italic">¡No te quedes fuera!</h3>
                            <p class="text-sm font-bold opacity-80">Entradas limitadas para la categoría Pista</p>
                        </div>
                        <a href="{{ route('public.buy-ticket', ['eventId' => $evento->id]) }}"
                            class="bg-white text-text-main px-8 py-4 rounded-2xl font-black shadow-lg hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                            Comprar entradas
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                @endif
            @endif

            <!-- Solicitar participación (Visible only to Artistas) -->
            @if(auth()->check() && auth()->user()->tipo_usuario === 'artista')
                @if($solicitudPendiente)
                    <div
                        class="flex items-center justify-between p-8 rounded-[32px] shadow-xl transition-all border
                        {{ $solicitudPendiente->estado === 'pendiente' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-amber-500/20 border-amber-400/20' : '' }}
                        {{ $solicitudPendiente->estado === 'aceptada' ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-green-500/20 border-green-400/20' : '' }}
                        {{ $solicitudPendiente->estado === 'rechazada' ? 'bg-gradient-to-r from-red-500 to-red-600 text-white shadow-red-500/20 border-red-400/20' : '' }}">
                        <div>
                            <h3 class="text-2xl font-black font-heading italic">
                                @if($solicitudPendiente->estado === 'pendiente')
                                    Propuesta en revisión
                                @elseif($solicitudPendiente->estado === 'aceptada')
                                    ¡Propuesta aceptada!
                                @else
                                    Propuesta rechazada
                                @endif
                            </h3>
                            <p class="text-sm font-bold opacity-80">
                                @if($solicitudPendiente->estado === 'pendiente')
                                    El ayuntamiento está revisando tu propuesta para este evento.
                                @elseif($solicitudPendiente->estado === 'aceptada')
                                    ¡Felicidades! Has sido confirmado para actuar en este evento.
                                @else
                                    Lo sentimos, tu propuesta no ha sido seleccionada en esta ocasión.
                                @endif
                            </p>
                        </div>
                        <div class="bg-white/20 text-white px-8 py-4 rounded-2xl font-black shadow-lg flex items-center gap-3 backdrop-blur-sm border border-white/10">
                            @if($solicitudPendiente->estado === 'pendiente')
                                <svg class="w-5 h-5 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Enviada
                            @elseif($solicitudPendiente->estado === 'aceptada')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Confirmado
                            @else
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Finalizada
                            @endif
                        </div>
                    </div>
                @else
                    <div
                        class="flex items-center justify-between p-8 bg-gradient-to-r from-secondary to-accent rounded-[32px] text-white shadow-xl shadow-secondary/20 group cursor-pointer hover:-translate-y-1 transition-all">
                        <div>
                            <h3 class="text-2xl font-black font-heading italic">¿Quieres actuar aquí?</h3>
                            <p class="text-sm font-bold opacity-80">Envía tu propuesta al ayuntamiento para este evento</p>
                        </div>
                        <button wire:click="solicitarEvento"
                            class="cursor-pointer bg-white text-text-main px-8 py-4 rounded-2xl font-black shadow-lg hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                            Solicitar participación
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                @endif
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
                    <div class="flex items-center gap-2 text-sm text-text-secondary">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        <span class="font-bold">{{ $evento->localidad }}, {{ $evento->provincia }}</span>
                    </div>
                </div>
                <!-- Google Maps Embed -->
                <div class="h-96 relative overflow-hidden">
                    <iframe width="100%" height="100%" frameborder="0" style="border:0"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8&q={{ urlencode($evento->localidad . ', ' . $evento->provincia . ', España') }}&zoom=14"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Organizer Info -->
            <div
                class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-10 flex items-center gap-8 group hover:border-secondary/30 transition-all">
                <div
                    class="w-20 h-20 rounded-2xl bg-secondary/10 flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                    🏛️</div>
                <div class="flex-1">
                    <h4 class="text-xl font-bold text-text-main font-heading mb-1">Organizado por
                        {{ $evento->ayuntamiento->nombre_institucion }}</h4>
                    <p class="text-sm text-text-secondary leading-relaxed">Ayuntamiento comprometido con la cultura en
                        {{ $evento->localidad }}, {{ $evento->provincia }}.</p>
                </div>
                <a href="{{ route('public.town-hall-profile', ['id' => $evento->id_ayuntamiento]) }}"
                    class="px-6 py-3 border border-gray-200 rounded-xl text-sm font-bold text-text-main hover:bg-gray-50 transition-colors">Ver
                    perfil</a>
            </div>

            <!-- Artists Participating -->
            <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-10 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-secondary rounded-full"></div>
                    <h3 class="text-2xl font-bold text-text-main font-heading">Artistas Participantes</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($evento->artistas as $artist)
                        <a href="{{ route('public.artist-profile', ['id' => $artist->id]) }}"
                            class="flex items-center gap-4 p-5 bg-gray-50 border border-gray-100 rounded-2xl hover:bg-white hover:shadow-lg hover:-translate-y-1 transition-all group">
                            <div
                                class="w-14 h-14 rounded-xl bg-gradient-to-br from-secondary/10 to-accent/10 flex items-center justify-center overflow-hidden group-hover:scale-110 transition-transform shadow-sm">
                                @if($artist->img_logo)
                                    <img src="{{ asset('storage/profiles/artistas/' . $artist->img_logo) }}" class="w-full h-full object-cover">
                                @else
                                    <span
                                        class="text-secondary font-black text-xl uppercase">{{ substr($artist->nombre_artistico, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="flex-1 text-left">
                                <h4 class="text-sm font-black text-text-main group-hover:text-secondary transition-colors">
                                    {{ $artist->nombre_artistico }}</h4>
                                <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest">
                                    {{ $artist->genero_musical }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-secondary transition-colors" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    @empty
                        <div
                            class="col-span-2 py-8 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                            <p class="text-sm font-bold text-text-secondary italic">Por ahora no se han confirmado artistas
                                invitados.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Section: Chat IA -->
        <div class="space-y-6">
            <div
                class="bg-gray-50 rounded-[40px] shadow-sm border border-gray-100 p-8 h-[calc(100vh-160px)] sticky top-10 flex flex-col">
                <div class="mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-primary text-xl">
                        ✨</div>
                    <div>
                        <h3 class="text-lg font-bold text-text-main font-heading">Eventia AI Chat</h3>
                        <p class="text-[10px] uppercase font-bold text-primary tracking-widest">Experto en este evento
                        </p>
                    </div>
                </div>

                <!-- Chat Display -->
                <div class="flex-1 space-y-4 overflow-y-auto pr-2 custom-scrollbar mb-6" id="chat-container">
                    @foreach($messages as $message)
                        @if($message['role'] === 'assistant')
                            <div
                                class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-text-main">
                                {!! nl2br(e($message['content'])) !!}
                            </div>
                        @else
                            <div class="bg-primary text-white p-4 rounded-2xl rounded-tr-none text-sm font-medium ml-8">
                                {{ $message['content'] }}
                            </div>
                        @endif
                    @endforeach
                    <div wire:loading wire:target="sendMessage">
                        <div
                            class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-text-main flex items-center gap-2">
                            <span class="flex gap-1">
                                <span class="w-1.5 h-1.5 bg-primary/40 rounded-full animate-bounce"></span>
                                <span
                                    class="w-1.5 h-1.5 bg-primary/40 rounded-full animate-bounce [animation-delay:0.2s]"></span>
                                <span
                                    class="w-1.5 h-1.5 bg-primary/40 rounded-full animate-bounce [animation-delay:0.4s]"></span>
                            </span>
                            <span class="text-xs font-bold text-text-secondary">Escribiendo...</span>
                        </div>
                    </div>
                </div>

                <!-- Input area -->
                <form wire:submit.prevent="sendMessage" class="relative">
                    <input type="text" wire:model="userInput"
                        class="w-full pl-5 pr-12 py-4 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all shadow-sm italic text-sm"
                        placeholder="Pregunta lo que sea...">
                    <button type="submit"
                        class="cursor-pointer absolute inset-y-2 right-2 px-3 bg-text-main text-white rounded-xl shadow-lg hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>

                <div class="space-y-4 mt-6">
                    @if(!auth()->check() || auth()->user()->tipo_usuario === 'publico')
                        <div
                            class="bg-white rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-lg shadow-sm">
                            <div class="flex items-center gap-4">
                                @if($evento->tipos_entrada && count($evento->tipos_entrada) > 0)
                                    @php $minPrice = collect($evento->tipos_entrada)->min('precio'); @endphp
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs text-text-secondary font-bold uppercase tracking-widest">Desde</span>
                                        <span class="text-lg font-black text-primary">{{ number_format($minPrice, 2) }}€</span>
                                    </div>
                                @else
                                    <span
                                        class="text-lg font-black text-primary">{{ number_format($evento->precio, 2) }}€</span>
                                @endif
                                <span class="text-xs text-text-secondary font-bold">Precio Entrada</span>
                            </div>
                            <div class="h-6 w-px bg-gray-100"></div>
                            <div class="text-sm font-black text-secondary">Habilitadas</div>
                        </div>
                    @endif

                    @if(auth()->check() && auth()->user()->tipo_usuario === 'artista')
                        <div
                            class="bg-white rounded-3xl p-6 border border-secondary/30 flex flex-col gap-4 transition-all hover:shadow-lg shadow-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-black text-secondary">Solicitud</span>
                                <span
                                    class="px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold rounded-full uppercase">Abierto</span>
                            </div>
                            @if($solicitudPendiente)
                                <div
                                    class="w-full py-4 text-center rounded-2xl font-black shadow-sm transition-all
                                    {{ $solicitudPendiente->estado === 'pendiente' ? 'bg-amber-100 text-amber-700 border border-amber-200' : '' }}
                                    {{ $solicitudPendiente->estado === 'aceptada' ? 'bg-green-100 text-green-700 border border-green-200' : '' }}
                                    {{ $solicitudPendiente->estado === 'rechazada' ? 'bg-red-100 text-red-700 border border-red-200' : '' }}">
                                    @if($solicitudPendiente->estado === 'pendiente')
                                        Propuesta enviada
                                    @elseif($solicitudPendiente->estado === 'aceptada')
                                        ¡Propuesta aceptada!
                                    @else
                                        Propuesta rechazada
                                    @endif
                                </div>
                            @else
                                <button wire:click="solicitarEvento"
                                    class="w-full py-4 bg-secondary text-white rounded-2xl font-black shadow-lg hover:bg-secondary-dark transition-all">
                                    Enviar propuesta
                                </button>
                            @endif
                        </div>
                    @endif
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