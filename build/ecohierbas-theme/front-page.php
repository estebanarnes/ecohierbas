<?php
/**
 * Front Page Template - Home Page
 *
 * @package EcoHierbas
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero__bg">
        <?php
        $hero_image = get_theme_mod('hero_background_image');
        if ($hero_image) {
            echo '<img src="' . esc_url($hero_image) . '" alt="EcoHierbas Chile Hero">';
        } else {
            echo '<img src="' . get_template_directory_uri() . '/assets/images/hero-ecohierbas.jpg" alt="Hierbas medicinales y aromáticas orgánicas EcoHierbas Chile">';
        }
        ?>
        <div class="hero__overlay"></div>
    </div>

    <div class="u-container">
        <div class="hero__content">
            <div class="hero__badge">
                <span class="mr-2">🌱</span>
                Productos orgánicos certificados desde 2015
            </div>

            <h1 class="hero__title">
                <?php echo esc_html(get_theme_mod('hero_title', 'Hierbas medicinales')); ?>
                <span class="accent"> orgánicas</span>
                <br>
                para tu bienestar
            </h1>

            <p class="hero__subtitle">
                <?php echo esc_html(get_theme_mod('hero_subtitle', 'Descubre nuestra selección de hierbas medicinales, productos de vermicompostaje y soluciones ecológicas para empresas conscientes y familias que cuidan su salud.')); ?>
            </p>

            <div class="hero__actions">
                <a href="#b2b-quote" class="u-btn u-btn--primary" onclick="openB2BModal()">
                    Cotización Corporativa
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="u-btn u-btn--secondary">
                        Ver Productos
                    </a>
                <?php endif; ?>
            </div>

            <div class="hero__stats">
                <div class="hero__stat">
                    <div class="hero__stat-number">100+</div>
                    <div class="hero__stat-label">Empresas confían</div>
                </div>
                <div class="hero__stat">
                    <div class="hero__stat-number">100%</div>
                    <div class="hero__stat-label">Orgánico</div>
                </div>
                <div class="hero__stat">
                    <div class="hero__stat-number">Local</div>
                    <div class="hero__stat-label">VI Región</div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white/60 rounded-full mt-2"></div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="section section--muted">
    <div class="u-container">
        <div class="section__header">
            <div class="section__badge u-badge">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Envíos a todo Chile
            </div>
            <h2 class="section__title">¿Por qué elegir EcoHierbas Chile?</h2>
            <p class="section__subtitle">
                Más que productos naturales, somos una empresa comprometida con tu bienestar 
                y el cuidado del planeta. Conoce los valores que nos impulsan.
            </p>
        </div>

        <div class="u-grid u-grid--cols-3 gap-8">
            <?php
            $benefits = array(
                array(
                    'title' => 'Salud y Bienestar',
                    'description' => 'Productos naturales que cuidan tu salud con ingredientes 100% orgánicos',
                    'icon' => 'heart'
                ),
                array(
                    'title' => 'Sostenibilidad',
                    'description' => 'Comprometidos con el medio ambiente y prácticas sustentables',
                    'icon' => 'globe'
                ),
                array(
                    'title' => 'Economía Circular',
                    'description' => 'Transformamos residuos en recursos valiosos a través del compostaje',
                    'icon' => 'recycle'
                ),
                array(
                    'title' => 'Producción Local',
                    'description' => 'Cultivado y producido en Chile, apoyando la economía local',
                    'icon' => 'truck'
                ),
                array(
                    'title' => 'Educación Ambiental',
                    'description' => 'Talleres y capacitaciones para promover hábitos sustentables',
                    'icon' => 'academic'
                ),
                array(
                    'title' => 'Calidad Certificada',
                    'description' => 'Productos con estándares de calidad y certificaciones orgánicas',
                    'icon' => 'shield'
                )
            );

            foreach ($benefits as $benefit) :
            ?>
                <div class="u-card group">
                    <div class="u-card__content text-center">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4 mx-auto group-hover:bg-primary/20 transition-colors">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2"><?php echo esc_html($benefit['title']); ?></h3>
                        <p class="text-muted-foreground text-sm"><?php echo esc_html($benefit['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Products -->
<?php if (class_exists('WooCommerce')) : ?>
<section class="section">
    <div class="u-container">
        <div class="section__header">
            <div class="section__badge u-badge">Productos Destacados</div>
            <h2 class="section__title">Nuestros productos más valorados</h2>
            <p class="section__subtitle">
                Descubre los productos que más eligen nuestros clientes para cuidar su salud 
                y contribuir al medio ambiente.
            </p>
        </div>

        <div class="product-grid">
            <?php
            $featured_products = wc_get_featured_product_ids();
            if (!empty($featured_products)) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'post__in' => $featured_products,
                );
                $query = new WP_Query($args);
                
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        wc_get_template_part('content', 'product');
                    }
                }
                wp_reset_postdata();
            }
            ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="u-btn u-btn--outline">
                Ver Todos los Productos
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Testimonials -->
<section class="section section--muted">
    <div class="u-container">
        <div class="section__header">
            <div class="section__badge u-badge">Testimonios Reales</div>
            <h2 class="section__title">Lo que dicen nuestros clientes</h2>
            <p class="section__subtitle">
                Más de 500 empresas y miles de familias confían en la calidad 
                de nuestros productos orgánicos.
            </p>
        </div>

        <div class="u-grid u-grid--cols-3 gap-8">
            <?php
            $testimonials = ecohierbas_get_testimonials(3);
            if (!empty($testimonials)) {
                foreach ($testimonials as $testimonial) {
                    $company = get_post_meta($testimonial->ID, '_testimonial_company', true);
                    $role = get_post_meta($testimonial->ID, '_testimonial_role', true);
                    $rating = get_post_meta($testimonial->ID, '_testimonial_rating', true);
                    $product = get_post_meta($testimonial->ID, '_testimonial_product', true);
                    ?>
                    <div class="u-card">
                        <div class="u-card__content">
                            <div class="flex items-center gap-1 mb-4">
                                <?php echo ecohierbas_get_star_rating($rating); ?>
                            </div>
                            <blockquote class="mb-6">
                                "<?php echo esc_html($testimonial->post_content); ?>"
                            </blockquote>
                            <?php if ($product) : ?>
                                <div class="mb-4">
                                    <span class="u-badge u-badge--outline text-xs"><?php echo esc_html($product); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-primary font-semibold">
                                        <?php echo substr($testimonial->post_title, 0, 1); ?>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm"><?php echo esc_html($testimonial->post_title); ?></h4>
                                    <p class="text-xs text-muted-foreground"><?php echo esc_html($role); ?></p>
                                    <p class="text-xs text-muted-foreground font-medium"><?php echo esc_html($company); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>