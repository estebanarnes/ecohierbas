    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-overlay">
            <div class="footer-content">
                <div class="u-container">
                    <div class="footer-grid">
                        
                        <!-- Company Info Column -->
                        <div class="footer-column">
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ecohierbas-logo.png" 
                                     alt="<?php bloginfo('name'); ?>" 
                                     style="width: 3rem; height: 3rem; object-fit: contain;">
                                <div style="display: flex; flex-direction: column;">
                                    <span style="font-size: 1.125rem; font-family: var(--eco-font-serif); font-weight: 600;"><?php bloginfo('name'); ?></span>
                                    <span style="font-size: 0.75rem; opacity: 0.8; margin-top: -0.25rem;">Chile</span>
                                </div>
                            </div>
                            
                            <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: 1.5rem; line-height: 1.6;">
                                Empresa chilena especializada en productos orgánicos, hierbas medicinales 
                                y soluciones de vermicompostaje para un futuro más sustentable.
                            </p>
                            
                            <!-- Contact Info -->
                            <div style="space-y: 0.75rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: rgba(255, 255, 255, 0.8); flex-shrink: 0;">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    <span style="font-size: 0.875rem;">
                                        Camino El tambo, San Vicente Tagua Tagua<br>
                                        VI Región, Chile
                                    </span>
                                </div>
                                
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: rgba(255, 255, 255, 0.8);">
                                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                                    </svg>
                                    <span style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.9);">+56 9 1234 5678</span>
                                </div>
                                
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: rgba(255, 255, 255, 0.8);">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                    <span style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.9);">contacto@ecohierbaschile.cl</span>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Column -->
                        <div class="footer-column">
                            <h3>Navegación</h3>
                            <ul>
                                <li><a href="<?php echo home_url(); ?>">Inicio</a></li>
                                <li><a href="<?php echo get_permalink(get_page_by_path('nosotros')); ?>">Nosotros</a></li>
                                <li><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Productos</a></li>
                                <li><a href="<?php echo get_permalink(get_page_by_path('contacto')); ?>">Contacto</a></li>
                                <li><a href="#">Talleres</a></li>
                            </ul>
                        </div>

                        <!-- Products Column -->
                        <div class="footer-column">
                            <h3>Productos</h3>
                            <ul>
                                <?php 
                                $product_categories = ecohierbas_get_product_categories();
                                if ($product_categories && !is_wp_error($product_categories)) :
                                    $count = 0;
                                    foreach ($product_categories as $category) :
                                        if ($count >= 5) break; // Limitar a 5 categorías
                                ?>
                                <li>
                                    <a href="<?php echo get_term_link($category); ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </li>
                                <?php 
                                        $count++;
                                    endforeach;
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

                        <!-- Newsletter Column -->
                        <div class="footer-column">
                            <h3>Mantente Conectado</h3>
                            <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: 1rem;">
                                Recibe noticias sobre nuevos productos, talleres y tips de vida sustentable.
                            </p>
                            
                            <form class="newsletter-form" style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem;">
                                <input type="email" 
                                       placeholder="Tu email" 
                                       required
                                       style="flex: 1; padding: 0.75rem; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: var(--eco-radius-m); background: rgba(255, 255, 255, 0.1); color: white; backdrop-filter: blur(8px);">
                                <button type="submit" 
                                        style="background: rgba(255, 255, 255, 0.2); color: white; border: 1px solid rgba(255, 255, 255, 0.3); padding: 0.75rem 1rem; border-radius: var(--eco-radius-m); cursor: pointer; backdrop-filter: blur(8px); transition: background 0.2s;">
                                    Suscribir
                                </button>
                            </form>
                            
                            <!-- Social Links -->
                            <div>
                                <p style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.8); margin-bottom: 0.75rem;">Síguenos:</p>
                                <div style="display: flex; gap: 0.75rem;">
                                    <a href="https://www.instagram.com/ecohierbaschile/" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       style="width: 3rem; height: 3rem; background: rgba(255, 255, 255, 0.1); border-radius: var(--eco-radius-m); display: flex; align-items: center; justify-content: center; transition: background 0.2s; border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);"
                                       onmouseover="this.style.background='rgba(255, 255, 255, 0.2)'"
                                       onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                                        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                    
                                    <a href="https://www.facebook.com/Ecohierbaschile/" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       style="width: 3rem; height: 3rem; background: rgba(255, 255, 255, 0.1); border-radius: var(--eco-radius-m); display: flex; align-items: center; justify-content: center; transition: background 0.2s; border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);"
                                       onmouseover="this.style.background='rgba(255, 255, 255, 0.2)'"
                                       onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                                        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    
                                    <a href="https://api.whatsapp.com/send?phone=56920188260&text=%C2%A1Hola!%20como%20podemos%20ayudarte%3F%2C%20d%C3%A9janos%20tu%20nombre%2C%20si%20necesitas%20el%20cat%C3%A1logo%20comp%C3%A1rtenos%20tu%20correo%20electr%C3%B3nico%2C%20disponemos%20de%20precios%20al%20por%20mayor%20y%20detalle." 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       style="width: 3rem; height: 3rem; background: rgba(255, 255, 255, 0.1); border-radius: var(--eco-radius-m); display: flex; align-items: center; justify-content: center; transition: background 0.2s; border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);"
                                       onmouseover="this.style.background='rgba(255, 255, 255, 0.2)'"
                                       onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                                        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.085"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                <div class="u-container" style="padding: 1.5rem 0;">
                    <div style="display: flex; flex-direction: column; md:flex-direction: row; align-items: center; justify-content: space-between; gap: 1rem;">
                        <div style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.8);">
                            © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.
                        </div>
                        
                        <div style="display: flex; align-items: center; gap: 1.5rem; font-size: 0.875rem; flex-wrap: wrap; justify-content: center;">
                            <a href="#" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'">
                                Términos y Condiciones
                            </a>
                            <a href="#" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'">
                                Política de Privacidad
                            </a>
                            <div style="display: flex; align-items: center; gap: 0.25rem; color: rgba(255, 255, 255, 0.8);">
                                Hecho con 
                                <svg width="16" height="16" fill="hsl(var(--accent))" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                                en Chile
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notifications Container -->
    <div id="toast-container" style="position: fixed; top: 1rem; right: 1rem; z-index: 1002; display: flex; flex-direction: column; gap: 0.5rem;"></div>

    <?php wp_footer(); ?>

    <script>
    // Initialize mobile menu, cart, and other interactions on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.style.display = 'block';
            });
        }
        
        if (mobileMenuClose && mobileMenu) {
            mobileMenuClose.addEventListener('click', function() {
                mobileMenu.style.display = 'none';
            });
        }
        
        // Close mobile menu when clicking outside
        if (mobileMenu) {
            mobileMenu.addEventListener('click', function(e) {
                if (e.target === mobileMenu) {
                    mobileMenu.style.display = 'none';
                }
            });
        }
        
        // Cart functionality
        const cartToggle = document.getElementById('cart-toggle');
        const cartSidebar = document.getElementById('cart-sidebar');
        const cartClose = document.getElementById('cart-close');
        const cartOverlay = document.getElementById('cart-overlay');
        
        if (cartToggle && cartSidebar && cartOverlay) {
            cartToggle.addEventListener('click', function() {
                cartSidebar.classList.add('open');
                cartOverlay.classList.add('show');
            });
        }
        
        function closeCart() {
            if (cartSidebar && cartOverlay) {
                cartSidebar.classList.remove('open');
                cartOverlay.classList.remove('show');
            }
        }
        
        if (cartClose) {
            cartClose.addEventListener('click', closeCart);
        }
        
        if (cartOverlay) {
            cartOverlay.addEventListener('click', closeCart);
        }
        
        // B2B Quote modal
        const b2bQuoteBtn = document.getElementById('b2b-quote-btn');
        const b2bQuoteModal = document.getElementById('b2b-quote-modal');
        
        if (b2bQuoteBtn && b2bQuoteModal) {
            b2bQuoteBtn.addEventListener('click', function() {
                b2bQuoteModal.style.display = 'flex';
            });
            
            // Close modal when clicking outside
            b2bQuoteModal.addEventListener('click', function(e) {
                if (e.target === b2bQuoteModal) {
                    b2bQuoteModal.style.display = 'none';
                }
            });
        }
    });
    </script>

</body>
</html>