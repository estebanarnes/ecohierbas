// Funciones de validación unificadas
export const validation = {
  isValidEmail: (email: string): boolean => {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  },

  isValidRUT: (rut: string): boolean => {
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
  },

  formatRUT: (rut: string): string => {
    if (!rut) return '';
    const cleanRUT = rut.replace(/[^0-9kK]/g, '');
    if (cleanRUT.length < 2) return rut;
    
    const body = cleanRUT.slice(0, -1);
    const dv = cleanRUT.slice(-1);
    const formattedBody = body.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
    return formattedBody + '-' + dv;
  }
};