<?php
/**
 * Single Product Template
 *
 * @package EcoHierbas
 */

get_header(); ?>

<main class="section">
    <div class="u-container">
        <?php while (have_posts()) : the_post(); ?>
            <?php wc_get_template_part('content', 'single-product'); ?>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>