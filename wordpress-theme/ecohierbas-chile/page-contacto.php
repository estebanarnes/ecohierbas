<?php
/**
 * Página Contacto
 * Replica funcionalidad de contacto del React
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <!-- Hero Section -->
    <section class="h-[400px] bg-gradient-to-b from-primary/5 to-background relative overflow-hidden flex items-center">
        <div class="absolute inset-0 flex items-center justify-center opacity-30 pointer-events-none z-0">
            <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                 alt="EcoHierbas Chile Logo" 
                 class="w-96 h-96 object-contain u-animate-float">
        </div>
        
        <div class="u-container relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-foreground mb-6">
                    <?php esc_html_e('Contáctanos', 'ecohierbas'); ?>
                </h1>
                <p class="text-xl text-muted-foreground mb-8 leading-relaxed">
                    <?php esc_html_e('Estamos aquí para ayudarte. Escríbenos y te responderemos a la brevedad.', 'ecohierbas'); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16">
        <div class="u-container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div>
                    <div class="u-card">
                        <div class="u-card-header">
                            <h2 class="text-2xl font-serif font-bold"><?php esc_html_e('Envíanos un mensaje', 'ecohierbas'); ?></h2>
                            <p class="text-muted-foreground mt-2">
                                <?php esc_html_e('Completa el formulario y nos pondremos en contacto contigo', 'ecohierbas'); ?>
                            </p>
                        </div>
                        <div class="u-card-content">
                            <form id="contact-form" class="space-y-6">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="first-name" class="block text-sm font-medium mb-2">
                                            <?php esc_html_e('Nombre', 'ecohierbas'); ?> <span class="text-destructive">*</span>
                                        </label>
                                        <input type="text" 
                                               id="first-name" 
                                               name="first_name"
                                               required
                                               class="u-input w-full"
                                               placeholder="<?php esc_attr_e('Tu nombre', 'ecohierbas'); ?>">
                                    </div>
                                    <div>
                                        <label for="last-name" class="block text-sm font-medium mb-2">
                                            <?php esc_html_e('Apellido', 'ecohierbas'); ?> <span class="text-destructive">*</span>
                                        </label>
                                        <input type="text" 
                                               id="last-name" 
                                               name="last_name"
                                               required
                                               class="u-input w-full"
                                               placeholder="<?php esc_attr_e('Tu apellido', 'ecohierbas'); ?>">
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium mb-2">
                                        <?php esc_html_e('Email', 'ecohierbas'); ?> <span class="text-destructive">*</span>
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email"
                                           required
                                           class="u-input w-full"
                                           placeholder="<?php esc_attr_e('tu@email.com', 'ecohierbas'); ?>">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium mb-2">
                                        <?php esc_html_e('Teléfono', 'ecohierbas'); ?>
                                    </label>
                                    <input type="tel" 
                                           id="phone" 
                                           name="phone"
                                           class="u-input w-full"
                                           placeholder="<?php esc_attr_e('+56 9 1234 5678', 'ecohierbas'); ?>">
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-medium mb-2">
                                        <?php esc_html_e('Asunto', 'ecohierbas'); ?> <span class="text-destructive">*</span>
                                    </label>
                                    <select id="subject" name="subject" required class="u-input w-full">
                                        <option value=""><?php esc_html_e('Selecciona un asunto', 'ecohierbas'); ?></option>
                                        <option value="producto"><?php esc_html_e('Consulta sobre productos', 'ecohierbas'); ?></option>
                                        <option value="pedido"><?php esc_html_e('Consulta sobre pedido', 'ecohierbas'); ?></option>
                                        <option value="b2b"><?php esc_html_e('Cotización B2B', 'ecohierbas'); ?></option>
                                        <option value="taller"><?php esc_html_e('Información sobre talleres', 'ecohierbas'); ?></option>
                                        <option value="otro"><?php esc_html_e('Otro', 'ecohierbas'); ?></option>
                                    </select>
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-medium mb-2">
                                        <?php esc_html_e('Mensaje', 'ecohierbas'); ?> <span class="text-destructive">*</span>
                                    </label>
                                    <textarea id="message" 
                                              name="message"
                                              rows="5"
                                              required
                                              class="u-input w-full resize-none"
                                              placeholder="<?php esc_attr_e('Cuéntanos cómo podemos ayudarte...', 'ecohierbas'); ?>"></textarea>
                                </div>

                                <div class="flex items-start gap-3">
                                    <input type="checkbox" 
                                           id="privacy-policy" 
                                           name="privacy_policy"
                                           required
                                           class="mt-1">
                                    <label for="privacy-policy" class="text-sm text-muted-foreground">
                                        <?php esc_html_e('Acepto la', 'ecohierbas'); ?> 
                                        <a href="#" class="text-primary hover:underline"><?php esc_html_e('política de privacidad', 'ecohierbas'); ?></a> 
                                        <?php esc_html_e('y autorizo el tratamiento de mis datos personales.', 'ecohierbas'); ?>
                                    </label>
                                </div>

                                <button type="submit" class="u-btn u-btn--primary w-full">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    <?php esc_html_e('Enviar mensaje', 'ecohierbas'); ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <!-- Contact Details -->
                    <div class="u-card">
                        <div class="u-card-header">
                            <h2 class="text-2xl font-serif font-bold"><?php esc_html_e('Información de contacto', 'ecohierbas'); ?></h2>
                        </div>
                        <div class="u-card-content space-y-6">
                            <!-- Address -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1"><?php esc_html_e('Dirección', 'ecohierbas'); ?></h3>
                                    <p class="text-muted-foreground">
                                        <?php echo wp_kses_post(nl2br(get_option('ecohierbas_contact_address', 'Camino El tambo, San Vicente Tagua Tagua<br>VI Región, Chile'))); ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1"><?php esc_html_e('Teléfono', 'ecohierbas'); ?></h3>
                                    <p class="text-muted-foreground"><?php echo esc_html(get_option('ecohierbas_contact_phone', '+56 9 1234 5678')); ?></p>
                                    <p class="text-sm text-muted-foreground mt-1"><?php esc_html_e('Lunes a Viernes: 9:00 - 18:00', 'ecohierbas'); ?></p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1"><?php esc_html_e('Email', 'ecohierbas'); ?></h3>
                                    <p class="text-muted-foreground"><?php echo esc_html(get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl')); ?></p>
                                    <p class="text-sm text-muted-foreground mt-1"><?php esc_html_e('Respondemos en máximo 24 horas', 'ecohierbas'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="u-card">
                        <div class="u-card-header">
                            <h2 class="text-xl font-serif font-bold"><?php esc_html_e('Síguenos', 'ecohierbas'); ?></h2>
                        </div>
                        <div class="u-card-content">
                            <div class="flex gap-4">
                                <a href="<?php echo esc_url(get_option('ecohierbas_social_instagram', 'https://www.instagram.com/ecohierbaschile/')); ?>" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white hover:scale-105 transition-transform">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                                <a href="<?php echo esc_url(get_option('ecohierbas_social_facebook', 'https://www.facebook.com/Ecohierbaschile/')); ?>" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:scale-105 transition-transform">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr(get_option('ecohierbas_social_whatsapp', '56920188260')); ?>&text=<?php echo urlencode(__('¡Hola! ¿Cómo podemos ayudarte?', 'ecohierbas')); ?>" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white hover:scale-105 transition-transform">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Quick Links -->
                    <div class="u-card">
                        <div class="u-card-header">
                            <h2 class="text-xl font-serif font-bold"><?php esc_html_e('Preguntas frecuentes', 'ecohierbas'); ?></h2>
                        </div>
                        <div class="u-card-content space-y-3">
                            <details class="group">
                                <summary class="flex justify-between items-center cursor-pointer py-2 font-medium hover:text-primary">
                                    <?php esc_html_e('¿Hacen envíos a todo Chile?', 'ecohierbas'); ?>
                                    <svg class="w-5 h-5 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <p class="text-muted-foreground mt-2 pb-2">
                                    <?php esc_html_e('Sí, realizamos envíos a todo Chile. Los tiempos de entrega varían según la región.', 'ecohierbas'); ?>
                                </p>
                            </details>
                            <details class="group">
                                <summary class="flex justify-between items-center cursor-pointer py-2 font-medium hover:text-primary">
                                    <?php esc_html_e('¿Ofrecen productos orgánicos certificados?', 'ecohierbas'); ?>
                                    <svg class="w-5 h-5 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <p class="text-muted-foreground mt-2 pb-2">
                                    <?php esc_html_e('Todos nuestros productos son 100% orgánicos y contamos con certificaciones correspondientes.', 'ecohierbas'); ?>
                                </p>
                            </details>
                            <details class="group">
                                <summary class="flex justify-between items-center cursor-pointer py-2 font-medium hover:text-primary">
                                    <?php esc_html_e('¿Realizan talleres de vermicompostaje?', 'ecohierbas'); ?>
                                    <svg class="w-5 h-5 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <p class="text-muted-foreground mt-2 pb-2">
                                    <?php esc_html_e('Sí, ofrecemos talleres presenciales y virtuales sobre vermicompostaje y agricultura sustentable.', 'ecohierbas'); ?>
                                </p>
                            </details>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>