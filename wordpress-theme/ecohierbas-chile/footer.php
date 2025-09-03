    </div><!-- #content -->

    <footer id="colophon" class="site-footer relative">
        <!-- Fondo tierra -->
        <div class="absolute inset-0 bg-gradient-to-b from-amber-900 via-amber-800 to-amber-900"></div>
        
        <!-- Overlay transparente acuoso -->
        <div class="footer-overlay">
            <div class="absolute inset-0 bg-gradient-to-b from-white/5 to-transparent"></div>
            
            <!-- Main Footer -->
            <div class="relative z-10 u-container py-16 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="lg:col-span-1">
                        <div class="flex items-center space-x-2 mb-6">
                            <?php
                            $custom_logo_id = get_theme_mod('custom_logo');
                            if ($custom_logo_id) {
                                echo wp_get_attachment_image($custom_logo_id, 'thumbnail', false, array('class' => 'w-12 h-12 object-contain'));
                            } else {
                                ?>
                                <img src="<?php echo esc_url(ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png'); ?>" 
                                     alt="<?php bloginfo('name'); ?>" 
                                     class="w-12 h-12 object-contain">
                                <?php
                            }
                            ?>
                            <div class="flex flex-col">
                                <span class="text-lg font-serif font-semibold"><?php bloginfo('name'); ?></span>
                                <span class="text-xs opacity-80 -mt-1">Chile</span>
                            </div>
                        </div>
                        <p class="text-white/90 mb-6 leading-relaxed">
                            <?php echo esc_html(get_bloginfo('description')); ?>
                        </p>
                        
                        <!-- Contact Info -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm">
                                    <?php echo wp_kses_post(nl2br(get_option('ecohierbas_contact_address', 'Camino El tambo, San Vicente Tagua Tagua<br>VI Región, Chile'))); ?>
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-sm text-white/90"><?php echo esc_html(get_option('ecohierbas_contact_phone', '+56 9 1234 5678')); ?></span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-white/90"><?php echo esc_html(get_option('ecohierbas_contact_email', 'contacto@ecohierbaschile.cl')); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-white"><?php esc_html_e('Navegación', 'ecohierbas'); ?></h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class' => 'space-y-3',
                            'container' => 'ul',
                            'fallback_cb' => 'ecohierbas_footer_fallback_menu',
                            'link_class' => 'text-white/80 hover:text-white transition-colors',
                        ));
                        ?>
                    </div>

                    <!-- Products -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-white"><?php esc_html_e('Productos', 'ecohierbas'); ?></h3>
                        <ul class="space-y-3">
                            <?php if (class_exists('WooCommerce')): ?>
                                <?php
                                $product_categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'number' => 5,
                                ));
                                
                                foreach ($product_categories as $category):
                                ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_term_link($category)); ?>" 
                                           class="text-white/80 hover:text-white transition-colors">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><a href="#" class="text-white/80 hover:text-white transition-colors"><?php esc_html_e('Hierbas Medicinales', 'ecohierbas'); ?></a></li>
                                <li><a href="#" class="text-white/80 hover:text-white transition-colors"><?php esc_html_e('Infusiones Funcionales', 'ecohierbas'); ?></a></li>
                                <li><a href="#" class="text-white/80 hover:text-white transition-colors"><?php esc_html_e('Vermicomposteras', 'ecohierbas'); ?></a></li>
                                <li><a href="#" class="text-white/80 hover:text-white transition-colors"><?php esc_html_e('Maceteros Ecológicos', 'ecohierbas'); ?></a></li>
                                <li><a href="#" class="text-white/80 hover:text-white transition-colors"><?php esc_html_e('Kits de Cultivo', 'ecohierbas'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-white"><?php esc_html_e('Mantente Conectado', 'ecohierbas'); ?></h3>
                        <p class="text-white/90 mb-4">
                            <?php esc_html_e('Recibe noticias sobre nuevos productos, talleres y tips de vida sustentable.', 'ecohierbas'); ?>
                        </p>
                        <div class="space-y-4">
                            <form id="newsletter-form" class="flex gap-2">
                                <input type="email" 
                                       placeholder="<?php esc_attr_e('Tu email', 'ecohierbas'); ?>"
                                       class="u-input bg-white/10 backdrop-blur-sm border-white/30 text-white placeholder:text-white/60"
                                       required>
                                <button type="submit" 
                                        class="u-btn u-btn--secondary bg-white/20 backdrop-blur-sm text-white border border-white/30 hover:bg-white/30">
                                    <?php esc_html_e('Suscribir', 'ecohierbas'); ?>
                                </button>
                            </form>
                            
                            <!-- Social Links -->
                            <div>
                                <p class="text-sm text-white/80 mb-3"><?php esc_html_e('Síguenos:', 'ecohierbas'); ?></p>
                                <div class="flex gap-3">
                                    <a href="<?php echo esc_url(get_option('ecohierbas_social_instagram', 'https://www.instagram.com/ecohierbaschile/')); ?>" 
                                       target="_blank" rel="noopener noreferrer"
                                       class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20"
                                       aria-label="<?php esc_attr_e('Síguenos en Instagram', 'ecohierbas'); ?>">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                    <a href="<?php echo esc_url(get_option('ecohierbas_social_facebook', 'https://www.facebook.com/Ecohierbaschile/')); ?>" 
                                       target="_blank" rel="noopener noreferrer"
                                       class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20"
                                       aria-label="<?php esc_attr_e('Síguenos en Facebook', 'ecohierbas'); ?>">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    <?php $whatsapp = get_option('ecohierbas_social_whatsapp', '56920188260'); ?>
                                    <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp); ?>&text=<?php echo urlencode(__('¡Hola! ¿Cómo podemos ayudarte? Déjanos tu nombre, si necesitas el catálogo compártenos tu correo electrónico, disponemos de precios al por mayor y detalle.', 'ecohierbas')); ?>" 
                                       target="_blank" rel="noopener noreferrer"
                                       class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20"
                                       aria-label="<?php esc_attr_e('Contáctanos por WhatsApp', 'ecohierbas'); ?>">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="relative z-10 border-t border-white/20">
                <div class="u-container py-6">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-white/80">
                            © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Todos los derechos reservados.', 'ecohierbas'); ?>
                        </div>
                        
                        <div class="flex items-center gap-6 text-sm">
                            <a href="#" class="text-white/80 hover:text-white transition-colors">
                                <?php esc_html_e('Términos y Condiciones', 'ecohierbas'); ?>
                            </a>
                            <a href="#" class="text-white/80 hover:text-white transition-colors">
                                <?php esc_html_e('Política de Privacidad', 'ecohierbas'); ?>
                            </a>
                            <div class="flex items-center gap-1 text-white/80">
                                <?php esc_html_e('Hecho con', 'ecohierbas'); ?> 
                                <svg class="w-4 h-4 fill-current text-accent" viewBox="0 0 24 24">
                                    <path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5 2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z"/>
                                </svg>
                                <?php esc_html_e('en Chile', 'ecohierbas'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Sidebar -->
    <?php get_template_part('template-parts/cart-sidebar'); ?>

    <!-- B2B Quote Modal -->
    <?php get_template_part('template-parts/b2b-quote-modal'); ?>

    <!-- Product Detail Modal -->
    <div id="product-detail-modal" class="u-modal-overlay hidden" aria-hidden="true">
        <div class="u-modal-content" role="dialog" aria-labelledby="modal-title" aria-describedby="modal-description">
            <!-- Modal content will be populated by JavaScript -->
        </div>
    </div>

</div><!-- #page -->

<?php wp_footer(); ?>

<?php
// Función fallback para el menú del footer
function ecohierbas_footer_fallback_menu() {
    $menu_items = array(
        array('title' => 'Inicio', 'url' => home_url('/')),
        array('title' => 'Nosotros', 'url' => home_url('/nosotros')),
        array('title' => 'Productos', 'url' => home_url('/productos')),
        array('title' => 'Contacto', 'url' => home_url('/contacto')),
        array('title' => 'Talleres', 'url' => home_url('/talleres')),
    );

    echo '<ul class="space-y-3">';
    foreach ($menu_items as $item) {
        echo '<li><a href="' . esc_url($item['url']) . '" class="text-white/80 hover:text-white transition-colors">' . esc_html($item['title']) . '</a></li>';
    }
    echo '</ul>';
}
?>

</body>
</html>