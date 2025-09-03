<?php
/**
 * Template Part: Reviews Section
 */
?>

<section class="py-16 md:py-24 bg-gradient-to-b from-background to-muted/20">
    <div class="u-container">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('Lo que dicen nuestros clientes', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                <?php esc_html_e('Miles de personas ya han transformado su bienestar con nuestros productos naturales y sustentables.', 'ecohierbas'); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Review 1 -->
            <div class="u-card" data-section="reviews">
                <div class="u-card-content">
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-accent fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    
                    <blockquote class="text-foreground mb-6 leading-relaxed">
                        "<?php esc_html_e('Los productos de EcoHierbas han sido un cambio total en mi vida. La calidad es excepcional y realmente se nota la diferencia en mi bienestar diario.', 'ecohierbas'); ?>"
                    </blockquote>
                    
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center mr-4">
                            <span class="text-primary font-semibold">MC</span>
                        </div>
                        <div>
                            <h4 class="font-semibold"><?php esc_html_e('María Carvalho', 'ecohierbas'); ?></h4>
                            <p class="text-sm text-muted-foreground"><?php esc_html_e('Santiago, Chile', 'ecohierbas'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="u-card" data-section="reviews">
                <div class="u-card-content">
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-accent fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    
                    <blockquote class="text-foreground mb-6 leading-relaxed">
                        "<?php esc_html_e('Excelente servicio y productos de primera calidad. El vermicompostaje ha revolucionado mi jardín y la atención al cliente es insuperable.', 'ecohierbas'); ?>"
                    </blockquote>
                    
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center mr-4">
                            <span class="text-accent font-semibold">CR</span>
                        </div>
                        <div>
                            <h4 class="font-semibold"><?php esc_html_e('Carlos Ramírez', 'ecohierbas'); ?></h4>
                            <p class="text-sm text-muted-foreground"><?php esc_html_e('Valparaíso, Chile', 'ecohierbas'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="u-card" data-section="reviews">
                <div class="u-card-content">
                    <div class="flex items-center mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 text-accent fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    
                    <blockquote class="text-foreground mb-6 leading-relaxed">
                        "<?php esc_html_e('Me encanta la filosofía sustentable de EcoHierbas. Sus productos no solo son efectivos sino que también cuidan el planeta. Altamente recomendados.', 'ecohierbas'); ?>"
                    </blockquote>
                    
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mr-4">
                            <span class="text-secondary font-semibold">AG</span>
                        </div>
                        <div>
                            <h4 class="font-semibold"><?php esc_html_e('Ana González', 'ecohierbas'); ?></h4>
                            <p class="text-sm text-muted-foreground"><?php esc_html_e('Concepción, Chile', 'ecohierbas'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16">
            <div class="u-card max-w-2xl mx-auto">
                <div class="u-card-content text-center">
                    <h3 class="text-2xl font-serif font-bold mb-4">
                        <?php esc_html_e('¿Listo para unirte a nuestra comunidad?', 'ecohierbas'); ?>
                    </h3>
                    <p class="text-muted-foreground mb-6">
                        <?php esc_html_e('Únete a miles de personas que ya viven de manera más sustentable y saludable.', 'ecohierbas'); ?>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
                           class="u-btn u-btn--primary">
                            <?php esc_html_e('Explorar Productos', 'ecohierbas'); ?>
                        </a>
                        <button class="u-btn u-btn--outline" id="reviews-b2b-quote">
                            <?php esc_html_e('Cotización B2B', 'ecohierbas'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>