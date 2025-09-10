    </div><!-- #main-content -->

<footer class="site-footer">
    <div class="footer-content u-container">
        <div class="footer-grid">
            <!-- Información de la empresa -->
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="<?php echo ecohierbas_get_logo(); ?>" 
                         alt="<?php bloginfo('name'); ?>">
                    <div>
                        <span style="font-size: 1.125rem; font-weight: 600;"><?php bloginfo('name'); ?></span>
                        <span style="font-size: 0.75rem; opacity: 0.8; display: block; margin-top: -2px;">Chile</span>
                    </div>
                </div>
                
                <p class="footer-description">
                    Empresa chilena especializada en productos orgánicos, hierbas medicinales 
                    y soluciones de vermicompostaje para un futuro más sustentable.
                </p>
                
                <div class="contact-info">
                    <div>
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>
                            <?php echo ecohierbas_get_contact_info('address') ?: 'Camino El tambo, San Vicente Tagua Tagua<br>VI Región, Chile'; ?>
                        </span>
                    </div>
                    
                    <?php if (ecohierbas_get_contact_info('phone')) : ?>
                    <div>
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span><?php echo ecohierbas_get_contact_info('phone'); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (ecohierbas_get_contact_info('email')) : ?>
                    <div>
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span><?php echo ecohierbas_get_contact_info('email'); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Navegación -->
            <div class="footer-section">
                <h3>Navegación</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'menu_class' => 'footer-menu',
                    'fallback_cb' => 'ecohierbas_fallback_footer_menu'
                ));
                ?>
            </div>

            <!-- Productos -->
            <div class="footer-section">
                <h3>Productos</h3>
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url(home_url('/productos?categoria=hierbas')); ?>">Hierbas Medicinales</a></li>
                    <li><a href="<?php echo esc_url(home_url('/productos?categoria=infusiones')); ?>">Infusiones Funcionales</a></li>
                    <li><a href="<?php echo esc_url(home_url('/productos?categoria=vermicompostaje')); ?>">Vermicomposteras</a></li>
                    <li><a href="<?php echo esc_url(home_url('/productos?categoria=maceteros')); ?>">Maceteros Ecológicos</a></li>
                    <li><a href="<?php echo esc_url(home_url('/productos?categoria=kits')); ?>">Kits de Cultivo</a></li>
                </ul>
            </div>

            <!-- Newsletter y Redes Sociales -->
            <div class="footer-section">
                <h3>Mantente Conectado</h3>
                <p style="margin-bottom: 1rem; color: rgba(255, 255, 255, 0.9);">
                    Recibe noticias sobre nuevos productos, talleres y tips de vida sustentable.
                </p>
                
                <form class="newsletter-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="newsletter_signup">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('newsletter_nonce'); ?>">
                    <input type="email" name="email" class="newsletter-input" placeholder="Tu email" required>
                    <button type="submit" class="newsletter-button">Suscribir</button>
                </form>
                
                <div style="margin-top: 1.5rem;">
                    <p style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.8); margin-bottom: 0.75rem;">Síguenos:</p>
                    <div class="social-links">
                        <?php if (ecohierbas_get_contact_info('instagram')) : ?>
                        <a href="<?php echo esc_url(ecohierbas_get_contact_info('instagram')); ?>" 
                           target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C8.396 0 7.989.013 6.756.072 5.526.13 4.719.333 4.033.63c-.7.3-1.3.74-1.9 1.34-.6.6-1.04 1.2-1.34 1.9-.297.686-.5 1.493-.558 2.723C.058 7.989.045 8.396.045 12.017c0 3.624.013 4.032.072 5.264.058 1.23.26 2.037.558 2.724.3.7.74 1.3 1.34 1.9.6.6 1.2 1.04 1.9 1.34.686.296 1.493.499 2.723.558 1.233.058 1.64.072 5.264.072 3.624 0 4.032-.013 5.264-.072 1.23-.058 2.037-.262 2.724-.558.7-.3 1.3-.74 1.9-1.34.6-.6 1.04-1.2 1.34-1.9.296-.687.499-1.494.558-2.724.058-1.232.072-1.64.072-5.264 0-3.624-.013-4.032-.072-5.264-.058-1.23-.262-2.037-.558-2.724-.3-.7-.74-1.3-1.34-1.9-.6-.6-1.2-1.04-1.9-1.34-.687-.296-1.494-.499-2.724-.558C16.032.013 15.624.001 12.017.001zM12.017 2.17c3.557 0 3.978.013 5.38.072 1.3.058 2.006.272 2.476.452.622.24 1.066.528 1.532.994.466.466.754.91.994 1.532.18.47.394 1.176.452 2.476.058 1.402.072 1.823.072 5.38 0 3.557-.013 3.978-.072 5.38-.058 1.3-.272 2.006-.452 2.476-.24.622-.528 1.066-.994 1.532-.466.466-.91.754-1.532.994-.47.18-1.176.394-2.476.452-1.402.058-1.823.072-5.38.072-3.557 0-3.978-.013-5.38-.072-1.3-.058-2.006-.272-2.476-.452-.622-.24-1.066-.528-1.532-.994-.466-.466-.754-.91-.994-1.532-.18-.47-.394-1.176-.452-2.476C2.183 15.995 2.17 15.574 2.17 12.017c0-3.557.013-3.978.072-5.38.058-1.3.272-2.006.452-2.476.24-.622.528-1.066.994-1.532.466-.466.91-.754 1.532-.994.47-.18 1.176-.394 2.476-.452 1.402-.058 1.823-.072 5.38-.072z"/>
                                <path d="M12.017 5.838a6.18 6.18 0 100 12.36 6.18 6.18 0 000-12.36zM12.017 15.99a3.972 3.972 0 110-7.944 3.972 3.972 0 010 7.944z"/>
                                <circle cx="18.406" cy="5.594" r="1.44"/>
                            </svg>
                        </a>
                        <?php else : ?>
                        <a href="https://www.instagram.com/ecohierbaschile/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C8.396 0 7.989.013 6.756.072 5.526.13 4.719.333 4.033.63c-.7.3-1.3.74-1.9 1.34-.6.6-1.04 1.2-1.34 1.9-.297.686-.5 1.493-.558 2.723C.058 7.989.045 8.396.045 12.017c0 3.624.013 4.032.072 5.264.058 1.23.26 2.037.558 2.724.3.7.74 1.3 1.34 1.9.6.6 1.2 1.04 1.9 1.34.686.296 1.493.499 2.723.558 1.233.058 1.64.072 5.264.072 3.624 0 4.032-.013 5.264-.072 1.23-.058 2.037-.262 2.724-.558.7-.3 1.3-.74 1.9-1.34.6-.6 1.04-1.2 1.34-1.9.296-.687.499-1.494.558-2.724.058-1.232.072-1.64.072-5.264 0-3.624-.013-4.032-.072-5.264-.058-1.23-.262-2.037-.558-2.724-.3-.7-.74-1.3-1.34-1.9-.6-.6-1.2-1.04-1.9-1.34-.687-.296-1.494-.499-2.724-.558C16.032.013 15.624.001 12.017.001zM12.017 2.17c3.557 0 3.978.013 5.38.072 1.3.058 2.006.272 2.476.452.622.24 1.066.528 1.532.994.466.466.754.91.994 1.532.18.47.394 1.176.452 2.476.058 1.402.072 1.823.072 5.38 0 3.557-.013 3.978-.072 5.38-.058 1.3-.272 2.006-.452 2.476-.24.622-.528 1.066-.994 1.532-.466.466-.91.754-1.532.994-.47.18-1.176.394-2.476.452-1.402.058-1.823.072-5.38.072-3.557 0-3.978-.013-5.38-.072-1.3-.058-2.006-.272-2.476-.452-.622-.24-1.066-.528-1.532-.994-.466-.466-.754-.91-.994-1.532-.18-.47-.394-1.176-.452-2.476C2.183 15.995 2.17 15.574 2.17 12.017c0-3.557.013-3.978.072-5.38.058-1.3.272-2.006.452-2.476.24-.622.528-1.066.994-1.532.466-.466.91-.754 1.532-.994.47-.18 1.176-.394 2.476-.452 1.402-.058 1.823-.072 5.38-.072z"/>
                                <path d="M12.017 5.838a6.18 6.18 0 100 12.36 6.18 6.18 0 000-12.36zM12.017 15.99a3.972 3.972 0 110-7.944 3.972 3.972 0 010 7.944z"/>
                                <circle cx="18.406" cy="5.594" r="1.44"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        
                        <?php if (ecohierbas_get_contact_info('facebook')) : ?>
                        <a href="<?php echo esc_url(ecohierbas_get_contact_info('facebook')); ?>" 
                           target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <?php else : ?>
                        <a href="https://www.facebook.com/Ecohierbaschile/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        
                        <?php if (ecohierbas_get_contact_info('whatsapp')) : ?>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo ecohierbas_get_contact_info('whatsapp'); ?>" 
                           target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
                            </svg>
                        </a>
                        <?php else : ?>
                        <a href="https://api.whatsapp.com/send?phone=56920188260" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-content u-container">
            <div>
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
            </div>
            
            <div class="footer-links">
                <a href="<?php echo esc_url(home_url('/terminos')); ?>">Términos y Condiciones</a>
                <a href="<?php echo esc_url(home_url('/privacidad')); ?>">Política de Privacidad</a>
                <div class="made-with-love">
                    Hecho con <span class="heart">♥</span> en Chile
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts adicionales -->
<script>
// Variables globales para JavaScript
window.ecohierbas = {
    ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
    nonce: '<?php echo wp_create_nonce('ecohierbas_nonce'); ?>',
    homeUrl: '<?php echo esc_url(home_url()); ?>',
    themeUrl: '<?php echo get_template_directory_uri(); ?>'
};
</script>

<?php wp_footer(); ?>

</body>
</html>

<?php
// Función fallback para el menú del footer
function ecohierbas_fallback_footer_menu() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Inicio</a></li>';
    echo '<li><a href="' . esc_url(home_url('/nosotros')) . '">Nosotros</a></li>';
    echo '<li><a href="' . esc_url(home_url('/productos')) . '">Productos</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contacto')) . '">Contacto</a></li>';
    echo '</ul>';
}
?>