<x-layouts.app>
<div
    class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gradient-to-b from-background to-white py-12 px-5 sm:px-6 lg:px-8">
    <!-- Card -->
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 relative">

        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary via-secondary to-accent"></div>

        <div class="p-8 sm:p-10">
            <!-- Header -->
            <div class="text-center mb-8">
                <!-- Eventia Logo (Small) -->
                <div
                    class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-secondary text-white font-bold text-3xl mb-4 shadow-lg shadow-primary/30 transform hover:scale-105 transition-transform duration-300">
                    E
                </div>
                <h2 class="text-3xl font-bold font-heading text-text-main tracking-tight mb-2">Recuperar contraseña</h2>
                <p class="text-sm text-text-secondary">Introduce tu email para recibir un enlace de recuperación</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div
                    class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 text-sm rounded-xl text-center font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-1">
                    <label for="email" class="block text-sm font-medium text-text-main">Correo electrónico</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" required autocomplete="email" autofocus
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all"
                            placeholder="tu@email.com" value="{{ old('email') }}">
                        <div
                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-primary/30 hover:shadow-primary/40 flex items-center justify-center transform hover:-translate-y-0.5">
                    Enviar enlace de recuperación
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-sm">
                <span>¿Recordaste tu contraseña?</span>
                <a href="{{ route('login') }}"
                    class="text-primary hover:text-secondary font-bold transition ml-1">Inicia sesión</a>
            </div>
        </div>
    </div>
</div>
</x-layouts.app>