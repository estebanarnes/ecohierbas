import { useEffect, useRef } from "react";
import { Badge } from "@/components/ui/badge";

interface HeroSectionProps {
  productCount: number;
}

const HeroSection = ({ productCount }: HeroSectionProps) => {
  const parallaxRef = useRef<HTMLDivElement>(null);

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

  return (
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
            {productCount} productos disponibles
          </Badge>
        </div>
      </div>
    </section>
  );
};

export default HeroSection;