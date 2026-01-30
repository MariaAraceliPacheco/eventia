<div class="space-y-24 pb-24">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-background via-white to-primary/10 pt-12 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8 animate-fade-in-up">
                    <h1 class="text-5xl lg:text-7xl font-bold font-heading leading-tight text-text-main">
                        La revolución de los <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">eventos
                            locales</span>
                    </h1>
                    <p class="text-lg text-text-secondary max-w-xl leading-relaxed">
                        Conectamos ayuntamientos, artistas y público en una única plataforma.
                        Simplificamos la gestión, centralizamos la logística y mejoramos la experiencia para todos.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#events"
                            class="px-8 py-4 bg-primary text-white font-bold rounded-full shadow-lg hover:shadow-xl hover:bg-primary/90 transition transform hover:-translate-y-1">
                            Explorar Eventos
                        </a>
                        <a href="#pricing"
                            class="px-8 py-4 bg-white text-secondary font-bold border-2 border-secondary/20 rounded-full hover:border-secondary hover:bg-secondary/5 transition">
                            Ver Planes
                        </a>
                    </div>
                </div>

                <!-- Hero Images / Visuals -->
                <div class="relative hidden lg:block">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4 translate-y-12">
                            <div
                                class="h-64 rounded-2xl overflow-hidden shadow-xl transform rotate-3 hover:rotate-0 transition duration-500">
                                <img src="{{ asset('images/hero-1.png') }}" alt="Concierto"
                                    class="w-full h-full object-cover">
                            </div>
                            <div
                                class="h-48 rounded-2xl overflow-hidden shadow-xl transform -rotate-2 hover:rotate-0 transition duration-500">
                                <img src="{{ asset('images/hero-2.png') }}" alt="Festival"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div
                                class="h-48 rounded-2xl overflow-hidden shadow-xl transform -rotate-3 hover:rotate-0 transition duration-500">
                                <img src="{{ asset('images/hero-3.png') }}" alt="Público"
                                    class="w-full h-full object-cover">
                            </div>
                            <div
                                class="h-64 rounded-2xl overflow-hidden shadow-xl transform rotate-2 hover:rotate-0 transition duration-500">
                                <img src="{{ asset('images/hero-4.png') }}" alt="Escenario"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <!-- Decor elements -->
                    <div class="absolute -z-10 top-0 right-0 w-72 h-72 bg-accent/20 rounded-full blur-3xl"></div>
                    <div class="absolute -z-10 bottom-0 left-0 w-72 h-72 bg-primary/20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section id="events" class="bg-surface py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold font-heading mb-2">Eventos Destacados</h2>
                    <p class="text-text-secondary">Descubre los mejores conciertos y festivales cerca de ti.</p>
                </div>
                <a href="#" class="hidden md:flex items-center text-primary font-medium hover:underline">
                    Ver todos <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Event Card 1 -->
                <div
                    class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition group border border-gray-100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/featured-jazz.png') }}" alt="Jazz Festival"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                            25€
                        </div>
                        <div
                            class="absolute bottom-4 left-4 bg-black/50 backdrop-blur-md text-white px-3 py-1 rounded-lg text-sm font-medium border border-white/20">
                            12 Ago - Jazz Night
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold tracking-wider text-accent uppercase">Música</span>
                            <div class="flex items-center text-text-secondary text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                Madrid, España
                            </div>
                        </div>
                        <h3 class="text-xl font-bold font-heading mb-3 group-hover:text-primary transition">Noches de
                            Jazz en el Parque</h3>
                        <p class="text-text-secondary text-sm mb-6 line-clamp-2">Disfruta de una velada inolvidable con
                            los mejores artistas de jazz nacional e internacional al aire libre.</p>
                        <button
                            class="w-full py-3 bg-gray-50 text-text-main font-bold rounded-xl hover:bg-primary hover:text-white transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v4.5c0 .621.504 1.125 1.125 1.125h4.5c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375Zm0 13.5c-.621 0-1.125.504-1.125 1.125v4.5c0 .621.504 1.125 1.125 1.125h4.5c.621 0 1.125-.504 1.125-1.125v-4.5c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                            </svg>
                            Comprar Entradas
                        </button>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div
                    class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition group border border-gray-100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/featured-indie.png') }}" alt="Indie Festival"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                            45€
                        </div>
                        <div
                            class="absolute bottom-4 left-4 bg-black/50 backdrop-blur-md text-white px-3 py-1 rounded-lg text-sm font-medium border border-white/20">
                            15 Sep - Indie Fest
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold tracking-wider text-accent uppercase">Festival</span>
                            <div class="flex items-center text-text-secondary text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                Barcelona, España
                            </div>
                        </div>
                        <h3 class="text-xl font-bold font-heading mb-3 group-hover:text-primary transition">Indie Summer
                            Fest 2026</h3>
                        <p class="text-text-secondary text-sm mb-6 line-clamp-2">El festival alternativo más esperado
                            del año. 3 días de música, arte y gastronomía junto al mar.</p>
                        <button
                            class="w-full py-3 bg-gray-50 text-text-main font-bold rounded-xl hover:bg-primary hover:text-white transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v4.5c0 .621.504 1.125 1.125 1.125h4.5c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375Zm0 13.5c-.621 0-1.125.504-1.125 1.125v4.5c0 .621.504 1.125 1.125 1.125h4.5c.621 0 1.125-.504 1.125-1.125v-4.5c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                            </svg>
                            Comprar Entradas
                        </button>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div
                    class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition group border border-gray-100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/hero-1.png') }}" alt="Rock Concert"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                            30€
                        </div>
                        <div
                            class="absolute bottom-4 left-4 bg-black/50 backdrop-blur-md text-white px-3 py-1 rounded-lg text-sm font-medium border border-white/20">
                            22 Oct - Rock Live
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold tracking-wider text-accent uppercase">Rock</span>
                            <div class="flex items-center text-text-secondary text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                Valencia, España
                            </div>
                        </div>
                        <h3 class="text-xl font-bold font-heading mb-3 group-hover:text-primary transition">Thunder Rock
                            Night</h3>
                        <p class="text-text-secondary text-sm mb-6 line-clamp-2">La noche de rock más potente de la
                            ciudad. Bandas locales y gran cierre con artistas invitados.</p>
                        <button
                            class="w-full py-3 bg-gray-50 text-text-main font-bold rounded-xl hover:bg-primary hover:text-white transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v4.5c0 .621.504 1.125 1.125 1.125h4.5c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375Zm0 13.5c-.621 0-1.125.504-1.125 1.125v4.5c0 .621.504 1.125 1.125 1.125h4.5c.621 0 1.125-.504 1.125-1.125v-4.5c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                            </svg>
                            Comprar Entradas
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="bg-primary/5 py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold font-heading mb-4">Planes para todos</h2>
                <p class="text-text-secondary max-w-2xl mx-auto">Tanto si eres artista, organizador o simplemente te
                    encanta la música, tenemos un plan adaptado a ti.</p>

                <!-- Pricing Toggles -->
                <div
                    class="mt-8 inline-grid grid-cols-3 min-w-[340px] bg-white rounded-full p-1 shadow-md border border-gray-100 relative">
                    <div class="w-full absolute inset-1 pointer-events-none">
                        <div class="h-full rounded-full transition-all duration-300 ease-in-out opacity-20 w-1/3 absolute left-0"
                            :class="{
                                'translate-x-[0%] bg-primary': $wire.selectedPlan === 'publico',
                                'translate-x-[100%] bg-secondary': $wire.selectedPlan === 'artistas',
                                'translate-x-[195%] bg-accent': $wire.selectedPlan === 'ayuntamientos'
                             }">
                        </div>
                    </div>

                    <button wire:click="setPlan('publico')"
                        class="w-full px-4 py-2 rounded-full text-sm font-bold transition relative z-10 {{ $selectedPlan === 'publico' ? 'text-primary' : 'text-text-secondary hover:text-text-main' }}">
                        Público
                    </button>
                    <button wire:click="setPlan('artistas')"
                        class="w-full px-4 py-2 rounded-full text-sm font-bold transition relative z-10 {{ $selectedPlan === 'artistas' ? 'text-primary' : 'text-text-secondary hover:text-text-main' }}">
                        Artistas
                    </button>
                    <button wire:click="setPlan('ayuntamientos')"
                        class="w-full px-4 py-2 rounded-full text-sm font-bold transition relative z-10 {{ $selectedPlan === 'ayuntamientos' ? 'text-accent' : 'text-text-secondary hover:text-text-main' }}">
                        Organizadores
                    </button>
                </div>
            </div>

            <!-- Pricing Cards Area -->
            <div class="grid md:grid-cols-3 gap-8">
                @if($selectedPlan === 'publico')
                    <!-- Público Plans -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col">
                        <h3 class="text-2xl font-bold font-heading mb-2">Gratis</h3>
                        <p class="text-text-secondary text-sm mb-6">Para disfrutar de eventos sin costes extra.</p>
                        <div class="text-4xl font-bold mb-6">0€</div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Compra de entradas
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Acceso a mapas y horarios
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition">Empezar
                            Gratis</button>
                    </div>

                    <div
                        class="bg-gradient-to-b from-primary/5 to-white p-8 rounded-3xl shadow-lg border-2 border-primary flex flex-col relative overflow-hidden">
                        <div class="absolute top-5 right-5 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">
                            RECOMENDADO</div>
                        <h3 class="text-2xl font-bold font-heading mb-2 text-primary">Fan Plus</h3>
                        <p class="text-text-secondary text-sm mb-6">Para los verdaderos amantes de la música.</p>
                        <div class="text-4xl font-bold mb-6">2.99€<span
                                class="text-sm font-medium text-text-secondary">/mes</span></div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Todo lo de Gratis
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Descuentos exclusivos
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Acceso anticipado a entradas
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Merchandising digital y VIP
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white font-bold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">Suscribirse</button>
                    </div>
                    <div
                        class="bg-white p-8 rounded-3xl opacity-50 pointer-events-none filter blur-[1px] select-none flex flex-col border border-gray-100 relative">
                        <div
                            class="absolute inset-0 flex items-center justify-center font-bold text-lg text-text-secondary bg-white/50 backdrop-blur-sm z-10">
                            Próximamente
                        </div>
                        <h3 class="text-2xl font-bold font-heading mb-2">Ultra Fan</h3>
                        <p class="text-text-secondary text-sm mb-6">Experiencias ilimitadas.</p>
                        <div class="text-4xl font-bold mb-6">9.99€<span
                                class="text-sm font-medium text-text-secondary">/mes</span></div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                --
                            </li>
                        </ul>
                        <button class="w-full py-3 bg-gray-100 text-gray-400 font-bold rounded-xl">No disponible</button>
                    </div>

                @elseif($selectedPlan === 'artistas')
                    <!-- Artistas Plans -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col">
                        <h3 class="text-2xl font-bold font-heading mb-2">Básico</h3>
                        <p class="text-text-secondary text-sm mb-6">Inicia tu carrera musical.</p>
                        <div class="text-4xl font-bold mb-6">Gratis</div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Perfil público
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Acceso a ofertas limitadas
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Contacto básico
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition">Registrarse</button>
                    </div>

                    <div
                        class="bg-gradient-to-b from-secondary/5 to-white p-8 rounded-3xl shadow-lg border-2 border-secondary flex flex-col relative">
                        <div
                            class="absolute top-5 right-5 bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full">
                            POPULAR</div>
                        <h3 class="text-2xl font-bold font-heading mb-2 text-secondary">Premium</h3>
                        <p class="text-text-secondary text-sm mb-6">Impulsa tu visibilidad.</p>
                        <div class="text-4xl font-bold mb-6">19.99€<span
                                class="text-sm font-medium text-text-secondary">/mes</span></div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Perfil destacado
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Estadísticas avanzadas
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Gestión de contratos online
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Prioridad en matching
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 bg-secondary text-white font-bold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">Mejorar
                            Perfil</button>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col">
                        <h3 class="text-2xl font-bold font-heading mb-2">Pro</h3>
                        <p class="text-text-secondary text-sm mb-6">Gestión integral de tu carrera.</p>
                        <div class="text-4xl font-bold mb-6">49.99€<span
                                class="text-sm font-medium text-text-secondary">/mes</span></div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Plan Premium incluido
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Asesoría legal/fiscal
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Campañas promocionales
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Herramientas de marketing
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 border-2 border-secondary text-secondary font-bold rounded-xl hover:bg-secondary hover:text-white transition">Contratar
                            Pro</button>
                    </div>

                @elseif($selectedPlan === 'ayuntamientos')
                    <!-- Ayuntamientos Plans -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col">
                        <h3 class="text-2xl font-bold font-heading mb-2">Básico</h3>
                        <p class="text-text-secondary text-sm mb-6">Gestión simple para eventos pequeños.</p>
                        <div class="text-4xl font-bold mb-6">Gratis</div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Publicación de eventos
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Contratación limitada
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Logística básica
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 border-2 border-accent text-accent font-bold rounded-xl hover:bg-accent hover:text-white transition">Comenzar</button>
                    </div>

                    <div
                        class="bg-gradient-to-b from-accent/5 to-white p-8 rounded-3xl shadow-lg border-2 border-accent flex flex-col relative">
                        <div class="absolute top-5 right-5 bg-accent text-white text-xs font-bold px-3 py-1 rounded-full">
                            EFICIENTE</div>
                        <h3 class="text-2xl font-bold font-heading mb-2 text-accent">Avanzado</h3>
                        <p class="text-text-secondary text-sm mb-6">Para ayuntamientos activos.</p>
                        <div class="text-4xl font-bold mb-6">Consultar</div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Marketplace de logística
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Panel de métricas
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Venta de entradas integrada
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 bg-accent text-white font-bold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition">Contactar
                            Ventas</button>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col">
                        <h3 class="text-2xl font-bold font-heading mb-2">Enterprise</h3>
                        <p class="text-text-secondary text-sm mb-6">Gestión masiva y personalizada.</p>
                        <div class="text-4xl font-bold mb-6">A medida</div>
                        <ul class="space-y-4 mb-8 flex-1">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Gestión multi-evento
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Soporte dedicado
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Integraciones (Ticketing, ERP)
                            </li>
                        </ul>
                        <button
                            class="w-full py-3 border-2 border-accent text-accent font-bold rounded-xl hover:bg-accent hover:text-white transition">Agendar
                            Demo</button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-surface py-24 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold font-heading mb-4">Preguntas Frecuentes</h2>
                <p class="text-text-secondary">Resolvemos tus dudas sobre Eventia.</p>
            </div>

            <div class="space-y-4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition"
                    x-data="{ open: false }" @click="open = !open">
                    <div class="flex justify-between items-center">
                        <h4 class="font-bold font-heading text-lg">¿Cómo funciona el pago de entradas?</h4>
                        <svg class="w-5 h-5 text-text-secondary transform transition-transform"
                            :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <div x-show="open" class="mt-4 text-text-secondary text-sm leading-relaxed" x-collapse>
                        Utilizamos pasarelas de pago seguras y sistema cashless para garantizar transacciones rápidas y
                        protegidas.
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition"
                    x-data="{ open: false }" @click="open = !open">
                    <div class="flex justify-between items-center">
                        <h4 class="font-bold font-heading text-lg">¿Puedo cancelar mi plan de suscripción?</h4>
                        <svg class="w-5 h-5 text-text-secondary transform transition-transform"
                            :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <div x-show="open" class="mt-4 text-text-secondary text-sm leading-relaxed" x-collapse>
                        Sí, puedes cancelar o cambiar tu plan en cualquier momento desde tu panel de usuario sin
                        penalizaciones.
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition"
                    x-data="{ open: false }" @click="open = !open">
                    <div class="flex justify-between items-center">
                        <h4 class="font-bold font-heading text-lg">¿Qué requisitos necesito para registrarme como
                            artista?</h4>
                        <svg class="w-5 h-5 text-text-secondary transform transition-transform"
                            :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <div x-show="open" class="mt-4 text-text-secondary text-sm leading-relaxed" x-collapse>
                        Solo necesitas verificar tu identidad y proporcionar una muestra de tu trabajo o perfil
                        artístico.
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>