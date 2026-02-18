<x-layouts.app>
<div
    class="flex items-center justify-center min-h-[calc(100vh-80px)] bg-gradient-to-b from-background to-white py-12 px-4 sm:px-6 lg:px-8">
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
                <h2 class="text-3xl font-bold font-heading text-text-main tracking-tight mb-2">Nueva contraseña</h2>
                <p class="text-sm text-text-secondary">Establece tu nueva contraseña de acceso</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                <!-- Token -->
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <!-- Email Address -->
                <div class="space-y-1">
                    <label for="email" class="block text-sm font-medium text-text-main">Correo electrónico</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" required autocomplete="email"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all"
                            value="{{ request('email') }}" readonly>
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

                <!-- Password -->
                <div class="space-y-1">
                    <label for="password" class="block text-sm font-medium text-text-main">Nueva contraseña</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required autocomplete="new-password"
                            autofocus
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all"
                            placeholder="••••••••">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400"
                            x-data="{ show: false }">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1">
                    <label for="password_confirmation" class="block text-sm font-medium text-text-main">Confirmar
                        contraseña</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            autocomplete="new-password"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-primary/30 hover:shadow-primary/40 flex items-center justify-center transform hover:-translate-y-0.5">
                    Restablecer contraseña
                </button>
            </form>
        </div>
    </div>
</div>
</x-layouts.app>