/**
 * EcoHierbas Chile - JavaScript Principal
 * Funcionalidades del carrito, productos y interacciones generales
 */

(function($) {
    'use strict';

    // ============================================================================
    // VARIABLES GLOBALES
    // ============================================================================
    
    let isCartUpdating = false;
    let toastCounter = 0;

    // ============================================================================
    // INICIALIZACIÓN
    // ============================================================================
    
    $(document).ready(function() {
        initializeCart();
        initializeProducts();
        initializeForms();
        initializeTooltips();
        initializeAnimations();
        
        console.log('EcoHierbas Theme: JavaScript inicializado correctamente');
    });

    // ============================================================================
    // FUNCIONES DEL CARRITO
    // ============================================================================
    
    function initializeCart() {
        // Agregar al carrito
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            
            if (isCartUpdating) return;
            
            const button = $(this);
            const productId = button.data('product-id');
            const quantity = parseInt(button.data('quantity')) || 1;
            
            if (!productId) {
                showToast('Error: Producto no válido', 'error');
                return;
            }
            
            addToCart(productId, quantity, button);
        });
        
        // Remover del carrito
        $(document).on('click', '.remove-cart-item', function(e) {
            e.preventDefault();
            
            if (isCartUpdating) return;
            
            const cartKey = $(this).data('cart-key');
            removeFromCart(cartKey);
        });
        
        // Actualizar carrito cuando se abre
        $(document).on('click', '#cart-toggle', function() {
            updateCartContent();
        });
    }
    
    function addToCart(productId, quantity, button) {
        isCartUpdating = true;
        
        // Loading state
        const originalText = button.text();
        button.prop('disabled', true).html('<span class="loading"></span> Agregando...');
        
        $.ajax({
            url: ecohierbas_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'ecohierbas_add_to_cart',
                product_id: productId,
                quantity: quantity,
                nonce: ecohierbas_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Actualizar contador del carrito
                    updateCartCount(response.data.cart_count);
                    
                    // Mostrar notificación
                    showToast(response.data.message, 'success');
                    
                    // Actualizar contenido del carrito
                    updateCartContent();
                    
                    // Abrir carrito automáticamente
                    openCart();
                } else {
                    showToast(response.data.message || 'Error al agregar producto', 'error');
                }
            },
            error: function() {
                showToast('Error de conexión', 'error');
            },
            complete: function() {
                // Restaurar botón
                button.prop('disabled', false).text(originalText);
                isCartUpdating = false;
            }
        });
    }
    
    function removeFromCart(cartKey) {
        if (!cartKey) return;
        
        isCartUpdating = true;
        
        $.ajax({
            url: ecohierbas_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'ecohierbas_remove_from_cart',
                cart_item_key: cartKey,
                nonce: ecohierbas_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Actualizar contador del carrito
                    updateCartCount(response.data.cart_count);
                    
                    // Actualizar contenido del carrito
                    updateCartContent();
                    
                    showToast(response.data.message, 'success');
                } else {
                    showToast(response.data.message || 'Error al remover producto', 'error');
                }
            },
            error: function() {
                showToast('Error de conexión', 'error');
            },
            complete: function() {
                isCartUpdating = false;
            }
        });
    }
    
    function updateCartContent() {
        $.ajax({
            url: ecohierbas_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'ecohierbas_get_cart_content',
                nonce: ecohierbas_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    $('#cart-content').html(response.data.cart_html);
                    updateCartCount(response.data.cart_count);
                    $('#cart-total').html(response.data.cart_total);
                }
            },
            error: function() {
                console.error('Error al actualizar carrito');
            }
        });
    }
    
    function updateCartCount(count) {
        const cartBadge = $('#cart-count');
        if (count > 0) {
            cartBadge.text(count).show();
        } else {
            cartBadge.hide();
        }
    }
    
    function openCart() {
        $('#cart-sidebar').addClass('open');
        $('#cart-overlay').addClass('show');
    }

    // ============================================================================
    // FUNCIONES DE PRODUCTOS
    // ============================================================================
    
    function initializeProducts() {
        // Filtros de productos
        $(document).on('change', '.product-filter', function() {
            filterProducts();
        });
        
        // Búsqueda de productos
        let searchTimeout;
        $(document).on('input', '.product-search', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                filterProducts();
            }, 500);
        });
        
        // Lazy loading de imágenes
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
    }
    
    function filterProducts() {
        const filters = {};
        
        // Recopilar filtros activos
        $('.product-filter:checked').each(function() {
            const filterType = $(this).data('filter-type');
            const filterValue = $(this).val();
            
            if (!filters[filterType]) {
                filters[filterType] = [];
            }
            filters[filterType].push(filterValue);
        });
        
        // Búsqueda por texto
        const searchTerm = $('.product-search').val();
        if (searchTerm) {
            filters.search = searchTerm;
        }
        
        // Aplicar filtros a productos visibles
        $('.product-card').each(function() {
            const product = $(this);
            let shouldShow = true;
            
            // Verificar cada tipo de filtro
            Object.keys(filters).forEach(filterType => {
                if (filterType === 'search') {
                    const productName = product.find('.product-title').text().toLowerCase();
                    const productDesc = product.find('.product-description').text().toLowerCase();
                    const searchLower = filters[filterType].toLowerCase();
                    
                    if (!productName.includes(searchLower) && !productDesc.includes(searchLower)) {
                        shouldShow = false;
                    }
                } else {
                    const productValue = product.data(filterType);
                    if (productValue && !filters[filterType].includes(productValue.toString())) {
                        shouldShow = false;
                    }
                }
            });
            
            // Mostrar/ocultar producto con animación
            if (shouldShow) {
                product.fadeIn(300);
            } else {
                product.fadeOut(300);
            }
        });
        
        // Actualizar contador de resultados
        setTimeout(function() {
            const visibleProducts = $('.product-card:visible').length;
            $('.results-count').text(`${visibleProducts} productos encontrados`);
        }, 350);
    }

    // ============================================================================
    // FUNCIONES DE FORMULARIOS
    // ============================================================================
    
    function initializeForms() {
        // Newsletter
        $(document).on('submit', '.newsletter-form', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const email = form.find('input[type="email"]').val();
            
            if (!email) {
                showToast('Por favor ingresa tu email', 'error');
                return;
            }
            
            // Aquí se puede integrar con servicio de newsletter
            showToast('¡Gracias por suscribirte!', 'success');
            form[0].reset();
        });
        
        // Validación de formularios WPForms
        $(document).on('submit', '.wpforms-form', function() {
            const form = $(this);
            
            // Mostrar loading en botón de envío
            const submitBtn = form.find('.wpforms-submit');
            const originalText = submitBtn.val();
            submitBtn.val('Enviando...').prop('disabled', true);
            
            // Restaurar botón después de un tiempo (WPForms maneja el envío)
            setTimeout(function() {
                submitBtn.val(originalText).prop('disabled', false);
            }, 3000);
        });
    }

    // ============================================================================
    // SISTEMA DE NOTIFICACIONES (TOASTS)
    // ============================================================================
    
    function showToast(message, type = 'info', duration = 5000) {
        toastCounter++;
        const toastId = `toast-${toastCounter}`;
        
        const toastTypes = {
            success: { color: 'hsl(var(--eco-color-success))', icon: '✓' },
            error: { color: 'hsl(var(--destructive))', icon: '✕' },
            warning: { color: 'hsl(var(--eco-color-warning))', icon: '⚠' },
            info: { color: 'hsl(var(--eco-color-info))', icon: 'ℹ' }
        };
        
        const toastStyle = toastTypes[type] || toastTypes.info;
        
        const toast = $(`
            <div id="${toastId}" class="toast" style="
                background: ${toastStyle.color};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: var(--eco-radius-m);
                box-shadow: var(--eco-shadow-card);
                display: flex;
                align-items: center;
                gap: 0.75rem;
                max-width: 400px;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                font-weight: 500;
                font-size: 0.875rem;
            ">
                <span style="font-size: 1.25rem;">${toastStyle.icon}</span>
                <span>${message}</span>
                <button type="button" class="toast-close" style="
                    background: none;
                    border: none;
                    color: white;
                    cursor: pointer;
                    padding: 0.25rem;
                    margin-left: auto;
                    opacity: 0.8;
                    font-size: 1.125rem;
                " onclick="removeToast('${toastId}')">×</button>
            </div>
        `);
        
        $('#toast-container').append(toast);
        
        // Animar entrada
        setTimeout(() => {
            toast.css('transform', 'translateX(0)');
        }, 100);
        
        // Auto-remove
        setTimeout(() => {
            removeToast(toastId);
        }, duration);
    }
    
    // Función global para remover toast
    window.removeToast = function(toastId) {
        const toast = $(`#${toastId}`);
        if (toast.length) {
            toast.css('transform', 'translateX(100%)');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    };

    // ============================================================================
    // TOOLTIPS Y AYUDAS
    // ============================================================================
    
    function initializeTooltips() {
        // Tooltips simples
        $(document).on('mouseenter', '[data-tooltip]', function() {
            const element = $(this);
            const tooltipText = element.data('tooltip');
            
            if (!tooltipText) return;
            
            const tooltip = $(`
                <div class="tooltip" style="
                    position: absolute;
                    background: rgba(0, 0, 0, 0.9);
                    color: white;
                    padding: 0.5rem 0.75rem;
                    border-radius: var(--eco-radius-s);
                    font-size: 0.875rem;
                    z-index: 1000;
                    pointer-events: none;
                    white-space: nowrap;
                ">${tooltipText}</div>
            `);
            
            $('body').append(tooltip);
            
            const rect = element[0].getBoundingClientRect();
            tooltip.css({
                top: rect.top - tooltip.outerHeight() - 5,
                left: rect.left + (rect.width / 2) - (tooltip.outerWidth() / 2)
            });
            
            element.data('tooltip-element', tooltip);
        });
        
        $(document).on('mouseleave', '[data-tooltip]', function() {
            const tooltipElement = $(this).data('tooltip-element');
            if (tooltipElement) {
                tooltipElement.remove();
                $(this).removeData('tooltip-element');
            }
        });
    }

    // ============================================================================
    // ANIMACIONES
    // ============================================================================
    
    function initializeAnimations() {
        // Intersection Observer para animaciones de entrada
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                        animationObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '50px'
            });
            
            // Observar elementos que deben animarse
            document.querySelectorAll('.product-card, .benefit-card, .stat-card').forEach(el => {
                animationObserver.observe(el);
            });
        }
        
        // Scroll suave para enlaces internos
        $(document).on('click', 'a[href^="#"]', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });
    }

    // ============================================================================
    // UTILIDADES
    // ============================================================================
    
    // Debounce function
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }
    
    // Formatear precio
    function formatPrice(price) {
        return new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(price);
    }
    
    // Validar email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // ============================================================================
    // EVENTOS GLOBALES
    // ============================================================================
    
    // Manejar errores de JavaScript
    window.addEventListener('error', function(e) {
        console.error('Error de JavaScript:', e.error);
        // Opcional: reportar errores a servicio de monitoreo
    });
    
    // Optimización de performance
    $(window).on('scroll', debounce(function() {
        // Aquí se pueden agregar funciones que dependan del scroll
    }, 100));
    
    // Exposer funciones globales necesarias
    window.EcoHierbas = {
        addToCart: addToCart,
        removeFromCart: removeFromCart,
        showToast: showToast,
        updateCartContent: updateCartContent,
        formatPrice: formatPrice
    };

})(jQuery);