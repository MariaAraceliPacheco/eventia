<div class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gradient-to-b from-background to-white py-12 px-4 sm:px-6 lg:px-8">
    <!-- Card -->
    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 relative">
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary via-secondary to-accent"></div>
        
        <div class="p-8 sm:p-12 text-center">
            <!-- Header -->
            <div class="mb-12">
                 <!-- Eventia Logo (Small) -->
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-secondary text-white font-bold text-3xl mb-4 shadow-lg shadow-primary/30 transform hover:scale-105 transition-transform duration-300">
                    E
                </div>
                <h2 class="text-3xl font-bold font-heading text-text-main tracking-tight mb-2">¿Quién Eres?</h2>
                <p class="text-text-secondary">Selecciona tu tipo de perfil para continuar</p>
            </div>

            <!-- Options Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 mb-12">
                <!-- Público -->
                <div class="group cursor-pointer" wire:click="selectRole('publico')">
                    <div class="w-40 h-40 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4 transition-all duration-300 {{ $selectedRole === 'publico' ? 'bg-primary/20 scale-110 shadow-lg ring-4 ring-primary' : 'group-hover:bg-primary/10 group-hover:scale-110 group-hover:shadow-lg ring-4 ring-transparent group-hover:ring-primary/20' }}">
                        <svg class="w-20 h-20 transition-colors {{ $selectedRole === 'publico' ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold transition-colors {{ $selectedRole === 'publico' ? 'text-primary' : 'text-text-main group-hover:text-primary' }}">Público</h3>
                </div>

                <!-- Artista/Grupo -->
                <div class="group cursor-pointer" wire:click="selectRole('artista')">
                    <div class="w-40 h-40 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4 transition-all duration-300 {{ $selectedRole === 'artista' ? 'bg-secondary/20 scale-110 shadow-lg ring-4 ring-secondary' : 'group-hover:bg-secondary/10 group-hover:scale-110 group-hover:shadow-lg ring-4 ring-transparent group-hover:ring-secondary/20' }}">
                        <svg class="w-20 h-20 transition-colors {{ $selectedRole === 'artista' ? 'text-secondary' : 'text-gray-400 group-hover:text-secondary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold transition-colors {{ $selectedRole === 'artista' ? 'text-secondary' : 'text-text-main group-hover:text-secondary' }}">Artista/Grupo</h3>
                </div>

                <!-- Ayuntamiento -->
                <div class="group cursor-pointer" wire:click="selectRole('ayuntamiento')">
                    <div class="w-40 h-40 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4 transition-all duration-300 {{ $selectedRole === 'ayuntamiento' ? 'bg-accent/20 scale-110 shadow-lg ring-4 ring-accent' : 'group-hover:bg-accent/10 group-hover:scale-110 group-hover:shadow-lg ring-4 ring-transparent group-hover:ring-accent/20' }}">
                        <svg class="w-20 h-20 transition-colors {{ $selectedRole === 'ayuntamiento' ? 'text-accent' : 'text-gray-400 group-hover:text-accent' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold transition-colors {{ $selectedRole === 'ayuntamiento' ? 'text-accent' : 'text-text-main group-hover:text-accent' }}">Ayuntamiento</h3>
                </div>
            </div>

            <!-- Action Button -->
            <button wire:click="submit" @if(is_null($selectedRole)) disabled @endif class="w-full max-w-sm mx-auto bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-primary/30 hover:shadow-primary/40 flex items-center justify-center transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 disabled:shadow-none">
                Continuar
            </button>

        </div>
    </div>
</div>
