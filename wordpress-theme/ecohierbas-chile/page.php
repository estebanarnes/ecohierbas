<?php
/**
 * Plantilla general para páginas
 * Utiliza el mismo sistema de PageTemplate que React
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero Section -->
        <section class="h-[400px] bg-gradient-to-b from-primary/5 to-background relative overflow-hidden flex items-center">
            <!-- Logo transparente de fondo -->
            <div class="absolute inset-0 flex items-center justify-center opacity-30 pointer-events-none z-0">
                <img 
                    src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                    alt="EcoHierbas Chile Logo" 
                    class="w-96 h-96 object-contain" 
                />
            </div>
            
            <div class="u-container relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-foreground mb-6">
                        <?php 
                        $hero_title = get_post_meta(get_the_ID(), '_ecohierbas_hero_title', true);
                        echo $hero_title ? esc_html($hero_title) : get_the_title(); 
                        ?>
                    </h1>
                    
                    <?php $hero_subtitle = get_post_meta(get_the_ID(), '_ecohierbas_hero_subtitle', true); ?>
                    <?php if ($hero_subtitle) : ?>
                        <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                            <?php echo esc_html($hero_subtitle); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Contenido de la página -->
        <section class="py-16">
            <div class="u-container">
                <div class="max-w-4xl mx-auto">
                    <div class="prose prose-lg mx-auto">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>