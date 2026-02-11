<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Payment Form -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('public.buy-ticket') }}" class="p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black font-heading text-text-main">Finalizar Compra</h1>
                    <p class="text-text-secondary text-sm">Completa los datos para procesar tu pago</p>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-8 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-primary rounded-full"></div>
                    <h3 class="text-xl font-bold text-text-main font-heading">Método de Pago</h3>
                </div>
                
                <div class="grid grid-cols-3 gap-4">
                    <button wire:click="$set('paymentMethod', 'card')" class="p-4 border-2 {{ $paymentMethod === 'card' ? 'border-primary bg-primary/5' : 'border-gray-100 bg-white hover:border-gray-200' }} rounded-2xl flex flex-col items-center justify-center gap-2 transition-all">
                        <svg class="w-8 h-8 {{ $paymentMethod === 'card' ? 'text-primary' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span class="text-xs font-bold {{ $paymentMethod === 'card' ? 'text-primary' : 'text-gray-500' }}">Tarjeta</span>
                    </button>
                    <button wire:click="$set('paymentMethod', 'paypal')" class="p-4 border-2 {{ $paymentMethod === 'paypal' ? 'border-primary bg-primary/5' : 'border-gray-100 bg-white hover:border-gray-200' }} rounded-2xl flex flex-col items-center justify-center gap-2 transition-all">
                        <span class="text-3xl">💳</span>
                        <span class="text-xs font-bold {{ $paymentMethod === 'paypal' ? 'text-primary' : 'text-gray-500' }}">PayPal</span>
                    </button>
                    <button wire:click="$set('paymentMethod', 'bizum')" class="p-4 border-2 {{ $paymentMethod === 'bizum' ? 'border-primary bg-primary/5' : 'border-gray-100 bg-white hover:border-gray-200' }} rounded-2xl flex flex-col items-center justify-center gap-2 transition-all">
                        <span class="text-3xl">📱</span>
                        <span class="text-xs font-bold {{ $paymentMethod === 'bizum' ? 'text-primary' : 'text-gray-500' }}">Bizum</span>
                    </button>
                </div>
            </div>

            <!-- Payment Details (Conditional based on method) -->
            @if($paymentMethod === 'card')
            <!-- Card Details -->
            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-8 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-secondary rounded-full"></div>
                    <h3 class="text-xl font-bold text-text-main font-heading">Datos de la Tarjeta</h3>
                </div>

                <div class="space-y-4">
                    <!-- Card Number -->
                    <div>
                        <label class="block text-sm font-bold text-text-main mb-2">Número de Tarjeta</label>
                        <input wire:model="cardNumber" type="text" placeholder="1234 5678 9012 3456" maxlength="19"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                    </div>

                    <!-- Card Name -->
                    <div>
                        <label class="block text-sm font-bold text-text-main mb-2">Nombre del Titular</label>
                        <input wire:model="cardName" type="text" placeholder="NOMBRE APELLIDOS"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all uppercase">
                    </div>

                    <!-- Expiry & CVV -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">Fecha de Expiración</label>
                            <input wire:model="expiryDate" type="text" placeholder="MM/AA" maxlength="5"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-text-main mb-2">CVV</label>
                            <input wire:model="cvv" type="text" placeholder="123" maxlength="3"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        </div>
                    </div>
                </div>
            </div>
            @elseif($paymentMethod === 'paypal')
            <!-- PayPal Details -->
            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-8 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-secondary rounded-full"></div>
                    <h3 class="text-xl font-bold text-text-main font-heading">Pago con PayPal</h3>
                </div>
                <div class="text-center py-8">
                    <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-4xl">💳</span>
                    </div>
                    <p class="text-text-secondary mb-6">Serás redirigido a PayPal para completar tu pago de forma segura.</p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-bold">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Pago 100% seguro con PayPal
                    </div>
                </div>
            </div>
            @elseif($paymentMethod === 'bizum')
            <!-- Bizum Details -->
            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-8 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-secondary rounded-full"></div>
                    <h3 class="text-xl font-bold text-text-main font-heading">Pago con Bizum</h3>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-text-main mb-2">Número de Teléfono</label>
                        <input wire:model="phone" type="tel" placeholder="+34 600 000 000"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        <p class="text-xs text-text-secondary mt-2 italic">Recibirás una notificación en tu app de Bizum para confirmar el pago</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-sm font-bold text-green-800">Pago instantáneo</p>
                            <p class="text-xs text-green-700">Tu pago se procesará al instante desde tu banco</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Contact Information -->
            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-8 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1.5 bg-accent rounded-full"></div>
                    <h3 class="text-xl font-bold text-text-main font-heading">Información de Contacto</h3>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-text-main mb-2">Email</label>
                        <input wire:model="email" type="email" placeholder="tu@email.com"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                        <p class="text-xs text-text-secondary mt-1 italic">Recibirás tus entradas en este email</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-text-main mb-2">Teléfono</label>
                        <input wire:model="phone" type="tel" placeholder="+34 600 000 000"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none transition-all">
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Order Summary -->
        <div class="space-y-6">
            
            <!-- Event Summary -->
            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-6 space-y-4 sticky top-6">
                <h3 class="text-lg font-bold text-text-main font-heading">Resumen del Pedido</h3>
                
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-2xl">
                        🎸
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-text-main text-sm">{{ $eventName }}</h4>
                        <p class="text-xs text-text-secondary">15 Ago 2026 • 21:00h</p>
                    </div>
                </div>

                <div class="space-y-3 pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-text-secondary">Entrada {{ $category }}</span>
                        <span class="font-bold text-text-main">{{ $quantity }}x</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-text-secondary">Precio unitario</span>
                        <span class="font-bold text-text-main">{{ number_format($unitPrice, 2) }}€</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-text-secondary italic">Gastos de gestión</span>
                        <span class="font-bold text-text-main">2.50€</span>
                    </div>
                    
                    <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                        <span class="text-lg font-bold text-text-main">Total</span>
                        <div class="text-right">
                            <span class="text-3xl font-black text-primary">{{ number_format($total, 2) }}€</span>
                            <p class="text-[10px] text-text-secondary uppercase tracking-widest font-bold">IVA incluido</p>
                        </div>
                    </div>
                </div>

                <button wire:click="processPayment" class="w-full mt-6 bg-gradient-to-r from-primary via-secondary to-accent text-white font-black py-4 rounded-2xl shadow-xl shadow-primary/30 hover:shadow-primary/50 transition-all transform hover:-translate-y-1 hover:scale-[1.02] flex items-center justify-center gap-3 active:scale-95 group">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Pagar Ahora
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>

                <div class="flex items-center justify-center gap-2 text-xs text-text-secondary pt-4">
                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold">Pago 100% seguro</span>
                </div>
            </div>

        </div>
    </div>
</div>
