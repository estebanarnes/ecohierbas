<?php
/**
 * Plantilla para la página de inicio
 * Replica exactamente la funcionalidad de Index.tsx
 */

get_header(); ?>

<main>
    <!-- Hero Section -->
    <?php get_template_part('template-parts/hero'); ?>

    <!-- Benefits Section -->
    <?php get_template_part('template-parts/benefits'); ?>

    <!-- Featured Products Section -->
    <?php get_template_part('template-parts/featured-products'); ?>

    <!-- Stats Section -->
    <?php get_template_part('template-parts/stats'); ?>

    <!-- Reviews Section -->
    <?php get_template_part('template-parts/reviews'); ?>

    <!-- Workshops Section -->
    <?php get_template_part('template-parts/workshops'); ?>
</main>

<!-- Offers Popup -->
<?php get_template_part('template-parts/offers-popup'); ?>

<?php get_footer();