import { HeartIcon, GlobeAltIcon, ShieldCheckIcon, TruckIcon, AcademicCapIcon, ArrowPathIcon } from "@heroicons/react/24/outline";
import { Button } from "@/components/ui/button";
import { Link } from "react-router-dom";
const benefits = [{
  icon: HeartIcon,
  title: "Salud y Bienestar",
  description: "Productos naturales que cuidan tu salud con ingredientes 100% orgánicos",
  image: "/src/assets/productos-hierbas.jpg"
}, {
  icon: GlobeAltIcon,
  title: "Sostenibilidad",
  description: "Comprometidos con el medio ambiente y prácticas sustentables",
  image: "/src/assets/hero-ecohierbas.jpg"
}, {
  icon: ArrowPathIcon,
  title: "Economía Circular",
  description: "Transformamos residuos en recursos valiosos a través del compostaje",
  image: "/src/assets/vermicompostaje.jpg"
}, {
  icon: TruckIcon,
  title: "Producción Local",
  description: "Cultivado y producido en Pudahuel, apoyando la economía local",
  image: "/src/assets/maceteros-kits.jpg"
}, {
  icon: AcademicCapIcon,
  title: "Educación Ambiental",
  description: "Talleres y capacitaciones para promover hábitos sustentables",
  image: "/src/assets/productos-hierbas.jpg"
}, {
  icon: ShieldCheckIcon,
  title: "Calidad Certificada",
  description: "Productos con estándares de calidad y certificaciones orgánicas",
  image: "/src/assets/hero-ecohierbas.jpg"
}];
const BenefitsSection = () => {
  return <section className="relative -mt-32 mx-2.5 py-20 bg-muted/30 rounded-t-3xl">
      <div className="u-container">
        {/* Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-3 bg-primary/10 text-primary px-6 py-3 rounded-full text-base font-medium mb-4">
            <TruckIcon className="w-5 h-5" />
            Envíos a todo Chile
          </div>
          <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
            ¿Por qué elegir EcoHierbas Chile?
          </h2>
          <p className="text-lg text-muted-foreground">
            Más que productos naturales, somos una empresa comprometida con tu bienestar 
            y el cuidado del planeta. Conoce los valores que nos impulsan.
          </p>
        </div>

        {/* Benefits Grid */}
        <div className="u-grid u-grid--cols-3 lg:grid-cols-3 gap-8">
          {benefits.map((benefit, index) => {
          const IconComponent = benefit.icon;
          return <div key={index} className="group h-64 [perspective:1000px]">
                <div className="relative w-full h-full [transform-style:preserve-3d] transition-all duration-700 group-hover:[transform:rotateY(180deg)]">
                  {/* Front Face - Original Card */}
                  <div className="absolute inset-0 w-full h-full bg-white rounded-xl p-6 shadow-sm border border-border/50 [backface-visibility:hidden] flex flex-col items-center text-center justify-center">
                    <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors">
                      <IconComponent className="w-6 h-6 text-primary" />
                    </div>
                    <h3 className="text-lg font-semibold text-foreground mb-2">
                      {benefit.title}
                    </h3>
                    <p className="text-muted-foreground text-sm leading-relaxed">
                      {benefit.description}
                    </p>
                  </div>

                  {/* Back Face - Image */}
                  <div className="absolute inset-0 w-full h-full bg-white rounded-xl shadow-sm border border-border/50 [backface-visibility:hidden] [transform:rotateY(180deg)] overflow-hidden">
                    <div className="relative w-full h-full">
                      <img src={benefit.image} alt={benefit.title} className="w-full h-full object-cover rounded-xl" />
                      
                      <div className="absolute bottom-4 left-4 right-4 text-white">
                        <h3 className="text-lg font-semibold mb-1">
                          {benefit.title}
                        </h3>
                        <p className="text-sm opacity-90">
                          Ver más detalles
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>;
        })}
        </div>

        {/* CTA Section */}
        <div className="mt-16 text-center">
          
        </div>
      </div>
    </section>;
};
export default BenefitsSection;