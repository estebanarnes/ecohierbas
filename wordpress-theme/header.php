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

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo-wrapper">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'fallback_cb'    => 'ecohierbas_fallback_menu',
                    ));
                    ?>
                </nav>

                <?php if (class_exists('WooCommerce')) : ?>
                <div class="header-cart">
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">
                            <?php echo WC()->cart->get_cart_contents_count(); ?>
                        </span>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="sr-only"><?php _e('Menú Principal', 'ecohierbas'); ?></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">

<?php
/**
 * Fallback menu when no menu is assigned
 */
function ecohierbas_fallback_menu() {
    echo '<ul id="primary-menu">';
    
    // Home
    echo '<li><a href="' . esc_url(home_url('/')) . '">Inicio</a></li>';
    
    // Products page (if WooCommerce is active)
    if (class_exists('WooCommerce')) {
        $shop_page_id = wc_get_page_id('shop');
        if ($shop_page_id && $shop_page_id > 0) {
            echo '<li><a href="' . esc_url(get_permalink($shop_page_id)) . '">Productos</a></li>';
        }
    }
    
    // Static pages
    $pages = get_pages(array(
        'sort_column' => 'menu_order',
        'number' => 5,
    ));
    
    foreach ($pages as $page) {
        if (!in_array($page->post_name, array('shop', 'cart', 'checkout', 'my-account'))) {
            echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
        }
    }
    
    echo '</ul>';
}
?>