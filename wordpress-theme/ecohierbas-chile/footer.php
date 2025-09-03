    <!-- Footer -->
    <footer class="site-footer" role="contentinfo">
        <div class="u-container">
            <div class="footer-content">
                <!-- Información de la empresa -->
                <div class="footer-section">
                    <h3><?php esc_html_e('EcoHierbas Chile', 'ecohierbas'); ?></h3>
                    <p><?php esc_html_e('Especialistas en productos orgánicos, hierbas medicinales y soluciones sustentables para tu hogar y jardín.', 'ecohierbas'); ?></p>
                    
                    <!-- Información de contacto -->
                    <div class="contact-info" style="margin-top: 1rem;">
                        <p><strong><?php esc_html_e('Teléfono:', 'ecohierbas'); ?></strong> 
                            <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_option('ecohierbas_contact_phone', '+56 9 1234 5678'))); ?>">
                                <?php echo esc_html(get_option('ecohierbas_contact_phone', '+56 9 1234 5678')); ?>
                            </a>
                        </p>
                        <p><strong><?php esc_html_e('Email:', 'ecohierbas'); ?></strong> 
                            <a href="mailto:<?php echo esc_attr(get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl')); ?>">
                                <?php echo esc_html(get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl')); ?>
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Enlaces rápidos -->
                <div class="footer-section">
                    <h3><?php esc_html_e('Enlaces Rápidos', 'ecohierbas'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-nav-menu',
                        'container'      => false,
                        'fallback_cb'    => 'ecohierbas_footer_fallback_menu',
                    ));
                    ?>
                </div>

                <!-- Productos -->
                <div class="footer-section">
                    <h3><?php esc_html_e('Productos', 'ecohierbas'); ?></h3>
                    <ul>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><?php esc_html_e('Todos los Productos', 'ecohierbas'); ?></a></li>
                        <?php if (class_exists('WooCommerce')) : ?>
                            <?php
                            $product_categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                                'number' => 4,
                            ));
                            
                            if ($product_categories && !is_wp_error($product_categories)) :
                                foreach ($product_categories as $category) :
                            ?>
                                <li><a href="<?php echo esc_url(get_term_link($category)); ?>"><?php echo esc_html($category->name); ?></a></li>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        <?php else : ?>
                            <li><a href="#"><?php esc_html_e('Hierbas Medicinales', 'ecohierbas'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Kits de Cultivo', 'ecohierbas'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Vermicompostaje', 'ecohierbas'); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Newsletter y redes sociales -->
                <div class="footer-section">
                    <h3><?php esc_html_e('Mantente Conectado', 'ecohierbas'); ?></h3>
                    
                    <!-- Newsletter -->
                    <form class="newsletter-form" id="newsletter-form" style="margin-bottom: 1.5rem;">
                        <div style="display: flex; gap: 0.5rem;">
                            <input 
                                type="email" 
                                placeholder="<?php esc_attr_e('Tu email', 'ecohierbas'); ?>" 
                                required
                                class="u-input"
                                style="flex: 1;"
                                name="newsletter_email"
                                id="newsletter_email">
                            <button type="submit" class="u-btn u-btn--primary">
                                <?php esc_html_e('Suscribir', 'ecohierbas'); ?>
                            </button>
                        </div>
                    </form>

                    <!-- Redes sociales -->
                    <div class="social-links">
                        <h4 style="font-size: 1rem; margin-bottom: 0.75rem;"><?php esc_html_e('Síguenos', 'ecohierbas'); ?></h4>
                        <div style="display: flex; gap: 1rem;">
                            <?php $instagram_url = get_option('ecohierbas_social_instagram', 'https://www.instagram.com/ecohierbaschile/'); ?>
                            <?php if ($instagram_url) : ?>
                            <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Síguenos en Instagram', 'ecohierbas'); ?>">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <?php endif; ?>

                            <?php $facebook_url = get_option('ecohierbas_social_facebook', 'https://www.facebook.com/Ecohierbaschile/'); ?>
                            <?php if ($facebook_url) : ?>
                            <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Síguenos en Facebook', 'ecohierbas'); ?>">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <?php endif; ?>

                            <?php $whatsapp_num = get_option('ecohierbas_social_whatsapp', '56920188260'); ?>
                            <?php if ($whatsapp_num) : ?>
                            <a href="https://wa.me/<?php echo esc_attr($whatsapp_num); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Contactar por WhatsApp', 'ecohierbas'); ?>">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.485 3.085"/>
                                </svg>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer bottom -->
            <div class="footer-bottom">
                <p>&copy; <?php echo esc_html(date('Y')); ?> <?php esc_html_e('EcoHierbas Chile. Todos los derechos reservados.', 'ecohierbas'); ?></p>
                <p><?php esc_html_e('Desarrollado con ❤️ para un futuro más sustentable.', 'ecohierbas'); ?></p>
            </div>
        </div>
    </footer>

    <!-- Notificaciones Toast -->
    <div id="toast-container" class="toast-container" style="position: fixed; bottom: 1rem; right: 1rem; z-index: 200;"></div>

    <!-- Cart Sidebar -->
    <?php get_template_part('template-parts/cart-sidebar'); ?>

    <!-- Product Modal -->
    <?php get_template_part('template-parts/modal-product'); ?>

    <!-- B2B Quote Modal -->
    <?php get_template_part('template-parts/b2b-quote-modal'); ?>

    <?php wp_footer(); ?>

    <!-- Scripts de inicialización -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar todos los componentes
        if (typeof EcoHierbas !== 'undefined') {
            // Ya se inicializan en main.js
        }
    });
    </script>
</body>
</html>

<?php
/**
 * Menú de fallback si no hay menú asignado
 */
function ecohierbas_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Inicio', 'ecohierbas') . '</a></li>';
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(wc_get_page_permalink('shop')) . '">' . esc_html__('Productos', 'ecohierbas') . '</a></li>';
    }
    if (get_page_by_path('nosotros')) {
        echo '<li><a href="' . esc_url(get_permalink(get_page_by_path('nosotros'))) . '">' . esc_html__('Nosotros', 'ecohierbas') . '</a></li>';
    }
    if (get_page_by_path('contacto')) {
        echo '<li><a href="' . esc_url(get_permalink(get_page_by_path('contacto'))) . '">' . esc_html__('Contacto', 'ecohierbas') . '</a></li>';
    }
    echo '</ul>';
}

function ecohierbas_footer_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Inicio', 'ecohierbas') . '</a></li>';
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(wc_get_page_permalink('shop')) . '">' . esc_html__('Productos', 'ecohierbas') . '</a></li>';
    }
    if (get_page_by_path('nosotros')) {
        echo '<li><a href="' . esc_url(get_permalink(get_page_by_path('nosotros'))) . '">' . esc_html__('Nosotros', 'ecohierbas') . '</a></li>';
    }
    if (get_page_by_path('contacto')) {
        echo '<li><a href="' . esc_url(get_permalink(get_page_by_path('contacto'))) . '">' . esc_html__('Contacto', 'ecohierbas') . '</a></li>';
    }
    echo '</ul>';
}
?>