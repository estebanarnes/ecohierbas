<?php
/**
 * Template principal del tema EcoHierbas Chile
 */
get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-ecohierbas.jpg');">
        <div class="hero-overlay"></div>
        <div class="hero-content u-container">
            <div class="hero-badge">
                🌱 Productos orgánicos certificados desde 2015
            </div>
            
            <h1 class="hero-title">
                Hierbas medicinales
                <span class="accent">orgánicas</span>
                <br>
                para tu bienestar
            </h1>
            
            <p class="hero-subtitle">
                Descubre nuestra selección de hierbas medicinales, productos de vermicompostaje
                y soluciones ecológicas para empresas conscientes y familias que cuidan su salud.
            </p>
            
            <div class="hero-ctas">
                <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--primary">
                    Cotización Corporativa
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 7l5 5-5 5M6 12h12"/>
                    </svg>
                </a>
                <a href="<?php echo esc_url(home_url('/productos')); ?>" class="u-btn u-btn--secondary">
                    Ver Productos
                </a>
            </div>
            
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Empresas confían</div>
                </div>
                <div class="hero-stat">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Orgánico</div>
                </div>
                <div class="hero-stat">
                    <div class="stat-number">Local</div>
                    <div class="stat-label">Pudahuel, RM</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios Section -->
    <section class="section">
        <div class="u-container">
            <div class="section-header">
                <span class="section-badge">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Envíos a todo Chile
                </span>
                <h2 class="section-title">
                    ¿Por qué elegir <span style="color: var(--eco-accent);">EcoHierbas</span> Chile?
                </h2>
                <p class="section-description">
                    Más que productos naturales, somos una empresa comprometida con tu bienestar 
                    y el cuidado del planeta. Conoce los valores que nos impulsan.
                </p>
            </div>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="benefit-title">Producción Local</h3>
                    <p class="benefit-description">
                        Cultivado y producido en Pudahuel, apoyando la economía local
                    </p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="benefit-title">Sostenibilidad</h3>
                    <p class="benefit-description">
                        Comprometidos con el medio ambiente y prácticas sustentables
                    </p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="benefit-title">Calidad Certificada</h3>
                    <p class="benefit-description">
                        Productos con estándares de calidad y certificaciones orgánicas
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <section class="section" style="background-color: var(--eco-bg-secondary);">
        <div class="u-container">
            <div class="section-header">
                <span class="section-badge">Productos Destacados</span>
                <h2 class="section-title">Nuestros productos más valorados</h2>
                <p class="section-description">
                    Descubre los productos que más eligen nuestros clientes para cuidar su salud 
                    y contribuir al medio ambiente.
                </p>
            </div>
            
            <div class="products-grid">
                <?php
                $featured_products = ecohierbas_get_featured_products(3);
                
                if ($featured_products->have_posts()) :
                    while ($featured_products->have_posts()) : $featured_products->the_post();
                        $price = get_post_meta(get_the_ID(), '_price', true);
                        $original_price = get_post_meta(get_the_ID(), '_original_price', true);
                        $stock = get_post_meta(get_the_ID(), '_stock_status', true);
                        $category = get_the_terms(get_the_ID(), 'product_cat');
                        $rating = get_post_meta(get_the_ID(), '_average_rating', true) ?: 5;
                        $reviews = get_post_meta(get_the_ID(), '_review_count', true) ?: rand(15, 50);
                ?>
                        <div class="product-card" data-product-id="<?php echo get_the_ID(); ?>">
                            <?php if ($stock !== 'instock') : ?>
                                <div class="stock-badge out-of-stock">Agotado</div>
                            <?php else : ?>
                                <div class="stock-badge in-stock">En Stock</div>
                            <?php endif; ?>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'product-thumbnail'); ?>" 
                                     alt="<?php echo get_the_title(); ?>" 
                                     class="product-image">
                            <?php endif; ?>
                            
                            <div class="product-content">
                                <?php if ($category && !is_wp_error($category)) : ?>
                                    <span class="product-category"><?php echo esc_html($category[0]->name); ?></span>
                                <?php endif; ?>
                                
                                <h3 class="product-title"><?php echo get_the_title(); ?></h3>
                                
                                <p class="product-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                
                                <div class="product-rating">
                                    <div class="rating-stars">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <svg class="star <?php echo $i <= $rating ? 'filled' : ''; ?>" width="16" height="16" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="rating-text"><?php echo $rating; ?> (<?php echo $reviews; ?>)</span>
                                </div>
                                
                                <div class="product-price">
                                    <span class="current-price"><?php echo ecohierbas_format_price($price); ?></span>
                                    <?php if ($original_price && $original_price > $price) : ?>
                                        <span class="original-price"><?php echo ecohierbas_format_price($original_price); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-actions">
                                    <button class="add-to-cart" 
                                            data-product-id="<?php echo get_the_ID(); ?>"
                                            <?php echo $stock !== 'instock' ? 'disabled' : ''; ?>>
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H19M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
                                        </svg>
                                        Agregar
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
                endif;
                ?>
            </div>
            
            <div class="u-text-center">
                <a href="<?php echo esc_url(home_url('/productos')); ?>" class="u-btn u-btn--secondary">
                    Ver Todos los Productos
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="section">
        <div class="u-container">
            <div class="section-header">
                <span class="section-badge">Testimonios Reales</span>
                <h2 class="section-title">Lo que dicen nuestros clientes</h2>
                <p class="section-description">
                    Más de 500 empresas y miles de familias confían en la calidad 
                    de nuestros productos orgánicos.
                </p>
            </div>
            
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-rating">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <svg class="star filled" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="review-text">
                        "Las hierbas de EcoHierbas han mejorado notablemente el bienestar de nuestros colaboradores. 
                        La calidad es excepcional y el servicio es muy profesional."
                    </blockquote>
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">MG</div>
                        <div class="reviewer-details">
                            <div class="reviewer-name">María González</div>
                            <div class="reviewer-company">Jefa de Bienestar, Corporación Sustentable S.A.</div>
                        </div>
                    </div>
                </div>
                
                <div class="review-card">
                    <div class="review-rating">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <svg class="star filled" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="review-text">
                        "La vermicompostera que instalamos en nuestra oficina ha sido un éxito total. 
                        Nuestro equipo está más consciente del reciclaje y la sostenibilidad."
                    </blockquote>
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">CM</div>
                        <div class="reviewer-details">
                            <div class="reviewer-name">Carlos Mendoza</div>
                            <div class="reviewer-company">Gerente General, EcoTech Innovations</div>
                        </div>
                    </div>
                </div>
                
                <div class="review-card">
                    <div class="review-rating">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <svg class="star filled" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="review-text">
                        "Los productos son de excelente calidad. Mis hijos ahora cultivan sus propias hierbas 
                        gracias al kit que compramos. Recomendado 100%."
                    </blockquote>
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">AR</div>
                        <div class="reviewer-details">
                            <div class="reviewer-name">Ana Rodríguez</div>
                            <div class="reviewer-company">Madre de familia</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Talleres -->
    <section class="section workshops-section">
        <div class="workshops-content u-container">
            <div class="section-header">
                <span class="section-badge">Educación Ambiental</span>
                <h2 class="section-title" style="color: white;">Talleres y Capacitaciones</h2>
                <p class="section-description" style="color: rgba(255, 255, 255, 0.9);">
                    Fortalece tu conocimiento en sustentabilidad, cultivo orgánico y economía circular 
                    con nuestros talleres especializados.
                </p>
            </div>
            
            <div class="workshops-grid">
                <div class="workshop-card">
                    <span class="workshop-category b2b">B2B</span>
                    <h3 class="workshop-title">Introducción al Vermicompostaje Empresarial</h3>
                    <p class="workshop-description">
                        Aprende a implementar sistemas de compostaje en tu empresa para reducir residuos 
                        y crear conciencia ambiental.
                    </p>
                    <div class="workshop-details">
                        <div class="workshop-detail">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V7a2 2 0 012-2h4a2 2 0 012 2v0M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"/>
                            </svg>
                            15 de Marzo, 2024
                        </div>
                        <div class="workshop-detail">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            14:00 - 17:00
                        </div>
                        <div class="workshop-detail">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Presencial - San Vicente Tagua Tagua
                        </div>
                    </div>
                    <div class="workshop-price">
                        <span class="price-label">Precio:</span>
                        <span class="price-amount free">Gratuito</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--primary" style="width: 100%;">
                        Reservar Cupo
                    </a>
                </div>
                
                <div class="workshop-card">
                    <span class="workshop-category b2c">B2C</span>
                    <h3 class="workshop-title">Cultivo de Hierbas Medicinales en Casa</h3>
                    <p class="workshop-description">
                        Taller práctico para aprender a cultivar y cuidar hierbas medicinales en espacios reducidos.
                    </p>
                    <div class="workshop-details">
                        <div class="workshop-detail">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V7a2 2 0 012-2h4a2 2 0 012 2v0M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"/>
                            </svg>
                            22 de Marzo, 2024
                        </div>
                        <div class="workshop-detail">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            10:00 - 13:00
                        </div>
                        <div class="workshop-detail">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Presencial - San Vicente Tagua Tagua
                        </div>
                    </div>
                    <div class="workshop-price">
                        <span class="price-label">Precio:</span>
                        <span class="price-amount paid">$15.000</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--primary" style="width: 100%;">
                        Reservar Cupo
                    </a>
                </div>
            </div>
            
            <div class="u-text-center" style="margin-top: 3rem;">
                <div style="background: rgba(255, 255, 255, 0.95); padding: 2rem; border-radius: 1rem; backdrop-filter: blur(10px);">
                    <h3 style="margin-bottom: 1rem; color: var(--eco-text);">
                        ¿Necesitas un taller personalizado para tu empresa?
                    </h3>
                    <p style="margin-bottom: 1.5rem; color: var(--eco-text-light);">
                        Diseñamos talleres a medida para equipos corporativos enfocados en sustentabilidad, 
                        bienestar laboral y responsabilidad social empresarial.
                    </p>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--primary">
                        Solicitar Propuesta B2B
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>