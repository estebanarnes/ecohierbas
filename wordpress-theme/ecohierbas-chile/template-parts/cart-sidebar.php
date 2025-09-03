<?php
/**
 * Template Part: Cart Sidebar
 * Replica exactamente el componente CartSidebar.tsx
 */
?>

<!-- Cart Sidebar -->
<div id="cart-sidebar" class="fixed inset-y-0 right-0 z-50 w-96 bg-background border-l border-border shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out" aria-hidden="true">
    <!-- Cart Header -->
    <div class="flex items-center justify-between p-6 border-b border-border">
        <div class="flex items-center gap-2">
            <h2 class="text-lg font-semibold"><?php esc_html_e('Carrito de compras', 'ecohierbas'); ?></h2>
            <span id="cart-items-badge" class="u-badge u-badge--default">0</span>
        </div>
        <button id="close-cart" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-muted transition-colors" 
                aria-label="<?php esc_attr_e('Cerrar carrito', 'ecohierbas'); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Cart Content -->
    <div class="flex flex-col h-full">
        <!-- Empty Cart State -->
        <div id="empty-cart" class="flex-1 flex flex-col items-center justify-center p-6 text-center">
            <svg class="w-16 h-16 text-muted-foreground mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
            </svg>
            <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Tu carrito está vacío', 'ecohierbas'); ?></h3>
            <p class="text-muted-foreground mb-6">
                <?php esc_html_e('Agrega algunos productos a tu carrito para comenzar', 'ecohierbas'); ?>
            </p>
            <button id="continue-shopping" class="u-btn u-btn--primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <?php esc_html_e('Continuar comprando', 'ecohierbas'); ?>
            </button>
        </div>

        <!-- Cart Items -->
        <div id="cart-items" class="hidden flex-1 overflow-y-auto">
            <div class="p-6">
                <!-- Clear Cart Button -->
                <div class="flex justify-end mb-4">
                    <button id="clear-cart" class="text-sm text-destructive hover:underline">
                        <?php esc_html_e('Vaciar carrito', 'ecohierbas'); ?>
                    </button>
                </div>

                <!-- Items List -->
                <div id="cart-items-list" class="space-y-4">
                    <!-- Cart items populated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Cart Footer -->
        <div id="cart-footer" class="hidden border-t border-border bg-muted/30">
            <div class="p-6 space-y-4">
                <!-- Cart Summary -->
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-muted-foreground"><?php esc_html_e('Subtotal', 'ecohierbas'); ?></span>
                        <span id="cart-subtotal">$0</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-muted-foreground"><?php esc_html_e('Envío', 'ecohierbas'); ?></span>
                        <span class="text-primary"><?php esc_html_e('Gratis', 'ecohierbas'); ?></span>
                    </div>
                    <div class="flex justify-between font-semibold text-lg pt-2 border-t border-border">
                        <span><?php esc_html_e('Total', 'ecohierbas'); ?></span>
                        <span id="cart-total">$0</span>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="flex items-center justify-center gap-2 py-2">
                    <span class="text-xs text-muted-foreground"><?php esc_html_e('Aceptamos:', 'ecohierbas'); ?></span>
                    <div class="flex items-center gap-1">
                        <svg class="w-6 h-6 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M1,4V6H23V4M1,20H23V8H1M3,18H21V10H3"/>
                        </svg>
                        <svg class="w-6 h-6 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>
                        </svg>
                        <svg class="w-6 h-6 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                        </svg>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                     <?php $cart_url = class_exists('WooCommerce') ? wc_get_cart_url() : '/carrito'; ?>
                     <a href="<?php echo esc_url($cart_url); ?>" 
                       class="u-btn u-btn--outline w-full">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <?php esc_html_e('Ver carrito', 'ecohierbas'); ?>
                    </a>
                     <?php $checkout_url = class_exists('WooCommerce') ? wc_get_checkout_url() : '/checkout'; ?>
                     <a href="<?php echo esc_url($checkout_url); ?>" 
                       class="u-btn u-btn--primary w-full">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <?php esc_html_e('Finalizar compra', 'ecohierbas'); ?>
                    </a>
                </div>

                <!-- Continue Shopping -->
                <div class="text-center">
                    <button id="continue-shopping-footer" class="text-sm text-muted-foreground hover:text-primary transition-colors">
                        <?php esc_html_e('Continuar comprando', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart Overlay -->
<div id="cart-overlay" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300"></div>

<!-- Cart Item Template -->
<template id="cart-item-template">
    <div class="flex items-center gap-3 p-3 bg-background rounded-lg border border-border">
        <div class="w-16 h-16 flex-shrink-0">
            <img src="" alt="" class="w-full h-full object-cover rounded">
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="font-medium text-sm truncate"></h4>
            <p class="text-sm text-muted-foreground"></p>
            <div class="flex items-center gap-2 mt-2">
                <button class="w-6 h-6 flex items-center justify-center rounded border border-border hover:bg-muted transition-colors quantity-minus">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                </button>
                <span class="text-sm font-medium quantity-display">1</span>
                <button class="w-6 h-6 flex items-center justify-center rounded border border-border hover:bg-muted transition-colors quantity-plus">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="text-right">
            <div class="font-semibold text-sm price-display"></div>
            <button class="text-xs text-destructive hover:underline mt-1 remove-item">
                <?php esc_html_e('Quitar', 'ecohierbas'); ?>
            </button>
        </div>
    </div>
</template>

<!-- Toast notification for cart actions -->
<div id="cart-toast" class="fixed top-4 right-4 z-60 max-w-sm transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="bg-background border border-border rounded-lg shadow-lg p-4">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <p id="cart-toast-message" class="text-sm font-medium text-foreground"></p>
                <button id="cart-toast-action" class="text-xs text-primary hover:underline mt-1">
                    <?php esc_html_e('Ver carrito', 'ecohierbas'); ?>
                </button>
            </div>
            <button id="cart-toast-close" class="text-muted-foreground hover:text-foreground transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>