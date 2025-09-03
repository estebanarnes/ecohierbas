/**
 * Ecohierbas Theme JavaScript
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        
        // Initialize theme features
        initMobileMenu();
        initSmoothScrolling();
        initFormValidation();
        initProductGallery();
        initCartFunctionality();
        initNewsletterForm();
        
    });

    /**
     * Mobile Menu Functionality
     */
    function initMobileMenu() {
        const mobileToggle = $('.mobile-menu-toggle');
        const navigation = $('.main-navigation');
        
        mobileToggle.on('click', function() {
            const isExpanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !isExpanded);
            navigation.toggleClass('is-open');
            $('body').toggleClass('mobile-menu-open');
        });
        
        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-header').length) {
                navigation.removeClass('is-open');
                mobileToggle.attr('aria-expanded', 'false');
                $('body').removeClass('mobile-menu-open');
            }
        });
        
        // Close mobile menu on window resize
        $(window).on('resize', function() {
            if ($(window).width() > 768) {
                navigation.removeClass('is-open');
                mobileToggle.attr('aria-expanded', 'false');
                $('body').removeClass('mobile-menu-open');
            }
        });
    }

    /**
     * Smooth Scrolling for Anchor Links
     */
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 600);
            }
        });
    }

    /**
     * Form Validation
     */
    function initFormValidation() {
        // Contact form validation
        $('.contact-form').on('submit', function(e) {
            let isValid = true;
            
            $(this).find('input[required], textarea[required]').each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });
            
            // Email validation
            const emailField = $(this).find('input[type="email"]');
            if (emailField.length && emailField.val()) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.val())) {
                    isValid = false;
                    emailField.addClass('error');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                showNotification('Por favor, completa todos los campos requeridos.', 'error');
            }
        });
    }

    /**
     * Product Gallery Functionality
     */
    function initProductGallery() {
        // Product image zoom on hover
        $('.product-image').on('mouseenter', function() {
            $(this).addClass('zoomed');
        }).on('mouseleave', function() {
            $(this).removeClass('zoomed');
        });
        
        // Product quick view modal (if needed)
        $('.quick-view-btn').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            openQuickView(productId);
        });
    }

    /**
     * Cart Functionality
     */
    function initCartFunctionality() {
        // Add to cart button
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const productId = button.data('product-id');
            const quantity = button.data('quantity') || 1;
            
            // Show loading state
            button.addClass('loading').text('Agregando...');
            
            // AJAX request
            $.ajax({
                url: ecohierbas_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'add_to_cart',
                    product_id: productId,
                    quantity: quantity,
                    nonce: ecohierbas_ajax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Update cart count
                        $('.cart-count').text(response.data.cart_count);
                        
                        // Show success state
                        button.removeClass('loading').addClass('success').text('¡Agregado!');
                        
                        // Show notification
                        showNotification('Producto agregado al carrito', 'success');
                        
                        // Reset button after 2 seconds
                        setTimeout(function() {
                            button.removeClass('success').text('Agregar al Carrito');
                        }, 2000);
                        
                    } else {
                        button.removeClass('loading').addClass('error').text('Error');
                        showNotification('Error al agregar producto', 'error');
                        
                        setTimeout(function() {
                            button.removeClass('error').text('Agregar al Carrito');
                        }, 2000);
                    }
                },
                error: function() {
                    button.removeClass('loading').addClass('error').text('Error');
                    showNotification('Error de conexión', 'error');
                    
                    setTimeout(function() {
                        button.removeClass('error').text('Agregar al Carrito');
                    }, 2000);
                }
            });
        });
        
        // Update quantity in cart
        $(document).on('change', '.cart-quantity', function() {
            const input = $(this);
            const cartItemKey = input.data('cart-key');
            const quantity = input.val();
            
            updateCartQuantity(cartItemKey, quantity);
        });
        
        // Remove item from cart
        $(document).on('click', '.remove-cart-item', function(e) {
            e.preventDefault();
            
            const cartItemKey = $(this).data('cart-key');
            removeCartItem(cartItemKey);
        });
    }

    /**
     * Newsletter Form
     */
    function initNewsletterForm() {
        $('.newsletter-signup').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const email = form.find('input[type="email"]').val();
            const button = form.find('button[type="submit"]');
            
            if (!email) {
                showNotification('Por favor, ingresa tu email', 'error');
                return;
            }
            
            // Show loading state
            button.addClass('loading').text('Suscribiendo...');
            
            // Here you would integrate with your email marketing service
            // For now, we'll simulate a successful subscription
            setTimeout(function() {
                button.removeClass('loading').addClass('success').text('¡Suscrito!');
                form.find('input[type="email"]').val('');
                showNotification('¡Gracias por suscribirte!', 'success');
                
                setTimeout(function() {
                    button.removeClass('success').text('Suscribirse');
                }, 3000);
            }, 1000);
        });
    }

    /**
     * Utility Functions
     */
    
    // Show notification
    function showNotification(message, type) {
        const notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
        
        $('body').append(notification);
        
        setTimeout(function() {
            notification.addClass('show');
        }, 100);
        
        setTimeout(function() {
            notification.removeClass('show');
            setTimeout(function() {
                notification.remove();
            }, 300);
        }, 3000);
    }
    
    // Update cart quantity
    function updateCartQuantity(cartItemKey, quantity) {
        $.ajax({
            url: ecohierbas_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'update_cart_quantity',
                cart_item_key: cartItemKey,
                quantity: quantity,
                nonce: ecohierbas_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Refresh cart totals
                    $('.cart-total').html(response.data.cart_total);
                    showNotification('Cantidad actualizada', 'success');
                } else {
                    showNotification('Error al actualizar cantidad', 'error');
                }
            }
        });
    }
    
    // Remove cart item
    function removeCartItem(cartItemKey) {
        if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
            $.ajax({
                url: ecohierbas_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'remove_cart_item',
                    cart_item_key: cartItemKey,
                    nonce: ecohierbas_ajax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh the page
                    } else {
                        showNotification('Error al eliminar producto', 'error');
                    }
                }
            });
        }
    }
    
    // Open quick view modal
    function openQuickView(productId) {
        // This would open a modal with product details
        // Implementation depends on your specific needs
        console.log('Opening quick view for product:', productId);
    }

    /**
     * Window Load Events
     */
    $(window).on('load', function() {
        // Hide loading screen if exists
        $('.loading-screen').fadeOut(300);
        
        // Initialize any plugins that need the page to be fully loaded
        initScrollAnimations();
    });

    /**
     * Scroll Animations
     */
    function initScrollAnimations() {
        // Animate elements on scroll
        $(window).on('scroll', function() {
            $('.animate-on-scroll').each(function() {
                const element = $(this);
                const elementTop = element.offset().top;
                const elementBottom = elementTop + element.outerHeight();
                const viewportTop = $(window).scrollTop();
                const viewportBottom = viewportTop + $(window).height();
                
                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    element.addClass('animated');
                }
            });
        });
    }

})(jQuery);

/**
 * Vanilla JavaScript for critical functionality
 */
document.addEventListener('DOMContentLoaded', function() {
    
    // Sticky header
    const header = document.querySelector('.site-header');
    let lastScrollTop = 0;
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            header.classList.add('header-hidden');
        } else {
            // Scrolling up
            header.classList.remove('header-hidden');
        }
        
        lastScrollTop = scrollTop;
    });
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
});