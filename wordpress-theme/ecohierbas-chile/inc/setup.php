<?php
/**
 * Configuración del tema
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configurar tamaños de imagen personalizados
 */
function ecohierbas_setup_image_sizes() {
    add_image_size('product-card', 300, 300, true);
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('featured-product', 400, 400, true);
    add_image_size('gallery-thumb', 150, 150, true);
}
add_action('after_setup_theme', 'ecohierbas_setup_image_sizes');

/**
 * Configurar soporte para características del tema
 */
function ecohierbas_theme_features() {
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para feeds automáticos
    add_theme_support('automatic-feed-links');
    
    // Soporte para título dinámico
    add_theme_support('title-tag');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Soporte para logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 64,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // Soporte para colores personalizados
    add_theme_support('custom-background');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Soporte para Gutenberg
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    // Soporte para WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'ecohierbas_theme_features');

/**
 * Registrar menús de navegación
 */
function ecohierbas_register_menus() {
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'ecohierbas'),
        'footer'  => __('Menú Footer', 'ecohierbas'),
        'mobile'  => __('Menú Móvil', 'ecohierbas'),
    ));
}
add_action('after_setup_theme', 'ecohierbas_register_menus');

/**
 * Configurar áreas de widgets
 */
function ecohierbas_register_sidebars() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'ecohierbas'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets para la sidebar principal', 'ecohierbas'),
        'before_widget' => '<section id="%1$s" class="widget u-card %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer widgets
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer %d', 'ecohierbas'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('Columna %d del footer', 'ecohierbas'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'ecohierbas_register_sidebars');