<?php
/**
 * The main template file
 *
 * @package Ecohierbas
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php if (is_home() || is_front_page()) : ?>
        
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <h1 class="hero-title">
                    <?php echo get_theme_mod('hero_title', 'Cultiva tu futuro verde'); ?>
                </h1>
                <p class="hero-subtitle">
                    <?php echo get_theme_mod('hero_subtitle', 'Descubre nuestra línea completa de productos para huerta urbana, maceteros y sistemas de vermicompostaje. Todo lo que necesitas para comenzar tu jardín sustentable.'); ?>
                </p>
                <?php
                $hero_button_text = get_theme_mod('hero_button_text', 'Ver Productos');
                $hero_button_url = get_theme_mod('hero_button_url', '/productos/');
                ?>
                <a href="<?php echo esc_url($hero_button_url); ?>" class="btn btn-primary">
                    <?php echo esc_html($hero_button_text); ?>
                </a>
            </div>
        </section>

        <!-- Featured Products Section -->
        <?php if (class_exists('WooCommerce')) : ?>
        <section class="featured-products">
            <div class="container">
                <h2 class="section-title">Productos Destacados</h2>
                
                <?php
                // Get featured products
                $featured_products = wc_get_featured_product_ids();
                
                if (!empty($featured_products)) :
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 6,
                        'post__in' => $featured_products,
                        'orderby' => 'post__in'
                    );
                    
                    $featured_query = new WP_Query($args);
                    
                    if ($featured_query->have_posts()) : ?>
                        <div class="products-grid">
                            <?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
                                <?php
                                global $product;
                                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                ?>
                                <div class="product-card">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ($product_image) : ?>
                                            <img src="<?php echo esc_url($product_image[0]); ?>" 
                                                 alt="<?php the_title(); ?>" 
                                                 class="product-image">
                                        <?php endif; ?>
                                        
                                        <div class="product-info">
                                            <h3 class="product-title"><?php the_title(); ?></h3>
                                            <div class="product-price">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                            <div class="product-description">
                                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                            </div>
                                            <div class="product-actions">
                                                <?php
                                                if ($product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock()) {
                                                    woocommerce_template_loop_add_to_cart();
                                                } else {
                                                    echo '<a href="' . get_permalink() . '" class="btn">Ver Detalles</a>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif;
                    wp_reset_postdata();
                endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Benefits Section -->
        <section class="benefits-section">
            <div class="container">
                <h2 class="section-title">¿Por qué elegir Ecohierbas?</h2>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <div class="benefit-icon">🌱</div>
                        <h3 class="benefit-title">Productos Sustentables</h3>
                        <p>Todos nuestros productos están diseñados pensando en el medio ambiente y la sostenibilidad.</p>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">🏠</div>
                        <h3 class="benefit-title">Ideal para Espacios Pequeños</h3>
                        <p>Perfecto para balcones, terrazas y pequeños jardines urbanos.</p>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">📚</div>
                        <h3 class="benefit-title">Guías Completas</h3>
                        <p>Incluimos manuales detallados y soporte para que tengas éxito en tu huerta.</p>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">🚚</div>
                        <h3 class="benefit-title">Envío a Todo el País</h3>
                        <p>Llevamos nuestros productos a cualquier rincón del país con packaging ecológico.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="container">
                <h2 class="section-title">¿Tienes preguntas?</h2>
                <div class="contact-form">
                    <?php
                    // Display WP Forms contact form if plugin is active
                    if (function_exists('wpforms_display')) {
                        $contact_form_id = get_theme_mod('contact_form_id', 1);
                        echo wpforms_display($contact_form_id, true, true);
                    } else {
                        // Fallback contact info
                        echo '<div style="text-align: center;">';
                        echo '<p>Contáctanos para resolver todas tus dudas sobre nuestros productos.</p>';
                        echo '<p><strong>Email:</strong> info@ecohierbas.com</p>';
                        echo '<p><strong>Teléfono:</strong> +1 234 567 8900</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </section>

    <?php else : ?>
        
        <!-- Standard Loop for other pages -->
        <div class="container">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
                
                <?php
                // Pagination
                the_posts_pagination(array(
                    'prev_text' => __('Anterior', 'ecohierbas'),
                    'next_text' => __('Siguiente', 'ecohierbas'),
                ));
                ?>
                
            <?php else : ?>
                <div class="no-content">
                    <h2><?php _e('No se encontró contenido', 'ecohierbas'); ?></h2>
                    <p><?php _e('Lo sentimos, pero no hay contenido disponible en esta página.', 'ecohierbas'); ?></p>
                </div>
            <?php endif; ?>
        </div>
        
    <?php endif; ?>
</main>

<?php get_footer(); ?>