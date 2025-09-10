<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#4ade80">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="EcoHierbas Chile - Productos orgánicos, hierbas medicinales y vermicompostaje. Empresa especializada en soluciones sustentables para empresas y familias.">
    <meta name="keywords" content="hierbas medicinales, productos orgánicos, vermicompostaje, sustentabilidad, Chile, orgánico">
    <meta name="author" content="EcoHierbas Chile">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo is_home() ? get_bloginfo('name') . ' - ' . get_bloginfo('description') : wp_get_document_title(); ?>">
    <meta property="og:description" content="Productos orgánicos, hierbas medicinales y vermicompostaje. Soluciones sustentables desde Chile.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(home_url()); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo is_home() ? get_bloginfo('name') : wp_get_document_title(); ?>">
    <meta name="twitter:description" content="Productos orgánicos, hierbas medicinales y vermicompostaje desde Chile.">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    
    <!-- Preconnect para optimizar carga de fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-content u-container">
        <!-- Logo y Marca -->
        <div class="site-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                <img src="<?php echo ecohierbas_get_logo(); ?>" 
                     alt="<?php bloginfo('name'); ?>" 
                     class="logo-img">
                <div class="logo-text">
                    <span class="brand"><?php bloginfo('name'); ?></span>
                    <span class="country">Chile</span>
                </div>
            </a>
        </div>

        <!-- Navegación Principal (Desktop) -->
        <nav class="main-navigation" role="navigation" aria-label="Navegación principal">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav-menu',
                'fallback_cb' => false
            ));
            
            // Fallback si no hay menú configurado
            if (!has_nav_menu('primary')) :
            ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
                <a href="<?php echo esc_url(home_url('/nosotros')); ?>">Nosotros</a>
                <a href="<?php echo esc_url(home_url('/productos')); ?>">Productos</a>
                <a href="<?php echo esc_url(home_url('/contacto')); ?>">Contacto</a>
            <?php endif; ?>
        </nav>

        <!-- Acciones del Header -->
        <div class="header-actions">
            <!-- Carrito -->
            <button class="cart-button" id="cart-toggle" aria-label="Abrir carrito de compras">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H19M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
                </svg>
                <span class="cart-count" id="cart-count">
                    <?php echo ecohierbas_get_cart_count(); ?>
                </span>
            </button>

            <!-- Botón B2B -->
            <a href="<?php echo esc_url(home_url('/contacto')); ?>" 
               class="u-btn u-btn--primary b2b-quote-btn">
                Cotizar B2B
            </a>

            <!-- Toggle del menú móvil -->
            <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Abrir menú móvil">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Overlay para menú móvil -->
<div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>

<!-- Menú móvil -->
<nav class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Menú móvil">
    <div class="mobile-menu-header">
        <img src="<?php echo ecohierbas_get_logo(); ?>" 
             alt="<?php bloginfo('name'); ?>" 
             class="mobile-logo">
        <button class="mobile-menu-close" id="mobile-menu-close" aria-label="Cerrar menú">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    
    <div class="mobile-menu-content">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'mobile-nav-menu',
            'fallback_cb' => false
        ));
        
        // Fallback si no hay menú configurado
        if (!has_nav_menu('primary')) :
        ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-menu-item">Inicio</a>
            <a href="<?php echo esc_url(home_url('/nosotros')); ?>" class="mobile-menu-item">Nosotros</a>
            <a href="<?php echo esc_url(home_url('/productos')); ?>" class="mobile-menu-item">Productos</a>
            <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="mobile-menu-item">Contacto</a>
        <?php endif; ?>
        
        <div class="mobile-menu-actions">
            <a href="<?php echo esc_url(home_url('/contacto')); ?>" 
               class="u-btn u-btn--primary mobile-b2b-btn">
                Cotizar B2B
            </a>
        </div>
    </div>
</nav>

<!-- Panel del Carrito -->
<div class="cart-panel" id="cart-panel">
    <div class="cart-header">
        <h3>Carrito de Compras</h3>
        <button class="cart-close" id="cart-close" aria-label="Cerrar carrito">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    
    <div class="cart-items" id="cart-items">
        <!-- Los items se cargarán dinámicamente -->
    </div>
    
    <div class="cart-footer">
        <div class="cart-total">
            <span>Total:</span>
            <span id="cart-total-amount">$0</span>
        </div>
        
        <?php if (class_exists('WooCommerce')) : ?>
            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button">
                Ir al Checkout
            </a>
        <?php else : ?>
            <a href="<?php echo esc_url(home_url('/checkout')); ?>" class="checkout-button">
                Ir al Checkout
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Modal B2B (si se usa) -->
<div class="modal-overlay" id="b2b-modal">
    <div class="modal-content">
        <button class="modal-close" id="b2b-modal-close">&times;</button>
        
        <div style="padding: 2rem;">
            <h2 style="margin-bottom: 1rem;">Solicitud de Cotización B2B</h2>
            <p style="margin-bottom: 2rem; color: var(--eco-text-light);">
                Completa el formulario y nos pondremos en contacto contigo para una propuesta personalizada.
            </p>
            
            <form id="b2b-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <input type="hidden" name="action" value="b2b_quote">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('ecohierbas_b2b_nonce'); ?>">
                
                <div class="form-group">
                    <label class="form-label" for="company">Empresa *</label>
                    <input type="text" id="company" name="company" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="contact_name">Nombre del Contacto *</label>
                    <input type="text" id="contact_name" name="contact_name" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Email *</label>
                    <input type="email" id="email" name="email" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="phone">Teléfono</label>
                    <input type="tel" id="phone" name="phone" class="form-input">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="employees">Número de Empleados</label>
                    <select id="employees" name="employees" class="form-select">
                        <option value="">Selecciona un rango</option>
                        <option value="1-10">1-10 empleados</option>
                        <option value="11-50">11-50 empleados</option>
                        <option value="51-200">51-200 empleados</option>
                        <option value="201+">201+ empleados</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="products">Productos de Interés</label>
                    <select id="products" name="products" class="form-select">
                        <option value="">Selecciona una categoría</option>
                        <option value="hierbas">Hierbas Medicinales</option>
                        <option value="vermicompostaje">Vermicompostaje</option>
                        <option value="maceteros">Maceteros y Kits</option>
                        <option value="talleres">Talleres Empresariales</option>
                        <option value="todos">Todos los productos</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="message">Mensaje Adicional</label>
                    <textarea id="message" name="message" class="form-textarea" rows="4" 
                              placeholder="Cuéntanos más sobre tus necesidades..."></textarea>
                </div>
                
                <button type="submit" class="u-btn u-btn--primary" style="width: 100%;">
                    Enviar Solicitud
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Container para notificaciones toast -->
<div class="toast-container" id="toast-container"></div>

<!-- Schema.org JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "EcoHierbas Chile",
    "description": "Empresa especializada en productos orgánicos, hierbas medicinales y vermicompostaje",
    "url": "<?php echo esc_url(home_url()); ?>",
    "logo": "<?php echo ecohierbas_get_logo(); ?>",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "San Vicente Tagua Tagua",
        "addressRegion": "VI Región",
        "addressCountry": "CL"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "<?php echo ecohierbas_get_contact_info('phone'); ?>",
        "contactType": "customer service",
        "email": "<?php echo ecohierbas_get_contact_info('email'); ?>"
    },
    "sameAs": [
        "<?php echo ecohierbas_get_contact_info('instagram'); ?>",
        "<?php echo ecohierbas_get_contact_info('facebook'); ?>"
    ]
}
</script>

<div id="main-content">