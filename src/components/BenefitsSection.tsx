import { 
  HeartIcon, 
  GlobeAltIcon, 
  ShieldCheckIcon, 
  TruckIcon,
  AcademicCapIcon,
  ArrowPathIcon 
} from "@heroicons/react/24/outline";
import { Button } from "@/components/ui/button";
import { Link } from "react-router-dom";

const benefits = [
  {
    icon: HeartIcon,
    title: "Salud y Bienestar",
    description: "Productos naturales que cuidan tu salud con ingredientes 100% orgánicos"
  },
  {
    icon: GlobeAltIcon,
    title: "Sostenibilidad",
    description: "Comprometidos con el medio ambiente y prácticas sustentables"
  },
  {
    icon: ArrowPathIcon,
    title: "Economía Circular",
    description: "Transformamos residuos en recursos valiosos a través del compostaje"
  },
  {
    icon: TruckIcon,
    title: "Producción Local",
    description: "Cultivado y producido en Pudahuel, apoyando la economía local"
  },
  {
    icon: AcademicCapIcon,
    title: "Educación Ambiental",
    description: "Talleres y capacitaciones para promover hábitos sustentables"
  },
  {
    icon: ShieldCheckIcon,
    title: "Calidad Certificada",
    description: "Productos con estándares de calidad y certificaciones orgánicas"
  },
];

const BenefitsSection = () => {
  return (
    <section className="py-20 bg-muted/30">
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
            return (
              <div 
                key={index}
                className="group bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-border/50 hover:border-primary/20"
              >
                <div className="flex flex-col items-center text-center">
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
              </div>
            );
          })}
        </div>

        {/* CTA Section */}
        <div className="mt-16 text-center">
          <div className="bg-primary/5 rounded-2xl p-8 border border-primary/20">
            <h3 className="text-2xl font-serif font-semibold text-foreground mb-3">
              ¿Listo para hacer el cambio hacia lo natural?
            </h3>
            <p className="text-muted-foreground mb-6 max-w-2xl mx-auto">
              Únete a las más de 500 empresas que ya confían en nuestros productos 
              orgánicos para cuidar la salud de sus colaboradores.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Button className="bg-primary text-primary-foreground hover:bg-primary/90">
                Solicitar Catálogo B2B
              </Button>
              <Button asChild variant="outline" className="border-primary text-primary hover:bg-primary hover:text-primary-foreground">
                <Link to="/productos">Ver Productos</Link>
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default BenefitsSection;