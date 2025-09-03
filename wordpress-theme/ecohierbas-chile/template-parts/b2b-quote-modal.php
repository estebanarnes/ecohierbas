<?php
/**
 * Template Part: B2B Quote Modal
 * Modal para cotizaciones B2B empresariales
 */
?>

<!-- B2B Quote Modal -->
<div id="b2b-quote-modal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden" aria-hidden="true">
    <div class="bg-background rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="b2b-modal-title">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-border">
            <h2 id="b2b-modal-title" class="text-2xl font-serif font-bold text-foreground">
                <?php esc_html_e('Cotización B2B Empresarial', 'ecohierbas'); ?>
            </h2>
            <button class="modal-close w-8 h-8 flex items-center justify-center rounded-full hover:bg-muted transition-colors" aria-label="<?php esc_attr_e('Cerrar modal', 'ecohierbas'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            <p class="text-muted-foreground mb-6">
                <?php esc_html_e('Solicita una cotización personalizada para tu empresa. Ofrecemos descuentos especiales por volumen y planes de entrega adaptados a tus necesidades.', 'ecohierbas'); ?>
            </p>

            <!-- B2B Form -->
            <form id="b2b-quote-form" class="space-y-6">
                <!-- Company Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="b2b-company-name" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Nombre de la Empresa', 'ecohierbas'); ?> *
                        </label>
                        <input type="text" 
                               id="b2b-company-name" 
                               name="company_name"
                               class="u-input w-full" 
                               required>
                    </div>
                    <div>
                        <label for="b2b-industry" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Rubro/Industria', 'ecohierbas'); ?>
                        </label>
                        <select id="b2b-industry" name="industry" class="u-input w-full">
                            <option value=""><?php esc_html_e('Seleccionar rubro', 'ecohierbas'); ?></option>
                            <option value="retail"><?php esc_html_e('Retail/Comercio', 'ecohierbas'); ?></option>
                            <option value="hospitality"><?php esc_html_e('Hotelería/Restaurantes', 'ecohierbas'); ?></option>
                            <option value="education"><?php esc_html_e('Educación', 'ecohierbas'); ?></option>
                            <option value="healthcare"><?php esc_html_e('Salud/Bienestar', 'ecohierbas'); ?></option>
                            <option value="agriculture"><?php esc_html_e('Agricultura', 'ecohierbas'); ?></option>
                            <option value="corporate"><?php esc_html_e('Corporativo', 'ecohierbas'); ?></option>
                            <option value="other"><?php esc_html_e('Otro', 'ecohierbas'); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Contact Person -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="b2b-contact-name" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Nombre del Contacto', 'ecohierbas'); ?> *
                        </label>
                        <input type="text" 
                               id="b2b-contact-name" 
                               name="contact_name"
                               class="u-input w-full" 
                               required>
                    </div>
                    <div>
                        <label for="b2b-position" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Cargo/Posición', 'ecohierbas'); ?>
                        </label>
                        <input type="text" 
                               id="b2b-position" 
                               name="position"
                               class="u-input w-full">
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="b2b-email" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Email Empresarial', 'ecohierbas'); ?> *
                        </label>
                        <input type="email" 
                               id="b2b-email" 
                               name="email"
                               class="u-input w-full" 
                               required>
                    </div>
                    <div>
                        <label for="b2b-phone" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Teléfono', 'ecohierbas'); ?>
                        </label>
                        <input type="tel" 
                               id="b2b-phone" 
                               name="phone"
                               class="u-input w-full" 
                               placeholder="+56 9 xxxx xxxx">
                    </div>
                </div>

                <!-- Products of Interest -->
                <div>
                    <label class="block text-sm font-medium text-foreground mb-3">
                        <?php esc_html_e('Productos de Interés', 'ecohierbas'); ?> *
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="products[]" value="infusions" class="mr-2">
                            <span class="text-sm"><?php esc_html_e('Infusiones y Hierbas Medicinales', 'ecohierbas'); ?></span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="products[]" value="vermicompost" class="mr-2">
                            <span class="text-sm"><?php esc_html_e('Sistemas de Vermicompostaje', 'ecohierbas'); ?></span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="products[]" value="planters" class="mr-2">
                            <span class="text-sm"><?php esc_html_e('Maceteros y Contenedores', 'ecohierbas'); ?></span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="products[]" value="kits" class="mr-2">
                            <span class="text-sm"><?php esc_html_e('Kits de Cultivo', 'ecohierbas'); ?></span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="products[]" value="workshops" class="mr-2">
                            <span class="text-sm"><?php esc_html_e('Talleres Corporativos', 'ecohierbas'); ?></span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="products[]" value="consulting" class="mr-2">
                            <span class="text-sm"><?php esc_html_e('Consultoría Sustentable', 'ecohierbas'); ?></span>
                        </label>
                    </div>
                </div>

                <!-- Volume and Frequency -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="b2b-volume" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Volumen Estimado', 'ecohierbas'); ?>
                        </label>
                        <select id="b2b-volume" name="volume" class="u-input w-full">
                            <option value=""><?php esc_html_e('Seleccionar volumen', 'ecohierbas'); ?></option>
                            <option value="small"><?php esc_html_e('Pequeño (1-50 unidades)', 'ecohierbas'); ?></option>
                            <option value="medium"><?php esc_html_e('Mediano (51-200 unidades)', 'ecohierbas'); ?></option>
                            <option value="large"><?php esc_html_e('Grande (201-500 unidades)', 'ecohierbas'); ?></option>
                            <option value="enterprise"><?php esc_html_e('Empresarial (500+ unidades)', 'ecohierbas'); ?></option>
                        </select>
                    </div>
                    <div>
                        <label for="b2b-frequency" class="block text-sm font-medium text-foreground mb-2">
                            <?php esc_html_e('Frecuencia de Pedidos', 'ecohierbas'); ?>
                        </label>
                        <select id="b2b-frequency" name="frequency" class="u-input w-full">
                            <option value=""><?php esc_html_e('Seleccionar frecuencia', 'ecohierbas'); ?></option>
                            <option value="monthly"><?php esc_html_e('Mensual', 'ecohierbas'); ?></option>
                            <option value="quarterly"><?php esc_html_e('Trimestral', 'ecohierbas'); ?></option>
                            <option value="biannual"><?php esc_html_e('Semestral', 'ecohierbas'); ?></option>
                            <option value="annual"><?php esc_html_e('Anual', 'ecohierbas'); ?></option>
                            <option value="onetime"><?php esc_html_e('Una vez', 'ecohierbas'); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Budget Range -->
                <div>
                    <label for="b2b-budget" class="block text-sm font-medium text-foreground mb-2">
                        <?php esc_html_e('Presupuesto Estimado (CLP)', 'ecohierbas'); ?>
                    </label>
                    <select id="b2b-budget" name="budget" class="u-input w-full">
                        <option value=""><?php esc_html_e('Seleccionar rango', 'ecohierbas'); ?></option>
                        <option value="low"><?php esc_html_e('Hasta $500.000', 'ecohierbas'); ?></option>
                        <option value="medium"><?php esc_html_e('$500.000 - $2.000.000', 'ecohierbas'); ?></option>
                        <option value="high"><?php esc_html_e('$2.000.000 - $5.000.000', 'ecohierbas'); ?></option>
                        <option value="enterprise"><?php esc_html_e('Más de $5.000.000', 'ecohierbas'); ?></option>
                    </select>
                </div>

                <!-- Special Requirements -->
                <div>
                    <label for="b2b-requirements" class="block text-sm font-medium text-foreground mb-2">
                        <?php esc_html_e('Requerimientos Especiales', 'ecohierbas'); ?>
                    </label>
                    <textarea id="b2b-requirements" 
                              name="requirements" 
                              rows="4" 
                              class="u-input w-full" 
                              placeholder="<?php esc_attr_e('Describe cualquier requerimiento especial, fechas específicas, personalizaciones, etc.', 'ecohierbas'); ?>"></textarea>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" class="modal-close u-btn u-btn--outline flex-1">
                        <?php esc_html_e('Cancelar', 'ecohierbas'); ?>
                    </button>
                    <button type="submit" class="u-btn u-btn--primary flex-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <?php esc_html_e('Enviar Cotización', 'ecohierbas'); ?>
                    </button>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="bg-muted/20 px-6 py-4 text-center border-t border-border">
            <p class="text-sm text-muted-foreground">
                <?php esc_html_e('Te contactaremos dentro de 24 horas con una propuesta personalizada.', 'ecohierbas'); ?>
            </p>
        </div>
    </div>
</div>

<script>
// B2B Quote Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('b2b-quote-modal');
    const triggers = document.querySelectorAll('#b2b-quote-btn, #mobile-b2b-quote-btn, #hero-b2b-quote');
    const closeBtns = modal.querySelectorAll('.modal-close');
    const form = document.getElementById('b2b-quote-form');

    // Open modal
    triggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });
    });

    // Close modal
    closeBtns.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    // Close on overlay click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    function openModal() {
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Focus first input
        const firstInput = modal.querySelector('input');
        if (firstInput) firstInput.focus();
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        form.reset();
    }

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><?php esc_html_e("Enviando...", "ecohierbas"); ?>';

        try {
            const formData = new FormData(form);
            formData.append('action', 'ecohierbas_b2b_quote');
            formData.append('nonce', ecohierbas_ajax.nonce);

            const response = await fetch(ecohierbas_ajax.ajax_url, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert('<?php esc_html_e("¡Cotización enviada exitosamente! Te contactaremos pronto.", "ecohierbas"); ?>');
                closeModal();
            } else {
                throw new Error(result.data || '<?php esc_html_e("Error al enviar la cotización", "ecohierbas"); ?>');
            }
        } catch (error) {
            alert('<?php esc_html_e("Error al enviar la cotización. Por favor, intenta de nuevo.", "ecohierbas"); ?>');
            console.error('B2B Quote Error:', error);
        } finally {
            // Restore button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
});
</script>