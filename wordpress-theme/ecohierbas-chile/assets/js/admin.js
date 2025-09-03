/**
 * EcoHierbas Admin Scripts
 * Scripts para el panel de administración
 */

const EcoHierbasAdmin = {
    init() {
        this.bindEvents();
        this.initThemeOptions();
    },

    bindEvents() {
        // Guardar opciones del tema
        const saveButton = document.querySelector('#submit');
        if (saveButton) {
            saveButton.addEventListener('click', this.saveThemeOptions.bind(this));
        }

        // Preview logo
        const logoInput = document.querySelector('#custom_logo');
        if (logoInput) {
            logoInput.addEventListener('change', this.previewLogo.bind(this));
        }
    },

    initThemeOptions() {
        // Verificar configuración inicial
        this.checkThemeSetup();
    },

    saveThemeOptions(e) {
        e.preventDefault();
        
        const form = e.target.closest('form');
        const formData = new FormData(form);
        
        // Mostrar loading
        this.showLoading(e.target);
        
        fetch(ECOHIERBAS_ADMIN.ajaxUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.showNotice('Configuración guardada correctamente', 'success');
            } else {
                this.showNotice('Error al guardar la configuración', 'error');
            }
        })
        .catch(() => {
            this.showNotice('Error de conexión', 'error');
        })
        .finally(() => {
            this.hideLoading(e.target);
        });
    },

    previewLogo(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const preview = document.querySelector('#logo-preview');
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            };
            reader.readAsDataURL(file);
        }
    },

    checkThemeSetup() {
        // Verificar que WooCommerce esté instalado
        if (typeof woocommerce_admin_meta_boxes === 'undefined') {
            this.showNotice('Recomendamos instalar WooCommerce para funcionalidad completa', 'warning');
        }
        
        // Verificar que las páginas necesarias existan
        this.checkRequiredPages();
    },

    checkRequiredPages() {
        const requiredPages = ['shop', 'cart', 'checkout', 'my-account'];
        
        fetch(ECOHIERBAS_ADMIN.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'check_required_pages',
                nonce: ECOHIERBAS_ADMIN.nonce
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                this.showNotice('Algunas páginas requeridas no están configuradas', 'warning');
            }
        });
    },

    showLoading(button) {
        button.disabled = true;
        button.innerHTML = 'Guardando...';
        button.classList.add('loading');
    },

    hideLoading(button) {
        button.disabled = false;
        button.innerHTML = 'Guardar cambios';
        button.classList.remove('loading');
    },

    showNotice(message, type = 'info') {
        const noticesContainer = document.querySelector('.wrap h1');
        if (!noticesContainer) return;

        const notice = document.createElement('div');
        const noticeClass = type === 'success' ? 'notice-success' : 'notice-error';
        notice.className = `notice ${noticeClass} is-dismissible`;
        notice.innerHTML = `<p>${message}</p>`;

        noticesContainer.after(notice);

        // Auto dismiss after 5 seconds
        setTimeout(() => {
            notice.remove();
        }, 5000);
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    EcoHierbasAdmin.init();
});