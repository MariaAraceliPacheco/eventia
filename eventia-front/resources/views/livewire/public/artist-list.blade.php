<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-16 space-y-4">
        <h1 class="text-5xl font-black font-heading text-text-main tracking-tight italic">Descubre el <span
                class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-accent">Talento</span></h1>
        <p class="text-lg text-text-secondary max-w-2xl mx-auto">Conoce a los artistas y bandas que dan vida a nuestras
            ciudades. Explora sus trayectorias y colaboraciones oficiales.</p>
        <div class="flex justify-center pt-4">
            <div class="h-1.5 w-32 bg-gradient-to-r from-secondary via-accent to-primary rounded-full"></div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="max-w-3xl mx-auto mb-16 px-4">
        <div class="relative group">
            <input type="text" wire:model.live="search"
                class="w-full pl-14 pr-4 py-5 bg-white border border-gray-100 rounded-[30px] shadow-sm focus:ring-4 focus:ring-secondary/10 focus:border-secondary focus:shadow-xl outline-none transition-all text-lg font-medium"
                placeholder="Busca por nombre, género o estilo...">
            <div
                class="absolute inset-y-0 left-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-secondary transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Artist Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        @foreach($artists as $artist)
            <div
                class="group relative bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-{{ $artist['color'] }}/10 hover:-translate-y-2 transition-all duration-500">
                <!-- Decorative Background Accent -->
                <div
                    class="absolute top-0 right-0 w-40 h-40 bg-{{ $artist['color'] }}/5 rounded-full -mr-20 -mt-20 transition-transform group-hover:scale-125">
                </div>

                <div class="p-10">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 relative">
                        <!-- Avatar / Image -->
                        <div
                            class="w-28 h-28 rounded-3xl bg-gradient-to-br from-{{ $artist['color'] }} to-{{ $artist['color'] === 'secondary' ? 'accent' : 'secondary' }} p-1.5 flex-shrink-0 shadow-xl shadow-{{ $artist['color'] }}/20">
                            <div
                                class="w-full h-full rounded-[20px] bg-white flex items-center justify-center text-4xl group-hover:scale-110 transition-transform duration-300">
                                @if($artist['image'])
                                    <img src="{{ asset('profiles/artistas/' . $artist['image']) }}"
                                        class="w-full h-full object-cover rounded-2xl">
                                @else
                                    <span class="text-xl">🎤</span>
                                @endif
                            </div>
                        </div>

                        <!-- Main Info -->
                        <div class="flex-1 text-center sm:text-left space-y-3">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 justify-center sm:justify-start">
                                <h2
                                    class="text-3xl font-black font-heading text-text-main tracking-tight group-hover:text-{{ $artist['color'] }} transition-colors">
                                    {{ $artist['name'] }}</h2>
                                <span
                                    class="px-3 py-1 bg-{{ $artist['color'] }}/10 text-[10px] font-bold text-{{ $artist['color'] }} rounded-full uppercase tracking-widest inline-block self-center sm:self-auto">Pro</span>
                            </div>
                            <p class="text-sm font-bold text-{{ $artist['color'] }} italic">{{ $artist['genre'] }}</p>
                            <p class="text-sm text-text-secondary leading-relaxed">{{ $artist['description'] }}</p>
                        </div>
                    </div>

                    <!-- Footer Stats & Links -->
                    <div class="mt-10 grid grid-cols-2 gap-6 pt-8 border-t border-gray-50">
                        <div class="space-y-3">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-text-secondary">Presentaciones
                            </h3>
                            <div class="flex flex-col gap-2">
                                @foreach(array_slice($artist['events'], 0, 2) as $event)
                                    <div
                                        class="flex items-center gap-2 text-xs font-bold text-text-main group-hover:text-{{ $artist['color'] }} transition-colors">
                                        <span class="w-1.5 h-1.5 bg-{{ $artist['color'] }} rounded-full"></span>
                                        {{ $event }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-text-secondary">Colaboraciones
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($artist['town_halls'] as $th)
                                    <span
                                        class="px-2.5 py-1 bg-gray-50 text-[10px] font-bold text-text-main rounded-md border border-gray-100 group-hover:bg-white transition-colors">🏛️
                                        {{ $th }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Profile Button -->
                    <div class="mt-8">
                        <a href="{{ route('public.artist-profile', ['id' => $artist['id']]) }}"
                            class="w-full py-4 inline-flex items-center justify-center gap-3 bg-{{ $artist['color'] === 'secondary' ? 'text-main' : 'gray-50' }} {{ $artist['color'] === 'secondary' ? 'text-white' : 'text-text-main' }} font-black rounded-2xl shadow-lg hover:scale-[1.02] active:scale-95 transition-all group/btn">
                            <span>Ver Perfil de Artista</span>
                            <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- CTA Section -->
    <div
        class="mt-20 relative rounded-[50px] p-1 shadow-2xl overflow-hidden bg-gradient-to-r from-secondary via-accent to-primary animate-gradient-x">
        <div class="bg-text-main rounded-[49px] p-12 sm:p-20 text-center text-white relative overflow-hidden">
            <div
                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=2070')] bg-cover bg-center opacity-10 mix-blend-overlay">
            </div>

            <div class="relative z-10 max-w-3xl mx-auto space-y-6">
                <h2 class="text-3xl sm:text-5xl font-black font-heading tracking-tighter italic">¿Eres un artista o
                    banda?</h2>
                <p class="text-gray-400 text-lg sm:text-xl">Forma parte del catálogo más exclusivo y conecta con
                    ayuntamientos de todo el país.</p>
                <div class="pt-8">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-3 bg-white text-text-main font-black px-12 py-5 rounded-2xl shadow-xl hover:scale-105 hover:shadow-secondary/20 transition-all group">
                        Crear Perfil Artista
                        <svg class="w-6 h-6 text-secondary group-hover:rotate-12 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes gradient-x {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 6s ease infinite;
        }
    </style>
</div>