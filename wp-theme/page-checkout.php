<?php
/**
 * Template Name: Checkout
 */
get_header();
$cart = ecohierbas_get_cart();
?>
<main class="u-container">
    <h1>Checkout</h1>
    <?php if ( isset( $_GET['ordered'] ) ) : ?>
        <p class="notice">Gracias por tu compra.</p>
    <?php endif; ?>
    <?php if ( empty( $cart ) ) : ?>
        <p>Tu carrito está vacío.</p>
    <?php else : ?>
        <ul class="checkout-items">
            <?php foreach ( $cart as $item ) : ?>
                <li><?php echo esc_html( $item['title'] ); ?> × <?php echo intval( $item['qty'] ); ?> - $<?php echo number_format( $item['price'] * $item['qty'], 0 ); ?></li>
            <?php endforeach; ?>
        </ul>
        <p class="subtotal">Subtotal: $<span id="checkout-subtotal"><?php echo number_format( ecohierbas_cart_total(), 0 ); ?></span></p>
        <form id="checkout-form" class="needs-validation" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
            <input type="hidden" name="action" value="ecohierbas_checkout" />
            <p><label>Nombre<br /><input type="text" name="name" required></label></p>
            <p><label>Email<br /><input type="email" name="email" required></label></p>
            <p><label>Dirección<br /><textarea name="address" required></textarea></label></p>
            <p><label>Método de envío<br />
                <select name="shipping" id="shipping-select">
                    <option value="retiro" data-cost="0">Retiro en tienda - $0</option>
                    <option value="envio" data-cost="5000">Envío estándar - $5.000</option>
                </select></label></p>
            <p><label>Método de pago<br />
                <select name="payment">
                    <option value="transferencia">Transferencia</option>
                    <option value="tarjeta">Tarjeta</option>
                </select></label></p>
            <p class="total">Total: $<span id="checkout-total"></span></p>
            <p><button type="submit">Finalizar compra</button></p>
        </form>
    <?php endif; ?>
</main>
<?php get_footer(); ?>

