<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-[40px] shadow-xl border border-gray-100/50 overflow-hidden relative">
        
        <!-- Decorative Header / Image Upload -->
        <div class="h-64 bg-gray-50 relative group cursor-pointer overflow-hidden">
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
            @elseif($foto)
                <img src="{{ asset('storage/profiles/eventos/' . $foto) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center border-b border-gray-100">
                    <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300 mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-text-main">Subir foto de portada</span>
                    <span class="text-xs text-text-secondary mt-1">Recomendado: 1200x480px</span>
                </div>
            @endif
            <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary via-secondary to-accent"></div>
        </div>

        <form wire:submit.prevent="submit" class="p-8 sm:p-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Title -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-text-main">Título del evento</label>
                        <input type="text" wire:model="title" required
                            class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-[20px] focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all font-heading text-lg" 
                            placeholder="Ej: Festival de Jazz 2026">
                    </div>

                    <!-- Invited Artists Selection -->
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-text-main">Artistas invitados (Selecciona uno o varios)</label>
                        <div class="space-y-2 max-h-64 overflow-y-auto pr-2 custom-scrollbar bg-gray-50/50 p-4 rounded-[24px] border border-gray-100">
                            @forelse($allArtists as $artist)
                                <div class="flex items-center justify-between p-3 bg-white rounded-xl border {{ in_array($artist->id, $selectedArtists) ? 'border-primary ring-1 ring-primary/20 shadow-sm' : 'border-gray-100' }} transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gray-50 flex items-center justify-center overflow-hidden border border-gray-100">
                                            @if($artist->img_logo)
                                                <img src="{{ asset('storage/' . $artist->img_logo) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-xs font-black text-gray-400 uppercase">{{ substr($artist->nombre_artistico, 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-text-main flex items-center gap-2">
                                                {{ $artist->nombre_artistico }}
                                                @if(isset($invitaciones[$artist->id]))
                                                    <span class="text-[8px] font-black px-1.5 py-0.5 rounded uppercase tracking-tighter
                                                        {{ $invitaciones[$artist->id] === 'pendiente' ? 'bg-amber-100 text-amber-600' : 
                                                           ($invitaciones[$artist->id] === 'aceptada' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600') }}">
                                                        {{ $invitaciones[$artist->id] }}
                                                    </span>
                                                @endif
                                            </span>
                                            <span class="text-[10px] text-text-secondary uppercase font-bold tracking-wider">{{ $artist->genero_musical }}</span>
                                        </div>
                                    </div>
                                    <button type="button" wire:click="toggleArtist({{ $artist->id }})" 
                                        class="w-10 h-10 rounded-xl flex items-center justify-center transition-all shadow-sm {{ in_array($artist->id, $selectedArtists) ? 'bg-primary text-white scale-90' : 'bg-white text-gray-400 border border-gray-100 hover:border-primary hover:text-primary hover:bg-primary/5' }}">
                                        @if(in_array($artist->id, $selectedArtists))
                                            @if(isset($invitaciones[$artist->id]) && $invitaciones[$artist->id] === 'aceptada')
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            @endif
                                        @else
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                        @endif
                                    </button>
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <p class="text-xs font-bold text-text-secondary italic">No hay artistas disponibles en este momento.</p>
                                </div>
                            @endforelse
                        </div>
                        @if(count($selectedArtists) > 0)
                            <p class="text-[10px] font-black text-secondary uppercase tracking-widest px-2">
                                {{ count($selectedArtists) }} {{ count($selectedArtists) == 1 ? 'artista seleccionado' : 'artistas seleccionados' }}
                            </p>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-bold text-text-main">Tipos de Entradas y Precios</label>
                            <button type="button" wire:click="addTipoEntrada" class="text-xs font-black text-primary uppercase tracking-widest hover:text-secondary transition-colors flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Añadir tipo
                            </button>
                        </div>
                        
                        <div class="space-y-3">
                            @foreach($tipos_entrada as $index => $tipo)
                                <div class="flex items-center gap-3 animate-fade-in">
                                    <div class="flex-1">
                                        <input type="text" wire:model="tipos_entrada.{{ $index }}.nombre" 
                                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all text-sm" 
                                            placeholder="Ej: General, VIP, Pista...">
                                    </div>
                                    <div class="w-32 relative">
                                        <input type="number" wire:model="tipos_entrada.{{ $index }}.precio" min="0" step="0.01"
                                            class="w-full pl-4 pr-8 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all text-sm" 
                                            placeholder="0.00">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">€</span>
                                    </div>
                                    @if(count($tipos_entrada) > 1)
                                        <button type="button" wire:click="removeTipoEntrada({{ $index }})" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Date -->
                        <div class="pt-4 space-y-1">
                            <label class="block text-sm font-bold text-text-main">Fecha del evento</label>
                            <input type="date" wire:model="date"
                                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-[20px] focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Category -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-text-main">Categoría</label>
                        <select wire:model="category"
                            class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-[20px] focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all cursor-pointer">
                            <option value="">Selecciona estilo</option>
                            <option value="concierto">Concierto</option>
                            <option value="festival">Festival</option>
                            <option value="feria">Feria</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="space-y-1 text-sm bg-accent/5 p-6 rounded-[30px] border border-accent/10">
                        <label class="block font-bold text-text-main mb-3">Descripción</label>
                        <textarea wire:model="description" rows="4"
                            class="w-full px-4 py-3 bg-white border border-gray-100 rounded-2xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all resize-none" 
                            placeholder="Describe el evento, horarios, accesos..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Locality -->
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-text-main">Localidad</label>
                            <input type="text" wire:model="locality"
                                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-[20px] focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                placeholder="Ej: Madrid">
                        </div>
                        <!-- Province -->
                        <div class="space-y-1 text-sm">
                            <label class="block font-bold text-text-main">Provincia</label>
                            <input type="text" wire:model="province"
                                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-[20px] focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all" 
                                placeholder="Ej: Madrid">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="flex items-center justify-end gap-4 mt-12 border-t border-gray-50 pt-8">
                <a href="{{ route('town-hall.area') }}" class="px-8 py-4 text-sm font-bold text-text-secondary hover:text-text-main transition-colors">Cancelar</a>
                <button type="submit" class="bg-gradient-to-r from-accent to-secondary text-white font-bold px-10 py-4 rounded-[20px] shadow-lg shadow-accent/20 hover:shadow-accent/40 transition-all transform hover:-translate-y-1">
                    Publicar evento
                </button>
            </div>
        </form>
    </div>
</div>
