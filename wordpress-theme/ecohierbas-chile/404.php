<?php
/**
 * 404 Error Page
 * Mantiene diseño consistente con el tema
 */

get_header(); ?>

<main class="min-h-screen bg-background flex items-center">
    <div class="u-container">
        <div class="max-w-2xl mx-auto text-center">
            <!-- 404 Illustration -->
            <div class="mb-8">
                <div class="w-48 h-48 mx-auto bg-primary/10 rounded-full flex items-center justify-center">
                    <svg class="w-24 h-24 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.444-.783-6.131-2.1M6.131 6.1C7.556 4.783 9.66 4 12 4s4.444.783 5.869 2.1M4.929 4.929l14.142 14.142"></path>
                    </svg>
                </div>
            </div>

            <!-- Error Message -->
            <h1 class="text-6xl md:text-8xl font-serif font-bold text-foreground mb-4">404</h1>
            <h2 class="text-2xl md:text-3xl font-serif font-semibold text-foreground mb-6">
                <?php esc_html_e('Página no encontrada', 'ecohierbas'); ?>
            </h2>
            <p class="text-lg text-muted-foreground mb-8 leading-relaxed">
                <?php esc_html_e('Lo sentimos, la página que buscas no existe o ha sido movida. Te invitamos a explorar nuestro catálogo de productos orgánicos.', 'ecohierbas'); ?>
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url(home_url()); ?>" class="u-btn u-btn--primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <?php esc_html_e('Ir al inicio', 'ecohierbas'); ?>
                </a>
                
                <?php if (class_exists('WooCommerce')): ?>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="u-btn u-btn--outline">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <?php esc_html_e('Ver productos', 'ecohierbas'); ?>
                    </a>
                <?php endif; ?>

                <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <?php esc_html_e('Contactar', 'ecohierbas'); ?>
                </a>
            </div>

            <!-- Search -->
            <div class="mt-12 pt-8 border-t border-border">
                <h3 class="text-lg font-semibold mb-4"><?php esc_html_e('¿Buscas algo específico?', 'ecohierbas'); ?></h3>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="max-w-md mx-auto">
                    <div class="flex gap-2">
                        <input type="search" 
                               name="s" 
                               class="u-input flex-1" 
                               placeholder="<?php esc_attr_e('Buscar productos...', 'ecohierbas'); ?>"
                               value="<?php echo get_search_query(); ?>">
                        <button type="submit" class="u-btn u-btn--primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Popular Links -->
            <div class="mt-12">
                <h3 class="text-lg font-semibold mb-6"><?php esc_html_e('Páginas populares', 'ecohierbas'); ?></h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="<?php echo esc_url(home_url('/nosotros')); ?>" 
                       class="u-card hover:bg-muted/50 transition-colors">
                        <div class="u-card-content text-center py-4">
                            <svg class="w-8 h-8 mx-auto mb-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <span class="text-sm font-medium"><?php esc_html_e('Nosotros', 'ecohierbas'); ?></span>
                        </div>
                    </a>

                    <?php if (class_exists('WooCommerce')): ?>
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
                           class="u-card hover:bg-muted/50 transition-colors">
                            <div class="u-card-content text-center py-4">
                                <svg class="w-8 h-8 mx-auto mb-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span class="text-sm font-medium"><?php esc_html_e('Productos', 'ecohierbas'); ?></span>
                            </div>
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" 
                       class="u-card hover:bg-muted/50 transition-colors">
                        <div class="u-card-content text-center py-4">
                            <svg class="w-8 h-8 mx-auto mb-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm font-medium"><?php esc_html_e('Contacto', 'ecohierbas'); ?></span>
                        </div>
                    </a>

                    <a href="#" class="u-card hover:bg-muted/50 transition-colors" id="b2b-quote-404">
                        <div class="u-card-content text-center py-4">
                            <svg class="w-8 h-8 mx-auto mb-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-sm font-medium"><?php esc_html_e('Cotizar B2B', 'ecohierbas'); ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>