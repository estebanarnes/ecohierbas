import React from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";

const ContactForm = () => {
  return (
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
          <Textarea placeholder="Cuéntanos cómo podemos ayudarte..." className="min-h-[120px]" />
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
  );
};

export default ContactForm;