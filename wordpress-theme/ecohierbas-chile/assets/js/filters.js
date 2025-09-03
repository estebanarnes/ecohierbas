/**
 * Filtros de productos
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        initProductFilters();
    });

    function initProductFilters() {
        $('.filter-btn').on('click', function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const category = $button.data('category');
            
            $('.filter-btn').removeClass('active');
            $button.addClass('active');
            
            filterProducts(category);
        });
    }

    function filterProducts(category) {
        const $products = $('.product-card');
        
        if (category === 'all') {
            $products.fadeIn(300);
        } else {
            $products.fadeOut(200, function() {
                $('.product-card.category-' + category).fadeIn(300);
            });
        }
    }

})(jQuery);