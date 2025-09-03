import React, { useRef, useEffect } from "react";
import { Card, CardContent } from "@/components/ui/card";
import faqBackground from "@/assets/faq-background.jpg";

const FAQSection = () => {
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

  const faqs = [
    {
      question: "¿Hacen envíos a todo Chile?",
      answer: "Sí, realizamos envíos a todo Chile. Los tiempos de entrega varían según la región, entre 2-7 días hábiles."
    },
    {
      question: "¿Ofrecen descuentos por volumen?",
      answer: "Sí, tenemos precios especiales para empresas y compras corporativas. Contáctanos para una cotización personalizada."
    },
    {
      question: "¿Los productos están certificados?",
      answer: "Todos nuestros productos cuentan con certificación orgánica y cumplen con los estándares de calidad nacional."
    },
    {
      question: "¿Realizan talleres presenciales?",
      answer: "Sí, realizamos talleres presenciales en nuestras instalaciones y también podemos ir a tu empresa."
    }
  ];

  return (
    <section className="py-16 relative overflow-hidden min-h-[600px]">
      {/* Background Image */}
      <div 
        ref={parallaxRef}
        className="absolute inset-0 bg-cover bg-center bg-no-repeat"
        style={{
          backgroundImage: `url(${faqBackground})`,
          willChange: 'transform'
        }}
      />
      
      {/* Overlay */}
      <div className="absolute inset-0 bg-black/40" />
      
      {/* Content */}
      <div className="relative z-10 u-container">
        <div className="text-center max-w-3xl mx-auto mb-12">
          <h2 className="text-3xl font-serif font-bold text-white mb-4 drop-shadow-lg">
            Preguntas Frecuentes
          </h2>
          <p className="text-white/90 drop-shadow-md">
            Encuentra respuestas rápidas a las consultas más comunes
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
          {faqs.map((faq, index) => (
            <Card key={index} className="bg-white/10 border-white/20 backdrop-blur-sm">
              <CardContent className="p-6">
                <h3 className="font-semibold text-white mb-2">
                  {faq.question}
                </h3>
                <p className="text-white/80 text-sm">
                  {faq.answer}
                </p>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </section>
  );
};

export default FAQSection;