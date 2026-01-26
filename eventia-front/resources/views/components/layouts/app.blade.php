<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Eventia' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-text-main bg-background flex flex-col min-h-screen">
        <header class="w-full bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <a href="/" class="flex items-center gap-2">
                            <!-- Logo Icon -->
                            <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                E
                            </div>
                            <span class="font-heading font-bold text-2xl tracking-tight">eventia</span>
                        </a>
                    </div>
                    
                    <!-- Desktop Nav -->
                    <nav class="hidden md:flex space-x-8">
                        <x-nav-link href="#">Explorar</x-nav-link>
                        <x-nav-link href="{{ route('public.artist-list') }}">Artistas</x-nav-link>
                        <x-nav-link href="{{ route('public.town-hall-list') }}">Ayuntamientos</x-nav-link>
                        <x-nav-link href="#pricing">Planes</x-nav-link>
                        <x-nav-link href="#">Ayuda</x-nav-link>
                    </nav>

                    <!-- Right Icons -->
                    <div class="flex items-center gap-4">
                        <button class="text-text-secondary hover:text-primary transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>

                        @auth
                            <div class="flex flex-col items-end">
                                <span class="text-sm font-bold text-text-main line-clamp-1">{{ auth()->user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-[10px] text-text-secondary hover:text-primary transition font-medium">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-text-secondary hover:text-primary transition flex items-center gap-2 group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span class="hidden lg:inline text-sm font-medium">Acceder</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            {{ $slot }}
        </main>

        <footer class="bg-gray-50 border-t border-gray-100 pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <!-- Links -->
                    <div>
                        <h4 class="font-heading font-bold text-lg mb-4">Explorar</h4>
                        <ul class="space-y-2 text-text-secondary">
                            <li><a href="#" class="hover:text-primary transition">Festivales</a></li>
                            <li><a href="#" class="hover:text-primary transition">Conciertos</a></li>
                            <li><a href="#" class="hover:text-primary transition">Teatro</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-heading font-bold text-lg mb-4">Empresa</h4>
                        <ul class="space-y-2 text-text-secondary">
                            <li><a href="#" class="hover:text-primary transition">Sobre nosotros</a></li>
                            <li><a href="#" class="hover:text-primary transition">Blog</a></li>
                            <li><a href="#" class="hover:text-primary transition">Trabaja con nosotros</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-heading font-bold text-lg mb-4">Legal</h4>
                        <ul class="space-y-2 text-text-secondary">
                            <li><a href="#" class="hover:text-primary transition">Términos y condiciones</a></li>
                            <li><a href="#" class="hover:text-primary transition">Privacidad</a></li>
                            <li><a href="#" class="hover:text-primary transition">Cookies</a></li>
                        </ul>
                    </div>

                    <!-- Branding & Social -->
                    <div class="flex flex-col items-start md:items-end">
                         <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                E
                            </div>
                            <span class="font-heading font-bold text-2xl tracking-tight">eventia</span>
                        </div>
                        <div class="flex gap-4">
                            <!-- Social Icons -->
                            <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-text-secondary hover:text-primary hover:shadow-md transition">
                                <!-- Twitter -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                            </a>
                             <a href="#" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-text-secondary hover:text-primary hover:shadow-md transition">
                                <!-- Instagram -->
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.373c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-8 text-center text-sm text-text-secondary">
                    <p>&copy; {{ date('Y') }} Eventia. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
