<?php
/**
 * B2B Quote Modal
 * Modal para cotizaciones corporativas
 */
?>

<!-- B2B Quote Modal -->
<div id="b2b-quote-modal" class="u-modal-overlay hidden" aria-hidden="true">
    <div class="u-modal-content max-w-4xl" role="dialog" aria-labelledby="b2b-modal-title" aria-describedby="b2b-modal-description">
        <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-primary to-primary/80 text-white p-8 text-center relative">
                <button class="modal-close absolute top-4 right-4 text-white hover:text-white/80 transition-colors" 
                        aria-label="<?php esc_attr_e('Cerrar modal', 'ecohierbas'); ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                
                <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 text-sm font-medium mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <?php esc_html_e('Cotización Corporativa', 'ecohierbas'); ?>
                </div>
                
                <h2 id="b2b-modal-title" class="text-3xl font-serif font-bold mb-2">
                    <?php esc_html_e('Solicita tu Cotización B2B', 'ecohierbas'); ?>
                </h2>
                <p id="b2b-modal-description" class="text-lg text-white/90">
                    <?php esc_html_e('Precios especiales para empresas y compras al por mayor', 'ecohierbas'); ?>
                </p>
            </div>

            <!-- Modal Content -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <!-- Form -->
                    <div>
                        <form id="b2b-quote-form" class="space-y-6" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
                            <?php wp_nonce_field('ecohierbas_b2b_quote_nonce', 'b2b_quote_nonce'); ?>
                            <input type="hidden" name="action" value="ecohierbas_b2b_quote_form">
                            
                            <!-- Company Info -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-foreground mb-4">
                                    <?php esc_html_e('Información de la Empresa', 'ecohierbas'); ?>
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="b2b-company-name" class="block text-sm font-medium text-foreground mb-2">
                                            <?php esc_html_e('Nombre de la Empresa *', 'ecohierbas'); ?>
                                        </label>
                                        <input type="text" 
                                               id="b2b-company-name" 
                                               name="company_name" 
                                               class="u-input w-full" 
                                               required>
                                    </div>
                                    <div>
                                        <label for="b2b-industry" class="block text-sm font-medium text-foreground mb-2">
                                            <?php esc_html_e('Sector/Industria *', 'ecohierbas'); ?>
                                        </label>
                                        <select id="b2b-industry" name="industry" class="u-input w-full" required>
                                            <option value=""><?php esc_html_e('Seleccionar sector', 'ecohierbas'); ?></option>
                                            <option value="retail"><?php esc_html_e('Retail/Comercio', 'ecohierbas'); ?></option>
                                            <option value="horeca"><?php esc_html_e('Hoteles/Restaurantes', 'ecohierbas'); ?></option>
                                            <option value="farmacia"><?php esc_html_e('Farmacias/Salud', 'ecohierbas'); ?></option>
                                            <option value="distribuidor"><?php esc_html_e('Distribuidor', 'ecohierbas'); ?></option>
                                            <option value="agricultura"><?php esc_html_e('Agricultura/Agroindustria', 'ecohierbas'); ?></option>
                                            <option value="otros"><?php esc_html_e('Otros', 'ecohierbas'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="b2b-company-size" class="block text-sm font-medium text-foreground mb-2">
                                        <?php esc_html_e('Tamaño de la Empresa', 'ecohierbas'); ?>
                                    </label>
                                    <select id="b2b-company-size" name="company_size" class="u-input w-full">
                                        <option value=""><?php esc_html_e('Seleccionar tamaño', 'ecohierbas'); ?></option>
                                        <option value="1-10"><?php esc_html_e('1-10 empleados', 'ecohierbas'); ?></option>
                                        <option value="11-50"><?php esc_html_e('11-50 empleados', 'ecohierbas'); ?></option>
                                        <option value="51-200"><?php esc_html_e('51-200 empleados', 'ecohierbas'); ?></option>
                                        <option value="201+"><?php esc_html_e('Más de 200 empleados', 'ecohierbas'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <!-- Contact Person -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-foreground mb-4 pt-4 border-t border-border">
                                    <?php esc_html_e('Persona de Contacto', 'ecohierbas'); ?>
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="b2b-contact-name" class="block text-sm font-medium text-foreground mb-2">
                                            <?php esc_html_e('Nombre Completo *', 'ecohierbas'); ?>
                                        </label>
                                        <input type="text" 
                                               id="b2b-contact-name" 
                                               name="contact_name" 
                                               class="u-input w-full" 
                                               required>
                                    </div>
                                    <div>
                                        <label for="b2b-position" class="block text-sm font-medium text-foreground mb-2">
                                            <?php esc_html_e('Cargo', 'ecohierbas'); ?>
                                        </label>
                                        <input type="text" 
                                               id="b2b-position" 
                                               name="position" 
                                               class="u-input w-full">
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="b2b-email" class="block text-sm font-medium text-foreground mb-2">
                                            <?php esc_html_e('Email Corporativo *', 'ecohierbas'); ?>
                                        </label>
                                        <input type="email" 
                                               id="b2b-email" 
                                               name="email" 
                                               class="u-input w-full" 
                                               required>
                                    </div>
                                    <div>
                                        <label for="b2b-phone" class="block text-sm font-medium text-foreground mb-2">
                                            <?php esc_html_e('Teléfono *', 'ecohierbas'); ?>
                                        </label>
                                        <input type="tel" 
                                               id="b2b-phone" 
                                               name="phone" 
                                               class="u-input w-full" 
                                               required>
                                    </div>
                                </div>
                            </div>

                            <!-- Requirements -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-foreground mb-4 pt-4 border-t border-border">
                                    <?php esc_html_e('Requerimientos', 'ecohierbas'); ?>
                                </h3>
                                
                                <div>
                                    <label for="b2b-products" class="block text-sm font-medium text-foreground mb-2">
                                        <?php esc_html_e('Productos de Interés *', 'ecohierbas'); ?>
                                    </label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="products[]" value="hierbas-medicinales" class="rounded">
                                            <span class="text-sm"><?php esc_html_e('Hierbas Medicinales', 'ecohierbas'); ?></span>
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="products[]" value="infusiones" class="rounded">
                                            <span class="text-sm"><?php esc_html_e('Infusiones', 'ecohierbas'); ?></span>
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="products[]" value="vermicompostaje" class="rounded">
                                            <span class="text-sm"><?php esc_html_e('Vermicompostaje', 'ecohierbas'); ?></span>
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="products[]" value="kits-cultivo" class="rounded">
                                            <span class="text-sm"><?php esc_html_e('Kits de Cultivo', 'ecohierbas'); ?></span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="b2b-volume" class="block text-sm font-medium text-foreground mb-2">
                                        <?php esc_html_e('Volumen Estimado Mensual', 'ecohierbas'); ?>
                                    </label>
                                    <select id="b2b-volume" name="volume" class="u-input w-full">
                                        <option value=""><?php esc_html_e('Seleccionar volumen', 'ecohierbas'); ?></option>
                                        <option value="100-500"><?php esc_html_e('100-500 unidades', 'ecohierbas'); ?></option>
                                        <option value="500-1000"><?php esc_html_e('500-1,000 unidades', 'ecohierbas'); ?></option>
                                        <option value="1000-5000"><?php esc_html_e('1,000-5,000 unidades', 'ecohierbas'); ?></option>
                                        <option value="5000+"><?php esc_html_e('Más de 5,000 unidades', 'ecohierbas'); ?></option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="b2b-message" class="block text-sm font-medium text-foreground mb-2">
                                        <?php esc_html_e('Detalles Adicionales', 'ecohierbas'); ?>
                                    </label>
                                    <textarea id="b2b-message" 
                                              name="message" 
                                              rows="4" 
                                              class="u-input w-full" 
                                              placeholder="<?php esc_attr_e('Especifica productos específicos, cantidades, plazos de entrega, etc.', 'ecohierbas'); ?>"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="u-btn u-btn--primary w-full">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                <?php esc_html_e('Solicitar Cotización', 'ecohierbas'); ?>
                            </button>
                        </form>
                    </div>

                    <!-- Benefits -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-foreground">
                            <?php esc_html_e('Beneficios Corporativos', 'ecohierbas'); ?>
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start gap-3 p-4 bg-primary/5 rounded-lg">
                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-foreground"><?php esc_html_e('Precios Preferenciales', 'ecohierbas'); ?></h4>
                                    <p class="text-sm text-muted-foreground"><?php esc_html_e('Descuentos por volumen de hasta 30%', 'ecohierbas'); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3 p-4 bg-primary/5 rounded-lg">
                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-foreground"><?php esc_html_e('Logística Especializada', 'ecohierbas'); ?></h4>
                                    <p class="text-sm text-muted-foreground"><?php esc_html_e('Entregas programadas y envío gratis desde $50.000', 'ecohierbas'); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3 p-4 bg-primary/5 rounded-lg">
                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-foreground"><?php esc_html_e('Soporte Dedicado', 'ecohierbas'); ?></h4>
                                    <p class="text-sm text-muted-foreground"><?php esc_html_e('Ejecutivo de cuenta exclusivo y soporte técnico', 'ecohierbas'); ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3 p-4 bg-primary/5 rounded-lg">
                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-foreground"><?php esc_html_e('Certificaciones', 'ecohierbas'); ?></h4>
                                    <p class="text-sm text-muted-foreground"><?php esc_html_e('Documentación completa y certificados orgánicos', 'ecohierbas'); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center gap-2 text-yellow-800 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span class="font-medium"><?php esc_html_e('Respuesta Rápida', 'ecohierbas'); ?></span>
                            </div>
                            <p class="text-sm text-yellow-700">
                                <?php esc_html_e('Te responderemos en menos de 24 horas con una cotización personalizada.', 'ecohierbas'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>