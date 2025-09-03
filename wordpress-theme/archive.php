<?php
/**
 * Template for displaying archive pages
 *
 * @package Ecohierbas
 */

get_header(); ?>

<main id="main" class="site-main archive-page">
    <div class="container">
        
        <!-- Archive Header -->
        <header class="archive-header">
            <?php the_archive_title('<h1 class="archive-title">', '</h1>'); ?>
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
        </header>

        <!-- Posts Grid -->
        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                                <span class="post-categories"><?php the_category(', '); ?></span>
                            </div>
                            
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                <?php _e('Leer más', 'ecohierbas'); ?>
                            </a>
                        </div>
                        
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination-wrapper">
                <?php
                the_posts_pagination(array(
                    'prev_text' => __('&laquo; Anterior', 'ecohierbas'),
                    'next_text' => __('Siguiente &raquo;', 'ecohierbas'),
                ));
                ?>
            </div>
            
        <?php else : ?>
            <div class="no-posts">
                <h2><?php _e('No se encontraron posts', 'ecohierbas'); ?></h2>
                <p><?php _e('No hay contenido disponible en esta categoría.', 'ecohierbas'); ?></p>
            </div>
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>