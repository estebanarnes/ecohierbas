<?php
/**
 * Page Template - Contacto
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contáctanos
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6">
                            <?php the_title(); ?>
                        </h1>
                        
                        <p class="text-xl text-muted-foreground leading-relaxed max-w-3xl mx-auto">
                            Estamos aquí para ayudarte. Contáctanos para cotizaciones, consultas sobre 
                            nuestros productos o información sobre talleres y capacitaciones.
                        </p>
                    </div>
                </section>

                <!-- Contact Info & Form Section -->
                <section class="py-16">
                    <div class="u-container">
                        <div class="u-grid u-grid--cols-1 lg:u-grid--cols-2 gap-12">
                            <!-- Contact Information -->
                            <div>
                                <h2 class="text-2xl font-serif font-bold mb-8">Información de Contacto</h2>
                                
                                <div class="space-y-6 mb-8">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold mb-1">Dirección</h3>
                                            <p class="text-muted-foreground">
                                                <?php echo esc_html(get_theme_mod('contact_address', 'Camino El tambo, San Vicente Tagua Tagua, VI Región, Chile')); ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold mb-1">Teléfono</h3>
                                            <p class="text-muted-foreground">
                                                <?php echo esc_html(get_theme_mod('contact_phone', '+56 9 1234 5678')); ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold mb-1">Email</h3>
                                            <p class="text-muted-foreground">
                                                <?php echo esc_html(get_theme_mod('contact_email', 'contacto@ecohierbaschile.cl')); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Hours -->
                                <div class="u-card">
                                    <div class="u-card__header">
                                        <h3 class="text-lg font-semibold">Horarios de Atención</h3>
                                    </div>
                                    <div class="u-card__content">
                                        <div class="space-y-3">
                                            <div class="flex justify-between">
                                                <span class="text-muted-foreground">Lunes - Viernes</span>
                                                <span class="font-medium">9:00 - 18:00</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-muted-foreground">Sábados</span>
                                                <span class="font-medium">9:00 - 14:00</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-muted-foreground">Domingos</span>
                                                <span class="font-medium">Cerrado</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Form -->
                            <div>
                                <div class="u-card">
                                    <div class="u-card__header">
                                        <h3 class="text-xl font-semibold">Envíanos un Mensaje</h3>
                                        <p class="text-muted-foreground">
                                            Completa el formulario y nos pondremos en contacto contigo a la brevedad.
                                        </p>
                                    </div>
                                    <div class="u-card__content">
                                        <?php
                                        // Use WP Forms if available, otherwise show fallback form
                                        if (function_exists('wpforms_display')) {
                                            echo do_shortcode('[wpforms id="1" title="false"]');
                                        } else :
                                        ?>
                                            <form class="space-y-6" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                                <input type="hidden" name="action" value="contact_form_submission">
                                                <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                                                
                                                <div class="u-grid u-grid--cols-2 gap-4">
                                                    <div>
                                                        <label for="contact_name" class="block text-sm font-medium mb-2">Nombre *</label>
                                                        <input type="text" id="contact_name" name="contact_name" required
                                                               class="w-full px-3 py-2 border border-border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label for="contact_email" class="block text-sm font-medium mb-2">Email *</label>
                                                        <input type="email" id="contact_email" name="contact_email" required
                                                               class="w-full px-3 py-2 border border-border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent">
                                                    </div>
                                                </div>

                                                <div class="u-grid u-grid--cols-2 gap-4">
                                                    <div>
                                                        <label for="contact_phone" class="block text-sm font-medium mb-2">Teléfono</label>
                                                        <input type="tel" id="contact_phone" name="contact_phone"
                                                               class="w-full px-3 py-2 border border-border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label for="contact_type" class="block text-sm font-medium mb-2">Tipo de Consulta</label>
                                                        <select id="contact_type" name="contact_type"
                                                                class="w-full px-3 py-2 border border-border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent">
                                                            <option value="">Seleccionar...</option>
                                                            <option value="productos">Información de Productos</option>
                                                            <option value="cotizacion">Cotización B2B</option>
                                                            <option value="talleres">Talleres y Capacitaciones</option>
                                                            <option value="soporte">Soporte Técnico</option>
                                                            <option value="otro">Otro</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="contact_company" class="block text-sm font-medium mb-2">Empresa (opcional)</label>
                                                    <input type="text" id="contact_company" name="contact_company"
                                                           class="w-full px-3 py-2 border border-border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent">
                                                </div>

                                                <div>
                                                    <label for="contact_subject" class="block text-sm font-medium mb-2">Asunto *</label>
                                                    <input type="text" id="contact_subject" name="contact_subject" required
                                                           class="w-full px-3 py-2 border border-border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent">
                                                </div>

                                                <div>
                                                    <label for="contact_message" class="block text-sm font-medium mb-2">Mensaje *</label>
                                                    <textarea id="contact_message" name="contact_message" rows="5" required
                                                              class="w-full px-3 py-2 border border-border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                                              placeholder="Cuéntanos cómo podemos ayudarte..."></textarea>
                                                </div>

                                                <div class="flex items-center gap-3">
                                                    <input type="checkbox" id="contact_newsletter" name="contact_newsletter" value="1"
                                                           class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary">
                                                    <label for="contact_newsletter" class="text-sm text-muted-foreground">
                                                        Quiero recibir información sobre nuevos productos y talleres
                                                    </label>
                                                </div>

                                                <button type="submit" class="u-btn u-btn--primary w-full">
                                                    Enviar Mensaje
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Map Section -->
                <section class="py-16 bg-muted/30">
                    <div class="u-container">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-serif font-bold mb-4">Nuestra Ubicación</h2>
                            <p class="text-lg text-muted-foreground">
                                Visítanos en nuestra sede en la VI Región de Chile
                            </p>
                        </div>

                        <div class="u-card overflow-hidden">
                            <div class="relative h-96">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509374!2d-71.0000000!3d-34.5000000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDMwJzAwLjAiUyA3McKwMDAnMDAuMCJX!5e0!3m2!1sen!2scl!4v1620000000000!5m2!1sen!2scl&q=Camino+El+tambo,+San+Vicente+Tagua+Tagua,+VI+Región,+Chile"
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="rounded-lg">
                                </iframe>
                                
                                <!-- Map Overlay with Link -->
                                <div class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 hover:opacity-100 transition-opacity cursor-pointer"
                                     onclick="window.open('https://www.google.com/maps/search/?api=1&query=Camino+El+tambo,+San+Vicente+Tagua+Tagua,+VI+Región,+Chile', '_blank')">
                                    <div class="bg-white/90 backdrop-blur-sm rounded-lg px-4 py-2 text-center">
                                        <p class="text-sm font-medium text-gray-900">Haz clic para abrir en Google Maps</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Content from WordPress -->
                <?php if (get_the_content()) : ?>
                <section class="py-16">
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