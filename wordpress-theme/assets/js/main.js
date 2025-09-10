/**
 * EcoHierbas Chile - JavaScript Principal
 * Funcionalidad para carrito, menú móvil, modales y filtros
 */

(function($) {
    'use strict';

    // Variables globales
    let cart = [];
    let cartTotal = 0;

    // Inicialización cuando el DOM está listo
    $(document).ready(function() {
        initMobileMenu();
        initCart();
        initModals();
        initToasts();
        initProductFilters();
        updateCartDisplay();
    });

    // === MENÚ MÓVIL ===
    function initMobileMenu() {
        const $mobileToggle = $('#mobile-menu-toggle');
        const $mobileMenu = $('#mobile-menu');
        const $mobileOverlay = $('#mobile-menu-overlay');
        const $mobileClose = $('#mobile-menu-close');

        // Abrir menú móvil
        $mobileToggle.on('click', function() {
            $mobileMenu.addClass('active');
            $mobileOverlay.addClass('active');
            $('body').css('overflow', 'hidden');
        });

        // Cerrar menú móvil
        function closeMobileMenu() {
            $mobileMenu.removeClass('active');
            $mobileOverlay.removeClass('active');
            $('body').css('overflow', 'auto');
        }

        $mobileClose.on('click', closeMobileMenu);
        $mobileOverlay.on('click', closeMobileMenu);

        // Cerrar menú al hacer click en un enlace
        $mobileMenu.find('a').on('click', function() {
            setTimeout(closeMobileMenu, 300);
        });
    }

    // === CARRITO ===
    function initCart() {
        const $cartToggle = $('#cart-toggle');
        const $cartPanel = $('#cart-panel');
        const $cartClose = $('#cart-close');

        // Abrir carrito
        $cartToggle.on('click', function() {
            $cartPanel.addClass('active');
            loadCartData();
        });

        // Cerrar carrito
        $cartClose.on('click', function() {
            $cartPanel.removeClass('active');
        });

        // Agregar al carrito
        $(document).on('click', '.add-to-cart', function() {
            const $button = $(this);
            const productId = $button.data('product-id');
            
            if ($button.prop('disabled')) return;
            
            addToCart(productId, 1);
        });

        // Actualizar cantidad en carrito
        $(document).on('click', '.quantity-button', function() {
            const action = $(this).data('action');
            const productId = $(this).data('product-id');
            const $quantitySpan = $(this).siblings('.quantity');
            let quantity = parseInt($quantitySpan.text());

            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            } else if (action === 'decrease' && quantity === 1) {
                removeFromCart(productId);
                return;
            }

            updateCartQuantity(productId, quantity);
        });
    }

    // Agregar producto al carrito
    function addToCart(productId, quantity = 1) {
        $.ajax({
            url: window.ecohierbas.ajaxUrl,
            method: 'POST',
            data: {
                action: 'add_to_cart',
                product_id: productId,
                quantity: quantity,
                nonce: window.ecohierbas.nonce
            },
            success: function(response) {
                if (response.success) {
                    showToast('Producto agregado al carrito', 'success');
                    updateCartDisplay();
                    loadCartData();
                } else {
                    showToast('Error al agregar el producto', 'error');
                }
            },
            error: function() {
                showToast('Error al agregar el producto', 'error');
            }
        });
    }

    // Actualizar cantidad en carrito
    function updateCartQuantity(productId, quantity) {
        $.ajax({
            url: window.ecohierbas.ajaxUrl,
            method: 'POST',
            data: {
                action: 'update_cart',
                product_id: productId,
                quantity: quantity,
                nonce: window.ecohierbas.nonce
            },
            success: function(response) {
                if (response.success) {
                    loadCartData();
                    updateCartDisplay();
                }
            }
        });
    }

    // Remover del carrito
    function removeFromCart(productId) {
        updateCartQuantity(productId, 0);
    }

    // Cargar datos del carrito
    function loadCartData() {
        $.ajax({
            url: window.ecohierbas.ajaxUrl,
            method: 'POST',
            data: {
                action: 'get_cart_data',
                nonce: window.ecohierbas.nonce
            },
            success: function(response) {
                if (response.success) {
                    renderCartItems(response.data.items);
                    $('#cart-total-amount').text('$' + response.data.total);
                    updateCartCount(response.data.count);
                }
            }
        });
    }

    // Renderizar items del carrito
    function renderCartItems(items) {
        const $cartItems = $('#cart-items');
        $cartItems.empty();

        if (items.length === 0) {
            $cartItems.append('<p style="text-align: center; color: var(--eco-text-light); padding: 2rem;">Tu carrito está vacío</p>');
            return;
        }

        items.forEach(function(item) {
            const itemHtml = `
                <div class="cart-item">
                    <img src="${item.image || '/wp-content/themes/ecohierbas/assets/images/placeholder.jpg'}" 
                         alt="${item.name}" class="cart-item-image">
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">$${item.price}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-button" data-action="decrease" data-product-id="${item.id}">-</button>
                            <span class="quantity">${item.quantity}</span>
                            <button class="quantity-button" data-action="increase" data-product-id="${item.id}">+</button>
                        </div>
                    </div>
                </div>
            `;
            $cartItems.append(itemHtml);
        });
    }

    // Actualizar contador del carrito
    function updateCartCount(count) {
        $('#cart-count').text(count || 0);
    }

    // Actualizar display del carrito
    function updateCartDisplay() {
        // Esta función se llama para actualizar el display general del carrito
        loadCartData();
    }

    // === MODALES ===
    function initModals() {
        // Modal B2B
        $('.b2b-quote-btn, .mobile-b2b-btn').on('click', function(e) {
            e.preventDefault();
            $('#b2b-modal').addClass('active');
        });

        $('#b2b-modal-close').on('click', function() {
            $('#b2b-modal').removeClass('active');
        });

        // Modal de producto
        $('#product-modal-close').on('click', function() {
            $('#product-modal').removeClass('active');
        });

        // Cerrar modales al hacer click en el overlay
        $('.modal-overlay').on('click', function(e) {
            if (e.target === this) {
                $(this).removeClass('active');
            }
        });

        // Cerrar modales con ESC
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('.modal-overlay').removeClass('active');
            }
        });
    }

    // === TOASTS ===
    function initToasts() {
        // Las notificaciones toast se manejan a través de la función showToast
    }

    function showToast(message, type = 'info', duration = 3000) {
        const toastId = 'toast-' + Date.now();
        const iconMap = {
            success: '<path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            error: '<path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zM12 14.25h.008v.008H12V14.25z"/>',
            warning: '<path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>',
            info: '<path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
        };

        const toast = $(`
            <div id="${toastId}" class="toast ${type}">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        ${iconMap[type] || iconMap.info}
                    </svg>
                    <span>${message}</span>
                </div>
            </div>
        `);

        $('#toast-container').append(toast);

        // Animar entrada
        setTimeout(() => {
            toast.css('transform', 'translateX(0)');
        }, 100);

        // Remover después del tiempo especificado
        setTimeout(() => {
            toast.css('transform', 'translateX(100%)');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }

    // === FILTROS DE PRODUCTOS ===
    function initProductFilters() {
        // Esta funcionalidad ya está implementada en page-productos.php
        // Aquí se pueden agregar filtros adicionales o mejoras
    }

    // === SMOOTH SCROLLING ===
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 500);
        }
    });

    // === LAZY LOADING DE IMÁGENES ===
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach((img) => {
            imageObserver.observe(img);
        });
    }

    // === EFECTOS DE SCROLL ===
    let lastScrollTop = 0;
    $(window).on('scroll', function() {
        const scrollTop = $(this).scrollTop();
        
        // Header behavior
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            $('.site-header').css('transform', 'translateY(-100%)');
        } else {
            // Scrolling up
            $('.site-header').css('transform', 'translateY(0)');
        }
        
        lastScrollTop = scrollTop;
    });

    // === VALIDACIÓN DE FORMULARIOS ===
    $('form').on('submit', function(e) {
        const $form = $(this);
        let isValid = true;

        // Validar campos requeridos
        $form.find('[required]').each(function() {
            const $field = $(this);
            if (!$field.val().trim()) {
                isValid = false;
                $field.addClass('error');
                showToast('Por favor completa todos los campos requeridos', 'error');
            } else {
                $field.removeClass('error');
            }
        });

        // Validar email
        const $emailFields = $form.find('input[type="email"]');
        $emailFields.each(function() {
            const $email = $(this);
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if ($email.val() && !emailPattern.test($email.val())) {
                isValid = false;
                $email.addClass('error');
                showToast('Por favor ingresa un email válido', 'error');
            }
        });

        if (!isValid) {
            e.preventDefault();
        }
    });

})(jQuery);

// === FUNCIONES GLOBALES ===

// Función para abrir el carrito desde cualquier lugar
window.openCart = function() {
    $('#cart-panel').addClass('active');
};

// Función para cerrar el carrito
window.closeCart = function() {
    $('#cart-panel').removeClass('active');
};

// Función para mostrar notificaciones desde cualquier lugar
window.showToast = function(message, type = 'info') {
    if (typeof jQuery !== 'undefined') {
        // Reutilizar la función interna si jQuery está disponible
        jQuery(document).ready(function() {
            showToast(message, type);
        });
    }
};