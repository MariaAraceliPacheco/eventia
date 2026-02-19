<x-layouts::auth>
    <div class="flex flex-col gap-6 text-center">
        <!-- Icon -->
        <div class="flex justify-center">
            <div class="relative">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                    </svg>
                </div>
                <div
                    class="absolute -top-1 -right-1 w-7 h-7 bg-secondary rounded-full border-4 border-white flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Copy -->
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-bold font-heading text-text-main tracking-tight">Verifica tu cuenta</h1>
            <p class="text-sm text-text-secondary px-2 leading-relaxed">
                ¡Gracias por unirte a Eventia! Para empezar a usar tu cuenta, necesitamos verificar tu correo electrónico.
                <span class="block mt-2 font-medium text-primary">Pulsa el botón de abajo para recibir el enlace de verificación.</span>
            </p>
        </div>

        <!-- Status Message -->
        @if (session('status') == 'verification-link-sent')
            <div
                class="p-3 text-sm font-medium text-green-700 bg-green-50 rounded-2xl border border-green-100 shadow-xs animate-in fade-in zoom-in duration-300">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ __('¡Enlace enviado! Revisa tu bandeja de entrada.') }}</span>
                </div>
            </div>
        @else
            <!-- Primary Action Button (Only show if not sent yet to focus the user) -->
            <div class="flex flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-primary/20 hover:shadow-primary/30 flex items-center justify-center transform hover:-translate-y-0.5 active:scale-[0.98]">
                        {{ __('Enviar correo de verificación') }}
                    </button>
                </form>
            </div>
        @endif

        @if (session('status') == 'verification-link-sent')
             <!-- Re-send option if they already clicked but haven't received it -->
             <div class="flex flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm font-bold text-primary hover:text-secondary transition-colors py-1 group flex items-center justify-center gap-1">
                        {{ __('¿No te ha llegado? Reenviar') }}
                    </button>
                </form>
            </div>
        @endif

        <!-- Secondary Actions -->
        <div class="flex flex-col gap-4">
            <form method="POST" action="{{ route('logout') }}" class="flex justify-center">
                @csrf
                <button type="submit"
                    class="text-xs font-bold text-text-secondary/60 hover:text-text-main transition-colors py-1 group flex items-center gap-1">
                    {{ __('Cerrar sesión') }}
                </button>
            </form>
        </div>

        <!-- Footer Help -->
        <div class="pt-4 border-t border-gray-50 text-[10px] text-text-secondary/50 italic leading-snug">
            Asegúrate de revisar tu carpeta de correo no deseado (spam).
        </div>
    </div>
</x-layouts::auth>