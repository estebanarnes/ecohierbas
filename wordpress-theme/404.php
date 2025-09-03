<?php
/**
 * Template for displaying 404 pages
 *
 * @package Ecohierbas
 */

get_header(); ?>

<main id="main" class="site-main error-404-page">
    <div class="container">
        
        <div class="error-404-content">
            <div class="error-404-graphic">
                <div class="error-number">404</div>
                <div class="error-icon">
                    <i class="fas fa-seedling"></i>
                </div>
            </div>
            
            <div class="error-404-text">
                <h1 class="error-title"><?php _e('Página no encontrada', 'ecohierbas'); ?></h1>
                <p class="error-description">
                    <?php _e('Lo sentimos, pero la página que estás buscando no existe. Puede que haya sido movida, eliminada o la URL esté incorrecta.', 'ecohierbas'); ?>
                </p>
                
                <div class="error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i>
                        <?php _e('Volver al Inicio', 'ecohierbas'); ?>
                    </a>
                    
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-outline">
                            <i class="fas fa-store"></i>
                            <?php _e('Ver Productos', 'ecohierbas'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Search Form -->
        <div class="error-search">
            <h3><?php _e('¿Buscas algo específico?', 'ecohierbas'); ?></h3>
            <?php get_search_form(); ?>
        </div>
        
        <!-- Popular Posts/Products -->
        <div class="error-suggestions">
            <h3><?php _e('Contenido Popular', 'ecohierbas'); ?></h3>
            
            <div class="suggestions-grid">
                <!-- Popular Posts -->
                <div class="suggestion-section">
                    <h4><?php _e('Posts Populares', 'ecohierbas'); ?></h4>
                    <?php
                    $popular_posts = new WP_Query(array(
                        'posts_per_page' => 3,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC'
                    ));
                    
                    if ($popular_posts->have_posts()) : ?>
                        <ul class="suggestion-list">
                            <?php while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif;
                    wp_reset_postdata();
                    ?>
                </div>
                
                <!-- Popular Products -->
                <?php if (class_exists('WooCommerce')) : ?>
                <div class="suggestion-section">
                    <h4><?php _e('Productos Populares', 'ecohierbas'); ?></h4>
                    <?php
                    $popular_products = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => 3,
                        'meta_key' => 'total_sales',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC'
                    ));
                    
                    if ($popular_products->have_posts()) : ?>
                        <ul class="suggestion-list">
                            <?php while ($popular_products->have_posts()) : $popular_products->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif;
                    wp_reset_postdata();
                    ?>
                </div>
                <?php endif; ?>
                
                <!-- Categories -->
                <div class="suggestion-section">
                    <h4><?php _e('Categorías', 'ecohierbas'); ?></h4>
                    <ul class="suggestion-list">
                        <?php
                        wp_list_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'show_count' => 1,
                            'title_li' => '',
                            'number' => 5,
                        ));
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</main>

<?php get_footer(); ?>