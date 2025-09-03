<?php
/**
 * Default Page Template
 *
 * @package EcoHierbas
 */

get_header(); ?>

<main class="section">
    <div class="u-container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
                <header class="text-center mb-12">
                    <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6">
                        <?php the_title(); ?>
                    </h1>
                    
                    <?php if (get_the_excerpt()) : ?>
                        <p class="text-xl text-muted-foreground leading-relaxed">
                            <?php the_excerpt(); ?>
                        </p>
                    <?php endif; ?>
                </header>

                <div class="prose prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>

                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Páginas:', 'ecohierbas'),
                    'after'  => '</div>',
                ));
                ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>