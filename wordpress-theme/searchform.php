<?php
/**
 * Template for displaying search form
 *
 * @package Ecohierbas
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-form-wrapper">
        <label class="screen-reader-text" for="search-field">
            <?php _e('Buscar:', 'ecohierbas'); ?>
        </label>
        <input type="search" 
               id="search-field" 
               class="search-field" 
               placeholder="<?php _e('Buscar productos, posts...', 'ecohierbas'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               autocomplete="off">
        <button type="submit" class="search-submit">
            <i class="fas fa-search"></i>
            <span class="screen-reader-text"><?php _e('Buscar', 'ecohierbas'); ?></span>
        </button>
    </div>
</form>