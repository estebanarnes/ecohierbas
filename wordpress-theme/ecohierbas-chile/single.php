<?php
/**
 * Plantilla para posts individuales
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Header del post -->
        <header class="py-16 bg-gradient-to-b from-primary/5 to-background">
            <div class="u-container">
                <div class="max-w-4xl mx-auto text-center">
                    
                    <!-- Categorías -->
                    <div class="mb-4">
                        <?php $categories = get_the_category(); ?>
                        <?php if (!empty($categories)) : ?>
                            <?php foreach($categories as $category) : ?>
                                <span class="u-badge u-badge--outline">
                                    <?php echo esc_html($category->name); ?>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Título -->
                    <h1 class="text-4xl md:text-5xl font-serif font-bold text-foreground mb-6">
                        <?php the_title(); ?>
                    </h1>
                    
                    <!-- Meta información -->
                    <div class="flex items-center justify-center gap-6 text-muted-foreground">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <time datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date('j F Y'); ?>
                            </time>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                            </svg>
                            <span><?php echo esc_html(get_the_author()); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Imagen destacada -->
        <?php if (has_post_thumbnail()) : ?>
            <section class="py-8">
                <div class="u-container">
                    <div class="max-w-4xl mx-auto">
                        <div class="aspect-[16/9] overflow-hidden rounded-lg">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Contenido del post -->
        <article class="py-8">
            <div class="u-container">
                <div class="max-w-4xl mx-auto">
                    <div class="prose prose-lg mx-auto">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Tags -->
                    <?php $tags = get_the_tags(); ?>
                    <?php if ($tags) : ?>
                        <div class="mt-12 pt-8 border-t border-border">
                            <h3 class="text-lg font-semibold mb-4">Etiquetas:</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach($tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="u-badge u-badge--secondary">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>

        <!-- Navegación de posts -->
        <nav class="py-12 bg-muted/30">
            <div class="u-container">
                <div class="max-w-4xl mx-auto">
                    <div class="flex justify-between items-center">
                        <?php 
                        $prev_post = get_previous_post();
                        if ($prev_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="u-btn u-btn--outline">
                                ← <?php echo esc_html($prev_post->post_title); ?>
                            </a>
                        <?php else : ?>
                            <div></div>
                        <?php endif; ?>
                        
                        <?php 
                        $next_post = get_next_post();
                        if ($next_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="u-btn u-btn--outline">
                                <?php echo esc_html($next_post->post_title); ?> →
                            </a>
                        <?php else : ?>
                            <div></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>