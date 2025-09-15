<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Preconnect para performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="site-header">
    <div class="u-container">
        <div class="header-container">
            
            <!-- Logo -->
            <a href="<?php echo home_url(); ?>" class="site-logo">
                <?php 
                $logo_url = get_template_directory_uri() . '/assets/images/ecohierbas-logo.png';
                if (function_exists('get_theme_file_uri')) {
                    $logo_check = get_theme_file_path('/assets/images/ecohierbas-logo.png');
                    if (!file_exists($logo_check)) {
                        // Fallback al logo por defecto
                        $logo_url = 'data:image/svg+xml;base64,' . base64_encode('
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">
                                <circle cx="32" cy="32" r="30" fill="#16a34a" opacity="0.1"/>
                                <path d="M32 8C20 8 12 16 12 28c0 8 4 14 8 18l12 10 12-10c4-4 8-10 8-18 0-12-8-20-20-20z" fill="#16a34a"/>
                                <circle cx="32" cy="28" r="8" fill="#ffffff"/>
                                <path d="M28 24l3 3 5-5" stroke="#16a34a" stroke-width="2" fill="none"/>
                            </svg>
                        ');
                    }
                }
                ?>
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>">
                <div class="logo-text">
                    <span><?php bloginfo('name'); ?></span>
                    <span>Chile</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => function() {
                        // Menú por defecto si no hay menú configurado
                        echo '<a href="' . home_url() . '">Inicio</a>';
                        echo '<a href="' . get_permalink(get_page_by_path('nosotros')) . '">Nosotros</a>';
                        echo '<a href="' . get_permalink(wc_get_page_id('shop')) . '">Productos</a>';
                        echo '<a href="' . get_permalink(get_page_by_path('contacto')) . '">Contacto</a>';
                    }
                ));
                ?>
            </nav>

            <!-- Desktop Actions -->
            <div class="header-actions">
                <!-- Cart Icon -->
                <div class="cart-icon">
                    <button type="button" id="cart-toggle" class="btn-cart" style="background: none; border: none; cursor: pointer; position: relative; padding: 0.5rem;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a1 1 0 001 1h9a1 1 0 001-1v-6M9 19v2m6-2v2"/>
                        </svg>
                        <?php if (function_exists('WC') && WC()->cart) : ?>
                            <span class="cart-badge" id="cart-count" style="<?php echo WC()->cart->get_cart_contents_count() > 0 ? '' : 'display: none;'; ?>">
                                <?php echo WC()->cart->get_cart_contents_count(); ?>
                            </span>
                        <?php endif; ?>
                    </button>
                </div>

                <!-- B2B Quote Button -->
                <button type="button" id="b2b-quote-btn" class="btn btn-primary">
                    Cotizar B2B
                </button>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="mobile-menu-toggle">
                <button type="button" id="mobile-menu-btn" class="mobile-menu-button" style="background: none; border: none; cursor: pointer; padding: 0.5rem;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 12h18M3 6h18M3 18h18"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="position: absolute; top: 0; right: 0; width: 320px; height: 100%; background: hsl(var(--card)); padding: 2rem; overflow-y: auto;">
        <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 2rem;">
            <h3 style="margin: 0;">Menú</h3>
            <button type="button" id="mobile-menu-close" style="background: none; border: none; cursor: pointer; padding: 0.5rem;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <nav style="display: flex; flex-direction: column; gap: 1.5rem;">
            <a href="<?php echo home_url(); ?>" style="text-decoration: none; font-size: 1.125rem; font-weight: 500; color: hsl(var(--foreground));">Inicio</a>
            <a href="<?php echo get_permalink(get_page_by_path('nosotros')); ?>" style="text-decoration: none; font-size: 1.125rem; font-weight: 500; color: hsl(var(--foreground));">Nosotros</a>
            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" style="text-decoration: none; font-size: 1.125rem; font-weight: 500; color: hsl(var(--foreground));">Productos</a>
            <a href="<?php echo get_permalink(get_page_by_path('contacto')); ?>" style="text-decoration: none; font-size: 1.125rem; font-weight: 500; color: hsl(var(--foreground));">Contacto</a>
        </nav>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid hsl(var(--border));">
            <button type="button" class="btn btn-primary" style="width: 100%;" onclick="document.getElementById('b2b-quote-modal').style.display='block';">
                Cotizar B2B
            </button>
        </div>
    </div>
</div>

<!-- Cart Sidebar -->
<div id="cart-sidebar" class="cart-sidebar">
    <div style="padding: 1.5rem; border-bottom: 1px solid hsl(var(--border)); display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600;">Carrito de Compras</h3>
        <button type="button" id="cart-close" style="background: none; border: none; cursor: pointer; padding: 0.5rem;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>
    
    <div id="cart-content" style="flex: 1; overflow-y: auto; padding: 1.5rem;">
        <?php if (function_exists('WC') && WC()->cart) : ?>
            <?php if (WC()->cart->is_empty()) : ?>
                <div style="text-align: center; padding: 2rem 0; color: hsl(var(--muted-foreground));">
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 1rem; opacity: 0.5;">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a1 1 0 001 1h9a1 1 0 001-1v-6"/>
                    </svg>
                    <p>Tu carrito está vacío</p>
                </div>
            <?php else : ?>
                <div id="cart-items">
                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : 
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                    ?>
                    <div class="cart-item" style="display: flex; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid hsl(var(--border));">
                        <div style="width: 4rem; height: 4rem; flex-shrink: 0;">
                            <?php 
                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                            echo $thumbnail;
                            ?>
                        </div>
                        <div style="flex: 1;">
                            <h4 style="font-size: 0.875rem; font-weight: 500; margin: 0 0 0.5rem;"><?php echo $_product->get_name(); ?></h4>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; color: hsl(var(--muted-foreground));">
                                    <?php echo $cart_item['quantity']; ?> × <?php echo WC()->cart->get_product_price($_product); ?>
                                </span>
                                <button type="button" class="remove-cart-item" data-cart-key="<?php echo $cart_item_key; ?>" style="background: none; border: none; color: hsl(var(--destructive)); cursor: pointer; padding: 0.25rem;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endif; endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <?php if (function_exists('WC') && WC()->cart && !WC()->cart->is_empty()) : ?>
    <div style="padding: 1.5rem; border-top: 1px solid hsl(var(--border));">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; font-weight: 600; font-size: 1.125rem;">
            <span>Total:</span>
            <span id="cart-total"><?php echo WC()->cart->get_cart_total(); ?></span>
        </div>
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-secondary" style="text-align: center; text-decoration: none;">
                Ver Carrito
            </a>
            <a href="<?php echo wc_get_checkout_url(); ?>" class="btn btn-primary" style="text-align: center; text-decoration: none;">
                Finalizar Compra
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Cart Overlay -->
<div id="cart-overlay" class="cart-overlay"></div>

<!-- B2B Quote Modal -->
<div id="b2b-quote-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1001; align-items: center; justify-content: center;">
    <div style="background: hsl(var(--card)); border-radius: var(--eco-radius-l); max-width: 500px; margin: 2rem; max-height: 90vh; overflow-y: auto;">
        <div style="padding: 1.5rem; border-bottom: 1px solid hsl(var(--border)); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600;">Cotización B2B</h3>
            <button type="button" onclick="document.getElementById('b2b-quote-modal').style.display='none';" style="background: none; border: none; cursor: pointer; padding: 0.5rem;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div style="padding: 1.5rem;">
            <?php echo do_shortcode('[ecohierbas_contact_form id="2" title="Solicitar Cotización B2B" description="Completa el formulario para recibir una cotización personalizada"]'); ?>
        </div>
    </div>
</div>