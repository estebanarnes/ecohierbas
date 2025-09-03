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
 * AJAX handler para agregar al carrito
 */
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
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_total = WC()->cart->get_cart_total();

        wp_send_json_success(array(
            'message' => 'Producto agregado al carrito',
            'cart_count' => $cart_count,
            'cart_total' => $cart_total,
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array())
        ));
    } else {
        wp_send_json_error(array('message' => 'Error al agregar producto al carrito'));
    }
}
add_action('wp_ajax_ecohierbas_add_to_cart', 'ecohierbas_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ecohierbas_add_to_cart', 'ecohierbas_ajax_add_to_cart');

/**
 * AJAX handler para filtrar productos
 */
function ecohierbas_ajax_filter_products() {
    check_ajax_referer('ecohierbas_nonce', 'nonce');

    $search = sanitize_text_field($_POST['search'] ?? '');
    $category = sanitize_text_field($_POST['category'] ?? '');
    $finalidad = sanitize_text_field($_POST['finalidad'] ?? '');
    $price_range = sanitize_text_field($_POST['price_range'] ?? '');

    $args = array();

    // Filtro por búsqueda
    if ($search) {
        $args['s'] = $search;
    }

    // Filtro por categoría
    if ($category && $category !== 'all') {
        $args['product_cat'] = $category;
    }

    // Filtro por precio
    if ($price_range && $price_range !== 'all') {
        switch ($price_range) {
            case 'low':
                $args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => 25000,
                    'compare' => '<='
                );
                break;
            case 'medium':
                $args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => array(25000, 50000),
                    'compare' => 'BETWEEN'
                );
                break;
            case 'high':
                $args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => 50000,
                    'compare' => '>'
                );
                break;
        }
    }

    $products = ecohierbas_get_products($args);

    // Filtrar por finalidad en PHP (si no es un atributo WC indexado)
    if ($finalidad && $finalidad !== 'all') {
        $products = array_filter($products, function($product) use ($finalidad) {
            return $product['finalidad'] === $finalidad;
        });
    }

    wp_send_json_success(array(
        'products' => array_values($products),
        'count' => count($products)
    ));
}
add_action('wp_ajax_ecohierbas_filter_products', 'ecohierbas_ajax_filter_products');
add_action('wp_ajax_nopriv_ecohierbas_filter_products', 'ecohierbas_ajax_filter_products');

/**
 * Configurar atributos personalizados de producto
 */
function ecohierbas_register_product_attributes() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Registrar atributo "finalidad"
    if (!wc_attribute_taxonomy_name_by_id(wc_attribute_taxonomy_id_by_name('finalidad'))) {
        wc_create_attribute(array(
            'name' => 'Finalidad',
            'slug' => 'finalidad',
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ));
    }
}
add_action('init', 'ecohierbas_register_product_attributes');

/**
 * Agregar términos por defecto para finalidad
 */
function ecohierbas_add_default_finalidad_terms() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    $finalidades = array('Piel', 'Masculina', 'Relajación', 'Digestivo', 'Energético', 'Inmunidad');
    
    foreach ($finalidades as $finalidad) {
        if (!term_exists($finalidad, 'pa_finalidad')) {
            wp_insert_term($finalidad, 'pa_finalidad');
        }
    }
}
add_action('init', 'ecohierbas_add_default_finalidad_terms');

/**
 * Función para mostrar estrellas de rating
 */
function ecohierbas_get_rating_stars($rating, $reviews = 0) {
    $rating = (float) $rating;
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars) >= 0.5;
    $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);

    $output = '<div class="rating-stars" title="' . sprintf(__('%s de 5 estrellas', 'ecohierbas'), $rating) . '">';
    
    // Estrellas llenas
    for ($i = 0; $i < $full_stars; $i++) {
        $output .= '<span class="star star-full">★</span>';
    }
    
    // Media estrella
    if ($half_star) {
        $output .= '<span class="star star-half">☆</span>';
    }
    
    // Estrellas vacías
    for ($i = 0; $i < $empty_stars; $i++) {
        $output .= '<span class="star star-empty">☆</span>';
    }
    
    if ($reviews > 0) {
        $output .= ' <span class="rating-count">(' . $reviews . ')</span>';
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Formatear precio chileno
 */
function ecohierbas_format_price($price) {
    return '$' . number_format($price, 0, ',', '.') . ' CLP';
}

/**
 * Función para mostrar badge de descuento
 */
function ecohierbas_get_discount_badge($price, $original_price) {
    if (!$original_price || $original_price <= $price) {
        return '';
    }

    $discount_percent = round((($original_price - $price) / $original_price) * 100);
    return '<span class="u-badge u-badge--secondary discount-badge">-' . $discount_percent . '%</span>';
}