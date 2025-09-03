<?php
/**
 * Modal de producto - Product Detail Modal
 */
?>
<div id="product-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
    <div id="product-modal-backdrop" class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative bg-background rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 max-h-[90vh] overflow-y-auto">
            <div class="space-y-4">
                <div class="aspect-square overflow-hidden rounded-lg bg-muted">
                    <img id="modal-product-image" src="" alt="" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="space-y-6">
                <div class="flex justify-end">
                    <button id="close-product-modal" class="p-2 text-muted-foreground hover:text-foreground transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <h2 id="modal-product-title" class="text-2xl font-serif font-bold text-foreground"></h2>
                <div class="space-y-2">
                    <div class="flex items-baseline gap-3">
                        <span id="modal-product-price" class="text-2xl font-bold text-foreground"></span>
                    </div>
                </div>
                <div id="modal-product-description" class="prose prose-gray max-w-none"></div>
                <div class="space-y-4 pt-6 border-t border-border">
                    <div class="flex items-center gap-4">
                        <input type="number" id="modal-quantity" value="1" min="1" class="w-16 text-center border border-border rounded">
                        <button id="modal-add-to-cart" class="u-btn u-btn--primary flex-1">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>