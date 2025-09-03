<?php
/**
 * EcoHierbas Chile Theme Functions
 * 
 * @package EcoHierbas
 * @version 1.0
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
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
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
        'primary' => __('Primary Menu', 'ecohierbas'),
        'footer' => __('Footer Menu', 'ecohierbas'),
    ));
    
    // Add custom image sizes
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('product-thumbnail', 400, 400, true);
    add_image_size('product-gallery', 800, 800, true);
}
add_action('after_setup_theme', 'ecohierbas_setup');

/**
 * Enqueue Scripts and Styles
 */
function ecohierbas_scripts() {
    // Main stylesheet
    wp_enqueue_style('ecohierbas-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Google Fonts
    wp_enqueue_style('ecohierbas-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap', array(), null);
    
    // Main JavaScript
    wp_enqueue_script('ecohierbas-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('ecohierbas-main', 'ecohierbas_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ecohierbas_nonce'),
    ));
    
    // Add cart functionality if WooCommerce is active
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('ecohierbas-cart', get_template_directory_uri() . '/assets/js/cart.js', array('jquery'), '1.0.0', true);
        wp_localize_script('ecohierbas-cart', 'wc_cart_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'wc_ajax_url' => WC_AJAX::get_endpoint('%%endpoint%%'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'ecohierbas_scripts');

/**
 * Register Widget Areas
 */
function ecohierbas_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'ecohierbas'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'ecohierbas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'ecohierbas'),
        'id' => 'footer-widgets',
        'description' => __('Add widgets to the footer area.', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer-widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'ecohierbas_widgets_init');

/**
 * Custom Post Types
 */
function ecohierbas_custom_post_types() {
    // Testimonials
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => __('Testimonios', 'ecohierbas'),
            'singular_name' => __('Testimonio', 'ecohierbas'),
            'add_new' => __('Agregar Testimonio', 'ecohierbas'),
            'add_new_item' => __('Agregar Nuevo Testimonio', 'ecohierbas'),
            'edit_item' => __('Editar Testimonio', 'ecohierbas'),
            'new_item' => __('Nuevo Testimonio', 'ecohierbas'),
            'view_item' => __('Ver Testimonio', 'ecohierbas'),
            'search_items' => __('Buscar Testimonios', 'ecohierbas'),
            'not_found' => __('No se encontraron testimonios', 'ecohierbas'),
            'not_found_in_trash' => __('No se encontraron testimonios en la papelera', 'ecohierbas'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));
    
    // Workshops
    register_post_type('workshops', array(
        'labels' => array(
            'name' => __('Talleres', 'ecohierbas'),
            'singular_name' => __('Taller', 'ecohierbas'),
            'add_new' => __('Agregar Taller', 'ecohierbas'),
            'add_new_item' => __('Agregar Nuevo Taller', 'ecohierbas'),
            'edit_item' => __('Editar Taller', 'ecohierbas'),
            'new_item' => __('Nuevo Taller', 'ecohierbas'),
            'view_item' => __('Ver Taller', 'ecohierbas'),
            'search_items' => __('Buscar Talleres', 'ecohierbas'),
            'not_found' => __('No se encontraron talleres', 'ecohierbas'),
            'not_found_in_trash' => __('No se encontraron talleres en la papelera', 'ecohierbas'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_rest' => true,
    ));
}
add_action('init', 'ecohierbas_custom_post_types');

/**
 * Custom Meta Fields
 */
function ecohierbas_add_meta_boxes() {
    // Testimonial meta boxes
    add_meta_box(
        'testimonial_details',
        __('Detalles del Testimonio', 'ecohierbas'),
        'ecohierbas_testimonial_meta_box',
        'testimonials',
        'normal',
        'high'
    );
    
    // Workshop meta boxes
    add_meta_box(
        'workshop_details',
        __('Detalles del Taller', 'ecohierbas'),
        'ecohierbas_workshop_meta_box',
        'workshops',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ecohierbas_add_meta_boxes');

function ecohierbas_testimonial_meta_box($post) {
    wp_nonce_field('ecohierbas_testimonial_nonce', 'testimonial_nonce');
    
    $company = get_post_meta($post->ID, '_testimonial_company', true);
    $role = get_post_meta($post->ID, '_testimonial_role', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);
    $product = get_post_meta($post->ID, '_testimonial_product', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="testimonial_company">Empresa:</label></th>';
    echo '<td><input type="text" id="testimonial_company" name="testimonial_company" value="' . esc_attr($company) . '" class="regular-text" /></td></tr>';
    echo '<tr><th><label for="testimonial_role">Cargo:</label></th>';
    echo '<td><input type="text" id="testimonial_role" name="testimonial_role" value="' . esc_attr($role) . '" class="regular-text" /></td></tr>';
    echo '<tr><th><label for="testimonial_rating">Calificación:</label></th>';
    echo '<td><select id="testimonial_rating" name="testimonial_rating">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<option value="' . $i . '"' . selected($rating, $i, false) . '>' . $i . ' estrella' . ($i > 1 ? 's' : '') . '</option>';
    }
    echo '</select></td></tr>';
    echo '<tr><th><label for="testimonial_product">Producto:</label></th>';
    echo '<td><input type="text" id="testimonial_product" name="testimonial_product" value="' . esc_attr($product) . '" class="regular-text" /></td></tr>';
    echo '</table>';
}

function ecohierbas_workshop_meta_box($post) {
    wp_nonce_field('ecohierbas_workshop_nonce', 'workshop_nonce');
    
    $date = get_post_meta($post->ID, '_workshop_date', true);
    $time = get_post_meta($post->ID, '_workshop_time', true);
    $duration = get_post_meta($post->ID, '_workshop_duration', true);
    $price = get_post_meta($post->ID, '_workshop_price', true);
    $capacity = get_post_meta($post->ID, '_workshop_capacity', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="workshop_date">Fecha:</label></th>';
    echo '<td><input type="date" id="workshop_date" name="workshop_date" value="' . esc_attr($date) . '" /></td></tr>';
    echo '<tr><th><label for="workshop_time">Hora:</label></th>';
    echo '<td><input type="time" id="workshop_time" name="workshop_time" value="' . esc_attr($time) . '" /></td></tr>';
    echo '<tr><th><label for="workshop_duration">Duración (horas):</label></th>';
    echo '<td><input type="number" id="workshop_duration" name="workshop_duration" value="' . esc_attr($duration) . '" min="1" max="8" /></td></tr>';
    echo '<tr><th><label for="workshop_price">Precio:</label></th>';
    echo '<td><input type="number" id="workshop_price" name="workshop_price" value="' . esc_attr($price) . '" min="0" /></td></tr>';
    echo '<tr><th><label for="workshop_capacity">Capacidad:</label></th>';
    echo '<td><input type="number" id="workshop_capacity" name="workshop_capacity" value="' . esc_attr($capacity) . '" min="1" /></td></tr>';
    echo '</table>';
}

function ecohierbas_save_meta_data($post_id) {
    // Check if nonce is valid
    if (!isset($_POST['testimonial_nonce']) && !isset($_POST['workshop_nonce'])) {
        return;
    }
    
    if (isset($_POST['testimonial_nonce']) && !wp_verify_nonce($_POST['testimonial_nonce'], 'ecohierbas_testimonial_nonce')) {
        return;
    }
    
    if (isset($_POST['workshop_nonce']) && !wp_verify_nonce($_POST['workshop_nonce'], 'ecohierbas_workshop_nonce')) {
        return;
    }
    
    // Check if user has permission to edit
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save testimonial data
    if (get_post_type($post_id) === 'testimonials') {
        $fields = array('testimonial_company', 'testimonial_role', 'testimonial_rating', 'testimonial_product');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    
    // Save workshop data
    if (get_post_type($post_id) === 'workshops') {
        $fields = array('workshop_date', 'workshop_time', 'workshop_duration', 'workshop_price', 'workshop_capacity');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'ecohierbas_save_meta_data');

/**
 * WooCommerce Customizations
 */
if (class_exists('WooCommerce')) {
    // Remove default WooCommerce styles
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    // Custom WooCommerce wrapper
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    
    add_action('woocommerce_before_main_content', 'ecohierbas_woocommerce_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'ecohierbas_woocommerce_wrapper_end', 10);
    
    function ecohierbas_woocommerce_wrapper_start() {
        echo '<main class="section"><div class="u-container">';
    }
    
    function ecohierbas_woocommerce_wrapper_end() {
        echo '</div></main>';
    }
    
    // Change number of products per row
    add_filter('loop_shop_columns', function() {
        return 3;
    });
    
    // Change number of products per page
    add_filter('loop_shop_per_page', function() {
        return 12;
    });
}

/**
 * AJAX Handlers
 */
function ecohierbas_load_more_products() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');
    
    $page = intval($_POST['page']);
    $category = sanitize_text_field($_POST['category']);
    
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 8,
        'paged' => $page,
        'post_status' => 'publish',
    );
    
    if ($category && $category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_products', 'ecohierbas_load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'ecohierbas_load_more_products');

/**
 * Custom Functions
 */
function ecohierbas_get_testimonials($limit = -1) {
    $args = array(
        'post_type' => 'testimonials',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );
    
    return get_posts($args);
}

function ecohierbas_get_workshops($limit = -1) {
    $args = array(
        'post_type' => 'workshops',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'meta_value',
        'meta_key' => '_workshop_date',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => '_workshop_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE',
            ),
        ),
    );
    
    return get_posts($args);
}

function ecohierbas_format_price($price) {
    return '$' . number_format($price, 0, ',', '.');
}

function ecohierbas_get_star_rating($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $stars .= '<svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
        } else {
            $stars .= '<svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>';
        }
    }
    return $stars;
}

/**
 * Theme Customizer
 */
function ecohierbas_customize_register($wp_customize) {
    // Add sections
    $wp_customize->add_section('ecohierbas_hero', array(
        'title' => __('Hero Section', 'ecohierbas'),
        'priority' => 30,
    ));
    
    $wp_customize->add_section('ecohierbas_contact', array(
        'title' => __('Contact Information', 'ecohierbas'),
        'priority' => 31,
    ));
    
    // Hero settings
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Hierbas medicinales orgánicas para tu bienestar',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'ecohierbas'),
        'section' => 'ecohierbas_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Descubre nuestra selección de hierbas medicinales, productos de vermicompostaje y soluciones ecológicas para empresas conscientes y familias que cuidan su salud.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'ecohierbas'),
        'section' => 'ecohierbas_hero',
        'type' => 'textarea',
    ));
    
    // Contact settings
    $wp_customize->add_setting('contact_phone', array(
        'default' => '+56 9 1234 5678',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label' => __('Phone Number', 'ecohierbas'),
        'section' => 'ecohierbas_contact',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default' => 'contacto@ecohierbaschile.cl',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label' => __('Email Address', 'ecohierbas'),
        'section' => 'ecohierbas_contact',
        'type' => 'email',
    ));
    
    $wp_customize->add_setting('contact_address', array(
        'default' => 'Camino El tambo, San Vicente Tagua Tagua, VI Región, Chile',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label' => __('Address', 'ecohierbas'),
        'section' => 'ecohierbas_contact',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'ecohierbas_customize_register');

/**
 * Security and Performance
 */
// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove unnecessary meta tags
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// Limit login attempts (basic implementation)
function ecohierbas_limit_login_attempts() {
    $attempts = get_transient('login_attempts_' . $_SERVER['REMOTE_ADDR']);
    if ($attempts && $attempts >= 5) {
        wp_die(__('Too many login attempts. Please try again later.', 'ecohierbas'));
    }
}
add_action('wp_login_failed', function() {
    $attempts = get_transient('login_attempts_' . $_SERVER['REMOTE_ADDR']) ?: 0;
    set_transient('login_attempts_' . $_SERVER['REMOTE_ADDR'], $attempts + 1, 15 * MINUTE_IN_SECONDS);
});

/**
 * SEO Enhancements
 */
function ecohierbas_add_seo_meta() {
    if (is_singular()) {
        global $post;
        
        // Meta description
        $meta_description = get_post_meta($post->ID, '_meta_description', true);
        if (!$meta_description) {
            $meta_description = wp_trim_words(strip_tags($post->post_content), 25);
        }
        echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
        
        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($meta_description) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'ecohierbas_add_seo_meta');

/**
 * Admin Customizations
 */
function ecohierbas_admin_styles() {
    echo '<style>
        #adminmenu .wp-menu-image.dashicons-format-quote:before {
            content: "\f122";
        }
        #adminmenu .wp-menu-image.dashicons-welcome-learn-more:before {
            content: "\f118";
        }
        .ecohierbas-admin-notice {
            border-left-color: #6b4632;
        }
    </style>';
}
add_action('admin_head', 'ecohierbas_admin_styles');

// Add admin notice for theme setup
function ecohierbas_admin_notice() {
    $screen = get_current_screen();
    if ($screen->id === 'themes' || $screen->id === 'appearance_page_theme-editor') {
        echo '<div class="notice notice-info ecohierbas-admin-notice"><p>';
        echo __('¡Bienvenido al tema EcoHierbas Chile! No olvides configurar WooCommerce y WP Forms para una funcionalidad completa.', 'ecohierbas');
        echo '</p></div>';
    }
}
add_action('admin_notices', 'ecohierbas_admin_notice');

?>