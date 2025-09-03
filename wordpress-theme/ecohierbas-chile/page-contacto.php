<?php
/**
 * Plantilla para página Contacto
 * Replica exactamente el diseño y funcionalidad de Contacto.tsx
 */

get_header(); ?>

<main class="min-h-screen bg-background">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero Section -->
        <section class="relative h-[50vh] flex items-center overflow-hidden">
            <!-- Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-accent/10"></div>
            
            <!-- Logo transparente de fondo -->
            <div class="absolute inset-0 flex items-center justify-center opacity-20 pointer-events-none">
                <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                     alt="<?php esc_attr_e('EcoHierbas Chile Logo', 'ecohierbas'); ?>" 
                     class="w-96 h-96 object-contain">
            </div>
            
            <div class="relative z-10 u-container">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl md:text-6xl font-serif font-bold text-foreground mb-6">
                        <?php esc_html_e('Contacto', 'ecohierbas'); ?>
                    </h1>
                    <p class="text-xl text-muted-foreground">
                        <?php esc_html_e('Estamos aquí para ayudarte. Contáctanos para consultas, cotizaciones o más información sobre nuestros productos orgánicos.', 'ecohierbas'); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Content -->
        <section class="py-16 md:py-24">
            <div class="u-container">
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                        
                        <!-- Contact Form -->
                        <div class="order-2 lg:order-1">
                            <div class="u-card">
                                <div class="u-card-content p-8">
                                    <h2 class="text-2xl font-serif font-bold text-foreground mb-6">
                                        <?php esc_html_e('Envíanos un mensaje', 'ecohierbas'); ?>
                                    </h2>
                                    
                                    <form id="contact-form" class="space-y-6" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                                        <?php wp_nonce_field('ecohierbas_contact_nonce', 'contact_nonce'); ?>
                                        <input type="hidden" name="action" value="ecohierbas_contact_form">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="name" class="block text-sm font-medium text-foreground mb-2">
                                                    <?php esc_html_e('Nombre *', 'ecohierbas'); ?>
                                                </label>
                                                <input type="text" 
                                                       id="name" 
                                                       name="name" 
                                                       class="u-input w-full" 
                                                       required>
                                            </div>
                                            <div>
                                                <label for="email" class="block text-sm font-medium text-foreground mb-2">
                                                    <?php esc_html_e('Email *', 'ecohierbas'); ?>
                                                </label>
                                                <input type="email" 
                                                       id="email" 
                                                       name="email" 
                                                       class="u-input w-full" 
                                                       required>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-foreground mb-2">
                                                <?php esc_html_e('Teléfono', 'ecohierbas'); ?>
                                            </label>
                                            <input type="tel" 
                                                   id="phone" 
                                                   name="phone" 
                                                   class="u-input w-full">
                                        </div>
                                        
                                        <div>
                                            <label for="company" class="block text-sm font-medium text-foreground mb-2">
                                                <?php esc_html_e('Empresa (opcional)', 'ecohierbas'); ?>
                                            </label>
                                            <input type="text" 
                                                   id="company" 
                                                   name="company" 
                                                   class="u-input w-full">
                                        </div>
                                        
                                        <div>
                                            <label for="subject" class="block text-sm font-medium text-foreground mb-2">
                                                <?php esc_html_e('Asunto *', 'ecohierbas'); ?>
                                            </label>
                                            <select id="subject" name="subject" class="u-input w-full" required>
                                                <option value=""><?php esc_html_e('Selecciona un asunto', 'ecohierbas'); ?></option>
                                                <option value="consulta-general"><?php esc_html_e('Consulta General', 'ecohierbas'); ?></option>
                                                <option value="cotizacion-b2b"><?php esc_html_e('Cotización B2B', 'ecohierbas'); ?></option>
                                                <option value="soporte-tecnico"><?php esc_html_e('Soporte Técnico', 'ecohierbas'); ?></option>
                                                <option value="alianzas"><?php esc_html_e('Alianzas Comerciales', 'ecohierbas'); ?></option>
                                                <option value="otros"><?php esc_html_e('Otros', 'ecohierbas'); ?></option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label for="message" class="block text-sm font-medium text-foreground mb-2">
                                                <?php esc_html_e('Mensaje *', 'ecohierbas'); ?>
                                            </label>
                                            <textarea id="message" 
                                                      name="message" 
                                                      rows="5" 
                                                      class="u-input w-full" 
                                                      placeholder="<?php esc_attr_e('Cuéntanos cómo podemos ayudarte...', 'ecohierbas'); ?>"
                                                      required></textarea>
                                        </div>
                                        
                                        <div class="flex items-start gap-3">
                                            <input type="checkbox" 
                                                   id="privacy" 
                                                   name="privacy" 
                                                   class="mt-1" 
                                                   required>
                                            <label for="privacy" class="text-sm text-muted-foreground">
                                                <?php esc_html_e('Acepto el tratamiento de mis datos personales según la', 'ecohierbas'); ?>
                                                <a href="#" class="text-primary hover:underline"><?php esc_html_e('Política de Privacidad', 'ecohierbas'); ?></a>
                                            </label>
                                        </div>
                                        
                                        <button type="submit" class="u-btn u-btn--primary w-full">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                            <?php esc_html_e('Enviar Mensaje', 'ecohierbas'); ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="order-1 lg:order-2">
                            <div class="sticky top-8">
                                <h2 class="text-2xl font-serif font-bold text-foreground mb-8">
                                    <?php esc_html_e('Información de Contacto', 'ecohierbas'); ?>
                                </h2>
                                
                                <!-- Contact Cards -->
                                <div class="space-y-6 mb-8">
                                    <!-- Dirección -->
                                    <div class="flex items-start gap-4 p-6 bg-card border border-border rounded-lg">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-foreground mb-1"><?php esc_html_e('Dirección', 'ecohierbas'); ?></h3>
                                            <p class="text-muted-foreground">
                                                <?php echo wp_kses_post(nl2br(get_option('ecohierbas_contact_address', 'Camino El tambo<br>San Vicente Tagua Tagua<br>VI Región, Chile'))); ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Teléfono -->
                                    <div class="flex items-start gap-4 p-6 bg-card border border-border rounded-lg">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-foreground mb-1"><?php esc_html_e('Teléfono', 'ecohierbas'); ?></h3>
                                            <p class="text-muted-foreground">
                                                <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_option('ecohierbas_contact_phone', '+56912345678'))); ?>" 
                                                   class="hover:text-primary transition-colors">
                                                    <?php echo esc_html(get_option('ecohierbas_contact_phone', '+56 9 1234 5678')); ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Email -->
                                    <div class="flex items-start gap-4 p-6 bg-card border border-border rounded-lg">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-foreground mb-1"><?php esc_html_e('Email', 'ecohierbas'); ?></h3>
                                            <p class="text-muted-foreground">
                                                <a href="mailto:<?php echo esc_attr(get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl')); ?>" 
                                                   class="hover:text-primary transition-colors">
                                                    <?php echo esc_html(get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl')); ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Horarios -->
                                    <div class="flex items-start gap-4 p-6 bg-card border border-border rounded-lg">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-foreground mb-1"><?php esc_html_e('Horarios de Atención', 'ecohierbas'); ?></h3>
                                            <div class="text-muted-foreground text-sm space-y-1">
                                                <p><?php esc_html_e('Lunes - Viernes: 9:00 - 18:00', 'ecohierbas'); ?></p>
                                                <p><?php esc_html_e('Sábados: 9:00 - 14:00', 'ecohierbas'); ?></p>
                                                <p><?php esc_html_e('Domingos: Cerrado', 'ecohierbas'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- WhatsApp Quick Contact -->
                                <div class="u-card bg-green-50 border-green-200">
                                    <div class="u-card-content p-6 text-center">
                                        <h3 class="font-semibold text-foreground mb-2">
                                            <?php esc_html_e('¿Necesitas ayuda inmediata?', 'ecohierbas'); ?>
                                        </h3>
                                        <p class="text-muted-foreground text-sm mb-4">
                                            <?php esc_html_e('Chatea con nosotros por WhatsApp para respuestas rápidas', 'ecohierbas'); ?>
                                        </p>
                                        <?php $whatsapp = get_option('ecohierbas_social_whatsapp', '56920188260'); ?>
                                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp); ?>&text=<?php echo urlencode('¡Hola! Me gustaría obtener más información sobre sus productos.'); ?>" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           class="u-btn u-btn--primary bg-green-600 hover:bg-green-700 w-full">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                            </svg>
                                            <?php esc_html_e('Chatear por WhatsApp', 'ecohierbas'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-16 bg-muted/30">
            <div class="u-container">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                            <?php esc_html_e('Preguntas Frecuentes', 'ecohierbas'); ?>
                        </h2>
                        <p class="text-lg text-muted-foreground">
                            <?php esc_html_e('Encuentra respuestas a las consultas más comunes sobre nuestros productos y servicios', 'ecohierbas'); ?>
                        </p>
                    </div>

                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <div class="u-card">
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                    <h3 class="font-semibold text-foreground">
                                        <?php esc_html_e('¿Todos sus productos son 100% orgánicos?', 'ecohierbas'); ?>
                                    </h3>
                                    <svg class="w-5 h-5 text-muted-foreground group-open:rotate-180 transition-transform" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-muted-foreground">
                                        <?php esc_html_e('Sí, todos nuestros productos cuentan con certificación orgánica. Trabajamos sin pesticidas, herbicidas ni fertilizantes químicos, siguiendo estrictos protocolos de agricultura sustentable.', 'ecohierbas'); ?>
                                    </p>
                                </div>
                            </details>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="u-card">
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                    <h3 class="font-semibold text-foreground">
                                        <?php esc_html_e('¿Hacen envíos a todo Chile?', 'ecohierbas'); ?>
                                    </h3>
                                    <svg class="w-5 h-5 text-muted-foreground group-open:rotate-180 transition-transform" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-muted-foreground">
                                        <?php esc_html_e('Sí, realizamos envíos a todo el territorio nacional. Los tiempos de entrega varían entre 1-3 días hábiles para la Región Metropolitana y 3-7 días para regiones.', 'ecohierbas'); ?>
                                    </p>
                                </div>
                            </details>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="u-card">
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                    <h3 class="font-semibold text-foreground">
                                        <?php esc_html_e('¿Ofrecen descuentos para compras al por mayor?', 'ecohierbas'); ?>
                                    </h3>
                                    <svg class="w-5 h-5 text-muted-foreground group-open:rotate-180 transition-transform" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-muted-foreground">
                                        <?php esc_html_e('Absolutamente. Tenemos precios especiales para empresas, distribuidores y compras en grandes volúmenes. Contáctanos para una cotización personalizada B2B.', 'ecohierbas'); ?>
                                    </p>
                                </div>
                            </details>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="u-card">
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                    <h3 class="font-semibold text-foreground">
                                        <?php esc_html_e('¿Cuál es la vida útil de sus productos?', 'ecohierbas'); ?>
                                    </h3>
                                    <svg class="w-5 h-5 text-muted-foreground group-open:rotate-180 transition-transform" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-muted-foreground">
                                        <?php esc_html_e('La vida útil varía por producto. Las hierbas secas duran 12-24 meses, mientras que productos frescos duran 5-10 días. Todos incluyen fecha de vencimiento en el empaque.', 'ecohierbas'); ?>
                                    </p>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>