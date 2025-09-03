<?php
/**
 * WooCommerce Shop Page Template
 *
 * @package EcoHierbas
 */

get_header(); ?>

<main class="section">
    <div class="u-container">
        <!-- Page Header -->
        <section class="py-12 text-center">
            <div class="max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-3 bg-primary/10 text-primary px-6 py-3 rounded-full text-base font-medium mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Tienda Online
                </div>
                
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6">
                    <?php woocommerce_page_title(); ?>
                </h1>
                
                <p class="text-xl text-muted-foreground leading-relaxed">
                    Descubre nuestra selección completa de productos orgánicos, hierbas medicinales 
                    y soluciones de vermicompostaje para tu bienestar y el cuidado del medio ambiente.
                </p>
            </div>
        </section>

        <!-- Filters Section -->
        <section class="py-8 border-b border-border">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2">
                        <label for="product-search" class="text-sm font-medium">Buscar:</label>
                        <input type="text" id="product-search" name="product-search" 
                               placeholder="Buscar productos..."
                               class="px-3 py-2 border border-border rounded-md text-sm w-64">
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <label for="product-category" class="text-sm font-medium">Categoría:</label>
                        <select id="product-category" name="product-category" 
                                class="px-3 py-2 border border-border rounded-md text-sm">
                            <option value="">Todas las categorías</option>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                            ));
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-muted-foreground">Ordenar por:</span>
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <button id="grid-view" class="p-2 border border-border rounded hover:bg-muted transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        </button>
                        <button id="list-view" class="p-2 border border-border rounded hover:bg-muted transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section class="py-12">
            <?php if (woocommerce_product_loop()) : ?>
                <?php woocommerce_output_all_notices(); ?>

                <!-- Products Grid -->
                <div id="products-container" class="product-grid">
                    <?php woocommerce_product_loop_start(); ?>

                    <?php while (have_posts()) : the_post(); ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php endwhile; ?>

                    <?php woocommerce_product_loop_end(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    <?php woocommerce_pagination(); ?>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-8">
                    <button id="load-more-products" class="u-btn u-btn--outline" 
                            data-page="2" data-max-pages="<?php echo $wp_query->max_num_pages; ?>">
                        Cargar Más Productos
                    </button>
                </div>

            <?php else : ?>
                <!-- No Products Found -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-muted rounded-full mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-12 h-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-serif font-bold mb-4">No se encontraron productos</h2>
                    <p class="text-muted-foreground mb-8">
                        No hay productos disponibles en este momento. Por favor, inténtalo de nuevo más tarde.
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="u-btn u-btn--primary">
                        Volver al Inicio
                    </a>
                </div>
            <?php endif; ?>
        </section>

        <!-- Featured Categories -->
        <section class="py-16 bg-muted/30 -mx-4 px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-bold mb-4">Categorías Destacadas</h2>
                <p class="text-lg text-muted-foreground">
                    Explora nuestras categorías más populares
                </p>
            </div>

            <div class="u-grid u-grid--cols-2 lg:u-grid--cols-4 gap-6">
                <?php
                $featured_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'number' => 4,
                    'meta_query' => array(
                        array(
                            'key' => 'featured_category',
                            'value' => '1',
                            'compare' => '='
                        )
                    )
                ));

                if (empty($featured_categories)) {
                    $featured_categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'number' => 4,
                    ));
                }

                if (!empty($featured_categories)) {
                    foreach ($featured_categories as $category) {
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src();
                        ?>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="u-card group hover:shadow-lg transition-all duration-300">
                            <div class="aspect-square overflow-hidden">
                                <img src="<?php echo esc_url($image_url); ?>" 
                                     alt="<?php echo esc_attr($category->name); ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="u-card__content text-center">
                                <h3 class="font-semibold mb-2"><?php echo esc_html($category->name); ?></h3>
                                <p class="text-sm text-muted-foreground mb-3">
                                    <?php echo esc_html($category->description ?: 'Descubre nuestros productos de ' . $category->name); ?>
                                </p>
                                <span class="text-sm text-primary font-medium">
                                    <?php echo $category->count; ?> producto<?php echo $category->count !== 1 ? 's' : ''; ?>
                                </span>
                            </div>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
    </div>
</main>

<script>
jQuery(document).ready(function($) {
    // Product filtering
    let currentPage = 1;
    let isLoading = false;

    // Search functionality
    $('#product-search').on('input', debounce(function() {
        filterProducts();
    }, 500));

    // Category filter
    $('#product-category').on('change', function() {
        filterProducts();
    });

    // View toggle
    $('#grid-view').on('click', function() {
        $('#products-container').removeClass('list-view').addClass('grid-view');
        $(this).addClass('active');
        $('#list-view').removeClass('active');
    });

    $('#list-view').on('click', function() {
        $('#products-container').removeClass('grid-view').addClass('list-view');
        $(this).addClass('active');
        $('#grid-view').removeClass('active');
    });

    // Load more products
    $('#load-more-products').on('click', function() {
        if (isLoading) return;
        
        const button = $(this);
        const page = parseInt(button.data('page'));
        const maxPages = parseInt(button.data('max-pages'));
        
        if (page > maxPages) {
            button.hide();
            return;
        }

        isLoading = true;
        button.text('Cargando...');

        $.post(ecohierbas_ajax.ajax_url, {
            action: 'load_more_products',
            page: page,
            category: $('#product-category').val(),
            search: $('#product-search').val(),
            nonce: ecohierbas_ajax.nonce
        }, function(response) {
            if (response) {
                $('#products-container').append(response);
                button.data('page', page + 1);
                
                if (page + 1 > maxPages) {
                    button.hide();
                } else {
                    button.text('Cargar Más Productos');
                }
            }
            isLoading = false;
        });
    });

    function filterProducts() {
        if (isLoading) return;

        isLoading = true;
        const search = $('#product-search').val();
        const category = $('#product-category').val();

        $.post(ecohierbas_ajax.ajax_url, {
            action: 'filter_products',
            search: search,
            category: category,
            nonce: ecohierbas_ajax.nonce
        }, function(response) {
            if (response.success) {
                $('#products-container').html(response.data.products);
                
                const loadMoreBtn = $('#load-more-products');
                if (response.data.max_pages > 1) {
                    loadMoreBtn.show().data('page', 2).data('max-pages', response.data.max_pages);
                } else {
                    loadMoreBtn.hide();
                }
            }
            isLoading = false;
        });
    }

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
});
</script>

<?php get_footer(); ?>