import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { useWPForms } from '@/hooks/useWordPress';
import { toast } from 'sonner';
import { EnvelopeIcon, PhoneIcon, MapPinIcon } from '@heroicons/react/24/outline';

interface WPContactFormProps {
  formId?: number;
  title?: string;
  subtitle?: string;
}

const WPContactForm = ({ 
  formId = 1, // ID del formulario en WP Forms
  title = "Contáctanos",
  subtitle = "Estamos aquí para ayudarte con tus consultas"
}: WPContactFormProps) => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
    inquiry_type: '',
    company: '',
    newsletter: false,
  });

  const { useSubmitForm } = useWPForms();
  const submitForm = useSubmitForm();

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    
    try {
      // Mapear los datos del formulario al formato esperado por WP Forms
      const wpFormData = {
        '1': formData.name, // Campo 1: Nombre
        '2': formData.email, // Campo 2: Email
        '3': formData.phone, // Campo 3: Teléfono
        '4': formData.subject, // Campo 4: Asunto
        '5': formData.message, // Campo 5: Mensaje
        '6': formData.inquiry_type, // Campo 6: Tipo de consulta
        '7': formData.company, // Campo 7: Empresa (opcional)
        '8': formData.newsletter ? '1' : '0', // Campo 8: Newsletter
      };

      await submitForm.mutateAsync({ formId, formData: wpFormData });
      
      toast.success('¡Mensaje enviado correctamente! Te responderemos pronto.', {
        duration: 5000,
      });

      // Limpiar formulario
      setFormData({
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
        inquiry_type: '',
        company: '',
        newsletter: false,
      });

    } catch (error) {
      toast.error('Error al enviar el mensaje. Por favor, inténtalo nuevamente.');
      console.error('Form submission error:', error);
    }
  };

  const handleInputChange = (field: string, value: string | boolean) => {
    setFormData(prev => ({ ...prev, [field]: value }));
  };

  return (
    <section className="py-20 bg-gradient-to-br from-background to-secondary/10">
      <div className="u-container">
        <div className="max-w-6xl mx-auto">
          {/* Header */}
          <div className="text-center mb-16">
            <Badge className="mb-4 bg-primary/10 text-primary border-primary/20">
              Contacto
            </Badge>
            <h2 className="text-3xl md:text-4xl font-serif font-bold text-foreground mb-4">
              {title}
            </h2>
            <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
              {subtitle}
            </p>
          </div>

          <div className="u-grid u-grid--cols-2 gap-12">
            {/* Contact Info */}
            <div className="space-y-8">
              <div>
                <h3 className="text-2xl font-serif font-bold text-foreground mb-6">
                  Información de Contacto
                </h3>
                <div className="space-y-6">
                  <div className="flex items-start gap-4">
                    <div className="bg-primary/10 p-3 rounded-lg">
                      <EnvelopeIcon className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <h4 className="font-semibold text-foreground mb-1">Email</h4>
                      <p className="text-muted-foreground">contacto@ecohierbas.cl</p>
                      <p className="text-muted-foreground">ventas@ecohierbas.cl</p>
                    </div>
                  </div>

                  <div className="flex items-start gap-4">
                    <div className="bg-primary/10 p-3 rounded-lg">
                      <PhoneIcon className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <h4 className="font-semibold text-foreground mb-1">Teléfono</h4>
                      <p className="text-muted-foreground">+56 9 1234 5678</p>
                      <p className="text-muted-foreground">Lunes a Viernes: 9:00 - 18:00</p>
                    </div>
                  </div>

                  <div className="flex items-start gap-4">
                    <div className="bg-primary/10 p-3 rounded-lg">
                      <MapPinIcon className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <h4 className="font-semibold text-foreground mb-1">Ubicación</h4>
                      <p className="text-muted-foreground">Camino El tambo, San Vicente Tagua Tagua</p>
                      <p className="text-muted-foreground">VI Región, Chile</p>
                    </div>
                  </div>
                </div>
              </div>

              {/* Business Hours */}
              <Card>
                <CardHeader>
                  <CardTitle className="text-xl">Horarios de Atención</CardTitle>
                </CardHeader>
                <CardContent className="space-y-2">
                  <div className="flex justify-between">
                    <span className="text-muted-foreground">Lunes - Viernes</span>
                    <span className="font-medium">9:00 - 18:00</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-muted-foreground">Sábado</span>
                    <span className="font-medium">9:00 - 14:00</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-muted-foreground">Domingo</span>
                    <span className="font-medium">Cerrado</span>
                  </div>
                </CardContent>
              </Card>
            </div>

            {/* Contact Form */}
            <Card>
              <CardHeader>
                <CardTitle className="text-xl">Envíanos un Mensaje</CardTitle>
              </CardHeader>
              <CardContent>
                <form onSubmit={handleSubmit} className="space-y-6">
                  <div className="u-grid u-grid--cols-2 gap-4">
                    <div className="space-y-2">
                      <Label htmlFor="name">Nombre Completo *</Label>
                      <Input
                        id="name"
                        value={formData.name}
                        onChange={(e) => handleInputChange('name', e.target.value)}
                        required
                        placeholder="Tu nombre completo"
                      />
                    </div>
                    <div className="space-y-2">
                      <Label htmlFor="email">Email *</Label>
                      <Input
                        id="email"
                        type="email"
                        value={formData.email}
                        onChange={(e) => handleInputChange('email', e.target.value)}
                        required
                        placeholder="tu@email.com"
                      />
                    </div>
                  </div>

                  <div className="u-grid u-grid--cols-2 gap-4">
                    <div className="space-y-2">
                      <Label htmlFor="phone">Teléfono</Label>
                      <Input
                        id="phone"
                        value={formData.phone}
                        onChange={(e) => handleInputChange('phone', e.target.value)}
                        placeholder="+56 9 1234 5678"
                      />
                    </div>
                    <div className="space-y-2">
                      <Label htmlFor="inquiry_type">Tipo de Consulta</Label>
                      <Select onValueChange={(value) => handleInputChange('inquiry_type', value)}>
                        <SelectTrigger>
                          <SelectValue placeholder="Selecciona una opción" />
                        </SelectTrigger>
                        <SelectContent>
                          <SelectItem value="general">Consulta General</SelectItem>
                          <SelectItem value="products">Información de Productos</SelectItem>
                          <SelectItem value="b2b">Ventas Mayoristas B2B</SelectItem>
                          <SelectItem value="support">Soporte Técnico</SelectItem>
                          <SelectItem value="wholesale">Distribución</SelectItem>
                        </SelectContent>
                      </Select>
                    </div>
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="company">Empresa (opcional)</Label>
                    <Input
                      id="company"
                      value={formData.company}
                      onChange={(e) => handleInputChange('company', e.target.value)}
                      placeholder="Nombre de tu empresa"
                    />
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="subject">Asunto *</Label>
                    <Input
                      id="subject"
                      value={formData.subject}
                      onChange={(e) => handleInputChange('subject', e.target.value)}
                      required
                      placeholder="Asunto de tu mensaje"
                    />
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="message">Mensaje *</Label>
                    <Textarea
                      id="message"
                      value={formData.message}
                      onChange={(e) => handleInputChange('message', e.target.value)}
                      required
                      placeholder="Escribe tu mensaje aquí..."
                      rows={5}
                    />
                  </div>

                  <div className="flex items-center space-x-2">
                    <input
                      type="checkbox"
                      id="newsletter"
                      checked={formData.newsletter}
                      onChange={(e) => handleInputChange('newsletter', e.target.checked)}
                      className="rounded border-gray-300"
                    />
                    <Label htmlFor="newsletter" className="text-sm">
                      Quiero recibir noticias y ofertas especiales por email
                    </Label>
                  </div>

                  <Button 
                    type="submit" 
                    className="w-full"
                    disabled={submitForm.isPending}
                  >
                    {submitForm.isPending ? 'Enviando...' : 'Enviar Mensaje'}
                  </Button>
                </form>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </section>
  );
};

export default WPContactForm;