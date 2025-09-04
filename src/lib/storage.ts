// Wrapper estándar para localStorage
const STORAGE_PREFIX = 'ecohierbas_';

export const storage = {
  set: <T>(key: string, value: T): boolean => {
    try {
      localStorage.setItem(STORAGE_PREFIX + key, JSON.stringify(value));
      return true;
    } catch (e) {
      console.warn('No se pudo guardar en localStorage:', e);
      return false;
    }
  },

  get: <T>(key: string, defaultValue: T | null = null): T | null => {
    try {
      const item = localStorage.getItem(STORAGE_PREFIX + key);
      return item ? JSON.parse(item) : defaultValue;
    } catch (e) {
      console.warn('No se pudo leer de localStorage:', e);
      return defaultValue;
    }
  },

  remove: (key: string): boolean => {
    try {
      localStorage.removeItem(STORAGE_PREFIX + key);
      return true;
    } catch (e) {
      console.warn('No se pudo eliminar de localStorage:', e);
      return false;
    }
  },

  clear: (): boolean => {
    try {
      // Solo eliminar claves que empiecen con nuestro prefijo
      Object.keys(localStorage).forEach(key => {
        if (key.startsWith(STORAGE_PREFIX)) {
          localStorage.removeItem(key);
        }
      });
      return true;
    } catch (e) {
      console.warn('No se pudo limpiar localStorage:', e);
      return false;
    }
  }
};