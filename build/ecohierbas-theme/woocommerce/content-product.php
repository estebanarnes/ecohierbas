<?php
/**
 * WooCommerce Product Content Template
 *
 * @package EcoHierbas
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<div <?php wc_product_class('product-card u-card group', $product); ?>>
    <div class="product-card__image relative overflow-hidden">
        <a href="<?php the_permalink(); ?>">
            <?php echo woocommerce_get_product_thumbnail('product-thumbnail'); ?>
        </a>
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Product Badges -->
        <div class="absolute top-3 left-3 space-y-2">
            <?php if ($product->is_on_sale()) : ?>
                <span class="u-badge bg-red-500 text-white">
                    <?php if ($product->get_type() === 'variable') : ?>
                        Oferta
                    <?php else : ?>
                        -<?php echo round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100); ?>%
                    <?php endif; ?>
                </span>
            <?php endif; ?>
            
            <?php if ($product->is_featured()) : ?>
                <span class="u-badge bg-primary text-primary-foreground">Destacado</span>
            <?php endif; ?>
            
            <?php if (!$product->is_in_stock()) : ?>
                <span class="u-badge bg-gray-500 text-white">Agotado</span>
            <?php endif; ?>
        </div>

        <!-- Quick Actions -->
        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 space-y-2">
            <button class="product-quick-view w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors" 
                    data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                    title="Vista rápida">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
            
            <?php if (class_exists('YITH_WCWL')) : ?>
                <button class="wishlist-toggle w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors" 
                        title="Añadir a favoritos">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="u-card__content">
        <!-- Category -->
        <div class="mb-2">
            <?php
            $product_cats = wp_get_post_terms($product->get_id(), 'product_cat');
            if (!empty($product_cats)) {
                echo '<span class="u-badge u-badge--outline text-xs">' . esc_html($product_cats[0]->name) . '</span>';
            }
            ?>
        </div>
        
        <!-- Product Title -->
        <h3 class="product-card__title text-lg font-semibold mb-2 line-clamp-2">
            <a href="<?php the_permalink(); ?>" class="text-foreground hover:text-primary transition-colors">
                <?php the_title(); ?>
            </a>
        </h3>
        
        <!-- Short Description -->
        <div class="product-card__description text-sm text-muted-foreground mb-4 line-clamp-2">
            <?php echo wp_trim_words(wp_strip_all_tags($product->get_short_description()), 20); ?>
        </div>

        <!-- Rating -->
        <?php if ($product->get_average_rating()) : ?>
            <div class="product-card__rating flex items-center gap-2 mb-4">
                <div class="flex items-center">
                    <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                </div>
                <span class="text-sm font-medium"><?php echo $product->get_average_rating(); ?></span>
                <span class="text-sm text-muted-foreground">
                    (<?php echo $product->get_review_count(); ?>)
                </span>
            </div>
        <?php endif; ?>

        <!-- Price -->
        <div class="product-card__price flex items-center gap-2 mb-4">
            <?php echo $product->get_price_html(); ?>
        </div>

        <!-- Stock Status -->
        <?php if (!$product->is_in_stock()) : ?>
            <div class="mb-4">
                <span class="text-sm text-red-600 font-medium">Agotado</span>
            </div>
        <?php endif; ?>
    </div>

    <div class="u-card__footer">
        <div class="product-card__actions flex gap-2 w-full">
            <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                <?php if ($product->get_type() === 'simple') : ?>
                    <form class="cart flex-1" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
                        <?php do_action('woocommerce_before_add_to_cart_button'); ?>
                        
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" 
                                class="u-btn u-btn--primary w-full single_add_to_cart_button button alt">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.4 8h9.2m0-8v8a2 2 0 01-2 2H9a2 2 0 01-2-2v-8m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                            </svg>
                            Agregar
                        </button>
                        
                        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
                    </form>
                <?php else : ?>
                    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="u-btn u-btn--primary flex-1">
                        Seleccionar Opciones
                    </a>
                <?php endif; ?>
            <?php else : ?>
                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="u-btn u-btn--primary flex-1">
                    Leer Más
                </a>
            <?php endif; ?>
            
            <a href="<?php the_permalink(); ?>" class="u-btn u-btn--outline px-4" title="Ver producto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </a>
        </div>
    </div>
</div>