<?php
/**
 * Single Post Template
 *
 * @package EcoHierbas
 */

get_header(); ?>

<main class="section">
    <div class="u-container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
                <!-- Post Header -->
                <header class="text-center mb-12">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-8">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-80 object-cover rounded-lg')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo '<span class="u-badge u-badge--outline">' . esc_html($categories[0]->name) . '</span>';
                        }
                        ?>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6">
                        <?php the_title(); ?>
                    </h1>

                    <div class="flex items-center justify-center gap-6 text-muted-foreground">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Por <?php the_author(); ?></span>
                        </div>

                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span><?php echo reading_time(); ?> min de lectura</span>
                        </div>
                    </div>
                </header>

                <!-- Post Content -->
                <div class="prose prose-lg max-w-none mb-12">
                    <?php the_content(); ?>
                </div>

                <!-- Post Navigation -->
                <nav class="flex items-center justify-between border-t border-border pt-8 mb-12">
                    <div class="flex-1">
                        <?php
                        $prev_post = get_previous_post();
                        if ($prev_post) :
                        ?>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="flex items-center gap-3 text-muted-foreground hover:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                <div>
                                    <div class="text-sm">Anterior</div>
                                    <div class="font-medium"><?php echo wp_trim_words($prev_post->post_title, 8); ?></div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="flex-1 text-right">
                        <?php
                        $next_post = get_next_post();
                        if ($next_post) :
                        ?>
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="flex items-center justify-end gap-3 text-muted-foreground hover:text-primary transition-colors">
                                <div>
                                    <div class="text-sm">Siguiente</div>
                                    <div class="font-medium"><?php echo wp_trim_words($next_post->post_title, 8); ?></div>
                                </div>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>

                <!-- Author Bio -->
                <?php if (get_the_author_meta('description')) : ?>
                <section class="bg-muted/30 rounded-lg p-8 mb-12">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-full')); ?>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Sobre <?php the_author(); ?></h3>
                            <p class="text-muted-foreground leading-relaxed">
                                <?php the_author_meta('description'); ?>
                            </p>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Related Posts -->
                <?php
                $related_posts = get_posts(array(
                    'category__in' => wp_get_post_categories($post->ID),
                    'numberposts' => 3,
                    'post__not_in' => array($post->ID),
                ));

                if ($related_posts) :
                ?>
                <section class="mb-12">
                    <h3 class="text-2xl font-serif font-bold mb-8">Artículos Relacionados</h3>
                    <div class="u-grid u-grid--cols-3 gap-8">
                        <?php foreach ($related_posts as $related_post) : ?>
                            <article class="u-card">
                                <?php if (has_post_thumbnail($related_post->ID)) : ?>
                                    <div class="aspect-video overflow-hidden">
                                        <a href="<?php echo get_permalink($related_post->ID); ?>">
                                            <?php echo get_the_post_thumbnail($related_post->ID, 'medium', array('class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="u-card__content">
                                    <h4 class="font-semibold mb-2">
                                        <a href="<?php echo get_permalink($related_post->ID); ?>" class="text-foreground hover:text-primary transition-colors">
                                            <?php echo $related_post->post_title; ?>
                                        </a>
                                    </h4>
                                    <p class="text-sm text-muted-foreground mb-4">
                                        <?php echo wp_trim_words($related_post->post_excerpt ?: $related_post->post_content, 20); ?>
                                    </p>
                                    <div class="text-xs text-muted-foreground">
                                        <?php echo get_the_date('', $related_post->ID); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- Comments -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <section class="border-t border-border pt-12">
                        <?php comments_template(); ?>
                    </section>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>

<?php
// Reading time function
function reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return $reading_time;
}
?>