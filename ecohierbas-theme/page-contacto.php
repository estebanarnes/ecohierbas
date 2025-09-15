<?php
/**
 * Template: Página Contacto
 * @package EcoHierbas_Chile
 */
get_header(); ?>

<main class="main-content">
    <div class="u-container" style="padding: 1rem 0;">
        <?php ecohierbas_breadcrumbs(); ?>
    </div>

    <section style="padding: 4rem 0;">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h1 style="font-size: 3rem; margin-bottom: 1rem;">Contáctanos</h1>
                <p style="font-size: 1.25rem; color: hsl(var(--muted-foreground));">
                    Estamos aquí para ayudarte con cualquier consulta sobre nuestros productos
                </p>
            </div>
            
            <div class="u-grid u-grid--cols-2" style="gap: 4rem; align-items: start;">
                <!-- Información de Contacto -->
                <div>
                    <h2 style="font-size: 1.5rem; margin-bottom: 2rem;">Información de Contacto</h2>
                    
                    <div style="space-y: 2rem;">
                        <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                            <svg width="24" height="24" fill="none" stroke="hsl(var(--primary))" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <div>
                                <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Dirección</h3>
                                <p style="color: hsl(var(--muted-foreground));">
                                    Camino El tambo, San Vicente Tagua Tagua<br>
                                    VI Región, Chile
                                </p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                            <svg width="24" height="24" fill="none" stroke="hsl(var(--primary))" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                            </svg>
                            <div>
                                <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Teléfono</h3>
                                <p style="color: hsl(var(--muted-foreground));">+56 9 1234 5678</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem;">
                            <svg width="24" height="24" fill="none" stroke="hsl(var(--primary))" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <div>
                                <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Email</h3>
                                <p style="color: hsl(var(--muted-foreground));">contacto@ecohierbaschile.cl</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Formulario WPForms -->
                <div style="background: hsl(var(--card)); padding: 2rem; border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem;">Envíanos un Mensaje</h2>
                    <?php echo do_shortcode('[wpforms id="1" title="false" description="false"]'); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>