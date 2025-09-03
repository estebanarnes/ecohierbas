/**
 * EcoHierbas Chile Theme JavaScript
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        initializeTheme();
    });

    function initializeTheme() {
        // Initialize components
        initMobileMenu();
        initSmoothScrolling();
        initLazyLoading();
        initAnimations();
        initContactForm();
        
        if (typeof woocommerce !== 'undefined') {
            initWooCommerce();
        }
    }

    // Mobile Menu
    function initMobileMenu() {
        $('.mobile-menu-toggle').on('click', function() {
            $('.mobile-menu').toggleClass('hidden');
            $(this).toggleClass('active');
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.mobile-menu, .mobile-menu-toggle').length) {
                $('.mobile-menu').addClass('hidden');
                $('.mobile-menu-toggle').removeClass('active');
            }
        });
    }

    // Smooth Scrolling
    function initSmoothScrolling() {
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                    return false;
                }
            }
        });
    }

    // Lazy Loading for Images
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // Animations on Scroll
    function initAnimations() {
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                animationObserver.observe(el);
            });
        }
    }

    // Contact Form Enhancement
    function initContactForm() {
        // Add loading states to forms
        $('form').on('submit', function() {
            const submitBtn = $(this).find('button[type="submit"], input[type="submit"]');
            const originalText = submitBtn.text() || submitBtn.val();
            
            submitBtn.prop('disabled', true)
                    .text('Enviando...')
                    .addClass('loading');

            // Reset after 5 seconds if no response
            setTimeout(() => {
                submitBtn.prop('disabled', false)
                        .text(originalText)
                        .removeClass('loading');
            }, 5000);
        });

        // Newsletter subscription
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            const email = $(this).find('input[type="email"]').val();
            
            if (email) {
                // Here you would typically send to your newsletter service
                alert('¡Gracias por suscribirte! Te mantendremos informado sobre nuestros productos y talleres.');
                $(this)[0].reset();
            }
        });
    }

    // WooCommerce Enhancements
    function initWooCommerce() {
        // Product image gallery hover effect
        $('.product-card__image').hover(
            function() {
                $(this).find('img').addClass('scale-110');
            },
            function() {
                $(this).find('img').removeClass('scale-110');
            }
        );

        // Add to cart animation
        $(document).on('added_to_cart', function(event, fragments, cart_hash, button) {
            // Update cart count
            updateCartCount();
            
            // Show success message
            showNotification('Producto agregado al carrito', 'success');
            
            // Animate button
            button.addClass('added-to-cart');
            setTimeout(() => {
                button.removeClass('added-to-cart');
            }, 2000);
        });

        // Product quick view
        $('.product-quick-view').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            openProductQuickView(productId);
        });
    }

    // Update cart count
    function updateCartCount() {
        $.get(wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'), function(data) {
            if (data && data.fragments) {
                $.each(data.fragments, function(key, value) {
                    $(key).replaceWith(value);
                });
            }
        });
    }

    // Show notification
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="notification notification--${type}">
                <div class="notification__content">
                    <span class="notification__message">${message}</span>
                    <button class="notification__close">&times;</button>
                </div>
            </div>
        `);

        $('body').append(notification);
        
        setTimeout(() => {
            notification.addClass('show');
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300);
        }, 5000);

        // Manual close
        notification.find('.notification__close').on('click', function() {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300);
        });
    }

    // Product Quick View
    function openProductQuickView(productId) {
        // Create modal
        const modal = $(`
            <div class="quick-view-modal">
                <div class="quick-view-modal__overlay"></div>
                <div class="quick-view-modal__content">
                    <button class="quick-view-modal__close">&times;</button>
                    <div class="quick-view-modal__body">
                        <div class="loading-spinner">Cargando...</div>
                    </div>
                </div>
            </div>
        `);

        $('body').append(modal).addClass('modal-open');

        // Load product content via AJAX
        $.post(ecohierbas_ajax.ajax_url, {
            action: 'get_product_quick_view',
            product_id: productId,
            nonce: ecohierbas_ajax.nonce
        }, function(response) {
            if (response.success) {
                modal.find('.quick-view-modal__body').html(response.data);
            } else {
                modal.find('.quick-view-modal__body').html('<p>Error al cargar el producto.</p>');
            }
        });

        // Close modal
        modal.on('click', '.quick-view-modal__close, .quick-view-modal__overlay', function() {
            modal.remove();
            $('body').removeClass('modal-open');
        });
    }

    // Load more products (for infinite scroll)
    let loading = false;
    let page = 1;

    function loadMoreProducts() {
        if (loading) return;
        
        loading = true;
        page++;

        $.post(ecohierbas_ajax.ajax_url, {
            action: 'load_more_products',
            page: page,
            category: $('.product-filter.active').data('category') || 'all',
            nonce: ecohierbas_ajax.nonce
        }, function(response) {
            if (response) {
                $('.product-grid').append(response);
                initProductAnimations();
            }
            loading = false;
        });
    }

    // Initialize product animations
    function initProductAnimations() {
        $('.product-card').each(function(index) {
            $(this).css('animation-delay', (index * 100) + 'ms')
                   .addClass('animate-fade-in');
        });
    }

    // Scroll to top button
    const scrollToTopBtn = $('<button class="scroll-to-top" title="Volver arriba">↑</button>');
    $('body').append(scrollToTopBtn);

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 300) {
            scrollToTopBtn.addClass('show');
        } else {
            scrollToTopBtn.removeClass('show');
        }
    });

    scrollToTopBtn.on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 800);
    });

    // Global functions
    window.toggleMobileMenu = function() {
        $('.mobile-menu').toggleClass('hidden');
    };

    window.openB2BModal = function() {
        $('#b2b-modal').removeClass('hidden');
        $('body').addClass('modal-open');
    };

    window.closeB2BModal = function() {
        $('#b2b-modal').addClass('hidden');
        $('body').removeClass('modal-open');
    };

    window.subscribeNewsletter = function(form) {
        const email = form.newsletter_email.value;
        if (email) {
            showNotification('¡Gracias por suscribirte! Te mantendremos informado.', 'success');
            form.reset();
        }
        return false;
    };

})(jQuery);