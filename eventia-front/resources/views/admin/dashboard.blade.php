<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventia - Admin Dashboard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Noto+Sans:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-custom font-body text-txt-main antialiased">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="w-full p-4 bg-gray-300 flex items-center justify-between gap-4">
            <!-- Logo Placeholder -->
            <div class="bg-gray-500 text-white w-24 h-12 flex items-center justify-center font-bold rounded">
                Logo
            </div>

            <!-- Navbar Placeholder -->
            <div class="bg-gray-500 text-white h-12 flex-1 flex items-center justify-center rounded">
                Navbar
            </div>

            <!-- Nav Buttons Placeholder -->
            <div class="bg-gray-500 text-white w-40 h-12 flex items-center justify-center rounded">
                btns navegacion
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-6">
            
            <!-- View Selector Title -->
            <div class="mb-6">
                <div class="bg-gray-300 p-3 inline-block rounded">
                    <h1 class="font-heading font-bold text-lg">Seleccionar vista (administrador/publico/artista/ayuntamiento)</h1>
                </div>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Section: Artista -->
                <div class="bg-gray-300 p-4 rounded-lg shadow-sm">
                    <div class="bg-gray-500 text-white p-2 mb-4 w-32 text-center rounded">
                        Buscar artista
                    </div>
                    
                    <div class="space-y-3">
                        <!-- List Item -->
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-gray-400 p-2 flex items-center justify-between rounded">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                                <span class="text-white font-semibold">artista</span>
                            </div>
                            <div class="flex flex-col gap-1 text-xs">
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Modificar</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Ver detalle</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Eliminar</button>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                 <!-- Section: Ayuntamiento -->
                 <div class="bg-gray-300 p-4 rounded-lg shadow-sm">
                    <div class="bg-gray-500 text-white p-2 mb-4 w-48 text-center rounded">
                        Buscar ayuntamiento
                    </div>
                    
                    <div class="space-y-3">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-gray-400 p-2 flex items-center justify-between rounded">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                                <span class="text-white font-semibold">Ayuntamiento</span>
                            </div>
                            <div class="flex flex-col gap-1 text-xs">
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Modificar</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Ver detalle</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Eliminar</button>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                 <!-- Section: Publico -->
                 <div class="bg-gray-300 p-4 rounded-lg shadow-sm">
                    <div class="bg-gray-500 text-white p-2 mb-4 w-32 text-center rounded">
                        Buscar publico
                    </div>
                    
                    <div class="space-y-3">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-gray-400 p-2 flex items-center justify-between rounded">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-transparent rounded-full"></div> <!-- No circle in wireframe for publico, but keeping spacing -->
                                <span class="text-white font-semibold">Publico</span>
                            </div>
                            <div class="flex flex-col gap-1 text-xs">
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Modificar</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Ver detalle</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Eliminar</button>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                 <!-- Section: Evento -->
                 <div class="bg-gray-300 p-4 rounded-lg shadow-sm">
                    <div class="bg-gray-500 text-white p-2 mb-4 w-32 text-center rounded">
                        Buscar evento
                    </div>
                    
                    <div class="space-y-3">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-gray-400 p-2 flex items-center justify-between rounded">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                                <span class="text-white font-semibold">Evento</span>
                            </div>
                            <div class="flex flex-col gap-1 text-xs">
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Modificar</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Ver detalle</button>
                                <button class="bg-gray-600 text-white px-2 py-0.5 rounded">Eliminar</button>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

            </div>

        </main>

        <!-- Footer -->
        <footer class="w-full bg-gray-300 mt-auto">
            <div class="grid grid-cols-2 p-8 gap-8">
                <div class="bg-gray-500 h-24 flex items-center justify-center text-white text-xl rounded">
                    Info
                </div>
                <div class="bg-gray-500 h-24 flex items-center justify-center text-white text-xl rounded">
                    Logo eventia
                </div>
            </div>
            
            <div class="px-8 pb-8">
                <div class="bg-gray-500 h-24 flex items-center justify-center text-white text-xl rounded">
                    Redes sociales
                </div>
            </div>

            <div class="bg-gray-500 text-white text-center py-2">
                Copyright
            </div>
        </footer>

    </div>
</body>
</html>
