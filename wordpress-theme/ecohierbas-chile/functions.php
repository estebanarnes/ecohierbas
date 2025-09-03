<?php
/**
 * EcoHierbas Chile Theme Functions
 * 
 * Funciones principales del tema WordPress migrado desde React
 * Mantiene la funcionalidad exacta del SPA original
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Constantes del tema
define('ECOHIERBAS_THEME_VERSION', '1.0.0');
define('ECOHIERBAS_THEME_PATH', get_template_directory());
define('ECOHIERBAS_THEME_URL', get_template_directory_uri());

// Cargar archivos de configuración
require_once ECOHIERBAS_THEME_PATH . '/inc/setup.php';
require_once ECOHIERBAS_THEME_PATH . '/inc/assets.php';
require_once ECOHIERBAS_THEME_PATH . '/inc/products.php';

/**
 * Configuración inicial del tema
 */
function ecohierbas_setup() {
    // Soporte para traducciones
    load_theme_textdomain('ecohierbas', ECOHIERBAS_THEME_PATH . '/languages');

    // Soporte para feeds automáticos
    add_theme_support('automatic-feed-links');

    // Soporte para título dinámico
    add_theme_support('title-tag');

    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Tamaños de imagen personalizados (idénticos a React)
    add_image_size('product-card', 300, 300, true);
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('featured-product', 400, 400, true);

    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Soporte para logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 64,
        'width'       => 64,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Registrar menús de navegación
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'ecohierbas'),
        'footer'  => __('Menú Footer', 'ecohierbas'),
    ));

    // Soporte para WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Soporte para Gutenberg
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Colores personalizados para el editor
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Verde Principal', 'ecohierbas'),
            'slug'  => 'primary',
            'color' => 'hsl(142, 69%, 40%)',
        ),
        array(
            'name'  => __('Tierra', 'ecohierbas'),
            'slug'  => 'secondary',
            'color' => 'hsl(29, 44%, 35%)',
        ),
        array(
            'name'  => __('Acento Cálido', 'ecohierbas'),
            'slug'  => 'accent',
            'color' => 'hsl(33, 82%, 55%)',
        ),
    ));
}
add_action('after_setup_theme', 'ecohierbas_setup');

/**
 * Registrar widgets areas
 */
function ecohierbas_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'ecohierbas'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets para la sidebar principal', 'ecohierbas'),
        'before_widget' => '<section id="%1$s" class="widget u-card %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 1', 'ecohierbas'),
        'id'            => 'footer-1',
        'description'   => __('Primera columna del footer', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 2', 'ecohierbas'),
        'id'            => 'footer-2',
        'description'   => __('Segunda columna del footer', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 3', 'ecohierbas'),
        'id'            => 'footer-3',
        'description'   => __('Tercera columna del footer', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 4', 'ecohierbas'),
        'id'            => 'footer-4',
        'description'   => __('Cuarta columna del footer', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'ecohierbas_widgets_init');

/**
 * Personalizar excerpt
 */
function ecohierbas_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'ecohierbas_excerpt_length');

function ecohierbas_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ecohierbas_excerpt_more');

/**
 * Agregar clases CSS body para mantener compatibilidad con React
 */
function ecohierbas_body_classes($classes) {
    // Agregar clase para identificar páginas
    if (is_front_page()) {
        $classes[] = 'page-home';
    } elseif (is_page('nosotros')) {
        $classes[] = 'page-nosotros';
    } elseif (is_shop() || is_product_category() || is_product_tag()) {
        $classes[] = 'page-productos';
    } elseif (is_page('contacto')) {
        $classes[] = 'page-contacto';
    } elseif (is_cart() || is_checkout()) {
        $classes[] = 'page-checkout';
    }

    // Agregar clase para WooCommerce
    if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || is_product())) {
        $classes[] = 'woocommerce-page';
    }

    return $classes;
}
add_filter('body_class', 'ecohierbas_body_classes');

/**
 * Configurar WooCommerce para mantener comportamiento del React
 */
function ecohierbas_woocommerce_setup() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Remover wrapper predeterminado de WooCommerce
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    // Remover sidebar de productos
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    // Personalizar breadcrumbs para que coincidan con el React
    add_filter('woocommerce_breadcrumb_defaults', 'ecohierbas_woocommerce_breadcrumbs');
    
    // Configurar productos por página (mismo que React)
    add_filter('loop_shop_per_page', function() {
        return 8; // Mismo número que en ProductGrid React
    });

    // Configurar columnas de productos (responsive como React)
    add_filter('loop_shop_columns', function() {
        return 4; // Desktop: 4 columnas, responsive en CSS
    });
}
add_action('init', 'ecohierbas_woocommerce_setup');

function ecohierbas_woocommerce_breadcrumbs($args) {
    $args['delimiter']   = ' <span class="breadcrumb-separator">/</span> ';
    $args['wrap_before'] = '<nav class="woocommerce-breadcrumb u-container"><div class="breadcrumbs">';
    $args['wrap_after']  = '</div></nav>';
    $args['before']      = '<span>';
    $args['after']       = '</span>';
    return $args;
}

/**
 * Configurar datos estructurados JSON-LD para SEO
 */
function ecohierbas_json_ld() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'EcoHierbas Chile',
        'url' => home_url(),
        'logo' => ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png',
        'description' => 'Empresa chilena especializada en productos orgánicos, hierbas medicinales y soluciones de vermicompostaje para un futuro más sustentable.',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => 'Camino El tambo',
            'addressLocality' => 'San Vicente Tagua Tagua',
            'addressRegion' => 'VI Región',
            'addressCountry' => 'Chile'
        ),
        'contactPoint' => array(
            '@type' => 'ContactPoint',
            'telephone' => '+56-9-1234-5678',
            'contactType' => 'customer service'
        ),
        'sameAs' => array(
            'https://www.instagram.com/ecohierbaschile/',
            'https://www.facebook.com/Ecohierbaschile/'
        )
    );

    // Agregar datos específicos para productos
    if (is_product()) {
        global $product;
        $product_schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->get_name(),
            'image' => wp_get_attachment_image_url($product->get_image_id(), 'full'),
            'description' => $product->get_description(),
            'sku' => $product->get_sku(),
            'offers' => array(
                '@type' => 'Offer',
                'price' => $product->get_price(),
                'priceCurrency' => 'CLP',
                'availability' => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'
            )
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($product_schema) . '</script>';
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
}
add_action('wp_head', 'ecohierbas_json_ld');

/**
 * Configurar metaboxes personalizados para páginas
 */
function ecohierbas_add_meta_boxes() {
    add_meta_box(
        'ecohierbas_page_options',
        __('Opciones de Página EcoHierbas', 'ecohierbas'),
        'ecohierbas_page_options_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ecohierbas_add_meta_boxes');

function ecohierbas_page_options_callback($post) {
    wp_nonce_field('ecohierbas_page_options', 'ecohierbas_page_options_nonce');
    
    $hero_image = get_post_meta($post->ID, '_ecohierbas_hero_image', true);
    $hero_title = get_post_meta($post->ID, '_ecohierbas_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, '_ecohierbas_hero_subtitle', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="ecohierbas_hero_image">' . __('Imagen Hero', 'ecohierbas') . '</label></th>';
    echo '<td><input type="text" id="ecohierbas_hero_image" name="ecohierbas_hero_image" value="' . esc_attr($hero_image) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="ecohierbas_hero_title">' . __('Título Hero', 'ecohierbas') . '</label></th>';
    echo '<td><input type="text" id="ecohierbas_hero_title" name="ecohierbas_hero_title" value="' . esc_attr($hero_title) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="ecohierbas_hero_subtitle">' . __('Subtítulo Hero', 'ecohierbas') . '</label></th>';
    echo '<td><textarea id="ecohierbas_hero_subtitle" name="ecohierbas_hero_subtitle" rows="3" class="large-text">' . esc_textarea($hero_subtitle) . '</textarea></td>';
    echo '</tr>';
    echo '</table>';
}

function ecohierbas_save_page_options($post_id) {
    if (!isset($_POST['ecohierbas_page_options_nonce']) || !wp_verify_nonce($_POST['ecohierbas_page_options_nonce'], 'ecohierbas_page_options')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ecohierbas_hero_image'])) {
        update_post_meta($post_id, '_ecohierbas_hero_image', sanitize_text_field($_POST['ecohierbas_hero_image']));
    }

    if (isset($_POST['ecohierbas_hero_title'])) {
        update_post_meta($post_id, '_ecohierbas_hero_title', sanitize_text_field($_POST['ecohierbas_hero_title']));
    }

    if (isset($_POST['ecohierbas_hero_subtitle'])) {
        update_post_meta($post_id, '_ecohierbas_hero_subtitle', sanitize_textarea_field($_POST['ecohierbas_hero_subtitle']));
    }
}
add_action('save_post', 'ecohierbas_save_page_options');

/**
 * Configurar opciones del tema
 */
function ecohierbas_theme_options() {
    add_theme_page(
        __('Opciones EcoHierbas', 'ecohierbas'),
        __('Opciones EcoHierbas', 'ecohierbas'),
        'manage_options',
        'ecohierbas-options',
        'ecohierbas_theme_options_page'
    );
}
add_action('admin_menu', 'ecohierbas_theme_options');

function ecohierbas_theme_options_page() {
    if (isset($_POST['submit'])) {
        update_option('ecohierbas_contact_phone', sanitize_text_field($_POST['contact_phone']));
        update_option('ecohierbas_contact_email', sanitize_email($_POST['contact_email']));
        update_option('ecohierbas_contact_address', sanitize_textarea_field($_POST['contact_address']));
        update_option('ecohierbas_social_instagram', esc_url_raw($_POST['social_instagram']));
        update_option('ecohierbas_social_facebook', esc_url_raw($_POST['social_facebook']));
        update_option('ecohierbas_social_whatsapp', sanitize_text_field($_POST['social_whatsapp']));
        
        echo '<div class="notice notice-success"><p>' . __('Opciones guardadas correctamente.', 'ecohierbas') . '</p></div>';
    }

    $phone = get_option('ecohierbas_contact_phone', '+56 9 1234 5678');
    $email = get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl');
    $address = get_option('ecohierbas_contact_address', 'Camino El tambo, San Vicente Tagua Tagua, VI Región, Chile');
    $instagram = get_option('ecohierbas_social_instagram', 'https://www.instagram.com/ecohierbaschile/');
    $facebook = get_option('ecohierbas_social_facebook', 'https://www.facebook.com/Ecohierbaschile/');
    $whatsapp = get_option('ecohierbas_social_whatsapp', '56920188260');
    ?>
    <div class="wrap">
        <h1><?php _e('Opciones EcoHierbas', 'ecohierbas'); ?></h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('Teléfono de Contacto', 'ecohierbas'); ?></th>
                    <td><input type="text" name="contact_phone" value="<?php echo esc_attr($phone); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Email de Contacto', 'ecohierbas'); ?></th>
                    <td><input type="email" name="contact_email" value="<?php echo esc_attr($email); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Dirección', 'ecohierbas'); ?></th>
                    <td><textarea name="contact_address" rows="3" class="large-text"><?php echo esc_textarea($address); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Instagram URL', 'ecohierbas'); ?></th>
                    <td><input type="url" name="social_instagram" value="<?php echo esc_attr($instagram); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Facebook URL', 'ecohierbas'); ?></th>
                    <td><input type="url" name="social_facebook" value="<?php echo esc_attr($facebook); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('WhatsApp Número', 'ecohierbas'); ?></th>
                    <td><input type="text" name="social_whatsapp" value="<?php echo esc_attr($whatsapp); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Remover elementos innecesarios para mantener diseño limpio
 */
function ecohierbas_clean_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'ecohierbas_clean_head');

/**
 * Desactivar barra de administrador para diseño limpio
 */
add_filter('show_admin_bar', '__return_false');