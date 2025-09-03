<?php
/**
 * Template Part: Workshops Section
 * Replica exactamente el componente WorkshopsSection.tsx
 */
?>

<section class="py-16 md:py-24 bg-gradient-to-br from-primary/5 via-background to-accent/5">
    <div class="u-container">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('Talleres y Capacitaciones', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                <?php esc_html_e('Aprende con nosotros sobre vermicompostaje, cultivo orgánico y vida sustentable. Talleres presenciales y online para toda la familia.', 'ecohierbas'); ?>
            </p>
        </div>

        <!-- Workshops Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Workshop 1: Vermicompostaje -->
            <div class="u-card group relative overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-primary/60"></div>
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="u-card-content relative z-10 text-white">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                            <?php esc_html_e('Presencial + Online', 'ecohierbas'); ?>
                        </span>
                    </div>

                    <h3 class="text-2xl font-serif font-bold mb-4">
                        <?php esc_html_e('Taller de Vermicompostaje', 'ecohierbas'); ?>
                    </h3>
                    
                    <p class="text-white/90 mb-6">
                        <?php esc_html_e('Aprende a transformar tus residuos orgánicos en el mejor abono natural para tus plantas. Incluye kit básico para comenzar.', 'ecohierbas'); ?>
                    </p>

                    <!-- Workshop Details -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span><?php esc_html_e('Duración: 3 horas', 'ecohierbas'); ?></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span><?php esc_html_e('Máximo 15 personas', 'ecohierbas'); ?></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <span><?php esc_html_e('$25.000 CLP (incluye kit)', 'ecohierbas'); ?></span>
                        </div>
                    </div>

                    <button class="u-btn bg-white text-primary hover:bg-white/90 transition-colors w-full">
                        <?php esc_html_e('Inscribirse Ahora', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>

            <!-- Workshop 2: Huerto Urbano -->
            <div class="u-card group relative overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-accent/80 to-accent/60"></div>
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="u-card-content relative z-10 text-white">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                            <?php esc_html_e('Presencial', 'ecohierbas'); ?>
                        </span>
                    </div>

                    <h3 class="text-2xl font-serif font-bold mb-4">
                        <?php esc_html_e('Huerto Urbano Familiar', 'ecohierbas'); ?>
                    </h3>
                    
                    <p class="text-white/90 mb-6">
                        <?php esc_html_e('Crea tu propio huerto en casa, sin importar el espacio. Aprende técnicas de cultivo vertical, hidroponía básica y cuidado de plantas.', 'ecohierbas'); ?>
                    </p>

                    <!-- Workshop Details -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span><?php esc_html_e('Duración: 4 horas', 'ecohierbas'); ?></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span><?php esc_html_e('Máximo 12 personas', 'ecohierbas'); ?></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <span><?php esc_html_e('$35.000 CLP (incluye materiales)', 'ecohierbas'); ?></span>
                        </div>
                    </div>

                    <button class="u-btn bg-white text-accent hover:bg-white/90 transition-colors w-full">
                        <?php esc_html_e('Inscribirse Ahora', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Additional Workshops -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Mini Workshop 1 -->
            <div class="u-card text-center hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold mb-2"><?php esc_html_e('Hierbas Medicinales', 'ecohierbas'); ?></h4>
                    <p class="text-sm text-muted-foreground mb-3"><?php esc_html_e('Preparación y uso de infusiones naturales', 'ecohierbas'); ?></p>
                    <div class="text-xs text-muted-foreground mb-3"><?php esc_html_e('2 horas • Online • $15.000', 'ecohierbas'); ?></div>
                    <button class="u-btn u-btn--outline text-sm">
                        <?php esc_html_e('Más info', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>

            <!-- Mini Workshop 2 -->
            <div class="u-card text-center hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold mb-2"><?php esc_html_e('Compostaje Casero', 'ecohierbas'); ?></h4>
                    <p class="text-sm text-muted-foreground mb-3"><?php esc_html_e('Técnicas básicas para el hogar', 'ecohierbas'); ?></p>
                    <div class="text-xs text-muted-foreground mb-3"><?php esc_html_e('1.5 horas • Online • $12.000', 'ecohierbas'); ?></div>
                    <button class="u-btn u-btn--outline text-sm">
                        <?php esc_html_e('Más info', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>

            <!-- Mini Workshop 3 -->
            <div class="u-card text-center hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold mb-2"><?php esc_html_e('Vida Sustentable', 'ecohierbas'); ?></h4>
                    <p class="text-sm text-muted-foreground mb-3"><?php esc_html_e('Hábitos eco-friendly para toda la familia', 'ecohierbas'); ?></p>
                    <div class="text-xs text-muted-foreground mb-3"><?php esc_html_e('2 horas • Presencial • $18.000', 'ecohierbas'); ?></div>
                    <button class="u-btn u-btn--outline text-sm">
                        <?php esc_html_e('Más info', 'ecohierbas'); ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <div class="bg-background rounded-2xl p-8 max-w-3xl mx-auto shadow-lg border border-border/50">
                <h3 class="text-2xl font-serif font-bold mb-4">
                    <?php esc_html_e('¿Quieres un taller personalizado?', 'ecohierbas'); ?>
                </h3>
                <p class="text-muted-foreground mb-6">
                    <?php esc_html_e('Organizamos talleres privados para empresas, colegios y grupos. Contáctanos para crear una experiencia a medida.', 'ecohierbas'); ?>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="u-btn u-btn--primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <?php esc_html_e('Solicitar Cotización', 'ecohierbas'); ?>
                    </button>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--outline">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                        </svg>
                        <?php esc_html_e('Más Información', 'ecohierbas'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>