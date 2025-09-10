<?php
/**
 * Template Name: Contacto
 */
get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/contacto-hero.jpg'); height: 50vh;">
        <div class="hero-overlay"></div>
        <div class="hero-content u-container">
            <h1 class="hero-title" style="font-size: 3rem;">Contacto</h1>
            <p class="hero-subtitle">
                Estamos aquí para ayudarte. Contáctanos para consultas, cotizaciones o más información.
            </p>
        </div>
    </section>

    <!-- Contenido Principal -->
    <section class="section">
        <div class="u-container">
            <?php if (isset($_GET['sent'])) : ?>
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: var(--eco-success); padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; text-align: center;">
                    ✅ Gracias por tu mensaje, te responderemos pronto.
                </div>
            <?php endif; ?>
            
            <div class="u-grid u-grid-cols-2" style="gap: 4rem;">
                <!-- Información de Contacto -->
                <div>
                    <h2 style="margin-bottom: 2rem;">Información de Contacto</h2>
                    
                    <div style="margin-bottom: 2rem;">
                        <h3 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email
                        </h3>
                        <p><strong>General:</strong> info@ecohierbas.cl</p>
                        <p><strong>Ventas:</strong> ventas@ecohierbas.cl</p>
                        <p><strong>B2B:</strong> empresas@ecohierbas.cl</p>
                    </div>
                    
                    <div style="margin-bottom: 2rem;">
                        <h3 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Teléfono
                        </h3>
                        <p><strong>Principal:</strong> +56 9 1234 5678</p>
                        <p><strong>WhatsApp:</strong> +56 9 2018 8260</p>
                    </div>
                    
                    <div style="margin-bottom: 2rem;">
                        <h3 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Dirección
                        </h3>
                        <p>Camino El tambo, San Vicente Tagua Tagua<br>VI Región, Chile</p>
                    </div>

                    <!-- FAQ -->
                    <div>
                        <h2 style="margin-bottom: 1.5rem;">Preguntas Frecuentes</h2>
                        
                        <details style="margin-bottom: 1rem; border: 1px solid var(--eco-border); border-radius: 0.5rem; padding: 1rem;">
                            <summary style="cursor: pointer; font-weight: 500; color: var(--eco-primary);">¿Realizan envíos internacionales?</summary>
                            <p style="margin-top: 1rem; color: var(--eco-text-light);">Actualmente solo realizamos envíos dentro de Chile.</p>
                        </details>
                        
                        <details style="margin-bottom: 1rem; border: 1px solid var(--eco-border); border-radius: 0.5rem; padding: 1rem;">
                            <summary style="cursor: pointer; font-weight: 500; color: var(--eco-primary);">¿Los productos son orgánicos?</summary>
                            <p style="margin-top: 1rem; color: var(--eco-text-light);">Sí, todos nuestros productos cuentan con certificación orgánica.</p>
                        </details>
                        
                        <details style="margin-bottom: 1rem; border: 1px solid var(--eco-border); border-radius: 0.5rem; padding: 1rem;">
                            <summary style="cursor: pointer; font-weight: 500; color: var(--eco-primary);">¿Ofrecen descuentos por mayor?</summary>
                            <p style="margin-top: 1rem; color: var(--eco-text-light);">Sí, contáctanos para una cotización B2B personalizada.</p>
                        </details>
                    </div>
                </div>

                <!-- Formulario de Contacto -->
                <div>
                    <h2 style="margin-bottom: 2rem;">Envíanos un Mensaje</h2>
                    
                    <!-- Aquí se integraría WP Forms o formulario personalizado -->
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: var(--eco-shadow);">
                        <input type="hidden" name="action" value="contact_form">
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('ecohierbas_contact_nonce'); ?>">
                        
                        <div class="form-group">
                            <label class="form-label" for="name">Nombre *</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="email">Email *</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="company">Empresa</label>
                            <input type="text" id="company" name="company" class="form-input">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="phone">Teléfono</label>
                            <input type="tel" id="phone" name="phone" class="form-input">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="query_type">Tipo de Consulta</label>
                            <select id="query_type" name="query_type" class="form-select">
                                <option value="">Selecciona un tipo</option>
                                <option value="general">Consulta General</option>
                                <option value="productos">Información de Productos</option>
                                <option value="b2b">Cotización Empresarial</option>
                                <option value="talleres">Talleres y Capacitaciones</option>
                                <option value="soporte">Soporte Técnico</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="message">Mensaje *</label>
                            <textarea id="message" name="message" class="form-textarea" rows="5" required placeholder="Cuéntanos cómo podemos ayudarte..."></textarea>
                        </div>
                        
                        <div class="form-checkbox">
                            <input type="checkbox" id="accept_marketing" name="accept_marketing">
                            <label for="accept_marketing" style="font-size: 0.875rem; color: var(--eco-text-light);">
                                Acepto recibir comunicaciones comerciales y newsletter de EcoHierbas Chile
                            </label>
                        </div>
                        
                        <button type="submit" class="u-btn u-btn--primary" style="width: 100%;">
                            Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>