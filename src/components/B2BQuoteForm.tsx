import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Checkbox } from "@/components/ui/checkbox";
import { Badge } from "@/components/ui/badge";
import { BuildingOfficeIcon, EnvelopeIcon, PhoneIcon, UserIcon } from "@heroicons/react/24/outline";
import { useToast } from "@/hooks/use-toast";

interface B2BQuoteFormProps {
  isOpen: boolean;
  onClose: () => void;
}

const B2BQuoteForm = ({ isOpen, onClose }: B2BQuoteFormProps) => {
  const { toast } = useToast();
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [formData, setFormData] = useState({
    empresa: "",
    contacto: "",
    email: "",
    telefono: "",
    cargo: "",
    colaboradores: "",
    presupuesto: "",
    productos: [] as string[],
    mensaje: "",
    newsletter: false
  });

  const productosDisponibles = [
    "Hierbas Medicinales y Aromáticas",
    "Mezclas Funcionales Personalizadas", 
    "Vermicomposteras Corporativas",
    "Talleres de Compostaje",
    "Maceteros Ecológicos",
    "Kits de Cultivo Urbano",
    "Programa de Bienestar Integral"
  ];

  const rangoColaboradores = [
    "1-10 personas",
    "11-50 personas", 
    "51-100 personas",
    "101-500 personas",
    "500+ personas"
  ];

  const handleProductToggle = (producto: string) => {
    setFormData(prev => ({
      ...prev,
      productos: prev.productos.includes(producto)
        ? prev.productos.filter(p => p !== producto)
        : [...prev.productos, producto]
    }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);

    // Simulación de envío
    setTimeout(() => {
      toast({
        title: "¡Cotización enviada exitosamente!",
        description: "Nos contactaremos contigo en las próximas 24 horas con una propuesta personalizada.",
      });
      setIsSubmitting(false);
      onClose();
      // Reset form
      setFormData({
        empresa: "",
        contacto: "",
        email: "",
        telefono: "",
        cargo: "",
        colaboradores: "",
        presupuesto: "",
        productos: [],
        mensaje: "",
        newsletter: false
      });
    }, 2000);
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-2xl max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2 text-2xl font-serif">
            <BuildingOfficeIcon className="w-6 h-6 text-primary" />
            Cotización Corporativa B2B
          </DialogTitle>
          <DialogDescription className="text-muted-foreground">
            Obtén una propuesta personalizada para tu empresa. Completar este formulario te tomará solo 3 minutos.
          </DialogDescription>
        </DialogHeader>

        <form onSubmit={handleSubmit} className="space-y-6 mt-6">
          {/* Información de la Empresa */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-foreground border-b border-border pb-2">
              Información de la Empresa
            </h3>
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="space-y-2">
                <Label htmlFor="empresa" className="text-sm font-medium">
                  Nombre de la Empresa *
                </Label>
                <Input
                  id="empresa"
                  required
                  value={formData.empresa}
                  onChange={(e) => setFormData(prev => ({ ...prev, empresa: e.target.value }))}
                  placeholder="Ej: Corporación Sustentable S.A."
                  className="w-full"
                />
              </div>

              <div className="space-y-2">
                <Label htmlFor="colaboradores" className="text-sm font-medium">
                  Número de Colaboradores *
                </Label>
                <Select value={formData.colaboradores} onValueChange={(value) => setFormData(prev => ({ ...prev, colaboradores: value }))}>
                  <SelectTrigger>
                    <SelectValue placeholder="Selecciona el rango" />
                  </SelectTrigger>
                  <SelectContent>
                    {rangoColaboradores.map((rango) => (
                      <SelectItem key={rango} value={rango}>{rango}</SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
            </div>
          </div>

          {/* Información de Contacto */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-foreground border-b border-border pb-2">
              Información de Contacto
            </h3>
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="space-y-2">
                <Label htmlFor="contacto" className="text-sm font-medium">
                  Nombre Completo *
                </Label>
                <div className="relative">
                  <UserIcon className="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                  <Input
                    id="contacto"
                    required
                    value={formData.contacto}
                    onChange={(e) => setFormData(prev => ({ ...prev, contacto: e.target.value }))}
                    placeholder="Tu nombre completo"
                    className="pl-10"
                  />
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="cargo" className="text-sm font-medium">
                  Cargo
                </Label>
                <Input
                  id="cargo"
                  value={formData.cargo}
                  onChange={(e) => setFormData(prev => ({ ...prev, cargo: e.target.value }))}
                  placeholder="Ej: Gerente de RRHH"
                />
              </div>

              <div className="space-y-2">
                <Label htmlFor="email" className="text-sm font-medium">
                  Email Corporativo *
                </Label>
                <div className="relative">
                  <EnvelopeIcon className="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                  <Input
                    id="email"
                    type="email"
                    required
                    value={formData.email}
                    onChange={(e) => setFormData(prev => ({ ...prev, email: e.target.value }))}
                    placeholder="email@empresa.com"
                    className="pl-10"
                  />
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="telefono" className="text-sm font-medium">
                  Teléfono *
                </Label>
                <div className="relative">
                  <PhoneIcon className="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                  <Input
                    id="telefono"
                    required
                    value={formData.telefono}
                    onChange={(e) => setFormData(prev => ({ ...prev, telefono: e.target.value }))}
                    placeholder="+56 9 XXXX XXXX"
                    className="pl-10"
                  />
                </div>
              </div>
            </div>
          </div>

          {/* Productos de Interés */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-foreground border-b border-border pb-2">
              Productos de Interés
            </h3>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-3">
              {productosDisponibles.map((producto) => (
                <div key={producto} className="flex items-center space-x-2">
                  <Checkbox
                    id={producto}
                    checked={formData.productos.includes(producto)}
                    onCheckedChange={() => handleProductToggle(producto)}
                  />
                  <Label htmlFor={producto} className="text-sm font-medium cursor-pointer">
                    {producto}
                  </Label>
                </div>
              ))}
            </div>
            {formData.productos.length > 0 && (
              <div className="flex flex-wrap gap-2 mt-3">
                {formData.productos.map((producto) => (
                  <Badge key={producto} variant="secondary" className="text-xs">
                    {producto}
                  </Badge>
                ))}
              </div>
            )}
          </div>

          {/* Presupuesto */}
          <div className="space-y-2">
            <Label htmlFor="presupuesto" className="text-sm font-medium">
              Presupuesto Aproximado (CLP)
            </Label>
            <Select value={formData.presupuesto} onValueChange={(value) => setFormData(prev => ({ ...prev, presupuesto: value }))}>
              <SelectTrigger>
                <SelectValue placeholder="Selecciona un rango (opcional)" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="50000-100000">$50.000 - $100.000</SelectItem>
                <SelectItem value="100000-300000">$100.000 - $300.000</SelectItem>
                <SelectItem value="300000-500000">$300.000 - $500.000</SelectItem>
                <SelectItem value="500000-1000000">$500.000 - $1.000.000</SelectItem>
                <SelectItem value="1000000+">Más de $1.000.000</SelectItem>
              </SelectContent>
            </Select>
          </div>

          {/* Mensaje */}
          <div className="space-y-2">
            <Label htmlFor="mensaje" className="text-sm font-medium">
              Mensaje Adicional
            </Label>
            <Textarea
              id="mensaje"
              value={formData.mensaje}
              onChange={(e) => setFormData(prev => ({ ...prev, mensaje: e.target.value }))}
              placeholder="Cuéntanos más sobre tus necesidades específicas, objetivos de bienestar, fechas importantes o cualquier información adicional que nos ayude a crear la mejor propuesta para tu empresa..."
              rows={4}
              className="resize-none"
            />
          </div>

          {/* Newsletter */}
          <div className="flex items-center space-x-2">
            <Checkbox
              id="newsletter"
              checked={formData.newsletter}
              onCheckedChange={(checked) => setFormData(prev => ({ ...prev, newsletter: checked as boolean }))}
            />
            <Label htmlFor="newsletter" className="text-sm">
              Quiero recibir información sobre nuevos productos y talleres corporativos
            </Label>
          </div>

          {/* Buttons */}
          <div className="flex flex-col sm:flex-row gap-3 pt-4">
            <Button
              type="submit"
              disabled={isSubmitting}
              className="flex-1 bg-primary hover:bg-primary/90"
            >
              {isSubmitting ? "Enviando..." : "Enviar Cotización"}
            </Button>
            <Button
              type="button"
              variant="outline"
              onClick={onClose}
              className="flex-1"
            >
              Cancelar
            </Button>
          </div>
        </form>
      </DialogContent>
    </Dialog>
  );
};

export default B2BQuoteForm;