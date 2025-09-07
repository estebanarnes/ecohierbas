<?php
/**
 * Template Name: Productos
 */
get_header();
?>
<main class="u-container">
    <h1>Nuestros Productos</h1>
    <div class="search-bar"><input type="text" id="product-search" placeholder="Buscar..." /></div>
    <div class="filters">
        <button class="product-filter active" data-cat="all">Todos</button>
        <?php
        $cats = get_categories( array( 'hide_empty' => false ) );
        foreach ( $cats as $cat ) {
            echo '<button class="product-filter" data-cat="' . esc_attr( $cat->slug ) . '">' . esc_html( $cat->name ) . '</button>';
        }
        ?>
    </div>
    <div class="price-filters">
        <input type="number" id="min-price" placeholder="Precio mín." />
        <input type="number" id="max-price" placeholder="Precio máx." />
        <button id="apply-price">Aplicar</button>
    </div>
    <div class="product-grid">
        <?php
        $query = new WP_Query( array(
            'post_type'      => 'producto',
            'posts_per_page' => -1,
        ) );
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) :
                $query->the_post();
                $price = get_post_meta( get_the_ID(), 'price', true );
                $terms = get_the_terms( get_the_ID(), 'category' );
                $slugs = $terms ? implode( ' ', wp_list_pluck( $terms, 'slug' ) ) : '';
                ?>
                <?php
                $image = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                $desc  = get_the_excerpt();
                ?>
                <div class="product-card" data-cat="<?php echo esc_attr( $slugs ); ?>" data-id="<?php the_ID(); ?>" data-title="<?php the_title_attribute(); ?>" data-desc="<?php echo esc_attr( $desc ); ?>" data-img="<?php echo esc_url( $image ); ?>" data-price="<?php echo esc_attr( $price ); ?>">
                    <?php if ( $image ) { echo '<img src="' . esc_url( $image ) . '" alt="" />'; } ?>
                    <h2><?php the_title(); ?></h2>
                    <?php if ( $price ) : ?><p class="price">$<?php echo esc_html( $price ); ?></p><?php endif; ?>
                    <div class="card-actions">
                        <button class="view-detail" data-product="<?php the_ID(); ?>">Ver detalle</button>
                        <button class="add-to-cart" data-product="<?php the_ID(); ?>">Añadir al carrito</button>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No hay productos disponibles.</p>';
        endif;
        ?>
    </div>
</main>
<div id="product-modal" class="product-modal">
    <div class="modal-inner">
        <button class="close-modal" aria-label="Cerrar">×</button>
        <img class="modal-img" src="" alt="" />
        <h2 class="modal-title"></h2>
        <p class="modal-desc"></p>
        <p class="modal-price"></p>
        <button class="add-to-cart modal-add" data-product="">Añadir al carrito</button>
    </div>
</div>
<?php get_footer(); ?>

