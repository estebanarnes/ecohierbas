import React, { useEffect, useRef } from "react"; // FIXED: React hooks import for parallax functionality
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { 
  MapPinIcon, 
  PhoneIcon, 
  EnvelopeIcon,
  ClockIcon,
  ChatBubbleLeftRightIcon
} from "@heroicons/react/24/outline";

const Contacto = () => {
  const parallaxRef = useRef<HTMLDivElement>(null);
  const faqParallaxRef = useRef<HTMLDivElement>(null);

  // Parallax scroll effect for both hero and FAQ sections
  useEffect(() => {
    const handleScroll = () => {
      const scrolled = window.pageYOffset;
      const speed = 0.5;
      
      // Hero parallax
      if (parallaxRef.current) {
        parallaxRef.current.style.transform = `translateY(${scrolled * speed}px)`;
      }
      
      // FAQ parallax
      if (faqParallaxRef.current) {
        faqParallaxRef.current.style.transform = `translateY(${scrolled * speed}px)`;
        console.log('FAQ parallax applied:', scrolled * speed);
      }
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main>
        {/* Hero */}
        <section className="relative py-16 overflow-hidden">
          {/* Parallax Background */}
          <div 
            ref={parallaxRef}
            className="absolute inset-0 bg-cover bg-center transform scale-110"
            style={{
              backgroundImage: `url(/lovable-uploads/21a1dd2c-ac23-49be-bc0a-657cbbd497c8.png)`,
              willChange: 'transform'
            }}
          ></div>
          {/* Overlay */}
          <div className="absolute inset-0 bg-black/40"></div>
          
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

        {/* Contact Content */}
        <section className="py-16">
          <div className="u-container">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
              {/* Contact Form */}
              <div>
                <Card className="border-border/50">
                  <CardHeader>
                    <CardTitle className="text-2xl font-serif">
                      Envíanos un mensaje
                    </CardTitle>
                    <p className="text-muted-foreground">
                      Completa el formulario y nos pondremos en contacto contigo pronto.
                    </p>
                  </CardHeader>
                  <CardContent className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label className="text-sm font-medium text-foreground mb-2 block">
                          Nombre *
                        </label>
                        <Input placeholder="Tu nombre completo" />
                      </div>
                      <div>
                        <label className="text-sm font-medium text-foreground mb-2 block">
                          Empresa
                        </label>
                        <Input placeholder="Nombre de tu empresa" />
                      </div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label className="text-sm font-medium text-foreground mb-2 block">
                          Email *
                        </label>
                        <Input type="email" placeholder="tu@email.com" />
                      </div>
                      <div>
                        <label className="text-sm font-medium text-foreground mb-2 block">
                          Teléfono
                        </label>
                        <Input placeholder="+56 9 1234 5678" />
                      </div>
                    </div>

                    <div>
                      <label className="text-sm font-medium text-foreground mb-2 block">
                        Tipo de consulta
                      </label>
                      <select className="w-full p-3 border border-input rounded-md bg-background">
                        <option>Selecciona una opción</option>
                        <option>Cotización B2B</option>
                        <option>Consulta sobre productos</option>
                        <option>Talleres y capacitaciones</option>
                        <option>Alianzas comerciales</option>
                        <option>Soporte técnico</option>
                        <option>Otros</option>
                      </select>
                    </div>

                    <div>
                      <label className="text-sm font-medium text-foreground mb-2 block">
                        Mensaje *
                      </label>
                      <Textarea 
                        placeholder="Cuéntanos cómo podemos ayudarte..."
                        className="min-h-[120px]"
                      />
                    </div>

                    <div className="flex items-start gap-3">
                      <input type="checkbox" className="mt-1" />
                      <p className="text-sm text-muted-foreground">
                        Acepto recibir comunicaciones comerciales de EcoHierbas Chile 
                        y confirmo que he leído la política de privacidad.
                      </p>
                    </div>

                    <Button size="lg" className="w-full bg-primary hover:bg-primary/90">
                      Enviar Mensaje
                    </Button>
                  </CardContent>
                </Card>
              </div>

              {/* Contact Info */}
              <div className="space-y-6">
                {/* Contact Details */}
                <Card className="border-border/50">
                  <CardHeader>
                    <CardTitle className="text-xl font-serif">
                      Información de Contacto
                    </CardTitle>
                  </CardHeader>
                  <CardContent className="space-y-4">
                    <div className="flex items-start gap-3">
                      <MapPinIcon className="w-5 h-5 text-primary mt-1 flex-shrink-0" />
                      <div>
                        <p className="font-medium text-foreground">Dirección</p>
                         <p className="text-muted-foreground text-sm">
                           Camino El tambo, San Vicente Tagua Tagua<br />
                           VI Región, Chile
                         </p>
                      </div>
                    </div>

                    <div className="flex items-start gap-3">
                      <PhoneIcon className="w-5 h-5 text-primary mt-1 flex-shrink-0" />
                      <div>
                        <p className="font-medium text-foreground">Teléfono</p>
                        <p className="text-muted-foreground text-sm">+56 9 1234 5678</p>
                      </div>
                    </div>

                    <div className="flex items-start gap-3">
                      <EnvelopeIcon className="w-5 h-5 text-primary mt-1 flex-shrink-0" />
                      <div>
                        <p className="font-medium text-foreground">Email</p>
                        <p className="text-muted-foreground text-sm">contacto@ecohierbaschile.cl</p>
                      </div>
                    </div>

                    <div className="flex items-start gap-3">
                      <ClockIcon className="w-5 h-5 text-primary mt-1 flex-shrink-0" />
                      <div>
                        <p className="font-medium text-foreground">Horarios</p>
                        <p className="text-muted-foreground text-sm">
                          Lunes a Viernes: 9:00 - 18:00<br />
                          Sábados: 9:00 - 14:00<br />
                          Domingos: Cerrado
                        </p>
                      </div>
                    </div>
                  </CardContent>
                </Card>

                {/* WhatsApp */}
                <Card className="border-accent/30 bg-accent/5">
                  <CardContent className="p-6">
                    <div className="flex items-center gap-3 mb-4">
                      <ChatBubbleLeftRightIcon className="w-6 h-6 text-accent" />
                      <h3 className="font-semibold text-foreground">WhatsApp Business</h3>
                    </div>
                    <p className="text-muted-foreground mb-4 text-sm">
                      ¿Necesitas una respuesta rápida? Contáctanos por WhatsApp 
                      para consultas urgentes y cotizaciones express.
                    </p>
                    <Button 
                      className="w-full bg-accent hover:bg-accent/90"
                      size="lg"
                      asChild
                    >
                      <a 
                        href="https://wa.me/56912345678?text=Hola%20EcoHierbas%20Chile,%20me%20interesa%20conocer%20más%20sobre%20sus%20productos%20naturales%20y%20sustentables"
                        target="_blank"
                        rel="noopener noreferrer"
                      >
                        Escribir por WhatsApp
                      </a>
                    </Button>
                  </CardContent>
                </Card>

                {/* B2B Section */}
                <Card className="border-primary/30 bg-primary/5">
                  <CardContent className="p-6">
                    <h3 className="font-semibold text-foreground mb-2">
                      Clientes Corporativos B2B
                    </h3>
                    <p className="text-muted-foreground mb-4 text-sm">
                      Si representas una empresa y necesitas cotizaciones especiales, 
                      volúmenes corporativos o soluciones personalizadas, contáctanos 
                      directamente.
                    </p>
                    <Button 
                      variant="outline" 
                      className="w-full border-primary text-primary hover:bg-primary hover:text-primary-foreground"
                    >
                      Solicitar Cotización B2B
                    </Button>
                  </CardContent>
                </Card>

                {/* Map */}
                <Card className="border-border/50">
                  <CardContent className="p-0">
                    <div className="h-64 rounded-lg overflow-hidden cursor-pointer group relative">
                      <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.123456789!2d-70.9876543!3d-34.4567890!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzTCsDI3JzI0LjQiUyA3MMKwNTknMTUuNiJX!5e0!3m2!1ses!2scl!4v1635789012345!5m2!1ses!2scl"
                        width="100%"
                        height="100%"
                        style={{ border: 0 }}
                        allowFullScreen
                        loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"
                        title="Ubicación EcoHierbas Chile"
                      ></iframe>
                      <div 
                        className="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"
                        onClick={() => window.open(`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent('Camino El tambo, San Vicente Tagua Tagua, VI Región')}`, '_blank')}
                      >
                        <div className="text-white bg-primary/80 px-4 py-2 rounded-lg shadow-lg">
                          <p className="text-sm font-medium">Abrir en Google Maps</p>
                        </div>
                      </div>
                    </div>
                  </CardContent>
                </Card>
              </div>
            </div>
          </div>
        </section>

        {/* FAQ Section */}
        <section className="py-16 relative overflow-hidden">
          {/* Parallax Background */}
          <div 
            ref={faqParallaxRef}
            className="absolute inset-0 bg-cover bg-center transform scale-110"
            style={{
              backgroundImage: `url(/lovable-uploads/21a1dd2c-ac23-49be-bc0a-657cbbd497c8.png)`,
              willChange: 'transform'
            }}
          ></div>
          {/* Overlay */}
          <div className="absolute inset-0 bg-black/40"></div>
          
          <div className="u-container relative z-10">
            <div className="text-center max-w-3xl mx-auto mb-12">
              <h2 className="text-3xl font-serif font-bold text-white mb-4 drop-shadow-lg">
                Preguntas Frecuentes
              </h2>
              <p className="text-white/90 drop-shadow-md">
                Encuentra respuestas rápidas a las consultas más comunes
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
              <Card className="bg-white/10 border-white/20 backdrop-blur-sm">
                <CardContent className="p-6">
                  <h3 className="font-semibold text-white mb-2">
                    ¿Hacen envíos a todo Chile?
                  </h3>
                  <p className="text-white/80 text-sm">
                    Sí, realizamos envíos a todo Chile. Los tiempos de entrega varían 
                    según la región, entre 2-7 días hábiles.
                  </p>
                </CardContent>
              </Card>

              <Card className="bg-white/10 border-white/20 backdrop-blur-sm">
                <CardContent className="p-6">
                  <h3 className="font-semibold text-white mb-2">
                    ¿Ofrecen descuentos por volumen?
                  </h3>
                  <p className="text-white/80 text-sm">
                    Sí, tenemos precios especiales para empresas y compras corporativas. 
                    Contáctanos para una cotización personalizada.
                  </p>
                </CardContent>
              </Card>

              <Card className="bg-white/10 border-white/20 backdrop-blur-sm">
                <CardContent className="p-6">
                  <h3 className="font-semibold text-white mb-2">
                    ¿Los productos están certificados?
                  </h3>
                  <p className="text-white/80 text-sm">
                    Todos nuestros productos cuentan con certificación orgánica 
                    y cumplen con los estándares de calidad nacional.
                  </p>
                </CardContent>
              </Card>

              <Card className="bg-white/10 border-white/20 backdrop-blur-sm">
                <CardContent className="p-6">
                  <h3 className="font-semibold text-white mb-2">
                    ¿Realizan talleres presenciales?
                  </h3>
                  <p className="text-white/80 text-sm">
                    Sí, realizamos talleres presenciales en nuestras instalaciones 
                    y también podemos ir a tu empresa.
                  </p>
                </CardContent>
              </Card>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
};

export default Contacto;