<?php
/**
 * Configuración inicial del tema
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configurar límites de memoria y tiempo para performance
 */
function ecohierbas_performance_setup() {
    // Aumentar límite de memoria si es necesario
    if (!ini_get('memory_limit') || (int)ini_get('memory_limit') < 256) {
        ini_set('memory_limit', '256M');
    }
}
add_action('init', 'ecohierbas_performance_setup');

/**
 * Remover jQuery Migrate para performance
 */
function ecohierbas_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'ecohierbas_remove_jquery_migrate');

/**
 * Desactivar emojis para performance
 */
function ecohierbas_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'ecohierbas_disable_emojis');

/**
 * Optimizar carga de Gutenberg
 */
function ecohierbas_optimize_gutenberg() {
    // Cargar CSS de Gutenberg solo en editor
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style'); // WooCommerce blocks
    }
}
add_action('wp_enqueue_scripts', 'ecohierbas_optimize_gutenberg', 100);

/**
 * Configurar Content Security Policy básico
 */
function ecohierbas_csp_header() {
    if (!is_admin()) {
        $csp = "default-src 'self'; ";
        $csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com https://www.google-analytics.com; ";
        $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
        $csp .= "img-src 'self' data: https:; ";
        $csp .= "font-src 'self' https://fonts.gstatic.com; ";
        $csp .= "connect-src 'self'; ";
        $csp .= "frame-src 'self';";
        
        header("Content-Security-Policy: $csp");
    }
}
add_action('send_headers', 'ecohierbas_csp_header');

/**
 * Configurar cache headers para assets estáticos
 */
function ecohierbas_cache_headers() {
    if (!is_admin()) {
        // Cache para assets estáticos
        header('Cache-Control: public, max-age=31536000'); // 1 año
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    }
}

/**
 * Configurar compresión GZIP
 */
function ecohierbas_gzip_compression() {
    if (!is_admin() && !ob_get_level()) {
        ob_start('ob_gzhandler');
    }
}
add_action('init', 'ecohierbas_gzip_compression');

/**
 * Configurar lazy loading para imágenes
 */
function ecohierbas_lazy_loading($attr, $attachment, $size) {
    if (!is_admin()) {
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'ecohierbas_lazy_loading', 10, 3);

/**
 * Configurar preconnect para Google Fonts
 */
function ecohierbas_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">';
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">';
}
add_action('wp_head', 'ecohierbas_preconnect', 1);

/**
 * Configurar meta viewport para responsive
 */
function ecohierbas_viewport_meta() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
    echo '<meta name="theme-color" content="hsl(142, 69%, 40%)">';
    echo '<meta name="msapplication-TileColor" content="hsl(142, 69%, 40%)">';
}
add_action('wp_head', 'ecohierbas_viewport_meta', 1);

/**
 * Configurar Open Graph para redes sociales
 */
function ecohierbas_open_graph() {
    if (is_single() || is_page()) {
        global $post;
        $title = get_the_title();
        $description = get_the_excerpt() ?: get_bloginfo('description');
        $image = get_the_post_thumbnail_url($post->ID, 'large') ?: ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png';
        $url = get_permalink();
    } else {
        $title = get_bloginfo('name');
        $description = get_bloginfo('description');
        $image = ECOHIERBAS_THEME_URL . '/assets/img/ecohierbas-logo.png';
        $url = home_url();
    }

    echo '<meta property="og:title" content="' . esc_attr($title) . '">';
    echo '<meta property="og:description" content="' . esc_attr($description) . '">';
    echo '<meta property="og:image" content="' . esc_url($image) . '">';
    echo '<meta property="og:url" content="' . esc_url($url) . '">';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:site_name" content="EcoHierbas Chile">';
    echo '<meta property="og:locale" content="es_ES">';
    
    // Twitter Cards
    echo '<meta name="twitter:card" content="summary_large_image">';
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">';
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">';
    echo '<meta name="twitter:image" content="' . esc_url($image) . '">';
}
add_action('wp_head', 'ecohierbas_open_graph');

/**
 * Configurar robots.txt dinámico
 */
function ecohierbas_robots_txt($output) {
    $output .= "User-agent: *\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /wp-includes/\n";
    $output .= "Disallow: /wp-content/plugins/\n";
    $output .= "Disallow: /wp-content/themes/\n";
    $output .= "Disallow: /trackback/\n";
    $output .= "Disallow: /feed/\n";
    $output .= "Disallow: /comments/\n";
    $output .= "Disallow: /category/*/*\n";
    $output .= "Disallow: */trackback/\n";
    $output .= "Disallow: */feed/\n";
    $output .= "Disallow: */comments/\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "\n";
    $output .= "Sitemap: " . home_url('/sitemap.xml') . "\n";
    
    return $output;
}
add_filter('robots_txt', 'ecohierbas_robots_txt');

/**
 * Configurar sitemap básico
 */
function ecohierbas_sitemap() {
    if (isset($_GET['sitemap']) && $_GET['sitemap'] === 'xml') {
        header('Content-Type: application/xml; charset=utf-8');
        
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Página principal
        echo '<url>';
        echo '<loc>' . home_url() . '</loc>';
        echo '<changefreq>daily</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';
        
        // Páginas
        $pages = get_pages();
        foreach ($pages as $page) {
            echo '<url>';
            echo '<loc>' . get_permalink($page->ID) . '</loc>';
            echo '<lastmod>' . date('Y-m-d', strtotime($page->post_modified)) . '</lastmod>';
            echo '<changefreq>weekly</changefreq>';
            echo '<priority>0.8</priority>';
            echo '</url>';
        }
        
        // Productos WooCommerce
        if (class_exists('WooCommerce')) {
            $products = get_posts(array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            ));
            
            foreach ($products as $product) {
                echo '<url>';
                echo '<loc>' . get_permalink($product->ID) . '</loc>';
                echo '<lastmod>' . date('Y-m-d', strtotime($product->post_modified)) . '</lastmod>';
                echo '<changefreq>weekly</changefreq>';
                echo '<priority>0.7</priority>';
                echo '</url>';
            }
        }
        
        echo '</urlset>';
        exit;
    }
}
add_action('init', 'ecohierbas_sitemap');

/**
 * Configurar seguridad básica
 */
function ecohierbas_security_headers() {
    if (!is_admin()) {
        header('X-Frame-Options: SAMEORIGIN');
        header('X-Content-Type-Options: nosniff');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'ecohierbas_security_headers');

/**
 * Remover información de versión para seguridad
 */
function ecohierbas_remove_version_info() {
    return '';
}
add_filter('the_generator', 'ecohierbas_remove_version_info');

/**
 * Configurar límite de intentos de login
 */
function ecohierbas_limit_login_attempts() {
    $attempts = get_transient('login_attempts_' . $_SERVER['REMOTE_ADDR']);
    
    if ($attempts && $attempts >= 5) {
        wp_die(__('Demasiados intentos de login. Intenta de nuevo en 30 minutos.', 'ecohierbas'));
    }
}
add_action('wp_login_failed', function() {
    $attempts = get_transient('login_attempts_' . $_SERVER['REMOTE_ADDR']) ?: 0;
    set_transient('login_attempts_' . $_SERVER['REMOTE_ADDR'], $attempts + 1, 30 * MINUTE_IN_SECONDS);
});

add_action('wp_login', function() {
    delete_transient('login_attempts_' . $_SERVER['REMOTE_ADDR']);
});