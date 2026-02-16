<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden border border-gray-100/50 relative">

        <!-- Header: Background Image & Event Info -->
        <div class="relative h-80 overflow-hidden group">
            <!-- Blurred Background (Placeholder simulation) -->
            <div class="absolute inset-0 bg-gradient-to-tr from-text-main to-primary opacity-90"></div>
            <div
                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1459749411177-042180ce673c?q=80&w=2070')] bg-cover bg-center mix-blend-overlay blur-[2px] scale-105 group-hover:scale-100 transition-transform duration-700">
            </div>

            <div class="relative h-full px-10 flex flex-col justify-center text-white">
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <!-- Main Event Image -->
                    <div
                        class="w-48 h-48 rounded-3xl bg-white/10 backdrop-blur-md p-2 shadow-2xl shadow-primary/20 flex-shrink-0">
                        <div class="w-full h-full rounded-2xl bg-white flex items-center justify-center text-5xl">🎸
                        </div>
                    </div>

                    <div class="flex-1 space-y-4 text-center md:text-left">
                        <div class="flex flex-wrap items-center gap-2 justify-center md:justify-start">
                            <span
                                class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-[10px] font-black uppercase tracking-widest text-primary">{{ $evento->categoria }}</span>
                            @if($evento->estado === 'FINALIZADO')
                                <span
                                    class="px-3 py-1 bg-red-500 rounded-full text-[10px] font-black uppercase tracking-widest text-white">Sold
                                    Out</span>
                            @endif
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black font-heading leading-tight tracking-tight">
                            {{ $evento->nombre_evento }}</h1>

                        <div class="flex flex-wrap items-center gap-6 justify-center md:justify-start">
                            <div class="flex items-center gap-2">
                                <span class="p-2 bg-white/10 rounded-xl"><svg class="w-5 h-5 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg></span>
                                <span class="font-bold text-sm">{{ $evento->localidad }},
                                    {{ $evento->provincia }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="p-2 bg-white/10 rounded-xl"><svg class="w-5 h-5 text-secondary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg></span>
                                <span
                                    class="font-bold text-sm">{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M') }}
                                    • {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('H:i') }}h</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-8 right-8 flex flex-col gap-2">
                        <button
                            class="p-4 bg-white/10 backdrop-blur-md rounded-2xl text-white hover:bg-primary transition-all duration-300 group/btn">
                            <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <p
                            class="text-[10px] font-bold text-center uppercase tracking-wider text-white/60 group-hover:text-white transition-colors">
                            Recordatorio</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchase Section -->
        <div class="p-8 sm:p-12 space-y-10">

            <!-- Step 1: Quantity -->
            <div
                class="bg-gray-50 border border-gray-100 rounded-[30px] p-8 flex flex-col md:flex-row items-center justify-between gap-6 hover:shadow-xl hover:shadow-gray-200/20 transition-all group">
                <div>
                    <h3 class="text-xl font-bold text-text-main font-heading mb-1">Cantidad de Entradas</h3>
                    @php $disponibles = $this->getDisponibles(); @endphp
                    <p class="text-text-secondary text-sm italic font-medium">
                        Puedes añadir hasta un máximo de {{ min(5, $disponibles) }}
                        <span class="text-primary font-bold">(Quedan {{ $disponibles }} disponibles)</span>
                    </p>
                </div>
                <div class="flex items-center gap-6 bg-white p-3 rounded-2xl shadow-sm border border-gray-100">
                    <button wire:click="decrement"
                        class="w-12 h-12 rounded-xl bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-text-main font-black text-xl transition-colors">-</button>
                    <span class="text-3xl font-black text-primary min-w-[40px] text-center">{{ $quantity }}</span>
                    <button wire:click="increment"
                        class="w-12 h-12 rounded-xl {{ $quantity >= min(5, $disponibles) ? 'bg-gray-200 cursor-not-allowed text-gray-400' : 'bg-primary text-white hover:opacity-90' }} flex items-center justify-center font-black text-xl transition-colors shadow-lg shadow-primary/20"
                        @if($quantity >= min(5, $disponibles)) disabled @endif>+</button>
                </div>
            </div>

            <!-- Step 2: Category & Price -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-text-main font-heading flex items-center gap-3">
                        Categoría Entradas
                        <div class="h-1 w-12 bg-secondary rounded-full"></div>
                    </h3>
                    <div class="space-y-4">
                        @foreach($tipos_disponibles as $tipo)
                            @php $label = $tipo['nombre']; @endphp
                            <label wire:click="$set('category', '{{ $label }}')"
                                class="flex items-center justify-between p-5 rounded-2xl border-2 {{ $category === $label ? 'border-primary bg-primary/5 shadow-md shadow-primary/5' : 'border-gray-100 bg-white hover:border-gray-200' }} cursor-pointer transition-all group relative overflow-hidden">
                                @if($category === $label)
                                    <div class="absolute inset-y-0 left-0 w-1.5 bg-primary"></div>
                                @endif
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-5 h-5 rounded-full border-2 border-gray-200 flex items-center justify-center transition-colors {{ $category === $label ? 'border-primary' : '' }}">
                                        @if($category === $label)
                                        <div class="w-2.5 h-2.5 rounded-full bg-primary"></div> @endif
                                    </div>
                                    <span
                                        class="font-bold text-text-main transition-colors {{ $category === $label ? 'text-primary' : '' }}">{{ $label }}</span>
                                </div>
                                <span
                                    class="text-lg font-black {{ $category === $label ? 'text-primary' : 'text-text-secondary' }}">{{ number_format((float) $tipo['precio'], 2) }}€</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Step 3: Summary / Checkout -->
                <div
                    class="bg-gradient-to-br from-text-main to-gray-800 rounded-[35px] p-10 text-white flex flex-col justify-between relative overflow-hidden shadow-2xl">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>

                    <div class="space-y-8 relative">
                        <h3 class="text-2xl font-bold font-heading">Resumen de compra</h3>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-gray-400 text-sm">
                                <span>Entrada {{ $category }}</span>
                                <span class="font-bold text-white">{{ $quantity }}x</span>
                            </div>
                            <div class="flex items-center justify-between text-gray-400 text-sm">
                                <span>Precio unitario</span>
                                <span class="font-bold text-white">{{ number_format($subtotal / $quantity, 2) }}€</span>
                            </div>
                            <div class="flex items-center justify-between text-gray-400 text-sm italic">
                                <span>Gastos de gestión</span>
                                <span class="font-bold text-white">2.50€</span>
                            </div>
                            <div class="border-t border-white/10 pt-6 flex items-center justify-between">
                                <span class="text-xl font-bold">Total</span>
                                <div class="text-right">
                                    <span
                                        class="text-4xl font-black text-primary">{{ number_format($total, 2) }}€</span>
                                    <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest font-bold">IVA
                                        incluido</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button wire:click="buy"
                        class="w-full mt-10 bg-gradient-to-r from-primary via-secondary to-accent text-white font-black py-5 rounded-2xl shadow-xl shadow-primary/30 hover:shadow-primary/50 transition-all transform hover:-translate-y-1 hover:scale-[1.02] flex items-center justify-center gap-3 active:scale-95 group">
                        Confirmar y Pagar
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>