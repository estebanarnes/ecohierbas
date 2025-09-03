    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                
                <!-- Footer Column 1 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h3>Ecohierbas</h3>
                        <p>Tu aliado perfecto para crear espacios verdes sustentables. Especialistas en huerta urbana, maceteros y vermicompostaje.</p>
                        <div class="social-links">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer Column 2 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h3>Enlaces Rápidos</h3>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a></li>
                            <?php if (class_exists('WooCommerce')) : ?>
                                <li><a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Productos</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo esc_url(home_url('/nosotros')); ?>">Nosotros</a></li>
                            <li><a href="<?php echo esc_url(home_url('/contacto')); ?>">Contacto</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer Column 3 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h3>Categorías</h3>
                        <?php if (class_exists('WooCommerce')) : ?>
                            <ul class="footer-links">
                                <?php
                                $product_categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'number' => 5,
                                ));
                                
                                if (!empty($product_categories) && !is_wp_error($product_categories)) :
                                    foreach ($product_categories as $category) :
                                        echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                        <?php else : ?>
                            <ul class="footer-links">
                                <li><a href="#">Maceteros</a></li>
                                <li><a href="#">Semillas</a></li>
                                <li><a href="#">Vermicompostaje</a></li>
                                <li><a href="#">Accesorios</a></li>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Footer Column 4 -->
                <div class="footer-section">
                    <h3>Contacto</h3>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i> info@ecohierbas.com</p>
                        <p><i class="fas fa-phone"></i> +1 234 567 8900</p>
                        <p><i class="fas fa-map-marker-alt"></i> Buenos Aires, Argentina</p>
                    </div>
                    
                    <?php if (class_exists('WooCommerce')) : ?>
                    <div class="payment-methods">
                        <h4>Métodos de Pago</h4>
                        <div class="payment-icons">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-paypal"></i>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                    <?php _e('Todos los derechos reservados.', 'ecohierbas'); ?></p>
                </div>
                
                <div class="footer-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Custom JavaScript for theme functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const navigation = document.querySelector('.main-navigation');
    
    if (mobileToggle && navigation) {
        mobileToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            navigation.classList.toggle('is-open');
        });
    }
    
    // Add to cart functionality (if WooCommerce is active)
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const quantity = this.dataset.quantity || 1;
            
            // Add loading state
            this.classList.add('loading');
            this.textContent = 'Agregando...';
            
            // AJAX request to add to cart
            fetch(ecohierbas_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'add_to_cart',
                    product_id: productId,
                    quantity: quantity,
                    nonce: ecohierbas_ajax.nonce
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.data.cart_count;
                    }
                    
                    // Show success message
                    this.textContent = 'Agregado!';
                    this.classList.add('success');
                    
                    setTimeout(() => {
                        this.textContent = 'Agregar al Carrito';
                        this.classList.remove('loading', 'success');
                    }, 2000);
                } else {
                    this.textContent = 'Error';
                    this.classList.add('error');
                    
                    setTimeout(() => {
                        this.textContent = 'Agregar al Carrito';
                        this.classList.remove('loading', 'error');
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.textContent = 'Error';
                this.classList.add('error');
                
                setTimeout(() => {
                    this.textContent = 'Agregar al Carrito';
                    this.classList.remove('loading', 'error');
                }, 2000);
            });
        });
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

</body>
</html>