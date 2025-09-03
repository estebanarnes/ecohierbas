<?php
/**
 * Página Nosotros
 * Replica el diseño de la página About del React
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <!-- Hero Section -->
    <section class="h-[400px] bg-gradient-to-b from-primary/5 to-background relative overflow-hidden flex items-center">
        <div class="absolute inset-0 flex items-center justify-center opacity-30 pointer-events-none z-0">
            <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                 alt="EcoHierbas Chile Logo" 
                 class="w-96 h-96 object-contain u-animate-float">
        </div>
        
        <div class="u-container relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-foreground mb-6">
                    <?php
                    $hero_title = get_post_meta(get_the_ID(), '_ecohierbas_hero_title', true);
                    echo $hero_title ? esc_html($hero_title) : esc_html__('Sobre Nosotros', 'ecohierbas');
                    ?>
                </h1>
                <p class="text-xl text-muted-foreground mb-8 leading-relaxed">
                    <?php
                    $hero_subtitle = get_post_meta(get_the_ID(), '_ecohierbas_hero_subtitle', true);
                    echo $hero_subtitle ? esc_html($hero_subtitle) : esc_html__('Conoce nuestra historia, misión y compromiso con la sustentabilidad', 'ecohierbas');
                    ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-8">
        <div class="u-container">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                
                <!-- Página Content -->
                <div class="max-w-4xl mx-auto">
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>

            <?php endwhile; endif; ?>

            <!-- Values Section -->
            <div class="mt-16 pt-16 border-t border-border">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                        <?php esc_html_e('Nuestros Valores', 'ecohierbas'); ?>
                    </h2>
                    <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                        <?php esc_html_e('Los principios que guían nuestro trabajo y compromiso con el medio ambiente', 'ecohierbas'); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Sustentabilidad -->
                    <div class="u-card">
                        <div class="u-card-content text-center">
                            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-serif font-semibold mb-3"><?php esc_html_e('Sustentabilidad', 'ecohierbas'); ?></h3>
                            <p class="text-muted-foreground">
                                <?php esc_html_e('Comprometidos con prácticas que respetan y protegen nuestro medio ambiente para las futuras generaciones.', 'ecohierbas'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Calidad -->
                    <div class="u-card">
                        <div class="u-card-content text-center">
                            <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-serif font-semibold mb-3"><?php esc_html_e('Calidad Premium', 'ecohierbas'); ?></h3>
                            <p class="text-muted-foreground">
                                <?php esc_html_e('Productos de la más alta calidad, cuidadosamente seleccionados y procesados para garantizar su pureza y efectividad.', 'ecohierbas'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Innovación -->
                    <div class="u-card">
                        <div class="u-card-content text-center">
                            <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-serif font-semibold mb-3"><?php esc_html_e('Innovación', 'ecohierbas'); ?></h3>
                            <p class="text-muted-foreground">
                                <?php esc_html_e('Constantemente buscamos nuevas formas de mejorar nuestros productos y procesos, siempre con un enfoque sustentable.', 'ecohierbas'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="mt-16 pt-16 border-t border-border">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                        <?php esc_html_e('Nuestro Equipo', 'ecohierbas'); ?>
                    </h2>
                    <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                        <?php esc_html_e('Conoce a las personas apasionadas que hacen posible nuestra misión', 'ecohierbas'); ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Team Member 1 -->
                    <div class="u-card">
                        <div class="u-card-content text-center">
                            <div class="w-24 h-24 bg-muted rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-muted-foreground" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-1"><?php esc_html_e('María González', 'ecohierbas'); ?></h3>
                            <p class="text-muted-foreground text-sm mb-3"><?php esc_html_e('Fundadora y CEO', 'ecohierbas'); ?></p>
                            <p class="text-sm text-muted-foreground">
                                <?php esc_html_e('Ingeniera agrónoma con más de 15 años de experiencia en agricultura sustentable.', 'ecohierbas'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Team Member 2 -->
                    <div class="u-card">
                        <div class="u-card-content text-center">
                            <div class="w-24 h-24 bg-muted rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-muted-foreground" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-1"><?php esc_html_e('Carlos Rojas', 'ecohierbas'); ?></h3>
                            <p class="text-muted-foreground text-sm mb-3"><?php esc_html_e('Director de Producción', 'ecohierbas'); ?></p>
                            <p class="text-sm text-muted-foreground">
                                <?php esc_html_e('Especialista en vermicompostaje y experto en procesos de producción orgánica.', 'ecohierbas'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Team Member 3 -->
                    <div class="u-card">
                        <div class="u-card-content text-center">
                            <div class="w-24 h-24 bg-muted rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-muted-foreground" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-1"><?php esc_html_e('Ana Silva', 'ecohierbas'); ?></h3>
                            <p class="text-muted-foreground text-sm mb-3"><?php esc_html_e('Jefa de Calidad', 'ecohierbas'); ?></p>
                            <p class="text-sm text-muted-foreground">
                                <?php esc_html_e('Química farmacéutica especializada en control de calidad de productos naturales.', 'ecohierbas'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-16 pt-16 border-t border-border">
                <div class="u-card bg-gradient-to-r from-primary/10 to-accent/10">
                    <div class="u-card-content text-center py-12">
                        <h2 class="text-3xl font-serif font-bold text-foreground mb-4">
                            <?php esc_html_e('¿Tienes preguntas?', 'ecohierbas'); ?>
                        </h2>
                        <p class="text-xl text-muted-foreground mb-8 max-w-2xl mx-auto">
                            <?php esc_html_e('Estamos aquí para ayudarte. Contáctanos y te responderemos a la brevedad.', 'ecohierbas'); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <?php esc_html_e('Contáctanos', 'ecohierbas'); ?>
                            </a>
                            <a href="<?php echo esc_url(home_url('/productos')); ?>" class="u-btn u-btn--outline">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <?php esc_html_e('Ver productos', 'ecohierbas'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>