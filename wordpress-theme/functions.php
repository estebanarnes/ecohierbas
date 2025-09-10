<?php
/**
 * EcoHierbas Chile Theme Functions
 * 
 * Funciones principales del tema para EcoHierbas Chile
 * Compatible con WooCommerce y WP Forms
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Configuración del tema
function ecohierbas_theme_setup() {
    // Soporte para título dinámico
    add_theme_support('title-tag');
    
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ));
    
    // Soporte para WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Registrar menús
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'ecohierbas'),
        'footer' => __('Menú del Footer', 'ecohierbas'),
    ));
    
    // Tamaños de imagen personalizados
    add_image_size('product-thumbnail', 400, 400, true);
    add_image_size('hero-banner', 1920, 1080, true);
    add_image_size('feature-image', 600, 400, true);
}
add_action('after_setup_theme', 'ecohierbas_theme_setup');

// Iniciar sesión si no existe
function ecohierbas_start_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'ecohierbas_start_session');

// Enqueue scripts y estilos
function ecohierbas_enqueue_scripts() {
    // CSS principal
    wp_enqueue_style(
        'ecohierbas-style', 
        get_stylesheet_uri(), 
        array(), 
        wp_get_theme()->get('Version')
    );
    
    // JavaScript principal
    wp_enqueue_script(
        'ecohierbas-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Localizar script con datos AJAX
    wp_localize_script('ecohierbas-main', 'ecohierbas_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ecohierbas_nonce'),
        'cart_count' => ecohierbas_get_cart_count(),
        'cart_total' => ecohierbas_get_cart_total()
    ));
}
add_action('wp_enqueue_scripts', 'ecohierbas_enqueue_scripts');

// === FUNCIONES DEL CARRITO ===

// Obtener contenido del carrito
function ecohierbas_get_cart() {
    return isset($_SESSION['ecohierbas_cart']) ? $_SESSION['ecohierbas_cart'] : array();
}

// Contar items en el carrito
function ecohierbas_get_cart_count() {
    $cart = ecohierbas_get_cart();
    $count = 0;
    foreach ($cart as $item) {
        $count += (int) $item['quantity'];
    }
    return $count;
}

// Calcular total del carrito
function ecohierbas_get_cart_total() {
    $cart = ecohierbas_get_cart();
    $total = 0;
    foreach ($cart as $item) {
        $total += (float) $item['price'] * (int) $item['quantity'];
    }
    return $total;
}

// === AJAX HANDLERS ===

// Agregar producto al carrito
function ecohierbas_add_to_cart() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');
    
    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];
    
    if (!$product_id || !$quantity) {
        wp_die('Datos inválidos');
    }
    
    // Si es un producto WooCommerce
    if (class_exists('WooCommerce')) {
        $product = wc_get_product($product_id);
        if (!$product) {
            wp_die('Producto no encontrado');
        }
        
        WC()->cart->add_to_cart($product_id, $quantity);
        
        wp_send_json_success(array(
            'message' => 'Producto agregado al carrito',
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total()
        ));
    } else {
        // Sistema de carrito personalizado (fallback)
        $cart = ecohierbas_get_cart();
        
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            $post = get_post($product_id);
            $price = get_post_meta($product_id, '_price', true);
            
            $cart[$product_id] = array(
                'id' => $product_id,
                'name' => $post->post_title,
                'price' => (float) $price,
                'quantity' => $quantity,
                'image' => get_the_post_thumbnail_url($product_id, 'thumbnail')
            );
        }
        
        $_SESSION['ecohierbas_cart'] = $cart;
        
        wp_send_json_success(array(
            'message' => 'Producto agregado al carrito',
            'cart_count' => ecohierbas_get_cart_count(),
            'cart_total' => number_format(ecohierbas_get_cart_total(), 0)
        ));
    }
}
add_action('wp_ajax_add_to_cart', 'ecohierbas_add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'ecohierbas_add_to_cart');

// Actualizar cantidad en carrito
function ecohierbas_update_cart() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');
    
    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];
    
    if (class_exists('WooCommerce')) {
        if ($quantity > 0) {
            WC()->cart->set_quantity($product_id, $quantity);
        } else {
            WC()->cart->remove_cart_item($product_id);
        }
        
        wp_send_json_success(array(
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total()
        ));
    } else {
        $cart = ecohierbas_get_cart();
        
        if ($quantity > 0) {
            $cart[$product_id]['quantity'] = $quantity;
        } else {
            unset($cart[$product_id]);
        }
        
        $_SESSION['ecohierbas_cart'] = $cart;
        
        wp_send_json_success(array(
            'cart_count' => ecohierbas_get_cart_count(),
            'cart_total' => number_format(ecohierbas_get_cart_total(), 0)
        ));
    }
}
add_action('wp_ajax_update_cart', 'ecohierbas_update_cart');
add_action('wp_ajax_nopriv_update_cart', 'ecohierbas_update_cart');

// Obtener datos del carrito
function ecohierbas_get_cart_data() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');
    
    if (class_exists('WooCommerce')) {
        $cart_items = array();
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $product = $cart_item['data'];
            $cart_items[] = array(
                'id' => $cart_item['product_id'],
                'name' => $product->get_name(),
                'price' => $product->get_price(),
                'quantity' => $cart_item['quantity'],
                'image' => wp_get_attachment_image_url($product->get_image_id(), 'thumbnail')
            );
        }
        
        wp_send_json_success(array(
            'items' => $cart_items,
            'count' => WC()->cart->get_cart_contents_count(),
            'total' => WC()->cart->get_cart_total()
        ));
    } else {
        wp_send_json_success(array(
            'items' => ecohierbas_get_cart(),
            'count' => ecohierbas_get_cart_count(),
            'total' => number_format(ecohierbas_get_cart_total(), 0)
        ));
    }
}
add_action('wp_ajax_get_cart_data', 'ecohierbas_get_cart_data');
add_action('wp_ajax_nopriv_get_cart_data', 'ecohierbas_get_cart_data');

// === FORMULARIOS ===

// Procesar formulario de contacto
function ecohierbas_process_contact_form() {
    if (!wp_verify_nonce($_POST['nonce'], 'ecohierbas_contact_nonce')) {
        wp_die('Error de seguridad');
    }
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $company = sanitize_text_field($_POST['company']);
    $phone = sanitize_text_field($_POST['phone']);
    $query_type = sanitize_text_field($_POST['query_type']);
    $message = sanitize_textarea_field($_POST['message']);
    $accept_marketing = isset($_POST['accept_marketing']);
    
    // Validación
    if (empty($name) || empty($email) || empty($message)) {
        wp_redirect(add_query_arg('error', 'required_fields', wp_get_referer()));
        exit;
    }
    
    if (!is_email($email)) {
        wp_redirect(add_query_arg('error', 'invalid_email', wp_get_referer()));
        exit;
    }
    
    // Enviar email
    $to = get_option('admin_email');
    $subject = 'Nuevo mensaje de contacto - EcoHierbas Chile';
    $body = "
    Nuevo mensaje de contacto:
    
    Nombre: {$name}
    Email: {$email}
    Empresa: {$company}
    Teléfono: {$phone}
    Tipo de consulta: {$query_type}
    
    Mensaje:
    {$message}
    
    Acepta comunicaciones comerciales: " . ($accept_marketing ? 'Sí' : 'No') . "
    
    Fecha: " . date('d/m/Y H:i');
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    wp_mail($to, $subject, $body, $headers);
    
    // Redireccionar con mensaje de éxito
    wp_redirect(add_query_arg('sent', '1', wp_get_referer()));
    exit;
}
add_action('admin_post_contact_form', 'ecohierbas_process_contact_form');
add_action('admin_post_nopriv_contact_form', 'ecohierbas_process_contact_form');

// Procesar formulario B2B
function ecohierbas_process_b2b_form() {
    if (!wp_verify_nonce($_POST['nonce'], 'ecohierbas_b2b_nonce')) {
        wp_die('Error de seguridad');
    }
    
    $company = sanitize_text_field($_POST['company']);
    $contact_name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $employees = sanitize_text_field($_POST['employees']);
    $products = sanitize_text_field($_POST['products']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Validación
    if (empty($company) || empty($contact_name) || empty($email)) {
        wp_redirect(add_query_arg('error', 'required_fields', wp_get_referer()));
        exit;
    }
    
    // Enviar email
    $to = get_option('admin_email');
    $subject = 'Nueva solicitud de cotización B2B - EcoHierbas Chile';
    $body = "
    Nueva solicitud de cotización B2B:
    
    Empresa: {$company}
    Contacto: {$contact_name}
    Email: {$email}
    Teléfono: {$phone}
    Número de empleados: {$employees}
    Productos de interés: {$products}
    
    Mensaje:
    {$message}
    
    Fecha: " . date('d/m/Y H:i');
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $contact_name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    wp_mail($to, $subject, $body, $headers);
    
    wp_redirect(add_query_arg('b2b_sent', '1', wp_get_referer()));
    exit;
}
add_action('admin_post_b2b_quote', 'ecohierbas_process_b2b_form');
add_action('admin_post_nopriv_b2b_quote', 'ecohierbas_process_b2b_form');

// === CUSTOMIZER ===

// Opciones del tema en el Customizer
function ecohierbas_customize_register($wp_customize) {
    // Sección de información de la empresa
    $wp_customize->add_section('ecohierbas_company_info', array(
        'title' => __('Información de la Empresa', 'ecohierbas'),
        'priority' => 30,
    ));
    
    // Logo
    $wp_customize->add_setting('ecohierbas_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ecohierbas_logo', array(
        'label' => __('Logo', 'ecohierbas'),
        'section' => 'ecohierbas_company_info',
        'settings' => 'ecohierbas_logo',
    )));
    
    // Información de contacto
    $contact_fields = array(
        'phone' => 'Teléfono',
        'email' => 'Email',
        'address' => 'Dirección',
        'whatsapp' => 'WhatsApp',
        'instagram' => 'Instagram',
        'facebook' => 'Facebook'
    );
    
    foreach ($contact_fields as $field => $label) {
        $wp_customize->add_setting("ecohierbas_{$field}");
        $wp_customize->add_control("ecohierbas_{$field}", array(
            'label' => __($label, 'ecohierbas'),
            'section' => 'ecohierbas_company_info',
            'type' => 'text',
        ));
    }
}
add_action('customize_register', 'ecohierbas_customize_register');

// === HELPERS ===

// Obtener información de contacto
function ecohierbas_get_contact_info($field) {
    return get_theme_mod("ecohierbas_{$field}", '');
}

// Obtener logo
function ecohierbas_get_logo() {
    $logo = get_theme_mod('ecohierbas_logo');
    return $logo ? $logo : get_template_directory_uri() . '/assets/images/logo.png';
}

// Formatear precio
function ecohierbas_format_price($price) {
    return '$' . number_format((float) $price, 0, ',', '.');
}

// Obtener productos destacados
function ecohierbas_get_featured_products($limit = 3) {
    if (class_exists('WooCommerce')) {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $limit,
            'meta_query' => array(
                array(
                    'key' => '_featured',
                    'value' => 'yes'
                )
            )
        );
    } else {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $limit,
            'meta_key' => '_featured',
            'meta_value' => 'yes'
        );
    }
    
    return new WP_Query($args);
}

// === WIDGETS ===

// Registrar áreas de widgets
function ecohierbas_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'ecohierbas'),
        'id' => 'sidebar-1',
        'description' => __('Widgets para la barra lateral principal', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer 1', 'ecohierbas'),
        'id' => 'footer-1',
        'description' => __('Primera columna del footer', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer 2', 'ecohierbas'),
        'id' => 'footer-2',
        'description' => __('Segunda columna del footer', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer 3', 'ecohierbas'),
        'id' => 'footer-3',
        'description' => __('Tercera columna del footer', 'ecohierbas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'ecohierbas_widgets_init');

// === COMPATIBILIDAD CON WOOCOMMERCE ===

// Remover estilos por defecto de WooCommerce
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Personalizar elementos de WooCommerce
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'ecohierbas_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'ecohierbas_wrapper_end', 10);

function ecohierbas_wrapper_start() {
    echo '<div class="u-container"><main class="main-content">';
}

function ecohierbas_wrapper_end() {
    echo '</main></div>';
}

// === ADMIN ===

// Agregar opciones personalizadas al admin
function ecohierbas_admin_menu() {
    add_theme_page(
        'Configuración EcoHierbas',
        'EcoHierbas Config',
        'manage_options',
        'ecohierbas-config',
        'ecohierbas_admin_page'
    );
}
add_action('admin_menu', 'ecohierbas_admin_menu');

function ecohierbas_admin_page() {
    ?>
    <div class="wrap">
        <h1>Configuración del Tema EcoHierbas</h1>
        <div class="card">
            <h2>Información del Tema</h2>
            <p>Tema desarrollado específicamente para EcoHierbas Chile.</p>
            <p><strong>Versión:</strong> <?php echo wp_get_theme()->get('Version'); ?></p>
            <p><strong>Compatibilidad:</strong></p>
            <ul>
                <li>✅ WooCommerce: <?php echo class_exists('WooCommerce') ? 'Activado' : 'No instalado'; ?></li>
                <li>✅ WP Forms: <?php echo class_exists('WPForms') ? 'Activado' : 'No instalado'; ?></li>
            </ul>
        </div>
        
        <div class="card">
            <h2>Configuración Rápida</h2>
            <p>Para configurar completamente el sitio:</p>
            <ol>
                <li>Ir a <strong>Apariencia > Personalizar</strong> para configurar logo y información de contacto</li>
                <li>Ir a <strong>Apariencia > Menús</strong> para configurar la navegación</li>
                <li>Si usas WooCommerce, configura los productos en <strong>Productos</strong></li>
                <li>Configura formularios de contacto con WP Forms</li>
            </ol>
        </div>
    </div>
    <?php
}

// === OPTIMIZACIONES ===

// Limpiar wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Optimizar jQuery
function ecohierbas_optimize_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, '3.6.0', true);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'ecohierbas_optimize_jquery');
?>