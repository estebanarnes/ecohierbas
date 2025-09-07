<?php
/**
 * Theme header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="u-container header-inner">
        <div class="branding">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
                <img src="https://via.placeholder.com/120x40?text=Logo" alt="EcoHierbas Chile" class="logo" />
                <div class="brand-text"><span class="title">EcoHierbas</span><span class="subtitle">Chile</span></div>
            </a>
        </div>
        <nav class="main-nav">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'menu',
                )
            );
            ?>
        </nav>
        <div class="actions">
            <button class="cart-button" aria-label="Ver carrito">
                🛒 <span class="cart-count"><?php echo ecohierbas_cart_count(); ?></span>
            </button>
            <button class="b2b-button" aria-controls="b2b-modal">Cotizar B2B</button>
        </div>
        <button class="menu-toggle" aria-label="Abrir menú" aria-controls="mobile-menu" aria-expanded="false">☰</button>
    </div>
    <nav id="mobile-menu" class="mobile-menu" aria-hidden="true">
        <button class="close-menu" aria-label="Cerrar">×</button>
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'mobile-menu-items',
            )
        );
        ?>
    </nav>
    <div class="menu-overlay" tabindex="-1"></div>
</header>
<div id="cart-panel" class="cart-panel">
    <div class="cart-inner">
        <button class="close-cart" aria-label="Cerrar">×</button>
        <ul class="cart-items"></ul>
        <div class="cart-total"></div>
        <a class="checkout-button" href="<?php echo esc_url( site_url( '/checkout' ) ); ?>">Ir al checkout</a>
    </div>
</div>
<div id="b2b-modal" class="b2b-modal">
    <div class="b2b-inner">
        <button class="close-b2b" aria-label="Cerrar">×</button>
        <h2>Solicitar cotización B2B</h2>
        <?php if ( isset( $_GET['sent'] ) ) : ?><p class="notice">Gracias por tu mensaje.</p><?php endif; ?>
        <form id="b2b-form" class="needs-validation" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
            <input type="hidden" name="action" value="ecohierbas_b2b" />
            <p><label>Nombre<br /><input type="text" name="name" required></label></p>
            <p><label>Email<br /><input type="email" name="email" required></label></p>
            <p><label>Mensaje<br /><textarea name="message" required></textarea></label></p>
            <p><button type="submit">Enviar</button></p>
        </form>
    </div>
</div>
<div id="toast-container" class="toast-container"></div>

