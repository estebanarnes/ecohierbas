<?php
/**
 * Template for displaying search results
 *
 * @package Ecohierbas
 */

get_header(); ?>

<main id="main" class="site-main search-results">
    <div class="container">
        
        <!-- Search Header -->
        <header class="search-header">
            <h1 class="search-title">
                <?php
                printf(
                    __('Resultados de búsqueda para: %s', 'ecohierbas'),
                    '<span class="search-term">' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            
            <?php if (have_posts()) : ?>
                <p class="search-count">
                    <?php
                    printf(
                        _n('Se encontró %d resultado', 'Se encontraron %d resultados', $wp_query->found_posts, 'ecohierbas'),
                        $wp_query->found_posts
                    );
                    ?>
                </p>
            <?php endif; ?>
            
            <!-- Search Form -->
            <div class="search-form-container">
                <?php get_search_form(); ?>
            </div>
        </header>

        <!-- Search Results -->
        <?php if (have_posts()) : ?>
            <div class="search-results-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="result-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="result-content">
                            <div class="result-meta">
                                <span class="result-type">
                                    <?php
                                    $post_type = get_post_type();
                                    if ($post_type === 'product' && class_exists('WooCommerce')) {
                                        echo '<i class="fas fa-shopping-bag"></i> Producto';
                                    } elseif ($post_type === 'post') {
                                        echo '<i class="fas fa-file-alt"></i> Artículo';
                                    } elseif ($post_type === 'page') {
                                        echo '<i class="fas fa-file"></i> Página';
                                    } else {
                                        echo '<i class="fas fa-file"></i> ' . ucfirst($post_type);
                                    }
                                    ?>
                                </span>
                                <span class="result-date"><?php echo get_the_date(); ?></span>
                            </div>
                            
                            <h2 class="result-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="result-excerpt">
                                <?php
                                if (get_post_type() === 'product' && class_exists('WooCommerce')) {
                                    global $product;
                                    echo '<div class="product-price">' . $product->get_price_html() . '</div>';
                                }
                                
                                $excerpt = get_the_excerpt();
                                if ($excerpt) {
                                    echo wp_trim_words($excerpt, 25);
                                } else {
                                    echo wp_trim_words(get_the_content(), 25);
                                }
                                ?>
                            </div>
                            
                            <div class="result-actions">
                                <?php if (get_post_type() === 'product' && class_exists('WooCommerce')) : ?>
                                    <?php global $product; ?>
                                    <?php if ($product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock()) : ?>
                                        <button class="btn btn-sm add-to-cart-btn" 
                                                data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                                                data-quantity="1">
                                            <i class="fas fa-cart-plus"></i>
                                            Agregar al Carrito
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">
                                    <?php _e('Ver más', 'ecohierbas'); ?>
                                </a>
                            </div>
                        </div>
                        
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination-wrapper">
                <?php
                the_posts_pagination(array(
                    'prev_text' => __('&laquo; Anterior', 'ecohierbas'),
                    'next_text' => __('Siguiente &raquo;', 'ecohierbas'),
                ));
                ?>
            </div>
            
        <?php else : ?>
            <div class="no-results">
                <div class="no-results-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h2><?php _e('No se encontraron resultados', 'ecohierbas'); ?></h2>
                <p><?php _e('Lo sentimos, pero no encontramos nada que coincida con tu búsqueda. Intenta con otros términos.', 'ecohierbas'); ?></p>
                
                <div class="search-suggestions">
                    <h3><?php _e('Sugerencias:', 'ecohierbas'); ?></h3>
                    <ul>
                        <li><?php _e('Verifica que todas las palabras estén escritas correctamente', 'ecohierbas'); ?></li>
                        <li><?php _e('Intenta con palabras clave diferentes', 'ecohierbas'); ?></li>
                        <li><?php _e('Usa términos más generales', 'ecohierbas'); ?></li>
                        <li><?php _e('Intenta con menos palabras', 'ecohierbas'); ?></li>
                    </ul>
                </div>
                
                <!-- Popular searches or categories -->
                <div class="popular-searches">
                    <h3><?php _e('Búsquedas populares:', 'ecohierbas'); ?></h3>
                    <div class="search-tags">
                        <a href="<?php echo esc_url(home_url('/?s=maceteros')); ?>" class="search-tag">maceteros</a>
                        <a href="<?php echo esc_url(home_url('/?s=semillas')); ?>" class="search-tag">semillas</a>
                        <a href="<?php echo esc_url(home_url('/?s=vermicompostaje')); ?>" class="search-tag">vermicompostaje</a>
                        <a href="<?php echo esc_url(home_url('/?s=huerta urbana')); ?>" class="search-tag">huerta urbana</a>
                        <a href="<?php echo esc_url(home_url('/?s=sustentable')); ?>" class="search-tag">sustentable</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>