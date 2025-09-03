<?php
/**
 * Página Nosotros
 */
get_header(); ?>

<main class="site-main">
    <section class="relative py-24 md:py-32 bg-gradient-to-br from-primary/10 to-secondary/10">
        <div class="u-container text-center">
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-foreground mb-6">Nuestra Historia</h1>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">Descubre cómo EcoHierbas Chile nació de la pasión por la agricultura sostenible.</p>
        </div>
    </section>

    <section class="py-16 md:py-24">
        <div class="u-container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-foreground">Cultivando Futuro</h2>
                    <div class="prose prose-lg max-w-none">
                        <p class="text-muted-foreground">EcoHierbas Chile nació en 2018 de la visión de crear productos orgánicos de la más alta calidad.</p>
                        <p class="text-muted-foreground">Desde nuestros inicios en las fértiles tierras del Valle Central, hemos desarrollado una línea completa de productos.</p>
                    </div>
                </div>
                <div class="relative">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero-ecohierbas.jpg" alt="Equipo EcoHierbas Chile" class="w-full h-auto rounded-2xl shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-muted/50">
        <div class="u-container">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-6">Nuestros Valores</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-background p-8 rounded-xl shadow-sm border border-border">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Sostenibilidad</h3>
                    <p class="text-muted-foreground">Cada producto es cultivado respetando los ciclos naturales.</p>
                </div>
                <div class="bg-background p-8 rounded-xl shadow-sm border border-border">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Calidad Premium</h3>
                    <p class="text-muted-foreground">Controles rigurosos en cada etapa del proceso.</p>
                </div>
                <div class="bg-background p-8 rounded-xl shadow-sm border border-border">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Innovación</h3>
                    <p class="text-muted-foreground">Investigamos continuamente nuevas técnicas de cultivo.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>