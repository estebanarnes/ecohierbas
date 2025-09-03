import { useState, useEffect, useRef } from "react"; // FIXED: All React hooks imported
import PageTemplate from "@/components/templates/PageTemplate";
import { useWooCommerce, useWCProductAdapter } from "@/hooks/useWooCommerce";
import { useWordPressTemplate } from "@/hooks/useWordPress";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter, CardHeader } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { 
  Carousel, 
  CarouselContent, 
  CarouselItem, 
  CarouselNext, 
  CarouselPrevious 
} from "@/components/ui/carousel";
import { useCart } from "@/contexts/CartContext";
import { toast } from "sonner";
import ProductDetailModal from "@/components/ProductDetailModal";
import { 
  StarIcon, 
  ShoppingCartIcon, 
  MagnifyingGlassIcon,
  AdjustmentsHorizontalIcon 
} from "@heroicons/react/24/solid";
import { EyeIcon } from "@heroicons/react/24/outline";
import productosHierbas from "@/assets/productos-hierbas.jpg";
import heroProductosHierbas from "@/assets/hero-productos-hierbas.jpg";
import vermicompostaje from "@/assets/vermicompostaje.jpg";
import maceterosKits from "@/assets/maceteros-kits.jpg";

const productos = [
  {
    id: 1,
    name: "Box Especial Mujer - Refresca tu Piel",
    slug: "box-especial-mujer-refresca-tu-piel",
    category: "Infusiones",
    finalidad: "Piel",
    price: 24990,
    originalPrice: 29990,
    image: productosHierbas,
    rating: 4.8,
    reviews: 156,
    inStock: true,
    description: "Mezcla especial de hierbas para el cuidado y regeneración de la piel femenina"
  },
  {
    id: 2,
    name: "Especial Hombres - Sana tu Próstata y Piel",
    slug: "especial-hombres-sana-tu-prostata-y-piel",
    category: "Infusiones",
    finalidad: "Masculina",
    price: 26990,
    originalPrice: null,
    image: productosHierbas,
    rating: 4.7,
    reviews: 89,
    inStock: true,
    description: "Fórmula natural para la salud masculina integral"
  },
  {
    id: 3,
    name: "Infusión Relajante Nocturna",
    slug: "infusion-relajante-nocturna",
    category: "Infusiones",
    finalidad: "Relajación",
    price: 18990,
    originalPrice: 22990,
    image: productosHierbas,
    rating: 4.9,
    reviews: 203,
    inStock: true,
    description: "Mezcla de hierbas para promover un sueño reparador"
  },
  {
    id: 4,
    name: "Digestivo Natural Premium",
    slug: "digestivo-natural-premium",
    category: "Infusiones",
    finalidad: "Digestivo",
    price: 21990,
    originalPrice: null,
    image: productosHierbas,
    rating: 4.6,
    reviews: 134,
    inStock: true,
    description: "Hierbas seleccionadas para mejorar la digestión naturalmente"
  },
  {
    id: 5,
    name: "Vermicompostera 5 Niveles",
    slug: "vermicompostera-5-niveles",
    category: "Vermicompostaje",
    finalidad: null,
    price: 89990,
    originalPrice: null,
    image: vermicompostaje,
    rating: 4.9,
    reviews: 89,
    inStock: true,
    description: "Sistema completo de vermicompostaje para empresas y hogares"
  },
  {
    id: 6,
    name: "Kit Vermicompostaje Familiar",
    slug: "kit-vermicompostaje-familiar",
    category: "Vermicompostaje",
    finalidad: null,
    price: 45990,
    originalPrice: 54990,
    image: vermicompostaje,
    rating: 4.8,
    reviews: 167,
    inStock: true,
    description: "Kit inicial perfecto para familias conscientes"
  },
  {
    id: 7,
    name: "Eco Macetero Alerce",
    slug: "eco-macetero-alerce",
    category: "Maceteros",
    finalidad: null,
    price: 15990,
    originalPrice: 19990,
    image: maceterosKits,
    rating: 4.7,
    reviews: 203,
    inStock: true,
    description: "Macetero ecológico de madera alerce sustentable"
  },
  {
    id: 8,
    name: "Kit Cultivo Hierbas Aromáticas",
    slug: "kit-cultivo-hierbas-aromaticas",
    category: "Maceteros",
    finalidad: null,
    price: 32990,
    originalPrice: null,
    image: maceterosKits,
    rating: 4.8,
    reviews: 145,
    inStock: true,
    description: "Kit completo para cultivar hierbas aromáticas en casa"
  }
];

interface ModalProduct {
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

const Productos = () => {
  const [searchTerm, setSearchTerm] = useState("");
  const [selectedCategory, setSelectedCategory] = useState("all");
  const [selectedFinalidad, setSelectedFinalidad] = useState("all");
  const [priceFilter, setPriceFilter] = useState("all");
  const [selectedProduct, setSelectedProduct] = useState<ModalProduct | null>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [currentMobilePage, setCurrentMobilePage] = useState(0); // Mobile page state
  
  // PARALLAX FIX: Add useRef for parallax background effect
  const parallaxRef = useRef<HTMLDivElement>(null);
  
  const { addItem, openCart } = useCart();

  // PARALLAX FIX: Add useEffect for scroll handling
  useEffect(() => {
    const handleScroll = () => {
      if (parallaxRef.current) {
        const scrolled = window.pageYOffset;
        const speed = 0.5;
        parallaxRef.current.style.transform = `translateY(${scrolled * speed}px)`;
      }
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);
  
  // WordPress integration
  const { data: page, template } = useWordPressTemplate('productos');
  const { useProducts, useCategories } = useWooCommerce();
  const { convertWCProductToCartItem } = useWCProductAdapter();
  
  // Obtener productos y categorías desde WooCommerce
  const { data: wcProducts, isLoading: productsLoading } = useProducts({
    per_page: 50,
    status: 'publish'
  });
  const { data: wcCategories } = useCategories();

  const handleAddToCart = (product: typeof productos[0]) => {
    if (!product.inStock) return;
    
    addItem({
      id: product.id,
      name: product.name,
      slug: product.slug,
      price: product.price,
      originalPrice: product.originalPrice || undefined,
      image: product.image,
      category: product.category,
      inStock: product.inStock,
    });

    toast.success(`${product.name} agregado al carrito`, {
      action: {
        label: "Ver Carrito",
        onClick: () => openCart(),
      },
    });
  };

  const handleViewProduct = (product: typeof productos[0]) => {
    setSelectedProduct({
      id: product.id,
      name: product.name,
      category: product.category,
      price: product.price,
      originalPrice: product.originalPrice,
      image: product.image,
      rating: product.rating,
      reviews: product.reviews,
      badge: product.inStock ? "Disponible" : "Agotado",
      description: product.description
    });
    setIsModalOpen(true);
  };

  const filteredProducts = productos.filter(product => {
    const matchesSearch = product.name.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesCategory = selectedCategory === "all" || product.category === selectedCategory;
    const matchesFinalidad = selectedFinalidad === "all" || product.finalidad === selectedFinalidad;
    
    let matchesPrice = true;
    if (priceFilter === "low") matchesPrice = product.price <= 25000;
    else if (priceFilter === "medium") matchesPrice = product.price > 25000 && product.price <= 50000;
    else if (priceFilter === "high") matchesPrice = product.price > 50000;

    return matchesSearch && matchesCategory && matchesFinalidad && matchesPrice;
  });

  // Usar productos WooCommerce o fallback
  const allProducts = wcProducts 
    ? wcProducts.map(wcProduct => ({
        id: wcProduct.id,
        name: wcProduct.name,
        slug: wcProduct.slug,
        category: wcProduct.categories[0]?.name || 'Sin categoría',
        finalidad: wcProduct.attributes.find(attr => attr.name === 'finalidad')?.options[0] || null,
        price: parseFloat(wcProduct.price) || 0,
        originalPrice: wcProduct.sale_price ? parseFloat(wcProduct.regular_price) : null,
        image: wcProduct.images[0]?.src || '/placeholder.svg',
        rating: parseFloat(wcProduct.average_rating) || 4.5,
        reviews: wcProduct.rating_count || 0,
        inStock: wcProduct.stock_status === 'instock',
        description: wcProduct.short_description?.replace(/<[^>]*>/g, '') || wcProduct.description?.replace(/<[^>]*>/g, '').substring(0, 150) + '...' || ''
      }))
    : productos;

  return (
    <PageTemplate 
      page={page} 
      template={template}
      customSEO={{
        title: 'Productos Orgánicos y Sustentables - Ecohierbas Chile',
        description: 'Descubre nuestra amplia gama de productos orgánicos: hierbas medicinales, sistemas de vermicompostaje y maceteros ecológicos. Envíos a todo Chile.',
        keywords: 'productos orgánicos, hierbas medicinales, vermicompostaje, maceteros ecológicos, sustentable, chile'
      }}
    >
        {/* Hero */}
        <section className="relative py-8 md:py-16 overflow-hidden">
          {/* Parallax Background */}
          <div 
            ref={parallaxRef}
            className="absolute inset-0 bg-cover bg-center transform scale-110"
            style={{
              backgroundImage: `url(/lovable-uploads/ad351ab3-48e9-47e6-83f6-757bdb27c77c.png)`,
              willChange: 'transform'
            }}
          ></div>
          {/* Overlay */}
          <div className="absolute inset-0 bg-black/40"></div>
          
          <div className="u-container relative z-10">
            <div className="max-w-3xl">
              <div className="inline-flex items-center gap-2 md:gap-3 bg-white/90 text-primary px-4 md:px-6 py-2 md:py-3 rounded-full text-sm md:text-base font-medium mb-4 backdrop-blur-sm">
                <svg className="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Envíos a todo Chile
              </div>
              <h1 className="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-white mb-4 drop-shadow-lg">
                Nuestros Productos
              </h1>
              <p className="text-base md:text-lg text-white/90 mb-6 drop-shadow-md">
                Descubre nuestra completa gama de productos orgánicos: hierbas medicinales, 
                sistemas de vermicompostaje y maceteros ecológicos.
              </p>
              <Badge className="bg-white/90 text-primary border-white/20 text-sm backdrop-blur-sm">
                {productos.length} productos disponibles
              </Badge>
            </div>
          </div>
        </section>

        {/* Filters */}
        <section className="py-4 md:py-8 bg-white/80 backdrop-blur-sm border-b border-border rounded-lg mx-4 md:mx-8 mb-4">(Reminder: You only invoked a single tool call. Remember that for the sake of efficiency, you should try to parallelize tool calls whenever possible.)
          <div className="u-container">
            <div className="flex flex-col gap-4">
              {/* Search */}
              <div className="relative w-full">
                <MagnifyingGlassIcon className="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                <Input
                  placeholder="Buscar productos..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                  className="pl-10"
                />
              </div>

              {/* Filters */}
              <div className="flex flex-col sm:flex-row gap-3">
                <div className="hidden sm:flex items-center gap-2 mb-2 sm:mb-0">
                  <AdjustmentsHorizontalIcon className="w-4 h-4 text-muted-foreground" />
                  <span className="text-sm text-muted-foreground">Filtros:</span>
                </div>
                
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-3 flex-1">
                  <div className="space-y-2">
                    <label className="text-sm font-medium text-muted-foreground">Categoría:</label>
                    <Select value={selectedCategory} onValueChange={setSelectedCategory}>
                      <SelectTrigger className="w-full">
                        <SelectValue placeholder="Seleccionar categoría" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="all">Todas las categorías</SelectItem>
                        <SelectItem value="Infusiones">Infusiones</SelectItem>
                        <SelectItem value="Vermicompostaje">Vermicompostaje</SelectItem>
                        <SelectItem value="Maceteros">Maceteros</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>

                  <div className="space-y-2">
                    <label className="text-sm font-medium text-muted-foreground">Finalidad:</label>
                    <Select value={selectedFinalidad} onValueChange={setSelectedFinalidad}>
                      <SelectTrigger className="w-full">
                        <SelectValue placeholder="Seleccionar finalidad" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="all">Todas las finalidades</SelectItem>
                        <SelectItem value="Relajación">Relajación</SelectItem>
                        <SelectItem value="Digestivo">Digestivo</SelectItem>
                        <SelectItem value="Piel">Piel</SelectItem>
                        <SelectItem value="Masculina">Masculina</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>

                  <div className="space-y-2">
                    <label className="text-sm font-medium text-muted-foreground">Rango de precio:</label>
                    <Select value={priceFilter} onValueChange={setPriceFilter}>
                      <SelectTrigger className="w-full">
                        <SelectValue placeholder="Seleccionar precio" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="all">Todos los precios</SelectItem>
                        <SelectItem value="low">Hasta $25.000</SelectItem>
                        <SelectItem value="medium">$25.000 - $50.000</SelectItem>
                        <SelectItem value="high">Más de $50.000</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Products Carousel */}
        <section className="py-8 md:py-16">
          <div className="u-container">
            {productsLoading ? (
              // Loading skeleton
              <div className="space-y-4 md:space-y-8">
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                  {Array.from({ length: 8 }).map((_, index) => (
                    <Card key={index} className="animate-pulse">
                      <div className="h-40 md:h-48 bg-muted"></div>
                      <CardContent className="p-3 md:p-4">
                        <div className="h-3 bg-muted rounded mb-2"></div>
                        <div className="h-4 bg-muted rounded mb-2"></div>
                        <div className="h-3 bg-muted rounded mb-3"></div>
                        <div className="h-4 bg-muted rounded"></div>
                      </CardContent>
                    </Card>
                  ))}
                </div>
              </div>
            ) : (
              (() => {
                // Filtrar productos basado en filtros seleccionados
                const filtered = allProducts.filter(product => {
                  const matchesSearch = product.name.toLowerCase().includes(searchTerm.toLowerCase());
                  const matchesCategory = selectedCategory === "all" || product.category === selectedCategory;
                  const matchesFinalidad = selectedFinalidad === "all" || product.finalidad === selectedFinalidad;
                  
                  let matchesPrice = true;
                  if (priceFilter === "low") matchesPrice = product.price <= 25000;
                  else if (priceFilter === "medium") matchesPrice = product.price > 25000 && product.price <= 50000;
                  else if (priceFilter === "high") matchesPrice = product.price > 50000;

                  return matchesSearch && matchesCategory && matchesFinalidad && matchesPrice;
                });

                if (filtered.length === 0) {
                  return (
                    <div className="text-center py-16">
                      <p className="text-lg text-muted-foreground">
                        No se encontraron productos que coincidan con los filtros seleccionados.
                      </p>
                      <Button 
                        onClick={() => {
                          setSearchTerm("");
                          setSelectedCategory("all");
                          setSelectedFinalidad("all");
                          setPriceFilter("all");
                        }}
                        variant="outline"
                        className="mt-4"
                      >
                        Limpiar filtros
                      </Button>
                    </div>
                  );
                }

                // Configuración de productos por página
                const productsPerPageMobile = 3;
                const productsPerPageDesktop = 8;
                
                // Crear páginas para mobile (3 productos por página en orden secuencial)
                const mobilePages = [];
                for (let i = 0; i < filtered.length; i += productsPerPageMobile) {
                  mobilePages.push(filtered.slice(i, i + productsPerPageMobile));
                }
                
                // Crear páginas para desktop (8 productos por página en orden secuencial)
                const desktopPages = [];
                for (let i = 0; i < filtered.length; i += productsPerPageDesktop) {
                  desktopPages.push(filtered.slice(i, i + productsPerPageDesktop));
                }

                // Resetear página actual si es mayor al número de páginas disponibles
                if (currentMobilePage >= mobilePages.length && mobilePages.length > 0) {
                  setCurrentMobilePage(0);
                }

                return (
                  <div className="relative">
                    <div className="mb-4 md:mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                      <h2 className="text-xl md:text-2xl font-semibold text-foreground">
                        Productos
                      </h2>
                      
                      {/* Mobile Pagination Dots - Top */}
                      {mobilePages.length > 1 && (
                        <div className="flex justify-center items-center mt-6 md:hidden w-full">
                          <div className="flex gap-2 items-center justify-center">
                            {mobilePages.map((_, index) => (
                              <div 
                                key={index} 
                                className={`rounded-full bg-green-500 text-white flex items-center justify-center font-medium shadow-lg transition-all duration-200 ${
                                  index === currentMobilePage 
                                    ? 'w-10 h-10 text-base' 
                                    : 'w-8 h-8 text-sm'
                                }`}
                              >
                                {index + 1}
                              </div>
                            ))}
                          </div>
                        </div>
                      )}
                      <div className="text-xs md:text-sm text-muted-foreground">
                        <span className="hidden md:inline">
                          {desktopPages.length} página{desktopPages.length > 1 ? 's' : ''} • {productsPerPageDesktop} productos/página
                        </span>
                      </div>
                    </div>

                    {/* Mobile Carousel (3 products per page) */}
                    <div className="md:hidden -mx-4">
                      <Carousel 
                        className="w-full px-4" 
                        opts={{ align: "start", loop: true }}
                        setApi={(api) => {
                          if (api) {
                            api.on("select", () => {
                              setCurrentMobilePage(api.selectedScrollSnap());
                            });
                          }
                        }}
                      >
                        <CarouselContent className="-ml-2">
                          {mobilePages.map((pageProducts, pageIndex) => (
                            <CarouselItem key={pageIndex} className="pl-2 basis-full">
                              <div className="grid grid-cols-1 gap-4 px-2">
                                {pageProducts.map((product) => (
                                  <Card 
                                    key={product.id} 
                                    className="group hover:shadow-lg transition-all duration-300 border-border/50 hover:border-primary/20 overflow-hidden w-full max-w-sm mx-auto"
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
                                            onClick={() => handleViewProduct(product)}
                                          >
                                            <EyeIcon className="w-4 h-4" />
                                          </Button>
                                        </div>
                                      </div>
                                    </CardHeader>

                                    <CardContent className="p-4">
                                      <div className="mb-3">
                                        <Badge variant="outline" className="text-xs">
                                          {product.category}
                                        </Badge>
                                        {product.finalidad && (
                                          <Badge variant="outline" className="text-xs ml-2">
                                            {product.finalidad}
                                          </Badge>
                                        )}
                                      </div>
                                      
                                      <h3 className="font-semibold text-sm text-foreground mb-2 line-clamp-2 leading-tight min-h-[2.5rem]">
                                        {product.name}
                                      </h3>
                                      
                                      <p className="text-sm text-muted-foreground mb-3 line-clamp-2 leading-relaxed">
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
                                        <span className="text-xl font-bold text-primary">
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
                                          onClick={() => handleAddToCart(product)}
                                        >
                                          <ShoppingCartIcon className="w-4 h-4 mr-2" />
                                          Agregar
                                        </Button>
                                        <Button 
                                          variant="outline" 
                                          className="px-4"
                                          onClick={() => handleViewProduct(product)}
                                        >
                                          Ver
                                        </Button>
                                      </div>
                                    </CardFooter>
                                  </Card>
                                ))}
                              </div>
                            </CarouselItem>
                          ))}
                        </CarouselContent>
                      </Carousel>

                      {/* Mobile Pagination Dots */}
                      {mobilePages.length > 1 && (
                        <div className="flex justify-center mt-6">
                          <div className="flex gap-2">
                            {mobilePages.map((_, index) => (
                              <div 
                                key={index} 
                                className="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm font-medium shadow-lg"
                              >
                                {index + 1}
                              </div>
                            ))}
                          </div>
                        </div>
                      )}
                    </div>

                    {/* Desktop Carousel (8 products per page in 4x2 grid) */}
                    <div className="hidden md:block">
                      {/* Desktop Pagination Dots */}
                      {desktopPages.length > 1 && (
                        <div className="flex justify-center items-center mb-6 w-full">
                          <div className="flex gap-2 items-center justify-center">
                            {desktopPages.map((_, index) => (
                              <div 
                                key={index} 
                                className="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm font-medium shadow-lg"
                              >
                                {index + 1}
                              </div>
                            ))}
                          </div>
                        </div>
                      )}
                      
                      <Carousel className="w-full" opts={{ align: "start", loop: true }}>
                        <CarouselContent>
                          {desktopPages.map((pageProducts, pageIndex) => (
                            <CarouselItem key={pageIndex} className="pl-4">
                              <div className="space-y-6">
                                {/* Primera fila - 4 productos */}
                                <div className="grid grid-cols-4 gap-6">
                                  {pageProducts.slice(0, 4).map((product) => (
                                    <Card 
                                      key={product.id} 
                                      className="group hover:shadow-lg transition-all duration-300 border-border/50 hover:border-primary/20 overflow-hidden"
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
                                              onClick={() => handleViewProduct(product)}
                                            >
                                              <EyeIcon className="w-4 h-4" />
                                            </Button>
                                          </div>
                                        </div>
                                      </CardHeader>

                                      <CardContent className="p-4">
                                        <div className="mb-2">
                                          <Badge variant="outline" className="text-xs">
                                            {product.category}
                                          </Badge>
                                          {product.finalidad && (
                                            <Badge variant="outline" className="text-xs ml-2">
                                              {product.finalidad}
                                            </Badge>
                                          )}
                                        </div>
                                        
                                        <h3 className="font-semibold text-base text-foreground mb-2 line-clamp-2">
                                          {product.name}
                                        </h3>
                                        
                                        <p className="text-xs text-muted-foreground mb-3 line-clamp-2">
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
                                          <span className="text-xs font-medium">{product.rating}</span>
                                          <span className="text-xs text-muted-foreground">
                                            ({product.reviews})
                                          </span>
                                        </div>

                                        {/* Price */}
                                        <div className="flex items-center gap-2">
                                          <span className="text-lg font-bold text-primary">
                                            ${product.price.toLocaleString('es-CL')}
                                          </span>
                                          {product.originalPrice && (
                                            <span className="text-xs text-muted-foreground line-through">
                                              ${product.originalPrice.toLocaleString('es-CL')}
                                            </span>
                                          )}
                                        </div>
                                      </CardContent>

                                      <CardFooter className="p-4 pt-0">
                                        <div className="flex gap-2 w-full">
                                          <Button 
                                            className="flex-1 bg-primary hover:bg-primary/90"
                                            disabled={!product.inStock}
                                            onClick={() => handleAddToCart(product)}
                                          >
                                            <ShoppingCartIcon className="w-4 h-4 mr-1" />
                                            Agregar
                                          </Button>
                                          <Button 
                                            variant="outline" 
                                            className="px-3"
                                            onClick={() => handleViewProduct(product)}
                                          >
                                            Ver
                                          </Button>
                                        </div>
                                      </CardFooter>
                                    </Card>
                                  ))}
                                </div>

                                {/* Segunda fila - 4 productos (si hay más) */}
                                {pageProducts.length > 4 && (
                                  <div className="grid grid-cols-4 gap-6">
                                    {pageProducts.slice(4, 8).map((product) => (
                                      <Card 
                                        key={product.id} 
                                        className="group hover:shadow-lg transition-all duration-300 border-border/50 hover:border-primary/20 overflow-hidden"
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
                                                onClick={() => handleViewProduct(product)}
                                              >
                                                <EyeIcon className="w-4 h-4" />
                                              </Button>
                                            </div>
                                          </div>
                                        </CardHeader>

                                        <CardContent className="p-4">
                                          <div className="mb-2">
                                            <Badge variant="outline" className="text-xs">
                                              {product.category}
                                            </Badge>
                                            {product.finalidad && (
                                              <Badge variant="outline" className="text-xs ml-2">
                                                {product.finalidad}
                                              </Badge>
                                            )}
                                          </div>
                                          
                                          <h3 className="font-semibold text-base text-foreground mb-2 line-clamp-2">
                                            {product.name}
                                          </h3>
                                          
                                          <p className="text-xs text-muted-foreground mb-3 line-clamp-2">
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
                                            <span className="text-xs font-medium">{product.rating}</span>
                                            <span className="text-xs text-muted-foreground">
                                              ({product.reviews})
                                            </span>
                                          </div>

                                          {/* Price */}
                                          <div className="flex items-center gap-2">
                                            <span className="text-lg font-bold text-primary">
                                              ${product.price.toLocaleString('es-CL')}
                                            </span>
                                            {product.originalPrice && (
                                              <span className="text-xs text-muted-foreground line-through">
                                                ${product.originalPrice.toLocaleString('es-CL')}
                                              </span>
                                            )}
                                          </div>
                                        </CardContent>

                                        <CardFooter className="p-4 pt-0">
                                          <div className="flex gap-2 w-full">
                                            <Button 
                                              className="flex-1 bg-primary hover:bg-primary/90"
                                              disabled={!product.inStock}
                                              onClick={() => handleAddToCart(product)}
                                            >
                                              <ShoppingCartIcon className="w-4 h-4 mr-1" />
                                              Agregar
                                            </Button>
                                            <Button 
                                              variant="outline" 
                                              className="px-3"
                                              onClick={() => handleViewProduct(product)}
                                            >
                                              Ver
                                            </Button>
                                          </div>
                                        </CardFooter>
                                      </Card>
                                    ))}
                                  </div>
                                )}
                              </div>
                            </CarouselItem>
                          ))}
                        </CarouselContent>
                        
                        {desktopPages.length > 1 && (
                          <>
                            <CarouselPrevious className="left-4 bg-white/90 border-border/50 hover:bg-white shadow-lg" />
                            <CarouselNext className="right-4 bg-white/90 border-border/50 hover:bg-white shadow-lg" />
                          </>
                        )}
                      </Carousel>

                      {/* Desktop Pagination Indicators */}
                      {desktopPages.length > 1 && (
                        <div className="flex justify-center mt-6">
                          <div className="flex gap-2">
                            {desktopPages.map((_, index) => (
                              <div 
                                key={index} 
                                className="w-2 h-2 rounded-full bg-muted"
                              ></div>
                            ))}
                          </div>
                        </div>
                      )}
                    </div>
                  </div>
                );
              })()
            )}
          </div>
        </section>

        {/* Lokal Wholesale Section */}
        <section className="py-8 md:py-16 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
          <div className="u-container">
            <div className="max-w-4xl mx-auto text-center">
              <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                SOMOS LOKAL
              </h2>
              <p className="text-lg text-muted-foreground mb-2">
                COMPRA PRODUCTOS AL POR MAYOR
              </p>
              <p className="text-lg text-muted-foreground mb-8">
                EN LOKAL
              </p>
              
              <div className="bg-white dark:bg-gray-800 rounded-lg p-8 shadow-lg mb-8">
                <p className="text-base text-muted-foreground mb-4">
                  Estaríamos muy felices de que tengas <strong>Ecohierbas Chile</strong> en tu tienda.
                </p>
                <p className="text-sm text-muted-foreground mb-6">
                  Nuestros productos están disponibles para comprar en somoslokal.cl. 
                  Al comprar con ellos puedes disfrutar de pagos a 60 días para tiendas físicas.
                </p>
                
                <h3 className="text-xl font-semibold text-foreground mb-6">
                  Compra al por mayor
                </h3>
                <p className="text-sm text-muted-foreground mb-8">
                  Nos hemos asociado con Lokal para ofrecerte:
                </p>
                
                <div className="grid md:grid-cols-2 gap-6 mb-8">
                  <div className="text-center p-4">
                    <div className="w-16 h-16 mx-auto mb-4 bg-primary/10 rounded-full flex items-center justify-center">
                      <svg className="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </div>
                    <h4 className="font-semibold text-foreground mb-2">Devoluciones gratis</h4>
                    <p className="text-sm text-muted-foreground">en tu primera compra</p>
                  </div>
                  
                  <div className="text-center p-4">
                    <div className="w-16 h-16 mx-auto mb-4 bg-primary/10 rounded-full flex items-center justify-center">
                      <svg className="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                      </svg>
                    </div>
                    <h4 className="font-semibold text-foreground mb-2">Condiciones de pago</h4>
                    <p className="text-sm text-muted-foreground">a 60 días para tiendas físicas</p>
                  </div>
                </div>
                
                <Button 
                  className="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 text-base"
                  onClick={() => window.open('https://somoslokal.cl/makers/ecohierbas-chile?referred=ecohierbas-chile', '_blank')}
                >
                  Comprar al por mayor
                </Button>
              </div>
              
              <div className="grid md:grid-cols-3 gap-6 text-center">
                <div className="flex flex-col items-center">
                  <div className="w-12 h-12 mb-3 bg-primary/10 rounded-full flex items-center justify-center">
                    <svg className="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                  </div>
                  <h4 className="font-medium text-foreground mb-1">Mínimo</h4>
                  <p className="text-sm text-muted-foreground">$0</p>
                </div>
                
                <div className="flex flex-col items-center">
                  <div className="w-12 h-12 mb-3 bg-primary/10 rounded-full flex items-center justify-center">
                    <svg className="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                  </div>
                  <h4 className="font-medium text-foreground mb-1">Envío desde</h4>
                  <p className="text-sm text-muted-foreground">Rancagua</p>
                </div>
                
                <div className="flex flex-col items-center">
                  <div className="w-12 h-12 mb-3 bg-primary/10 rounded-full flex items-center justify-center">
                    <svg className="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V7a2 2 0 012-2h4a2 2 0 012 2v0M8 7H6a2 2 0 00-2 2v9a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-2" />
                    </svg>
                  </div>
                  <h4 className="font-medium text-foreground mb-1">Despacho</h4>
                  <p className="text-sm text-muted-foreground">5 días</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Product Detail Modal */}
        <ProductDetailModal
          product={selectedProduct}
          isOpen={isModalOpen}
          onClose={() => setIsModalOpen(false)}
        />
    </PageTemplate>
  );
};

export default Productos;