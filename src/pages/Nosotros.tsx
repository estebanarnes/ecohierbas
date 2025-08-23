import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
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
        <section className="py-20 bg-gradient-to-b from-primary/5 to-background">
          <div className="u-container">
            <div className="max-w-4xl mx-auto text-center">
              <Badge className="mb-6 bg-primary/10 text-primary border-primary/20">
                Nuestra Historia
              </Badge>
              <h1 className="text-4xl md:text-5xl font-serif font-bold text-foreground mb-6">
                EcoHierbas Chile
              </h1>
              <p className="text-xl text-muted-foreground leading-relaxed">
                Somos JAFER SPA, una microempresa chilena fundada en 2015 con la misión de 
                promover la salud natural y la sostenibilidad ambiental a través de productos 
                orgánicos de la más alta calidad.
              </p>
            </div>
          </div>
        </section>

        {/* Historia */}
        <section className="py-20">
          <div className="u-container">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
              <div>
                <h2 className="text-3xl font-serif font-bold text-foreground mb-6">
                  Nuestra Historia
                </h2>
                <div className="space-y-4 text-muted-foreground leading-relaxed">
                  <p>
                    Todo comenzó en 2015 en Pudahuel, Región Metropolitana, cuando decidimos 
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
                      <div className="text-sm text-muted-foreground">Fundación de JAFER SPA</div>
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

        {/* Valores */}
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

            <div className="u-grid u-grid--cols-3 gap-8">
              {valores.map((valor, index) => {
              const IconComponent = valor.icon;
              return <Card key={index} className="bg-white border-border/50 hover:border-primary/20 transition-all duration-300">
                    <CardContent className="p-6 text-center">
                      <div className="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <IconComponent className="w-6 h-6 text-primary" />
                      </div>
                      <h3 className="text-lg font-semibold text-foreground mb-3">
                        {valor.title}
                      </h3>
                      <p className="text-muted-foreground text-sm leading-relaxed">
                        {valor.description}
                      </p>
                    </CardContent>
                  </Card>;
            })}
            </div>
          </div>
        </section>

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
                <div className="w-20 h-20 bg-primary/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/20 transition-colors">
                  <span className="text-2xl font-bold text-primary">MC</span>
                </div>
                <h3 className="font-semibold text-foreground mb-2">Marca Chile</h3>
                <p className="text-xs text-muted-foreground">Sello de calidad nacional</p>
              </div>
              
              <div className="text-center group">
                
                <h3 className="font-semibold text-foreground mb-2">HACCP</h3>
                <p className="text-xs text-muted-foreground">Certificación Internacional</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors">
                  <span className="text-lg font-bold text-purple-600">F</span>
                </div>
                <h3 className="font-semibold text-foreground mb-2">Falabella.com</h3>
                <p className="text-xs text-muted-foreground">Marketplace líder</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-200 transition-colors">
                  <span className="text-lg font-bold text-yellow-600">ML</span>
                </div>
                <h3 className="font-semibold text-foreground mb-2">Mercado Libre</h3>
                <p className="text-xs text-muted-foreground">Plataforma de ventas</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                  <ArrowPathIcon className="w-10 h-10 text-green-600" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">RedPyme Circular</h3>
                <p className="text-xs text-muted-foreground">Economía circular</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                  <UserGroupIcon className="w-10 h-10 text-blue-600" />
                </div>
                <h3 className="font-semibold text-foreground mb-2">Chile Graneles Unidos</h3>
                <p className="text-xs text-muted-foreground">Asociación gremial</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-200 transition-colors">
                  <span className="text-lg font-bold text-orange-600">C</span>
                </div>
                <h3 className="font-semibold text-foreground mb-2">CORFO</h3>
                <p className="text-xs text-muted-foreground">Fomento productivo</p>
              </div>
              
              <div className="text-center group">
                <div className="w-20 h-20 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-200 transition-colors">
                  <GlobeAltIcon className="w-10 h-10 text-emerald-600" />
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