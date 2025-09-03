<?php
/**
 * Archivo de plantilla para mostrar archivo de productos
 * Replica exactamente la página Productos.tsx del React
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-primary/5 to-background py-16 md:py-24">
        <div class="u-container">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-foreground mb-6">
                    <?php 
                    if (is_product_category()) {
                        single_cat_title();
                    } elseif (is_product_tag()) {
                        single_tag_title();
                    } else {
                        esc_html_e('Nuestros Productos', 'ecohierbas');
                    }
                    ?>
                </h1>
                <p class="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
                    <?php 
                    if (is_product_category()) {
                        echo category_description();
                    } elseif (is_product_tag()) {
                        echo tag_description();
                    } else {
                        esc_html_e('Descubre nuestra selección completa de productos orgánicos, hierbas medicinales y soluciones de vermicompostaje para un estilo de vida más natural y sustentable.', 'ecohierbas');
                    }
                    ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-16 md:py-24 bg-background">
        <div class="u-container">
            <!-- Filtros -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
                    <!-- Search -->
                    <div class="flex-1 max-w-md">
                        <form role="search" method="get" class="flex gap-2">
                            <input 
                                type="search" 
                                name="s" 
                                value="<?php echo esc_attr(get_search_query()); ?>"
                                placeholder="<?php esc_attr_e('Buscar productos...', 'ecohierbas'); ?>"
                                class="u-input flex-1"
                                aria-label="<?php esc_attr_e('Buscar productos', 'ecohierbas'); ?>">
                            <button type="submit" class="u-btn u-btn--primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="sr-only"><?php esc_html_e('Buscar', 'ecohierbas'); ?></span>
                            </button>
                        </form>
                    </div>

                    <!-- Filtros avanzados -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Categorías -->
                        <select id="category-filter" class="u-input" aria-label="<?php esc_attr_e('Filtrar por categoría', 'ecohierbas'); ?>">
                            <option value=""><?php esc_html_e('Todas las categorías', 'ecohierbas'); ?></option>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                            ));
                            foreach ($categories as $category) {
                                $selected = is_product_category($category->slug) ? 'selected' : '';
                                echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                            }
                            ?>
                        </select>

                        <!-- Precio -->
                        <select id="price-filter" class="u-input" aria-label="<?php esc_attr_e('Filtrar por precio', 'ecohierbas'); ?>">
                            <option value=""><?php esc_html_e('Todos los precios', 'ecohierbas'); ?></option>
                            <option value="low"><?php esc_html_e('Hasta $25.000', 'ecohierbas'); ?></option>
                            <option value="medium"><?php esc_html_e('$25.000 - $50.000', 'ecohierbas'); ?></option>
                            <option value="high"><?php esc_html_e('Más de $50.000', 'ecohierbas'); ?></option>
                        </select>

                        <!-- Ordenar -->
                        <select id="sort-filter" class="u-input" aria-label="<?php esc_attr_e('Ordenar productos', 'ecohierbas'); ?>">
                            <option value="menu_order"><?php esc_html_e('Orden por defecto', 'ecohierbas'); ?></option>
                            <option value="popularity"><?php esc_html_e('Más populares', 'ecohierbas'); ?></option>
                            <option value="rating"><?php esc_html_e('Mejor valorados', 'ecohierbas'); ?></option>
                            <option value="date"><?php esc_html_e('Más recientes', 'ecohierbas'); ?></option>
                            <option value="price"><?php esc_html_e('Precio: menor a mayor', 'ecohierbas'); ?></option>
                            <option value="price-desc"><?php esc_html_e('Precio: mayor a menor', 'ecohierbas'); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Resultados -->
            <div id="products-container">
                <!-- Loading State -->
                <div id="products-loading" class="hidden text-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
                    <p class="text-muted-foreground"><?php esc_html_e('Cargando productos...', 'ecohierbas'); ?></p>
                </div>

                <!-- Products Grid -->
                <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php 
                            global $product;
                            $normalized_product = ecohierbas_normalize_product($product);
                            if ($normalized_product) {
                                get_template_part('template-parts/product-card', null, array('product' => $normalized_product));
                            }
                            ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <!-- Empty State -->
                        <div class="col-span-full text-center py-16">
                            <svg class="w-20 h-20 text-muted-foreground mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <h3 class="text-2xl font-semibold mb-4"><?php esc_html_e('No se encontraron productos', 'ecohierbas'); ?></h3>
                            <p class="text-muted-foreground mb-8">
                                <?php esc_html_e('Intenta ajustar los filtros o buscar con términos diferentes.', 'ecohierbas'); ?>
                            </p>
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="u-btn u-btn--primary">
                                <?php esc_html_e('Ver todos los productos', 'ecohierbas'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <?php if (function_exists('woocommerce_pagination')) : ?>
                    <div class="flex justify-center">
                        <?php woocommerce_pagination(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<!-- Product Detail Modal -->
<?php get_template_part('template-parts/modal-product'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('category-filter');
    const priceFilter = document.getElementById('price-filter');
    const sortFilter = document.getElementById('sort-filter');
    const productsGrid = document.getElementById('products-grid');
    const productsLoading = document.getElementById('products-loading');

    function applyFilters() {
        const filters = {
            category: categoryFilter.value,
            price_range: priceFilter.value,
            orderby: sortFilter.value
        };

        // Show loading
        productsLoading.classList.remove('hidden');
        productsGrid.style.opacity = '0.5';

        // Make AJAX request
        EcoHierbas.ajax('ecohierbas_filter_products', {
            filters: JSON.stringify(filters),
            page: 1
        })
        .then(data => {
            productsGrid.innerHTML = data.html;
            // Update URL without reload
            const url = new URL(window.location);
            if (filters.category) url.searchParams.set('product_cat', filters.category);
            else url.searchParams.delete('product_cat');
            
            window.history.pushState({}, '', url);
        })
        .catch(error => {
            console.error('Filter error:', error);
            EcoHierbas.showNotification('Error al filtrar productos', 'error');
        })
        .finally(() => {
            productsLoading.classList.add('hidden');
            productsGrid.style.opacity = '1';
        });
    }

    // Event listeners
    [categoryFilter, priceFilter, sortFilter].forEach(filter => {
        filter.addEventListener('change', EcoHierbas.debounce(applyFilters, 300));
    });
});
</script>

<?php get_footer(); ?>