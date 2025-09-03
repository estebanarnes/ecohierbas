/**
 * Funcionalidad del carrito - EcoHierbas Chile
 * Maneja añadir/quitar productos, actualizar cantidades, persistencia
 */

class EcoHierbasCart {
  constructor() {
    this.items = [];
    this.isOpen = false;
    this.sidebar = null;
    this.overlay = null;
    this.toast = null;
    
    this.init();
  }

  init() {
    this.sidebar = EcoHierbas.DOM.$('#cart-sidebar');
    this.overlay = EcoHierbas.DOM.$('#cart-overlay');
    this.toast = EcoHierbas.DOM.$('#cart-toast');
    
    if (!this.sidebar) {
      console.warn('Cart sidebar not found');
      return;
    }

    this.loadCart();
    this.bindEvents();
    this.updateUI();
  }

  bindEvents() {
    // Toggle carrito desde header
    EcoHierbas.DOM.$$('[data-cart-toggle]').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        this.toggle();
      });
    });

    // Cerrar carrito
    const closeBtn = EcoHierbas.DOM.$('#close-cart');
    if (closeBtn) {
      closeBtn.addEventListener('click', () => this.close());
    }

    // Cerrar con overlay
    if (this.overlay) {
      this.overlay.addEventListener('click', () => this.close());
    }

    // Cerrar con ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isOpen) {
        this.close();
      }
    });

    // Continuar comprando
    EcoHierbas.DOM.$$('#continue-shopping, #continue-shopping-footer').forEach(btn => {
      btn.addEventListener('click', () => this.close());
    });

    // Vaciar carrito
    const clearBtn = EcoHierbas.DOM.$('#clear-cart');
    if (clearBtn) {
      clearBtn.addEventListener('click', () => this.clear());
    }

    // Botones añadir al carrito
    document.addEventListener('click', (e) => {
      if (e.target.matches('.add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
        e.preventDefault();
        const btn = e.target.closest('.add-to-cart-btn');
        const productId = btn.dataset.productId;
        const productName = btn.dataset.productName;
        
        if (productId) {
          this.addItem(productId, 1, { name: productName });
        }
      }
    });

    // Toast actions
    if (this.toast) {
      const toastAction = EcoHierbas.DOM.$('#cart-toast-action', this.toast);
      const toastClose = EcoHierbas.DOM.$('#cart-toast-close', this.toast);
      
      toastAction?.addEventListener('click', () => {
        this.hideToast();
        this.open();
      });
      
      toastClose?.addEventListener('click', () => this.hideToast());
    }

    // Eventos del carrito
    EcoHierbas.EventBus.on('cart:updated', () => this.updateUI());
  }

  async addItem(productId, quantity = 1, productData = {}) {
    try {
      // Mostrar loading en el botón
      const btn = EcoHierbas.DOM.$(`[data-product-id="${productId}"]`);
      if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Agregando...';
      }

      // Llamada AJAX a WooCommerce
      const response = await fetch(ecohierbas_ajax.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'ecohierbas_add_to_cart',
          product_id: productId,
          quantity: quantity,
          nonce: ecohierbas_ajax.nonce
        })
      });

      const result = await response.json();

      if (result.success) {
        // Actualizar items locales
        const existingItem = this.items.find(item => item.id === productId);
        
        if (existingItem) {
          existingItem.quantity += quantity;
        } else {
          this.items.push({
            id: productId,
            quantity: quantity,
            ...productData,
            ...result.data.product
          });
        }

        this.saveCart();
        this.updateUI();
        
        // Mostrar toast
        this.showToast(`${productData.name || 'Producto'} agregado al carrito`);
        
        // Emitir evento
        EcoHierbas.EventBus.emit('cart:add', { productId, quantity });
        
        // Anunciar a lectores de pantalla
        EcoHierbas.A11y.announce(`${productData.name || 'Producto'} agregado al carrito`);
        
      } else {
        throw new Error(result.data || 'Error al agregar producto');
      }

    } catch (error) {
      console.error('Error adding to cart:', error);
      this.showToast('Error al agregar producto', 'error');
    } finally {
      // Restaurar botón
      if (btn) {
        btn.disabled = false;
        btn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M7 13h10m-10 6h10"></path></svg>Agregar';
      }
    }
  }

  async removeItem(productId) {
    try {
      const response = await fetch(ecohierbas_ajax.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'ecohierbas_remove_from_cart',
          product_id: productId,
          nonce: ecohierbas_ajax.nonce
        })
      });

      const result = await response.json();

      if (result.success) {
        this.items = this.items.filter(item => item.id !== productId);
        this.saveCart();
        this.updateUI();
        
        EcoHierbas.EventBus.emit('cart:remove', { productId });
        EcoHierbas.A11y.announce('Producto eliminado del carrito');
      }

    } catch (error) {
      console.error('Error removing from cart:', error);
    }
  }

  async updateQuantity(productId, quantity) {
    if (quantity <= 0) {
      return this.removeItem(productId);
    }

    try {
      const response = await fetch(ecohierbas_ajax.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'ecohierbas_update_cart_quantity',
          product_id: productId,
          quantity: quantity,
          nonce: ecohierbas_ajax.nonce
        })
      });

      const result = await response.json();

      if (result.success) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
          item.quantity = quantity;
          this.saveCart();
          this.updateUI();
          
          EcoHierbas.EventBus.emit('cart:update', { productId, quantity });
        }
      }

    } catch (error) {
      console.error('Error updating quantity:', error);
    }
  }

  async clear() {
    if (!confirm('¿Estás seguro de que quieres vaciar el carrito?')) {
      return;
    }

    try {
      const response = await fetch(ecohierbas_ajax.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'ecohierbas_clear_cart',
          nonce: ecohierbas_ajax.nonce
        })
      });

      const result = await response.json();

      if (result.success) {
        this.items = [];
        this.saveCart();
        this.updateUI();
        
        EcoHierbas.EventBus.emit('cart:clear');
        EcoHierbas.A11y.announce('Carrito vaciado');
      }

    } catch (error) {
      console.error('Error clearing cart:', error);
    }
  }

  updateUI() {
    this.updateCartCount();
    this.updateCartItems();
    this.updateCartTotals();
    this.toggleEmptyState();
  }

  updateCartCount() {
    const count = this.items.reduce((total, item) => total + item.quantity, 0);
    
    // Actualizar badges del carrito
    EcoHierbas.DOM.$$('[data-cart-count]').forEach(badge => {
      badge.textContent = count;
      badge.style.display = count > 0 ? 'inline-flex' : 'none';
    });

    // Badge específico del sidebar
    const sidebarBadge = EcoHierbas.DOM.$('#cart-items-badge');
    if (sidebarBadge) {
      sidebarBadge.textContent = count;
    }
  }

  updateCartItems() {
    const container = EcoHierbas.DOM.$('#cart-items-list');
    if (!container) return;

    container.innerHTML = '';

    this.items.forEach(item => {
      const itemElement = this.createCartItemElement(item);
      container.appendChild(itemElement);
    });
  }

  createCartItemElement(item) {
    const template = EcoHierbas.DOM.$('#cart-item-template');
    if (!template) return EcoHierbas.DOM.createElement('div');

    const clone = template.content.cloneNode(true);
    const element = clone.querySelector('div');

    // Imagen
    const img = clone.querySelector('img');
    if (img && item.image) {
      img.src = item.image;
      img.alt = item.name;
    }

    // Nombre y precio
    const title = clone.querySelector('h4');
    if (title) title.textContent = item.name;

    const description = clone.querySelector('p');
    if (description) description.textContent = EcoHierbas.Currency.format(item.price);

    // Cantidad
    const quantityDisplay = clone.querySelector('.quantity-display');
    if (quantityDisplay) quantityDisplay.textContent = item.quantity;

    // Precio total
    const priceDisplay = clone.querySelector('.price-display');
    if (priceDisplay) {
      priceDisplay.textContent = EcoHierbas.Currency.format(item.price * item.quantity);
    }

    // Botones de cantidad
    const minusBtn = clone.querySelector('.quantity-minus');
    const plusBtn = clone.querySelector('.quantity-plus');
    const removeBtn = clone.querySelector('.remove-item');

    if (minusBtn) {
      minusBtn.addEventListener('click', () => {
        this.updateQuantity(item.id, item.quantity - 1);
      });
    }

    if (plusBtn) {
      plusBtn.addEventListener('click', () => {
        this.updateQuantity(item.id, item.quantity + 1);
      });
    }

    if (removeBtn) {
      removeBtn.addEventListener('click', () => {
        this.removeItem(item.id);
      });
    }

    return element;
  }

  updateCartTotals() {
    const subtotal = this.items.reduce((total, item) => {
      return total + (item.price * item.quantity);
    }, 0);

    const subtotalElement = EcoHierbas.DOM.$('#cart-subtotal');
    const totalElement = EcoHierbas.DOM.$('#cart-total');

    if (subtotalElement) {
      subtotalElement.textContent = EcoHierbas.Currency.format(subtotal);
    }

    if (totalElement) {
      totalElement.textContent = EcoHierbas.Currency.format(subtotal); // Sin envío por ahora
    }
  }

  toggleEmptyState() {
    const isEmpty = this.items.length === 0;
    
    const emptyCart = EcoHierbas.DOM.$('#empty-cart');
    const cartItems = EcoHierbas.DOM.$('#cart-items');
    const cartFooter = EcoHierbas.DOM.$('#cart-footer');

    if (emptyCart) emptyCart.style.display = isEmpty ? 'flex' : 'none';
    if (cartItems) cartItems.style.display = isEmpty ? 'none' : 'block';
    if (cartFooter) cartFooter.style.display = isEmpty ? 'none' : 'block';
  }

  open() {
    if (!this.sidebar) return;

    this.isOpen = true;
    
    // Mostrar overlay y sidebar
    if (this.overlay) {
      this.overlay.classList.remove('hidden');
      this.overlay.style.opacity = '1';
    }
    
    this.sidebar.classList.remove('translate-x-full');
    this.sidebar.setAttribute('aria-hidden', 'false');
    
    // Focus trap
    this.focusTrap = EcoHierbas.A11y.createFocusTrap(this.sidebar);
    this.focusTrap.activate();
    
    // Bloquear scroll del body
    document.body.style.overflow = 'hidden';
    
    EcoHierbas.EventBus.emit('cart:open');
  }

  close() {
    if (!this.sidebar) return;

    this.isOpen = false;
    
    // Ocultar sidebar y overlay
    this.sidebar.classList.add('translate-x-full');
    this.sidebar.setAttribute('aria-hidden', 'true');
    
    if (this.overlay) {
      this.overlay.style.opacity = '0';
      setTimeout(() => {
        this.overlay.classList.add('hidden');
      }, 300);
    }
    
    // Restaurar scroll del body
    document.body.style.overflow = '';
    
    // Limpiar focus trap
    if (this.focusTrap) {
      this.focusTrap.deactivate();
      this.focusTrap = null;
    }
    
    EcoHierbas.EventBus.emit('cart:close');
  }

  toggle() {
    if (this.isOpen) {
      this.close();
    } else {
      this.open();
    }
  }

  showToast(message, type = 'success') {
    if (!this.toast) return;

    const messageEl = EcoHierbas.DOM.$('#cart-toast-message', this.toast);
    if (messageEl) {
      messageEl.textContent = message;
    }

    // Mostrar toast
    this.toast.classList.remove('translate-x-full');
    
    // Auto-ocultar después de 3 segundos
    setTimeout(() => {
      this.hideToast();
    }, 3000);
  }

  hideToast() {
    if (!this.toast) return;
    this.toast.classList.add('translate-x-full');
  }

  saveCart() {
    EcoHierbas.Storage.set('ecohierbas_cart', this.items);
  }

  loadCart() {
    this.items = EcoHierbas.Storage.get('ecohierbas_cart', []);
  }
}

// Inicializar carrito cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  window.EcoHierbasCartInstance = new EcoHierbasCart();
});