<?php
/**
 * Archivo de productos (tienda)
 */
get_header(); ?>

<main class="site-main">
    <section class="relative py-24 md:py-32" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('<?php echo get_template_directory_uri(); ?>/assets/img/hero-productos-hierbas.jpg'); background-size: cover; background-position: center;">
        <div class="u-container text-center">
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6">Nuestros Productos</h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">Descubre nuestra línea completa de productos orgánicos de la más alta calidad.</p>
        </div>
    </section>

    <section class="py-16 md:py-24">
        <div class="u-container">
            <div class="mb-12">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div class="flex flex-wrap gap-2">
                        <button class="filter-btn active" data-category="all">Todos los Productos</button>
                        <?php
                        $product_categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                        ));
                        if (!empty($product_categories) && !is_wp_error($product_categories)) :
                            foreach ($product_categories as $category) :
                                if ($category->slug !== 'uncategorized') :
                        ?>
                            <button class="filter-btn" data-category="<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></button>
                        <?php 
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>

            <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 12,
                    'meta_query' => array(
                        array(
                            'key' => '_visibility',
                            'value' => array('catalog', 'visible'),
                            'compare' => 'IN'
                        )
                    )
                );

                $products = new WP_Query($args);
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        global $product;
                        $categories = get_the_terms(get_the_ID(), 'product_cat');
                        $category_classes = '';
                        if ($categories && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                if ($category->slug !== 'uncategorized') {
                                    $category_classes .= ' category-' . $category->slug;
                                }
                            }
                        }
                ?>
                    <div class="product-card<?php echo esc_attr($category_classes); ?>" data-categories="<?php echo esc_attr(trim($category_classes)); ?>">
                        <?php get_template_part('template-parts/product-card'); ?>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="col-span-full text-center py-16">
                        <h3 class="text-xl font-serif font-bold text-foreground mb-4">No se encontraron productos</h3>
                        <p class="text-muted-foreground">Actualmente no hay productos disponibles en esta categoría.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>