<?php
/**
 * Template Name: Contacto
 */
get_header();
?>
<main>
    <section class="contact-hero">
        <div class="u-container">
            <h1>Contacto</h1>
        </div>
    </section>
    <section class="contact-content u-container">
        <?php if ( isset( $_GET['sent'] ) ) : ?>
            <p class="notice">Gracias por tu mensaje, te responderemos pronto.</p>
        <?php endif; ?>
        <div class="contact-info">
            <p><strong>Email:</strong> info@ecohierbas.cl</p>
            <p><strong>Teléfono:</strong> +56 9 1234 5678</p>
            <p><strong>Dirección:</strong> Pudahuel, Región Metropolitana</p>
        </div>
        <form id="contact-form" class="needs-validation" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
            <input type="hidden" name="action" value="ecohierbas_contact" />
            <p><label>Nombre<br /><input type="text" name="name" required></label></p>
            <p><label>Email<br /><input type="email" name="email" required></label></p>
            <p><label>Mensaje<br /><textarea name="message" required></textarea></label></p>
            <p><button type="submit">Enviar</button></p>
        </form>
        <div class="faq">
            <h2>Preguntas frecuentes</h2>
            <details><summary>¿Realizan envíos internacionales?</summary><p>Actualmente solo dentro de Chile.</p></details>
            <details><summary>¿Los productos son orgánicos?</summary><p>Sí, contamos con certificación.</p></details>
            <details><summary>¿Ofrecen descuentos por mayor?</summary><p>Contáctanos para una cotización B2B.</p></details>
        </div>
    </section>
</main>
<?php get_footer(); ?>

