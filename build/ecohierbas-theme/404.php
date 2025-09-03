<?php
/**
 * 404 Error Page Template
 *
 * @package EcoHierbas
 */

get_header(); ?>

<main class="section">
    <div class="u-container">
        <div class="error404 text-center py-20">
            <div class="page-title text-8xl font-bold text-primary mb-8">404</div>
            <h1 class="text-3xl font-serif font-bold mb-4">Página no encontrada</h1>
            <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                Lo sentimos, la página que buscas no existe o ha sido movida. 
                Te invitamos a explorar nuestros productos orgánicos y soluciones sustentables.
            </p>
            
            <div class="space-y-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="u-btn u-btn--primary">
                    Volver al Inicio
                </a>
                
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="u-btn u-btn--outline">
                        Ver Productos
                    </a>
                <?php endif; ?>
            </div>

            <div class="mt-12">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>