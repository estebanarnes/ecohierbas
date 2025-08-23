import { Card, CardContent } from "@/components/ui/card";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { StarIcon } from "@heroicons/react/24/solid";
import { Badge } from "@/components/ui/badge";
const reviews = [{
  id: 1,
  name: "María González",
  company: "Corporación Sustentable S.A.",
  role: "Jefa de Bienestar",
  avatar: "/placeholder-avatar-1.jpg",
  rating: 5,
  comment: "Las hierbas de EcoHierbas han mejorado notablemente el bienestar de nuestros colaboradores. La calidad es excepcional y el servicio es muy profesional.",
  product: "Box Especial Mujer",
  verified: true
}, {
  id: 2,
  name: "Carlos Mendoza",
  company: "EcoTech Innovations",
  role: "Gerente General",
  avatar: "/placeholder-avatar-2.jpg",
  rating: 5,
  comment: "La vermicompostera que instalamos en nuestra oficina ha sido un éxito total. Nuestro equipo está más consciente del reciclaje y la sostenibilidad.",
  product: "Vermicompostera 5 Niveles",
  verified: true
}, {
  id: 3,
  name: "Ana Rodríguez",
  company: "Cliente Particular",
  role: "Madre de familia",
  avatar: "/placeholder-avatar-3.jpg",
  rating: 5,
  comment: "Los productos son de excelente calidad. Mis hijos ahora cultivan sus propias hierbas gracias al kit que compramos. Recomendado 100%.",
  product: "Eco Macetero + Kit",
  verified: true
}];
const ReviewsSection = () => {
  return <section className="py-20 bg-muted/20" data-section="reviews">
      <div className="u-container">
        {/* Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <Badge className="mb-4 bg-primary/10 text-primary border-primary/20">
            Testimonios Reales
          </Badge>
          <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
            Lo que dicen nuestros clientes
          </h2>
          <p className="text-lg text-muted-foreground">
            Más de 500 empresas y miles de familias confían en la calidad 
            de nuestros productos orgánicos.
          </p>
        </div>

        {/* Reviews Grid */}
        <div className="u-grid u-grid--cols-3 gap-8 mb-12">
          {reviews.map(review => <Card key={review.id} className="bg-white border-border/50 hover:border-primary/20 transition-all duration-300 hover:shadow-md">
              <CardContent className="p-6">
                {/* Rating */}
                <div className="flex items-center gap-1 mb-4">
                  {[...Array(5)].map((_, i) => <StarIcon key={i} className={`w-5 h-5 ${i < review.rating ? "text-yellow-400 fill-current" : "text-gray-300"}`} />)}
                </div>

                {/* Comment */}
                <blockquote className="text-foreground mb-6 leading-relaxed">
                  "{review.comment}"
                </blockquote>

                {/* Product */}
                <div className="mb-4">
                  <Badge variant="outline" className="text-xs">
                    {review.product}
                  </Badge>
                </div>

                {/* Reviewer Info */}
                <div className="flex items-start gap-3">
                  <Avatar className="w-12 h-12">
                    <AvatarImage src={review.avatar} alt={review.name} />
                    <AvatarFallback className="bg-primary/10 text-primary">
                      {review.name.split(' ').map(n => n[0]).join('')}
                    </AvatarFallback>
                  </Avatar>
                  
                  <div className="flex-1 min-w-0">
                    <div className="flex items-center gap-2">
                      <h4 className="font-semibold text-sm text-foreground">
                        {review.name}
                      </h4>
                      {review.verified && <Badge className="bg-green-100 text-green-800 text-xs border-green-200">
                          ✓ Verificado
                        </Badge>}
                    </div>
                    <p className="text-xs text-muted-foreground">
                      {review.role}
                    </p>
                    <p className="text-xs text-muted-foreground font-medium">
                      {review.company}
                    </p>
                  </div>
                </div>
              </CardContent>
            </Card>)}
        </div>

        {/* Stats */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div>
            
            <div className="text-sm text-muted-foreground">
              Calificación promedio
            </div>
          </div>
          <div>
            <div className="text-3xl md:text-4xl font-bold text-primary mb-2">
              2,450+
            </div>
            <div className="text-sm text-muted-foreground">
              Reseñas verificadas
            </div>
          </div>
          <div>
            <div className="text-3xl md:text-4xl font-bold text-primary mb-2">
              500+
            </div>
            <div className="text-sm text-muted-foreground">
              Empresas B2B
            </div>
          </div>
          <div>
            <div className="text-3xl md:text-4xl font-bold text-primary mb-2">
              98%
            </div>
            <div className="text-sm text-muted-foreground">
              Recomendarían
            </div>
          </div>
        </div>
      </div>
    </section>;
};
export default ReviewsSection;