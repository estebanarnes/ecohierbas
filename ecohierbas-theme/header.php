<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="main-nav">
    <div class="u-container">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="logo__icon">E</div>
                    <div class="logo__text">
                        <span class="logo__title"><?php bloginfo('name'); ?></span>
                        <span class="logo__subtitle"><?php bloginfo('description'); ?></span>
                    </div>
                <?php endif; ?>
            </a>

            <!-- Desktop Navigation -->
            <nav class="nav-menu hidden md:flex">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'nav-menu',
                    'fallback_cb' => function() {
                        echo '<a href="' . esc_url(home_url('/')) . '">Inicio</a>';
                        echo '<a href="' . esc_url(home_url('/about')) . '">Nosotros</a>';
                        if (class_exists('WooCommerce')) {
                            echo '<a href="' . esc_url(wc_get_page_permalink('shop')) . '">Productos</a>';
                        }
                        echo '<a href="' . esc_url(home_url('/contact')) . '">Contacto</a>';
                    },
                ));
                ?>
            </nav>

            <!-- Desktop Actions -->
            <div class="nav-actions hidden md:flex">
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="u-btn u-btn--outline relative">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.4 8h9.2m0-8v8a2 2 0 01-2 2H9a2 2 0 01-2-2v-8m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                        </svg>
                        Carrito
                        <span class="cart-count">
                            <?php echo WC()->cart->get_cart_contents_count(); ?>
                        </span>
                    </a>
                <?php endif; ?>
                
                <a href="#b2b-quote" class="u-btn u-btn--primary" onclick="openB2BModal()">
                    Cotizar B2B
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <nav class="mobile-menu hidden">
            <div class="py-6 space-y-6">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'mobile-nav-menu',
                    'fallback_cb' => function() {
                        echo '<a href="' . esc_url(home_url('/')) . '" class="mobile-nav-link">Inicio</a>';
                        echo '<a href="' . esc_url(home_url('/about')) . '" class="mobile-nav-link">Nosotros</a>';
                        if (class_exists('WooCommerce')) {
                            echo '<a href="' . esc_url(wc_get_page_permalink('shop')) . '" class="mobile-nav-link">Productos</a>';
                        }
                        echo '<a href="' . esc_url(home_url('/contact')) . '" class="mobile-nav-link">Contacto</a>';
                    },
                ));
                ?>
                
                <div class="pt-4 border-t border-border space-y-4">
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="u-btn u-btn--outline w-full">
                            Carrito (<?php echo WC()->cart->get_cart_contents_count(); ?>)
                        </a>
                    <?php endif; ?>
                    <a href="#b2b-quote" class="u-btn u-btn--primary w-full" onclick="openB2BModal()">
                        Cotizar B2B
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- B2B Quote Modal -->
<div id="b2b-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" onclick="closeB2BModal()">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Cotización B2B</h3>
                <button onclick="closeB2BModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <?php
            // Include WP Forms if available
            if (function_exists('wpforms_display')) {
                echo do_shortcode('[wpforms id="2" title="false"]'); // Assuming form ID 2 for B2B quotes
            } else {
                echo '<p>Configure WP Forms para mostrar el formulario de cotización B2B.</p>';
            }
            ?>
        </div>
    </div>
</div>

<style>
.mobile-nav-menu {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.mobile-nav-link {
    font-size: 1.125rem;
    font-weight: 500;
    color: hsl(var(--foreground));
    text-decoration: none;
    transition: color 0.2s;
}

.mobile-nav-link:hover {
    color: hsl(var(--primary));
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: hsl(var(--accent));
    color: hsl(var(--accent-foreground));
    font-size: 0.75rem;
    border-radius: 50%;
    width: 1.25rem;
    height: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>