import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter, CardHeader } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { StarIcon, ShoppingCartIcon } from "@heroicons/react/24/solid";
import { EyeIcon } from "@heroicons/react/24/outline";
import { useCart } from "@/contexts/CartContext";
import { toast } from "sonner";
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import ProductDetailModal from "@/components/ProductDetailModal";
import { formatPrice } from "@/lib/utils";
import { useFeaturedProducts } from "@/hooks/useProducts";
import { Product } from "@/services/wordpress";

const FeaturedProducts = () => {
  const { addItem, openCart } = useCart();
  const navigate = useNavigate();
  const [selectedProduct, setSelectedProduct] = useState<Product | null>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  
  const { products, loading, error } = useFeaturedProducts(3);

  if (loading) {
    return (
      <section className="pt-10 pb-20 bg-background">
        <div className="u-container">
          <div className="text-center">
            <div className="animate-pulse">
              <div className="h-8 bg-muted rounded w-64 mx-auto mb-4"></div>
              <div className="h-4 bg-muted rounded w-96 mx-auto"></div>
            </div>
          </div>
        </div>
      </section>
    );
  }

  if (error) {
    return (
      <section className="pt-10 pb-20 bg-background">
        <div className="u-container">
          <div className="text-center">
            <p className="text-muted-foreground">Error al cargar productos destacados</p>
          </div>
        </div>
      </section>
    );
  }
  const handleViewProduct = (product: Product) => {
    setSelectedProduct(product);
    setIsModalOpen(true);
  };
  
  const handleAddToCart = (product: Product) => {
    addItem({
      id: product.id,
      name: product.name,
      slug: product.slug,
      price: product.price,
      originalPrice: product.originalPrice || undefined,
      image: product.image,
      category: product.category,
      inStock: product.inStock
    });
    toast.success(`${product.name} agregado al carrito`, {
      action: {
        label: "Ver Carrito",
        onClick: () => openCart()
      }
    });
  };
  return <section className="pt-10 pb-20 bg-background">
      <div className="u-container">
        {/* Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <Badge className="-mt-10 mb-4 bg-accent/10 text-accent border-accent/20 my-10 mx-10">
            Productos Destacados
          </Badge>
          <h2 className="text-3xl md:text-4xl font-serif font-bold mb-4 text-slate-950">
            Nuestros productos más valorados
          </h2>
          <p className="text-lg text-muted-foreground">
            Descubre los productos que más eligen nuestros clientes para cuidar su salud 
            y contribuir al medio ambiente.
          </p>
        </div>

        {/* Products Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 max-w-4xl mx-auto justify-items-center">
          {products.map(product => (
            <Card key={product.id} className="group hover:shadow-lg transition-all duration-300 border-border/50 hover:border-primary/20 overflow-hidden">
              <CardHeader className="p-0 relative">
                <div className="relative overflow-hidden">
                  <img src={product.image} alt={product.name} className="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                  
                  {/* Stock Status */}
                  <Badge className={`absolute top-3 left-3 ${product.inStock ? "bg-green-100 text-green-800 border-green-200" : "bg-red-100 text-red-800 border-red-200"}`}>
                    {product.inStock ? "En Stock" : "Agotado"}
                  </Badge>

                  {/* Quick Actions */}
                  <div className="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 space-y-2">
                    <Button size="icon" variant="secondary" className="w-8 h-8">
                      <EyeIcon className="w-4 h-4" />
                    </Button>
                  </div>
                </div>
              </CardHeader>

              <CardContent className="p-6">
                <div className="mb-2">
                  <Badge variant="outline" className="text-xs">
                    {product.category}
                  </Badge>
                </div>
                
                <h3 className="font-semibold text-lg text-foreground mb-2 line-clamp-2">
                  {product.name}
                </h3>
                
                <p className="text-sm text-muted-foreground mb-4 line-clamp-2">
                  {product.description}
                </p>

                {/* Rating */}
                <div className="flex items-center gap-2 mb-4">
                  <div className="flex items-center">
                    {[...Array(5)].map((_, i) => <StarIcon key={i} className={`w-4 h-4 ${i < Math.floor(product.rating) ? "text-yellow-400 fill-current" : "text-gray-300"}`} />)}
                  </div>
                  <span className="text-sm font-medium">{product.rating}</span>
                  <span className="text-sm text-muted-foreground">
                    ({product.reviews})
                  </span>
                </div>

                {/* Price */}
                <div className="flex items-center gap-2 mb-4">
                  <span className="text-xl font-bold text-primary">
                    {formatPrice(product.price)}
                  </span>
                  {product.originalPrice && <span className="text-sm text-muted-foreground line-through">
                      {formatPrice(product.originalPrice)}
                    </span>}
                </div>
              </CardContent>

              <CardFooter className="p-6 pt-0">
                <div className="flex gap-2 w-full">
                  <Button 
                    className="flex-1 bg-primary hover:bg-primary/90" 
                    disabled={!product.inStock}
                    onClick={() => handleAddToCart(product)}
                  >
                    <ShoppingCartIcon className="w-4 h-4 mr-2" />
                    Agregar
                  </Button>
                  <Button variant="outline" className="px-4" onClick={() => handleViewProduct(product)}>
                    Ver
                  </Button>
                </div>
              </CardFooter>
            </Card>
          ))}
        </div>

        {/* CTA */}
        <div className="text-center">
          <Button size="lg" variant="outline" className="px-8" onClick={() => navigate('/productos')}>
            Ver Todos los Productos
          </Button>
        </div>
      </div>

      {/* Product Detail Modal */}
      <ProductDetailModal product={selectedProduct} isOpen={isModalOpen} onClose={() => setIsModalOpen(false)} />
    </section>;
};
export default FeaturedProducts;