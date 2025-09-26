import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { ArrowUpRightIcon } from "@heroicons/react/24/outline";

const SomosLokalSection = () => {
  return (
    <section className="py-16 bg-gradient-to-br from-primary/5 via-background to-primary/10">
      <div className="u-container">
        <div className="max-w-4xl mx-auto">
          <Card className="overflow-hidden border-primary/20 shadow-lg bg-white/80 backdrop-blur-sm">
            <CardContent className="p-8 md:p-12">
              <div className="text-center space-y-6">
                {/* Logo/Badge */}
                <div className="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 border border-primary/20">
                  <span className="text-2xl font-bold text-primary">L</span>
                </div>
                
                {/* Title */}
                <div className="space-y-3">
                  <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground">
                    Somos <span className="text-primary">Lokal</span>
                  </h2>
                  <p className="text-lg text-muted-foreground max-w-2xl mx-auto leading-relaxed">
                    Creemos en el comercio local y los productos cercanos. 
                    Por eso, también puedes encontrar nuestros productos en la plataforma Lokal, 
                    apoyando el ecosistema de emprendedores chilenos.
                  </p>
                </div>

                {/* Features */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">
                  <div className="text-center space-y-2">
                    <div className="w-12 h-12 mx-auto rounded-full bg-primary/10 flex items-center justify-center">
                      <span className="text-primary font-semibold">🇨🇱</span>
                    </div>
                    <h3 className="font-semibold text-foreground">100% Chileno</h3>
                    <p className="text-sm text-muted-foreground">Productos locales de calidad</p>
                  </div>
                  
                  <div className="text-center space-y-2">
                    <div className="w-12 h-12 mx-auto rounded-full bg-primary/10 flex items-center justify-center">
                      <span className="text-primary font-semibold">🤝</span>
                    </div>
                    <h3 className="font-semibold text-foreground">Apoyo Local</h3>
                    <p className="text-sm text-muted-foreground">Fortalecemos emprendedores</p>
                  </div>
                  
                  <div className="text-center space-y-2">
                    <div className="w-12 h-12 mx-auto rounded-full bg-primary/10 flex items-center justify-center">
                      <span className="text-primary font-semibold">🌱</span>
                    </div>
                    <h3 className="font-semibold text-foreground">Sustentable</h3>
                    <p className="text-sm text-muted-foreground">Compromiso con el planeta</p>
                  </div>
                </div>

                {/* CTA Button */}
                <div className="pt-4">
                  <Button 
                    size="lg"
                    className="bg-primary hover:bg-primary/90 text-white px-8 py-6 text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                    onClick={() => window.open('https://lokal.cl', '_blank', 'noopener,noreferrer')}
                  >
                    Visitar Lokal
                    <ArrowUpRightIcon className="ml-2 w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform duration-300" />
                  </Button>
                  <p className="text-sm text-muted-foreground mt-3">
                    Descubre más emprendedores locales
                  </p>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </section>
  );
};

export default SomosLokalSection;