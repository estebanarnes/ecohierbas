import { useState } from "react";
import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Sheet, SheetContent, SheetTrigger } from "@/components/ui/sheet";
import { Bars3Icon, ShoppingCartIcon } from "@heroicons/react/24/outline";
import { useCart } from "@/contexts/CartContext";
import B2BQuoteForm from "@/components/B2BQuoteForm";

const Header = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [showQuoteForm, setShowQuoteForm] = useState(false);
  const { state, toggleCart } = useCart();

  const navigation = [
    { name: "Inicio", href: "/" },
    { name: "Nosotros", href: "/nosotros" },
    { name: "Productos", href: "/productos" },
    { name: "Contacto", href: "/contacto" },
  ];

  return (
    <header className="bg-white/10 backdrop-blur-lg border-b border-white/20 sticky top-0 z-50 shadow-lg shadow-black/5">
      <div className="u-container">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <Link to="/" className="flex items-center space-x-2">
            <img 
              src="/lovable-uploads/9ea5ebd8-40a7-4c66-a3bc-1777813399af.png" 
              alt="EcoHierbas Chile" 
              className="w-16 h-16 object-contain"
            />
            <div className="flex flex-col">
              <span className="text-lg font-serif font-semibold text-primary">EcoHierbas</span>
              <span className="text-xs text-muted-foreground -mt-1">Chile</span>
            </div>
          </Link>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center space-x-8">
            {navigation.map((item) => (
              <Link
                key={item.name}
                to={item.href}
                className="text-foreground hover:text-primary transition-colors font-medium"
              >
                {item.name}
              </Link>
            ))}
          </nav>

          {/* Desktop Actions */}
          <div className="hidden md:flex items-center space-x-4">
            <Button 
              variant="ghost" 
              size="icon" 
              className="relative"
              onClick={toggleCart}
            >
              <ShoppingCartIcon className="w-5 h-5" />
              {state.totalItems > 0 && (
                <span className="absolute -top-1 -right-1 bg-accent text-accent-foreground text-xs rounded-full w-5 h-5 flex items-center justify-center">
                  {state.totalItems}
                </span>
              )}
            </Button>
            <Button 
              className="bg-primary hover:bg-primary/90"
              onClick={() => setShowQuoteForm(true)}
            >
              Cotizar B2B
            </Button>
          </div>

          {/* Mobile menu button */}
          <div className="md:hidden">
            <Sheet open={isOpen} onOpenChange={setIsOpen}>
              <SheetTrigger asChild>
                <Button variant="ghost" size="icon">
                  <Bars3Icon className="w-6 h-6" />
                </Button>
              </SheetTrigger>
              <SheetContent side="right" className="w-80">
                <div className="flex flex-col space-y-6 mt-6">
                  {navigation.map((item) => (
                    <Link
                      key={item.name}
                      to={item.href}
                      className="text-lg font-medium text-foreground hover:text-primary transition-colors"
                      onClick={() => setIsOpen(false)}
                    >
                      {item.name}
                    </Link>
                  ))}
                  <div className="pt-4 border-t border-border space-y-4">
                    <Button 
                      className="w-full bg-primary hover:bg-primary/90"
                      onClick={() => {
                        setShowQuoteForm(true);
                        setIsOpen(false);
                      }}
                    >
                      Cotizar B2B
                    </Button>
                  </div>
                </div>
              </SheetContent>
            </Sheet>
          </div>
        </div>
      </div>
      
      <B2BQuoteForm 
        isOpen={showQuoteForm} 
        onClose={() => setShowQuoteForm(false)} 
      />
    </header>
  );
};

export default Header;