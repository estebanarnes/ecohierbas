<?php
/**
 * EcoHierbas Chile Theme Functions
 * 
 * @package EcoHierbas_Chile
 * @version 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================================
 * CONFIGURACIÓN BÁSICA DEL TEMA
 * ============================================================================
 */

// Configuración del tema
function ecohierbas_theme_setup() {
    // Soporte para título dinámico
    add_theme_support('title-tag');
    
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para menús
    add_theme_support('menus');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Soporte para editor de bloques
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => 'Menú Principal',
        'footer' => 'Menú Footer',
    ));
    
    // Tamaños de imagen personalizados
    add_image_size('product-thumbnail', 300, 300, true);
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('featured-image', 600, 400, true);
}
add_action('after_setup_theme', 'ecohierbas_theme_setup');

/**
 * ============================================================================
 * ENQUEUE SCRIPTS Y STYLES
 * ============================================================================
 */

function ecohierbas_enqueue_assets() {
    // CSS Principal
    wp_enqueue_style(
        'ecohierbas-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Tailwind CSS (CDN para desarrollo, compilar para producción)
    wp_enqueue_style(
        'tailwind-css',
        'https://cdn.tailwindcss.com',
        array(),
        '3.3.0'
    );
    
    // JavaScript principal
    wp_enqueue_script(
        'ecohierbas-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Localize script para AJAX
    wp_localize_script('ecohierbas-main', 'ecohierbas_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ecohierbas_nonce'),
        'cart_url' => wc_get_cart_url(),
        'checkout_url' => wc_get_checkout_url(),
    ));
    
    // Iconos Hero
    wp_enqueue_script(
        'heroicons',
        'https://unpkg.com/heroicons@2.0.18/24/outline/index.js',
        array(),
        '2.0.18',
        true
    );
    
    // Lucide Icons
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest/dist/umd/lucide.js',
        array(),
        'latest',
        true
    );
}
add_action('wp_enqueue_scripts', 'ecohierbas_enqueue_assets');

/**
 * ============================================================================
 * SOPORTE WOOCOMMERCE
 * ============================================================================
 */

// Declarar soporte para WooCommerce
function ecohierbas_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'ecohierbas_woocommerce_support');

// Personalizar número de productos por página
function ecohierbas_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'ecohierbas_products_per_page', 20);

/**
 * ============================================================================
 * FUNCIONES AJAX PARA CARRITO
 * ============================================================================
 */

// Agregar producto al carrito vía AJAX
function ecohierbas_add_to_cart() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');
    
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']) ?: 1;
    
    if ($product_id > 0) {
        $result = WC()->cart->add_to_cart($product_id, $quantity);
        
        if ($result) {
            wp_send_json_success(array(
                'message' => 'Producto agregado al carrito',
                'cart_count' => WC()->cart->get_cart_contents_count(),
                'cart_total' => WC()->cart->get_cart_total(),
            ));
        } else {
            wp_send_json_error(array('message' => 'Error al agregar producto'));
        }
    }
    
    wp_send_json_error(array('message' => 'Producto no válido'));
}
add_action('wp_ajax_ecohierbas_add_to_cart', 'ecohierbas_add_to_cart');
add_action('wp_ajax_nopriv_ecohierbas_add_to_cart', 'ecohierbas_add_to_cart');

// Obtener contenido del carrito vía AJAX
function ecohierbas_get_cart_content() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');
    
    ob_start();
    wc_get_template('cart/mini-cart.php');
    $cart_html = ob_get_clean();
    
    wp_send_json_success(array(
        'cart_html' => $cart_html,
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
    ));
}
add_action('wp_ajax_ecohierbas_get_cart_content', 'ecohierbas_get_cart_content');
add_action('wp_ajax_nopriv_ecohierbas_get_cart_content', 'ecohierbas_get_cart_content');

// Remover producto del carrito vía AJAX
function ecohierbas_remove_from_cart() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    
    if (WC()->cart->remove_cart_item($cart_item_key)) {
        wp_send_json_success(array(
            'message' => 'Producto removido del carrito',
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total(),
        ));
    }
    
    wp_send_json_error(array('message' => 'Error al remover producto'));
}
add_action('wp_ajax_ecohierbas_remove_from_cart', 'ecohierbas_remove_from_cart');
add_action('wp_ajax_nopriv_ecohierbas_remove_from_cart', 'ecohierbas_remove_from_cart');

/**
 * ============================================================================
 * FUNCIONES DE PRODUCTOS
 * ============================================================================
 */

// Obtener productos destacados
function ecohierbas_get_featured_products($limit = 8) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => '_featured',
                'value' => 'yes',
                'compare' => '='
            )
        ),
        'post_status' => 'publish'
    );
    
    return new WP_Query($args);
}

// Obtener productos por categoría
function ecohierbas_get_products_by_category($category_slug, $limit = 12) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category_slug
            )
        ),
        'post_status' => 'publish'
    );
    
    return new WP_Query($args);
}

// Obtener categorías de productos
function ecohierbas_get_product_categories() {
    return get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'parent' => 0 // Solo categorías padre
    ));
}

/**
 * ============================================================================
 * FUNCIONES WPFORMS
 * ============================================================================
 */

// Integración con WPForms
function ecohierbas_wpforms_integration() {
    // Verificar si WPForms está activo
    if (!function_exists('wpforms')) {
        return false;
    }
    
    return true;
}

// Shortcode personalizado para formulario de contacto
function ecohierbas_contact_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'id' => '1', // ID del formulario WPForms
        'title' => 'Contáctanos',
        'description' => 'Completa el formulario y nos contactaremos contigo'
    ), $atts);
    
    ob_start();
    ?>
    <div class="contact-form-section">
        <div class="u-container">
            <div class="contact-form-header u-text-center">
                <h2><?php echo esc_html($atts['title']); ?></h2>
                <p><?php echo esc_html($atts['description']); ?></p>
            </div>
            <div class="contact-form">
                <?php echo do_shortcode('[wpforms id="' . esc_attr($atts['id']) . '"]'); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ecohierbas_contact_form', 'ecohierbas_contact_form_shortcode');

/**
 * ============================================================================
 * WIDGETS Y SIDEBARS
 * ============================================================================
 */

function ecohierbas_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar Principal',
        'id' => 'sidebar-1',
        'description' => 'Widgets para la barra lateral principal',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => 'Footer 1',
        'id' => 'footer-1',
        'description' => 'Primera columna del footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'ecohierbas_widgets_init');

/**
 * ============================================================================
 * FUNCIONES DE UTILIDAD
 * ============================================================================
 */

// Función para mostrar breadcrumbs
function ecohierbas_breadcrumbs() {
    if (function_exists('woocommerce_breadcrumb')) {
        woocommerce_breadcrumb();
    } else {
        // Breadcrumbs básicos para páginas normales
        $breadcrumb = '<nav class="breadcrumbs">';
        $breadcrumb .= '<a href="' . home_url() . '">Inicio</a>';
        
        if (is_page()) {
            $breadcrumb .= ' > ' . get_the_title();
        } elseif (is_single()) {
            $category = get_the_category();
            if ($category) {
                $breadcrumb .= ' > ' . $category[0]->name;
            }
            $breadcrumb .= ' > ' . get_the_title();
        }
        
        $breadcrumb .= '</nav>';
        echo $breadcrumb;
    }
}

// Función para obtener la imagen destacada con fallback
function ecohierbas_get_featured_image($post_id = null, $size = 'full', $fallback = true) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    } elseif ($fallback) {
        return get_template_directory_uri() . '/assets/images/placeholder.jpg';
    }
    
    return false;
}

// Función para truncar texto
function ecohierbas_truncate_text($text, $length = 150, $suffix = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    return substr($text, 0, $length) . $suffix;
}

/**
 * ============================================================================
 * SEO Y META TAGS
 * ============================================================================
 */

// Meta tags personalizados
function ecohierbas_custom_meta_tags() {
    // Meta viewport
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
    
    // Meta de la empresa
    echo '<meta name="author" content="EcoHierbas Chile">' . "\n";
    echo '<meta name="language" content="es">' . "\n";
    echo '<meta name="geo.region" content="CL">' . "\n";
    echo '<meta name="geo.country" content="Chile">' . "\n";
    
    // Open Graph básico
    if (is_front_page()) {
        echo '<meta property="og:title" content="EcoHierbas Chile - Productos Orgánicos y Sustentables">' . "\n";
        echo '<meta property="og:description" content="Empresa chilena especializada en productos orgánicos, hierbas medicinales y sistemas de vermicompostaje sustentables.">' . "\n";
    } elseif (is_single() || is_page()) {
        echo '<meta property="og:title" content="' . get_the_title() . ' - EcoHierbas Chile">' . "\n";
        
        $description = get_the_excerpt();
        if (empty($description)) {
            $description = ecohierbas_truncate_text(get_the_content(), 160);
        }
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        
        $image = ecohierbas_get_featured_image(get_the_ID(), 'large');
        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        }
    }
    
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . get_permalink() . '">' . "\n";
    echo '<meta property="og:site_name" content="EcoHierbas Chile">' . "\n";
}
add_action('wp_head', 'ecohierbas_custom_meta_tags');

/**
 * ============================================================================
 * PERSONALIZACIÓN DE WORDPRESS
 * ============================================================================
 */

// Remover versión de WordPress del head
remove_action('wp_head', 'wp_generator');

// Limpiar wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Personalizar extracto
function ecohierbas_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'ecohierbas_excerpt_length');

function ecohierbas_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ecohierbas_excerpt_more');

/**
 * ============================================================================
 * HOOKS DE ACTIVACIÓN/DESACTIVACIÓN
 * ============================================================================
 */

// Al activar el tema
function ecohierbas_theme_activation() {
    // Flush rewrite rules
    flush_rewrite_rules();
    
    // Configurar permalinks a /%postname%/
    update_option('permalink_structure', '/%postname%/');
}
add_action('after_switch_theme', 'ecohierbas_theme_activation');

/**
 * ============================================================================
 * SEGURIDAD Y OPTIMIZACIÓN
 * ============================================================================
 */

// Desactivar emojis de WordPress
function ecohierbas_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'ecohierbas_disable_emojis');

// Remover jQuery Migrate
function ecohierbas_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'ecohierbas_remove_jquery_migrate');

?>