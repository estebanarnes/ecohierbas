<?php
/**
 * Search Results Page
 * Mantiene diseño consistente para búsquedas
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <!-- Search Header -->
    <section class="py-16 bg-gradient-to-b from-primary/5 to-background">
        <div class="u-container">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                    <?php
                    printf(
                        esc_html__('Resultados para: "%s"', 'ecohierbas'),
                        '<span class="text-primary">' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
                <p class="text-muted-foreground mb-8">
                    <?php
                    global $wp_query;
                    $found_posts = $wp_query->found_posts;
                    if ($found_posts > 0) {
                        printf(
                            esc_html(_n('Encontramos %d resultado', 'Encontramos %d resultados', $found_posts, 'ecohierbas')),
                            $found_posts
                        );
                    } else {
                        esc_html_e('No se encontraron resultados', 'ecohierbas');
                    }
                    ?>
                </p>

                <!-- Search Form -->
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="max-w-md mx-auto">
                    <div class="flex gap-2">
                        <input type="search" 
                               name="s" 
                               class="u-input flex-1" 
                               placeholder="<?php esc_attr_e('Buscar productos...', 'ecohierbas'); ?>"
                               value="<?php echo get_search_query(); ?>">
                        <button type="submit" class="u-btn u-btn--primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="py-16">
        <div class="u-container">
            <?php if (have_posts()): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while (have_posts()): the_post(); ?>
                        <article class="u-card">
                            <div class="u-card-content">
                                <!-- Post Type Badge -->
                                <div class="mb-3">
                                    <?php
                                    $post_type = get_post_type();
                                    $post_type_label = '';
                                    switch ($post_type) {
                                        case 'product':
                                            $post_type_label = __('Producto', 'ecohierbas');
                                            break;
                                        case 'page':
                                            $post_type_label = __('Página', 'ecohierbas');
                                            break;
                                        case 'post':
                                            $post_type_label = __('Artículo', 'ecohierbas');
                                            break;
                                        default:
                                            $post_type_label = ucfirst($post_type);
                                    }
                                    ?>
                                    <span class="u-badge u-badge--outline"><?php echo esc_html($post_type_label); ?></span>
                                </div>

                                <!-- Thumbnail -->
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="aspect-video overflow-hidden rounded-lg mb-4">
                                        <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <h2 class="text-xl font-serif font-semibold mb-3">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <div class="text-muted-foreground mb-4">
                                    <?php
                                    if (get_post_type() === 'product' && function_exists('wc_get_product')) {
                                        $product = wc_get_product(get_the_ID());
                                        if ($product) {
                                            echo wp_kses_post($product->get_short_description() ?: wp_trim_words(get_the_content(), 20));
                                        }
                                    } else {
                                        the_excerpt();
                                    }
                                    ?>
                                </div>

                                <!-- Product Price (if product) -->
                                <?php if (get_post_type() === 'product' && function_exists('wc_get_product')): ?>
                                    <?php
                                    $product = wc_get_product(get_the_ID());
                                    if ($product):
                                    ?>
                                         <div class="mb-4">
                             <span class="text-2xl font-bold text-foreground">
                                 <?php echo wc_price($product->get_price()); ?>
                             </span>
                             <?php if ($product->is_on_sale()): ?>
                                 <span class="text-muted-foreground line-through ml-2">
                                     <?php echo wc_price($product->get_regular_price()); ?>
                                 </span>
                             <?php endif; ?>
                         </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- Action Button -->
                                <div class="flex justify-between items-center">
                                    <a href="<?php the_permalink(); ?>" class="u-btn u-btn--primary">
                                        <?php
                                        if (get_post_type() === 'product') {
                                            esc_html_e('Ver producto', 'ecohierbas');
                                        } else {
                                            esc_html_e('Leer más', 'ecohierbas');
                                        }
                                        ?>
                                    </a>

                                    <?php if (get_post_type() === 'product' && function_exists('wc_get_product')): ?>
                                        <?php
                                        $product = wc_get_product(get_the_ID());
                                        if ($product && $product->is_in_stock()):
                                        ?>
                                            <button class="u-btn u-btn--outline add-to-cart-btn" 
                                                    data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
                                                </svg>
                                                <?php esc_html_e('Agregar', 'ecohierbas'); ?>
                                            </button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => __('« Anterior', 'ecohierbas'),
                        'next_text' => __('Siguiente »', 'ecohierbas'),
                        'type' => 'list',
                        'class' => 'flex justify-center space-x-2',
                    ));
                    ?>
                </div>

            <?php else: ?>
                <!-- No Results -->
                <div class="text-center py-16">
                    <div class="u-card max-w-2xl mx-auto">
                        <div class="u-card-content text-center">
                            <svg class="w-24 h-24 mx-auto text-muted-foreground mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h2 class="text-2xl font-serif font-bold mb-4"><?php esc_html_e('No se encontraron resultados', 'ecohierbas'); ?></h2>
                            <p class="text-muted-foreground mb-8">
                                <?php
                                printf(
                                    esc_html__('No pudimos encontrar nada para "%s". Intenta con otros términos o explora nuestros productos.', 'ecohierbas'),
                                    '<strong>' . get_search_query() . '</strong>'
                                );
                                ?>
                            </p>

                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="<?php echo esc_url(home_url()); ?>" class="u-btn u-btn--primary">
                                    <?php esc_html_e('Ir al inicio', 'ecohierbas'); ?>
                                </a>
                                <?php if (class_exists('WooCommerce')): ?>
                                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="u-btn u-btn--outline">
                                        <?php esc_html_e('Ver todos los productos', 'ecohierbas'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suggestions -->
                <div class="mt-16">
                    <h3 class="text-2xl font-serif font-bold text-center mb-8">
                        <?php esc_html_e('Quizás te interese', 'ecohierbas'); ?>
                    </h3>
                    
                    <?php
                    // Mostrar productos aleatorios como sugerencias
                    $suggested_products = ecohierbas_get_products(array(
                        'limit' => 4,
                        'orderby' => 'rand'
                    ));
                    
                    if ($suggested_products):
                    ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <?php foreach ($suggested_products as $product): ?>
                                <?php get_template_part('template-parts/product-card', null, array('product' => $product)); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>