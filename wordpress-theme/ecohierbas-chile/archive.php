<?php
/**
 * Plantilla de archivo general
 * Para categorías, etiquetas, fechas, etc.
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    
    <!-- Header del archivo -->
    <header class="py-16 bg-gradient-to-b from-primary/5 to-background">
        <div class="u-container">
            <div class="max-w-4xl mx-auto text-center">
                
                <!-- Breadcrumbs -->
                <nav class="mb-6">
                    <ol class="flex items-center justify-center gap-2 text-sm text-muted-foreground">
                        <li><a href="<?php echo esc_url(home_url()); ?>" class="hover:text-foreground">Inicio</a></li>
                        <li>/</li>
                        <li class="text-foreground">
                            <?php
                            if (is_category()) {
                                echo 'Categoría: ' . single_cat_title('', false);
                            } elseif (is_tag()) {
                                echo 'Etiqueta: ' . single_tag_title('', false);
                            } elseif (is_date()) {
                                echo 'Archivo: ' . get_the_date('F Y');
                            } elseif (is_author()) {
                                echo 'Autor: ' . get_the_author();
                            } else {
                                echo 'Archivo';
                            }
                            ?>
                        </li>
                    </ol>
                </nav>
                
                <!-- Título del archivo -->
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-foreground mb-6">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } elseif (is_date()) {
                        echo 'Archivo de ' . get_the_date('F Y');
                    } elseif (is_author()) {
                        echo 'Posts de ' . get_the_author();
                    } else {
                        echo 'Archivo del Blog';
                    }
                    ?>
                </h1>
                
                <!-- Descripción del archivo -->
                <?php if (is_category() && category_description()) : ?>
                    <div class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        <?php echo category_description(); ?>
                    </div>
                <?php elseif (is_tag() && tag_description()) : ?>
                    <div class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        <?php echo tag_description(); ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </header>

    <!-- Lista de posts -->
    <section class="py-16">
        <div class="u-container">
            <div class="max-w-4xl mx-auto">
                
                <?php if (have_posts()) : ?>
                    <div class="space-y-12">
                        <?php while (have_posts()) : the_post(); ?>
                            
                            <article class="u-card">
                                <div class="grid md:grid-cols-3 gap-6">
                                    
                                    <!-- Imagen destacada -->
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="md:col-span-1">
                                            <div class="aspect-[4/3] overflow-hidden rounded-lg">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300')); ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Contenido -->
                                    <div class="<?php echo has_post_thumbnail() ? 'md:col-span-2' : 'md:col-span-3'; ?> u-card-content">
                                        
                                        <!-- Meta información -->
                                        <div class="flex items-center gap-4 text-sm text-muted-foreground mb-3">
                                            <time datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date('j F Y'); ?>
                                            </time>
                                            
                                            <?php $categories = get_the_category(); ?>
                                            <?php if (!empty($categories)) : ?>
                                                <span class="u-badge u-badge--outline">
                                                    <?php echo esc_html($categories[0]->name); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Título -->
                                        <h2 class="text-2xl font-serif font-bold text-foreground mb-3 hover:text-primary transition-colors">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        
                                        <!-- Excerpt -->
                                        <div class="text-muted-foreground mb-4">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        
                                        <!-- Botón leer más -->
                                        <a href="<?php the_permalink(); ?>" class="u-btn u-btn--outline">
                                            Leer más
                                        </a>
                                        
                                    </div>
                                </div>
                            </article>
                            
                        <?php endwhile; ?>
                    </div>
                    
                    <!-- Paginación -->
                    <?php if (get_the_posts_pagination()) : ?>
                        <nav class="mt-16">
                            <?php
                            echo paginate_links(array(
                                'prev_text' => '← Anterior',
                                'next_text' => 'Siguiente →',
                                'class' => 'pagination-custom'
                            ));
                            ?>
                        </nav>
                    <?php endif; ?>
                    
                <?php else : ?>
                    
                    <!-- No se encontraron posts -->
                    <div class="text-center py-16">
                        <h2 class="text-2xl font-semibold text-foreground mb-4">
                            No se encontraron posts
                        </h2>
                        <p class="text-muted-foreground mb-6">
                            Lo sentimos, no hay contenido disponible en esta sección.
                        </p>
                        <a href="<?php echo esc_url(home_url()); ?>" class="u-btn u-btn--primary">
                            Volver al inicio
                        </a>
                    </div>
                    
                <?php endif; ?>
                
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>