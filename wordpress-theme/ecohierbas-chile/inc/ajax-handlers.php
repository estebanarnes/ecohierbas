<?php
/**
 * AJAX Handlers
 * Maneja todas las peticiones AJAX del tema
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handler para formulario de contacto
 */
function ecohierbas_handle_contact_form() {
    // Verificar nonce
    if (!wp_verify_nonce($_POST['contact_nonce'], 'ecohierbas_contact_nonce')) {
        wp_die(__('Token de seguridad inválido', 'ecohierbas'));
    }

    // Sanitizar datos
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $company = sanitize_text_field($_POST['company']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    // Validar campos requeridos
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error(__('Por favor completa todos los campos requeridos.', 'ecohierbas'));
    }

    // Validar email
    if (!is_email($email)) {
        wp_send_json_error(__('Email inválido.', 'ecohierbas'));
    }

    // Preparar el email
    $to = get_option('ecohierbas_contact_email', get_option('admin_email'));
    $email_subject = '[EcoHierbas] ' . $subject;
    
    $email_message = "Nueva consulta desde el sitio web:\n\n";
    $email_message .= "Nombre: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Teléfono: $phone\n";
    if (!empty($company)) {
        $email_message .= "Empresa: $company\n";
    }
    $email_message .= "Asunto: $subject\n\n";
    $email_message .= "Mensaje:\n$message\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // Enviar email
    $sent = wp_mail($to, $email_subject, $email_message, $headers);

    if ($sent) {
        wp_send_json_success(__('Mensaje enviado correctamente. Te contactaremos pronto.', 'ecohierbas'));
    } else {
        wp_send_json_error(__('Error al enviar el mensaje. Inténtalo de nuevo.', 'ecohierbas'));
    }
}
add_action('wp_ajax_ecohierbas_contact_form', 'ecohierbas_handle_contact_form');
add_action('wp_ajax_nopriv_ecohierbas_contact_form', 'ecohierbas_handle_contact_form');

/**
 * Handler para cotización B2B
 */
function ecohierbas_handle_b2b_quote_form() {
    // Verificar nonce
    if (!wp_verify_nonce($_POST['b2b_quote_nonce'], 'ecohierbas_b2b_quote_nonce')) {
        wp_die(__('Token de seguridad inválido', 'ecohierbas'));
    }

    // Sanitizar datos
    $company_name = sanitize_text_field($_POST['company_name']);
    $industry = sanitize_text_field($_POST['industry']);
    $company_size = sanitize_text_field($_POST['company_size']);
    $contact_name = sanitize_text_field($_POST['contact_name']);
    $position = sanitize_text_field($_POST['position']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $products = isset($_POST['products']) ? array_map('sanitize_text_field', $_POST['products']) : array();
    $volume = sanitize_text_field($_POST['volume']);
    $message = sanitize_textarea_field($_POST['message']);

    // Validar campos requeridos
    if (empty($company_name) || empty($industry) || empty($contact_name) || empty($email) || empty($phone)) {
        wp_send_json_error(__('Por favor completa todos los campos requeridos.', 'ecohierbas'));
    }

    // Validar email
    if (!is_email($email)) {
        wp_send_json_error(__('Email inválido.', 'ecohierbas'));
    }

    // Preparar el email
    $to = get_option('ecohierbas_contact_email', get_option('admin_email'));
    $email_subject = '[EcoHierbas B2B] Solicitud de Cotización - ' . $company_name;
    
    $email_message = "Nueva solicitud de cotización B2B:\n\n";
    $email_message .= "=== INFORMACIÓN DE LA EMPRESA ===\n";
    $email_message .= "Empresa: $company_name\n";
    $email_message .= "Sector: $industry\n";
    if (!empty($company_size)) {
        $email_message .= "Tamaño: $company_size\n";
    }
    $email_message .= "\n=== CONTACTO ===\n";
    $email_message .= "Nombre: $contact_name\n";
    if (!empty($position)) {
        $email_message .= "Cargo: $position\n";
    }
    $email_message .= "Email: $email\n";
    $email_message .= "Teléfono: $phone\n";
    
    if (!empty($products)) {
        $email_message .= "\n=== PRODUCTOS DE INTERÉS ===\n";
        foreach ($products as $product) {
            $email_message .= "- " . ucfirst(str_replace('-', ' ', $product)) . "\n";
        }
    }
    
    if (!empty($volume)) {
        $email_message .= "\nVolumen estimado: $volume\n";
    }
    
    if (!empty($message)) {
        $email_message .= "\n=== DETALLES ADICIONALES ===\n";
        $email_message .= "$message\n";
    }

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        'Reply-To: ' . $contact_name . ' <' . $email . '>'
    );

    // Enviar email
    $sent = wp_mail($to, $email_subject, $email_message, $headers);

    if ($sent) {
        wp_send_json_success(__('Solicitud enviada correctamente. Nos contactaremos contigo en menos de 24 horas.', 'ecohierbas'));
    } else {
        wp_send_json_error(__('Error al enviar la solicitud. Inténtalo de nuevo.', 'ecohierbas'));
    }
}
add_action('wp_ajax_ecohierbas_b2b_quote_form', 'ecohierbas_handle_b2b_quote_form');
add_action('wp_ajax_nopriv_ecohierbas_b2b_quote_form', 'ecohierbas_handle_b2b_quote_form');

/**
 * Handler para añadir producto al carrito (WooCommerce)
 */
function ecohierbas_add_to_cart() {
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(__('WooCommerce no está activo.', 'ecohierbas'));
    }

    // Verificar nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ecohierbas_nonce')) {
        wp_send_json_error(__('Token de seguridad inválido', 'ecohierbas'));
    }

    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']) ?: 1;

    if (!$product_id) {
        wp_send_json_error(__('ID de producto inválido.', 'ecohierbas'));
    }

    // Verificar que el producto existe
    $product = wc_get_product($product_id);
    if (!$product) {
        wp_send_json_error(__('Producto no encontrado.', 'ecohierbas'));
    }

    // Verificar stock
    if (!$product->is_in_stock()) {
        wp_send_json_error(__('Producto sin stock.', 'ecohierbas'));
    }

    // Añadir al carrito
    $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity);

    if ($cart_item_key) {
        wp_send_json_success(array(
            'message' => __('Producto añadido al carrito.', 'ecohierbas'),
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total(),
            'cart_key' => $cart_item_key
        ));
    } else {
        wp_send_json_error(__('Error al añadir el producto al carrito.', 'ecohierbas'));
    }
}
add_action('wp_ajax_ecohierbas_add_to_cart', 'ecohierbas_add_to_cart');
add_action('wp_ajax_nopriv_ecohierbas_add_to_cart', 'ecohierbas_add_to_cart');

/**
 * Handler para actualizar cantidad en el carrito
 */
function ecohierbas_update_cart_quantity() {
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(__('WooCommerce no está activo.', 'ecohierbas'));
    }

    // Verificar nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ecohierbas_nonce')) {
        wp_send_json_error(__('Token de seguridad inválido', 'ecohierbas'));
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if (!$cart_item_key) {
        wp_send_json_error(__('Clave de carrito inválida.', 'ecohierbas'));
    }

    if ($quantity <= 0) {
        // Eliminar item si la cantidad es 0 o negativa
        WC()->cart->remove_cart_item($cart_item_key);
        $message = __('Producto eliminado del carrito.', 'ecohierbas');
    } else {
        // Actualizar cantidad
        WC()->cart->set_quantity($cart_item_key, $quantity);
        $message = __('Cantidad actualizada.', 'ecohierbas');
    }

    wp_send_json_success(array(
        'message' => $message,
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'cart_subtotal' => WC()->cart->get_cart_subtotal()
    ));
}
add_action('wp_ajax_ecohierbas_update_cart_quantity', 'ecohierbas_update_cart_quantity');
add_action('wp_ajax_nopriv_ecohierbas_update_cart_quantity', 'ecohierbas_update_cart_quantity');

/**
 * Handler para eliminar producto del carrito
 */
function ecohierbas_remove_from_cart() {
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(__('WooCommerce no está activo.', 'ecohierbas'));
    }

    // Verificar nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ecohierbas_nonce')) {
        wp_send_json_error(__('Token de seguridad inválido', 'ecohierbas'));
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

    if (!$cart_item_key) {
        wp_send_json_error(__('Clave de carrito inválida.', 'ecohierbas'));
    }

    // Eliminar del carrito
    $removed = WC()->cart->remove_cart_item($cart_item_key);

    if ($removed) {
        wp_send_json_success(array(
            'message' => __('Producto eliminado del carrito.', 'ecohierbas'),
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total(),
            'cart_subtotal' => WC()->cart->get_cart_subtotal()
        ));
    } else {
        wp_send_json_error(__('Error al eliminar el producto del carrito.', 'ecohierbas'));
    }
}
add_action('wp_ajax_ecohierbas_remove_from_cart', 'ecohierbas_remove_from_cart');
add_action('wp_ajax_nopriv_ecohierbas_remove_from_cart', 'ecohierbas_remove_from_cart');

/**
 * Handler para vaciar carrito
 */
function ecohierbas_clear_cart() {
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(__('WooCommerce no está activo.', 'ecohierbas'));
    }

    // Verificar nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ecohierbas_nonce')) {
        wp_send_json_error(__('Token de seguridad inválido', 'ecohierbas'));
    }

    WC()->cart->empty_cart();

    wp_send_json_success(array(
        'message' => __('Carrito vaciado.', 'ecohierbas'),
        'cart_count' => 0,
        'cart_total' => wc_price(0)
    ));
}
add_action('wp_ajax_ecohierbas_clear_cart', 'ecohierbas_clear_cart');
add_action('wp_ajax_nopriv_ecohierbas_clear_cart', 'ecohierbas_clear_cart');

/**
 * Handler para obtener contenido del carrito
 */
function ecohierbas_get_cart_contents() {
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(__('WooCommerce no está activo.', 'ecohierbas'));
    }

    $cart_items = array();
    
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $product = $cart_item['data'];
        $product_id = $cart_item['product_id'];
        
        $cart_items[] = array(
            'key' => $cart_item_key,
            'product_id' => $product_id,
            'name' => $product->get_name(),
            'price' => WC()->cart->get_product_price($product),
            'quantity' => $cart_item['quantity'],
            'subtotal' => WC()->cart->get_product_subtotal($product, $cart_item['quantity']),
            'image' => get_the_post_thumbnail_url($product_id, 'thumbnail') ?: wc_placeholder_img_src(),
            'permalink' => get_permalink($product_id)
        );
    }

    wp_send_json_success(array(
        'items' => $cart_items,
        'count' => WC()->cart->get_cart_contents_count(),
        'total' => WC()->cart->get_cart_total(),
        'subtotal' => WC()->cart->get_cart_subtotal()
    ));
}
add_action('wp_ajax_ecohierbas_get_cart_contents', 'ecohierbas_get_cart_contents');
add_action('wp_ajax_nopriv_ecohierbas_get_cart_contents', 'ecohierbas_get_cart_contents');