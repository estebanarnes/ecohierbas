<?php
/**
 * Template for displaying pages
 *
 * @package Ecohierbas
 */

get_header(); ?>

<main id="main" class="site-main page-template">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <!-- Page Header -->
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-featured-image">
                            <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Page Content -->
                <div class="page-content">
                    <?php
                    the_content();
                    
                    // Page break pagination
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Páginas:', 'ecohierbas'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <!-- Page Footer -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <footer class="page-footer">
                        <?php comments_template(); ?>
                    </footer>
                <?php endif; ?>
                
            </article>
            
        <?php endwhile; ?>
        
    </div>
</main>

<?php get_footer(); ?>