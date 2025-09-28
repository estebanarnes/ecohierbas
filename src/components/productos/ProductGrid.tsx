import { useState } from "react";
import { Button } from "@/components/ui/button";
import { 
  Carousel, 
  CarouselContent, 
  CarouselItem,
  CarouselPrevious,
  CarouselNext
} from "@/components/ui/carousel";
import ProductCard from "./ProductCard";

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

interface ProductGridProps {
  products: Product[];
  onAddToCart: (product: Product) => void;
  onViewProduct: (product: Product) => void;
  onClearFilters: () => void;
}

const ProductGrid = ({ products, onAddToCart, onViewProduct, onClearFilters }: ProductGridProps) => {
  const [currentMobilePage, setCurrentMobilePage] = useState(0);
  const [currentDesktopPage, setCurrentDesktopPage] = useState(0);
  const [mobileApi, setMobileApi] = useState<any>(null);
  const [desktopApi, setDesktopApi] = useState<any>(null);

  if (products.length === 0) {
    return (
      <div className="text-center py-16">
        <p className="text-lg text-muted-foreground">
          No se encontraron productos que coincidan con los filtros seleccionados.
        </p>
        <Button 
          onClick={onClearFilters}
          variant="outline"
          className="mt-4"
        >
          Limpiar filtros
        </Button>
      </div>
    );
  }

  // Configuración de productos por página
  const productsPerPageMobile = 1;
  const productsPerPageDesktop = 6; // 3x2 grid
  
  // Crear páginas para mobile (1 producto por página para navegación fluida)
  const mobilePages = products.map(product => [product]);
  
  // Crear páginas para desktop (6 productos por página en orden secuencial)
  const desktopPages = [];
  for (let i = 0; i < products.length; i += productsPerPageDesktop) {
    desktopPages.push(products.slice(i, i + productsPerPageDesktop));
  }

  // Funciones para navegar a páginas específicas
  const goToMobilePage = (pageIndex: number) => {
    setCurrentMobilePage(pageIndex);
    if (mobileApi) {
      mobileApi.scrollTo(pageIndex);
    }
  };

  const goToDesktopPage = (pageIndex: number) => {
    setCurrentDesktopPage(pageIndex);
    if (desktopApi) {
      desktopApi.scrollTo(pageIndex);
    }
  };

  const goToPreviousMobile = () => {
    const prevIndex = currentMobilePage > 0 ? currentMobilePage - 1 : mobilePages.length - 1;
    setCurrentMobilePage(prevIndex);
    if (mobileApi) {
      mobileApi.scrollTo(prevIndex);
    }
  };

  const goToNextMobile = () => {
    const nextIndex = currentMobilePage < mobilePages.length - 1 ? currentMobilePage + 1 : 0;
    setCurrentMobilePage(nextIndex);
    if (mobileApi) {
      mobileApi.scrollTo(nextIndex);
    }
  };

  const goToPreviousDesktop = () => {
    const prevIndex = currentDesktopPage > 0 ? currentDesktopPage - 1 : desktopPages.length - 1;
    setCurrentDesktopPage(prevIndex);
    if (desktopApi) {
      desktopApi.scrollTo(prevIndex);
    }
  };

  const goToNextDesktop = () => {
    const nextIndex = currentDesktopPage < desktopPages.length - 1 ? currentDesktopPage + 1 : 0;
    setCurrentDesktopPage(nextIndex);
    if (desktopApi) {
      desktopApi.scrollTo(nextIndex);
    }
  };

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
                <button
                  key={index} 
                  onClick={() => goToMobilePage(index)}
                  className={`rounded-full bg-green-500 text-white flex items-center justify-center font-medium shadow-lg transition-all duration-200 hover:bg-green-600 cursor-pointer ${
                    index === currentMobilePage 
                      ? 'w-10 h-10 text-base ring-2 ring-green-300' 
                      : 'w-8 h-8 text-sm opacity-70'
                  }`}
                >
                  {index + 1}
                </button>
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
      <div className="md:hidden -mx-4 relative">
        <Carousel 
          className="w-full px-4" 
          opts={{ align: "start", loop: true }}
          setApi={(api) => {
            setMobileApi(api);
            // No necesitamos el listener "select" aquí ya que manejamos el estado manualmente
          }}
        >
          <CarouselContent className="-ml-2">
            {mobilePages.map((pageProducts, pageIndex) => (
              <CarouselItem key={pageIndex} className="pl-2 basis-full">
                <div className="grid grid-cols-1 gap-4 px-2 auto-rows-fr items-stretch">
                  {pageProducts.map((product) => (
                    <div key={product.id} className="flex h-full">
                      <ProductCard
                        key={product.id}
                        product={product}
                        onAddToCart={onAddToCart}
                        onViewProduct={onViewProduct}
                        isMobile={true}
                      />
                    </div>
                  ))}
                </div>
              </CarouselItem>
            ))}
          </CarouselContent>
          <CarouselPrevious className="left-2" onClick={goToPreviousMobile} />
          <CarouselNext className="right-2" onClick={goToNextMobile} />
        </Carousel>

        {/* Mobile Pagination Dots */}
        {mobilePages.length > 1 && (
          <div className="flex justify-center mt-6">
            <div className="flex gap-2">
              {mobilePages.map((_, index) => (
                <button
                  key={index} 
                  onClick={() => goToMobilePage(index)}
                  className={`rounded-full bg-green-500 text-white flex items-center justify-center font-medium shadow-lg transition-all duration-200 hover:bg-green-600 cursor-pointer ${
                    index === currentMobilePage 
                      ? 'w-10 h-10 text-base ring-2 ring-green-300' 
                      : 'w-8 h-8 text-sm opacity-70'
                  }`}
                >
                  {index + 1}
                </button>
              ))}
            </div>
          </div>
        )}
      </div>

      {/* Desktop Carousel (6 products per page in 3x2 grid) */}
      <div className="hidden md:block relative">
        {/* Desktop Pagination Dots */}
        {desktopPages.length > 1 && (
          <div className="flex justify-center items-center mb-6 w-full">
            <div className="flex gap-2 items-center justify-center">
              {desktopPages.map((_, index) => (
                <button
                  key={index} 
                  onClick={() => goToDesktopPage(index)}
                  className={`rounded-full bg-green-500 text-white flex items-center justify-center font-medium shadow-lg transition-all duration-200 hover:bg-green-600 cursor-pointer ${
                    index === currentDesktopPage 
                      ? 'w-10 h-10 text-base ring-2 ring-green-300' 
                      : 'w-8 h-8 text-sm opacity-70'
                  }`}
                >
                  {index + 1}
                </button>
              ))}
            </div>
          </div>
        )}
        
        <Carousel 
          className="w-full" 
          opts={{ align: "start", loop: true }}
          setApi={(api) => {
            setDesktopApi(api);
            // No necesitamos el listener "select" aquí ya que manejamos el estado manualmente
          }}
        >
          <CarouselContent className="-ml-0">
            {desktopPages.map((pageProducts, pageIndex) => (
              <CarouselItem key={pageIndex} className="pl-0 basis-full">
                <div className="grid grid-cols-3 gap-6 auto-rows-fr items-stretch">
                  {pageProducts.map((product) => (
                    <div key={product.id} className="flex h-full">
                      <ProductCard
                        product={product}
                        onAddToCart={onAddToCart}
                        onViewProduct={onViewProduct}
                        isMobile={false}
                      />
                    </div>
                  ))}
                </div>
              </CarouselItem>
            ))}
          </CarouselContent>
          <CarouselPrevious className="left-4" onClick={goToPreviousDesktop} />
          <CarouselNext className="right-4" onClick={goToNextDesktop} />
        </Carousel>
      </div>
    </div>
  );
};

export default ProductGrid;