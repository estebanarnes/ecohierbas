<?php
/**
 * Functions and definitions for Ecohierbas Theme
 */

function ecohierbas_start_session() {
    if ( ! session_id() ) {
        session_start();
    }
}
add_action( 'init', 'ecohierbas_start_session', 1 );

function ecohierbas_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'ecohierbas' ),
        )
    );
}
add_action( 'after_setup_theme', 'ecohierbas_theme_setup' );

function ecohierbas_register_cpt() {
    register_post_type(
        'producto',
        array(
            'labels' => array(
                'name'          => __( 'Productos', 'ecohierbas' ),
                'singular_name' => __( 'Producto', 'ecohierbas' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-carrot',
            'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
            'taxonomies'  => array( 'category' ),
            'rewrite'     => array( 'slug' => 'productos' ),
        )
    );
}
add_action( 'init', 'ecohierbas_register_cpt' );

function ecohierbas_get_cart() {
    if ( ! isset( $_SESSION['ec_cart'] ) ) {
        $_SESSION['ec_cart'] = array();
    }
    return $_SESSION['ec_cart'];
}

function ecohierbas_cart_count() {
    $cart  = ecohierbas_get_cart();
    $count = 0;
    foreach ( $cart as $item ) {
        $count += (int) $item['qty'];
    }
    return $count;
}

function ecohierbas_cart_total() {
    $cart  = ecohierbas_get_cart();
    $total = 0;
    foreach ( $cart as $item ) {
        $total += (float) $item['price'] * (int) $item['qty'];
    }
    return $total;
}

function ecohierbas_enqueue_scripts() {
    wp_enqueue_style( 'ecohierbas-style', get_stylesheet_uri(), array(), '0.4.0' );
    wp_enqueue_script( 'ecohierbas-main', get_template_directory_uri() . '/assets/main.js', array(), '0.4.0', true );
    wp_localize_script(
        'ecohierbas-main',
        'ecohierbas',
        array(
            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            'nonce'     => wp_create_nonce( 'ecohierbas_cart' ),
            'cartCount' => ecohierbas_cart_count(),
            'cartItems' => array_values( ecohierbas_get_cart() ),
            'cartTotal' => ecohierbas_cart_total(),
        )
    );
}
add_action( 'wp_enqueue_scripts', 'ecohierbas_enqueue_scripts' );

function ecohierbas_add_to_cart_ajax() {
    check_ajax_referer( 'ecohierbas_cart' );
    $id  = intval( $_POST['product_id'] );
    $qty = max( 1, intval( $_POST['quantity'] ) );
    $cart = ecohierbas_get_cart();
    if ( isset( $cart[ $id ] ) ) {
        $cart[ $id ]['qty'] += $qty;
    } else {
        $product = get_post( $id );
        if ( $product && 'producto' === $product->post_type ) {
            $price       = get_post_meta( $id, 'price', true );
            $cart[ $id ] = array(
                'id'    => $id,
                'qty'   => $qty,
                'title' => $product->post_title,
                'price' => (float) $price,
            );
        }
    }
    $_SESSION['ec_cart'] = $cart;
    wp_send_json(
        array(
            'count' => ecohierbas_cart_count(),
        )
    );
}
add_action( 'wp_ajax_ecohierbas_add_to_cart', 'ecohierbas_add_to_cart_ajax' );
add_action( 'wp_ajax_nopriv_ecohierbas_add_to_cart', 'ecohierbas_add_to_cart_ajax' );

function ecohierbas_remove_from_cart_ajax() {
    check_ajax_referer( 'ecohierbas_cart' );
    $id   = intval( $_POST['product_id'] );
    $cart = ecohierbas_get_cart();
    if ( isset( $cart[ $id ] ) ) {
        unset( $cart[ $id ] );
    }
    $_SESSION['ec_cart'] = $cart;
    wp_send_json(
        array(
            'count' => ecohierbas_cart_count(),
        )
    );
}
add_action( 'wp_ajax_ecohierbas_remove_from_cart', 'ecohierbas_remove_from_cart_ajax' );
add_action( 'wp_ajax_nopriv_ecohierbas_remove_from_cart', 'ecohierbas_remove_from_cart_ajax' );

function ecohierbas_update_cart_ajax() {
    check_ajax_referer( 'ecohierbas_cart' );
    $id   = intval( $_POST['product_id'] );
    $qty  = max( 1, intval( $_POST['quantity'] ) );
    $cart = ecohierbas_get_cart();
    if ( isset( $cart[ $id ] ) ) {
        $cart[ $id ]['qty'] = $qty;
    }
    $_SESSION['ec_cart'] = $cart;
    wp_send_json(
        array(
            'count' => ecohierbas_cart_count(),
            'total' => ecohierbas_cart_total(),
            'items' => array_values( $cart ),
        )
    );
}
add_action( 'wp_ajax_ecohierbas_update_cart', 'ecohierbas_update_cart_ajax' );
add_action( 'wp_ajax_nopriv_ecohierbas_update_cart', 'ecohierbas_update_cart_ajax' );

function ecohierbas_get_cart_ajax() {
    wp_send_json(
        array(
            'items' => array_values( ecohierbas_get_cart() ),
            'count' => ecohierbas_cart_count(),
            'total' => ecohierbas_cart_total(),
        )
    );
}
add_action( 'wp_ajax_ecohierbas_get_cart', 'ecohierbas_get_cart_ajax' );
add_action( 'wp_ajax_nopriv_ecohierbas_get_cart', 'ecohierbas_get_cart_ajax' );

function ecohierbas_handle_contact_form() {
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $message = sanitize_textarea_field( $_POST['message'] );
    $body    = "Nombre: $name\nEmail: $email\nMensaje:\n$message";
    wp_mail( get_option( 'admin_email' ), 'Nuevo mensaje de contacto', $body );
    wp_redirect( add_query_arg( 'sent', '1', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_nopriv_ecohierbas_contact', 'ecohierbas_handle_contact_form' );
add_action( 'admin_post_ecohierbas_contact', 'ecohierbas_handle_contact_form' );

function ecohierbas_handle_b2b_form() {
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $message = sanitize_textarea_field( $_POST['message'] );
    $body    = "Cotización B2B\nNombre: $name\nEmail: $email\nMensaje:\n$message";
    wp_mail( get_option( 'admin_email' ), 'Nueva solicitud B2B', $body );
    wp_redirect( add_query_arg( 'sent', '1', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_nopriv_ecohierbas_b2b', 'ecohierbas_handle_b2b_form' );
add_action( 'admin_post_ecohierbas_b2b', 'ecohierbas_handle_b2b_form' );

function ecohierbas_handle_checkout() {
    $cart    = ecohierbas_get_cart();
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $address = sanitize_textarea_field( $_POST['address'] );
    $shipping = sanitize_text_field( $_POST['shipping'] );
    $payment  = sanitize_text_field( $_POST['payment'] );

    $lines = array();
    foreach ( $cart as $item ) {
        $lines[] = $item['qty'] . 'x ' . $item['title'] . ' - $' . number_format( $item['price'], 2 );
    }
    $total = ecohierbas_cart_total();
    $body = "Cliente: $name\nEmail: $email\nDireccion: $address\nEnvio: $shipping\nPago: $payment\n\nPedido:\n" . implode( "\n", $lines ) . "\nTotal: $" . number_format( $total, 2 );
    wp_mail( get_option( 'admin_email' ), 'Nuevo pedido', $body );
    $_SESSION['ec_cart'] = array();
    wp_redirect( add_query_arg( 'ordered', '1', site_url( '/checkout' ) ) );
    exit;
}
add_action( 'admin_post_nopriv_ecohierbas_checkout', 'ecohierbas_handle_checkout' );
add_action( 'admin_post_ecohierbas_checkout', 'ecohierbas_handle_checkout' );

