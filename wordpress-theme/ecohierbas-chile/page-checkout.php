<?php
/**
 * Página Checkout Personalizada
 * Replica el diseño del checkout del React original
 * Integra con WooCommerce pero mantiene el diseño custom
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <!-- Checkout Header -->
    <section class="py-8 bg-gradient-to-b from-primary/5 to-background">
        <div class="u-container">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumbs -->
                <nav class="mb-6" aria-label="<?php esc_attr_e('Navegación checkout', 'ecohierbas'); ?>">
                    <ol class="flex items-center space-x-2 text-sm text-muted-foreground">
                        <li><a href="<?php echo esc_url(home_url()); ?>" class="hover:text-primary"><?php esc_html_e('Inicio', 'ecohierbas'); ?></a></li>
                        <li><span>/</span></li>
                        <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="hover:text-primary"><?php esc_html_e('Productos', 'ecohierbas'); ?></a></li>
                        <li><span>/</span></li>
                        <li class="text-foreground"><?php esc_html_e('Checkout', 'ecohierbas'); ?></li>
                    </ol>
                </nav>

                <div class="text-center">
                    <h1 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                        <?php esc_html_e('Finalizar Compra', 'ecohierbas'); ?>
                    </h1>
                    <p class="text-muted-foreground">
                        <?php esc_html_e('Completa tu pedido de productos orgánicos', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Content -->
    <section class="py-8 md:py-16">
        <div class="u-container">
            <?php if (class_exists('WooCommerce')): ?>
                <?php
                // Verificar si hay items en el carrito
                if (WC()->cart->is_empty()):
                ?>
                    <!-- Empty Cart -->
                    <div class="max-w-2xl mx-auto text-center">
                        <div class="u-card">
                            <div class="u-card-content py-16">
                                <svg class="w-24 h-24 mx-auto text-muted-foreground mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
                                </svg>
                                <h2 class="text-2xl font-serif font-bold mb-4"><?php esc_html_e('Tu carrito está vacío', 'ecohierbas'); ?></h2>
                                <p class="text-muted-foreground mb-8">
                                    <?php esc_html_e('Agrega algunos productos a tu carrito antes de proceder al checkout.', 'ecohierbas'); ?>
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="u-btn u-btn--primary">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        <?php esc_html_e('Ver productos', 'ecohierbas'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(home_url()); ?>" class="u-btn u-btn--outline">
                                        <?php esc_html_e('Ir al inicio', 'ecohierbas'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="max-w-6xl mx-auto">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Checkout Form Column -->
                            <div class="lg:col-span-2">
                                <div class="u-card">
                                    <div class="u-card-header">
                                        <h2 class="text-2xl font-serif font-bold"><?php esc_html_e('Información de entrega', 'ecohierbas'); ?></h2>
                                        <p class="text-muted-foreground mt-2">
                                            <?php esc_html_e('Completa los datos para realizar tu pedido', 'ecohierbas'); ?>
                                        </p>
                                    </div>
                                    <div class="u-card-content">
                                        <!-- WooCommerce Checkout Form -->
                                        <div id="ecohierbas-checkout-form">
                                            <?php 
                                            // Remover estilos default de WooCommerce y usar nuestros estilos
                                            remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
                                            
                                            // Mostrar formulario de checkout de WooCommerce
                                            if (function_exists('woocommerce_checkout')):
                                                woocommerce_checkout();
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Methods Info -->
                                <div class="u-card mt-6">
                                    <div class="u-card-header">
                                        <h3 class="text-lg font-semibold"><?php esc_html_e('Métodos de pago', 'ecohierbas'); ?></h3>
                                    </div>
                                    <div class="u-card-content">
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                            <!-- Payment method icons -->
                                            <div class="flex items-center justify-center p-3 border border-border rounded-lg">
                                                <svg class="w-8 h-8 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M1,4V6H23V4M1,20H23V8H1M3,18H21V10H3"/>
                                                </svg>
                                                <span class="ml-2 text-sm"><?php esc_html_e('Tarjeta', 'ecohierbas'); ?></span>
                                            </div>
                                            <div class="flex items-center justify-center p-3 border border-border rounded-lg">
                                                <svg class="w-8 h-8 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>
                                                </svg>
                                                <span class="ml-2 text-sm"><?php esc_html_e('PayPal', 'ecohierbas'); ?></span>
                                            </div>
                                            <div class="flex items-center justify-center p-3 border border-border rounded-lg">
                                                <svg class="w-8 h-8 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                                                </svg>
                                                <span class="ml-2 text-sm"><?php esc_html_e('Transferencia', 'ecohierbas'); ?></span>
                                            </div>
                                            <div class="flex items-center justify-center p-3 border border-border rounded-lg">
                                                <svg class="w-8 h-8 text-muted-foreground" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12,2C13.1,2 14,2.9 14,4C14,5.1 13.1,6 12,6C10.9,6 10,5.1 10,4C10,2.9 10.9,2 12,2M21,9V7L15,1H5C3.89,1 3,1.89 3,3V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V9M19,19H5V3H13V9H19V19Z"/>
                                                </svg>
                                                <span class="ml-2 text-sm"><?php esc_html_e('Efectivo', 'ecohierbas'); ?></span>
                                            </div>
                                        </div>
                                        <div class="mt-4 p-4 bg-primary/5 rounded-lg">
                                            <div class="flex items-start gap-3">
                                                <svg class="w-5 h-5 text-primary mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>
                                                    <p class="font-medium text-foreground"><?php esc_html_e('Pago seguro', 'ecohierbas'); ?></p>
                                                    <p class="text-sm text-muted-foreground mt-1">
                                                        <?php esc_html_e('Tus datos están protegidos con encriptación SSL de 256 bits.', 'ecohierbas'); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Summary Column -->
                            <div class="lg:col-span-1">
                                <div class="u-card sticky top-8">
                                    <div class="u-card-header">
                                        <h3 class="text-xl font-serif font-bold"><?php esc_html_e('Resumen del pedido', 'ecohierbas'); ?></h3>
                                    </div>
                                    <div class="u-card-content">
                                        <!-- Cart Items -->
                                        <div class="space-y-4 mb-6">
                                            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item): ?>
                                                <?php
                                                $product = $cart_item['data'];
                                                $product_name = $product->get_name();
                                                $quantity = $cart_item['quantity'];
                                                $price = WC()->cart->get_product_price($product);
                                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'thumbnail');
                                                ?>
                                                <div class="flex items-center gap-3 p-3 border border-border rounded-lg">
                                                    <?php if ($image): ?>
                                                        <img src="<?php echo esc_url($image[0]); ?>" 
                                                             alt="<?php echo esc_attr($product_name); ?>"
                                                             class="w-12 h-12 object-cover rounded">
                                                    <?php else: ?>
                                                        <div class="w-12 h-12 bg-muted rounded flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="font-medium text-sm truncate"><?php echo esc_html($product_name); ?></h4>
                                                        <p class="text-sm text-muted-foreground">
                                                            <?php printf(esc_html__('Cantidad: %d', 'ecohierbas'), $quantity); ?>
                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <span class="font-semibold"><?php echo wp_kses_post($price); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <!-- Order Totals -->
                                        <div class="space-y-3 pt-4 border-t border-border">
                                            <div class="flex justify-between">
                                                <span class="text-muted-foreground"><?php esc_html_e('Subtotal', 'ecohierbas'); ?></span>
                                                <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                            </div>
                                            
                                            <?php if (WC()->cart->get_shipping_total() > 0): ?>
                                                <div class="flex justify-between">
                                                    <span class="text-muted-foreground"><?php esc_html_e('Envío', 'ecohierbas'); ?></span>
                                                    <span><?php echo WC()->cart->get_cart_shipping_total(); ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (WC()->cart->get_total_tax() > 0): ?>
                                                <div class="flex justify-between">
                                                    <span class="text-muted-foreground"><?php esc_html_e('IVA', 'ecohierbas'); ?></span>
                                                    <span><?php echo WC()->cart->get_total_tax(); ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <div class="flex justify-between pt-3 border-t border-border">
                                                <span class="text-lg font-semibold"><?php esc_html_e('Total', 'ecohierbas'); ?></span>
                                                <span class="text-lg font-bold text-primary"><?php echo WC()->cart->get_total(); ?></span>
                                            </div>
                                        </div>

                                        <!-- Trust Badges -->
                                        <div class="mt-6 pt-6 border-t border-border">
                                            <div class="space-y-3">
                                                <div class="flex items-center gap-3">
                                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-sm text-muted-foreground"><?php esc_html_e('Envío gratis desde $30.000', 'ecohierbas'); ?></span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-sm text-muted-foreground"><?php esc_html_e('Productos 100% orgánicos', 'ecohierbas'); ?></span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-sm text-muted-foreground"><?php esc_html_e('Garantía de satisfacción', 'ecohierbas'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Help Section -->
                                <div class="u-card mt-6">
                                    <div class="u-card-content text-center">
                                        <h4 class="font-semibold mb-2"><?php esc_html_e('¿Necesitas ayuda?', 'ecohierbas'); ?></h4>
                                        <p class="text-sm text-muted-foreground mb-4">
                                            <?php esc_html_e('Estamos aquí para ayudarte con tu pedido', 'ecohierbas'); ?>
                                        </p>
                                        <div class="flex flex-col gap-2">
                                            <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--outline text-sm">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                <?php esc_html_e('Contactar', 'ecohierbas'); ?>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr(get_option('ecohierbas_social_whatsapp', '56920188260')); ?>&text=<?php echo urlencode(__('Necesito ayuda con mi pedido', 'ecohierbas')); ?>" 
                                               target="_blank" rel="noopener noreferrer"
                                               class="u-btn u-btn--outline text-sm">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                                </svg>
                                                <?php esc_html_e('WhatsApp', 'ecohierbas'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <!-- WooCommerce not installed -->
                <div class="max-w-2xl mx-auto text-center">
                    <div class="u-card">
                        <div class="u-card-content py-16">
                            <svg class="w-24 h-24 mx-auto text-muted-foreground mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <h2 class="text-2xl font-serif font-bold mb-4"><?php esc_html_e('WooCommerce requerido', 'ecohierbas'); ?></h2>
                            <p class="text-muted-foreground mb-8">
                                <?php esc_html_e('Esta página requiere WooCommerce para funcionar correctamente. Por favor, instala y activa el plugin WooCommerce.', 'ecohierbas'); ?>
                            </p>
                            <a href="<?php echo esc_url(admin_url('plugin-install.php?s=woocommerce&tab=search&type=term')); ?>" class="u-btn u-btn--primary">
                                <?php esc_html_e('Instalar WooCommerce', 'ecohierbas'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<style>
/* Estilos personalizados para el checkout de WooCommerce */
#ecohierbas-checkout-form .woocommerce-checkout {
    /* Override WooCommerce default styles */
}

#ecohierbas-checkout-form .form-row {
    margin-bottom: 1rem;
}

#ecohierbas-checkout-form .form-row label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

#ecohierbas-checkout-form .form-row input,
#ecohierbas-checkout-form .form-row select,
#ecohierbas-checkout-form .form-row textarea {
    @apply u-input w-full;
}

#ecohierbas-checkout-form .woocommerce-checkout-payment {
    background: transparent;
    border: none;
    padding: 0;
}

#ecohierbas-checkout-form .payment_methods {
    list-style: none;
    padding: 0;
    margin: 0;
}

#ecohierbas-checkout-form .payment_methods li {
    margin-bottom: 1rem;
    padding: 1rem;
    border: 1px solid hsl(var(--border));
    border-radius: var(--radius);
}

#ecohierbas-checkout-form .place-order {
    width: 100%;
    margin-top: 1.5rem;
}

#ecohierbas-checkout-form #place_order {
    @apply u-btn u-btn--primary w-full text-lg py-3;
}

/* Responsive adjustments */
@media (max-width: 1023px) {
    .sticky {
        position: static;
    }
}
</style>

<?php get_footer(); ?>