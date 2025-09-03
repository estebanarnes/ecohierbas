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
import { useWooCommerce, useWCProductAdapter } from "@/hooks/useWooCommerce";
const FeaturedProducts = () => {
  const {
    addItem,
    openCart
  } = useCart();
  const navigate = useNavigate();
  const [selectedProduct, setSelectedProduct] = useState<any>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);

  // Usar WooCommerce para obtener productos destacados
  const {
    useFeaturedProducts
  } = useWooCommerce();
  const {
    convertWCProductToCartItem
  } = useWCProductAdapter();
  const {
    data: wcProducts,
    isLoading,
    error
  } = useFeaturedProducts();

  // Fallback a productos estáticos si no hay conexión con WooCommerce
  const fallbackProducts = [{
    id: 1,
    name: "Box Especial Mujer - Refresca tu Piel",
    category: "Infusiones",
    price: 24990,
    originalPrice: 29990,
    image: "/src/assets/productos-hierbas.jpg",
    rating: 4.8,
    reviews: 156,
    badge: "Más Vendido",
    description: "Mezcla de hierbas especialmente seleccionadas para el cuidado de la piel femenina"
  }, {
    id: 2,
    name: "Vermicompostera 5 Niveles",
    category: "Vermicompostaje",
    price: 89990,
    originalPrice: null,
    image: "/src/assets/vermicompostaje.jpg",
    rating: 4.9,
    reviews: 89,
    badge: "B2B Popular",
    description: "Sistema completo de vermicompostaje para empresas y hogares conscientes"
  }, {
    id: 3,
    name: "Eco Macetero Alerce + Kit Cultivo",
    category: "Maceteros",
    price: 15990,
    originalPrice: 19990,
    image: "/src/assets/maceteros-kits.jpg",
    rating: 4.7,
    reviews: 203,
    badge: "Oferta",
    description: "Macetero ecológico de madera alerce con kit completo para cultivar hierbas"
  }];

  // Convertir productos WooCommerce o usar fallback
  const products = wcProducts ? wcProducts.slice(0, 3).map(wcProduct => ({
    id: wcProduct.id,
    name: wcProduct.name,
    category: wcProduct.categories[0]?.name || 'Sin categoría',
    price: parseFloat(wcProduct.price) || 0,
    originalPrice: wcProduct.sale_price ? parseFloat(wcProduct.regular_price) : null,
    image: wcProduct.images[0]?.src || '/placeholder.svg',
    rating: parseFloat(wcProduct.average_rating) || 4.5,
    reviews: wcProduct.rating_count || 0,
    badge: wcProduct.featured ? "Destacado" : wcProduct.on_sale ? "Oferta" : "Disponible",
    description: wcProduct.short_description?.replace(/<[^>]*>/g, '') || wcProduct.description?.replace(/<[^>]*>/g, '').substring(0, 100) + '...' || ''
  })) : fallbackProducts;
  const handleViewProduct = (product: typeof products[0]) => {
    setSelectedProduct(product);
    setIsModalOpen(true);
  };
  const handleAddToCart = (product: typeof products[0]) => {
    addItem({
      id: product.id,
      name: product.name,
      slug: product.name.toLowerCase().replace(/\s+/g, '-'),
      price: product.price,
      originalPrice: product.originalPrice || undefined,
      image: product.image,
      category: product.category,
      inStock: true
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
        <div className="u-grid u-grid--cols-4 gap-8 mb-12">
          {isLoading ?
        // Loading skeleton
        Array.from({
          length: 3
        }).map((_, index) => <Card key={index} className="animate-pulse">
                <div className="h-64 bg-muted"></div>
                <CardContent className="p-6">
                  <div className="h-4 bg-muted rounded mb-2"></div>
                  <div className="h-6 bg-muted rounded mb-2"></div>
                  <div className="h-4 bg-muted rounded mb-4"></div>
                  <div className="h-6 bg-muted rounded"></div>
                </CardContent>
              </Card>) : products.map(product => <Card key={product.id} className="group hover:shadow-lg transition-all duration-300 border-border/50 hover:border-primary/20 overflow-hidden">
              <CardHeader className="p-0 relative">
                <div className="relative overflow-hidden">
                  <img src={product.image} alt={product.name} className="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                  
                  {/* Badge */}
                  <Badge className={`absolute top-3 left-3 ${product.badge === "Más Vendido" ? "bg-accent text-accent-foreground" : product.badge === "B2B Popular" ? "bg-primary text-primary-foreground" : "bg-secondary text-secondary-foreground"}`}>
                    {product.badge}
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
                    ${product.price.toLocaleString('es-CL')}
                  </span>
                  {product.originalPrice && <span className="text-sm text-muted-foreground line-through">
                      ${product.originalPrice.toLocaleString('es-CL')}
                    </span>}
                </div>
              </CardContent>

              <CardFooter className="p-6 pt-0">
                <div className="flex gap-2 w-full">
                  <Button className="flex-1 bg-primary hover:bg-primary/90" onClick={() => handleAddToCart(product)}>
                    <ShoppingCartIcon className="w-4 h-4 mr-2" />
                    Agregar
                  </Button>
                  <Button variant="outline" className="px-4" onClick={() => handleViewProduct(product)}>
                    Ver
                  </Button>
                </div>
              </CardFooter>
            </Card>)}
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