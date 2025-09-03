<?php
/**
 * Template Part: Offers Popup
 */
?>

<div id="offers-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden" 
     data-popup="ofertas" aria-hidden="true">
    <div class="bg-background rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto relative" 
         role="dialog" aria-modal="true" aria-labelledby="popup-title">
        
        <button class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-muted transition-colors z-10" 
                data-popup-close aria-label="<?php esc_attr_e('Cerrar popup', 'ecohierbas'); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="p-8 text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>

            <h2 id="popup-title" class="text-2xl font-serif font-bold text-foreground mb-4">
                <?php esc_html_e('¡Oferta Especial!', 'ecohierbas'); ?>
            </h2>

            <p class="text-muted-foreground mb-6 leading-relaxed">
                <?php esc_html_e('Obtén un 15% de descuento en tu primera compra de productos EcoHierbas. Válido solo para nuevos clientes.', 'ecohierbas'); ?>
            </p>

            <div class="bg-muted rounded-lg p-4 mb-6">
                <p class="text-sm text-muted-foreground mb-2"><?php esc_html_e('Código de descuento:', 'ecohierbas'); ?></p>
                <div class="flex items-center justify-center gap-2">
                    <code class="text-2xl font-bold text-primary bg-primary/10 px-3 py-1 rounded">NUEVO15</code>
                    <button class="p-2 hover:bg-muted-foreground/10 rounded transition-colors" 
                            onclick="navigator.clipboard?.writeText('NUEVO15')" 
                            title="<?php esc_attr_e('Copiar código', 'ecohierbas'); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="space-y-3">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
                   class="u-btn u-btn--primary w-full">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <?php esc_html_e('Comprar Ahora', 'ecohierbas'); ?>
                </a>
                
                <button class="u-btn u-btn--outline w-full" data-popup-close>
                    <?php esc_html_e('Tal vez después', 'ecohierbas'); ?>
                </button>
            </div>

            <p class="text-xs text-muted-foreground mt-6">
                <?php esc_html_e('*Oferta válida solo para nuevos clientes. No acumulable con otras promociones. Válido hasta fin de mes.', 'ecohierbas'); ?>
            </p>

            <div class="mt-4">
                <button class="text-sm text-muted-foreground hover:text-foreground transition-colors" 
                        data-popup-no-show>
                    <?php esc_html_e('No mostrar de nuevo', 'ecohierbas'); ?>
                </button>
            </div>
        </div>
    </div>
</div>