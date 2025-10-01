<?php
/**
 * Front page template
 */
get_header();
?>
<main>
    <section class="hero">
        <div class="bg" style="background-image: url('https://via.placeholder.com/1920x1080?text=Hero');"></div>
        <div class="overlay"></div>
        <div class="u-container content">
            <div class="badge"><span>🌱</span> Productos orgánicos certificados desde 2015</div>
            <h1 class="headline">Hierbas medicinales <span class="accent">orgánicas</span><br>para tu bienestar</h1>
            <p class="subtitle">Descubre nuestra selección de hierbas medicinales, productos de vermicompostaje y soluciones ecológicas para empresas conscientes y familias que cuidan su salud.</p>
            <div class="ctas">
                <a href="<?php echo esc_url( site_url( '/contacto' ) ); ?>" class="btn btn-primary">Cotización Corporativa</a>
                <a href="<?php echo esc_url( site_url( '/productos' ) ); ?>" class="btn btn-secondary">Ver Productos</a>
            </div>
        </div>
    </section>
    <section class="benefits">
        <div class="u-container">
            <h2>Beneficios</h2>
            <div class="benefit-grid">
                <div class="benefit">🌿 Cultivo 100% orgánico</div>
                <div class="benefit">🚚 Envíos a todo Chile</div>
                <div class="benefit">🤝 Compra directa a productores</div>
            </div>
        </div>
    </section>
    <section class="featured">
        <div class="u-container">
            <h2>Productos destacados</h2>
            <div class="product-grid">
                <?php
                $featured = new WP_Query(
                    array(
                        'post_type'      => 'producto',
                        'posts_per_page' => 3,
                        'meta_key'       => 'featured',
                        'meta_value'     => '1',
                    )
                );
                if ( $featured->have_posts() ) :
                    while ( $featured->have_posts() ) :
                        $featured->the_post();
                        $price = get_post_meta( get_the_ID(), 'price', true );
                        ?>
                        <div class="product-card">
                            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium' ); } ?>
                            <h3><?php the_title(); ?></h3>
                            <?php if ( $price ) : ?><p class="price">$<?php echo esc_html( $price ); ?></p><?php endif; ?>
                            <button class="add-to-cart" data-product="<?php the_ID(); ?>">Añadir al carrito</button>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No hay productos destacados.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
    <section class="stats-section">
        <div class="u-container">
            <div class="stats-grid">
                <div class="stat"><div class="number">150+</div><div class="label">Clientes</div></div>
                <div class="stat"><div class="number">200+</div><div class="label">Recuperaciones de residuos deshidratados</div></div>
                <div class="stat"><div class="number">98%</div><div class="label">Recomendarían</div></div>
            </div>
        </div>
    </section>
    <section class="reviews">
        <div class="u-container">
            <h2>Reseñas</h2>
            <div class="review-list">
                <blockquote>"Productos de excelente calidad" – Ana</blockquote>
                <blockquote>"Servicio rápido y amable" – Luis</blockquote>
                <blockquote>"Nuestra empresa confía en EcoHierbas" – Marta</blockquote>
            </div>
        </div>
    </section>
    <section class="workshops">
        <div class="u-container">
            <h2>Talleres</h2>
            <p>Participa en nuestros talleres de cultivo y uso de hierbas medicinales.</p>
        </div>
    </section>
</main>
<div id="offer-popup" class="offer-popup">
    <div class="offer-inner">
        <button class="close-offer" aria-label="Cerrar">×</button>
        <h2>¡Bienvenido!</h2>
        <p>Obtén un 10% de descuento en tu primera compra.</p>
        <a href="<?php echo esc_url( site_url( '/productos' ) ); ?>" class="btn btn-primary">Ver productos</a>
    </div>
</div>
<?php
get_footer();
?>
