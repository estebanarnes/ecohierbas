<?php
/**
 * Template Part: Reviews Section
 * Replica exactamente el componente ReviewsSection.tsx
 */
?>

<section class="py-16 md:py-24 bg-background">
    <div class="u-container">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('Lo que dicen nuestros clientes', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                <?php esc_html_e('Miles de familias chilenas ya han transformado su vida con nuestros productos naturales.', 'ecohierbas'); ?>
            </p>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Review 1 -->
            <div class="u-card bg-background/50 backdrop-blur-sm border-border/50 hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-muted-foreground"><?php esc_html_e('5.0', 'ecohierbas'); ?></span>
                    </div>

                    <!-- Review Text -->
                    <blockquote class="text-muted-foreground mb-6 italic">
                        "<?php esc_html_e('Los productos de EcoHierbas han sido un cambio total en mi vida. La calidad es excepcional y realmente se nota la diferencia. Llevo 2 años comprando y nunca me han fallado.', 'ecohierbas'); ?>"
                    </blockquote>

                    <!-- Reviewer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                            <span class="text-primary font-semibold">MG</span>
                        </div>
                        <div>
                            <div class="font-semibold text-foreground"><?php esc_html_e('María González', 'ecohierbas'); ?></div>
                            <div class="text-sm text-muted-foreground"><?php esc_html_e('Santiago, Chile', 'ecohierbas'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="u-card bg-background/50 backdrop-blur-sm border-border/50 hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-muted-foreground"><?php esc_html_e('5.0', 'ecohierbas'); ?></span>
                    </div>

                    <!-- Review Text -->
                    <blockquote class="text-muted-foreground mb-6 italic">
                        "<?php esc_html_e('Increíble experiencia con el vermicompostaje. El kit familiar es perfecto y el soporte técnico excepcional. Mis plantas nunca se habían visto tan saludables.', 'ecohierbas'); ?>"
                    </blockquote>

                    <!-- Reviewer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mr-4">
                            <span class="text-accent font-semibold">CR</span>
                        </div>
                        <div>
                            <div class="font-semibold text-foreground"><?php esc_html_e('Carlos Rodríguez', 'ecohierbas'); ?></div>
                            <div class="text-sm text-muted-foreground"><?php esc_html_e('Valparaíso, Chile', 'ecohierbas'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="u-card bg-background/50 backdrop-blur-sm border-border/50 hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-muted-foreground"><?php esc_html_e('5.0', 'ecohierbas'); ?></span>
                    </div>

                    <!-- Review Text -->
                    <blockquote class="text-muted-foreground mb-6 italic">
                        "<?php esc_html_e('Las infusiones son deliciosas y realmente efectivas. El Box Especial Mujer me ha ayudado muchísimo. La atención al cliente es de primera clase.', 'ecohierbas'); ?>"
                    </blockquote>

                    <!-- Reviewer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mr-4">
                            <span class="text-secondary font-semibold">AP</span>
                        </div>
                        <div>
                            <div class="font-semibold text-foreground"><?php esc_html_e('Ana Pérez', 'ecohierbas'); ?></div>
                            <div class="text-sm text-muted-foreground"><?php esc_html_e('Concepción, Chile', 'ecohierbas'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 4 -->
            <div class="u-card bg-background/50 backdrop-blur-sm border-border/50 hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-muted-foreground"><?php esc_html_e('5.0', 'ecohierbas'); ?></span>
                    </div>

                    <!-- Review Text -->
                    <blockquote class="text-muted-foreground mb-6 italic">
                        "<?php esc_html_e('Servicio de primera. Los maceteros son hermosos y de excelente calidad. Mi huerto urbano está prosperando gracias a EcoHierbas.', 'ecohierbas'); ?>"
                    </blockquote>

                    <!-- Reviewer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                            <span class="text-primary font-semibold">JL</span>
                        </div>
                        <div>
                            <div class="font-semibold text-foreground"><?php esc_html_e('Juan López', 'ecohierbas'); ?></div>
                            <div class="text-sm text-muted-foreground"><?php esc_html_e('La Serena, Chile', 'ecohierbas'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 5 -->
            <div class="u-card bg-background/50 backdrop-blur-sm border-border/50 hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-muted-foreground"><?php esc_html_e('5.0', 'ecohierbas'); ?></span>
                    </div>

                    <!-- Review Text -->
                    <blockquote class="text-muted-foreground mb-6 italic">
                        "<?php esc_html_e('Excelente relación precio-calidad. Los productos llegan súper rápido y bien empacados. Definitivamente mi tienda online favorita para productos naturales.', 'ecohierbas'); ?>"
                    </blockquote>

                    <!-- Reviewer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mr-4">
                            <span class="text-accent font-semibold">LS</span>
                        </div>
                        <div>
                            <div class="font-semibold text-foreground"><?php esc_html_e('Laura Silva', 'ecohierbas'); ?></div>
                            <div class="text-sm text-muted-foreground"><?php esc_html_e('Antofagasta, Chile', 'ecohierbas'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 6 -->
            <div class="u-card bg-background/50 backdrop-blur-sm border-border/50 hover:shadow-lg transition-all duration-300">
                <div class="u-card-content">
                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-muted-foreground"><?php esc_html_e('5.0', 'ecohierbas'); ?></span>
                    </div>

                    <!-- Review Text -->
                    <blockquote class="text-muted-foreground mb-6 italic">
                        "<?php esc_html_e('La asesoría personalizada fue clave para elegir los productos correctos. El equipo conoce mucho del tema y realmente se preocupan por ayudar.', 'ecohierbas'); ?>"
                    </blockquote>

                    <!-- Reviewer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mr-4">
                            <span class="text-secondary font-semibold">PM</span>
                        </div>
                        <div>
                            <div class="font-semibold text-foreground"><?php esc_html_e('Pedro Martín', 'ecohierbas'); ?></div>
                            <div class="text-sm text-muted-foreground"><?php esc_html_e('Temuco, Chile', 'ecohierbas'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Rating -->
        <div class="text-center">
            <div class="bg-primary/5 rounded-2xl p-8 max-w-2xl mx-auto">
                <div class="flex justify-center items-center mb-4">
                    <span class="text-6xl font-bold text-primary mr-4">4.9</span>
                    <div>
                        <div class="flex items-center mb-2">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <p class="text-sm text-muted-foreground"><?php esc_html_e('Basado en 2,847 reseñas', 'ecohierbas'); ?></p>
                    </div>
                </div>
                <p class="text-lg text-foreground font-medium"><?php esc_html_e('¡Únete a miles de clientes satisfechos!', 'ecohierbas'); ?></p>
            </div>
        </div>
    </div>
</section>