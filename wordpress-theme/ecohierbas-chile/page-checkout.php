<?php
/**
 * Plantilla para página Checkout personalizada
 * Reemplaza el checkout estándar de WooCommerce con diseño personalizado
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <?php if (class_exists('WooCommerce')): ?>
        
        <!-- Hero Section -->
        <section class="relative h-[40vh] flex items-center overflow-hidden">
            <!-- Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-accent/5"></div>
            
            <div class="relative z-10 u-container">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-serif font-bold text-foreground mb-4">
                        <?php esc_html_e('Finalizar Compra', 'ecohierbas'); ?>
                    </h1>
                    <p class="text-lg text-muted-foreground">
                        <?php esc_html_e('Estás a un paso de recibir tus productos orgánicos', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Checkout Content -->
        <section class="py-16">
            <div class="u-container">
                <div class="max-w-6xl mx-auto">
                    
                    <?php if (WC()->cart->is_empty()): ?>
                        <!-- Empty Cart State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 mx-auto mb-8 bg-muted/30 rounded-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-serif font-bold text-foreground mb-4">
                                <?php esc_html_e('Tu carrito está vacío', 'ecohierbas'); ?>
                            </h2>
                            <p class="text-muted-foreground mb-8">
                                <?php esc_html_e('Agrega algunos productos para continuar con tu compra', 'ecohierbas'); ?>
                            </p>
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
                               class="u-btn u-btn--primary">
                                <?php esc_html_e('Ver Productos', 'ecohierbas'); ?>
                            </a>
                        </div>
                    <?php else: ?>
                        
                        <!-- Checkout Form -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                            
                            <!-- Customer Information -->
                            <div class="lg:col-span-2">
                                <div class="u-card">
                                    <div class="u-card-content p-8">
                                        <h2 class="text-2xl font-serif font-bold text-foreground mb-6">
                                            <?php esc_html_e('Información de Facturación', 'ecohierbas'); ?>
                                        </h2>
                                        
                                        <!-- WooCommerce Checkout Form -->
                                        <?php
                                        // Output the WooCommerce checkout form
                                        if (function_exists('woocommerce_checkout')) {
                                            echo '<div class="woocommerce-checkout-wrapper">';
                                            woocommerce_checkout();
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Order Summary -->
                            <div class="lg:col-span-1">
                                <div class="sticky top-8">
                                    <div class="u-card">
                                        <div class="u-card-content p-6">
                                            <h3 class="text-xl font-serif font-semibold text-foreground mb-6">
                                                <?php esc_html_e('Resumen del Pedido', 'ecohierbas'); ?>
                                            </h3>
                                            
                                            <!-- Cart Items -->
                                            <div class="space-y-4 mb-6">
                                                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                                                    $product = $cart_item['data'];
                                                    $product_id = $cart_item['product_id'];
                                                    $quantity = $cart_item['quantity'];
                                                ?>
                                                    <div class="flex items-center gap-3 py-3 border-b border-border last:border-b-0">
                                                        <?php if (has_post_thumbnail($product_id)): ?>
                                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url($product_id, 'thumbnail')); ?>" 
                                                                 alt="<?php echo esc_attr($product->get_name()); ?>"
                                                                 class="w-12 h-12 object-cover rounded">
                                                        <?php endif; ?>
                                                        
                                                        <div class="flex-1">
                                                            <h4 class="font-medium text-foreground text-sm">
                                                                <?php echo esc_html($product->get_name()); ?>
                                                            </h4>
                                                            <p class="text-xs text-muted-foreground">
                                                                <?php esc_html_e('Cantidad:', 'ecohierbas'); ?> <?php echo esc_html($quantity); ?>
                                                            </p>
                                                        </div>
                                                        
                                                        <div class="text-right">
                                                            <span class="font-semibold text-foreground">
                                                                <?php echo WC()->cart->get_product_subtotal($product, $quantity); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            
                                            <!-- Totals -->
                                            <div class="space-y-3 pt-4 border-t border-border">
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-muted-foreground"><?php esc_html_e('Subtotal:', 'ecohierbas'); ?></span>
                                                    <span class="font-medium"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                                </div>
                                                
                                                <?php if (WC()->cart->get_shipping_total() > 0): ?>
                                                    <div class="flex justify-between text-sm">
                                                        <span class="text-muted-foreground"><?php esc_html_e('Envío:', 'ecohierbas'); ?></span>
                                                        <span class="font-medium"><?php echo WC()->cart->get_cart_shipping_total(); ?></span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="flex justify-between text-sm">
                                                        <span class="text-muted-foreground"><?php esc_html_e('Envío:', 'ecohierbas'); ?></span>
                                                        <span class="font-medium text-green-600"><?php esc_html_e('Gratis', 'ecohierbas'); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if (WC()->cart->get_total_tax() > 0): ?>
                                                    <div class="flex justify-between text-sm">
                                                        <span class="text-muted-foreground"><?php esc_html_e('IVA:', 'ecohierbas'); ?></span>
                                                        <span class="font-medium"><?php echo WC()->cart->get_total_tax(); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <div class="flex justify-between text-lg font-bold pt-3 border-t border-border">
                                                    <span class="text-foreground"><?php esc_html_e('Total:', 'ecohierbas'); ?></span>
                                                    <span class="text-primary"><?php echo WC()->cart->get_total(); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Security Badge -->
                                    <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                        <div class="flex items-center gap-2 text-green-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            <span class="text-sm font-medium"><?php esc_html_e('Compra 100% Segura', 'ecohierbas'); ?></span>
                                        </div>
                                        <p class="text-xs text-green-700 mt-1">
                                            <?php esc_html_e('Tus datos están protegidos con encriptación SSL', 'ecohierbas'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    <?php else: ?>
        <!-- WooCommerce No Activado -->
        <section class="py-16">
            <div class="u-container text-center">
                <h1 class="text-3xl font-serif font-bold text-foreground mb-4">
                    <?php esc_html_e('Tienda No Disponible', 'ecohierbas'); ?>
                </h1>
                <p class="text-muted-foreground mb-8">
                    <?php esc_html_e('El sistema de tienda no está configurado. Por favor contacta al administrador.', 'ecohierbas'); ?>
                </p>
                <a href="<?php echo esc_url(home_url()); ?>" class="u-btn u-btn--primary">
                    <?php esc_html_e('Volver al Inicio', 'ecohierbas'); ?>
                </a>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>