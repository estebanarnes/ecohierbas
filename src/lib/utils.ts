import { clsx, type ClassValue } from "clsx"
import { twMerge } from "tailwind-merge"
import { CURRENCY, LOCALE } from "./cartTypes"

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

// Función de formato de precio unificada - EXACTA misma implementación que WordPress
export const formatPrice = (price: number): string => {
  return new Intl.NumberFormat(LOCALE, {
    style: 'currency',
    currency: CURRENCY,
    minimumFractionDigits: 0
  }).format(price);
};
