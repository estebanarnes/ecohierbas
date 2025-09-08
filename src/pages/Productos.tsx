import { useState } from "react";
import PageTemplate from "@/components/templates/PageTemplate";
import { useCart } from "@/contexts/CartContext";
import { toast } from "sonner";
import ProductDetailModal from "@/components/ProductDetailModal";
import HeroSection from "@/components/productos/HeroSection";
import ProductFilters from "@/components/productos/ProductFilters";
import ProductGrid from "@/components/productos/ProductGrid";
import { useProducts } from "@/hooks/useProducts";
import { Product } from "@/services/wordpress";


const Productos = () => {
  const [searchTerm, setSearchTerm] = useState("");
  const [selectedCategory, setSelectedCategory] = useState("all");
  const [selectedFinalidad, setSelectedFinalidad] = useState("all");
  const [priceFilter, setPriceFilter] = useState("all");
  const [selectedProduct, setSelectedProduct] = useState<Product | null>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  
  const { addItem, openCart } = useCart();
  const { products, loading, error } = useProducts();

  const handleAddToCart = (product: Product) => {
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

  const handleViewProduct = (product: Product) => {
    setSelectedProduct(product);
    setIsModalOpen(true);
  };

  const handleClearFilters = () => {
    setSearchTerm("");
    setSelectedCategory("all");
    setSelectedFinalidad("all");
    setPriceFilter("all");
  };

  // Filtrar productos basado en filtros seleccionados
  const filteredProducts = products.filter(product => {
    const matchesSearch = product.name.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesCategory = selectedCategory === "all" || product.category === selectedCategory;
    const matchesFinalidad = selectedFinalidad === "all" || product.finalidad === selectedFinalidad;
    
    let matchesPrice = true;
    if (priceFilter === "low") matchesPrice = product.price <= 25000;
    else if (priceFilter === "medium") matchesPrice = product.price > 25000 && product.price <= 50000;
    else if (priceFilter === "high") matchesPrice = product.price > 50000;

    return matchesSearch && matchesCategory && matchesFinalidad && matchesPrice;
  });

  if (loading) {
    return (
      <PageTemplate template="products">
        <div className="u-container py-20">
          <div className="text-center">
            <div className="animate-pulse space-y-4">
              <div className="h-8 bg-muted rounded w-64 mx-auto"></div>
              <div className="h-4 bg-muted rounded w-96 mx-auto"></div>
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                {[...Array(8)].map((_, i) => (
                  <div key={i} className="h-64 bg-muted rounded"></div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </PageTemplate>
    );
  }

  if (error) {
    return (
      <PageTemplate template="products">
        <div className="u-container py-20">
          <div className="text-center">
            <p className="text-muted-foreground">{error}</p>
          </div>
        </div>
      </PageTemplate>
    );
  }

  return (
    <PageTemplate 
      template="products"
      customSEO={{
        title: 'Productos Orgánicos y Sustentables - Ecohierbas Chile',
        description: 'Descubre nuestra amplia gama de productos orgánicos: hierbas medicinales, sistemas de vermicompostaje y maceteros ecológicos. Envíos a todo Chile.',
        keywords: 'productos orgánicos, hierbas medicinales, vermicompostaje, maceteros ecológicos, sustentable, chile'
      }}
    >
      <HeroSection productCount={products.length} />

      <ProductFilters
        searchTerm={searchTerm}
        setSearchTerm={setSearchTerm}
        selectedCategory={selectedCategory}
        setSelectedCategory={setSelectedCategory}
        selectedFinalidad={selectedFinalidad}
        setSelectedFinalidad={setSelectedFinalidad}
        priceFilter={priceFilter}
        setPriceFilter={setPriceFilter}
      />

      {/* Products Section */}
      <section className="py-8 md:py-16">
        <div className="u-container">
          <ProductGrid
            products={filteredProducts}
            onAddToCart={handleAddToCart}
            onViewProduct={handleViewProduct}
            onClearFilters={handleClearFilters}
          />
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