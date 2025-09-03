import { Card, CardContent, CardFooter, CardHeader } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { StarIcon, ShoppingCartIcon, EyeIcon } from "@heroicons/react/24/solid";

interface Product {
  id: number;
  name: string;
  slug: string;
  category: string;
  finalidad: string | null;
  price: number;
  originalPrice: number | null;
  image: string;
  rating: number;
  reviews: number;
  inStock: boolean;
  description: string;
}

interface ProductCardProps {
  product: Product;
  onAddToCart: (product: Product) => void;
  onViewProduct: (product: Product) => void;
  isMobile?: boolean;
}

const ProductCard = ({ product, onAddToCart, onViewProduct, isMobile = false }: ProductCardProps) => {
  return (
    <Card 
      className={`group hover:shadow-lg transition-all duration-300 border-border/50 hover:border-primary/20 overflow-hidden ${
        isMobile ? 'w-full max-w-sm mx-auto' : ''
      }`}
    >
      <CardHeader className="p-0 relative">
        <div className="relative overflow-hidden">
          <img
            src={product.image}
            alt={product.name}
            className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          
          {/* Stock Status */}
          <Badge 
            className={`absolute top-3 left-3 ${
              product.inStock 
                ? "bg-green-100 text-green-800 border-green-200" 
                : "bg-red-100 text-red-800 border-red-200"
            }`}
          >
            {product.inStock ? "En Stock" : "Agotado"}
          </Badge>

          {/* Quick Actions */}
          <div className="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <Button 
              size="icon" 
              variant="secondary" 
              className="w-8 h-8"
              onClick={() => onViewProduct(product)}
            >
              <EyeIcon className="w-4 h-4" />
            </Button>
          </div>
        </div>
      </CardHeader>

      <CardContent className="p-4">
        <div className={isMobile ? "mb-3" : "mb-2"}>
          <Badge variant="outline" className="text-xs">
            {product.category}
          </Badge>
          {product.finalidad && (
            <Badge variant="outline" className="text-xs ml-2">
              {product.finalidad}
            </Badge>
          )}
        </div>
        
        <h3 className={`font-semibold text-foreground mb-2 line-clamp-2 ${
          isMobile ? 'text-sm leading-tight min-h-[2.5rem]' : 'text-base'
        }`}>
          {product.name}
        </h3>
        
        <p className={`text-muted-foreground mb-3 line-clamp-2 ${
          isMobile ? 'text-sm leading-relaxed' : 'text-xs'
        }`}>
          {product.description}
        </p>

        {/* Rating */}
        <div className="flex items-center gap-1 mb-3">
          <div className="flex items-center">
            {[...Array(5)].map((_, i) => (
              <StarIcon
                key={i}
                className={`w-3 h-3 ${
                  i < Math.floor(product.rating)
                    ? "text-yellow-400 fill-current"
                    : "text-gray-300"
                }`}
              />
            ))}
          </div>
          <span className="text-sm font-medium">{product.rating}</span>
          <span className="text-sm text-muted-foreground">
            ({product.reviews})
          </span>
        </div>

        {/* Price */}
        <div className="flex items-center gap-2">
          <span className={`font-bold text-primary ${
            isMobile ? 'text-xl' : 'text-lg'
          }`}>
            ${product.price.toLocaleString('es-CL')}
          </span>
          {product.originalPrice && (
            <span className="text-sm text-muted-foreground line-through">
              ${product.originalPrice.toLocaleString('es-CL')}
            </span>
          )}
        </div>
      </CardContent>

      <CardFooter className="p-4 pt-0">
        <div className="flex gap-3 w-full">
          <Button 
            className="flex-1 bg-primary hover:bg-primary/90"
            disabled={!product.inStock}
            onClick={() => onAddToCart(product)}
          >
            <ShoppingCartIcon className="w-4 h-4 mr-2" />
            Agregar
          </Button>
          <Button 
            variant="outline" 
            className="px-4"
            onClick={() => onViewProduct(product)}
          >
            Ver
          </Button>
        </div>
      </CardFooter>
    </Card>
  );
};

export default ProductCard;