<?php
/**
 * The main template file
 *
 * @package EcoHierbas
 * @version 1.0
 */

get_header(); ?>

<main class="section">
    <div class="u-container">
        <?php if (have_posts()) : ?>
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="section__header">
                    <h1 class="section__title"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <div class="u-grid u-grid--cols-2 lg:u-grid--cols-3 gap-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('u-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="u-card__image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('class' => 'w-full h-48 object-cover')); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="u-card__content">
                            <div class="mb-2">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<span class="u-badge u-badge--outline text-xs">' . esc_html($categories[0]->name) . '</span>';
                                }
                                ?>
                            </div>

                            <h2 class="text-lg font-semibold mb-2">
                                <a href="<?php the_permalink(); ?>" class="text-foreground hover:text-primary transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <div class="text-sm text-muted-foreground mb-4">
                                <?php echo get_the_date(); ?> • Por <?php the_author(); ?>
                            </div>

                            <div class="text-sm text-muted-foreground mb-4 line-clamp-3">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>

                        <div class="u-card__footer">
                            <a href="<?php the_permalink(); ?>" class="u-btn u-btn--primary">
                                Leer más
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&laquo; Anterior', 'ecohierbas'),
                'next_text' => __('Siguiente &raquo;', 'ecohierbas'),
                'before_page_number' => '<span class="screen-reader-text">' . __('Página', 'ecohierbas') . ' </span>',
            ));
            ?>

        <?php else : ?>
            <div class="text-center py-16">
                <h1 class="text-2xl font-serif font-bold mb-4"><?php _e('No se encontraron publicaciones', 'ecohierbas'); ?></h1>
                <p class="text-muted-foreground mb-8"><?php _e('Lo sentimos, no hay contenido disponible en este momento.', 'ecohierbas'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="u-btn u-btn--primary">
                    <?php _e('Volver al inicio', 'ecohierbas'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>