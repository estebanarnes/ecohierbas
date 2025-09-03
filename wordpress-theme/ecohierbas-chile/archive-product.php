<?php
/**
 * Archive Products Page - Página Productos WooCommerce
 * Replica exactamente src/pages/Productos.tsx
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <!-- Hero Section -->
    <section class="h-[400px] bg-gradient-to-b from-primary/5 to-background relative overflow-hidden flex items-center">
        <div class="absolute inset-0 flex items-center justify-center opacity-30 pointer-events-none z-0">
            <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                 alt="EcoHierbas Chile Logo" 
                 class="w-96 h-96 object-contain u-animate-float">
        </div>
        
        <div class="u-container relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-foreground mb-6">
                    <?php esc_html_e('Nuestros Productos', 'ecohierbas'); ?>
                </h1>
                <p class="text-xl text-muted-foreground mb-8 leading-relaxed">
                    <?php esc_html_e('Descubre nuestra selección de productos orgánicos y sustentables', 'ecohierbas'); ?>
                </p>
                <div class="flex items-center justify-center gap-4 text-sm text-muted-foreground">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <?php esc_html_e('100% Orgánico', 'ecohierbas'); ?>
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <?php esc_html_e('Envío Nacional', 'ecohierbas'); ?>
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <?php
                        $product_count = wp_count_posts('product');
                        printf(esc_html__('%d Productos', 'ecohierbas'), $product_count->publish);
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="py-8 bg-muted/30">
        <div class="u-container">
            <div class="u-card">
                <div class="u-card-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <label for="product-search" class="block text-sm font-medium mb-2">
                                <?php esc_html_e('Buscar productos', 'ecohierbas'); ?>
                            </label>
                            <input type="text" 
                                   id="product-search" 
                                   placeholder="<?php esc_attr_e('Buscar...', 'ecohierbas'); ?>"
                                   class="u-input w-full">
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <label for="category-filter" class="block text-sm font-medium mb-2">
                                <?php esc_html_e('Categoría', 'ecohierbas'); ?>
                            </label>
                            <select id="category-filter" class="u-input w-full">
                                <option value="all"><?php esc_html_e('Todas las categorías', 'ecohierbas'); ?></option>
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                ));
                                foreach ($categories as $category):
                                ?>
                                    <option value="<?php echo esc_attr($category->slug); ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Finalidad Filter -->
                        <div>
                            <label for="finalidad-filter" class="block text-sm font-medium mb-2">
                                <?php esc_html_e('Finalidad', 'ecohierbas'); ?>
                            </label>
                            <select id="finalidad-filter" class="u-input w-full">
                                <option value="all"><?php esc_html_e('Todas las finalidades', 'ecohierbas'); ?></option>
                                <?php
                                $finalidades = get_terms(array(
                                    'taxonomy' => 'pa_finalidad',
                                    'hide_empty' => true,
                                ));
                                if (!is_wp_error($finalidades)):
                                    foreach ($finalidades as $finalidad):
                                ?>
                                        <option value="<?php echo esc_attr($finalidad->slug); ?>">
                                            <?php echo esc_html($finalidad->name); ?>
                                        </option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                        </div>

                        <!-- Price Filter -->
                        <div>
                            <label for="price-filter" class="block text-sm font-medium mb-2">
                                <?php esc_html_e('Rango de precio', 'ecohierbas'); ?>
                            </label>
                            <select id="price-filter" class="u-input w-full">
                                <option value="all"><?php esc_html_e('Todos los precios', 'ecohierbas'); ?></option>
                                <option value="low"><?php esc_html_e('Hasta $25.000', 'ecohierbas'); ?></option>
                                <option value="medium"><?php esc_html_e('$25.000 - $50.000', 'ecohierbas'); ?></option>
                                <option value="high"><?php esc_html_e('Más de $50.000', 'ecohierbas'); ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <div class="mt-4 flex justify-between items-center">
                        <button id="clear-filters" class="u-btn u-btn--outline">
                            <?php esc_html_e('Limpiar filtros', 'ecohierbas'); ?>
                        </button>
                        <div id="product-count" class="text-sm text-muted-foreground">
                            <?php esc_html_e('Mostrando todos los productos', 'ecohierbas'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-8 md:py-16">
        <div class="u-container">
            <div id="products-grid" class="product-grid">
                <?php
                $products = ecohierbas_get_products(array('limit' => 8));
                
                if (empty($products)):
                ?>
                    <div class="col-span-full text-center py-16">
                        <div class="u-card max-w-md mx-auto">
                            <div class="u-card-content text-center">
                                <svg class="w-16 h-16 mx-auto text-muted-foreground mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4-4-4"></path>
                                </svg>
                                <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('No se encontraron productos', 'ecohierbas'); ?></h3>
                                <p class="text-muted-foreground mb-4"><?php esc_html_e('Intenta cambiar los filtros o buscar otros términos.', 'ecohierbas'); ?></p>
                                <button id="clear-filters-empty" class="u-btn u-btn--primary">
                                    <?php esc_html_e('Ver todos los productos', 'ecohierbas'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                else:
                    foreach ($products as $product):
                        get_template_part('template-parts/product-card', null, array('product' => $product));
                    endforeach;
                endif;
                ?>
            </div>

            <!-- Loading State -->
            <div id="products-loading" class="hidden text-center py-8">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto"></div>
                <p class="mt-4 text-muted-foreground"><?php esc_html_e('Cargando productos...', 'ecohierbas'); ?></p>
            </div>

            <!-- Pagination -->
            <?php
            $total_products = wp_count_posts('product')->publish;
            if ($total_products > 8):
            ?>
                <div class="mt-12 flex justify-center">
                    <nav class="flex space-x-2" aria-label="<?php esc_attr_e('Paginación de productos', 'ecohierbas'); ?>">
                        <button class="u-btn u-btn--outline" id="prev-page" disabled>
                            <?php esc_html_e('Anterior', 'ecohierbas'); ?>
                        </button>
                        <div id="page-numbers" class="flex space-x-2">
                            <!-- Page numbers populated by JavaScript -->
                        </div>
                        <button class="u-btn u-btn--outline" id="next-page">
                            <?php esc_html_e('Siguiente', 'ecohierbas'); ?>
                        </button>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>