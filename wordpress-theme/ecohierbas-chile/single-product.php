<?php
/**
 * Plantilla para mostrar productos individuales
 * Replica exactamente la funcionalidad de PDP del React
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <?php
        global $product;
        // CORREGIDO: No usar función que no existe
        ?>

        <!-- Product Detail -->
        <section class="py-16 md:py-24">
            <div class="u-container">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Product Images -->
                    <div class="space-y-4">
                        <div class="aspect-square overflow-hidden rounded-2xl bg-muted">
                            <?php if (has_post_thumbnail()) : ?>
                                <img 
                                    src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" 
                                    alt="<?php echo esc_attr(get_the_title()); ?>"
                                    class="w-full h-full object-cover"
                                    loading="eager">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="space-y-8">
                        <!-- Title -->
                        <h1 class="text-3xl lg:text-4xl font-serif font-bold text-foreground"><?php the_title(); ?></h1>

                        <!-- Price -->
                        <div class="space-y-2">
                            <div class="flex items-baseline gap-3">
                                <span class="text-3xl font-bold text-foreground">
                                    <?php echo $product->get_price_html(); ?>
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="prose prose-gray max-w-none">
                            <?php echo apply_filters('the_content', $product->get_short_description() ?: $product->get_description()); ?>
                        </div>

                        <!-- Add to Cart -->
                        <div class="space-y-4 pt-6 border-t border-border">
                            <?php if ($product->is_in_stock()) : ?>
                                <form class="cart flex items-center gap-4" method="post" enctype="multipart/form-data">
                                    <?php
                                    woocommerce_quantity_input(array(
                                        'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                                        'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                                        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                                        'classes'     => array('w-20 text-center border border-border rounded'),
                                    ));
                                    ?>
                                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="u-btn u-btn--primary flex-1">
                                        <?php echo esc_html($product->single_add_to_cart_text()); ?>
                                    </button>
                                </form>
                            <?php else : ?>
                                <button class="u-btn w-full bg-muted text-muted-foreground cursor-not-allowed" disabled>
                                    <?php esc_html_e('Producto agotado', 'ecohierbas'); ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>