<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

    <!-- Welcome Section -->
    <div class="mb-10">
        <h1 class="text-3xl font-bold font-heading text-text-main mb-2">Panel de Control</h1>
        <p class="text-text-secondary">Gestiona los artistas, ayuntamientos y eventos de la plataforma.</p>
    </div>

    <!-- Selector de Vista (Optional/Status) -->
    <div class="mb-8 p-4 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-text-main">Global Admin Control</h2>
                <p class="text-xs text-text-secondary">Vista actual: Administrador</p>
            </div>
        </div>
        <div class="flex gap-2">
            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Sistema Activo</span>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">

        <!-- Section Choice Component (Template for each area) -->

        <!-- Area: Artistas -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div
                class="p-6 border-b border-gray-50 flex items-center justify-between bg-gradient-to-r from-primary/5 to-transparent">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-primary rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-text-main tracking-tight">Artistas</h3>
                </div>
                <button class="text-sm text-primary font-bold hover:underline">Ver todos</button>
            </div>

            <div class="p-6 flex-1">
                <div class="relative mb-6">
                    <input type="text" placeholder="Buscar artista..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Artistas -->
                <div class="space-y-4">
                    @foreach($artistas as $artista)
                        <div
                            class="group flex items-center justify-between p-3 rounded-2xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-200 to-gray-100 border-2 border-white shadow-sm overflow-hidden">
                                    <img style="border-radius: 50%; width: 100%; height: 100%; object-fit: cover;"
                                        src="{{ asset('storage/' . $artista->img_logo) }}"
                                        alt="{{ $artista->nombre_artistico }}">
                                </div>
                                <div>
                                    <h4 class="font-bold text-text-main text-sm">#{{ $artista->id }} -
                                        {{ $artista->nombre_artistico }}
                                    </h4>
                                    <p class="text-[10px] text-text-secondary uppercase font-bold tracking-wider">
                                        {{$artista->tipo}} •
                                        {{ $artista->genero_musical }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('public.artist-profile', $artista->id) }}">
                                    <button title="Ver detalle"
                                        class="p-2 text-gray-400 hover:text-primary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </a>
                                <button title="Modificar"
                                    class="p-2 text-gray-400 hover:text-secondary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="deleteArtista({{ $artista->id }})" title="Eliminar"
                                    class="p-2 text-gray-400 hover:text-red-500 transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Area: Ayuntamientos -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div
                class="p-6 border-b border-gray-50 flex items-center justify-between bg-gradient-to-r from-secondary/5 to-transparent">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-secondary rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-text-main tracking-tight">Ayuntamientos</h3>
                </div>
                <button class="text-sm text-secondary font-bold hover:underline">Ver todos</button>
            </div>

            <div class="p-6 flex-1">
                <div class="relative mb-6">
                    <input type="text" placeholder="Buscar ayuntamiento..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-secondary/20 transition">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="space-y-4">
                    @foreach($ayuntamientos as $ayuntamiento)
                        <div
                            class="group flex items-center justify-between p-3 rounded-2xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100 shadow-sm overflow-hidden p-2">
                                    <img style="border-radius: 50%;" src="{{ asset('storage/' . $ayuntamiento->imagen) }}"
                                        alt="{{ $ayuntamiento->nombre_institucion }}">
                                </div>
                                <div>
                                    <h4 class="font-bold text-text-main text-sm"> #{{ $ayuntamiento->id }} -
                                        {{ $ayuntamiento->nombre_institucion }}
                                    </h4>
                                    <p class="text-[10px] text-text-secondary uppercase font-bold tracking-wider">
                                        {{ $ayuntamiento->comunidad_autonoma }} • {{ $ayuntamiento->provincia }} •
                                        {{ $ayuntamiento->localidad }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('public.town-hall-profile', $ayuntamiento->id) }}">
                                    <button title="Ver detalle"
                                        class="p-2 text-gray-400 hover:text-primary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </a>
                                <button title="Modificar"
                                    class="p-2 text-gray-400 hover:text-secondary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="deleteAyuntamiento({{ $ayuntamiento->id }})" title="Eliminar"
                                    class="p-2 text-gray-400 hover:text-red-500 transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Area: Público -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div
                class="p-6 border-b border-gray-50 flex items-center justify-between bg-gradient-to-r from-accent/5 to-transparent">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-accent rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-text-main tracking-tight">Público</h3>
                </div>
                <button class="text-sm text-accent font-bold hover:underline">Ver todos</button>
            </div>

            <div class="p-6 flex-1">
                <div class="relative mb-6">
                    <input type="text" placeholder="Buscar usuario..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-accent/20 transition">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="space-y-4">
                    @foreach($publicos as $publico)
                        <div
                            class="group flex items-center justify-between p-3 rounded-2xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-accent/5 flex items-center justify-center border border-accent/10">
                                    <span class="text-accent font-bold text-sm">U{{ $publico->id }}</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-text-main text-sm">#{{ $publico->id }}
                                        {{ $publico->usuario->nombre }}
                                    </h4>
                                    <p class="text-[10px] text-text-secondary uppercase font-bold tracking-wider">
                                        {{ $publico->comunidad_autonoma }} • {{ $publico->provincia }} •
                                        {{ $publico->localidad }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('public.area', ['id' => $publico->id]) }}">
                                    <button title="Ver detalle"
                                        class="p-2 text-gray-400 hover:text-primary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </a>
                                <button title="Modificar" wire:click="editPublico({{ $publico->id }})"
                                    class="p-2 text-gray-400 hover:text-secondary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="deletePublico({{ $publico->id }})" title="Eliminar"
                                    class="p-2 text-gray-400 hover:text-red-500 transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Area: Eventos -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div
                class="p-6 border-b border-gray-50 flex items-center justify-between bg-gradient-to-r from-primary/10 via-secondary/10 to-transparent">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-text-main rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-text-main tracking-tight">Eventos</h3>
                </div>
                <button class="text-sm text-text-main font-bold hover:underline">Ver todos</button>
            </div>

            <div class="p-6 flex-1">
                <div class="relative mb-6">
                    <input type="text" placeholder="Buscar evento..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-gray-200 transition">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="space-y-4">
                    @foreach($eventos as $evento)
                        <div
                            class="group flex items-center justify-between p-3 rounded-2xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-gray-200 shadow-inner overflow-hidden relative">
                                    <img src="https://picsum.photos/seed/event{{ $evento->id }}/200" alt="event"
                                        class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-text-main text-sm italic tracking-tight">
                                        #{{ $evento->id }} - {{ $evento->nombre_evento }}
                                    </h4>
                                    <p class="text-[10px] text-primary font-bold tracking-widest uppercase">
                                        {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} •
                                        {{ $evento->localidad }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('public.event-detail', $evento->id) }}">
                                    <button title="Ver detalle"
                                        class="p-2 text-gray-400 hover:text-primary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </a>
                                <button wire:click="editEvent({{ $evento->id }})" title="Modificar"
                                    class="p-2 text-gray-400 hover:text-secondary transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="deleteEvent({{ $evento->id }})" title="Eliminar"
                                    class="p-2 text-gray-400 hover:text-red-500 transition rounded-lg hover:bg-white shadow-none hover:shadow-sm border border-transparent hover:border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @if (session()->has('message'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg font-bold animate-bounce"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('message') }}
        </div>
    @endif

    <!-- Edit Publico Modal -->
    @if($showEditPublicoModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black/20 backdrop-blur-sm transition-opacity" aria-hidden="true" wire:click="cancelEditPublico"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-middle bg-white rounded-[32px] text-left shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10 overflow-hidden border border-gray-100">
                    <div class="bg-white px-8 pt-8 pb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-black text-text-main font-heading" id="modal-title">Modificar Usuario Público</h3>
                            <button wire:click="cancelEditPublico" class="text-gray-400 hover:text-gray-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form wire:submit.prevent="updatePublico" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Account Info -->
                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                    <div class="md:col-span-2 px-1">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-primary">Información de Cuenta</span>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Nombre</label>
                                        <input type="text" wire:model="editNombre" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Email</label>
                                        <input type="email" wire:model="editEmail" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                    </div>
                                </div>

                                <!-- Location -->
                                <div>
                                    <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Comunidad Autónoma</label>
                                    <input type="text" wire:model="editComunidad" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Provincia</label>
                                    <input type="text" wire:model="editProvincia" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-2">Localidad</label>
                                    <input type="text" wire:model="editLocalidad" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                </div>

                                <!-- Preferences -->
                                <div class="md:col-span-1">
                                    <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-3">Gustos Musicales</label>
                                    <div class="space-y-2 max-h-40 overflow-y-auto p-2 bg-gray-50 rounded-xl border border-gray-100">
                                        @foreach($allGustos as $gusto)
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="checkbox" value="{{ $gusto }}" wire:model="editGustos" class="rounded border-gray-300 text-primary focus:ring-primary/20">
                                                <span class="text-sm text-text-main group-hover:text-primary transition-colors capitalize">{{ $gusto }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="md:col-span-1">
                                    <label class="block text-xs font-black text-text-secondary uppercase tracking-widest mb-3">Eventos Favoritos</label>
                                    <div class="space-y-2 max-h-40 overflow-y-auto p-2 bg-gray-50 rounded-xl border border-gray-100">
                                        @foreach($allFavoritos as $fav)
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="checkbox" value="{{ $fav }}" wire:model="editFavoritos" class="rounded border-gray-300 text-secondary focus:ring-secondary/20">
                                                <span class="text-sm text-text-main group-hover:text-secondary transition-colors capitalize">{{ $fav }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Notifications -->
                                <div class="md:col-span-2 flex items-center gap-3 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                                    <input type="checkbox" wire:model="editNotificaciones" id="editNotificaciones" class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary/20">
                                    <label for="editNotificaciones" class="text-sm font-bold text-text-main cursor-pointer">Recibir notificaciones comerciales</label>
                                </div>
                            </div>
                            
                            <div class="flex flex-col md:flex-row gap-3 pt-4 border-t border-gray-100">
                                <button type="submit" class="flex-1 bg-primary text-white font-black py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                                    Guardar Cambios
                                </button>
                                <button type="button" wire:click="cancelEditPublico" class="flex-1 bg-white text-text-secondary font-bold py-4 rounded-2xl border border-gray-200 hover:bg-gray-100 transition-all">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>