<?php
/**
 * Template Part: Featured Products
 * Replica exactamente el componente FeaturedProducts.tsx
 */

$products = ecohierbas_get_featured_products();
if (empty($products)) {
    $products = array_slice(ecohierbas_get_products(), 0, 4);
}
?>

<section class="py-16 md:py-24 bg-background">
    <div class="u-container">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('Productos Destacados', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
                <?php esc_html_e('Descubre nuestra selección de productos más populares, cuidadosamente elegidos por su calidad excepcional y beneficios para tu bienestar.', 'ecohierbas'); ?>
            </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <?php foreach ($products as $product): ?>
                <?php get_template_part('template-parts/product-card', null, array('product' => $product)); ?>
            <?php endforeach; ?>
        </div>

        <!-- CTA Section -->
        <div class="text-center">
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
               class="u-btn u-btn--primary text-lg px-8 py-4">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <?php esc_html_e('Ver Todos los Productos', 'ecohierbas'); ?>
            </a>
        </div>

        <!-- Trust Indicators -->
        <div class="mt-16 pt-16 border-t border-border">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Calidad Garantizada', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground"><?php esc_html_e('Productos 100% orgánicos certificados', 'ecohierbas'); ?></p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Envío Rápido', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground"><?php esc_html_e('Entrega a todo Chile en 2-5 días', 'ecohierbas'); ?></p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Sustentable', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground"><?php esc_html_e('Compromiso con el medio ambiente', 'ecohierbas'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>