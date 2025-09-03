/**
 * EcoHierbas Modals - Sistema de modales
 * Migración desde ProductDetailModal.tsx y B2BQuoteForm.tsx
 */

class EcoHierbasModals {
    constructor() {
        this.activeModal = null;
        this.focusTrap = null;
        this.previousActiveElement = null;
        this.init();
    }

    init() {
        this.bindEvents();
        this.initProductModals();
        this.initB2BModal();
    }

    bindEvents() {
        // Abrir modal de producto
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-product-modal]') || e.target.closest('[data-product-modal]')) {
                e.preventDefault();
                const button = e.target.closest('[data-product-modal]') || e.target;
                this.openProductModal(button);
            }
        });

        // Abrir modal B2B
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-b2b-modal]') || e.target.closest('[data-b2b-modal]')) {
                e.preventDefault();
                this.openB2BModal();
            }
        });

        // Cerrar modal con ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.activeModal) {
                this.closeModal();
            }
        });
    }

    initProductModals() {
        // Crear contenedor para modal de producto si no existe
        if (!document.getElementById('product-modal')) {
            const modalHTML = this.getProductModalHTML();
            document.body.insertAdjacentHTML('beforeend', modalHTML);
        }
    }

    initB2BModal() {
        // Crear contenedor para modal B2B si no existe
        if (!document.getElementById('b2b-modal')) {
            const modalHTML = this.getB2BModalHTML();
            document.body.insertAdjacentHTML('beforeend', modalHTML);
        }
    }

    openProductModal(button) {
        try {
            const productData = JSON.parse(button.dataset.product || '{}');
            this.populateProductModal(productData);
            this.showModal('product-modal');
        } catch (error) {
            console.error('Error opening product modal:', error);
        }
    }

    openB2BModal() {
        this.showModal('b2b-modal');
    }

    populateProductModal(product) {
        const modal = document.getElementById('product-modal');
        if (!modal || !product.id) return;

        // Actualizar contenido del modal
        modal.querySelector('[data-product-image]').src = product.image || '';
        modal.querySelector('[data-product-name]').textContent = product.name || '';
        modal.querySelector('[data-product-category]').textContent = product.category || '';
        modal.querySelector('[data-product-price]').textContent = this.formatPrice(product.price || 0);
        modal.querySelector('[data-product-description]').textContent = product.description || '';
        
        // Rating
        this.updateRating(modal.querySelector('[data-product-rating]'), product.rating || 0);
        
        // Configurar botón agregar al carrito
        const addToCartBtn = modal.querySelector('[data-add-to-cart]');
        if (addToCartBtn) {
            addToCartBtn.onclick = () => {
                this.addProductToCart(product);
            };
        }
    }

    addProductToCart(product) {
        if (window.EcoHierbasCart) {
            window.EcoHierbasCart.addItem(product);
            this.closeModal();
        }
    }

    showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        this.previousActiveElement = document.activeElement;
        this.activeModal = modal;

        // Mostrar modal
        modal.style.display = 'flex';
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Focus trap
        this.createFocusTrap(modal);

        // Focus primer elemento
        const firstFocusable = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (firstFocusable) {
            firstFocusable.focus();
        }
    }

    closeModal() {
        if (!this.activeModal) return;

        // Ocultar modal
        this.activeModal.style.display = 'none';
        this.activeModal.classList.remove('active');
        document.body.style.overflow = '';

        // Restaurar focus
        if (this.previousActiveElement) {
            this.previousActiveElement.focus();
        }

        // Limpiar
        this.destroyFocusTrap();
        this.activeModal = null;
        this.previousActiveElement = null;
    }

    createFocusTrap(modal) {
        const focusableElements = modal.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

        this.focusTrap = (e) => {
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        lastFocusable.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        firstFocusable.focus();
                        e.preventDefault();
                    }
                }
            }
        };

        modal.addEventListener('keydown', this.focusTrap);
    }

    destroyFocusTrap() {
        if (this.focusTrap && this.activeModal) {
            this.activeModal.removeEventListener('keydown', this.focusTrap);
            this.focusTrap = null;
        }
    }

    updateRating(container, rating) {
        if (!container) return;
        
        const stars = container.querySelectorAll('.star');
        stars.forEach((star, index) => {
            star.classList.toggle('filled', index < Math.floor(rating));
        });
    }

    formatPrice(price) {
        return new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP',
            minimumFractionDigits: 0
        }).format(price);
    }

    getProductModalHTML() {
        return `
        <div id="product-modal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/50" onclick="window.EcoHierbasModals?.closeModal()"></div>
            <div class="relative bg-background rounded-lg max-w-2xl mx-auto my-8 max-h-[90vh] overflow-y-auto">
                <button onclick="window.EcoHierbasModals?.closeModal()" 
                        class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-white/90 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <div class="p-6">
                    <div class="aspect-[4/3] mb-6">
                        <img data-product-image src="" alt="" class="w-full h-full object-cover rounded-lg">
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <span data-product-category class="text-sm text-muted-foreground"></span>
                            <h2 data-product-name class="text-2xl font-serif font-bold"></h2>
                        </div>
                        
                        <div data-product-rating class="flex items-center gap-1">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                        </div>
                        
                        <div data-product-price class="text-3xl font-bold text-primary"></div>
                        
                        <p data-product-description class="text-muted-foreground"></p>
                        
                        <button data-add-to-cart class="u-btn u-btn--primary w-full">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </div>
        `;
    }

    getB2BModalHTML() {
        return `
        <div id="b2b-modal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/50" onclick="window.EcoHierbasModals?.closeModal()"></div>
            <div class="relative bg-background rounded-lg max-w-2xl mx-auto my-8 max-h-[90vh] overflow-y-auto">
                <button onclick="window.EcoHierbasModals?.closeModal()" 
                        class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-white/90 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <div class="p-6">
                    <h2 class="text-2xl font-serif font-bold mb-6">Cotización B2B</h2>
                    
                    <form id="b2b-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Empresa</label>
                                <input type="text" name="empresa" required class="u-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Contacto</label>
                                <input type="text" name="contacto" required class="u-input">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" required class="u-input">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Teléfono</label>
                                <input type="tel" name="telefono" class="u-input">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Mensaje</label>
                            <textarea name="mensaje" rows="4" class="u-input"></textarea>
                        </div>
                        
                        <button type="submit" class="u-btn u-btn--primary w-full">
                            Enviar cotización
                        </button>
                    </form>
                </div>
            </div>
        </div>
        `;
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.EcoHierbasModals = new EcoHierbasModals();
});

// Event binding para botones
document.addEventListener('click', function(e) {
    if (e.target.matches('#hero-b2b-quote')) {
        e.preventDefault();
        if (window.EcoHierbasModals) {
            window.EcoHierbasModals.openB2BModal();
        }
    }
});