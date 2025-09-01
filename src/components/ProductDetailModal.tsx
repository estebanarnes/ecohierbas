import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { StarIcon, ShoppingCartIcon, XMarkIcon } from "@heroicons/react/24/solid";
import { HeartIcon, ShareIcon } from "@heroicons/react/24/outline";
import { useCart } from "@/contexts/CartContext";
import { toast } from "sonner";

interface Product {
  id: number;
  name: string;
  category: string;
  price: number;
  originalPrice: number | null;
  image: string;
  rating: number;
  reviews: number;
  badge: string;
  description: string;
}

interface ProductDetailModalProps {
  product: Product | null;
  isOpen: boolean;
  onClose: () => void;
}

const ProductDetailModal = ({ product, isOpen, onClose }: ProductDetailModalProps) => {
  const { addItem, openCart } = useCart();

  if (!product) return null;

  const handleAddToCart = () => {
    addItem({
      id: product.id,
      name: product.name,
      slug: product.name.toLowerCase().replace(/\s+/g, '-'),
      price: product.price,
      originalPrice: product.originalPrice || undefined,
      image: product.image,
      category: product.category,
      inStock: true,
    });

    toast.success(`${product.name} agregado al carrito`, {
      action: {
        label: "Ver Carrito",
        onClick: () => openCart(),
      },
    });
    onClose();
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto p-0">
        <div className="grid md:grid-cols-2 gap-0">
          {/* Image Section */}
          <div className="relative">
            <img
              src={product.image}
              alt={product.name}
              className="w-full h-96 md:h-full object-cover"
            />
            <Badge 
              className={`absolute top-4 left-4 ${
                product.badge === "Más Vendido" 
                  ? "bg-accent text-accent-foreground" 
                  : product.badge === "B2B Popular"
                  ? "bg-primary text-primary-foreground"
                  : "bg-secondary text-secondary-foreground"
              }`}
            >
              {product.badge}
            </Badge>
            
            <div className="absolute top-4 right-4 space-y-2">
              <Button size="icon" variant="secondary" className="w-10 h-10 rounded-full">
                <HeartIcon className="w-5 h-5" />
              </Button>
              <Button size="icon" variant="secondary" className="w-10 h-10 rounded-full">
                <ShareIcon className="w-5 h-5" />
              </Button>
            </div>
          </div>

          {/* Content Section */}
          <div className="p-8">
            <DialogHeader className="mb-6">
              <div className="flex items-center justify-between mb-2">
                <Badge variant="outline" className="text-sm">
                  {product.category}
                </Badge>
                <Button
                  variant="ghost"
                  size="icon"
                  onClick={onClose}
                  className="w-8 h-8"
                >
                  <XMarkIcon className="w-5 h-5" />
                </Button>
              </div>
              <DialogTitle className="text-2xl font-serif font-bold text-left">
                {product.name}
              </DialogTitle>
            </DialogHeader>

            {/* Rating */}
            <div className="flex items-center gap-3 mb-6">
              <div className="flex items-center">
                {[...Array(5)].map((_, i) => (
                  <StarIcon
                    key={i}
                    className={`w-5 h-5 ${
                      i < Math.floor(product.rating)
                        ? "text-yellow-400 fill-current"
                        : "text-gray-300"
                    }`}
                  />
                ))}
              </div>
              <span className="font-medium">{product.rating}</span>
              <span className="text-muted-foreground">
                ({product.reviews} reseñas)
              </span>
            </div>

            {/* Price */}
            <div className="flex items-center gap-3 mb-6">
              <span className="text-3xl font-bold text-primary">
                ${product.price.toLocaleString('es-CL')}
              </span>
              {product.originalPrice && (
                <span className="text-lg text-muted-foreground line-through">
                  ${product.originalPrice.toLocaleString('es-CL')}
                </span>
              )}
              {product.originalPrice && (
                <Badge variant="secondary" className="ml-2">
                  {Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100)}% OFF
                </Badge>
              )}
            </div>

            {/* Description */}
            <div className="mb-8">
              <h4 className="font-semibold text-lg mb-3">Descripción</h4>
              <p className="text-muted-foreground leading-relaxed">
                {product.description}
              </p>
            </div>

            {/* Features */}
            <div className="mb-8">
              <h4 className="font-semibold text-lg mb-3">Características</h4>
              <ul className="space-y-2 text-muted-foreground">
                <li className="flex items-center">
                  <span className="w-2 h-2 bg-primary rounded-full mr-3"></span>
                  100% ingredientes naturales y orgánicos
                </li>
                <li className="flex items-center">
                  <span className="w-2 h-2 bg-primary rounded-full mr-3"></span>
                  Libre de químicos y pesticidas
                </li>
                <li className="flex items-center">
                  <span className="w-2 h-2 bg-primary rounded-full mr-3"></span>
                  Empaque eco-friendly y biodegradable
                </li>
                <li className="flex items-center">
                  <span className="w-2 h-2 bg-primary rounded-full mr-3"></span>
                  Producido localmente en Chile
                </li>
              </ul>
            </div>

            {/* Actions */}
            <div className="space-y-4">
              <Button 
                className="w-full bg-primary hover:bg-primary/90 h-12"
                onClick={handleAddToCart}
              >
                <ShoppingCartIcon className="w-5 h-5 mr-3" />
                Agregar al Carrito
              </Button>
              
              <div className="grid grid-cols-2 gap-3">
                <Button variant="outline" className="h-10">
                  Añadir a Favoritos
                </Button>
                <Button variant="outline" className="h-10">
                  Compartir
                </Button>
              </div>
            </div>

            {/* Payment Methods */}
            <div className="mt-6">
              <h4 className="font-semibold text-lg mb-3">Métodos de pago disponibles</h4>
              <div className="flex justify-start items-center gap-3 flex-wrap">
                <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                  <div className="w-12 h-7 bg-white rounded border flex items-center justify-center p-1">
                    <img src="/lovable-uploads/df926a2d-1aa7-4eef-b253-2f6a979dba1c.png" alt="Visa" className="w-full h-full object-contain" />
                  </div>
                </div>
                <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                  <div className="w-12 h-7 bg-gradient-to-r from-red-500 to-orange-400 rounded text-white text-[8px] font-bold flex items-center justify-center">
                    MC
                  </div>
                </div>
                <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                  <div className="w-12 h-7 bg-white rounded border flex items-center justify-center p-1">
                    <img src="/lovable-uploads/1c0b50be-da02-4f90-aaa1-29fecf8d0af6.png" alt="WebPay" className="w-full h-full object-contain" />
                  </div>
                </div>
                <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                  <div className="w-12 h-7 bg-white rounded border flex items-center justify-center p-1">
                    <img src="/lovable-uploads/7fc26e92-13e6-452b-bb5b-1084beb96e1a.png" alt="Khipu" className="w-full h-full object-contain" />
                  </div>
                </div>
                <div className="flex flex-col items-center gap-1 text-xs text-muted-foreground">
                  <div className="w-12 h-7 bg-gray-600 rounded text-white text-[7px] font-bold flex items-center justify-center">
                    TRANSF
                  </div>
                </div>
              </div>
            </div>

            {/* Additional Info */}
            <div className="mt-8 pt-6 border-t border-border">
              <div className="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <span className="font-medium">Envío:</span>
                  <span className="text-muted-foreground ml-2">Gratis &gt; $30.000</span>
                </div>
                <div>
                  <span className="font-medium">Disponibilidad:</span>
                  <span className="text-green-600 ml-2">En Stock</span>
                </div>
                <div>
                  <span className="font-medium">SKU:</span>
                  <span className="text-muted-foreground ml-2">ECO-{product.id.toString().padStart(3, '0')}</span>
                </div>
                <div>
                  <span className="font-medium">Garantía:</span>
                  <span className="text-muted-foreground ml-2">30 días</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
};

export default ProductDetailModal;