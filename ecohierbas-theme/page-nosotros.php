<?php
/**
 * Page Template - Nosotros
 *
 * @package EcoHierbas
 */

get_header(); ?>

<main class="section">
    <div class="u-container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Hero Section -->
                <section class="py-20 text-center">
                    <div class="max-w-4xl mx-auto">
                        <div class="inline-flex items-center gap-3 bg-primary/10 text-primary px-6 py-3 rounded-full text-base font-medium mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.121M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Nuestra Historia
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6">
                            <?php the_title(); ?>
                        </h1>
                        
                        <p class="text-xl text-muted-foreground leading-relaxed">
                            Conoce la historia detrás de EcoHierbas Chile y nuestro compromiso con 
                            la salud natural y la sostenibilidad ambiental.
                        </p>
                    </div>
                </section>

                <!-- Mission & Vision -->
                <section class="py-16 bg-muted/30">
                    <div class="u-container">
                        <div class="u-grid u-grid--cols-2 gap-12 items-center">
                            <div>
                                <h2 class="text-3xl font-serif font-bold mb-6">Nuestra Misión</h2>
                                <p class="text-lg text-muted-foreground leading-relaxed mb-6">
                                    Promover el bienestar y la salud natural a través de productos orgánicos 
                                    de la más alta calidad, mientras contribuimos activamente a la 
                                    conservación del medio ambiente y el desarrollo sustentable de nuestras comunidades.
                                </p>
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center mt-1">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <p class="text-muted-foreground">Productos 100% orgánicos y naturales</p>
                                </div>
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center mt-1">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <p class="text-muted-foreground">Compromiso con la sostenibilidad</p>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center mt-1">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <p class="text-muted-foreground">Apoyo al desarrollo comunitario</p>
                                </div>
                            </div>
                            <div class="u-card">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-mission.jpg" 
                                     alt="Misión EcoHierbas" 
                                     class="w-full h-80 object-cover rounded-lg">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Story Section -->
                <section class="py-16">
                    <div class="u-container">
                        <div class="max-w-4xl mx-auto">
                            <div class="text-center mb-12">
                                <h2 class="text-3xl font-serif font-bold mb-4">Nuestra Historia</h2>
                                <p class="text-lg text-muted-foreground">
                                    Desde 2015, trabajando por un Chile más saludable y sustentable
                                </p>
                            </div>

                            <div class="space-y-12">
                                <div class="u-grid u-grid--cols-2 gap-8 items-center">
                                    <div>
                                        <div class="u-badge u-badge--outline mb-4">2015 - Los Inicios</div>
                                        <h3 class="text-xl font-semibold mb-4">Semillas de un Sueño</h3>
                                        <p class="text-muted-foreground leading-relaxed">
                                            Todo comenzó con una pequeña huerta familiar en la VI Región de Chile. 
                                            Motivados por la necesidad de acceder a productos naturales de calidad, 
                                            iniciamos el cultivo de hierbas medicinales orgánicas.
                                        </p>
                                    </div>
                                    <div>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/story-2015.jpg" 
                                             alt="Inicios EcoHierbas 2015" 
                                             class="w-full h-64 object-cover rounded-lg">
                                    </div>
                                </div>

                                <div class="u-grid u-grid--cols-2 gap-8 items-center">
                                    <div class="order-2 md:order-1">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/story-2018.jpg" 
                                             alt="Crecimiento EcoHierbas 2018" 
                                             class="w-full h-64 object-cover rounded-lg">
                                    </div>
                                    <div class="order-1 md:order-2">
                                        <div class="u-badge u-badge--outline mb-4">2018 - Crecimiento</div>
                                        <h3 class="text-xl font-semibold mb-4">Expandiendo Horizontes</h3>
                                        <p class="text-muted-foreground leading-relaxed">
                                            Incorporamos el vermicompostaje como parte integral de nuestro modelo 
                                            de negocio, cerrando el ciclo de la economía circular y ofreciendo 
                                            soluciones completas de sustentabilidad.
                                        </p>
                                    </div>
                                </div>

                                <div class="u-grid u-grid--cols-2 gap-8 items-center">
                                    <div>
                                        <div class="u-badge u-badge--outline mb-4">2020 - Innovación</div>
                                        <h3 class="text-xl font-semibold mb-4">Soluciones B2B</h3>
                                        <p class="text-muted-foreground leading-relaxed">
                                            Desarrollamos programas especializados para empresas, ayudando a 
                                            organizaciones a implementar prácticas sustentables y mejorar 
                                            el bienestar de sus colaboradores.
                                        </p>
                                    </div>
                                    <div>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/story-2020.jpg" 
                                             alt="Innovación EcoHierbas 2020" 
                                             class="w-full h-64 object-cover rounded-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Team Section -->
                <section class="py-16 bg-muted/30">
                    <div class="u-container">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-serif font-bold mb-4">Nuestro Equipo</h2>
                            <p class="text-lg text-muted-foreground">
                                Profesionales comprometidos con la salud natural y la sustentabilidad
                            </p>
                        </div>

                        <div class="u-grid u-grid--cols-3 gap-8">
                            <div class="u-card text-center">
                                <div class="u-card__content">
                                    <div class="w-24 h-24 bg-primary/10 rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <span class="text-2xl font-bold text-primary">AM</span>
                                    </div>
                                    <h3 class="text-lg font-semibold mb-2">Ana María González</h3>
                                    <p class="text-primary font-medium mb-2">Fundadora & CEO</p>
                                    <p class="text-sm text-muted-foreground">
                                        Ingeniera Agrónoma especializada en cultivos orgánicos y medicina natural.
                                    </p>
                                </div>
                            </div>

                            <div class="u-card text-center">
                                <div class="u-card__content">
                                    <div class="w-24 h-24 bg-primary/10 rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <span class="text-2xl font-bold text-primary">CR</span>
                                    </div>
                                    <h3 class="text-lg font-semibold mb-2">Carlos Rodríguez</h3>
                                    <p class="text-primary font-medium mb-2">Director de Producción</p>
                                    <p class="text-sm text-muted-foreground">
                                        Especialista en vermicompostaje y procesos de producción sustentable.
                                    </p>
                                </div>
                            </div>

                            <div class="u-card text-center">
                                <div class="u-card__content">
                                    <div class="w-24 h-24 bg-primary/10 rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <span class="text-2xl font-bold text-primary">LP</span>
                                    </div>
                                    <h3 class="text-lg font-semibold mb-2">Laura Pérez</h3>
                                    <p class="text-primary font-medium mb-2">Responsable de Calidad</p>
                                    <p class="text-sm text-muted-foreground">
                                        Química farmacéutica enfocada en control de calidad y certificaciones.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Values Section -->
                <section class="py-16">
                    <div class="u-container">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-serif font-bold mb-4">Nuestros Valores</h2>
                            <p class="text-lg text-muted-foreground">
                                Los principios que guían cada una de nuestras decisiones
                            </p>
                        </div>

                        <div class="u-grid u-grid--cols-2 lg:u-grid--cols-4 gap-6">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-primary/10 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold mb-2">Pasión</h3>
                                <p class="text-sm text-muted-foreground">
                                    Amor por lo que hacemos y compromiso con la excelencia
                                </p>
                            </div>

                            <div class="text-center">
                                <div class="w-16 h-16 bg-primary/10 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold mb-2">Calidad</h3>
                                <p class="text-sm text-muted-foreground">
                                    Estándares rigurosos en cada producto que ofrecemos
                                </p>
                            </div>

                            <div class="text-center">
                                <div class="w-16 h-16 bg-primary/10 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold mb-2">Sustentabilidad</h3>
                                <p class="text-sm text-muted-foreground">
                                    Cuidado del planeta para las futuras generaciones
                                </p>
                            </div>

                            <div class="text-center">
                                <div class="w-16 h-16 bg-primary/10 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.121M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold mb-2">Comunidad</h3>
                                <p class="text-sm text-muted-foreground">
                                    Apoyo y desarrollo de nuestras comunidades locales
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Content from WordPress -->
                <?php if (get_the_content()) : ?>
                <section class="py-16 bg-muted/30">
                    <div class="u-container">
                        <div class="max-w-4xl mx-auto prose prose-lg">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>