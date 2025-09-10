<?php
/**
 * Template Name: Productos
 * 
 * Página de productos compatible con WooCommerce
 */
get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/productos-hero.jpg'); height: 50vh;">
        <div class="hero-overlay"></div>
        <div class="hero-content u-container">
            <h1 class="hero-title" style="font-size: 3rem;">Nuestros Productos</h1>
            <p class="hero-subtitle">
                Descubre nuestra selección de hierbas medicinales, productos de vermicompostaje 
                y soluciones ecológicas certificadas.
            </p>
        </div>
    </section>

    <!-- Filtros y Búsqueda -->
    <section class="section" style="padding: 2rem 0; background-color: var(--eco-bg-secondary);">
        <div class="u-container">
            <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: var(--eco-shadow);">
                <div style="display: grid; grid-template-columns: 1fr auto auto; gap: 1.5rem; align-items: end;">
                    <!-- Búsqueda -->
                    <div class="form-group">
                        <label class="form-label" for="product-search">Buscar productos</label>
                        <input type="text" 
                               id="product-search" 
                               class="form-input" 
                               placeholder="Busca por nombre, categoría o beneficio...">
                    </div>
                    
                    <!-- Filtro por categoría -->
                    <div class="form-group">
                        <label class="form-label" for="category-filter">Categoría</label>
                        <select id="category-filter" class="form-select">
                            <option value="">Todas las categorías</option>
                            <?php
                            // Obtener categorías de WooCommerce o categorías personalizadas
                            if (class_exists('WooCommerce')) {
                                $categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true
                                ));
                            } else {
                                $categories = get_terms(array(
                                    'taxonomy' => 'product_category',
                                    'hide_empty' => true
                                ));
                            }
                            
                            if (!is_wp_error($categories)) {
                                foreach ($categories as $category) {
                                    echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <!-- Filtro por precio -->
                    <div class="form-group">
                        <label class="form-label" for="price-filter">Precio máximo</label>
                        <select id="price-filter" class="form-select">
                            <option value="">Sin límite</option>
                            <option value="10000">Hasta $10.000</option>
                            <option value="25000">Hasta $25.000</option>
                            <option value="50000">Hasta $50.000</option>
                            <option value="100000">Hasta $100.000</option>
                        </select>
                    </div>
                    
                    <!-- Botón limpiar filtros -->
                    <button id="clear-filters" class="u-btn u-btn--secondary" style="height: fit-content;">
                        Limpiar Filtros
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Grid de Productos -->
    <section class="section">
        <div class="u-container">
            <!-- Indicador de carga -->
            <div id="loading-indicator" style="display: none; text-align: center; margin: 2rem 0;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--eco-text-light);">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="animation: spin 1s linear infinite;">
                        <path d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                    </svg>
                    Cargando productos...
                </div>
            </div>
            
            <!-- Contador de resultados -->
            <div id="results-count" style="margin-bottom: 2rem; color: var(--eco-text-light);"></div>
            
            <!-- Grid de productos -->
            <div id="products-grid" class="products-grid">
                <?php
                // Query para obtener productos
                $posts_per_page = 12;
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                
                if (class_exists('WooCommerce')) {
                    // Query para WooCommerce
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $posts_per_page,
                        'paged' => $paged,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => '_visibility',
                                'value' => array('catalog', 'visible'),
                                'compare' => 'IN'
                            )
                        )
                    );
                } else {
                    // Query para productos personalizados
                    $args = array(
                        'post_type' => 'producto',
                        'posts_per_page' => $posts_per_page,
                        'paged' => $paged,
                        'post_status' => 'publish'
                    );
                }
                
                $products_query = new WP_Query($args);
                
                if ($products_query->have_posts()) :
                    while ($products_query->have_posts()) : $products_query->the_post();
                        
                        // Obtener datos del producto
                        if (class_exists('WooCommerce')) {
                            $product = wc_get_product(get_the_ID());
                            $price = $product->get_price();
                            $original_price = $product->get_regular_price();
                            $stock_status = $product->get_stock_status();
                            $in_stock = ($stock_status === 'instock');
                            $categories = wp_get_post_terms(get_the_ID(), 'product_cat');
                            $rating = $product->get_average_rating();
                            $review_count = $product->get_review_count();
                        } else {
                            $price = get_post_meta(get_the_ID(), '_price', true);
                            $original_price = get_post_meta(get_the_ID(), '_original_price', true);
                            $stock_status = get_post_meta(get_the_ID(), '_stock_status', true);
                            $in_stock = ($stock_status !== 'outofstock');
                            $categories = wp_get_post_terms(get_the_ID(), 'product_category');
                            $rating = get_post_meta(get_the_ID(), '_average_rating', true) ?: 5;
                            $review_count = get_post_meta(get_the_ID(), '_review_count', true) ?: rand(15, 50);
                        }
                        
                        $category_names = array();
                        if (!is_wp_error($categories) && !empty($categories)) {
                            foreach ($categories as $category) {
                                $category_names[] = $category->name;
                            }
                        }
                ?>
                        <div class="product-card" 
                             data-product-id="<?php echo get_the_ID(); ?>"
                             data-name="<?php echo esc_attr(get_the_title()); ?>"
                             data-price="<?php echo esc_attr($price); ?>"
                             data-category="<?php echo esc_attr(implode(',', $category_names)); ?>"
                             data-description="<?php echo esc_attr(wp_trim_words(get_the_excerpt(), 20)); ?>">
                            
                            <!-- Badge de stock -->
                            <?php if (!$in_stock) : ?>
                                <div class="stock-badge out-of-stock">Agotado</div>
                            <?php else : ?>
                                <div class="stock-badge in-stock">En Stock</div>
                            <?php endif; ?>
                            
                            <!-- Imagen del producto -->
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'product-thumbnail'); ?>" 
                                     alt="<?php echo esc_attr(get_the_title()); ?>" 
                                     class="product-image"
                                     loading="lazy">
                            <?php else : ?>
                                <div class="product-image" style="background: var(--eco-bg-secondary); display: flex; align-items: center; justify-content: center; height: 250px;">
                                    <svg width="60" height="60" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-text-lighter);">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            
                            <div class="product-content">
                                <!-- Categoría -->
                                <?php if (!empty($category_names)) : ?>
                                    <span class="product-category"><?php echo esc_html($category_names[0]); ?></span>
                                <?php endif; ?>
                                
                                <!-- Título -->
                                <h3 class="product-title"><?php echo get_the_title(); ?></h3>
                                
                                <!-- Descripción -->
                                <p class="product-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                
                                <!-- Rating -->
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <svg class="star <?php echo $i <= $rating ? 'filled' : ''; ?>" width="16" height="16" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="rating-text"><?php echo $rating; ?> (<?php echo $review_count; ?>)</span>
                                </div>
                                
                                <!-- Precio -->
                                <div class="product-price">
                                    <span class="current-price"><?php echo ecohierbas_format_price($price); ?></span>
                                    <?php if ($original_price && $original_price > $price) : ?>
                                        <span class="original-price"><?php echo ecohierbas_format_price($original_price); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Acciones -->
                                <div class="product-actions">
                                    <button class="add-to-cart" 
                                            data-product-id="<?php echo get_the_ID(); ?>"
                                            <?php echo !$in_stock ? 'disabled' : ''; ?>>
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H19M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
                                        </svg>
                                        <?php echo $in_stock ? 'Agregar' : 'Agotado'; ?>
                                    </button>
                                    <button class="view-product" data-product-id="<?php echo get_the_ID(); ?>">
                                        Ver
                                    </button>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div id="no-products" style="grid-column: 1 / -1; text-align: center; padding: 4rem 0;">
                        <svg width="80" height="80" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-text-lighter); margin-bottom: 1rem;">
                            <path d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-3-8v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 style="margin-bottom: 0.5rem; color: var(--eco-text);">No se encontraron productos</h3>
                        <p style="color: var(--eco-text-light);">Intenta con otros filtros o términos de búsqueda.</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Paginación -->
            <?php if ($products_query->max_num_pages > 1) : ?>
                <div style="margin-top: 3rem;">
                    <?php
                    echo paginate_links(array(
                        'total' => $products_query->max_num_pages,
                        'current' => $paged,
                        'prev_text' => '← Anterior',
                        'next_text' => 'Siguiente →',
                        'type' => 'list'
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background-color: var(--eco-bg-secondary);">
        <div class="u-container">
            <div style="background: white; padding: 3rem; border-radius: 1rem; text-align: center; box-shadow: var(--eco-shadow);">
                <h2 style="margin-bottom: 1rem; color: var(--eco-text);">
                    ¿No encuentras lo que buscas?
                </h2>
                <p style="margin-bottom: 2rem; color: var(--eco-text-light); max-width: 600px; margin-left: auto; margin-right: auto;">
                    Contáctanos para una propuesta personalizada. Podemos desarrollar productos específicos 
                    para las necesidades de tu empresa o familia.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--primary">
                        Contactar Asesor
                    </a>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--secondary">
                        Cotización B2B
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal de Producto -->
<div class="modal-overlay" id="product-modal">
    <div class="modal-content" style="max-width: 800px;">
        <button class="modal-close" id="product-modal-close">&times;</button>
        
        <div id="product-modal-content" style="padding: 2rem;">
            <!-- El contenido se cargará dinámicamente -->
        </div>
    </div>
</div>

<style>
@keyframes spin {
    to { transform: rotate(360deg); }
}

.star.filled {
    color: #fbbf24;
    fill: currentColor;
}

.star:not(.filled) {
    color: #d1d5db;
}

/* Hover effects */
.product-card:hover {
    transform: translateY(-5px);
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: 1fr;
    }
    
    .section:first-child > .u-container > div {
        grid-template-columns: 1fr;
    }
    
    .hero-title {
        font-size: 2rem !important;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    // Variables para filtros
    let searchTimeout;
    
    // Elementos del DOM
    const $searchInput = $('#product-search');
    const $categoryFilter = $('#category-filter');
    const $priceFilter = $('#price-filter');
    const $clearFilters = $('#clear-filters');
    const $productsGrid = $('#products-grid');
    const $loadingIndicator = $('#loading-indicator');
    const $resultsCount = $('#results-count');
    
    // Función de búsqueda y filtrado
    function filterProducts() {
        const searchTerm = $searchInput.val().toLowerCase();
        const selectedCategory = $categoryFilter.val();
        const maxPrice = $priceFilter.val();
        
        let visibleCount = 0;
        
        $('.product-card').each(function() {
            const $card = $(this);
            const productName = $card.data('name').toLowerCase();
            const productCategory = $card.data('category').toLowerCase();
            const productDescription = $card.data('description').toLowerCase();
            const productPrice = parseFloat($card.data('price'));
            
            let isVisible = true;
            
            // Filtro por búsqueda
            if (searchTerm && !productName.includes(searchTerm) && 
                !productCategory.includes(searchTerm) && 
                !productDescription.includes(searchTerm)) {
                isVisible = false;
            }
            
            // Filtro por categoría
            if (selectedCategory && !productCategory.includes(selectedCategory)) {
                isVisible = false;
            }
            
            // Filtro por precio
            if (maxPrice && productPrice > parseFloat(maxPrice)) {
                isVisible = false;
            }
            
            if (isVisible) {
                $card.show();
                visibleCount++;
            } else {
                $card.hide();
            }
        });
        
        // Actualizar contador de resultados
        updateResultsCount(visibleCount);
        
        // Mostrar mensaje si no hay resultados
        toggleNoResults(visibleCount === 0);
    }
    
    // Actualizar contador de resultados
    function updateResultsCount(count) {
        const total = $('.product-card').length;
        $resultsCount.text(`Mostrando ${count} de ${total} productos`);
    }
    
    // Mostrar/ocultar mensaje de "sin resultados"
    function toggleNoResults(show) {
        if (show) {
            if ($('#no-results-message').length === 0) {
                $productsGrid.append(`
                    <div id="no-results-message" style="grid-column: 1 / -1; text-align: center; padding: 4rem 0;">
                        <svg width="80" height="80" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-text-lighter); margin-bottom: 1rem;">
                            <path d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-3-8v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 style="margin-bottom: 0.5rem; color: var(--eco-text);">No se encontraron productos</h3>
                        <p style="color: var(--eco-text-light);">Intenta con otros filtros o términos de búsqueda.</p>
                    </div>
                `);
            }
        } else {
            $('#no-results-message').remove();
        }
    }
    
    // Event listeners para filtros
    $searchInput.on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(filterProducts, 300);
    });
    
    $categoryFilter.on('change', filterProducts);
    $priceFilter.on('change', filterProducts);
    
    // Limpiar filtros
    $clearFilters.on('click', function() {
        $searchInput.val('');
        $categoryFilter.val('');
        $priceFilter.val('');
        $('.product-card').show();
        updateResultsCount($('.product-card').length);
        toggleNoResults(false);
    });
    
    // Agregar al carrito
    $(document).on('click', '.add-to-cart', function() {
        const $button = $(this);
        const productId = $button.data('product-id');
        
        if ($button.prop('disabled')) return;
        
        $button.prop('disabled', true).text('Agregando...');
        
        $.ajax({
            url: ecohierbas.ajaxUrl,
            method: 'POST',
            data: {
                action: 'add_to_cart',
                product_id: productId,
                quantity: 1,
                nonce: ecohierbas.nonce
            },
            success: function(response) {
                if (response.success) {
                    showToast('Producto agregado al carrito', 'success');
                    updateCartCount(response.data.cart_count);
                } else {
                    showToast('Error al agregar el producto', 'error');
                }
            },
            error: function() {
                showToast('Error al agregar el producto', 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $button.html('<svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H19M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/></svg> Agregar');
            }
        });
    });
    
    // Ver producto (modal)
    $(document).on('click', '.view-product', function() {
        const productId = $(this).data('product-id');
        showProductModal(productId);
    });
    
    // Funciones auxiliares
    function showToast(message, type = 'info') {
        const toast = $(`
            <div class="toast ${type}" style="transform: translateX(100%);">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>${message}</span>
                </div>
            </div>
        `);
        
        $('#toast-container').append(toast);
        
        // Animar entrada
        setTimeout(() => {
            toast.css('transform', 'translateX(0)');
        }, 100);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            toast.css('transform', 'translateX(100%)');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    function updateCartCount(count) {
        $('#cart-count').text(count);
    }
    
    function showProductModal(productId) {
        $('#product-modal').addClass('active');
        // Aquí cargarías el contenido del producto vía AJAX
        $('#product-modal-content').html('<p>Cargando información del producto...</p>');
    }
    
    // Cerrar modal
    $('#product-modal-close, .modal-overlay').on('click', function(e) {
        if (e.target === this) {
            $('#product-modal').removeClass('active');
        }
    });
    
    // Inicializar contador
    updateResultsCount($('.product-card').length);
});
</script>

<?php get_footer(); ?>