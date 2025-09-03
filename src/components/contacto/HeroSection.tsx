import React, { useRef, useEffect } from "react";
import { Badge } from "@/components/ui/badge";

const HeroSection = () => {
  const parallaxRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const handleScroll = () => {
      const scrolled = window.pageYOffset;
      const speed = 0.5;

      if (parallaxRef.current) {
        parallaxRef.current.style.transform = `translateY(${scrolled * speed}px)`;
      }
    };
    
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <section className="relative py-16 overflow-hidden">
      {/* Parallax Background */}
      <div 
        ref={parallaxRef} 
        className="absolute inset-0 bg-cover bg-center transform scale-110" 
        style={{
          backgroundImage: `url(/lovable-uploads/21a1dd2c-ac23-49be-bc0a-657cbbd497c8.png)`,
          willChange: 'transform'
        }}
      />
      {/* Overlay */}
      <div className="absolute inset-0 bg-black/40" />
      
      <div className="u-container relative z-10">
        <div className="max-w-3xl">
          <h1 className="text-4xl md:text-5xl font-serif font-bold text-white mb-4 drop-shadow-lg">
            Contáctanos
          </h1>
          <p className="text-lg text-white/90 mb-6 drop-shadow-md">
            Estamos aquí para ayudarte. Contáctanos para cotizaciones, consultas 
            o para conocer más sobre nuestros productos y talleres.
          </p>
          <Badge className="bg-white/90 text-primary border-white/20 backdrop-blur-sm">
            Respuesta en menos de 24 horas
          </Badge>
        </div>
      </div>
    </section>
  );
};

export default HeroSection;