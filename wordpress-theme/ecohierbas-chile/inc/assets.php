<?php
/**
 * Gestión de assets (CSS y JS)
 * Replica exactamente el comportamiento de Vite del proyecto React
 */

if (!defined('ABSPATH')) {
    exit;
}

function ecohierbas_enqueue_assets() {
    // CSS principal
    wp_enqueue_style(
        'ecohierbas-style',
        get_stylesheet_uri(),
        array(),
        ECOHIERBAS_THEME_VERSION
    );
    
    // CSS compilado
    wp_enqueue_style(
        'ecohierbas-app',
        ECOHIERBAS_THEME_URL . '/assets/css/app.css',
        array(),
        ECOHIERBAS_THEME_VERSION
    );

    // JavaScript utilities (debe cargarse primero)
    wp_enqueue_script(
        'ecohierbas-utils',
        ECOHIERBAS_THEME_URL . '/assets/js/utils.js',
        array(),
        ECOHIERBAS_THEME_VERSION,
        true
    );
    
    // JavaScript modales
    wp_enqueue_script(
        'ecohierbas-modals',
        ECOHIERBAS_THEME_URL . '/assets/js/modals.js',
        array('ecohierbas-utils'),
        ECOHIERBAS_THEME_VERSION,
        true
    );
    
    // JavaScript carrito
    wp_enqueue_script(
        'ecohierbas-cart',
        ECOHIERBAS_THEME_URL . '/assets/js/cart.js',
        array('ecohierbas-utils'),
        ECOHIERBAS_THEME_VERSION,
        true
    );
    
    // JavaScript filtros (solo en páginas de productos)
    if (is_shop() || is_product_category() || is_product_tag() || is_post_type_archive('product')) {
        wp_enqueue_script(
            'ecohierbas-filters',
            ECOHIERBAS_THEME_URL . '/assets/js/filters.js',
            array('ecohierbas-utils'),
            ECOHIERBAS_THEME_VERSION,
            true
        );
    }

    // Configuración JavaScript global
    wp_localize_script('ecohierbas-utils', 'ecohierbas_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ecohierbas_nonce'),
        'home_url' => home_url(),
        'theme_url' => ECOHIERBAS_THEME_URL,
        'is_logged_in' => is_user_logged_in(),
        'wc_enabled' => class_exists('WooCommerce'),
        'cart_url' => class_exists('WooCommerce') ? wc_get_cart_url() : '',
        'checkout_url' => class_exists('WooCommerce') ? wc_get_checkout_url() : '',
        'currency_symbol' => class_exists('WooCommerce') ? get_woocommerce_currency_symbol() : '$',
        'strings' => array(
            'added_to_cart' => __('Producto agregado al carrito', 'ecohierbas'),
            'removed_from_cart' => __('Producto eliminado del carrito', 'ecohierbas'),
            'cart_updated' => __('Carrito actualizado', 'ecohierbas'),
            'error' => __('Ha ocurrido un error', 'ecohierbas'),
            'loading' => __('Cargando...', 'ecohierbas'),
            'close' => __('Cerrar', 'ecohierbas'),
        )
    ));

    // Cargar CSS específico para WooCommerce si está activo
    if (class_exists('WooCommerce')) {
        wp_enqueue_style(
            'ecohierbas-woocommerce',
            ECOHIERBAS_THEME_URL . '/assets/css/woocommerce.css',
            array('ecohierbas-app'),
            ECOHIERBAS_THEME_VERSION
        );
    }

    // Comentarios threaded
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ecohierbas_enqueue_assets');

/**
 * Enqueue assets para el admin
 */
function ecohierbas_admin_assets($hook) {
    // Solo cargar en páginas específicas del admin
    if ($hook !== 'appearance_page_ecohierbas-options') {
        return;
    }

    wp_enqueue_style(
        'ecohierbas-admin',
        ECOHIERBAS_THEME_URL . '/assets/css/admin.css',
        array(),
        ECOHIERBAS_THEME_VERSION
    );

    wp_enqueue_script(
        'ecohierbas-admin',
        ECOHIERBAS_THEME_URL . '/assets/js/admin.js',
        array('jquery'),
        ECOHIERBAS_THEME_VERSION,
        true
    );

    wp_localize_script('ecohierbas-admin', 'ECOHIERBAS_ADMIN', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ecohierbas_admin_nonce'),
    ));
}
add_action('admin_enqueue_scripts', 'ecohierbas_admin_assets');

/**
 * Inline critical CSS para performance
 */
function ecohierbas_critical_css() {
    // Solo en front-end y no en admin
    if (is_admin()) {
        return;
    }

    $critical_css = '
    /* Critical CSS inline para First Paint */
    :root {
        --primary: 142 69% 40%;
        --background: 48 33% 96%;
        --foreground: 215 25% 27%;
    }
    
    body {
        font-family: "Inter", system-ui, sans-serif;
        background-color: hsl(var(--background));
        color: hsl(var(--foreground));
        margin: 0;
        line-height: 1.6;
    }
    
    .site-header {
        background-color: hsl(0 0% 100% / 0.1);
        backdrop-filter: blur(16px);
        border-bottom: 1px solid hsl(0 0% 100% / 0.2);
        position: sticky;
        top: 0;
        z-index: 40;
    }
    
    .u-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .u-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
        border: none;
        text-decoration: none;
    }
    
    .u-btn--primary {
        background-color: hsl(var(--primary));
        color: white;
    }
    
    @media (min-width: 640px) {
        .u-container {
            padding: 0 1.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .u-container {
            padding: 0 2rem;
        }
    }
    ';

    echo '<style id="ecohierbas-critical-css">' . $critical_css . '</style>';
}
add_action('wp_head', 'ecohierbas_critical_css', 1);

/**
 * Preload assets críticos
 */
function ecohierbas_preload_assets() {
    // Preload CSS principal
    echo '<link rel="preload" href="' . get_stylesheet_uri() . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
    
    // Preload JavaScript principal
    echo '<link rel="preload" href="' . ECOHIERBAS_THEME_URL . '/assets/js/main.js" as="script">';
    
    // Preload fuentes críticas
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZ9hiJ-Ek-_EeA.woff2" as="font" type="font/woff2" crossorigin>';
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/playfairdisplay/v29/nuFvD-vYSZviVYUb_rj3ij__anPXJzDwcbmjWBN2PKeiukDRNGHSF9TrhOO1yg.woff2" as="font" type="font/woff2" crossorigin>';
}
add_action('wp_head', 'ecohierbas_preload_assets', 2);

/**
 * Optimizar carga de assets
 */
function ecohierbas_optimize_assets() {
    // Mover jQuery al footer para mejor performance
    if (!is_admin()) {
        wp_scripts()->add_data('jquery', 'group', 1);
        wp_scripts()->add_data('jquery-core', 'group', 1);
        wp_scripts()->add_data('jquery-migrate', 'group', 1);
    }
}
add_action('wp_enqueue_scripts', 'ecohierbas_optimize_assets');

/**
 * Defer JavaScript no crítico
 */
function ecohierbas_defer_scripts($tag, $handle, $src) {
    // Scripts que pueden ser diferidos
    $defer_scripts = array(
        'ecohierbas-product-filters',
        'ecohierbas-forms',
        'comment-reply',
    );

    if (in_array($handle, $defer_scripts)) {
        return str_replace('<script ', '<script defer ', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'ecohierbas_defer_scripts', 10, 3);

/**
 * Minificar HTML output
 */
function ecohierbas_minify_html($html) {
    if (is_admin() || defined('WP_DEBUG') && WP_DEBUG) {
        return $html;
    }

    // Remover comentarios HTML
    $html = preg_replace('/<!--(?!<!)[^\[>].*?-->/s', '', $html);
    
    // Remover espacios en blanco extra
    $html = preg_replace('/\s+/', ' ', $html);
    
    // Remover espacios alrededor de tags
    $html = preg_replace('/>\s+</', '><', $html);
    
    return trim($html);
}

// Solo activar minificación en producción
if (!defined('WP_DEBUG') || !WP_DEBUG) {
    add_action('get_header', function() {
        ob_start('ecohierbas_minify_html');
    });
    
    add_action('wp_footer', function() {
        ob_end_flush();
    });
}

/**
 * Resource hints para mejor performance
 */
function ecohierbas_resource_hints($urls, $relation_type) {
    switch ($relation_type) {
        case 'dns-prefetch':
            $urls[] = '//fonts.googleapis.com';
            $urls[] = '//fonts.gstatic.com';
            break;
            
        case 'preconnect':
            $urls[] = array(
                'href' => 'https://fonts.googleapis.com',
                'crossorigin',
            );
            $urls[] = array(
                'href' => 'https://fonts.gstatic.com',
                'crossorigin',
            );
            break;
    }
    
    return $urls;
}
add_filter('wp_resource_hints', 'ecohierbas_resource_hints', 10, 2);

/**
 * Service Worker para PWA básico
 */
function ecohierbas_service_worker() {
    if (isset($_GET['service-worker'])) {
        header('Content-Type: application/javascript');
        header('Service-Worker-Allowed: /');
        
        $sw_content = "
        const CACHE_NAME = 'ecohierbas-v1';
        const urlsToCache = [
            '/',
            '/wp-content/themes/ecohierbas-chile/style.css',
            '/wp-content/themes/ecohierbas-chile/assets/css/main.css',
            '/wp-content/themes/ecohierbas-chile/assets/js/main.js',
        ];

        self.addEventListener('install', function(event) {
            event.waitUntil(
                caches.open(CACHE_NAME)
                    .then(function(cache) {
                        return cache.addAll(urlsToCache);
                    })
            );
        });

        self.addEventListener('fetch', function(event) {
            event.respondWith(
                caches.match(event.request)
                    .then(function(response) {
                        if (response) {
                            return response;
                        }
                        return fetch(event.request);
                    }
                )
            );
        });
        ";
        
        echo $sw_content;
        exit;
    }
}
add_action('init', 'ecohierbas_service_worker');

/**
 * Registrar Service Worker
 */
function ecohierbas_register_sw() {
    if (!is_admin()) {
        echo "<script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/?service-worker=1')
                .then(function(registration) {
                    console.log('SW registered: ', registration);
                }).catch(function(registrationError) {
                    console.log('SW registration failed: ', registrationError);
                });
            });
        }
        </script>";
    }
}
add_action('wp_footer', 'ecohierbas_register_sw');