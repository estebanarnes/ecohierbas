<?php
/**
 * Template Part: Workshops Section
 */
?>

<section class="py-16 md:py-24 bg-muted/20" data-banner="talleres">
    <div class="u-container">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('Talleres y Capacitaciones', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                <?php esc_html_e('Aprende junto a nuestros expertos sobre vermicompostaje, cultivo sustentable y vida eco-amigable.', 'ecohierbas'); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Workshops Content -->
            <div>
                <div class="space-y-8">
                    <!-- Workshop 1: Vermicompostaje -->
                    <div class="u-card group hover:shadow-lg transition-all duration-300">
                        <div class="u-card-content">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary/20 transition-colors">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-serif font-semibold mb-2">
                                        <?php esc_html_e('Taller de Vermicompostaje', 'ecohierbas'); ?>
                                    </h3>
                                    <p class="text-muted-foreground mb-3">
                                        <?php esc_html_e('Aprende a crear tu propio sistema de compost con lombrices californianas. Perfecto para hogares y empresas.', 'ecohierbas'); ?>
                                    </p>
                                    <div class="flex items-center text-sm text-primary">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <?php esc_html_e('Duración: 2 horas', 'ecohierbas'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Workshop 2: Cultivo Urbano -->
                    <div class="u-card group hover:shadow-lg transition-all duration-300">
                        <div class="u-card-content">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-accent/20 transition-colors">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-serif font-semibold mb-2">
                                        <?php esc_html_e('Huertos Urbanos Sustentables', 'ecohierbas'); ?>
                                    </h3>
                                    <p class="text-muted-foreground mb-3">
                                        <?php esc_html_e('Crea tu propio huerto en espacios reducidos. Técnicas, herramientas y plantas ideales para principiantes.', 'ecohierbas'); ?>
                                    </p>
                                    <div class="flex items-center text-sm text-accent">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <?php esc_html_e('Duración: 3 horas', 'ecohierbas'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Workshop 3: Plantas Medicinales -->
                    <div class="u-card group hover:shadow-lg transition-all duration-300">
                        <div class="u-card-content">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-secondary/20 transition-colors">
                                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-serif font-semibold mb-2">
                                        <?php esc_html_e('Hierbas Medicinales Caseras', 'ecohierbas'); ?>
                                    </h3>
                                    <p class="text-muted-foreground mb-3">
                                        <?php esc_html_e('Descubre las propiedades curativas de las plantas y aprende a preparar tus propias infusiones terapéuticas.', 'ecohierbas'); ?>
                                    </p>
                                    <div class="flex items-center text-sm text-secondary">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <?php esc_html_e('Duración: 2.5 horas', 'ecohierbas'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" 
                       class="u-btn u-btn--primary flex-1 text-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <?php esc_html_e('Consultar Fechas', 'ecohierbas'); ?>
                    </a>
                    <button class="u-btn u-btn--outline flex-1" id="workshops-b2b-quote">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <?php esc_html_e('Talleres Corporativos', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>

            <!-- Workshops Image/Benefits -->
            <div>
                <div class="u-card">
                    <div class="u-card-content">
                        <div class="aspect-video overflow-hidden rounded-lg mb-6">
                            <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/vermicompostaje.jpg'); ?>" 
                                 alt="<?php esc_attr_e('Taller de vermicompostaje EcoHierbas', 'ecohierbas'); ?>"
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <h3 class="text-xl font-serif font-semibold mb-4">
                            <?php esc_html_e('Beneficios de nuestros talleres', 'ecohierbas'); ?>
                        </h3>
                        
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-muted-foreground"><?php esc_html_e('Instructores certificados con amplia experiencia', 'ecohierbas'); ?></span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-muted-foreground"><?php esc_html_e('Materiales incluidos y kit de inicio', 'ecohierbas'); ?></span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-muted-foreground"><?php esc_html_e('Seguimiento post-taller y comunidad online', 'ecohierbas'); ?></span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-primary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-muted-foreground"><?php esc_html_e('Certificado de participación digital', 'ecohierbas'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>