/**
 * WooCommerce Cart Enhancement JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        initWooCommerceEnhancements();
    });

    function initWooCommerceEnhancements() {
        initAddToCartAnimations();
        initQuantityControls();
        initMiniCart();
        initProductFilters();
        initWishlist();
        initQuickView();
    }

    // Add to Cart Animations
    function initAddToCartAnimations() {
        $(document).on('click', '.single_add_to_cart_button', function() {
            const button = $(this);
            const originalText = button.text();
            
            button.addClass('loading')
                  .text('Agregando...')
                  .prop('disabled', true);

            // Reset after AJAX completes
            $(document).on('added_to_cart', function() {
                setTimeout(() => {
                    button.removeClass('loading')
                          .text('¡Agregado!')
                          .addClass('added');
                    
                    setTimeout(() => {
                        button.text(originalText)
                              .removeClass('added')
                              .prop('disabled', false);
                    }, 2000);
                }, 500);
            });
        });

        // Product card add to cart
        $(document).on('click', '.product-card .add_to_cart_button', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const productId = button.data('product_id');
            const quantity = button.data('quantity') || 1;
            
            button.addClass('loading').text('Agregando...');

            $.post(wc_add_to_cart_params.ajax_url, {
                action: 'woocommerce_add_to_cart',
                product_id: productId,
                quantity: quantity
            }, function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    // Update cart fragments
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, button]);
                    
                    // Show success animation
                    button.removeClass('loading')
                          .addClass('added')
                          .text('¡Agregado!');
                    
                    // Update cart count
                    updateCartCount(response.fragments);
                    
                    // Reset button after delay
                    setTimeout(() => {
                        button.removeClass('added').text('Agregar al carrito');
                    }, 3000);
                }
            });
        });
    }

    // Enhanced Quantity Controls
    function initQuantityControls() {
        $(document).on('click', '.quantity-minus, .quantity-plus', function() {
            const button = $(this);
            const input = button.siblings('.qty');
            const currentVal = parseInt(input.val());
            const min = parseInt(input.attr('min')) || 1;
            const max = parseInt(input.attr('max')) || 999;
            
            let newVal = currentVal;
            
            if (button.hasClass('quantity-minus')) {
                newVal = Math.max(min, currentVal - 1);
            } else {
                newVal = Math.min(max, currentVal + 1);
            }
            
            input.val(newVal).trigger('change');
        });

        // Add quantity controls to cart page
        $('.woocommerce-cart-form .quantity').each(function() {
            const quantityInput = $(this).find('.qty');
            
            if (quantityInput.length && !quantityInput.siblings('.quantity-controls').length) {
                quantityInput.wrap('<div class="quantity-wrapper"></div>');
                quantityInput.before('<button type="button" class="quantity-minus">-</button>');
                quantityInput.after('<button type="button" class="quantity-plus">+</button>');
                quantityInput.parent().addClass('quantity-controls');
            }
        });
    }

    // Mini Cart Enhancements
    function initMiniCart() {
        // Toggle mini cart
        $('.cart-toggle').on('click', function(e) {
            e.preventDefault();
            $('#mini-cart').toggleClass('open');
        });

        // Close mini cart when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#mini-cart, .cart-toggle').length) {
                $('#mini-cart').removeClass('open');
            }
        });

        // Remove item from mini cart
        $(document).on('click', '.mini-cart-remove', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const cartItemKey = button.data('cart-item-key');
            
            button.addClass('loading');
            
            $.post(wc_add_to_cart_params.ajax_url, {
                action: 'woocommerce_remove_cart_item',
                cart_item_key: cartItemKey
            }, function(response) {
                if (response.success) {
                    $(document.body).trigger('wc_fragment_refresh');
                    showNotification('Producto eliminado del carrito', 'info');
                } else {
                    showNotification('Error al eliminar el producto', 'error');
                }
                button.removeClass('loading');
            });
        });
    }

    // Product Filters
    function initProductFilters() {
        let filterTimeout;
        
        // Search filter
        $('#product-search').on('input', function() {
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(() => {
                filterProducts();
            }, 500);
        });

        // Category filter
        $('#product-category').on('change', function() {
            filterProducts();
        });

        // Price filter
        if ($('.price-filter').length) {
            $('.price-filter').on('change', function() {
                filterProducts();
            });
        }

        // Sort filter
        $('.orderby').on('change', function() {
            filterProducts();
        });
    }

    function filterProducts() {
        const searchTerm = $('#product-search').val();
        const category = $('#product-category').val();
        const priceMin = $('.price-filter-min').val() || '';
        const priceMax = $('.price-filter-max').val() || '';
        const orderby = $('.orderby').val() || 'menu_order';
        
        const productsContainer = $('.products');
        productsContainer.addClass('loading');
        
        $.post(wc_add_to_cart_params.ajax_url, {
            action: 'filter_products',
            search: searchTerm,
            category: category,
            price_min: priceMin,
            price_max: priceMax,
            orderby: orderby,
            nonce: ecohierbas_ajax.nonce
        }, function(response) {
            if (response.success) {
                productsContainer.html(response.data.products);
                
                // Update URL without reload
                const url = new URL(window.location);
                if (searchTerm) url.searchParams.set('search', searchTerm);
                else url.searchParams.delete('search');
                
                if (category) url.searchParams.set('product_cat', category);
                else url.searchParams.delete('product_cat');
                
                window.history.pushState({}, '', url);
            }
            productsContainer.removeClass('loading');
        });
    }

    // Wishlist Functionality
    function initWishlist() {
        $(document).on('click', '.wishlist-toggle', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const productId = button.data('product-id') || button.closest('.product').find('[data-product_id]').data('product_id');
            
            if (!productId) return;
            
            button.addClass('loading');
            
            $.post(wc_add_to_cart_params.ajax_url, {
                action: 'toggle_wishlist',
                product_id: productId,
                nonce: ecohierbas_ajax.nonce
            }, function(response) {
                if (response.success) {
                    button.toggleClass('in-wishlist');
                    
                    if (response.data.added) {
                        showNotification('Producto agregado a favoritos', 'success');
                        button.attr('title', 'Quitar de favoritos');
                    } else {
                        showNotification('Producto eliminado de favoritos', 'info');
                        button.attr('title', 'Agregar a favoritos');
                    }
                } else {
                    showNotification('Error al actualizar favoritos', 'error');
                }
                button.removeClass('loading');
            });
        });
    }

    // Quick View Functionality
    function initQuickView() {
        $(document).on('click', '.product-quick-view', function(e) {
            e.preventDefault();
            
            const productId = $(this).data('product-id');
            openQuickView(productId);
        });
    }

    function openQuickView(productId) {
        const modal = createQuickViewModal();
        $('body').append(modal).addClass('modal-open');
        
        // Load product content
        $.post(wc_add_to_cart_params.ajax_url, {
            action: 'get_product_quick_view',
            product_id: productId,
            nonce: ecohierbas_ajax.nonce
        }, function(response) {
            if (response.success) {
                modal.find('.quick-view-content').html(response.data);
                initQuantityControls();
            } else {
                modal.find('.quick-view-content').html('<p>Error al cargar el producto.</p>');
            }
        });
    }

    function createQuickViewModal() {
        return $(`
            <div class="quick-view-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                <div class="quick-view-container bg-white rounded-lg max-w-4xl w-full max-h-full overflow-y-auto">
                    <div class="quick-view-header flex justify-between items-center p-4 border-b">
                        <h3 class="text-lg font-semibold">Vista Rápida</h3>
                        <button class="quick-view-close text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="quick-view-content p-6">
                        <div class="text-center py-12">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                            <p class="mt-2 text-muted-foreground">Cargando producto...</p>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }

    // Close quick view modal
    $(document).on('click', '.quick-view-close, .quick-view-modal', function(e) {
        if (e.target === this) {
            $('.quick-view-modal').remove();
            $('body').removeClass('modal-open');
        }
    });

    // Update cart count
    function updateCartCount(fragments) {
        if (fragments && fragments['.cart-count']) {
            $('.cart-count').html(fragments['.cart-count']);
        }
    }

    // Show notification
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="wc-notification wc-notification--${type} fixed top-4 right-4 z-50 bg-white border-l-4 p-4 rounded shadow-lg">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-sm font-medium">${message}</p>
                    </div>
                    <button class="notification-close ml-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        `);

        // Add color classes based on type
        const colorClasses = {
            success: 'border-green-500 text-green-700',
            error: 'border-red-500 text-red-700',
            info: 'border-blue-500 text-blue-700',
            warning: 'border-yellow-500 text-yellow-700'
        };
        
        notification.addClass(colorClasses[type] || colorClasses.info);

        $('body').append(notification);
        
        // Show animation
        setTimeout(() => {
            notification.addClass('show');
        }, 100);

        // Auto remove
        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300);
        }, 5000);

        // Manual close
        notification.find('.notification-close').on('click', function() {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300);
        });
    }

    // Checkout enhancements
    if ($('body').hasClass('woocommerce-checkout')) {
        // Auto-fill commune based on city
        $('#billing_city').on('change', function() {
            const city = $(this).val();
            // Auto-populate commune if available
            updateCommune(city);
        });

        // Real-time validation
        $('.woocommerce-checkout input[required]').on('blur', function() {
            validateField($(this));
        });
    }

    function updateCommune(city) {
        // Chilean cities to commune mapping
        const cityCommune = {
            'Santiago': 'Santiago',
            'Valparaíso': 'Valparaíso',
            'Concepción': 'Concepción',
            // Add more mappings as needed
        };

        if (cityCommune[city]) {
            $('#billing_state').val(cityCommune[city]);
        }
    }

    function validateField(field) {
        const value = field.val().trim();
        const fieldType = field.attr('type');
        const isRequired = field.attr('required');
        
        let isValid = true;
        let errorMessage = '';

        if (isRequired && !value) {
            isValid = false;
            errorMessage = 'Este campo es requerido';
        } else if (fieldType === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                errorMessage = 'Email inválido';
            }
        } else if (fieldType === 'tel' && value) {
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]+$/;
            if (!phoneRegex.test(value)) {
                isValid = false;
                errorMessage = 'Teléfono inválido';
            }
        }

        // Remove existing error
        field.removeClass('error').siblings('.field-error').remove();

        if (!isValid) {
            field.addClass('error')
                 .after(`<span class="field-error text-red-500 text-sm">${errorMessage}</span>`);
        }

        return isValid;
    }

})(jQuery);