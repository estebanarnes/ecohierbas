<?php
/**
 * Single Product Page - Producto Individual
 * Mantiene diseño simple y redirige funcionalidad a modal
 */

get_header();

if (have_posts()): while (have_posts()): the_post();
    global $product;
    $normalized_product = ecohierbas_normalize_product($product);
?>

<main class="min-h-screen bg-background py-16">
    <div class="u-container">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumbs -->
            <nav class="mb-8" aria-label="<?php esc_attr_e('Navegación', 'ecohierbas'); ?>">
                <ol class="flex items-center space-x-2 text-sm text-muted-foreground">
                    <li><a href="<?php echo esc_url(home_url()); ?>" class="hover:text-primary"><?php esc_html_e('Inicio', 'ecohierbas'); ?></a></li>
                    <li><span>/</span></li>
                    <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="hover:text-primary"><?php esc_html_e('Productos', 'ecohierbas'); ?></a></li>
                    <li><span>/</span></li>
                    <li class="text-foreground"><?php the_title(); ?></li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div class="space-y-4">
                    <div class="aspect-square overflow-hidden rounded-lg bg-muted">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large', array(
                                'class' => 'w-full h-full object-cover',
                                'loading' => 'eager'
                            )); ?>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-muted">
                                <svg class="w-24 h-24 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Gallery -->
                    <?php 
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ($attachment_ids): 
                    ?>
                        <div class="grid grid-cols-4 gap-2">
                            <?php foreach (array_slice($attachment_ids, 0, 4) as $attachment_id): ?>
                                <div class="aspect-square overflow-hidden rounded-lg bg-muted cursor-pointer hover:opacity-75 transition-opacity">
                                    <?php echo wp_get_attachment_image($attachment_id, 'thumbnail', false, array(
                                        'class' => 'w-full h-full object-cover'
                                    )); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <!-- Category & Stock -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <?php
                            $categories = get_the_terms(get_the_ID(), 'product_cat');
                            if ($categories && !is_wp_error($categories)):
                                foreach (array_slice($categories, 0, 1) as $category):
                            ?>
                                <span class="u-badge u-badge--outline"><?php echo esc_html($category->name); ?></span>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                            <?php
                            $finalidad = $product->get_attribute('finalidad');
                            if ($finalidad):
                            ?>
                                <span class="u-badge u-badge--secondary"><?php echo esc_html($finalidad); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($product->is_in_stock()): ?>
                            <span class="u-badge u-badge--default"><?php esc_html_e('Disponible', 'ecohierbas'); ?></span>
                        <?php else: ?>
                            <span class="u-badge bg-destructive text-destructive-foreground"><?php esc_html_e('Agotado', 'ecohierbas'); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-serif font-bold text-foreground"><?php the_title(); ?></h1>

                    <!-- Rating -->
                    <?php if ($product->get_average_rating()): ?>
                        <div class="flex items-center gap-2">
                            <?php echo ecohierbas_get_rating_stars($product->get_average_rating(), $product->get_review_count()); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Price -->
                    <div class="space-y-2">
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl font-bold text-foreground">
                                <?php echo ecohierbas_format_price($normalized_product['price']); ?>
                            </span>
                            <?php if ($normalized_product['originalPrice']): ?>
                                <span class="text-xl text-muted-foreground line-through">
                                    <?php echo ecohierbas_format_price($normalized_product['originalPrice']); ?>
                                </span>
                                <?php echo ecohierbas_get_discount_badge($normalized_product['price'], $normalized_product['originalPrice']); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="prose prose-sm max-w-none">
                        <?php if ($product->get_short_description()): ?>
                            <?php echo wp_kses_post($product->get_short_description()); ?>
                        <?php else: ?>
                            <?php the_content(); ?>
                        <?php endif; ?>
                    </div>

                    <!-- Add to Cart Section -->
                    <div class="space-y-4 pt-6 border-t border-border">
                        <?php if ($product->is_in_stock()): ?>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center border border-border rounded-lg">
                                    <button type="button" class="p-3 hover:bg-muted transition-colors quantity-minus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" 
                                           value="1" 
                                           min="1" 
                                           class="w-20 text-center border-0 focus:ring-0 product-quantity">
                                    <button type="button" class="p-3 hover:bg-muted transition-colors quantity-plus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                                <button class="u-btn u-btn--primary flex-1 add-to-cart-btn" 
                                        data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
                                    </svg>
                                    <?php esc_html_e('Agregar al carrito', 'ecohierbas'); ?>
                                </button>
                            </div>
                        <?php else: ?>
                            <button class="u-btn w-full bg-muted text-muted-foreground cursor-not-allowed" disabled>
                                <?php esc_html_e('Producto agotado', 'ecohierbas'); ?>
                            </button>
                        <?php endif; ?>

                        <!-- Quick Actions -->
                        <div class="flex gap-2">
                            <button class="u-btn u-btn--outline flex-1" id="view-details-btn" 
                                    data-product='<?php echo wp_json_encode($normalized_product); ?>'>
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <?php esc_html_e('Ver detalles', 'ecohierbas'); ?>
                            </button>
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
                               class="u-btn u-btn--outline flex-1 text-center">
                                <?php esc_html_e('Ver más productos', 'ecohierbas'); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <?php if ($product->get_attributes()): ?>
                        <div class="pt-6 border-t border-border">
                            <h3 class="font-semibold mb-4"><?php esc_html_e('Características', 'ecohierbas'); ?></h3>
                            <dl class="space-y-2">
                                <?php foreach ($product->get_attributes() as $attribute): ?>
                                    <div class="flex justify-between">
                                        <dt class="text-muted-foreground"><?php echo esc_html(wc_attribute_label($attribute->get_name())); ?>:</dt>
                                        <dd class="font-medium"><?php echo esc_html($product->get_attribute($attribute->get_name())); ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Related Products -->
            <?php
            $related_products = ecohierbas_get_products(array(
                'limit' => 4,
                'exclude' => array($product->get_id()),
                'orderby' => 'rand'
            ));
            
            if ($related_products):
            ?>
                <div class="mt-16 pt-16 border-t border-border">
                    <h2 class="text-2xl font-serif font-bold text-center mb-8">
                        <?php esc_html_e('Productos relacionados', 'ecohierbas'); ?>
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php foreach ($related_products as $related_product): ?>
                            <?php get_template_part('template-parts/product-card', null, array('product' => $related_product)); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php 
endwhile; 
endif;

get_footer(); ?>