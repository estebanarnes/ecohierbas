// Datos centralizados de productos - Compatible con futura migración a WordPress/WooCommerce
export interface ProductData {
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
  featured: boolean;
  // Campos adicionales para compatibilidad con WooCommerce
  sku?: string;
  weight?: number;
  dimensions?: {
    length: number;
    width: number;
    height: number;
  };
  tags?: string[];
  attributes?: {
    name: string;
    value: string;
  }[];
}

// Base de datos centralizada de productos
// Esta estructura será fácil de migrar a WordPress/WooCommerce
export const PRODUCTS_DATABASE: ProductData[] = [
  {
    id: 1,
    name: "Box Especial Mujer - Refresca tu Piel",
    slug: "box-especial-mujer-refresca-tu-piel",
    category: "Infusiones",
    finalidad: "Piel",
    price: 24990,
    originalPrice: 29990,
    image: "/assets/productos-hierbas.jpg",
    rating: 4.8,
    reviews: 156,
    inStock: true,
    featured: true,
    description: "Mezcla especial de hierbas para el cuidado y regeneración de la piel femenina. Incluye manzanilla, lavanda y caléndula.",
    sku: "BOX-MUJER-001",
    weight: 250,
    tags: ["mujer", "piel", "natural", "orgánico"],
    attributes: [
      { name: "Uso", value: "Infusión" },
      { name: "Género", value: "Mujer" },
      { name: "Beneficio", value: "Cuidado de la piel" }
    ]
  },
  {
    id: 2,
    name: "Vermicompostera 5 Niveles",
    slug: "vermicompostera-5-niveles",
    category: "Vermicompostaje",
    finalidad: null,
    price: 89990,
    originalPrice: null,
    image: "/assets/vermicompostaje.jpg",
    rating: 4.9,
    reviews: 89,
    inStock: true,
    featured: true,
    description: "Sistema completo de vermicompostaje para empresas y hogares. Incluye 5 niveles apilables y manual de uso.",
    sku: "VERMI-5N-001",
    weight: 5000,
    dimensions: {
      length: 60,
      width: 40,
      height: 80
    },
    tags: ["compost", "ecológico", "sustentable", "hogar"],
    attributes: [
      { name: "Niveles", value: "5" },
      { name: "Material", value: "Plástico reciclado" },
      { name: "Capacidad", value: "50L" }
    ]
  },
  {
    id: 3,
    name: "Eco Macetero Alerce + Kit Cultivo",
    slug: "eco-macetero-alerce-kit-cultivo",
    category: "Maceteros",
    finalidad: null,
    price: 15990,
    originalPrice: 19990,
    image: "/assets/maceteros-kits.jpg",
    rating: 4.7,
    reviews: 203,
    inStock: true,
    featured: true,
    description: "Macetero ecológico de madera alerce con kit completo para cultivar hierbas. Incluye semillas y sustrato.",
    sku: "MACETERO-ALE-001",
    weight: 800,
    dimensions: {
      length: 30,
      width: 20,
      height: 15
    },
    tags: ["macetero", "alerce", "cultivo", "kit"],
    attributes: [
      { name: "Material", value: "Madera Alerce" },
      { name: "Incluye", value: "Semillas + Sustrato" },
      { name: "Tamaño", value: "Mediano" }
    ]
  },
  {
    id: 4,
    name: "Infusión Digestiva Premium",
    slug: "infusion-digestiva-premium",
    category: "Infusiones",
    finalidad: "Digestión",
    price: 12990,
    originalPrice: null,
    image: "/assets/productos-hierbas.jpg",
    rating: 4.6,
    reviews: 127,
    inStock: true,
    featured: false,
    description: "Mezcla premium de hierbas para mejorar la digestión. Con menta, boldo y manzanilla.",
    sku: "INF-DIG-001",
    weight: 100,
    tags: ["digestión", "menta", "boldo", "natural"],
    attributes: [
      { name: "Uso", value: "Infusión" },
      { name: "Beneficio", value: "Digestión" },
      { name: "Contenido", value: "100g" }
    ]
  },
  {
    id: 5,
    name: "Kit Huerto Urbano Completo",
    slug: "kit-huerto-urbano-completo",
    category: "Maceteros",
    finalidad: null,
    price: 34990,
    originalPrice: 39990,
    image: "/assets/maceteros-kits.jpg",
    rating: 4.8,
    reviews: 92,
    inStock: true,
    featured: false,
    description: "Kit completo para crear tu huerto urbano. Incluye 3 maceteros, semillas variadas y guía de cultivo.",
    sku: "KIT-HUERTO-001",
    weight: 2500,
    tags: ["huerto", "urbano", "kit", "completo"],
    attributes: [
      { name: "Incluye", value: "3 Maceteros + Semillas" },
      { name: "Tipo", value: "Kit Completo" },
      { name: "Nivel", value: "Principiante" }
    ]
  },
  {
    id: 6,
    name: "Té Relajante Nocturno",
    slug: "te-relajante-nocturno",
    category: "Infusiones",
    finalidad: "Relajación",
    price: 9990,
    originalPrice: null,
    image: "/assets/productos-hierbas.jpg",
    rating: 4.5,
    reviews: 245,
    inStock: true,
    featured: false,
    description: "Mezcla especial de hierbas para relajarse antes de dormir. Con valeriana, tilo y lavanda.",
    sku: "TE-REL-001",
    weight: 80,
    tags: ["relajante", "noche", "sueño", "valeriana"],
    attributes: [
      { name: "Uso", value: "Nocturno" },
      { name: "Beneficio", value: "Relajación" },
      { name: "Contenido", value: "80g" }
    ]
  }
];

// Categorías disponibles
export const CATEGORIES = [
  "Infusiones",
  "Vermicompostaje", 
  "Maceteros"
];

// Finalidades disponibles
export const FINALIDADES = [
  "Piel",
  "Digestión",
  "Relajación",
  "Energía",
  "Inmunidad"
];

// Funciones helper para acceder a los datos
export const getProductById = (id: number): ProductData | undefined => {
  return PRODUCTS_DATABASE.find(product => product.id === id);
};

export const getProductBySlug = (slug: string): ProductData | undefined => {
  return PRODUCTS_DATABASE.find(product => product.slug === slug);
};

export const getProductsByCategory = (category: string): ProductData[] => {
  return PRODUCTS_DATABASE.filter(product => product.category === category);
};

export const getFeaturedProducts = (limit?: number): ProductData[] => {
  const featured = PRODUCTS_DATABASE.filter(product => product.featured);
  return limit ? featured.slice(0, limit) : featured;
};

export const searchProducts = (query: string): ProductData[] => {
  const lowercaseQuery = query.toLowerCase();
  return PRODUCTS_DATABASE.filter(product => 
    product.name.toLowerCase().includes(lowercaseQuery) ||
    product.description.toLowerCase().includes(lowercaseQuery) ||
    product.category.toLowerCase().includes(lowercaseQuery) ||
    (product.finalidad && product.finalidad.toLowerCase().includes(lowercaseQuery))
  );
};