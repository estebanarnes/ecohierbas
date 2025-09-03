<?php
/**
 * Plantilla principal - Front Page
 * Replica exactamente la página Index.tsx del React
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