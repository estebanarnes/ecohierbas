/*!
 * EcoHierbas Chile - Admin JavaScript
 * Scripts para el panel de administración
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Inicializar funcionalidades del admin
        EcoHierbasAdmin.init();
    });

    const EcoHierbasAdmin = {
        init: function() {
            this.bindEvents();
            this.initComponents();
        },

        bindEvents: function() {
            // Guardar configuraciones con AJAX
            $('#ecohierbas-settings-form').on('submit', this.saveSettings);
            
            // Tabs de navegación
            $('.ecohierbas-nav-tab').on('click', this.switchTab);
            
            // Media uploader para imágenes
            $('.ecohierbas-upload-button').on('click', this.openMediaUploader);
        },

        initComponents: function() {
            // Inicializar tooltips
            $('.ecohierbas-tooltip').tooltip();
            
            // Inicializar sortable para elementos arrastrables
            $('.ecohierbas-sortable').sortable({
                handle: '.sort-handle',
                update: function(event, ui) {
                    EcoHierbasAdmin.updateOrder();
                }
            });
        },

        saveSettings: function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $submitButton = $form.find('input[type="submit"]');
            const originalText = $submitButton.val();
            
            // Mostrar estado de carga
            $submitButton.val('Guardando...').prop('disabled', true);
            
            // Enviar datos via AJAX
            $.ajax({
                url: ECOHIERBAS_ADMIN.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ecohierbas_save_settings',
                    nonce: ECOHIERBAS_ADMIN.nonce,
                    form_data: $form.serialize()
                },
                success: function(response) {
                    if (response.success) {
                        EcoHierbasAdmin.showNotice('Configuración guardada correctamente', 'success');
                    } else {
                        EcoHierbasAdmin.showNotice('Error al guardar la configuración', 'error');
                    }
                },
                error: function() {
                    EcoHierbasAdmin.showNotice('Error de conexión', 'error');
                },
                complete: function() {
                    $submitButton.val(originalText).prop('disabled', false);
                }
            });
        },

        switchTab: function(e) {
            e.preventDefault();
            
            const $tab = $(this);
            const targetTab = $tab.data('tab');
            
            // Actualizar navegación
            $('.ecohierbas-nav-tab').removeClass('nav-tab-active');
            $tab.addClass('nav-tab-active');
            
            // Mostrar contenido correspondiente
            $('.ecohierbas-tab-content').hide();
            $('#ecohierbas-tab-' + targetTab).show();
        },

        openMediaUploader: function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const targetInput = $button.data('target');
            
            // Crear media uploader
            const mediaUploader = wp.media({
                title: 'Seleccionar imagen',
                button: {
                    text: 'Usar esta imagen'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                $(targetInput).val(attachment.url);
                $button.siblings('.image-preview').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto;">');
            });
            
            mediaUploader.open();
        },

        updateOrder: function() {
            const order = $('.ecohierbas-sortable').sortable('toArray', {
                attribute: 'data-id'
            });
            
            $.ajax({
                url: ECOHIERBAS_ADMIN.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ecohierbas_update_order',
                    nonce: ECOHIERBAS_ADMIN.nonce,
                    order: order
                },
                success: function(response) {
                    if (response.success) {
                        EcoHierbasAdmin.showNotice('Orden actualizado', 'success');
                    }
                }
            });
        },

        showNotice: function(message, type) {
            const noticeClass = type === 'success' ? 'notice-success' : 'notice-error';
            const $notice = $('<div class="notice ' + noticeClass + ' is-dismissible"><p>' + message + '</p></div>');
            
            $('.ecohierbas-admin-wrap').prepend($notice);
            
            // Auto-remover después de 3 segundos
            setTimeout(function() {
                $notice.fadeOut(function() {
                    $(this).remove();
                });
            }, 3000);
        }
    };

})(jQuery);