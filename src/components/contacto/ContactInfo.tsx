import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { MapPinIcon, PhoneIcon, EnvelopeIcon, ClockIcon, ChatBubbleLeftRightIcon } from "@heroicons/react/24/outline";

const ContactInfo = () => {
  return (
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
          <Button className="w-full bg-accent hover:bg-accent/90" size="lg" asChild>
            <a href="https://wa.me/56912345678?text=Hola%20EcoHierbas%20Chile,%20me%20interesa%20conocer%20más%20sobre%20sus%20productos%20naturales%20y%20sustentables" target="_blank" rel="noopener noreferrer">
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
            onClick={() => window.scrollTo({ top: 0, behavior: 'smooth' })}
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
            />
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
  );
};

export default ContactInfo;