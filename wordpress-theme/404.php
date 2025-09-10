<?php
/**
 * Página de Error 404
 */
get_header(); ?>

<main class="main-content">
    <section class="section" style="min-height: 60vh; display: flex; align-items: center;">
        <div class="u-container u-text-center">
            <!-- Ilustración de error -->
            <div style="margin-bottom: 3rem;">
                <svg width="200" height="200" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-text-lighter);">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            
            <h1 style="font-size: 4rem; margin-bottom: 1rem; color: var(--eco-primary);">404</h1>
            <h2 style="font-size: 2rem; margin-bottom: 1rem; color: var(--eco-text);">Página no encontrada</h2>
            <p style="font-size: 1.25rem; color: var(--eco-text-light); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                Lo sentimos, la página que buscas no existe o ha sido movida. 
                Pero no te preocupes, tenemos muchas otras cosas que mostrarte.
            </p>
            
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="u-btn u-btn--primary">
                    Volver al Inicio
                </a>
                <a href="<?php echo esc_url(home_url('/productos')); ?>" class="u-btn u-btn--secondary">
                    Ver Productos
                </a>
                <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="u-btn u-btn--secondary">
                    Contactar
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>