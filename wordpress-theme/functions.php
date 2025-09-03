<?php
/**
 * Ecohierbas Theme Functions
 *
 * @package Ecohierbas
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function ecohierbas_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'ecohierbas'),
        'footer' => __('Menú Footer', 'ecohierbas'),
    ));
    
    // Set image sizes
    add_image_size('product-thumbnail', 300, 300, true);
    add_image_size('hero-image', 1200, 600, true);
}
add_action('after_setup_theme', 'ecohierbas_setup');

/**
 * Enqueue Scripts and Styles
 */
function ecohierbas_scripts() {
    // Theme stylesheet
    wp_enqueue_style('ecohierbas-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Font Awesome for icons (optional)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // Theme JavaScript
    wp_enqueue_script('ecohierbas-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('ecohierbas-script', 'ecohierbas_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ecohierbas_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'ecohierbas_scripts');

/**
 * Register Widget Areas
 */
function ecohierbas_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'ecohierbas'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets para la barra lateral principal.', 'ecohierbas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 1', 'ecohierbas'),
        'id'            => 'footer-1',
        'description'   => __('Widgets para la primera columna del footer.', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 2', 'ecohierbas'),
        'id'            => 'footer-2',
        'description'   => __('Widgets para la segunda columna del footer.', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 3', 'ecohierbas'),
        'id'            => 'footer-3',
        'description'   => __('Widgets para la tercera columna del footer.', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'ecohierbas_widgets_init');

/**
 * Customizer Settings
 */
function ecohierbas_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Sección Hero', 'ecohierbas'),
        'priority' => 30,
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Cultiva tu futuro verde',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Título Principal', 'ecohierbas'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Descubre nuestra línea completa de productos para huerta urbana, maceteros y sistemas de vermicompostaje.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Subtítulo', 'ecohierbas'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ));
    
    // Hero Button Text
    $wp_customize->add_setting('hero_button_text', array(
        'default'           => 'Ver Productos',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_button_text', array(
        'label'   => __('Texto del Botón', 'ecohierbas'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    // Hero Button URL
    $wp_customize->add_setting('hero_button_url', array(
        'default'           => '/productos/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_button_url', array(
        'label'   => __('URL del Botón', 'ecohierbas'),
        'section' => 'hero_section',
        'type'    => 'url',
    ));
    
    // Contact Form Section
    $wp_customize->add_section('contact_section', array(
        'title'    => __('Sección de Contacto', 'ecohierbas'),
        'priority' => 40,
    ));
    
    // Contact Form ID
    $wp_customize->add_setting('contact_form_id', array(
        'default'           => '1',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('contact_form_id', array(
        'label'       => __('ID del Formulario WP Forms', 'ecohierbas'),
        'description' => __('Ingresa el ID del formulario de contacto creado en WP Forms.', 'ecohierbas'),
        'section'     => 'contact_section',
        'type'        => 'number',
    ));
}
add_action('customize_register', 'ecohierbas_customize_register');

/**
 * WooCommerce Customizations
 */
if (class_exists('WooCommerce')) {
    
    // Remove WooCommerce default styles
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    // Customize WooCommerce product loop
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    
    // Change number of products per row
    function ecohierbas_loop_columns() {
        return 3;
    }
    add_filter('loop_shop_columns', 'ecohierbas_loop_columns', 999);
    
    // Change number of products per page
    function ecohierbas_products_per_page() {
        return 12;
    }
    add_filter('loop_shop_per_page', 'ecohierbas_products_per_page', 20);
}

/**
 * AJAX Handler for Cart Updates
 */
function ecohierbas_add_to_cart() {
    if (!wp_verify_nonce($_POST['nonce'], 'ecohierbas_nonce')) {
        wp_die('Security check failed');
    }
    
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    
    if (class_exists('WooCommerce')) {
        $result = WC()->cart->add_to_cart($product_id, $quantity);
        
        if ($result) {
            wp_send_json_success(array(
                'message' => 'Producto agregado al carrito',
                'cart_count' => WC()->cart->get_cart_contents_count(),
            ));
        } else {
            wp_send_json_error('Error al agregar producto al carrito');
        }
    }
    
    wp_die();
}
add_action('wp_ajax_add_to_cart', 'ecohierbas_add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'ecohierbas_add_to_cart');

/**
 * Add Custom Body Classes
 */
function ecohierbas_body_classes($classes) {
    if (is_woocommerce()) {
        $classes[] = 'woocommerce-page';
    }
    
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    return $classes;
}
add_filter('body_class', 'ecohierbas_body_classes');

/**
 * Custom Excerpt Length
 */
function ecohierbas_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'ecohierbas_excerpt_length', 999);

/**
 * Custom Excerpt More
 */
function ecohierbas_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ecohierbas_excerpt_more');

/**
 * Security: Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * SEO: Add Open Graph meta tags
 */
function ecohierbas_add_og_meta() {
    if (is_single() || is_page()) {
        global $post;
        $title = get_the_title();
        $description = get_the_excerpt() ?: wp_trim_words(strip_tags($post->post_content), 20);
        $image = get_the_post_thumbnail_url($post->ID, 'large');
        $url = get_permalink();
        
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        
        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'ecohierbas_add_og_meta');