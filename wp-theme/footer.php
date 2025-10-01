<?php
/**
 * Theme footer
 */
?>
<footer class="site-footer">
    <div class="u-container footer-main">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="<?php echo esc_url( 'https://via.placeholder.com/120x40?text=EcoHierbas' ); ?>" alt="EcoHierbas Chile" class="footer-logo" />
                <p>Empresa chilena especializada en productos orgánicos, hierbas medicinales y soluciones de vermicompostaje.</p>
                <ul class="contact-info">
                    <li>Camino El tambo, San Vicente Tagua Tagua</li>
                    <li>VI Región, Chile</li>
                    <li>+56 9 1234 5678</li>
                    <li>contacto@ecohierbaschile.cl</li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3>Navegación</h3>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'footer-menu',
                ) );
                ?>
            </div>
            <div class="footer-social">
                <h3>Redes Sociales</h3>
                <ul class="social-links">
                    <li><a href="https://www.instagram.com/ecohierbaschile/" target="_blank" rel="noopener">Instagram</a></li>
                    <li><a href="https://www.facebook.com/Ecohierbaschile/" target="_blank" rel="noopener">Facebook</a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=56920188260" target="_blank" rel="noopener">WhatsApp</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="u-container">
            <p>© <?php echo date( 'Y' ); ?> EcoHierbas Chile. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

