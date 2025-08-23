import { useState } from "react";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter, CardHeader } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { useCart } from "@/contexts/CartContext";
import { toast } from "sonner";
import ProductDetailModal from "@/components/ProductDetailModal";
import { StarIcon, ShoppingCartIcon, MagnifyingGlassIcon, AdjustmentsHorizontalIcon } from "@heroicons/react/24/solid";
import { EyeIcon } from "@heroicons/react/24/outline";
import productosHierbas from "@/assets/productos-hierbas.jpg";
import vermicompostaje from "@/assets/vermicompostaje.jpg";
import maceterosKits from "@/assets/maceteros-kits.jpg";
const productos = [{
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
}, {
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
}, {
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
}, {
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
}, {
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
}, {
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
}, {
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
}, {
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
}];
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
  const {
    addItem,
    openCart
  } = useCart();
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
      inStock: product.inStock
    });
    toast.success(`${product.name} agregado al carrito`, {
      action: {
        label: "Ver Carrito",
        onClick: () => openCart()
      }
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
    if (priceFilter === "low") matchesPrice = product.price <= 25000;else if (priceFilter === "medium") matchesPrice = product.price > 25000 && product.price <= 50000;else if (priceFilter === "high") matchesPrice = product.price > 50000;
    return matchesSearch && matchesCategory && matchesFinalidad && matchesPrice;
  });
  return <div className="min-h-screen bg-background">
      <Header />
      <main>
        {/* Hero */}
        <section className="py-16 bg-gradient-to-r from-primary/10 to-accent/10">
          <div className="u-container">
            <div className="max-w-3xl">
              <h1 className="text-4xl md:text-5xl font-serif font-bold text-foreground mb-4">Envíos a todo Chile</h1>
              <p className="text-lg text-muted-foreground mb-6">
                Descubre nuestra completa gama de productos orgánicos: hierbas medicinales, 
                sistemas de vermicompostaje y maceteros ecológicos.
              </p>
              <Badge className="bg-primary/10 text-primary border-primary/20">
                {productos.length} productos disponibles
              </Badge>
            </div>
          </div>
        </section>

        {/* Filters */}
        <section className="py-8 bg-white border-b border-border">
          <div className="u-container">
            <div className="flex flex-col lg:flex-row gap-4 items-center">
              {/* Search */}
              <div className="relative flex-1 max-w-md">
                <MagnifyingGlassIcon className="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                <Input placeholder="Buscar productos..." value={searchTerm} onChange={e => setSearchTerm(e.target.value)} className="pl-10" />
              </div>

              {/* Filters */}
              <div className="flex gap-4 items-center">
                <div className="flex items-center gap-2">
                  <AdjustmentsHorizontalIcon className="w-4 h-4 text-muted-foreground" />
                  <span className="text-sm text-muted-foreground">Filtros:</span>
                </div>
                
                <Select value={selectedCategory} onValueChange={setSelectedCategory}>
                  <SelectTrigger className="w-40">
                    <SelectValue placeholder="Categoría" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="all">Todas</SelectItem>
                    <SelectItem value="Infusiones">Infusiones</SelectItem>
                    <SelectItem value="Vermicompostaje">Vermicompostaje</SelectItem>
                    <SelectItem value="Maceteros">Maceteros</SelectItem>
                  </SelectContent>
                </Select>

                <Select value={selectedFinalidad} onValueChange={setSelectedFinalidad}>
                  <SelectTrigger className="w-40">
                    <SelectValue placeholder="Finalidad" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="all">Todas</SelectItem>
                    <SelectItem value="Relajación">Relajación</SelectItem>
                    <SelectItem value="Digestivo">Digestivo</SelectItem>
                    <SelectItem value="Piel">Piel</SelectItem>
                    <SelectItem value="Masculina">Masculina</SelectItem>
                  </SelectContent>
                </Select>

                <Select value={priceFilter} onValueChange={setPriceFilter}>
                  <SelectTrigger className="w-40">
                    <SelectValue placeholder="Precio" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="all">Todos</SelectItem>
                    <SelectItem value="low">Hasta $25.000</SelectItem>
                    <SelectItem value="medium">$25.000 - $50.000</SelectItem>
                    <SelectItem value="high">Más de $50.000</SelectItem>
                  </SelectContent>
                </Select>
              </div>
            </div>
          </div>
        </section>

        {/* Lokal Wholesale Section */}
        <section className="py-16 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
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
                
                <Button className="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 text-base" onClick={() => window.open('https://somoslokal.cl/makers/ecohierbas-chile?referred=ecohierbas-chile', '_blank')}>
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

        {/* Products Grid */}
        <section className="py-16">
          <div className="u-container">
            {filteredProducts.length === 0 ? <div className="text-center py-16">
                <p className="text-lg text-muted-foreground">
                  No se encontraron productos que coincidan con los filtros seleccionados.
                </p>
                <Button onClick={() => {
              setSearchTerm("");
              setSelectedCategory("all");
              setSelectedFinalidad("all");
              setPriceFilter("all");
            }} variant="outline" className="mt-4">
                  Limpiar filtros
                </Button>
              </div> : <div className="u-grid u-grid--cols-4 gap-6">
                {filteredProducts.map(product => <Card key={product.id} className="group hover:shadow-lg transition-all duration-300 border-border/50 hover:border-primary/20 overflow-hidden">
                    <CardHeader className="p-0 relative">
                      <div className="relative overflow-hidden">
                        <img src={product.image} alt={product.name} className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        {/* Stock Status */}
                        <Badge className={`absolute top-3 left-3 ${product.inStock ? "bg-green-100 text-green-800 border-green-200" : "bg-red-100 text-red-800 border-red-200"}`}>
                          {product.inStock ? "En Stock" : "Agotado"}
                        </Badge>

                        {/* Quick Actions */}
                        <div className="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                          <Button size="icon" variant="secondary" className="w-8 h-8">
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
                        {product.finalidad && <Badge variant="outline" className="text-xs ml-2">
                            {product.finalidad}
                          </Badge>}
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
                          {[...Array(5)].map((_, i) => <StarIcon key={i} className={`w-3 h-3 ${i < Math.floor(product.rating) ? "text-yellow-400 fill-current" : "text-gray-300"}`} />)}
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
                        {product.originalPrice && <span className="text-xs text-muted-foreground line-through">
                            ${product.originalPrice.toLocaleString('es-CL')}
                          </span>}
                      </div>
                    </CardContent>

                    <CardFooter className="p-4 pt-0">
                      <div className="flex gap-2 w-full">
                        <Button className="flex-1 bg-primary hover:bg-primary/90" disabled={!product.inStock} onClick={() => handleAddToCart(product)}>
                          <ShoppingCartIcon className="w-4 h-4 mr-1" />
                          Agregar
                        </Button>
                        <Button variant="outline" className="px-3" onClick={() => handleViewProduct(product)}>
                          Ver
                        </Button>
                      </div>
                    </CardFooter>
                  </Card>)}
              </div>}
          </div>
        </section>
      </main>

      {/* Product Detail Modal */}
      <ProductDetailModal product={selectedProduct} isOpen={isModalOpen} onClose={() => setIsModalOpen(false)} />
      
      <Footer />
    </div>;
};
export default Productos;