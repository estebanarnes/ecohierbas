<?php
/**
 * Template: 404 Error Page
 * @package EcoHierbas_Chile
 */
get_header(); ?>

<main class="main-content">
    <section style="padding: 6rem 0; text-align: center;">
        <div class="u-container">
            <div style="max-width: 600px; margin: 0 auto;">
                <div style="font-size: 8rem; font-weight: 700; color: hsl(var(--primary)); margin-bottom: 1rem;">404</div>
                <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Página No Encontrada</h1>
                <p style="font-size: 1.125rem; color: hsl(var(--muted-foreground)); margin-bottom: 2rem;">
                    Lo sentimos, la página que buscas no existe o ha sido movida.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo home_url(); ?>" class="btn btn-primary">Volver al Inicio</a>
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-secondary">Ver Productos</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>