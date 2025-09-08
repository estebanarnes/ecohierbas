import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { MagnifyingGlassIcon, AdjustmentsHorizontalIcon } from "@heroicons/react/24/solid";
import { productService } from "@/services/wordpress";

interface ProductFiltersProps {
  searchTerm: string;
  setSearchTerm: (value: string) => void;
  selectedCategory: string;
  setSelectedCategory: (value: string) => void;
  selectedFinalidad: string;
  setSelectedFinalidad: (value: string) => void;
  priceFilter: string;
  setPriceFilter: (value: string) => void;
}

const ProductFilters = ({
  searchTerm,
  setSearchTerm,
  selectedCategory,
  setSelectedCategory,
  selectedFinalidad,
  setSelectedFinalidad,
  priceFilter,
  setPriceFilter
}: ProductFiltersProps) => {
  return (
    <section className="py-4 md:py-8 bg-white/80 backdrop-blur-sm border-b border-border rounded-lg mx-4 md:mx-8 mb-4">
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
                    {productService.getCategories().map(category => (
                      <SelectItem key={category} value={category}>{category}</SelectItem>
                    ))}
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
                    {productService.getFinalidades().map(finalidad => (
                      <SelectItem key={finalidad} value={finalidad}>{finalidad}</SelectItem>
                    ))}
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
  );
};

export default ProductFilters;