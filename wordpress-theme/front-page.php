<?php
/**
 * Template for displaying the front page
 *
 * @package Ecohierbas
 */

get_header(); ?>

<main id="main" class="site-main front-page">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    <?php echo get_theme_mod('hero_title', 'Cultiva tu futuro verde'); ?>
                </h1>
                <p class="hero-subtitle">
                    <?php echo get_theme_mod('hero_subtitle', 'Descubre nuestra línea completa de productos para huerta urbana, maceteros y sistemas de vermicompostaje. Todo lo que necesitas para comenzar tu jardín sustentable.'); ?>
                </p>
                
                <div class="hero-actions">
                    <?php
                    $hero_button_text = get_theme_mod('hero_button_text', 'Ver Productos');
                    $hero_button_url = get_theme_mod('hero_button_url', '/productos/');
                    ?>
                    <a href="<?php echo esc_url($hero_button_url); ?>" class="btn btn-primary">
                        <?php echo esc_html($hero_button_text); ?>
                    </a>
                    
                    <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-secondary">
                        Ver Catálogo
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if (has_post_thumbnail()) : ?>
            <div class="hero-image">
                <?php the_post_thumbnail('hero-image', array('alt' => get_the_title())); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Featured Products Section -->
    <?php if (class_exists('WooCommerce')) : ?>
    <section class="featured-products">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Productos Destacados</h2>
                <p class="section-subtitle">Los favoritos de nuestros clientes para comenzar tu huerta urbana</p>
            </div>
            
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
                            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'product-thumbnail');
                            $sale_price = $product->get_sale_price();
                            $regular_price = $product->get_regular_price();
                            ?>
                            <div class="product-card">
                                <div class="product-image-wrapper">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ($product_image) : ?>
                                            <img src="<?php echo esc_url($product_image[0]); ?>" 
                                                 alt="<?php the_title(); ?>" 
                                                 class="product-image">
                                        <?php else : ?>
                                            <div class="product-placeholder">
                                                <i class="fas fa-seedling"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    
                                    <?php if ($product->is_on_sale()) : ?>
                                        <span class="sale-badge">¡Oferta!</span>
                                    <?php endif; ?>
                                    
                                    <?php if ($product->is_featured()) : ?>
                                        <span class="featured-badge">Destacado</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    
                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                    
                                    <div class="product-description">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                    </div>
                                    
                                    <div class="product-actions">
                                        <?php if ($product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock()) : ?>
                                            <button class="btn add-to-cart-btn" 
                                                    data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                                                    data-quantity="1">
                                                <i class="fas fa-shopping-cart"></i>
                                                Agregar al Carrito
                                            </button>
                                        <?php else : ?>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-outline">
                                                Ver Detalles
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <div class="section-footer">
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-outline">
                            Ver Todos los Productos
                        </a>
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
            <div class="section-header">
                <h2 class="section-title">¿Por qué elegir Ecohierbas?</h2>
                <p class="section-subtitle">Más que productos, ofrecemos soluciones completas para tu vida sustentable</p>
            </div>
            
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="benefit-title">100% Sustentable</h3>
                    <p>Todos nuestros productos están diseñados pensando en el medio ambiente, utilizando materiales reciclados y procesos eco-amigables.</p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="benefit-title">Ideal para Espacios Pequeños</h3>
                    <p>Perfecto para balcones, terrazas y pequeños jardines urbanos. Maximiza tu espacio verde sin importar el tamaño.</p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="benefit-title">Guías Completas</h3>
                    <p>Incluimos manuales detallados, videos instructivos y soporte personalizado para garantizar el éxito de tu huerta.</p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="benefit-title">Envío a Todo el País</h3>
                    <p>Llevamos nuestros productos a cualquier rincón del país con packaging 100% reciclable y tiempos de entrega rápidos.</p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="benefit-title">Comunidad Activa</h3>
                    <p>Únete a nuestra comunidad de cultivadores urbanos, comparte experiencias y aprende de otros entusiastas.</p>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="benefit-title">Calidad Garantizada</h3>
                    <p>Productos de la más alta calidad con garantía de satisfacción. Si no estás conforme, te devolvemos tu dinero.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <?php if (class_exists('WooCommerce')) : ?>
    <section class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Explora Nuestras Categorías</h2>
                <p class="section-subtitle">Todo lo que necesitas para tu huerta urbana organizado por categorías</p>
            </div>
            
            <?php
            $product_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'exclude' => array(15), // Exclude 'Uncategorized' category
                'number' => 4,
            ));
            
            if (!empty($product_categories) && !is_wp_error($product_categories)) : ?>
                <div class="categories-grid">
                    <?php foreach ($product_categories as $category) : 
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
                    ?>
                        <div class="category-card">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-link">
                                <div class="category-image">
                                    <?php if ($image_url) : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                    <?php else : ?>
                                        <div class="category-placeholder">
                                            <i class="fas fa-seedling"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="category-info">
                                    <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                                    <p class="category-count"><?php echo esc_html($category->count); ?> productos</p>
                                    <?php if ($category->description) : ?>
                                        <p class="category-description"><?php echo esc_html(wp_trim_words($category->description, 10)); ?></p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Lo que dicen nuestros clientes</h2>
                <p class="section-subtitle">Miles de personas ya disfrutan de sus huertas urbanas</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-item">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Increíble calidad y resultados. Mi balcón se transformó en un pequeño huerto productivo en pocas semanas."</p>
                    <div class="testimonial-author">
                        <strong>María González</strong>
                        <span>Cliente verificada</span>
                    </div>
                </div>
                
                <div class="testimonial-item">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"El kit de vermicompostaje es fantástico. Ahora reciclo todos mis restos orgánicos y obtengo el mejor abono."</p>
                    <div class="testimonial-author">
                        <strong>Carlos Mendoza</strong>
                        <span>Cliente verificado</span>
                    </div>
                </div>
                
                <div class="testimonial-item">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Excelente atención al cliente y productos de primera calidad. Los maceteros son perfectos para mi terraza."</p>
                    <div class="testimonial-author">
                        <strong>Ana Rodríguez</strong>
                        <span>Cliente verificada</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="contact-cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">¿Tienes preguntas?</h2>
                <p class="cta-subtitle">Nuestro equipo está aquí para ayudarte a comenzar tu huerta urbana</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <i class="fas fa-envelope"></i>
                        <h3>Email</h3>
                        <p>info@ecohierbas.com</p>
                    </div>
                    
                    <div class="contact-method">
                        <i class="fas fa-phone"></i>
                        <h3>Teléfono</h3>
                        <p>+1 234 567 8900</p>
                    </div>
                    
                    <div class="contact-method">
                        <i class="fas fa-comments"></i>
                        <h3>Chat Online</h3>
                        <p>Lun-Vie 9:00-18:00</p>
                    </div>
                </div>
                
                <!-- WP Forms Integration -->
                <div class="contact-form-wrapper">
                    <?php
                    if (function_exists('wpforms_display')) {
                        $contact_form_id = get_theme_mod('contact_form_id', 1);
                        echo wpforms_display($contact_form_id, true, true);
                    } else {
                        echo '<div class="form-placeholder">';
                        echo '<p>Formulario de contacto disponible cuando WP Forms esté instalado.</p>';
                        echo '<a href="/contacto/" class="btn btn-primary">Ir a Contacto</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h2 class="newsletter-title">Mantente al día</h2>
                    <p class="newsletter-subtitle">Recibe consejos, ofertas especiales y las últimas novedades en huerta urbana</p>
                </div>
                
                <div class="newsletter-form">
                    <!-- This would integrate with your email marketing service -->
                    <form class="newsletter-signup" action="#" method="post">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Tu email" class="form-control" required>
                            <button type="submit" class="btn btn-primary">Suscribirse</button>
                        </div>
                        <p class="newsletter-privacy">No spam. Cancela cuando quieras.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>