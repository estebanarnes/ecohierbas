<?php
/**
 * Plantilla para página Nosotros
 * Replica exactamente el diseño y contenido de Nosotros.tsx
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero Section -->
        <section class="relative h-[60vh] md:h-[70vh] flex items-center overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center" 
                 style="background-image: url('/lovable-uploads/debcd0d7-6515-4ff4-bb07-d5bc28e6bff9.png');">
            </div>
            
            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            
            <div class="relative z-10 u-container">
                <div class="max-w-3xl">
                    <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-6">
                        <?php esc_html_e('Nuestra Historia', 'ecohierbas'); ?>
                    </h1>
                    <p class="text-xl text-white/90 leading-relaxed">
                        <?php esc_html_e('Más de 8 años cultivando bienestar y sostenibilidad desde el corazón de Chile', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Company Story -->
        <section class="py-16 md:py-24">
            <div class="u-container">
                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                        <div>
                            <h2 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-6">
                                <?php esc_html_e('¿Quiénes somos?', 'ecohierbas'); ?>
                            </h2>
                            <div class="prose prose-lg text-muted-foreground">
                                <p class="mb-6">
                                    <?php esc_html_e('EcoHierbas Chile nace en 2015 de la pasión por la medicina natural y el cuidado del medio ambiente. Somos una empresa familiar ubicada en Pudahuel, dedicada a cultivar y distribuir hierbas medicinales orgánicas de la más alta calidad.', 'ecohierbas'); ?>
                                </p>
                                <p class="mb-6">
                                    <?php esc_html_e('Nuestro compromiso va más allá de ofrecer productos naturales. Creemos en un futuro sustentable donde la salud de las personas y el planeta van de la mano. Por eso, todos nuestros procesos respetan el ciclo natural y promueven la biodiversidad.', 'ecohierbas'); ?>
                                </p>
                                <p>
                                    <?php esc_html_e('Hoy, después de más de 8 años, hemos logrado posicionarnos como líderes en el mercado chileno de productos orgánicos, sirviendo tanto a familias conscientes como a empresas comprometidas con la sostenibilidad.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="/lovable-uploads/62e97ad3-752c-480f-8ab6-1cdda9102893.png" 
                                 alt="<?php esc_attr_e('Equipo EcoHierbas Chile', 'ecohierbas'); ?>" 
                                 class="w-full h-96 object-cover rounded-2xl shadow-lg">
                            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-primary/10 rounded-full flex items-center justify-center">
                                <span class="text-4xl">🌱</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values -->
        <section class="py-16 bg-muted/30">
            <div class="u-container">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                            <?php esc_html_e('Nuestros Valores', 'ecohierbas'); ?>
                        </h2>
                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                            <?php esc_html_e('Los principios que guían cada decisión y acción en EcoHierbas Chile', 'ecohierbas'); ?>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Sostenibilidad -->
                        <div class="u-card text-center">
                            <div class="u-card-content p-8">
                                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-foreground mb-4"><?php esc_html_e('Sostenibilidad', 'ecohierbas'); ?></h3>
                                <p class="text-muted-foreground">
                                    <?php esc_html_e('Cada proceso respeta el medio ambiente, desde el cultivo hasta el empaque, promoviendo un futuro más verde para las próximas generaciones.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Calidad -->
                        <div class="u-card text-center">
                            <div class="u-card-content p-8">
                                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-foreground mb-4"><?php esc_html_e('Calidad Premium', 'ecohierbas'); ?></h3>
                                <p class="text-muted-foreground">
                                    <?php esc_html_e('Certificaciones orgánicas y controles de calidad rigurosos garantizan que cada producto cumpla con los más altos estándares internacionales.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Innovación -->
                        <div class="u-card text-center">
                            <div class="u-card-content p-8">
                                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-foreground mb-4"><?php esc_html_e('Innovación', 'ecohierbas'); ?></h3>
                                <p class="text-muted-foreground">
                                    <?php esc_html_e('Investigamos constantemente nuevas técnicas de cultivo orgánico y desarrollamos productos innovadores para el bienestar natural.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Transparencia -->
                        <div class="u-card text-center">
                            <div class="u-card-content p-8">
                                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-foreground mb-4"><?php esc_html_e('Transparencia', 'ecohierbas'); ?></h3>
                                <p class="text-muted-foreground">
                                    <?php esc_html_e('Comunicación abierta sobre nuestros procesos, origen de ingredientes y prácticas comerciales con total honestidad.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Comunidad -->
                        <div class="u-card text-center">
                            <div class="u-card-content p-8">
                                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-foreground mb-4"><?php esc_html_e('Comunidad', 'ecohierbas'); ?></h3>
                                <p class="text-muted-foreground">
                                    <?php esc_html_e('Apoyamos a productores locales y educamos sobre agricultura sustentable, fortaleciendo la comunidad agrícola chilena.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Bienestar -->
                        <div class="u-card text-center">
                            <div class="u-card-content p-8">
                                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-foreground mb-4"><?php esc_html_e('Bienestar Integral', 'ecohierbas'); ?></h3>
                                <p class="text-muted-foreground">
                                    <?php esc_html_e('Creemos que la salud es holística: física, mental y ambiental. Nuestros productos nutren cuerpo, mente y planeta.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="py-16 md:py-24">
            <div class="u-container">
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Misión -->
                        <div class="u-card">
                            <div class="u-card-content p-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-2xl font-serif font-bold text-foreground"><?php esc_html_e('Nuestra Misión', 'ecohierbas'); ?></h2>
                                </div>
                                <p class="text-muted-foreground leading-relaxed">
                                    <?php esc_html_e('Proporcionar productos orgánicos de la más alta calidad que promuevan el bienestar integral de las personas, mientras educamos sobre prácticas sustentables y contribuimos al cuidado del medio ambiente a través de cada proceso de nuestra cadena de valor.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Visión -->
                        <div class="u-card">
                            <div class="u-card-content p-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-2xl font-serif font-bold text-foreground"><?php esc_html_e('Nuestra Visión', 'ecohierbas'); ?></h2>
                                </div>
                                <p class="text-muted-foreground leading-relaxed">
                                    <?php esc_html_e('Ser la empresa líder en Chile de productos orgánicos y medicina natural, reconocida por nuestra excelencia, innovación y compromiso con la sostenibilidad, inspirando a más personas y empresas a adoptar un estilo de vida consciente y respetuoso con el planeta.', 'ecohierbas'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-16 bg-primary text-white">
            <div class="u-container text-center">
                <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4">
                    <?php esc_html_e('¿Listo para unirte a nuestra misión?', 'ecohierbas'); ?>
                </h2>
                <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                    <?php esc_html_e('Descubre nuestros productos orgánicos y forma parte del cambio hacia un futuro más sustentable', 'ecohierbas'); ?>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url(class_exists('WooCommerce') ? get_permalink(wc_get_page_id('shop')) : home_url('/productos')); ?>" 
                       class="u-btn u-btn--secondary bg-white text-primary hover:bg-white/90">
                        <?php esc_html_e('Ver Productos', 'ecohierbas'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" 
                       class="u-btn u-btn--outline border-white text-white hover:bg-white hover:text-primary">
                        <?php esc_html_e('Contactar', 'ecohierbas'); ?>
                    </a>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>