<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    
    <!-- Preconnect para performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Fuentes (idénticas al React) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>">
    <meta property="og:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta property="og:image" content="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="twitter:title" content="<?php wp_title('|', true, 'right'); ?>">
    <meta property="twitter:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta property="twitter:image" content="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Header Principal -->
    <header class="site-header" role="banner">
        <div class="u-container">
            <nav class="header-nav" role="navigation" aria-label="<?php esc_attr_e('Navegación principal', 'ecohierbas'); ?>">
                <!-- Logo -->
                <div class="site-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Ir al inicio', 'ecohierbas'); ?>">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                                 alt="<?php esc_attr_e('EcoHierbas Chile', 'ecohierbas'); ?>" 
                                 width="48" 
                                 height="48">
                        <?php endif; ?>
                    </a>
                </div>

                <!-- Navegación Principal (Desktop) -->
                <div class="main-navigation hidden-mobile" id="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                        'fallback_cb'    => 'ecohierbas_fallback_menu',
                    ));
                    ?>
                </div>

                <!-- Botones de acción -->
                <div class="header-actions">
                    <div class="flex items-center gap-4">
                        <!-- Botón B2B Quote -->
                        <button 
                            class="u-btn u-btn--outline hidden-mobile" 
                            id="b2b-quote-btn"
                            aria-label="<?php esc_attr_e('Solicitar cotización B2B', 'ecohierbas'); ?>">
                            <?php esc_html_e('Cotización B2B', 'ecohierbas'); ?>
                        </button>

                        <!-- Carrito (solo si WooCommerce está activo) -->
                        <?php if (class_exists('WooCommerce')) : ?>
                        <button 
                            class="u-btn u-btn--primary cart-toggle" 
                            id="cart-toggle"
                            data-cart-trigger
                            aria-label="<?php esc_attr_e('Abrir carrito de compras', 'ecohierbas'); ?>">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.1 5.1M7 13v6a1 1 0 001 1h9a1 1 0 001-1v-6m-10 0h10"/>
                            </svg>
                            <span id="cart-count" class="cart-count" data-cart-count>0</span>
                        </button>
                        <?php endif; ?>

                        <!-- Toggle Menú Móvil -->
                        <button 
                            class="mobile-menu-toggle block-mobile" 
                            id="mobile-menu-toggle"
                            aria-label="<?php esc_attr_e('Abrir menú de navegación', 'ecohierbas'); ?>"
                            aria-expanded="false"
                            aria-controls="mobile-navigation">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 6h16v2H4V6zM4 11h16v2H4v-2zM4 16h16v2H4v-2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Navegación Móvil -->
            <div class="main-navigation block-mobile" id="mobile-navigation" style="display: none;">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'mobile-nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'ecohierbas_fallback_menu',
                ));
                ?>
                
                <!-- Botón B2B en móvil -->
                <div class="mobile-nav-actions" style="padding: 1rem 0; border-top: 1px solid hsl(var(--border));">
                    <button class="u-btn u-btn--outline w-full" id="mobile-b2b-quote-btn">
                        <?php esc_html_e('Cotización B2B', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Overlay para menú móvil -->
    <div class="mobile-menu-overlay" id="mobile-menu-overlay" style="display: none;"></div>

    <!-- Main Content Start -->