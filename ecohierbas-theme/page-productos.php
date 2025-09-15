<?php
/**
 * Template: Página Productos / Shop
 * Compatible con WooCommerce
 * 
 * @package EcoHierbas_Chile
 */

get_header(); 

// Verificar si WooCommerce está activo
if (!function_exists('WC')) {
    echo '<div class="u-container" style="padding: 4rem 0; text-align: center;">
        <h1>WooCommerce no está disponible</h1>
        <p>Esta página requiere que WooCommerce esté instalado y activado.</p>
    </div>';
    get_footer();
    return;
}

// Obtener categorías y productos
$product_categories = ecohierbas_get_product_categories();
$featured_products = ecohierbas_get_featured_products(4);

// Parámetros de consulta
$current_category = isset($_GET['product_cat']) ? sanitize_text_field($_GET['product_cat']) : '';
$search_query = isset($_GET['product_search']) ? sanitize_text_field($_GET['product_search']) : '';
$price_range = isset($_GET['price_range']) ? sanitize_text_field($_GET['price_range']) : '';

?>

<main class="main-content woocommerce">
    
    <!-- Breadcrumbs -->
    <div class="u-container" style="padding: 1rem 0;">
        <?php ecohierbas_breadcrumbs(); ?>
    </div>

    <!-- Hero Section -->
    <section style="padding: 3rem 0; background: linear-gradient(135deg, hsl(var(--primary) / 0.05), hsl(var(--accent) / 0.05));">
        <div class="u-container">
            <div class="u-text-center">
                <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Nuestros Productos
                </h1>
                <p style="font-size: 1.25rem; color: hsl(var(--muted-foreground)); margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Descubre nuestra amplia selección de productos orgánicos, hierbas medicinales y soluciones sustentables
                </p>
                
                <!-- Búsqueda rápida -->
                <div style="max-width: 500px; margin: 0 auto;">
                    <form method="GET" style="display: flex; gap: 0.5rem;">
                        <input type="text" 
                               name="product_search" 
                               value="<?php echo esc_attr($search_query); ?>"
                               placeholder="Buscar productos..." 
                               class="form-input" 
                               style="flex: 1; padding: 0.75rem; border: 1px solid hsl(var(--border)); border-radius: var(--eco-radius-m); background: hsl(var(--background));">
                        <button type="submit" class="btn btn-primary">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="M21 21l-4.35-4.35"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Destacados (solo si no hay búsqueda o filtros) -->
    <?php if (empty($search_query) && empty($current_category) && $featured_products->have_posts()) : ?>
    <section style="padding: 4rem 0; background: hsl(var(--muted) / 0.3);">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Productos Destacados
                </h2>
                <p style="color: hsl(var(--muted-foreground));">
                    Los más populares y mejor valorados por nuestros clientes
                </p>
            </div>
            
            <div class="product-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                <?php while ($featured_products->have_posts()) : $featured_products->the_post(); 
                    global $product; ?>
                    <div class="product-card">
                        <div style="position: relative; overflow: hidden;">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'product-thumbnail'); ?>" 
                                     alt="<?php the_title(); ?>" 
                                     class="product-image">
                            <?php else : ?>
                                <div style="width: 100%; height: 12rem; background: hsl(var(--muted)); display: flex; align-items: center; justify-content: center;">
                                    <span style="color: hsl(var(--muted-foreground));">Sin imagen</span>
                                </div>
                            <?php endif; ?>
                            
                            <span style="position: absolute; top: 0.5rem; left: 0.5rem; background: hsl(var(--accent)); color: white; padding: 0.25rem 0.5rem; border-radius: var(--eco-radius-s); font-size: 0.75rem;">
                                Destacado
                            </span>
                        </div>
                        
                        <div class="product-content">
                            <h3 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="product-description">
                                <?php echo ecohierbas_truncate_text(get_the_excerpt(), 100); ?>
                            </p>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                                <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                                <?php if ($product->get_average_rating()) : ?>
                                <div style="display: flex; align-items: center; gap: 0.25rem;">
                                    <span style="color: #fbbf24;">★</span>
                                    <span style="font-size: 0.875rem;"><?php echo $product->get_average_rating(); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <button type="button" class="add-to-cart-btn" data-product-id="<?php echo get_the_ID(); ?>">
                                Agregar al Carrito
                            </button>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Catálogo Principal -->
    <section style="padding: 4rem 0;">
        <div class="u-container">
            <div style="display: grid; grid-template-columns: 1fr; lg:grid-template-columns: 250px 1fr; gap: 2rem;">
                
                <!-- Sidebar de Filtros -->
                <aside style="background: hsl(var(--card)); padding: 1.5rem; border-radius: var(--eco-radius-l); height: fit-content; box-shadow: var(--eco-shadow-card);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1.5rem; color: hsl(var(--foreground));">
                        Filtrar Productos
                    </h3>
                    
                    <form method="GET" id="product-filters">
                        <!-- Mantener búsqueda actual -->
                        <?php if ($search_query) : ?>
                            <input type="hidden" name="product_search" value="<?php echo esc_attr($search_query); ?>">
                        <?php endif; ?>
                        
                        <!-- Categorías -->
                        <?php if ($product_categories && !is_wp_error($product_categories)) : ?>
                        <div style="margin-bottom: 2rem;">
                            <h4 style="font-weight: 600; margin-bottom: 1rem; color: hsl(var(--foreground));">Categorías</h4>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="radio" name="product_cat" value="" <?php checked($current_category, ''); ?>>
                                    <span>Todas las categorías</span>
                                </label>
                                <?php foreach ($product_categories as $category) : ?>
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="radio" name="product_cat" value="<?php echo esc_attr($category->slug); ?>" <?php checked($current_category, $category->slug); ?>>
                                    <span><?php echo esc_html($category->name); ?> (<?php echo $category->count; ?>)</span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Rango de Precios -->
                        <div style="margin-bottom: 2rem;">
                            <h4 style="font-weight: 600; margin-bottom: 1rem; color: hsl(var(--foreground));">Rango de Precio</h4>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="radio" name="price_range" value="" <?php checked($price_range, ''); ?>>
                                    <span>Todos los precios</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="radio" name="price_range" value="0-5000" <?php checked($price_range, '0-5000'); ?>>
                                    <span>Hasta $5.000</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="radio" name="price_range" value="5000-15000" <?php checked($price_range, '5000-15000'); ?>>
                                    <span>$5.000 - $15.000</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="radio" name="price_range" value="15000-30000" <?php checked($price_range, '15000-30000'); ?>>
                                    <span>$15.000 - $30.000</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="radio" name="price_range" value="30000+" <?php checked($price_range, '30000+'); ?>>
                                    <span>Más de $30.000</span>
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            Aplicar Filtros
                        </button>
                        
                        <?php if ($current_category || $price_range) : ?>
                        <a href="<?php echo get_permalink(); ?><?php echo $search_query ? '?product_search=' . urlencode($search_query) : ''; ?>" 
                           class="btn btn-secondary" 
                           style="width: 100%; margin-top: 0.5rem; text-align: center; text-decoration: none;">
                            Limpiar Filtros
                        </a>
                        <?php endif; ?>
                    </form>
                </aside>

                <!-- Grid de Productos -->
                <div>
                    <?php
                    // Preparar argumentos para WP_Query
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => '_visibility',
                                'value' => array('catalog', 'visible'),
                                'compare' => 'IN'
                            )
                        )
                    );

                    // Filtro por categoría
                    if ($current_category) {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $current_category
                            )
                        );
                    }

                    // Filtro por búsqueda
                    if ($search_query) {
                        $args['s'] = $search_query;
                    }

                    // Filtro por precio
                    if ($price_range) {
                        switch ($price_range) {
                            case '0-5000':
                                $args['meta_query'][] = array(
                                    'key' => '_price',
                                    'value' => array(0, 5000),
                                    'type' => 'NUMERIC',
                                    'compare' => 'BETWEEN'
                                );
                                break;
                            case '5000-15000':
                                $args['meta_query'][] = array(
                                    'key' => '_price',
                                    'value' => array(5000, 15000),
                                    'type' => 'NUMERIC',
                                    'compare' => 'BETWEEN'
                                );
                                break;
                            case '15000-30000':
                                $args['meta_query'][] = array(
                                    'key' => '_price',
                                    'value' => array(15000, 30000),
                                    'type' => 'NUMERIC',
                                    'compare' => 'BETWEEN'
                                );
                                break;
                            case '30000+':
                                $args['meta_query'][] = array(
                                    'key' => '_price',
                                    'value' => 30000,
                                    'type' => 'NUMERIC',
                                    'compare' => '>'
                                );
                                break;
                        }
                    }

                    $products_query = new WP_Query($args);
                    ?>

                    <!-- Resultados Header -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid hsl(var(--border));">
                        <div>
                            <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.25rem;">
                                <?php if ($current_category) : 
                                    $category_obj = get_term_by('slug', $current_category, 'product_cat');
                                    echo esc_html($category_obj->name);
                                elseif ($search_query) :
                                    echo 'Resultados para: "' . esc_html($search_query) . '"';
                                else :
                                    echo 'Todos los Productos';
                                endif; ?>
                            </h2>
                            <p class="results-count" style="color: hsl(var(--muted-foreground)); font-size: 0.875rem;">
                                <?php echo $products_query->found_posts; ?> productos encontrados
                            </p>
                        </div>
                        
                        <!-- Ordenamiento -->
                        <select onchange="location = this.value;" style="padding: 0.5rem; border: 1px solid hsl(var(--border)); border-radius: var(--eco-radius-s); background: hsl(var(--background));">
                            <option value="<?php echo add_query_arg('orderby', 'menu_order'); ?>">Orden por defecto</option>
                            <option value="<?php echo add_query_arg('orderby', 'popularity'); ?>">Más populares</option>
                            <option value="<?php echo add_query_arg('orderby', 'rating'); ?>">Mejor valorados</option>
                            <option value="<?php echo add_query_arg('orderby', 'date'); ?>">Más recientes</option>
                            <option value="<?php echo add_query_arg('orderby', 'price'); ?>">Precio: menor a mayor</option>
                            <option value="<?php echo add_query_arg('orderby', 'price-desc'); ?>">Precio: mayor a menor</option>
                        </select>
                    </div>

                    <!-- Grid de Productos -->
                    <?php if ($products_query->have_posts()) : ?>
                    <div class="product-grid">
                        <?php while ($products_query->have_posts()) : $products_query->the_post(); 
                            global $product; ?>
                            <div class="product-card" 
                                 data-category="<?php echo implode(' ', wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'slugs'))); ?>"
                                 data-price="<?php echo $product->get_price(); ?>">
                                
                                <div style="position: relative; overflow: hidden;">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'product-thumbnail'); ?>" 
                                             alt="<?php the_title(); ?>" 
                                             class="product-image"
                                             loading="lazy">
                                    <?php else : ?>
                                        <div style="width: 100%; height: 12rem; background: hsl(var(--muted)); display: flex; align-items: center; justify-content: center;">
                                            <span style="color: hsl(var(--muted-foreground));">Sin imagen</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($product->is_on_sale()) : ?>
                                        <span style="position: absolute; top: 0.5rem; left: 0.5rem; background: hsl(var(--accent)); color: white; padding: 0.25rem 0.5rem; border-radius: var(--eco-radius-s); font-size: 0.75rem; font-weight: 600;">
                                            <?php echo '-' . round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100) . '%'; ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (!$product->is_in_stock()) : ?>
                                        <span style="position: absolute; top: 0.5rem; right: 0.5rem; background: hsl(var(--destructive)); color: white; padding: 0.25rem 0.5rem; border-radius: var(--eco-radius-s); font-size: 0.75rem;">
                                            Agotado
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-content">
                                    <h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    
                                    <p class="product-description">
                                        <?php echo ecohierbas_truncate_text(get_the_excerpt(), 100); ?>
                                    </p>
                                    
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                                        <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                                        <?php if ($product->get_average_rating()) : ?>
                                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                                            <span style="color: #fbbf24;">★</span>
                                            <span style="font-size: 0.875rem; color: hsl(var(--muted-foreground));">
                                                <?php echo $product->get_average_rating(); ?> (<?php echo $product->get_rating_count(); ?>)
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <button type="button" 
                                            class="add-to-cart-btn" 
                                            data-product-id="<?php echo get_the_ID(); ?>"
                                            <?php echo $product->is_purchasable() && $product->is_in_stock() ? '' : 'disabled'; ?>>
                                        <?php 
                                        if (!$product->is_in_stock()) {
                                            echo 'Agotado';
                                        } elseif (!$product->is_purchasable()) {
                                            echo 'No Disponible';
                                        } else {
                                            echo 'Agregar al Carrito';
                                        }
                                        ?>
                                    </button>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Paginación -->
                    <?php if ($products_query->max_num_pages > 1) : ?>
                    <div style="margin-top: 3rem; text-align: center;">
                        <?php
                        echo paginate_links(array(
                            'total' => $products_query->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'format' => '?paged=%#%',
                            'prev_text' => '← Anterior',
                            'next_text' => 'Siguiente →',
                        ));
                        ?>
                    </div>
                    <?php endif; ?>

                    <?php else : ?>
                    <!-- No products found -->
                    <div style="text-align: center; padding: 4rem 2rem; background: hsl(var(--muted) / 0.3); border-radius: var(--eco-radius-l);">
                        <svg width="64" height="64" fill="none" stroke="hsl(var(--muted-foreground))" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 1rem; opacity: 0.5;">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a1 1 0 001 1h9a1 1 0 001-1v-6"/>
                        </svg>
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">No se encontraron productos</h3>
                        <p style="color: hsl(var(--muted-foreground)); margin-bottom: 2rem;">
                            <?php if ($search_query || $current_category || $price_range) : ?>
                                Intenta ajustar los filtros o buscar algo diferente.
                            <?php else : ?>
                                Aún no hay productos disponibles en esta sección.
                            <?php endif; ?>
                        </p>
                        
                        <?php if ($search_query || $current_category || $price_range) : ?>
                        <a href="<?php echo get_permalink(); ?>" class="btn btn-primary">
                            Ver Todos los Productos
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>