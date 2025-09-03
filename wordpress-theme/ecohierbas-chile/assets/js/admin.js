/**
 * JavaScript del panel de administración
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        initMediaUploader();
        initColorPickers();
        initTabs();
        initAjaxForms();
    });

    function initMediaUploader() {
        $('.upload-button').on('click', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const targetInput = button.siblings('.upload-input');
            const preview = button.siblings('.upload-preview');
            
            const frame = wp.media({
                title: 'Seleccionar imagen',
                button: {
                    text: 'Usar esta imagen'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                const attachment = frame.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                
                if (preview.length) {
                    preview.html(`<img src="${attachment.url}" style="max-width: 200px; height: auto;">`);
                }
                
                button.text('Cambiar imagen');
            });
            
            frame.open();
        });
    }

    function initColorPickers() {
        if ($.fn.wpColorPicker) {
            $('.color-picker').wpColorPicker();
        }
    }

    function initTabs() {
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            
            const tab = $(this);
            const target = tab.attr('href');
            
            $('.nav-tab').removeClass('nav-tab-active');
            tab.addClass('nav-tab-active');
            
            $('.tab-content').hide();
            $(target).show();
            
            localStorage.setItem('ecohierbas_active_tab', target);
        });

        const activeTab = localStorage.getItem('ecohierbas_active_tab');
        if (activeTab && $(activeTab).length) {
            $('.nav-tab[href="' + activeTab + '"]').click();
        }
    }

    function initAjaxForms() {
        $('.ajax-form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const submitButton = form.find('[type="submit"]');
            const originalText = submitButton.text();
            
            submitButton.text('Guardando...').prop('disabled', true);
            
            const formData = new FormData(this);
            formData.append('action', form.data('action') || 'save_theme_options');
            formData.append('nonce', ecohierbas_admin.nonce);
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        showNotice('Configuración guardada correctamente', 'success');
                    } else {
                        showNotice(response.data || 'Error al guardar la configuración', 'error');
                    }
                },
                error: function() {
                    showNotice('Error de conexión. Inténtalo de nuevo.', 'error');
                },
                complete: function() {
                    submitButton.text(originalText).prop('disabled', false);
                }
            });
        });
    }

    function showNotice(message, type = 'info') {
        const notice = $(`
            <div class="notice notice-${type} is-dismissible">
                <p>${message}</p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">Descartar este aviso.</span>
                </button>
            </div>
        `);

        $('.wrap h1').first().after(notice);

        setTimeout(function() {
            notice.fadeOut();
        }, 5000);

        notice.find('.notice-dismiss').on('click', function() {
            notice.fadeOut();
        });
    }

})(jQuery);