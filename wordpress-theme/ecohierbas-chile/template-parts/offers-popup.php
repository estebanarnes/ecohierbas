<?php
/**
 * Template Part: Offers Popup
 * Replica exactamente el componente OffersPopup.tsx
 */
?>

<!-- Offers Popup Modal -->
<div id="offers-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden" aria-hidden="true">
    <div class="bg-background rounded-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto relative animate-scale-in" role="dialog" aria-modal="true" aria-labelledby="offers-popup-title">
        <!-- Close Button -->
        <button id="offers-popup-close" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-muted transition-colors z-10" aria-label="<?php esc_attr_e('Cerrar ofertas', 'ecohierbas'); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Popup Content -->
        <div class="p-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-r from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <h2 id="offers-popup-title" class="text-2xl font-serif font-bold text-foreground mb-2">
                    <?php esc_html_e('¡Ofertas Especiales!', 'ecohierbas'); ?>
                </h2>
                <p class="text-muted-foreground">
                    <?php esc_html_e('No te pierdas nuestras promociones exclusivas', 'ecohierbas'); ?>
                </p>
            </div>

            <!-- Offers List -->
            <div class="space-y-4 mb-6">
                <!-- Offer 1: Envío Gratis -->
                <div class="u-card bg-primary/5 border-primary/20">
                    <div class="u-card-content">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-foreground mb-1">
                                    <?php esc_html_e('Envío Gratis', 'ecohierbas'); ?>
                                </h3>
                                <p class="text-sm text-muted-foreground">
                                    <?php esc_html_e('En compras sobre $40.000 a todo Chile', 'ecohierbas'); ?>
                                </p>
                                <span class="inline-block bg-primary text-primary-foreground text-xs px-2 py-1 rounded-full mt-2">
                                    <?php esc_html_e('Válido hasta fin de mes', 'ecohierbas'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offer 2: Descuento Primera Compra -->
                <div class="u-card bg-accent/5 border-accent/20">
                    <div class="u-card-content">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-foreground mb-1">
                                    <?php esc_html_e('15% OFF Primera Compra', 'ecohierbas'); ?>
                                </h3>
                                <p class="text-sm text-muted-foreground">
                                    <?php esc_html_e('Para nuevos clientes con código BIENVENIDO', 'ecohierbas'); ?>
                                </p>
                                <div class="flex items-center mt-2">
                                    <span class="bg-accent text-accent-foreground text-xs px-2 py-1 rounded font-mono">
                                        BIENVENIDO
                                    </span>
                                    <button class="ml-2 text-xs text-accent hover:underline" onclick="copyToClipboard('BIENVENIDO')">
                                        <?php esc_html_e('Copiar', 'ecohierbas'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offer 3: Kit Familiar -->
                <div class="u-card bg-secondary/5 border-secondary/20">
                    <div class="u-card-content">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-foreground mb-1">
                                    <?php esc_html_e('Kit Familiar Completo', 'ecohierbas'); ?>
                                </h3>
                                <p class="text-sm text-muted-foreground">
                                    <?php esc_html_e('Vermicompostera + 3 infusiones + guía', 'ecohierbas'); ?>
                                </p>
                                <div class="flex items-center mt-2">
                                    <span class="text-lg font-bold text-secondary mr-2">$89.990</span>
                                    <span class="text-sm text-muted-foreground line-through">$120.000</span>
                                    <span class="bg-secondary text-secondary-foreground text-xs px-2 py-1 rounded-full ml-2">
                                        <?php esc_html_e('25% OFF', 'ecohierbas'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Newsletter Signup -->
            <div class="bg-gradient-to-r from-primary/10 to-accent/10 rounded-xl p-6 mb-6">
                <div class="text-center mb-4">
                    <h3 class="font-semibold text-foreground mb-2">
                        <?php esc_html_e('Suscríbete a nuestro Newsletter', 'ecohierbas'); ?>
                    </h3>
                    <p class="text-sm text-muted-foreground">
                        <?php esc_html_e('Recibe ofertas exclusivas y tips de vida sustentable', 'ecohierbas'); ?>
                    </p>
                </div>
                
                <form id="newsletter-form" class="space-y-3">
                    <div>
                        <input type="email" 
                               id="newsletter-email" 
                               class="u-input w-full" 
                               placeholder="<?php esc_attr_e('tu@email.com', 'ecohierbas'); ?>" 
                               required>
                    </div>
                    <button type="submit" class="u-btn u-btn--primary w-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <?php esc_html_e('Suscribirse', 'ecohierbas'); ?>
                    </button>
                </form>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
                   class="u-btn u-btn--primary flex-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <?php esc_html_e('Ver Productos', 'ecohierbas'); ?>
                </a>
                <button id="offers-popup-dismiss" class="u-btn u-btn--outline flex-1">
                    <?php esc_html_e('Tal vez después', 'ecohierbas'); ?>
                </button>
            </div>

            <!-- Don't show again -->
            <div class="text-center mt-4">
                <label class="flex items-center justify-center text-sm text-muted-foreground cursor-pointer">
                    <input type="checkbox" id="dont-show-again" class="mr-2">
                    <?php esc_html_e('No mostrar de nuevo', 'ecohierbas'); ?>
                </label>
            </div>
        </div>
    </div>
</div>

<script>
// Offers Popup Functionality
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('offers-popup');
    const closeBtn = document.getElementById('offers-popup-close');
    const dismissBtn = document.getElementById('offers-popup-dismiss');
    const dontShowAgain = document.getElementById('dont-show-again');
    const newsletterForm = document.getElementById('newsletter-form');

    // Show popup after 3 seconds if not dismissed before
    setTimeout(() => {
        if (!localStorage.getItem('offers-popup-dismissed')) {
            showPopup();
        }
    }, 3000);

    // Show popup function
    function showPopup() {
        popup.classList.remove('hidden');
        popup.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        
        // Focus trap
        const focusableElements = popup.querySelectorAll('button, input, a');
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];
        
        if (firstFocusable) firstFocusable.focus();
        
        popup.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        lastFocusable.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        firstFocusable.focus();
                        e.preventDefault();
                    }
                }
            } else if (e.key === 'Escape') {
                hidePopup();
            }
        });
    }

    // Hide popup function
    function hidePopup() {
        popup.classList.add('hidden');
        popup.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        
        if (dontShowAgain.checked) {
            localStorage.setItem('offers-popup-dismissed', 'true');
        }
    }

    // Event listeners
    closeBtn.addEventListener('click', hidePopup);
    dismissBtn.addEventListener('click', hidePopup);
    
    // Close on overlay click
    popup.addEventListener('click', function(e) {
        if (e.target === popup) {
            hidePopup();
        }
    });

    // Newsletter form submission
    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('newsletter-email').value;
        
        // Here you would typically send the email to your newsletter service
        // For now, we'll just show a success message
        alert('¡Gracias por suscribirte! Recibirás nuestras ofertas especiales.');
        hidePopup();
    });
});

// Copy to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show temporary success message
        const originalText = event.target.textContent;
        event.target.textContent = '¡Copiado!';
        setTimeout(() => {
            event.target.textContent = originalText;
        }, 1000);
    }).catch(function(err) {
        console.error('Error copying text: ', err);
    });
}
</script>

<style>
@keyframes scale-in {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(-10px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.animate-scale-in {
    animation: scale-in 0.2s ease-out;
}
</style>