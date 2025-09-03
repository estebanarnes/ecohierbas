<?php
/**
 * Template Part: Benefits Section
 * Replica exactamente el componente BenefitsSection.tsx
 */
?>

<section class="py-16 md:py-24 bg-gradient-to-b from-background to-muted/20">
    <div class="u-container">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('¿Por qué elegir EcoHierbas?', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                <?php esc_html_e('Más de 10 años especializándonos en productos naturales y sustentables para tu bienestar y el del planeta.', 'ecohierbas'); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Beneficio 1: Productos Orgánicos -->
            <div class="u-card text-center group hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary/20 transition-colors">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold mb-4"><?php esc_html_e('100% Orgánico', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground">
                        <?php esc_html_e('Todos nuestros productos están certificados como orgánicos, libres de pesticidas y químicos dañinos.', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>

            <!-- Beneficio 2: Sustentabilidad -->
            <div class="u-card text-center group hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-accent/20 transition-colors">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold mb-4"><?php esc_html_e('Compromiso Ambiental', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground">
                        <?php esc_html_e('Promovemos prácticas sustentables y el cuidado del medio ambiente en cada paso de nuestro proceso.', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>

            <!-- Beneficio 3: Calidad -->
            <div class="u-card text-center group hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-secondary/20 transition-colors">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold mb-4"><?php esc_html_e('Calidad Premium', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground">
                        <?php esc_html_e('Selección rigurosa de materias primas y procesos de calidad que garantizan la excelencia en cada producto.', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>

            <!-- Beneficio 4: Experiencia -->
            <div class="u-card text-center group hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary/20 transition-colors">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold mb-4"><?php esc_html_e('Más de 10 Años', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground">
                        <?php esc_html_e('Una década de experiencia en el rubro nos respalda como líderes en productos naturales en Chile.', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>

            <!-- Beneficio 5: Entrega Nacional -->
            <div class="u-card text-center group hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-accent/20 transition-colors">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold mb-4"><?php esc_html_e('Envío Nacional', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground">
                        <?php esc_html_e('Llevamos nuestros productos a todo Chile con envíos rápidos y seguros a tu puerta.', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>

            <!-- Beneficio 6: Asesoría Personalizada -->
            <div class="u-card text-center group hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-secondary/20 transition-colors">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-semibold mb-4"><?php esc_html_e('Asesoría Experta', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground">
                        <?php esc_html_e('Nuestro equipo especializado te acompaña para encontrar los productos ideales para tus necesidades.', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16">
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
               class="u-btn u-btn--primary text-lg px-8 py-4">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <?php esc_html_e('Descubre Nuestros Productos', 'ecohierbas'); ?>
            </a>
        </div>
    </div>
</section>