<?php
/**
 * Adaptador de productos WooCommerce
 * Mantiene la misma interfaz que el hook useWooCommerce del React
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase adaptadora para productos
 * Normaliza datos WooCommerce al formato usado en React
 */
class EcoHierbas_Product_Adapter {
    
    /**
     * Obtener productos con filtros
     */
    public static function get_products($args = array()) {
        if (!class_exists('WooCommerce')) {
            return self::get_fallback_products();
        }

        $defaults = array(
            'status' => 'publish',
            'limit' => 8,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $args = wp_parse_args($args, $defaults);
        $products = wc_get_products($args);
        $normalized_products = array();

        foreach ($products as $product) {
            $normalized_products[] = self::normalize_product($product);
        }

        return $normalized_products;
    }

    /**
     * Obtener productos destacados
     */
    public static function get_featured_products() {
        if (!class_exists('WooCommerce')) {
            return self::get_fallback_products();
        }

        return self::get_products(array(
            'featured' => true,
            'limit' => 8,
        ));
    }

    /**
     * Normalizar producto WooCommerce al formato React
     */
    public static function normalize_product($product) {
        if (is_numeric($product)) {
            $product = wc_get_product($product);
        }

        if (!$product) {
            return null;
        }

        // Obtener categorías
        $categories = wp_get_post_terms($product->get_id(), 'product_cat');
        $category = !empty($categories) ? $categories[0]->name : 'General';

        // Obtener finalidad (atributo personalizado)
        $finalidad = $product->get_attribute('finalidad') ?: null;

        // Obtener imágenes
        $image_id = $product->get_image_id();
        $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'product-card') : '';

        // Calcular precio de descuento
        $regular_price = (float) $product->get_regular_price();
        $sale_price = (float) $product->get_sale_price();
        $original_price = $product->is_on_sale() ? $regular_price : null;

        // Obtener rating
        $rating = (float) $product->get_average_rating();
        $review_count = (int) $product->get_review_count();

        return array(
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'slug' => $product->get_slug(),
            'category' => $category,
            'finalidad' => $finalidad,
            'price' => $sale_price ?: $regular_price,
            'originalPrice' => $original_price,
            'image' => $image_url,
            'rating' => $rating,
            'reviews' => $review_count,
            'inStock' => $product->is_in_stock(),
            'description' => $product->get_short_description() ?: $product->get_description(),
            'permalink' => $product->get_permalink(),
            'wc_product' => $product, // Mantener referencia al producto WC original
        );
    }

    /**
     * Productos de fallback (idénticos a los del React)
     */
    public static function get_fallback_products() {
        return array(
            array(
                'id' => 1,
                'name' => 'Box Especial Mujer - Refresca tu Piel',
                'slug' => 'box-especial-mujer-refresca-tu-piel',
                'category' => 'Infusiones',
                'finalidad' => 'Piel',
                'price' => 24990,
                'originalPrice' => 29990,
                'image' => get_template_directory_uri() . '/assets/img/productos-hierbas.jpg',
                'rating' => 4.8,
                'reviews' => 156,
                'inStock' => true,
                'description' => 'Mezcla especial de hierbas para el cuidado y regeneración de la piel femenina',
                'permalink' => '#',
            ),
            array(
                'id' => 2,
                'name' => 'Especial Hombres - Sana tu Próstata y Piel',
                'slug' => 'especial-hombres-sana-tu-prostata-y-piel',
                'category' => 'Infusiones',
                'finalidad' => 'Masculina',
                'price' => 26990,
                'originalPrice' => null,
                'image' => get_template_directory_uri() . '/assets/img/productos-hierbas.jpg',
                'rating' => 4.7,
                'reviews' => 89,
                'inStock' => true,
                'description' => 'Fórmula natural para la salud masculina integral',
                'permalink' => '#',
            ),
            array(
                'id' => 3,
                'name' => 'Infusión Relajante Nocturna',
                'slug' => 'infusion-relajante-nocturna',
                'category' => 'Infusiones',
                'finalidad' => 'Relajación',
                'price' => 18990,
                'originalPrice' => 22990,
                'image' => get_template_directory_uri() . '/assets/img/productos-hierbas.jpg',
                'rating' => 4.9,
                'reviews' => 203,
                'inStock' => true,
                'description' => 'Mezcla de hierbas para promover un sueño reparador',
                'permalink' => '#',
            ),
            array(
                'id' => 4,
                'name' => 'Digestivo Natural Premium',
                'slug' => 'digestivo-natural-premium',
                'category' => 'Infusiones',
                'finalidad' => 'Digestivo',
                'price' => 21990,
                'originalPrice' => null,
                'image' => get_template_directory_uri() . '/assets/img/productos-hierbas.jpg',
                'rating' => 4.6,
                'reviews' => 134,
                'inStock' => true,
                'description' => 'Hierbas seleccionadas para mejorar la digestión naturalmente',
                'permalink' => '#',
            ),
            array(
                'id' => 5,
                'name' => 'Vermicompostera 5 Niveles',
                'slug' => 'vermicompostera-5-niveles',
                'category' => 'Vermicompostaje',
                'finalidad' => null,
                'price' => 89990,
                'originalPrice' => null,
                'image' => get_template_directory_uri() . '/assets/img/vermicompostaje.jpg',
                'rating' => 4.9,
                'reviews' => 89,
                'inStock' => true,
                'description' => 'Sistema completo de vermicompostaje para empresas y hogares',
                'permalink' => '#',
            ),
            array(
                'id' => 6,
                'name' => 'Kit Vermicompostaje Familiar',
                'slug' => 'kit-vermicompostaje-familiar',
                'category' => 'Vermicompostaje',
                'finalidad' => null,
                'price' => 45990,
                'originalPrice' => 54990,
                'image' => get_template_directory_uri() . '/assets/img/vermicompostaje.jpg',
                'rating' => 4.8,
                'reviews' => 167,
                'inStock' => true,
                'description' => 'Kit inicial perfecto para familias conscientes',
                'permalink' => '#',
            ),
            array(
                'id' => 7,
                'name' => 'Eco Macetero Alerce',
                'slug' => 'eco-macetero-alerce',
                'category' => 'Maceteros',
                'finalidad' => null,
                'price' => 15990,
                'originalPrice' => 19990,
                'image' => get_template_directory_uri() . '/assets/img/maceteros-kits.jpg',
                'rating' => 4.7,
                'reviews' => 203,
                'inStock' => true,
                'description' => 'Macetero ecológico de madera alerce sustentable',
                'permalink' => '#',
            ),
            array(
                'id' => 8,
                'name' => 'Kit Cultivo Hierbas Aromáticas',
                'slug' => 'kit-cultivo-hierbas-aromaticas',
                'category' => 'Maceteros',
                'finalidad' => null,
                'price' => 32990,
                'originalPrice' => null,
                'image' => get_template_directory_uri() . '/assets/img/maceteros-kits.jpg',
                'rating' => 4.8,
                'reviews' => 145,
                'inStock' => true,
                'description' => 'Kit completo para cultivar hierbas aromáticas en casa',
                'permalink' => '#',
            ),
        );
    }
}

/**
 * DUPLICADO ELIMINADO - Ver función válida en línea 608
 */

/**
 * DUPLICADO - ELIMINAR - Ver función en línea 639
 */
// function ecohierbas_format_price($price) {
//     return '$' . number_format($price, 0, ',', '.');
// }

/**
 * Funciones helper para templates
 */
function ecohierbas_get_products($args = array()) {
    return EcoHierbas_Product_Adapter::get_products($args);
}

function ecohierbas_get_featured_products() {
    return EcoHierbas_Product_Adapter::get_featured_products();
}

function ecohierbas_normalize_product($product) {
    return EcoHierbas_Product_Adapter::normalize_product($product);
}

/**
 * AJAX Endpoints para carrito - EcoHierbas Chile
 */

// Agregar al carrito
function ecohierbas_ajax_add_to_cart() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');

    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce no está activado'));
        return;
    }

    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']) ?: 1;

    if (!$product_id) {
        wp_send_json_error(array('message' => 'ID de producto inválido'));
        return;
    }

    $added = WC()->cart->add_to_cart($product_id, $quantity);

    if ($added) {
        $product = wc_get_product($product_id);
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_total = WC()->cart->get_cart_total();

        wp_send_json_success(array(
            'message' => 'Producto agregado al carrito',
            'product' => ecohierbas_normalize_product($product),
            'cart_count' => $cart_count,
            'cart_total' => strip_tags($cart_total),
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array())
        ));
    } else {
        wp_send_json_error(array('message' => 'Error al agregar producto al carrito'));
    }
}
add_action('wp_ajax_ecohierbas_add_to_cart', 'ecohierbas_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ecohierbas_add_to_cart', 'ecohierbas_ajax_add_to_cart');

// Remover del carrito
function ecohierbas_ajax_remove_from_cart() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');

    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce no está activado'));
        return;
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $product_id = intval($_POST['product_id']);

    if (!$cart_item_key && !$product_id) {
        wp_send_json_error(array('message' => 'Parámetros inválidos'));
        return;
    }

    // Si no tenemos cart_item_key, buscar por product_id
    if (!$cart_item_key && $product_id) {
        foreach (WC()->cart->get_cart() as $key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                $cart_item_key = $key;
                break;
            }
        }
    }

    if ($cart_item_key) {
        WC()->cart->remove_cart_item($cart_item_key);
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_total = WC()->cart->get_cart_total();

        wp_send_json_success(array(
            'message' => 'Producto eliminado del carrito',
            'cart_count' => $cart_count,
            'cart_total' => strip_tags($cart_total),
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array())
        ));
    } else {
        wp_send_json_error(array('message' => 'Producto no encontrado en el carrito'));
    }
}
add_action('wp_ajax_ecohierbas_remove_from_cart', 'ecohierbas_ajax_remove_from_cart');
add_action('wp_ajax_nopriv_ecohierbas_remove_from_cart', 'ecohierbas_ajax_remove_from_cart');

// Actualizar cantidad
function ecohierbas_ajax_update_cart_quantity() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');

    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce no está activado'));
        return;
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ((!$cart_item_key && !$product_id) || $quantity < 0) {
        wp_send_json_error(array('message' => 'Parámetros inválidos'));
        return;
    }

    // Si no tenemos cart_item_key, buscar por product_id
    if (!$cart_item_key && $product_id) {
        foreach (WC()->cart->get_cart() as $key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                $cart_item_key = $key;
                break;
            }
        }
    }

    if ($cart_item_key) {
        if ($quantity == 0) {
            WC()->cart->remove_cart_item($cart_item_key);
        } else {
            WC()->cart->set_quantity($cart_item_key, $quantity);
        }
        
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_total = WC()->cart->get_cart_total();

        wp_send_json_success(array(
            'message' => 'Carrito actualizado',
            'cart_count' => $cart_count,
            'cart_total' => strip_tags($cart_total),
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array())
        ));
    } else {
        wp_send_json_error(array('message' => 'Producto no encontrado en el carrito'));
    }
}
add_action('wp_ajax_ecohierbas_update_cart_quantity', 'ecohierbas_ajax_update_cart_quantity');
add_action('wp_ajax_nopriv_ecohierbas_update_cart_quantity', 'ecohierbas_ajax_update_cart_quantity');

// Vaciar carrito
function ecohierbas_ajax_clear_cart() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');

    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce no está activado'));
        return;
    }

    WC()->cart->empty_cart();

    wp_send_json_success(array(
        'message' => 'Carrito vaciado',
        'cart_count' => 0,
        'cart_total' => '',
        'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array())
    ));
}
add_action('wp_ajax_ecohierbas_clear_cart', 'ecohierbas_ajax_clear_cart');
add_action('wp_ajax_nopriv_ecohierbas_clear_cart', 'ecohierbas_ajax_clear_cart');

// Filtrar productos
function ecohierbas_ajax_filter_products() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');

    $filters = json_decode(stripslashes($_POST['filters']), true);
    $page = intval($_POST['page']) ?: 1;
    $per_page = 8;

    $args = array(
        'status' => 'publish',
        'limit' => $per_page,
        'offset' => ($page - 1) * $per_page,
        'orderby' => $filters['orderby'] ?: 'menu_order',
        'order' => 'ASC'
    );

    // Filtro por búsqueda
    if (!empty($filters['search'])) {
        $args['s'] = sanitize_text_field($filters['search']);
    }

    // Filtro por categoría
    if (!empty($filters['category']) && $filters['category'] !== 'all') {
        $args['category'] = array(sanitize_text_field($filters['category']));
    }

    // Filtro por precio
    if (!empty($filters['price_range']) && $filters['price_range'] !== 'all') {
        switch ($filters['price_range']) {
            case 'low':
                $args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => 25000,
                    'compare' => '<=',
                    'type' => 'NUMERIC'
                );
                break;
            case 'medium':
                $args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => array(25000, 50000),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
                break;
            case 'high':
                $args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => 50000,
                    'compare' => '>',
                    'type' => 'NUMERIC'
                );
                break;
        }
    }

    $products = EcoHierbas_Product_Adapter::get_products($args);

    // Filtrar por finalidad después (si no es un atributo WC indexado)
    if (!empty($filters['finalidad']) && $filters['finalidad'] !== 'all') {
        $products = array_filter($products, function($product) use ($filters) {
            return $product['finalidad'] === $filters['finalidad'];
        });
    }

    // Generar HTML para productos
    ob_start();
    if (!empty($products)) {
        foreach ($products as $product) {
            get_template_part('template-parts/product-card', null, array('product' => $product));
        }
    } else {
        echo '<div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-muted-foreground mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-lg font-semibold mb-2">No se encontraron productos</h3>
                <p class="text-muted-foreground">Intenta cambiar los filtros o buscar otros términos.</p>
              </div>';
    }
    $html = ob_get_clean();

    // Calcular paginación
    $total_products = count($products);
    $total_pages = ceil($total_products / $per_page);

    wp_send_json_success(array(
        'html' => $html,
        'total' => $total_products,
        'pagination' => array(
            'current_page' => $page,
            'total_pages' => $total_pages,
            'html' => '' // Generar HTML de paginación si es necesario
        )
    ));
}
add_action('wp_ajax_ecohierbas_filter_products', 'ecohierbas_ajax_filter_products');
add_action('wp_ajax_nopriv_ecohierbas_filter_products', 'ecohierbas_ajax_filter_products');

/**
 * AJAX endpoint para solicitud de cotización B2B
 */
function ecohierbas_ajax_b2b_quote() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');

    $company_name = sanitize_text_field($_POST['company_name']);
    $contact_name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $industry = sanitize_text_field($_POST['industry']);
    $position = sanitize_text_field($_POST['position']);
    $products = isset($_POST['products']) ? array_map('sanitize_text_field', $_POST['products']) : array();
    $volume = sanitize_text_field($_POST['volume']);
    $frequency = sanitize_text_field($_POST['frequency']);
    $budget = sanitize_text_field($_POST['budget']);
    $requirements = sanitize_textarea_field($_POST['requirements']);

    if (empty($company_name) || empty($contact_name) || empty($email)) {
        wp_send_json_error(array('message' => 'Faltan campos obligatorios'));
        return;
    }

    // Preparar email
    $to = get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl');
    $subject = 'Nueva Solicitud de Cotización B2B - ' . $company_name;
    
    $message = "Nueva solicitud de cotización B2B:\n\n";
    $message .= "EMPRESA:\n";
    $message .= "Nombre: " . $company_name . "\n";
    $message .= "Rubro: " . $industry . "\n\n";
    $message .= "CONTACTO:\n";
    $message .= "Nombre: " . $contact_name . "\n";
    $message .= "Cargo: " . $position . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Teléfono: " . $phone . "\n\n";
    $message .= "PRODUCTOS DE INTERÉS:\n";
    $message .= implode(', ', $products) . "\n\n";
    $message .= "DETALLES:\n";
    $message .= "Volumen estimado: " . $volume . "\n";
    $message .= "Frecuencia: " . $frequency . "\n";
    $message .= "Presupuesto: " . $budget . "\n\n";
    $message .= "REQUERIMIENTOS ESPECIALES:\n";
    $message .= $requirements . "\n\n";
    $message .= "---\n";
    $message .= "Enviado desde: " . home_url() . "\n";
    $message .= "Fecha: " . current_time('mysql');

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        'Reply-To: ' . $contact_name . ' <' . $email . '>'
    );

    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => 'Cotización enviada exitosamente'));
    } else {
        wp_send_json_error(array('message' => 'Error al enviar la cotización'));
    }
}
add_action('wp_ajax_ecohierbas_b2b_quote', 'ecohierbas_ajax_b2b_quote');
add_action('wp_ajax_nopriv_ecohierbas_b2b_quote', 'ecohierbas_ajax_b2b_quote');

/**
 * Funciones helper
 */
function ecohierbas_get_rating_stars($rating, $reviews = 0) {
    $rating = (float) $rating;
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars) >= 0.5;
    $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);

    $output = '<div class="flex items-center gap-1" title="' . sprintf(__('%s de 5 estrellas', 'ecohierbas'), $rating) . '">';
    
    // Estrellas llenas
    for ($i = 0; $i < $full_stars; $i++) {
        $output .= '<svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
    }
    
    // Media estrella
    if ($half_star) {
        $output .= '<svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20"><defs><linearGradient id="half"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="transparent"/></linearGradient></defs><path fill="url(#half)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
    }
    
    // Estrellas vacías
    for ($i = 0; $i < $empty_stars; $i++) {
        $output .= '<svg class="w-4 h-4 text-gray-300" viewBox="0 0 20 20"><path fill="currentColor" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
    }
    
    if ($reviews > 0) {
        $output .= '<span class="text-sm text-muted-foreground ml-2">(' . $reviews . ')</span>';
    }
    
    $output .= '</div>';
    return $output;
}

function ecohierbas_format_price($price) {
    return '$' . number_format($price, 0, ',', '.') . ' CLP';
}

/**
 * Helper para badge de descuento
 */
function ecohierbas_get_discount_badge($current_price, $original_price) {
    if (!$original_price || $original_price <= $current_price) {
        return '';
    }
    
    $discount_percent = round((($original_price - $current_price) / $original_price) * 100);
    return '<span class="u-badge bg-destructive text-destructive-foreground">-' . $discount_percent . '%</span>';
}

/**
 * DUPLICADO - ELIMINAR - Ya existe función en línea 543
 */