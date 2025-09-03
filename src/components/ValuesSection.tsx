import { 
  HeartIcon, 
  GlobeAltIcon, 
  AcademicCapIcon,
  ArrowPathIcon,
  ShieldCheckIcon,
  UserGroupIcon
} from "@heroicons/react/24/outline";

const valores = [
  {
    icon: HeartIcon,
    title: "Salud y Bienestar",
    description: "Promovemos el bienestar integral a través de productos naturales que nutren cuerpo y alma.",
    image: "/src/assets/productos-hierbas.jpg"
  },
  {
    icon: GlobeAltIcon,
    title: "Sostenibilidad",
    description: "Cada decisión que tomamos considera el impacto ambiental para las futuras generaciones.",
    image: "/src/assets/hero-ecohierbas.jpg"
  },
  {
    icon: AcademicCapIcon,
    title: "Educación",
    description: "Compartimos conocimiento para que más personas adopten un estilo de vida sustentable.",
    image: "/src/assets/maceteros-kits.jpg"
  },
  {
    icon: ArrowPathIcon,
    title: "Innovación",
    description: "Buscamos constantemente nuevas formas de crear productos que respeten el medio ambiente.",
    image: "/src/assets/vermicompostaje.jpg"
  },
  {
    icon: ShieldCheckIcon,
    title: "Calidad",
    description: "Nos comprometemos con los más altos estándares en cada producto que ofrecemos.",
    image: "/src/assets/productos-hierbas.jpg"
  },
  {
    icon: UserGroupIcon,
    title: "Comunidad",
    description: "Creemos en el poder de la comunidad para generar cambios positivos y duraderos.",
    image: "/src/assets/hero-ecohierbas.jpg"
  }
];

const ValuesSection = () => {
  return (
    <section className="py-20 bg-muted/20">
      <div className="u-container">
        <div className="text-center max-w-3xl mx-auto mb-16">
          <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
            Nuestros Valores
          </h2>
          <p className="text-lg text-muted-foreground">
            Los principios que guían cada decisión y acción en EcoHierbas Chile
          </p>
        </div>

        <div className="u-grid u-grid--cols-3 lg:grid-cols-3 gap-8">
          {valores.map((valor, index) => {
            const IconComponent = valor.icon;
            return (
              <div key={index} className="group h-64 [perspective:1000px]">
                <div className="relative w-full h-full [transform-style:preserve-3d] transition-all duration-700 group-hover:[transform:rotateY(180deg)]">
                  {/* Front Face - Original Card */}
                  <div className="absolute inset-0 w-full h-full bg-white rounded-xl p-6 shadow-sm border border-border/50 [backface-visibility:hidden] flex flex-col items-center text-center justify-center">
                    <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors">
                      <IconComponent className="w-6 h-6 text-primary" />
                    </div>
                    <h3 className="text-lg font-semibold text-foreground mb-2">
                      {valor.title}
                    </h3>
                    <p className="text-muted-foreground text-sm leading-relaxed">
                      {valor.description}
                    </p>
                  </div>

                  {/* Back Face - Image */}
                  <div className="absolute inset-0 w-full h-full bg-white rounded-xl shadow-sm border border-border/50 [backface-visibility:hidden] [transform:rotateY(180deg)] overflow-hidden">
                    <div className="relative w-full h-full">
                      <img src={valor.image} alt={valor.title} className="w-full h-full object-cover rounded-xl" />
                      
                      <div className="absolute bottom-4 left-4 right-4 text-white">
                        <h3 className="text-lg font-semibold mb-1">
                          {valor.title}
                        </h3>
                        <p className="text-sm opacity-90">
                          Ver más detalles
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
};

export default ValuesSection;