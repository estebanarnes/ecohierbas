/**
 * EcoHierbas Cart Functionality
 * Migración desde CartContext.tsx para mantener funcionalidad idéntica
 */

class EcoHierbasCart {
    constructor() {
        this.cart = this.getCartFromStorage();
        this.sidebar = null;
        this.cartCount = 0;
        this.init();
    }

    init() {
        this.initElements();
        this.bindEvents();
        this.updateCartDisplay();
        this.initWooCommerceIntegration();
    }

    initElements() {
        this.sidebar = document.getElementById('cart-sidebar');
        this.trigger = document.querySelector('[data-cart-trigger]');
        this.closeBtn = document.getElementById('close-cart');
        this.cartItems = document.getElementById('cart-items-list');
        this.cartTotal = document.getElementById('cart-total');
        this.cartCount = document.querySelector('[data-cart-count]');
        this.clearCartBtn = document.getElementById('clear-cart');
        this.checkoutBtn = document.querySelector('a[href*="checkout"]');
        this.emptyCart = document.getElementById('empty-cart');
        this.cartFooter = document.getElementById('cart-footer');
    }

    bindEvents() {
        // Abrir/cerrar sidebar
        if (this.trigger) {
            this.trigger.addEventListener('click', (e) => {
                e.preventDefault();
                this.openCart();
            });
        }

        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => {
                this.closeCart();
            });
        }

        // Cerrar con ESC o click fuera
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isCartOpen()) {
                this.closeCart();
            }
        });

        if (this.sidebar) {
            this.sidebar.addEventListener('click', (e) => {
                if (e.target === this.sidebar) {
                    this.closeCart();
                }
            });
        }

        // Limpiar carrito
        if (this.clearCartBtn) {
            this.clearCartBtn.addEventListener('click', () => {
                this.clearCart();
            });
        }

        // Checkout
        if (this.checkoutBtn) {
            this.checkoutBtn.addEventListener('click', () => {
                this.goToCheckout();
            });
        }

        // Escuchar eventos de WooCommerce
        document.addEventListener('added_to_cart', (e) => {
            this.handleWooCommerceAdd(e.detail);
        });

        document.addEventListener('removed_from_cart', (e) => {
            this.handleWooCommerceRemove(e.detail);
        });
    }

    // Gestión del carrito
    addItem(product) {
        const existingItem = this.cart.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.cart.push({
                ...product,
                quantity: 1
            });
        }

        this.saveCartToStorage();
        this.updateCartDisplay();
        this.showAddedNotification(product);
    }

    removeItem(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.saveCartToStorage();
        this.updateCartDisplay();
    }

    updateQuantity(productId, quantity) {
        const item = this.cart.find(item => item.id === productId);
        
        if (item) {
            if (quantity <= 0) {
                this.removeItem(productId);
            } else {
                item.quantity = quantity;
                this.saveCartToStorage();
                this.updateCartDisplay();
            }
        }
    }

    clearCart() {
        this.cart = [];
        this.saveCartToStorage();
        this.updateCartDisplay();
        
        if (window.EcoHierbas && window.EcoHierbas.showNotification) {
            window.EcoHierbas.showNotification('Carrito vaciado');
        }
    }

    // Gestión de la UI
    openCart() {
        if (this.sidebar) {
            this.sidebar.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    closeCart() {
        if (this.sidebar) {
            this.sidebar.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    isCartOpen() {
        return this.sidebar && this.sidebar.classList.contains('open');
    }

    updateCartDisplay() {
        this.updateCartCount();
        this.updateCartItems();
        this.updateCartTotal();
    }

    updateCartCount() {
        const totalItems = this.cart.reduce((sum, item) => sum + item.quantity, 0);
        
        if (this.cartCount) {
            this.cartCount.textContent = totalItems;
            this.cartCount.style.display = totalItems > 0 ? 'flex' : 'none';
        }
    }

    updateCartItems() {
        if (!this.cartItems) return;

        if (this.cart.length === 0) {
            this.cartItems.innerHTML = this.getEmptyCartHTML();
            return;
        }

        const itemsHTML = this.cart.map(item => this.getCartItemHTML(item)).join('');
        this.cartItems.innerHTML = itemsHTML;

        // Bind events para los controles de cantidad
        this.bindQuantityControls();
    }

    updateCartTotal() {
        if (!this.cartTotal) return;

        const total = this.cart.reduce((sum, item) => {
            return sum + (item.price * item.quantity);
        }, 0);

        this.cartTotal.textContent = this.formatPrice(total);
    }

    bindQuantityControls() {
        // Botones de aumentar cantidad
        const increaseButtons = this.cartItems.querySelectorAll('[data-quantity-increase]');
        increaseButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = parseInt(button.dataset.productId);
                const currentItem = this.cart.find(item => item.id === productId);
                if (currentItem) {
                    this.updateQuantity(productId, currentItem.quantity + 1);
                }
            });
        });

        // Botones de disminuir cantidad
        const decreaseButtons = this.cartItems.querySelectorAll('[data-quantity-decrease]');
        decreaseButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = parseInt(button.dataset.productId);
                const currentItem = this.cart.find(item => item.id === productId);
                if (currentItem) {
                    this.updateQuantity(productId, currentItem.quantity - 1);
                }
            });
        });

        // Botones de eliminar
        const removeButtons = this.cartItems.querySelectorAll('[data-remove-item]');
        removeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = parseInt(button.dataset.productId);
                this.removeItem(productId);
            });
        });
    }

    // HTML Templates
    getEmptyCartHTML() {
        return `
            <div class="text-center py-8">
                <svg class="w-16 h-16 mx-auto mb-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"/>
                </svg>
                <h3 class="text-lg font-semibold text-foreground mb-2">Tu carrito está vacío</h3>
                <p class="text-muted-foreground mb-4">Agrega algunos productos para comenzar</p>
                <a href="/productos" class="u-btn u-btn--primary">Ver Productos</a>
            </div>
        `;
    }

    getCartItemHTML(item) {
        return `
            <div class="flex items-center gap-4 p-4 border-b border-border">
                <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded">
                <div class="flex-1">
                    <h4 class="font-medium text-foreground">${item.name}</h4>
                    <p class="text-sm text-muted-foreground">${item.category}</p>
                    <div class="flex items-center gap-2 mt-2">
                        <button 
                            data-quantity-decrease 
                            data-product-id="${item.id}"
                            class="w-8 h-8 rounded border border-border flex items-center justify-center hover:bg-muted">
                            -
                        </button>
                        <span class="px-2 py-1 bg-muted rounded text-sm">${item.quantity}</span>
                        <button 
                            data-quantity-increase 
                            data-product-id="${item.id}"
                            class="w-8 h-8 rounded border border-border flex items-center justify-center hover:bg-muted">
                            +
                        </button>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-foreground">${this.formatPrice(item.price * item.quantity)}</p>
                    <button 
                        data-remove-item 
                        data-product-id="${item.id}"
                        class="text-xs text-destructive hover:underline mt-1">
                        Eliminar
                    </button>
                </div>
            </div>
        `;
    }

    // Integración con WooCommerce
    initWooCommerceIntegration() {
        // Agregar productos desde botones WooCommerce
        const addToCartButtons = document.querySelectorAll('.add_to_cart_button');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                // WooCommerce manejará la funcionalidad AJAX
                // Nosotros solo actualizamos la UI
                this.showLoadingState(button);
            });
        });
    }

    handleWooCommerceAdd(data) {
        if (data && data.product) {
            this.addItem({
                id: data.product.id,
                name: data.product.name,
                price: data.product.price,
                image: data.product.image,
                category: data.product.category,
                slug: data.product.slug
            });
        }
    }

    handleWooCommerceRemove(data) {
        if (data && data.product_id) {
            this.removeItem(data.product_id);
        }
    }

    showLoadingState(button) {
        button.classList.add('loading');
        button.disabled = true;
        
        setTimeout(() => {
            button.classList.remove('loading');
            button.disabled = false;
        }, 1000);
    }

    // Funciones auxiliares
    showAddedNotification(product) {
        if (window.EcoHierbas && window.EcoHierbas.showNotification) {
            window.EcoHierbas.showNotification(
                `${product.name} agregado al carrito`,
                'success'
            );
        }
    }

    // REMOVIDO: formatPrice duplicado - usar EcoHierbas.formatPrice centralizado
    formatPrice(price) {
        return EcoHierbas.formatPrice(price);
    }

    goToCheckout() {
        if (this.cart.length > 0) {
            window.location.href = '/checkout';
        }
    }

    // Storage unificado - usar EcoHierbas.storage
    getCartFromStorage() {
        return EcoHierbas.storage.get('cart', []);
    }

    saveCartToStorage() {
        EcoHierbas.storage.set('cart', this.cart);
    }

    // API pública
    getCart() {
        return [...this.cart];
    }

    getTotalPrice() {
        return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    }

    getTotalItems() {
        return this.cart.reduce((sum, item) => sum + item.quantity, 0);
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.EcoHierbasCart = new EcoHierbasCart();
});

// Exponer métodos globalmente para compatibilidad
window.addToCart = function(product) {
    if (window.EcoHierbasCart) {
        window.EcoHierbasCart.addItem(product);
    }
};

window.openCart = function() {
    if (window.EcoHierbasCart) {
        window.EcoHierbasCart.openCart();
    }
};