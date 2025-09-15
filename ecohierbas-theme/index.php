<?php
/**
 * Template: Homepage / Index
 * 
 * @package EcoHierbas_Chile
 */

get_header(); ?>

<main class="main-content">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="u-container">
            <div class="hero-content">
                <h1 class="hero-title fade-in">
                    Productos Orgánicos <br>
                    <span style="color: hsl(var(--primary));">Para una Vida Sustentable</span>
                </h1>
                <p class="hero-subtitle fade-in">
                    Descubre nuestra selección de hierbas medicinales, productos orgánicos y 
                    soluciones de vermicompostaje para un futuro más verde.
                </p>
                <div class="hero-actions fade-in" style="margin-top: 2rem;">
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-primary" style="margin-right: 1rem;">
                        Explorar Productos
                    </a>
                    <a href="<?php echo get_permalink(get_page_by_path('contacto')); ?>" class="btn btn-secondary">
                        Contáctanos
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Background decoration -->
        <div style="position: absolute; top: 0; right: 0; width: 50%; height: 100%; background: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg') center/cover; opacity: 0.1; z-index: 1;"></div>
    </section>

    <!-- Benefits Section -->
    <section style="padding: 4rem 0; background: hsl(var(--muted) / 0.3);">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    ¿Por qué elegir EcoHierbas?
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem;">
                    Comprometidos con la calidad, sustentabilidad y tu bienestar
                </p>
            </div>
            
            <div class="u-grid u-grid--cols-3">
                <div class="benefit-card" style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 4rem; height: 4rem; background: hsl(var(--primary) / 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" style="color: hsl(var(--primary));">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5"/>
                            <path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">100% Orgánico</h3>
                    <p style="color: hsl(var(--muted-foreground));">
                        Productos cultivados sin químicos, pesticidas ni fertilizantes artificiales.
                    </p>
                </div>
                
                <div class="benefit-card" style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 4rem; height: 4rem; background: hsl(var(--accent) / 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" style="color: hsl(var(--accent));">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Calidad Garantizada</h3>
                    <p style="color: hsl(var(--muted-foreground));">
                        Rigurosos controles de calidad en cada etapa del proceso productivo.
                    </p>
                </div>
                
                <div class="benefit-card" style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 4rem; height: 4rem; background: hsl(var(--primary) / 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" style="color: hsl(var(--primary));">
                            <path d="M3 6h18l-2 13H5L3 6z"/>
                            <path d="M3 6L2 3H0"/>
                            <circle cx="9" cy="19" r="1"/>
                            <circle cx="20" cy="19" r="1"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Entrega Nacional</h3>
                    <p style="color: hsl(var(--muted-foreground));">
                        Enviamos a todo Chile con embalaje ecológico y entregas rápidas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section style="padding: 4rem 0;">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Productos Destacados
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem;">
                    Descubre nuestros productos más populares y mejor valorados
                </p>
            </div>
            
            <div class="woocommerce">
                <div class="product-grid">
                    <?php 
                    $featured_products = ecohierbas_get_featured_products(8);
                    if ($featured_products->have_posts()) :
                        while ($featured_products->have_posts()) : $featured_products->the_post();
                            global $product;
                    ?>
                    <div class="product-card">
                        <div class="product-image-container" style="position: relative; overflow: hidden;">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'product-thumbnail'); ?>" 
                                     alt="<?php the_title(); ?>" 
                                     class="product-image">
                            <?php else : ?>
                                <div style="width: 100%; height: 12rem; background: hsl(var(--muted)); display: flex; align-items: center; justify-content: center;">
                                    <span style="color: hsl(var(--muted-foreground));">Sin imagen</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($product->is_on_sale()) : ?>
                                <span style="position: absolute; top: 0.5rem; left: 0.5rem; background: hsl(var(--accent)); color: white; padding: 0.25rem 0.5rem; border-radius: var(--eco-radius-s); font-size: 0.75rem; font-weight: 600;">
                                    Oferta
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="product-content">
                            <h3 class="product-title">
                                <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <p class="product-description">
                                <?php echo ecohierbas_truncate_text(get_the_excerpt(), 100); ?>
                            </p>
                            
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                                <span class="product-price">
                                    <?php echo $product->get_price_html(); ?>
                                </span>
                                <?php if ($product->get_average_rating()) : ?>
                                <div style="display: flex; align-items: center; gap: 0.25rem;">
                                    <span style="color: #fbbf24;">★</span>
                                    <span style="font-size: 0.875rem; color: hsl(var(--muted-foreground));">
                                        <?php echo $product->get_average_rating(); ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <button type="button" 
                                    class="add-to-cart-btn" 
                                    data-product-id="<?php echo get_the_ID(); ?>"
                                    <?php echo $product->is_purchasable() ? '' : 'disabled'; ?>>
                                <?php echo $product->is_purchasable() ? 'Agregar al Carrito' : 'No Disponible'; ?>
                            </button>
                        </div>
                    </div>
                    <?php 
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem;">
                        <p>No hay productos destacados disponibles.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="u-text-center" style="margin-top: 3rem;">
                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-primary">
                    Ver Todos los Productos
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section style="padding: 4rem 0; background: linear-gradient(135deg, hsl(var(--primary) / 0.05), hsl(var(--accent) / 0.05));">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Nuestro Impacto
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem;">
                    Números que reflejan nuestro compromiso con la sustentabilidad
                </p>
            </div>
            
            <div class="u-grid u-grid--cols-4">
                <div class="stat-card" style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; font-weight: 700; color: hsl(var(--primary)); margin-bottom: 0.5rem;">
                        500+
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem;">Clientes Satisfechos</h3>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem;">
                        Confiando en nuestros productos orgánicos
                    </p>
                </div>
                
                <div class="stat-card" style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; font-weight: 700; color: hsl(var(--accent)); margin-bottom: 0.5rem;">
                        50+
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem;">Productos Únicos</h3>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem;">
                        Hierbas y productos cuidadosamente seleccionados
                    </p>
                </div>
                
                <div class="stat-card" style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; font-weight: 700; color: hsl(var(--primary)); margin-bottom: 0.5rem;">
                        3
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem;">Años de Experiencia</h3>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem;">
                        Creciendo junto a la comunidad sustentable
                    </p>
                </div>
                
                <div class="stat-card" style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; font-weight: 700; color: hsl(var(--accent)); margin-bottom: 0.5rem;">
                        100%
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem;">Orgánico</h3>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem;">
                        Sin químicos ni aditivos artificiales
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshops Section -->
    <section style="padding: 4rem 0;">
        <div class="u-container">
            <div style="background: linear-gradient(135deg, hsl(var(--primary) / 0.1), hsl(var(--accent) / 0.1)); border-radius: var(--eco-radius-l); padding: 3rem; text-align: center;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Talleres de Sustentabilidad
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Aprende técnicas de cultivo orgánico, vermicompostaje y vida sustentable con nuestros expertos.
                </p>
                <div style="display: flex; flex-direction: column; sm:flex-direction: row; gap: 1rem; justify-content: center; align-items: center;">
                    <a href="<?php echo get_permalink(get_page_by_path('contacto')); ?>" class="btn btn-primary">
                        Consultar Talleres
                    </a>
                    <span style="color: hsl(var(--muted-foreground)); font-size: 0.875rem;">
                        Talleres presenciales y virtuales disponibles
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section style="padding: 4rem 0; background: hsl(var(--muted) / 0.3);">
        <div class="u-container">
            <div class="u-text-center">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Mantente Conectado
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem; margin-bottom: 2rem;">
                    Recibe noticias sobre nuevos productos, talleres y tips de vida sustentable
                </p>
                
                <form class="newsletter-form" style="max-width: 400px; margin: 0 auto; display: flex; gap: 0.5rem;">
                    <input type="email" 
                           placeholder="Tu email" 
                           required
                           style="flex: 1; padding: 0.75rem; border: 1px solid hsl(var(--border)); border-radius: var(--eco-radius-m); background: hsl(var(--background));">
                    <button type="submit" class="btn btn-primary">
                        Suscribir
                    </button>
                </form>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>