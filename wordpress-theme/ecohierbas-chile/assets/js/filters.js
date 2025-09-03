/**
 * EcoHierbas Product Filters
 * Migración desde ProductFilters.tsx para filtrado de productos
 */

class EcoHierbasFilters {
    constructor() {
        this.filters = {
            search: '',
            category: 'all',
            finalidad: 'all',
            price_range: 'all',
            orderby: 'date'
        };
        
        this.isFiltering = false;
        this.currentPage = 1;
        this.totalPages = 1;
        
        this.init();
    }

    init() {
        if (!this.isProductPage()) return;
        
        this.parseURLParams();
        this.bindEvents();
        this.updateFilterUI();
    }

    isProductPage() {
        return document.querySelector('.woocommerce-products-header') || 
               document.querySelector('.product-grid') ||
               document.body.classList.contains('post-type-archive-product') ||
               document.body.classList.contains('tax-product_cat');
    }

    parseURLParams() {
        const urlParams = new URLSearchParams(window.location.search);
        
        this.filters.search = urlParams.get('search') || '';
        this.filters.category = urlParams.get('category') || 'all';
        this.filters.finalidad = urlParams.get('finalidad') || 'all';
        this.filters.price_range = urlParams.get('price_range') || 'all';
        this.filters.orderby = urlParams.get('orderby') || 'date';
        this.currentPage = parseInt(urlParams.get('paged')) || 1;
    }

    bindEvents() {
        // Search input
        const searchInput = document.querySelector('[data-filter="search"]');
        if (searchInput) {
            searchInput.addEventListener('input', window.EcoHierbas.Performance.debounce((e) => {
                this.setFilter('search', e.target.value);
                this.applyFilters();
            }, 500));
        }

        // Category filter
        const categorySelect = document.querySelector('[data-filter="category"]');
        if (categorySelect) {
            categorySelect.addEventListener('change', (e) => {
                this.setFilter('category', e.target.value);
                this.applyFilters();
            });
        }

        // Finalidad filter
        const finalidadSelect = document.querySelector('[data-filter="finalidad"]');
        if (finalidadSelect) {
            finalidadSelect.addEventListener('change', (e) => {
                this.setFilter('finalidad', e.target.value);
                this.applyFilters();
            });
        }

        // Price range filter
        const priceSelect = document.querySelector('[data-filter="price_range"]');
        if (priceSelect) {
            priceSelect.addEventListener('change', (e) => {
                this.setFilter('price_range', e.target.value);
                this.applyFilters();
            });
        }

        // Order by
        const orderSelect = document.querySelector('[data-filter="orderby"]');
        if (orderSelect) {
            orderSelect.addEventListener('change', (e) => {
                this.setFilter('orderby', e.target.value);
                this.applyFilters();
            });
        }

        // Pagination
        document.addEventListener('click', (e) => {
            if (e.target.matches('.page-numbers') && !e.target.matches('.current')) {
                e.preventDefault();
                const href = e.target.getAttribute('href');
                const url = new URL(href, window.location.origin);
                const page = url.searchParams.get('paged') || 1;
                this.setFilter('paged', page);
                this.applyFilters();
            }
        });

        // Clear filters
        const clearButton = document.querySelector('[data-clear-filters]');
        if (clearButton) {
            clearButton.addEventListener('click', (e) => {
                e.preventDefault();
                this.clearFilters();
            });
        }

        // Mobile filter toggle
        const mobileToggle = document.querySelector('[data-mobile-filters-toggle]');
        const mobileFilters = document.querySelector('[data-mobile-filters]');
        
        if (mobileToggle && mobileFilters) {
            mobileToggle.addEventListener('click', () => {
                mobileFilters.classList.toggle('active');
            });
        }

        // Custom event listener for filter application
        document.addEventListener('filters:applied', () => {
            if (mobileFilters) {
                mobileFilters.classList.remove('active');
            }
        });
    }

    async applyFilters() {
        if (this.isFiltering) return;
        
        this.isFiltering = true;
        this.showLoadingState();

        try {
            const params = new URLSearchParams({
                action: 'filter_products',
                nonce: ecohierbas_ajax.nonce,
                ...this.filters
            });

            const response = await fetch(ecohierbas_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: params
            });

            const result = await response.json();

            if (result.success) {
                this.updateProductGrid(result.data.html);
                this.updatePagination(result.data.pagination);
                this.updateResultsCount(result.data.total);
                this.updateURL(this.filters);
                
                // Dispatch custom event
                document.dispatchEvent(new CustomEvent('filters:applied', {
                    detail: { filters: this.filters, results: result.data }
                }));
            } else {
                console.error('Error filtering products:', result.data);
                this.showErrorState();
            }
        } catch (error) {
            console.error('Error applying filters:', error);
            this.showErrorState();
        } finally {
            this.isFiltering = false;
            this.hideLoadingState();
        }
    }

    updateProductGrid(html) {
        const productGrid = document.querySelector('.product-grid') || 
                           document.querySelector('.products') ||
                           document.querySelector('[data-products-container]');
        
        if (productGrid) {
            productGrid.innerHTML = html;
            
            // Re-initialize any necessary scripts for new products
            if (window.EcoHierbasCart) {
                window.EcoHierbasCart.updateCartDisplay();
            }
            
            // Lazy load new images
            if (window.EcoHierbas && window.EcoHierbas.Performance) {
                window.EcoHierbas.Performance.lazyLoadImages();
            }
        }
    }

    updatePagination(paginationData) {
        const paginationContainer = document.querySelector('.woocommerce-pagination') ||
                                   document.querySelector('[data-pagination]');
        
        if (paginationContainer && paginationData) {
            paginationContainer.innerHTML = paginationData.html || '';
            this.totalPages = paginationData.total_pages || 1;
            this.currentPage = paginationData.current_page || 1;
        }
    }

    updateResultsCount(total) {
        const resultsCount = document.querySelector('[data-results-count]') ||
                            document.querySelector('.woocommerce-result-count');
        
        if (resultsCount) {
            const text = total === 1 ? 
                `Mostrando 1 producto` : 
                `Mostrando ${total} productos`;
            resultsCount.textContent = text;
        }
    }

    updateURL(params) {
        const url = new URL(window.location);
        
        // Clean current params
        url.searchParams.delete('search');
        url.searchParams.delete('category');
        url.searchParams.delete('finalidad');
        url.searchParams.delete('price_range');
        url.searchParams.delete('orderby');
        url.searchParams.delete('paged');

        // Set new params
        Object.entries(params).forEach(([key, value]) => {
            if (value && value !== 'all' && value !== '' && key !== 'paged') {
                url.searchParams.set(key, value);
            }
        });

        window.history.replaceState(null, '', url.toString());
    }

    clearFilters() {
        this.filters = {
            search: '',
            category: 'all',
            finalidad: 'all',
            price_range: 'all',
            orderby: 'date'
        };
        
        this.updateFilterUI();
        this.applyFilters();
    }

    updateFilterUI() {
        // Update all filter inputs to match current filters
        Object.entries(this.filters).forEach(([key, value]) => {
            const input = document.querySelector(`[data-filter="${key}"]`);
            if (input) {
                if (input.type === 'text' || input.tagName === 'TEXTAREA') {
                    input.value = value;
                } else if (input.tagName === 'SELECT') {
                    input.value = value;
                }
            }
        });

        this.updateActiveFiltersIndicator();
    }

    updateActiveFiltersIndicator() {
        const hasActiveFilters = Object.entries(this.filters).some(([key, value]) => {
            return key !== 'orderby' && value && value !== 'all' && value !== '';
        });

        const indicator = document.querySelector('[data-active-filters]');
        const clearButton = document.querySelector('[data-clear-filters]');

        if (indicator) {
            indicator.style.display = hasActiveFilters ? 'block' : 'none';
        }

        if (clearButton) {
            clearButton.style.display = hasActiveFilters ? 'inline-flex' : 'none';
        }

        // Update filter status text
        const statusText = document.querySelector('[data-filter-status]');
        if (statusText) {
            const activeCount = Object.values(this.filters).filter(v => v && v !== 'all' && v !== '').length;
            statusText.textContent = activeCount > 0 ? 
                `${activeCount} filtro${activeCount > 1 ? 's' : ''} activo${activeCount > 1 ? 's' : ''}` :
                'Sin filtros';
        }
    }

    showLoadingState() {
        const productGrid = document.querySelector('.product-grid') || 
                           document.querySelector('.products');
        
        if (productGrid) {
            productGrid.classList.add('loading');
            productGrid.style.opacity = '0.5';
            productGrid.style.pointerEvents = 'none';
        }

        // Show loading spinner
        const loadingSpinner = document.querySelector('[data-loading-spinner]');
        if (loadingSpinner) {
            loadingSpinner.style.display = 'block';
        }
    }

    hideLoadingState() {
        const productGrid = document.querySelector('.product-grid') || 
                           document.querySelector('.products');
        
        if (productGrid) {
            productGrid.classList.remove('loading');
            productGrid.style.opacity = '';
            productGrid.style.pointerEvents = '';
        }

        // Hide loading spinner
        const loadingSpinner = document.querySelector('[data-loading-spinner]');
        if (loadingSpinner) {
            loadingSpinner.style.display = 'none';
        }
    }

    showErrorState() {
        const productGrid = document.querySelector('.product-grid') || 
                           document.querySelector('.products');
        
        if (productGrid) {
            productGrid.innerHTML = `
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold mb-2">Error al filtrar productos</h3>
                    <p class="text-muted-foreground mb-4">Ocurrió un error al aplicar los filtros. Por favor, intenta de nuevo.</p>
                    <button onclick="location.reload()" class="u-btn u-btn--primary">
                        Recargar página
                    </button>
                </div>
            `;
        }

        // Announce error to screen readers
        if (window.EcoHierbas && window.EcoHierbas.A11y) {
            window.EcoHierbas.A11y.announce('Error al filtrar productos');
        }
    }

    // Public API
    setFilter(key, value) {
        this.filters[key] = value;
        this.currentPage = 1; // Reset to first page when changing filters
    }

    getFilters() {
        return { ...this.filters };
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.EcoHierbasFilters = new EcoHierbasFilters();
});