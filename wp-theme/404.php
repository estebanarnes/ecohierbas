<?php
/**
 * Template for 404 errors
 */
get_header();
?>
<main class="u-container">
    <h1>Página no encontrada</h1>
    <p>Lo sentimos, la página solicitada no existe.</p>
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Volver al inicio</a></p>
</main>
<?php get_footer(); ?>

