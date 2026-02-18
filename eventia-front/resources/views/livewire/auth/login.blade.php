<div
    class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gradient-to-b from-background to-white py-12 px-4 sm:px-6 lg:px-8">
    <!-- Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100/50 relative">

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
                <h2 class="text-3xl font-bold font-heading text-text-main tracking-tight mb-2">Iniciar sesión</h2>
                <p class="text-sm text-text-secondary">Bienvenido de nuevo a Eventia</p>
            </div>

            <!-- Status Message (e.g., Password Reset Success) -->
            @if (session('status'))
                <div
                    class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 text-sm rounded-xl text-center font-medium shadow-sm animate-in fade-in zoom-in duration-300">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            <!-- Socials -->
            <div class="space-y-3 mb-8">
                <button type="button"
                    class="group flex items-center justify-center gap-3 w-full px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 text-text-main font-medium bg-white shadow-sm hover:shadow-md">
                    <!-- Google SVG -->
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .533 5.333.533 12S5.867 24 12.48 24c3.44 0 6.013-1.133 8.053-3.24 2.08-2.08 2.72-5.2 2.72-7.853 0-.773-.08-1.52-.227-2.227H12.48z" />
                    </svg>
                    <span class="text-sm">Iniciar sesión con Google</span>
                </button>

                <button type="button"
                    class="group flex items-center justify-center gap-3 w-full px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 text-text-main font-medium bg-white shadow-sm hover:shadow-md">
                    <!-- Spotify SVG -->
                    <svg class="w-5 h-5 text-[#1DB954] transition-transform group-hover:scale-110" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141 4.2-1.32 9.6-0.66 13.38 1.68.42.24.6.84.361 1.141zm0.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-0.181-1.38-0.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z" />
                    </svg>
                    <span class="text-sm">Iniciar sesión con Spotify</span>
                </button>

                <button type="button"
                    class="group flex items-center justify-center gap-3 w-full px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 text-text-main font-medium bg-white shadow-sm hover:shadow-md">
                    <!-- Amazon SVG -->
                    <svg class="w-5 h-5 text-text-main transition-transform group-hover:scale-110" role="img"
                        viewBox="0 0 24 24" fill="currentColor">
                        <title>Amazon</title>
                        <path
                            d="M13.9 13.6c-0.3-2.5-2.6-3.9-5.1-3.9-2.6 0-4.4 1.7-4.4 3.9 0 2.2 1.8 3.5 4.1 3.5 2.5 0 4-1.3 4.8-1.8 0 0.1 0 0.2 0 0.4 0 2-1.6 2.8-3.6 2.8-1.9 0-3.3-0.7-3.9-1.3 -0.1-0.1-0.3-0.1-0.4 0l-1.3 1.1c-0.1 0.1-0.1 0.3 0 0.4 1.1 1.1 3.2 2 5.7 2 3.6 0 6-2.5 6-7.1 0-0.1 0-0.2 0-0.2L13.9 13.6zM10.9 15.5c-0.9 0-1.6-0.6-1.6-1.7 0-1.1 0.8-1.7 1.7-1.7 0.9 0 1.6 0.6 1.6 1.7C12.5 14.8 11.7 15.5 10.9 15.5zM22.8 14.1c-0.6-1.1-1.4-1.6-1.4-1.6 -0.1-0.1-0.3-0.1-0.4 0l-0.7 0.6c-0.1 0.1-0.1 0.3 0 0.4 0.3 0.3 0.6 0.7 0.8 1.1 0.6 1.1 0.4 2.5-0.3 3.6 -0.1 0.1-0.1 0.3 0 0.4l0 0c0.6 0.4 1.2 0.8 1.9 1.1 0 0 0.1 0 0.1-0.1C23.5 18.2 23.7 15.7 22.8 14.1z" />
                    </svg>
                    <span class="text-sm">Iniciar sesión con Amazon Music</span>
                </button>

                <button type="button"
                    class="group flex items-center justify-center gap-3 w-full px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 text-text-main font-medium bg-white shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm">Iniciar sesión con correo electrónico</span>
                </button>
            </div>

            <!-- Divider -->
            <div class="relative my-6" aria-hidden="true">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-100"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase tracking-wide">
                    <span class="px-2 bg-white text-text-secondary/60">o continúa con</span>
                </div>
            </div>

            <!-- Email Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
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

                <div class="space-y-1">
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-text-main">Contraseña</label>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all"
                            placeholder="••••••••">
                        <div
                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-primary/30 hover:shadow-primary/40 flex items-center justify-center transform hover:-translate-y-0.5">
                    Iniciar sesión
                </button>
            </form>

            <!-- Footer -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100 text-sm">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-text-secondary hover:text-primary transition font-medium">¿Contraseña olvidada?</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="text-primary hover:text-secondary font-bold transition">Regístrate</a>
                @endif
            </div>

        </div>
    </div>
</div>