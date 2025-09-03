<?php
/**
 * Template Part: Product Card
 * Replica exactamente el componente ProductCard.tsx
 * 
 * @param array $args['product'] - Producto normalizado
 */

$product = $args['product'] ?? null;
if (!$product) return;

$is_mobile = wp_is_mobile();
?>

<article class="u-card group relative overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
    <!-- Quick Actions Overlay -->
    <div class="absolute top-3 right-3 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
        <button class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors shadow-lg view-product-btn" 
                data-product='<?php echo wp_json_encode($product); ?>'
                aria-label="<?php esc_attr_e('Vista rápida', 'ecohierbas'); ?>">
            <svg class="w-5 h-5 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </button>
    </div>

    <!-- Product Image -->
    <div class="relative aspect-square overflow-hidden bg-muted">
        <?php if ($product['image']): ?>
            <img src="<?php echo esc_url($product['image']); ?>" 
                 alt="<?php echo esc_attr($product['name']); ?>"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                 loading="lazy">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center bg-muted">
                <svg class="w-16 h-16 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        <?php endif; ?>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        <!-- Stock Badge -->
        <div class="absolute top-3 left-3 z-10">
            <?php if ($product['inStock']): ?>
                <span class="u-badge u-badge--default"><?php esc_html_e('Disponible', 'ecohierbas'); ?></span>
            <?php else: ?>
                <span class="u-badge bg-destructive text-destructive-foreground"><?php esc_html_e('Agotado', 'ecohierbas'); ?></span>
            <?php endif; ?>
        </div>

        <!-- Sale Badge -->
        <?php if ($product['originalPrice'] && $product['originalPrice'] > $product['price']): ?>
            <div class="absolute top-3 left-3 mt-8">
                <?php echo ecohierbas_get_discount_badge($product['price'], $product['originalPrice']); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Product Info -->
    <div class="u-card-content">
        <!-- Category & Finalidad -->
        <div class="flex items-center gap-2 mb-3">
            <?php if ($product['category']): ?>
                <span class="u-badge u-badge--outline text-xs"><?php echo esc_html($product['category']); ?></span>
            <?php endif; ?>
            <?php if ($product['finalidad']): ?>
                <span class="u-badge u-badge--secondary text-xs"><?php echo esc_html($product['finalidad']); ?></span>
            <?php endif; ?>
        </div>

        <!-- Product Name -->
        <h3 class="font-serif font-semibold text-lg mb-2 line-clamp-2 group-hover:text-primary transition-colors">
            <a href="<?php echo esc_url($product['permalink'] ?? '#'); ?>" class="hover:text-primary transition-colors">
                <?php echo esc_html($product['name']); ?>
            </a>
        </h3>

        <!-- Description -->
        <?php if ($product['description']): ?>
            <p class="text-sm text-muted-foreground mb-4 line-clamp-2">
                <?php echo esc_html(wp_trim_words($product['description'], 15)); ?>
            </p>
        <?php endif; ?>

        <!-- Rating -->
        <?php if ($product['rating'] > 0): ?>
            <div class="flex items-center gap-2 mb-4">
                <?php echo ecohierbas_get_rating_stars($product['rating'], $product['reviews']); ?>
            </div>
        <?php endif; ?>

        <!-- Price -->
        <div class="flex items-baseline gap-2 mb-4">
            <span class="text-xl font-bold text-foreground">
                <?php echo ecohierbas_format_price($product['price']); ?>
            </span>
            <?php if ($product['originalPrice'] && $product['originalPrice'] > $product['price']): ?>
                <span class="text-sm text-muted-foreground line-through">
                    <?php echo ecohierbas_format_price($product['originalPrice']); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="u-card-footer">
        <div class="flex gap-2">
            <?php if ($product['inStock']): ?>
                <button class="u-btn u-btn--primary flex-1 add-to-cart-btn" 
                        data-product-id="<?php echo esc_attr($product['id']); ?>"
                        data-product-name="<?php echo esc_attr($product['name']); ?>">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path>
                    </svg>
                    <?php esc_html_e('Agregar', 'ecohierbas'); ?>
                </button>
            <?php else: ?>
                <button class="u-btn w-full bg-muted text-muted-foreground cursor-not-allowed" disabled>
                    <?php esc_html_e('Agotado', 'ecohierbas'); ?>
                </button>
            <?php endif; ?>
            
            <button class="u-btn u-btn--outline view-product-btn" 
                    data-product='<?php echo wp_json_encode($product); ?>'
                    aria-label="<?php esc_attr_e('Ver detalles del producto', 'ecohierbas'); ?>">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
    </div>
</article>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>