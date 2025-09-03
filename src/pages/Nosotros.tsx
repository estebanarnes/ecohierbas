import ValuesSection from "@/components/ValuesSection";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "@/components/ui/carousel";
import { HeartIcon, GlobeAltIcon, AcademicCapIcon, ArrowPathIcon, ShieldCheckIcon, UserGroupIcon } from "@heroicons/react/24/outline";
const valores = [{
  icon: HeartIcon,
  title: "Salud y Bienestar",
  description: "Promovemos el bienestar integral a través de productos naturales que nutren cuerpo y alma."
}, {
  icon: GlobeAltIcon,
  title: "Sostenibilidad",
  description: "Cada decisión que tomamos considera el impacto ambiental para las futuras generaciones."
}, {
  icon: ArrowPathIcon,
  title: "Economía Circular",
  description: "Transformamos residuos en recursos, cerrando ciclos y minimizando desperdicios."
}, {
  icon: AcademicCapIcon,
  title: "Educación",
  description: "Compartimos conocimiento para empoderar a comunidades hacia prácticas sustentables."
}, {
  icon: ShieldCheckIcon,
  title: "Calidad",
  description: "Mantenemos los más altos estándares en todos nuestros procesos y productos."
}, {
  icon: UserGroupIcon,
  title: "Comunidad",
  description: "Fortalecemos redes locales y apoyamos el desarrollo económico regional."
}];
const Nosotros = () => {
  return <div className="min-h-screen bg-background">
      <Header />
      <main>
        {/* Hero Section */}
        <section className="h-[400px] bg-gradient-to-b from-primary/5 to-background relative overflow-hidden flex items-center">
          {/* Logo transparente de fondo */}
          <div className="absolute inset-0 flex items-center justify-center opacity-30 pointer-events-none z-0">
            <img src="/lovable-uploads/8b7e9f40-2cae-4354-85aa-4c6be95c0095.png" alt="EcoHierbas Chile Logo" className="w-96 h-96 object-contain" />
          </div>
          <div className="u-container relative z-10">
            <div className="max-w-4xl mx-auto text-center">
            </div>
          </div>
        </section>

        {/* Descripción */}
        <section className="py-8 relative">
          <div className="u-container">
            <div className="max-w-4xl mx-auto text-center">
              <p className="text-xl text-muted-foreground leading-relaxed">Somos una microempresa chilena fundada en 2015 con la misión de promover la salud natural y la sostenibilidad ambiental a través de productos orgánicos de la más alta calidad.</p>
            </div>
          </div>
        </section>
        <section className="py-20">
          <div className="u-container">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
              <div>
                <h2 className="text-3xl font-serif font-bold text-foreground mb-6">
                  Nuestra Historia
                </h2>
                <div className="space-y-4 text-muted-foreground leading-relaxed">
                  <p>
                    Todo comenzó en 2015 en San Vicente Tagua Tagua, VI Región, cuando decidimos 
                    crear una alternativa natural y sustentable para el cuidado de la salud.
                    Lo que inició como un pequeño emprendimiento familiar, hoy se ha convertido 
                    en una empresa referente en productos orgánicos.
                  </p>
                  <p>
                    Nuestro enfoque siempre ha sido integral: no solo ofrecemos hierbas 
                    medicinales de calidad premium, sino que también promovemos prácticas 
                    de economía circular a través de nuestros sistemas de vermicompostaje 
                    y talleres educativos.
                  </p>
                  <p>
                    Hoy, más de 500 empresas confían en nosotros para el bienestar de sus 
                    colaboradores, y miles de familias han adoptado un estilo de vida más 
                    consciente y saludable gracias a nuestros productos.
                  </p>
                </div>
              </div>
              <div className="bg-muted/30 rounded-2xl p-8">
                <h3 className="text-xl font-semibold text-foreground mb-6">Hitos Importantes</h3>
                <div className="space-y-4">
                  <div className="flex items-start gap-3">
                    <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                      <div className="font-medium text-foreground">2015</div>
                      <div className="text-sm text-muted-foreground">Fundación de Ecohierbas Chile</div>
                    </div>
                  </div>
                  <div className="flex items-start gap-3">
                    <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                      <div className="font-medium text-foreground">2018</div>
                      <div className="text-sm text-muted-foreground">Certificación orgánica</div>
                    </div>
                  </div>
                  <div className="flex items-start gap-3">
                    <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                      <div className="font-medium text-foreground">2020</div>
                      <div className="text-sm text-muted-foreground">Expansión a mercado B2B</div>
                    </div>
                  </div>
                  <div className="flex items-start gap-3">
                    <div className="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                      <div className="font-medium text-foreground">2023</div>
                      <div className="text-sm text-muted-foreground">500+ empresas aliadas</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Carrusel de Fotografías */}
        <section className="py-16 bg-background">
          <div className="u-container">
            <div className="text-center max-w-3xl mx-auto mb-12">
              <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">Nuestro día a día</h2>
              <p className="text-lg text-muted-foreground">
                Un recorrido visual por los momentos más importantes de EcoHierbas Chile
              </p>
            </div>

            <div className="relative max-w-6xl mx-auto">
              <Carousel className="w-full" opts={{
              align: "start",
              loop: true
            }}>
                <CarouselContent className="-ml-2 md:-ml-4">
                  <CarouselItem className="pl-2 md:pl-4 basis-full md:basis-1/2 lg:basis-1/3">
                    <Card className="border-border/50 overflow-hidden group hover:shadow-lg transition-all duration-300">
                      <div className="aspect-[4/3] overflow-hidden">
                        <img src="/lovable-uploads/600b2247-6f71-428e-b9b5-661118e80152.png" alt="Cultivos orgánicos de EcoHierbas" className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                      </div>
                      <CardContent className="p-4">
                        <h3 className="font-semibold text-foreground mb-2">Nuestros Cultivos</h3>
                        <p className="text-sm text-muted-foreground">Hierbas orgánicas cultivadas con los más altos estándares de calidad</p>
                      </CardContent>
                    </Card>
                  </CarouselItem>

                  <CarouselItem className="pl-2 md:pl-4 basis-full md:basis-1/2 lg:basis-1/3">
                    <Card className="border-border/50 overflow-hidden group hover:shadow-lg transition-all duration-300">
                      <div className="aspect-[4/3] overflow-hidden">
                        <img src="/lovable-uploads/539aefc2-235d-4d1f-812a-52c1f0acfa69.png" alt="Productos de hierbas medicinales" className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                      </div>
                      <CardContent className="p-4">
                        <h3 className="font-semibold text-foreground mb-2">Productos Premium</h3>
                        <p className="text-sm text-muted-foreground">Selección cuidadosa de hierbas medicinales para el bienestar</p>
                      </CardContent>
                    </Card>
                  </CarouselItem>

                  <CarouselItem className="pl-2 md:pl-4 basis-full md:basis-1/2 lg:basis-1/3">
                    <Card className="border-border/50 overflow-hidden group hover:shadow-lg transition-all duration-300">
                      <div className="aspect-[4/3] overflow-hidden">
                        <img src="/lovable-uploads/8adecc65-ccf3-4b16-baeb-71a26cb59adb.png" alt="Sistema de vermicompostaje" className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                      </div>
                      <CardContent className="p-4">
                        <h3 className="font-semibold text-foreground mb-2">Vermicompostaje</h3>
                        <p className="text-sm text-muted-foreground">Innovación en economía circular y sostenibilidad ambiental</p>
                      </CardContent>
                    </Card>
                  </CarouselItem>

                  <CarouselItem className="pl-2 md:pl-4 basis-full md:basis-1/2 lg:basis-1/3">
                    <Card className="border-border/50 overflow-hidden group hover:shadow-lg transition-all duration-300">
                      <div className="aspect-[4/3] overflow-hidden">
                        <img src="/lovable-uploads/a3b99036-3b8d-41c0-aff4-926a4f492193.png" alt="Kits de cultivo ecológico" className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                      </div>
                      <CardContent className="p-4">
                        <h3 className="font-semibold text-foreground mb-2">Kits Ecológicos</h3>
                        <p className="text-sm text-muted-foreground">Soluciones completas para cultivo urbano sustentable</p>
                      </CardContent>
                    </Card>
                  </CarouselItem>

                  

                  <CarouselItem className="pl-2 md:pl-4 basis-full md:basis-1/2 lg:basis-1/3">
                    <Card className="border-border/50 overflow-hidden group hover:shadow-lg transition-all duration-300">
                      <div className="aspect-[4/3] bg-gradient-to-br from-green-50 to-emerald-50 flex items-center justify-center">
                        <div className="text-center p-6">
                          <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <UserGroupIcon className="w-8 h-8 text-green-600" />
                          </div>
                          <h3 className="font-semibold text-foreground mb-2">Comunidad</h3>
                          <p className="text-sm text-muted-foreground">Más de 500 empresas y miles de familias</p>
                        </div>
                      </div>
                    </Card>
                  </CarouselItem>
                </CarouselContent>
                
                <CarouselPrevious className="left-4 bg-white/90 border-border/50 hover:bg-white" />
                <CarouselNext className="right-4 bg-white/90 border-border/50 hover:bg-white" />
              </Carousel>
            </div>
          </div>
        </section>

        <ValuesSection />

        {/* Propósito */}
        <section className="py-20">
          <div className="u-container">
            <div className="max-w-4xl mx-auto text-center">
              <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-6">
                Nuestro Propósito
              </h2>
              <p className="text-xl text-muted-foreground leading-relaxed mb-8">
                Crear un ecosistema de bienestar que integre la salud personal, 
                la sostenibilidad ambiental y el desarrollo comunitario, 
                demostrando que es posible generar valor económico mientras 
                cuidamos nuestro planeta y nuestra gente.
              </p>
              
              <div className="bg-primary/5 rounded-2xl p-8 border border-primary/20">
                <h3 className="text-2xl font-serif font-semibold text-foreground mb-4">
                  Visión 2030
                </h3>
                <p className="text-muted-foreground leading-relaxed">
                  Ser la empresa líder en Chile en productos orgánicos y soluciones de 
                  economía circular, reconocida por nuestra contribución al bienestar 
                  de las personas y la regeneración del medio ambiente, inspirando 
                  a otras organizaciones a adoptar modelos de negocio sustentables.
                </p>
              </div>
            </div>
          </div>
        </section>

        {/* Alianzas Clave */}
        <section className="py-20 bg-muted/20">
          <div className="u-container">
            <div className="text-center max-w-3xl mx-auto mb-16">
              <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
                Alianzas Clave
              </h2>
              <p className="text-lg text-muted-foreground">
                Trabajamos junto a organizaciones líderes que comparten nuestra visión de sostenibilidad y calidad
              </p>
            </div>

            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/c5e2da9d-c47a-4ca3-9ed5-75ef2a952997.png" alt="Chile Logo" className="w-full h-full object-cover" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">Marca Chile</h3>
                <p className="text-xs text-muted-foreground">Sello de calidad nacional</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/4a215e72-3825-4f2c-9d97-b5cb71633acb.png" alt="HACCP Certification" className="w-full h-full object-contain" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">HACCP</h3>
                <p className="text-xs text-muted-foreground">Certificación Internacional</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/62b0a2e1-c6c9-4741-b664-cd8421e6135e.png" alt="Falabella.com" className="w-full h-full object-contain" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">Falabella.com</h3>
                <p className="text-xs text-muted-foreground">Marketplace líder</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/3fb978b6-70af-4293-9f46-eb9844c19a47.png" alt="Mercado Libre" className="w-full h-full object-contain" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">Mercado Libre</h3>
                <p className="text-xs text-muted-foreground">Plataforma de ventas</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/45017a15-9474-4d46-9468-ede70b81f9d7.png" alt="RedPyme Circular" className="w-full h-full object-contain" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">RedPyme Circular</h3>
                <p className="text-xs text-muted-foreground">Economía circular</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/75e6d464-d3f5-4378-8810-f0301e10fae2.png" alt="Graneles Unidos Asociación Chile" className="w-full h-full object-contain" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">Chile Graneles Unidos</h3>
                <p className="text-xs text-muted-foreground">Asociación gremial</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/e09d1167-229e-4e24-a22f-81907be2c8c3.png" alt="CORFO" className="w-full h-full object-contain" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">CORFO</h3>
                <p className="text-xs text-muted-foreground">Fomento productivo</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 overflow-hidden">
                  <img src="/lovable-uploads/6189ac3f-96cd-4e3f-83f5-c3cde048b03a.png" alt="Eco Mercado Verde" className="w-full h-full object-contain" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">Eco Mercado Verde</h3>
                <p className="text-xs text-muted-foreground">Marketplace sustentable</p>
              </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>;
};
export default Nosotros;