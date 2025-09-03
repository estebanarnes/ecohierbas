<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen bg-background">
    <header id="masthead" class="site-header bg-white/10 backdrop-blur-lg border-b border-white/20 sticky top-0 z-50 shadow-lg shadow-black/5">
        <div class="u-container">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-2" rel="home">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        echo wp_get_attachment_image($custom_logo_id, 'full', false, array('class' => 'w-16 h-16 object-contain'));
                    } else {
                        ?>
                        <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                             alt="<?php bloginfo('name'); ?>" 
                             class="w-16 h-16 object-contain">
                        <?php
                    }
                    ?>
                    <div class="flex flex-col">
                        <span class="text-lg font-serif font-semibold text-primary"><?php bloginfo('name'); ?></span>
                        <span class="text-xs text-muted-foreground -mt-1">Chile</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="u-hide-mobile" aria-label="<?php esc_attr_e('Menú principal', 'ecohierbas'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'flex items-center space-x-8',
                        'container' => false,
                        'fallback_cb' => 'ecohierbas_fallback_menu',
                        'link_class' => 'text-foreground hover:text-primary transition-colors font-medium',
                    ));
                    ?>
                </nav>

                <!-- Desktop Actions -->
                <div class="u-hide-mobile flex items-center space-x-4">
                    <!-- Cart Button -->
                    <button class="relative p-2 text-foreground hover:text-primary transition-colors" 
                            id="cart-toggle"
                            aria-label="<?php esc_attr_e('Abrir carrito', 'ecohierbas'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
                        </svg>
                        <?php if (class_exists('WooCommerce') && WC()->cart->get_cart_contents_count() > 0): ?>
                            <span class="absolute -top-1 -right-1 bg-accent text-accent-foreground text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                <?php echo WC()->cart->get_cart_contents_count(); ?>
                            </span>
                        <?php endif; ?>
                    </button>
                    
                    <!-- B2B Quote Button -->
                    <button class="u-btn u-btn--primary" id="b2b-quote-btn">
                        <?php esc_html_e('Cotizar B2B', 'ecohierbas'); ?>
                    </button>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="u-btn u-btn--ghost" 
                            id="mobile-menu-toggle"
                            aria-expanded="false"
                            aria-label="<?php esc_attr_e('Abrir menú', 'ecohierbas'); ?>">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-lg border-t border-white/20">
            <div class="u-container py-4">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'flex flex-col space-y-4',
                    'container' => false,
                    'fallback_cb' => 'ecohierbas_fallback_menu',
                    'link_class' => 'text-lg font-medium text-foreground hover:text-primary transition-colors',
                ));
                ?>
                <div class="pt-4 border-t border-border space-y-4">
                    <button class="u-btn u-btn--primary w-full" id="mobile-b2b-quote-btn">
                        <?php esc_html_e('Cotizar B2B', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">

<?php
// Función fallback para el menú
function ecohierbas_fallback_menu() {
    $menu_items = array(
        array('title' => 'Inicio', 'url' => home_url('/')),
        array('title' => 'Nosotros', 'url' => home_url('/nosotros')),
        array('title' => 'Productos', 'url' => home_url('/productos')),
        array('title' => 'Contacto', 'url' => home_url('/contacto')),
    );

    echo '<ul class="flex items-center space-x-8">';
    foreach ($menu_items as $item) {
        $current = (trailingslashit(home_url(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) === trailingslashit($item['url'])) ? ' current' : '';
        echo '<li><a href="' . esc_url($item['url']) . '" class="text-foreground hover:text-primary transition-colors font-medium' . $current . '">' . esc_html($item['title']) . '</a></li>';
    }
    echo '</ul>';
}
?>