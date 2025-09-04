import { clsx, type ClassValue } from "clsx"
import { twMerge } from "tailwind-merge"

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

// Constantes para formateo de precio
export const CURRENCY = 'CLP';
export const LOCALE = 'es-CL';

// Función de formato de precio unificada - EXACTA misma implementación que WordPress
export const formatPrice = (price: number): string => {
  return new Intl.NumberFormat(LOCALE, {
    style: 'currency',
    currency: CURRENCY,
    minimumFractionDigits: 0
  }).format(price);
};
