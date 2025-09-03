<?php
/**
 * Template Part: Stats Section
 * Sección de estadísticas e impacto
 */
?>

<section class="py-16 md:py-24 bg-muted/20">
    <div class="u-container">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('Impacto EcoHierbas', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                <?php esc_html_e('Nuestros números reflejan el compromiso con la sustentabilidad y el bienestar de nuestros clientes.', 'ecohierbas'); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Stat 1: Productos -->
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-primary mb-2">500+</div>
                <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Productos Entregados', 'ecohierbas'); ?></h3>
                <p class="text-muted-foreground"><?php esc_html_e('Mensualmente a todo Chile', 'ecohierbas'); ?></p>
            </div>

            <!-- Stat 2: Clientes -->
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-accent mb-2">2000+</div>
                <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Clientes Satisfechos', 'ecohierbas'); ?></h3>
                <p class="text-muted-foreground"><?php esc_html_e('Confiando en nuestros productos', 'ecohierbas'); ?></p>
            </div>

            <!-- Stat 3: Experiencia -->
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-secondary mb-2">10+</div>
                <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Años de Experiencia', 'ecohierbas'); ?></h3>
                <p class="text-muted-foreground"><?php esc_html_e('En productos naturales', 'ecohierbas'); ?></p>
            </div>

            <!-- Stat 4: Cobertura -->
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-primary mb-2">16</div>
                <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Regiones de Chile', 'ecohierbas'); ?></h3>
                <p class="text-muted-foreground"><?php esc_html_e('Cobertura nacional completa', 'ecohierbas'); ?></p>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="mt-16 pt-16 border-t border-border">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('98% Satisfacción', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground"><?php esc_html_e('Calificación promedio de nuestros clientes', 'ecohierbas'); ?></p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Entrega Rápida', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground"><?php esc_html_e('Promedio de 3 días hábiles', 'ecohierbas'); ?></p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2"><?php esc_html_e('Eco-Impacto', 'ecohierbas'); ?></h3>
                    <p class="text-muted-foreground"><?php esc_html_e('5 toneladas de CO₂ reducidas anualmente', 'ecohierbas'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>