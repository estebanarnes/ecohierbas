<?php
/**
 * Modal B2B Quote
 */
?>
<div id="b2b-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
    <div id="b2b-modal-backdrop" class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative bg-background rounded-lg max-w-2xl w-full max-h-[90vh] overflow-hidden">
        <div class="p-8 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-serif font-bold text-foreground">Cotización Empresarial</h2>
                <button id="close-b2b-modal" class="p-2 text-muted-foreground hover:text-foreground transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="b2b-form" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="company-name" class="block text-sm font-medium text-foreground mb-2">Nombre de la Empresa *</label>
                        <input type="text" id="company-name" name="company_name" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label for="company-rut" class="block text-sm font-medium text-foreground mb-2">RUT de la Empresa *</label>
                        <input type="text" id="company-rut" name="company_rut" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label for="contact-email" class="block text-sm font-medium text-foreground mb-2">Email *</label>
                    <input type="email" id="contact-email" name="contact_email" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label for="products-interest" class="block text-sm font-medium text-foreground mb-2">Productos de Interés *</label>
                    <textarea id="products-interest" name="products_interest" rows="3" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                </div>
                <div class="flex gap-4">
                    <button type="button" id="cancel-b2b" class="u-btn u-btn--outline flex-1">Cancelar</button>
                    <button type="submit" id="submit-b2b" class="u-btn u-btn--primary flex-1">Enviar Cotización</button>
                </div>
            </form>
        </div>
    </div>
</div>