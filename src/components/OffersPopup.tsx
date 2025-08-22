import { useState, useEffect } from "react";
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { XMarkIcon, GiftIcon } from "@heroicons/react/24/outline";
import productosHierbas from "@/assets/productos-hierbas.jpg";

interface OffersPopupProps {
  isOpen: boolean;
  onClose: () => void;
}

const OffersPopup = ({ isOpen, onClose }: OffersPopupProps) => {
  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent 
        className="max-w-md mx-auto p-0 overflow-hidden"
        data-popup="ofertas"
      >
        {/* Close button */}
        <button
          onClick={onClose}
          className="absolute top-4 right-4 z-10 bg-white/90 rounded-full p-1 hover:bg-white transition-colors"
        >
          <XMarkIcon className="w-4 h-4" />
        </button>

        <div className="relative">
          {/* Header Image */}
          <div className="relative h-32 bg-gradient-to-r from-primary to-accent overflow-hidden">
            <div className="absolute inset-0 bg-black/20"></div>
            <img
              src={productosHierbas}
              alt="Oferta especial EcoHierbas"
              className="w-full h-full object-cover mix-blend-overlay"
            />
            <div className="absolute inset-0 flex items-center justify-center">
              <div className="text-center text-white">
                <GiftIcon className="w-8 h-8 mx-auto mb-2" />
                <Badge className="bg-accent text-accent-foreground">
                  Oferta Especial
                </Badge>
              </div>
            </div>
          </div>

          {/* Content */}
          <div className="p-6">
            <DialogHeader className="text-center mb-4">
              <DialogTitle className="text-2xl font-serif font-bold text-foreground">
                ¡Bienvenido a EcoHierbas!
              </DialogTitle>
              <DialogDescription className="text-muted-foreground">
                Obtén un 25% de descuento en tu primera compra
              </DialogDescription>
            </DialogHeader>

            <div className="space-y-4">
              <div className="bg-primary/5 rounded-lg p-4 text-center border border-primary/20">
                <div className="text-3xl font-bold text-primary mb-1">25% OFF</div>
                <div className="text-sm text-muted-foreground">
                  En productos seleccionados
                </div>
                <div className="text-xs text-muted-foreground mt-2">
                  Código: <span className="font-mono font-bold">BIENVENIDO25</span>
                </div>
              </div>

              <div className="text-center text-sm text-muted-foreground">
                ✅ Válido para hierbas medicinales<br />
                ✅ Envío gratis en compras sobre $30.000<br />
                ✅ Solo para nuevos clientes
              </div>

              <div className="space-y-3">
                <Button 
                  size="lg" 
                  className="w-full bg-primary hover:bg-primary/90"
                  onClick={onClose}
                >
                  Explorar Productos
                </Button>
                <Button 
                  size="lg" 
                  variant="outline" 
                  className="w-full"
                  onClick={onClose}
                >
                  Cotización B2B
                </Button>
              </div>

              <div className="text-center">
                <button
                  onClick={onClose}
                  className="text-xs text-muted-foreground hover:text-foreground transition-colors"
                >
                  No mostrar de nuevo
                </button>
              </div>
            </div>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
};

export default OffersPopup;