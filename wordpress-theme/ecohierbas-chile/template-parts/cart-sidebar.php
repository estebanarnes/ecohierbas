<?php
/**
 * Carrito lateral - Sidebar Cart
 */
?>
<div id="cart-sidebar" class="fixed inset-y-0 right-0 z-50 w-full max-w-md bg-background border-l border-border transform translate-x-full transition-transform duration-300 ease-in-out" style="display: none;">
    <div class="flex flex-col h-full">
        <div class="flex items-center justify-between p-6 border-b border-border">
            <h2 class="text-xl font-semibold text-foreground">Tu Carrito</h2>
            <button id="close-cart" class="p-2 text-muted-foreground hover:text-foreground transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6">
            <div id="cart-items-container">
                <div id="empty-cart" class="text-center py-8">
                    <p class="text-muted-foreground">Tu carrito está vacío</p>
                    <button id="continue-shopping" class="mt-4 u-btn u-btn--outline">Seguir Comprando</button>
                </div>
            </div>
        </div>
        <div id="cart-footer" class="border-t border-border p-6 space-y-4" style="display: none;">
            <div class="flex justify-between items-center text-lg font-semibold">
                <span>Total:</span>
                <span id="cart-total">$0</span>
            </div>
            <button id="checkout-btn" class="u-btn u-btn--primary w-full">Ir al Checkout</button>
        </div>
    </div>
</div>