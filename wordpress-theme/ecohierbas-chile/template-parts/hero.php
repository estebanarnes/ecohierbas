<?php
/**
 * Template Part: Hero Section
 * Replica exactamente el componente Hero.tsx del React
 */

$hero_image = get_post_meta(get_the_ID(), '_ecohierbas_hero_image', true);
$hero_title = get_post_meta(get_the_ID(), '_ecohierbas_hero_title', true);
$hero_subtitle = get_post_meta(get_the_ID(), '_ecohierbas_hero_subtitle', true);

// Fallbacks para front-page
if (!$hero_image) {
    $hero_image = ECOHIERBAS_THEME_URL . '/assets/img/hero-ecohierbas.jpg';
}
if (!$hero_title) {
    $hero_title = __('Productos Orgánicos & Sustentables', 'ecohierbas');
}
if (!$hero_subtitle) {
    $hero_subtitle = __('Descubre nuestra selección de hierbas medicinales, sistemas de vermicompostaje y productos ecológicos para un estilo de vida más natural y sustentable.', 'ecohierbas');
}
?>

<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-b from-primary/5 via-background to-background">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url($hero_image); ?>" 
             alt="<?php echo esc_attr($hero_title); ?>"
             class="w-full h-full object-cover"
             loading="eager">
        <div class="absolute inset-0 bg-background/40"></div>
    </div>

    <!-- Floating Logo -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-10 pointer-events-none z-10">
        <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
             alt="EcoHierbas Chile Logo" 
             class="w-96 h-96 object-contain u-animate-float">
    </div>

    <!-- Content -->
    <div class="relative z-20 u-container">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-foreground mb-6 leading-tight">
                <?php echo esc_html($hero_title); ?>
            </h1>
            <p class="text-xl md:text-2xl text-muted-foreground mb-8 leading-relaxed max-w-3xl mx-auto">
                <?php echo esc_html($hero_subtitle); ?>
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" 
                   class="u-btn u-btn--primary text-lg px-8 py-4">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <?php esc_html_e('Explorar Productos', 'ecohierbas'); ?>
                </a>
                <button class="u-btn u-btn--outline text-lg px-8 py-4" id="hero-b2b-quote">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <?php esc_html_e('Cotización B2B', 'ecohierbas'); ?>
                </button>
            </div>

            <!-- Features -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 text-sm text-muted-foreground">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span><?php esc_html_e('100% Orgánico', 'ecohierbas'); ?></span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span><?php esc_html_e('Envío Nacional', 'ecohierbas'); ?></span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span><?php esc_html_e('Sustentable', 'ecohierbas'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
        <div class="animate-bounce">
            <svg class="w-6 h-6 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>