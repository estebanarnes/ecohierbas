import { useState } from "react";
import PageTemplate from "@/components/templates/PageTemplate";
import { Card, CardContent } from "@/components/ui/card";
import { useCart } from "@/contexts/CartContext";
import { toast } from "sonner";
import ProductDetailModal from "@/components/ProductDetailModal";
import productosHierbas from "@/assets/productos-hierbas.jpg";
import vermicompostaje from "@/assets/vermicompostaje.jpg";
import maceterosKits from "@/assets/maceteros-kits.jpg";
import HeroSection from "@/components/productos/HeroSection";
import ProductFilters from "@/components/productos/ProductFilters";
import ProductGrid from "@/components/productos/ProductGrid";

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
  
  const { addItem, openCart } = useCart();

  const handleAddToCart = (product: typeof productos[0]) => {
    if (!product.inStock) return;
    
    addItem({
      id: product.id,
      name: product.slug,
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

  const handleClearFilters = () => {
    setSearchTerm("");
    setSelectedCategory("all");
    setSelectedFinalidad("all");
    setPriceFilter("all");
  };

  // Filtrar productos basado en filtros seleccionados
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

  return (
    <PageTemplate 
      template="products"
      customSEO={{
        title: 'Productos Orgánicos y Sustentables - Ecohierbas Chile',
        description: 'Descubre nuestra amplia gama de productos orgánicos: hierbas medicinales, sistemas de vermicompostaje y maceteros ecológicos. Envíos a todo Chile.',
        keywords: 'productos orgánicos, hierbas medicinales, vermicompostaje, maceteros ecológicos, sustentable, chile'
      }}
    >
      <HeroSection productCount={productos.length} />

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