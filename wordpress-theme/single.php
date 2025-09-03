<?php
/**
 * Template for displaying single posts
 *
 * @package Ecohierbas
 */

get_header(); ?>

<main id="main" class="site-main single-post">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <!-- Post Header -->
                <header class="post-header">
                    <div class="post-meta">
                        <span class="post-date">
                            <i class="fas fa-calendar"></i>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="post-author">
                            <i class="fas fa-user"></i>
                            <?php the_author(); ?>
                        </span>
                        <span class="post-categories">
                            <i class="fas fa-folder"></i>
                            <?php the_category(', '); ?>
                        </span>
                    </div>
                    
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Post Content -->
                <div class="post-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Páginas:', 'ecohierbas'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <!-- Post Footer -->
                <footer class="post-footer">
                    <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <h3><?php _e('Etiquetas:', 'ecohierbas'); ?></h3>
                            <?php the_tags('<span class="tag">', '</span><span class="tag">', '</span>'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-navigation">
                        <?php
                        the_post_navigation(array(
                            'prev_text' => '<span class="nav-subtitle">' . __('Anterior:', 'ecohierbas') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . __('Siguiente:', 'ecohierbas') . '</span> <span class="nav-title">%title</span>',
                        ));
                        ?>
                    </div>
                </footer>
                
            </article>
            
            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-section">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
            
        <?php endwhile; ?>
        
    </div>
</main>

<?php get_footer(); ?>