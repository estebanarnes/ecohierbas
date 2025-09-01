import { useCart } from "@/contexts/CartContext";
import { Button } from "@/components/ui/button";
import { Sheet, SheetContent, SheetHeader, SheetTitle } from "@/components/ui/sheet";
import { Separator } from "@/components/ui/separator";
import { Badge } from "@/components/ui/badge";
import { 
  XMarkIcon, 
  PlusIcon, 
  MinusIcon, 
  ShoppingBagIcon,
  TrashIcon 
} from "@heroicons/react/24/outline";
import { CreditCard, Building, Smartphone, DollarSign } from "lucide-react";
import { Link } from "react-router-dom";

const CartSidebar = () => {
  const { state, updateQuantity, removeItem, closeCart, clearCart } = useCart();

  if (state.items.length === 0) {
    return (
      <Sheet open={state.isOpen} onOpenChange={closeCart}>
        <SheetContent side="right" className="w-full sm:w-96">
          <SheetHeader>
            <SheetTitle className="flex items-center gap-2">
              <ShoppingBagIcon className="w-5 h-5" />
              Carrito de Compras
            </SheetTitle>
          </SheetHeader>
          
          <div className="flex flex-col items-center justify-center h-96 text-center">
            <ShoppingBagIcon className="w-16 h-16 text-muted-foreground mb-4" />
            <h3 className="text-lg font-semibold text-foreground mb-2">
              Tu carrito está vacío
            </h3>
            <p className="text-muted-foreground mb-6">
              Agrega algunos productos para comenzar
            </p>
            <Button asChild className="bg-primary hover:bg-primary/90">
              <Link to="/productos">Continuar Comprando</Link>
            </Button>
          </div>
        </SheetContent>
      </Sheet>
    );
  }

  return (
    <Sheet open={state.isOpen} onOpenChange={closeCart}>
      <SheetContent side="right" className="w-full sm:w-96 flex flex-col">
        <SheetHeader>
          <div className="flex items-center justify-center mb-2">
            <div className="inline-flex items-center gap-3 bg-primary/10 text-primary px-5 py-2 rounded-full text-sm font-medium">
              <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Envíos a todo Chile
            </div>
          </div>
          <SheetTitle className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <ShoppingBagIcon className="w-5 h-5" />
              Carrito de Compras
              <Badge variant="secondary">{state.totalItems}</Badge>
            </div>
            <Button
              variant="ghost"
              size="sm"
              onClick={clearCart}
              className="text-muted-foreground hover:text-destructive"
            >
              <TrashIcon className="w-4 h-4" />
            </Button>
          </SheetTitle>
        </SheetHeader>

        <div className="flex-1 overflow-y-auto py-4">
          <div className="space-y-4">
            {state.items.map((item) => (
              <div key={item.id} className="flex gap-3 p-3 rounded-lg border border-border">
                <img
                  src={item.image}
                  alt={item.name}
                  className="w-16 h-16 object-cover rounded-md"
                />
                
                <div className="flex-1 min-w-0">
                  <h4 className="text-sm font-medium text-foreground truncate">
                    {item.name}
                  </h4>
                  <p className="text-xs text-muted-foreground mb-2">
                    {item.category}
                  </p>
                  
                  <div className="flex items-center justify-between">
                    <div className="flex items-center gap-2">
                      <Button
                        variant="outline"
                        size="icon"
                        className="w-6 h-6"
                        onClick={() => updateQuantity(item.id, item.quantity - 1)}
                      >
                        <MinusIcon className="w-3 h-3" />
                      </Button>
                      <span className="text-sm font-medium w-8 text-center">
                        {item.quantity}
                      </span>
                      <Button
                        variant="outline"
                        size="icon"
                        className="w-6 h-6"
                        onClick={() => updateQuantity(item.id, item.quantity + 1)}
                      >
                        <PlusIcon className="w-3 h-3" />
                      </Button>
                    </div>
                    
                    <Button
                      variant="ghost"
                      size="icon"
                      className="w-6 h-6 text-muted-foreground hover:text-destructive"
                      onClick={() => removeItem(item.id)}
                    >
                      <XMarkIcon className="w-3 h-3" />
                    </Button>
                  </div>
                </div>
                
                <div className="text-right">
                  <p className="text-sm font-semibold text-primary">
                    ${(item.price * item.quantity).toLocaleString('es-CL')}
                  </p>
                  {item.originalPrice && (
                    <p className="text-xs text-muted-foreground line-through">
                      ${(item.originalPrice * item.quantity).toLocaleString('es-CL')}
                    </p>
                  )}
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="border-t border-border pt-4 space-y-4">
          <div className="space-y-2">
            <div className="flex justify-between text-sm">
              <span className="text-muted-foreground">Subtotal:</span>
              <span className="font-medium">
                ${state.totalPrice.toLocaleString('es-CL')}
              </span>
            </div>
            <div className="flex justify-between text-sm">
              <span className="text-muted-foreground">Envío:</span>
              <span className="text-green-600">Gratis</span>
            </div>
            <Separator />
            <div className="flex justify-between font-semibold">
              <span>Total:</span>
              <span className="text-primary">
                ${state.totalPrice.toLocaleString('es-CL')}
              </span>
            </div>
          </div>

          {/* Payment Methods */}
          <div className="mb-4">
            <p className="text-xs text-muted-foreground mb-2 text-center">Métodos de pago disponibles:</p>
            <div className="flex justify-center items-center gap-3 flex-wrap">
              <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                <div className="w-10 h-6 bg-white rounded border flex items-center justify-center p-1">
                  <img src="/lovable-uploads/debcd0d7-6515-4ff4-bb07-d5bc28e6bff9.png" alt="Visa" className="w-full h-full object-contain" />
                </div>
              </div>
              <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                <div className="w-10 h-6 bg-gradient-to-r from-red-500 to-orange-400 rounded text-white text-[7px] font-bold flex items-center justify-center">
                  MC
                </div>
              </div>
              <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                <div className="w-10 h-6 bg-red-600 rounded text-white text-[6px] font-bold flex items-center justify-center">
                  <Smartphone className="w-3 h-3" />
                </div>
              </div>
              <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                <div className="w-10 h-6 bg-green-600 rounded text-white text-[7px] font-bold flex items-center justify-center">
                  <CreditCard className="w-3 h-3" />
                </div>
              </div>
              <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                <div className="w-10 h-6 bg-gray-600 rounded text-white text-[6px] font-bold flex items-center justify-center">
                  <Building className="w-3 h-3" />
                </div>
              </div>
            </div>
          </div>

          <div className="space-y-2">
            <Button className="w-full bg-primary hover:bg-primary/90">
              Finalizar Compra
            </Button>
            <Button 
              asChild
              variant="outline" 
              className="w-full"
            >
              <Link to="/productos">Continuar Comprando</Link>
            </Button>
          </div>
        </div>
      </SheetContent>
    </Sheet>
  );
};

export default CartSidebar;