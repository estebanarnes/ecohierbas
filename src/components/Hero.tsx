import { Button } from "@/components/ui/button";
import { ArrowRightIcon, PlayIcon } from "@heroicons/react/24/outline";
import { Link } from "react-router-dom";
import { useEffect, useRef } from "react";
import heroImage from "@/assets/hero-ecohierbas.jpg";

const Hero = () => {
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
    <section className="relative h-[120vh] flex items-center overflow-hidden -mt-[5px] pb-[15px] lg:pb-[25px]">
      {/* Parallax Background */}
      <div 
        ref={parallaxRef}
        className="absolute inset-0 bg-cover bg-center transform scale-110"
        style={{
          backgroundImage: `url(/lovable-uploads/d9ef91ad-5427-4c86-8851-614ac592b7ff.png)`,
          willChange: 'transform'
        }}
      ></div>
      
      {/* Overlay */}
      <div className="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>

      {/* Content */}
      <div className="relative z-20 u-container -mt-[10px]">
        <div className="max-w-3xl">
          {/* Badge */}
          <div className="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary mb-6 backdrop-blur-sm">
            <span className="mr-2">🌱</span>
            Productos orgánicos certificados desde 2015
          </div>

          {/* Headline */}
          <h1 className="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight">
            Hierbas medicinales
            <span className="text-accent"> orgánicas</span>
            <br />
            para tu bienestar
          </h1>

          {/* Subtitle */}
          <p className="text-lg md:text-xl text-white/90 mb-8 max-w-2xl leading-relaxed">
            Descubre nuestra selección de hierbas medicinales, productos de vermicompostaje
            y soluciones ecológicas para empresas conscientes y familias que cuidan su salud.
          </p>

          {/* CTAs */}
          <div className="flex flex-col sm:flex-row gap-4 mb-8">
            <Button size="lg" className="bg-primary hover:bg-primary/90 text-white px-8 py-4 h-auto" data-variant="b2b">
              Cotización Corporativa
              <ArrowRightIcon className="ml-2 w-5 h-5" />
            </Button>
            <Button asChild size="lg" className="bg-white text-primary hover:bg-white/90 font-medium">
              <Link to="/productos">Ver Productos</Link>
            </Button>
          </div>

          {/* Stats */}
          <div className="grid grid-cols-3 gap-6 max-w-md">
            <div className="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20 animate-float hover:animate-none transition-all duration-300">
              <div className="text-2xl md:text-3xl font-bold text-white">100+</div>
              <div className="text-sm text-white/80">Empresas confían</div>
            </div>
            <div className="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20 animate-float hover:animate-none transition-all duration-300" style={{
            animationDelay: '0.5s'
          }}>
              <div className="text-2xl md:text-3xl font-bold text-white">100%</div>
              <div className="text-sm text-white/80">Orgánico</div>
            </div>
            <div className="text-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20 animate-float hover:animate-none transition-all duration-300" style={{
            animationDelay: '1s'
          }}>
              <div className="text-2xl md:text-3xl font-bold text-white">Local</div>
              <div className="text-sm text-white/80">Pudahuel, RM</div>
            </div>
          </div>
        </div>
      </div>

      {/* Scroll indicator */}
      <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        
      </div>
    </section>
  );
};

export default Hero;