<?php
/**
 * Template Part: Modal Product
 */
?>

<div id="product-detail-modal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden" aria-hidden="true">
    <div class="bg-background rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" 
         role="dialog" aria-modal="true" aria-labelledby="modal-product-title">
        
        <div id="modal-product-content">
            <div class="p-8 text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
                <p class="text-muted-foreground"><?php esc_html_e('Cargando producto...', 'ecohierbas'); ?></p>
            </div>
        </div>
    </div>
</div>

<template id="product-modal-template">
    <div class="relative">
        <button class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-muted transition-colors z-10 modal-close" 
                aria-label="<?php esc_attr_e('Cerrar modal', 'ecohierbas'); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <div class="space-y-4">
                <div class="aspect-square overflow-hidden rounded-lg bg-muted">
                    <img class="product-image w-full h-full object-cover" alt="">
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="u-badge u-badge--outline product-category"></span>
                        <span class="u-badge u-badge--secondary product-finalidad"></span>
                    </div>
                    <span class="u-badge product-stock"></span>
                </div>

                <h2 id="modal-product-title" class="text-3xl font-serif font-bold text-foreground product-name"></h2>

                <div class="flex items-center gap-2 product-rating-container"></div>

                <div class="space-y-2">
                    <div class="flex items-baseline gap-3">
                        <span class="text-3xl font-bold text-foreground product-price"></span>
                        <span class="text-xl text-muted-foreground line-through product-original-price"></span>
                        <span class="product-discount-badge"></span>
                    </div>
                </div>

                <div class="prose prose-sm max-w-none product-description"></div>

                <div class="space-y-4 pt-6 border-t border-border">
                    <div class="flex items-center gap-4 add-to-cart-section">
                        <div class="flex items-center border border-border rounded-lg">
                            <button type="button" class="p-3 hover:bg-muted transition-colors quantity-minus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" value="1" min="1" class="w-20 text-center border-0 focus:ring-0 product-quantity">
                            <button type="button" class="p-3 hover:bg-muted transition-colors quantity-plus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                        <button class="u-btn u-btn--primary flex-1 add-to-cart-btn">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
                            </svg>
                            <?php esc_html_e('Agregar al carrito', 'ecohierbas'); ?>
                        </button>
                    </div>

                    <div class="out-of-stock-message hidden">
                        <button class="u-btn w-full bg-muted text-muted-foreground cursor-not-allowed" disabled>
                            <?php esc_html_e('Producto agotado', 'ecohierbas'); ?>
                        </button>
                    </div>

                    <div class="flex gap-2">
                        <a href="#" class="u-btn u-btn--outline flex-1 text-center product-link">
                            <?php esc_html_e('Ver página del producto', 'ecohierbas'); ?>
                        </a>
                        <button class="u-btn u-btn--outline modal-close">
                            <?php esc_html_e('Cerrar', 'ecohierbas'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>