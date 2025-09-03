<?php
/**
 * Página de Checkout
 */
get_header(); ?>

<main class="site-main">
    <?php if (class_exists('WooCommerce')) : ?>
        <section class="py-16 bg-gradient-to-br from-primary/10 to-secondary/10">
            <div class="u-container text-center">
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">Finalizar Compra</h1>
                <p class="text-lg text-muted-foreground">Completa tu pedido de forma segura y rápida</p>
            </div>
        </section>

        <section class="py-16">
            <div class="u-container">
                <?php if (WC()->cart->is_empty()) : ?>
                    <div class="text-center py-16">
                        <h2 class="text-2xl font-serif font-bold text-foreground mb-4">Tu carrito está vacío</h2>
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="u-btn u-btn--primary">Ver Productos</a>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <div class="lg:col-span-2">
                            <div class="bg-background border border-border rounded-lg p-8">
                                <h2 class="text-xl font-serif font-bold text-foreground mb-6">Información de Facturación</h2>
                                <?php
                                if (function_exists('woocommerce_checkout')) {
                                    woocommerce_checkout();
                                }
                                ?>
                            </div>
                        </div>
                        <div class="lg:col-span-1">
                            <div class="bg-muted/50 border border-border rounded-lg p-8 sticky top-8">
                                <h3 class="text-lg font-serif font-bold text-foreground mb-6">Resumen del Pedido</h3>
                                <div class="space-y-4 mb-6">
                                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                                        $product = $cart_item['data'];
                                        $quantity = $cart_item['quantity'];
                                        $subtotal = WC()->cart->get_product_subtotal($product, $quantity);
                                    ?>
                                        <div class="flex justify-between items-center py-2 border-b border-border">
                                            <span class="font-medium text-foreground"><?php echo esc_html($product->get_name()); ?> x<?php echo esc_html($quantity); ?></span>
                                            <span class="font-semibold text-foreground"><?php echo wp_kses_post($subtotal); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="space-y-3 py-4 border-t border-border">
                                    <div class="flex justify-between items-center">
                                        <span class="text-muted-foreground">Subtotal:</span>
                                        <span class="font-medium text-foreground"><?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></span>
                                    </div>
                                    <div class="flex justify-between items-center pt-3 border-t border-border">
                                        <span class="text-lg font-bold text-foreground">Total:</span>
                                        <span class="text-lg font-bold text-foreground"><?php echo wp_kses_post(WC()->cart->get_total()); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php else : ?>
        <section class="py-16">
            <div class="u-container text-center">
                <h1 class="text-2xl font-bold text-foreground mb-4">Tienda No Disponible</h1>
                <p class="text-muted-foreground">La funcionalidad de tienda no está disponible en este momento.</p>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>