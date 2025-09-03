/**
 * Utilidades JavaScript
 */
(function($) {
    'use strict';

    window.EcoHierbas = window.EcoHierbas || {};

    EcoHierbas.validation = {
        isValidEmail: function(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        },

        isValidRUT: function(rut) {
            if (!rut || typeof rut !== 'string') return false;
            const cleanRUT = rut.replace(/[^0-9kK]/g, '');
            if (cleanRUT.length < 2) return false;
            
            const body = cleanRUT.slice(0, -1);
            const dv = cleanRUT.slice(-1).toLowerCase();
            
            let sum = 0;
            let multiplier = 2;
            
            for (let i = body.length - 1; i >= 0; i--) {
                sum += parseInt(body[i]) * multiplier;
                multiplier = multiplier === 7 ? 2 : multiplier + 1;
            }
            
            const calculatedDV = 11 - (sum % 11);
            const finalDV = calculatedDV === 11 ? '0' : calculatedDV === 10 ? 'k' : calculatedDV.toString();
            
            return dv === finalDV;
        }
    };

    EcoHierbas.format = {
        price: function(amount, currency = 'CLP') {
            if (currency === 'CLP') {
                return '$' + new Intl.NumberFormat('es-CL').format(amount);
            }
            return amount;
        },

        rut: function(rut) {
            if (!rut) return '';
            const cleanRUT = rut.replace(/[^0-9kK]/g, '');
            if (cleanRUT.length < 2) return rut;
            
            const body = cleanRUT.slice(0, -1);
            const dv = cleanRUT.slice(-1);
            const formattedBody = body.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            
            return formattedBody + '-' + dv;
        }
    };

    EcoHierbas.storage = {
        set: function(key, value) {
            try {
                localStorage.setItem('ecohierbas_' + key, JSON.stringify(value));
                return true;
            } catch (e) {
                console.warn('No se pudo guardar en localStorage:', e);
                return false;
            }
        },

        get: function(key, defaultValue = null) {
            try {
                const item = localStorage.getItem('ecohierbas_' + key);
                return item ? JSON.parse(item) : defaultValue;
            } catch (e) {
                console.warn('No se pudo leer de localStorage:', e);
                return defaultValue;
            }
        }
    };

    EcoHierbas.notify = {
        success: function(message, duration = 3000) {
            this.show(message, 'success', duration);
        },

        error: function(message, duration = 5000) {
            this.show(message, 'error', duration);
        },

        show: function(message, type = 'info', duration = 3000) {
            const notification = $(`
                <div class="notification notification-${type}">
                    <span class="notification-message">${message}</span>
                    <button class="notification-close">&times;</button>
                </div>
            `);

            if (!$('#notifications-container').length) {
                $('body').append('<div id="notifications-container"></div>');
            }

            $('#notifications-container').append(notification);

            setTimeout(() => {
                notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, duration);

            notification.find('.notification-close').on('click', () => {
                notification.fadeOut(300, function() {
                    $(this).remove();
                });
            });
        }
    };

})(jQuery);