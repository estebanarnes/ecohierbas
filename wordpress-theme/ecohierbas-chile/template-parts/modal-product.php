<?php
/**
 * Template Part: Product Modal (Quick View)
 * Replica exactamente el componente ProductDetailModal.tsx
 */
?>

<!-- Product Detail Modal -->
<div id="product-detail-modal" class="fixed inset-0 z-50 hidden" aria-hidden="true" role="dialog" aria-labelledby="modal-title" aria-describedby="modal-description">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
    
    <!-- Modal Content -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="u-modal-content w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-background rounded-lg shadow-2xl transform transition-all">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-border">
                <h2 id="modal-title" class="text-xl font-serif font-bold text-foreground"><?php esc_html_e('Detalles del producto', 'ecohierbas'); ?></h2>
                <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-muted transition-colors close-modal-btn" 
                        aria-label="<?php esc_attr_e('Cerrar modal', 'ecohierbas'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div id="modal-description" class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Product Image -->
                    <div class="space-y-4">
                        <div class="aspect-square overflow-hidden rounded-lg bg-muted">
                            <img id="modal-product-image" 
                                 src="" 
                                 alt="" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="space-y-6">
                        <!-- Category & Stock -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2" id="modal-badges">
                                <!-- Badges populated by JavaScript -->
                            </div>
                            <span id="modal-stock-badge" class="u-badge">
                                <!-- Stock status populated by JavaScript -->
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 id="modal-product-title" class="text-2xl md:text-3xl font-serif font-bold text-foreground"></h3>

                        <!-- Rating -->
                        <div id="modal-rating" class="hidden">
                            <!-- Rating populated by JavaScript -->
                        </div>

                        <!-- Price -->
                        <div class="space-y-2">
                            <div class="flex items-baseline gap-3">
                                <span id="modal-price" class="text-3xl font-bold text-foreground"></span>
                                <span id="modal-original-price" class="hidden text-xl text-muted-foreground line-through"></span>
                                <span id="modal-discount-badge" class="hidden"></span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div id="modal-description-text" class="prose prose-sm max-w-none text-muted-foreground">
                            <!-- Description populated by JavaScript -->
                        </div>

                        <!-- Features List -->
                        <div class="space-y-3">
                            <h4 class="font-semibold text-foreground"><?php esc_html_e('Características:', 'ecohierbas'); ?></h4>
                            <ul class="space-y-2 text-sm text-muted-foreground">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php esc_html_e('100% Orgánico y natural', 'ecohierbas'); ?>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php esc_html_e('Libre de pesticidas y químicos', 'ecohierbas'); ?>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php esc_html_e('Cosechado sustentablemente', 'ecohierbas'); ?>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php esc_html_e('Empaque ecológico', 'ecohierbas'); ?>
                                </li>
                            </ul>
                        </div>

                        <!-- Payment Methods -->
                        <div class="space-y-3">
                            <h4 class="font-semibold text-foreground"><?php esc_html_e('Métodos de pago:', 'ecohierbas'); ?></h4>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-6 h-6 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M1,4V6H23V4M1,20H23V8H1M3,18H21V10H3"/>
                                    </svg>
                                    <span class="text-sm text-muted-foreground"><?php esc_html_e('Tarjeta', 'ecohierbas'); ?></span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-6 h-6 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>
                                    </svg>
                                    <span class="text-sm text-muted-foreground"><?php esc_html_e('PayPal', 'ecohierbas'); ?></span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-6 h-6 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                                    </svg>
                                    <span class="text-sm text-muted-foreground"><?php esc_html_e('Transferencia', 'ecohierbas'); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Add to Cart -->
                        <div class="pt-6 border-t border-border">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center border border-border rounded-lg">
                                    <button type="button" class="p-3 hover:bg-muted transition-colors quantity-minus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" 
                                           value="1" 
                                           min="1" 
                                           class="w-20 text-center border-0 focus:ring-0 product-quantity">
                                    <button type="button" class="p-3 hover:bg-muted transition-colors quantity-plus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                                <button id="modal-add-to-cart" class="u-btn u-btn--primary flex-1" data-product-id="">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
                                    </svg>
                                    <?php esc_html_e('Agregar al carrito', 'ecohierbas'); ?>
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <button class="text-sm text-muted-foreground hover:text-primary transition-colors close-modal-btn">
                                    <?php esc_html_e('Continuar comprando', 'ecohierbas'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>