import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { 
  CalendarDaysIcon, 
  MapPinIcon, 
  UsersIcon,
  ClockIcon 
} from "@heroicons/react/24/outline";

const workshops = [
  {
    id: 1,
    title: "Introducción al Vermicompostaje Empresarial",
    description: "Aprende a implementar sistemas de compostaje en tu empresa para reducir residuos y crear conciencia ambiental.",
    date: "15 de Marzo, 2024",
    time: "14:00 - 17:00",
    location: "Presencial - Pudahuel",
    capacity: "20 personas",
    price: "Gratuito",
    level: "Principiante",
    category: "B2B"
  },
  {
    id: 2,
    title: "Cultivo de Hierbas Medicinales en Casa",
    description: "Taller práctico para aprender a cultivar y cuidar hierbas medicinales en espacios reducidos.",
    date: "22 de Marzo, 2024",
    time: "10:00 - 13:00",
    location: "Presencial - Pudahuel",
    capacity: "15 personas",
    price: "$15.000",
    level: "Principiante",
    category: "B2C"
  },
  {
    id: 3,
    title: "Economía Circular en Empresas",
    description: "Workshop sobre implementación de modelos de economía circular y sustentabilidad corporativa.",
    date: "29 de Marzo, 2024",
    time: "09:00 - 12:00",
    location: "Online + Kit",
    capacity: "50 personas",
    price: "$25.000",
    level: "Intermedio",
    category: "B2B"
  }
];

const WorkshopsSection = () => {
  return (
    <section className="py-20 bg-gradient-to-r from-primary/5 to-accent/5" data-banner="talleres">
      <div className="u-container">
        {/* Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <Badge className="mb-4 bg-accent/20 text-accent border-accent/30">
            Educación Ambiental
          </Badge>
          <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
            Talleres y Capacitaciones
          </h2>
          <p className="text-lg text-muted-foreground">
            Fortalece tu conocimiento en sustentabilidad, cultivo orgánico y economía circular 
            con nuestros talleres especializados.
          </p>
        </div>

        {/* Workshops Grid */}
        <div className="u-grid u-grid--cols-3 gap-8 mb-12">
          {workshops.map((workshop) => (
            <Card 
              key={workshop.id}
              className="bg-white border-border/50 hover:border-primary/30 transition-all duration-300 hover:shadow-lg overflow-hidden"
            >
              <CardContent className="p-6">
                {/* Category & Level */}
                <div className="flex items-center justify-between mb-4">
                  <Badge 
                    className={`${
                      workshop.category === "B2B" 
                        ? "bg-primary/10 text-primary border-primary/20" 
                        : "bg-accent/10 text-accent border-accent/20"
                    }`}
                  >
                    {workshop.category}
                  </Badge>
                  <Badge variant="outline" className="text-xs">
                    {workshop.level}
                  </Badge>
                </div>

                {/* Title */}
                <h3 className="text-xl font-semibold text-foreground mb-3 leading-tight">
                  {workshop.title}
                </h3>

                {/* Description */}
                <p className="text-muted-foreground text-sm mb-6 leading-relaxed">
                  {workshop.description}
                </p>

                {/* Details */}
                <div className="space-y-3 mb-6">
                  <div className="flex items-center gap-2 text-sm">
                    <CalendarDaysIcon className="w-4 h-4 text-primary" />
                    <span className="text-foreground">{workshop.date}</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm">
                    <ClockIcon className="w-4 h-4 text-primary" />
                    <span className="text-foreground">{workshop.time}</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm">
                    <MapPinIcon className="w-4 h-4 text-primary" />
                    <span className="text-foreground">{workshop.location}</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm">
                    <UsersIcon className="w-4 h-4 text-primary" />
                    <span className="text-foreground">{workshop.capacity}</span>
                  </div>
                </div>

                {/* Price */}
                <div className="flex items-center justify-between mb-4">
                  <span className="text-sm text-muted-foreground">Precio:</span>
                  <span className={`font-bold text-lg ${
                    workshop.price === "Gratuito" ? "text-green-600" : "text-primary"
                  }`}>
                    {workshop.price}
                  </span>
                </div>
              </CardContent>

              <CardFooter className="p-6 pt-0">
                <Button 
                  className="w-full bg-primary hover:bg-primary/90"
                  size="lg"
                  asChild
                >
                  <a 
                    href={`https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(workshop.title)}&details=${encodeURIComponent(`Taller: ${workshop.title}\n\nDescripción: ${workshop.description}\n\nHorario: ${workshop.time}\nPrecio: ${workshop.price}\n\nMás información: contacto@ecohierbaschile.cl`)}&location=${encodeURIComponent('EcoHierbas Chile, Camino El tambo, San Vicente Tagua Tagua, VI Región')}`}
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    Coordinar en Google Calendar
                  </a>
                </Button>
              </CardFooter>
            </Card>
          ))}
        </div>

        {/* CTA Section */}
        <div className="bg-white rounded-2xl p-8 border border-primary/20 text-center">
          <h3 className="text-2xl font-serif font-semibold text-foreground mb-3">
            ¿Necesitas un taller personalizado para tu empresa?
          </h3>
          <p className="text-muted-foreground mb-6 max-w-2xl mx-auto">
            Diseñamos talleres a medida para equipos corporativos enfocados en sustentabilidad, 
            bienestar laboral y responsabilidad social empresarial.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Button size="lg" className="bg-primary hover:bg-primary/90">
              Solicitar Propuesta B2B
            </Button>
            <Button size="lg" variant="outline">
              Ver Calendario Completo
            </Button>
          </div>
        </div>
      </div>
    </section>
  );
};

export default WorkshopsSection;