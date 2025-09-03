<footer class="footer">
    <div class="footer__overlay">
        <div class="footer__content">
            <div class="u-container">
                <div class="footer__grid">
                    <!-- Company Info -->
                    <div>
                        <div class="flex items-center space-x-2 mb-6">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/30">
                                <span class="text-white font-bold text-lg">E</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-lg font-serif font-semibold">EcoHierbas</span>
                                <span class="text-xs opacity-80 -mt-1">Chile</span>
                            </div>
                        </div>
                        <p class="text-white/90 mb-6 leading-relaxed">
                            <?php
                            $description = get_bloginfo('description');
                            echo $description ? esc_html($description) : 'Empresa chilena especializada en productos orgánicos, hierbas medicinales y soluciones de vermicompostaje para un futuro más sustentable.';
                            ?>
                        </p>
                        
                        <!-- Contact Info -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm">
                                    <?php echo esc_html(get_theme_mod('contact_address', 'Camino El tambo, San Vicente Tagua Tagua, VI Región, Chile')); ?>
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-sm text-white/90">
                                    <?php echo esc_html(get_theme_mod('contact_phone', '+56 9 1234 5678')); ?>
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm text-white/90">
                                    <?php echo esc_html(get_theme_mod('contact_email', 'contacto@ecohierbaschile.cl')); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-white">Navegación</h3>
                        <ul class="footer__links">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a></li>
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>">Nosotros</a></li>
                            <?php if (class_exists('WooCommerce')) : ?>
                                <li><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Productos</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contacto</a></li>
                            <li><a href="<?php echo esc_url(home_url('/workshops')); ?>">Talleres</a></li>
                        </ul>
                    </div>

                    <!-- Products -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-white">Productos</h3>
                        <ul class="footer__links">
                            <?php if (class_exists('WooCommerce')) : 
                                $product_categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'number' => 5,
                                ));
                                if (!empty($product_categories)) :
                                    foreach ($product_categories as $category) :
                            ?>
                                <li>
                                    <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </li>
                            <?php 
                                    endforeach;
                                endif;
                            else : 
                            ?>
                                <li><a href="#">Hierbas Medicinales</a></li>
                                <li><a href="#">Infusiones Funcionales</a></li>
                                <li><a href="#">Vermicomposteras</a></li>
                                <li><a href="#">Maceteros Ecológicos</a></li>
                                <li><a href="#">Kits de Cultivo</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6 text-white">Mantente Conectado</h3>
                        <p class="text-white/90 mb-4">
                            Recibe noticias sobre nuevos productos, talleres y tips de vida sustentable.
                        </p>
                        <div class="space-y-4">
                            <?php
                            // Newsletter form - can be replaced with WP Forms
                            if (function_exists('wpforms_display')) {
                                echo do_shortcode('[wpforms id="3" title="false"]'); // Assuming form ID 3 for newsletter
                            } else :
                            ?>
                                <form class="flex gap-2" method="post" action="#" onsubmit="return subscribeNewsletter(this)">
                                    <input 
                                        type="email" 
                                        name="newsletter_email"
                                        placeholder="Tu email" 
                                        required
                                        class="flex-1 px-3 py-2 bg-white/10 backdrop-blur-sm border border-white/30 text-white placeholder:text-white/60 rounded"
                                    />
                                    <button type="submit" class="u-btn u-btn--secondary">
                                        Suscribir
                                    </button>
                                </form>
                            <?php endif; ?>
                            
                            <!-- Social Links -->
                            <div>
                                <p class="text-sm text-white/80 mb-3">Síguenos:</p>
                                <div class="flex gap-3">
                                    <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.024-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.74.097.118.11.221.082.343-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="footer__bottom">
            <div class="u-container">
                <div class="footer__bottom-content">
                    <div class="text-sm text-white/80">
                        © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.
                    </div>
                    
                    <div class="flex items-center gap-6 text-sm">
                        <a href="<?php echo esc_url(home_url('/terms')); ?>" class="text-white/80 hover:text-white transition-colors">
                            Términos y Condiciones
                        </a>
                        <a href="<?php echo esc_url(home_url('/privacy')); ?>" class="text-white/80 hover:text-white transition-colors">
                            Política de Privacidad
                        </a>
                        <div class="flex items-center gap-1 text-white/80">
                            Hecho con 
                            <svg class="w-4 h-4 fill-current text-accent" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                            en Chile
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
// Mobile menu toggle
function toggleMobileMenu() {
    const menu = document.querySelector('.mobile-menu');
    menu.classList.toggle('hidden');
}

// B2B Modal functions
function openB2BModal() {
    document.getElementById('b2b-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeB2BModal() {
    document.getElementById('b2b-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Newsletter subscription
function subscribeNewsletter(form) {
    const email = form.newsletter_email.value;
    if (email) {
        // Here you would typically send the email to your backend
        alert('¡Gracias por suscribirte! Te mantendremos informado.');
        form.reset();
    }
    return false;
}

// Close mobile menu when clicking on links
document.addEventListener('DOMContentLoaded', function() {
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
});
</script>

</body>
</html>