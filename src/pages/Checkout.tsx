import { useState } from "react";
import { useCart } from "@/contexts/CartContext";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Separator } from "@/components/ui/separator";
import { Badge } from "@/components/ui/badge";
import { 
  ArrowLeftIcon, 
  TruckIcon, 
  ClockIcon, 
  MapPinIcon,
  CreditCardIcon,
  BanknotesIcon,
  ShieldCheckIcon,
  CheckCircleIcon
} from "@heroicons/react/24/outline";
import { Link, useNavigate } from "react-router-dom";
import { toast } from "sonner";
import Header from "@/components/Header";
import Footer from "@/components/Footer";

const Checkout = () => {
  const { state, clearCart } = useCart();
  const navigate = useNavigate();
  const [selectedShipping, setSelectedShipping] = useState("standard");
  const [selectedPayment, setSelectedPayment] = useState("credit-card");
  const [isProcessing, setIsProcessing] = useState(false);
  
  const [formData, setFormData] = useState({
    firstName: "",
    lastName: "",
    email: "",
    phone: "",
    address: "",
    city: "",
    zipCode: "",
    region: "",
    notes: "",
    cardNumber: "",
    expiryDate: "",
    cvv: "",
    cardName: "",
  });

  // Redirect if cart is empty
  if (state.items.length === 0) {
    return (
      <div className="min-h-screen bg-background flex items-center justify-center">
        <div className="text-center">
          <h2 className="text-2xl font-semibold text-foreground mb-4">Tu carrito está vacío</h2>
          <p className="text-muted-foreground mb-6">Agrega productos antes de proceder al checkout</p>
          <Button asChild>
            <Link to="/productos">Ver Productos</Link>
          </Button>
        </div>
      </div>
    );
  }

  const shippingMethods = [
    {
      id: "standard",
      name: "Envío Estándar",
      description: "5-7 días hábiles",
      price: 0,
      icon: TruckIcon,
    },
    {
      id: "express",
      name: "Envío Express",
      description: "2-3 días hábiles",
      price: 3500,
      icon: ClockIcon,
    },
    {
      id: "same-day",
      name: "Envío Mismo Día",
      description: "VI Región únicamente",
      price: 5900,
      icon: MapPinIcon,
    },
  ];

  const paymentMethods = [
    {
      id: "credit-card",
      name: "Tarjeta de Crédito/Débito",
      description: "Visa, Mastercard, American Express",
      icon: CreditCardIcon,
    },
    {
      id: "transfer",
      name: "Transferencia Bancaria",
      description: "Confirma tu pago por email",
      icon: BanknotesIcon,
    },
  ];

  const chileanRegions = [
    "Región de Arica y Parinacota",
    "Región de Tarapacá",
    "Región de Antofagasta",
    "Región de Atacama",
    "Región de Coquimbo",
    "Región de Valparaíso",
    "Región Metropolitana",
    "VI Región del Libertador General Bernardo O'Higgins",
    "Región del Maule",
    "Región de Ñuble",
    "Región del Biobío",
    "Región de La Araucanía",
    "Región de Los Ríos",
    "Región de Los Lagos",
    "Región de Aysén",
    "Región de Magallanes"
  ];

  const selectedMethod = shippingMethods.find(method => method.id === selectedShipping);
  const selectedPaymentMethod = paymentMethods.find(method => method.id === selectedPayment);
  const shippingCost = selectedMethod?.price || 0;
  const total = state.totalPrice + shippingCost;

  const handleInputChange = (field: string, value: string) => {
    setFormData(prev => ({ ...prev, [field]: value }));
  };

  const validateForm = () => {
    const required = ['firstName', 'lastName', 'email', 'phone', 'address', 'city', 'zipCode', 'region'];
    const missing = required.filter(field => !formData[field as keyof typeof formData]);
    
    if (missing.length > 0) {
      toast.error("Por favor completa todos los campos obligatorios");
      return false;
    }

    if (selectedPayment === 'credit-card') {
      const cardFields = ['cardNumber', 'expiryDate', 'cvv', 'cardName'];
      const missingCard = cardFields.filter(field => !formData[field as keyof typeof formData]);
      if (missingCard.length > 0) {
        toast.error("Por favor completa la información de la tarjeta");
        return false;
      }
    }

    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(formData.email)) {
      toast.error("Por favor ingresa un email válido");
      return false;
    }

    return true;
  };

  const handleSubmit = async () => {
    if (!validateForm()) return;

    setIsProcessing(true);
    
    try {
      // Simulate order processing
      await new Promise(resolve => setTimeout(resolve, 2000));
      
      // Create order object
      const order = {
        id: `ORD-${Date.now()}`,
        items: state.items,
        shipping: selectedMethod,
        payment: selectedPaymentMethod,
        customer: formData,
        total,
        date: new Date().toISOString(),
      };

      console.log("Orden procesada:", order);
      
      toast.success("¡Pedido confirmado! Te enviaremos un email con los detalles", {
        duration: 5000,
      });

      // Clear cart and redirect
      clearCart();
      navigate("/", { replace: true });
      
    } catch (error) {
      toast.error("Error al procesar el pedido. Inténtalo nuevamente");
    } finally {
      setIsProcessing(false);
    }
  };

  return (
    <div className="min-h-screen bg-background">
      <Header />
      
      <main className="u-container py-8">
        <div className="mb-6">
          <Link to="/productos" className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
            <ArrowLeftIcon className="w-4 h-4" />
            Continuar comprando
          </Link>
        </div>

        <div className="mb-8">
          <h1 className="text-3xl font-serif font-bold text-foreground mb-2">Checkout</h1>
          <p className="text-muted-foreground">Completa tu información para finalizar la compra</p>
        </div>

        <div className="grid lg:grid-cols-3 gap-8">
          {/* Formulario de checkout */}
          <div className="lg:col-span-2 space-y-6">
            {/* Información Personal */}
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center gap-2">
                  <div className="w-6 h-6 bg-primary text-primary-foreground rounded-full flex items-center justify-center text-xs font-semibold">1</div>
                  Información Personal
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <Label htmlFor="firstName">Nombre *</Label>
                    <Input 
                      id="firstName" 
                      placeholder="Juan" 
                      value={formData.firstName}
                      onChange={(e) => handleInputChange('firstName', e.target.value)}
                    />
                  </div>
                  <div>
                    <Label htmlFor="lastName">Apellido *</Label>
                    <Input 
                      id="lastName" 
                      placeholder="Pérez" 
                      value={formData.lastName}
                      onChange={(e) => handleInputChange('lastName', e.target.value)}
                    />
                  </div>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <Label htmlFor="email">Email *</Label>
                    <Input 
                      id="email" 
                      type="email" 
                      placeholder="juan@ejemplo.com" 
                      value={formData.email}
                      onChange={(e) => handleInputChange('email', e.target.value)}
                    />
                  </div>
                  <div>
                    <Label htmlFor="phone">Teléfono *</Label>
                    <Input 
                      id="phone" 
                      placeholder="+56 9 1234 5678" 
                      value={formData.phone}
                      onChange={(e) => handleInputChange('phone', e.target.value)}
                    />
                  </div>
                </div>
              </CardContent>
            </Card>

            {/* Información de Envío */}
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center gap-2">
                  <div className="w-6 h-6 bg-primary text-primary-foreground rounded-full flex items-center justify-center text-xs font-semibold">2</div>
                  Dirección de Envío
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div>
                  <Label htmlFor="address">Dirección *</Label>
                  <Input 
                    id="address" 
                    placeholder="Camino El tambo 123" 
                    value={formData.address}
                    onChange={(e) => handleInputChange('address', e.target.value)}
                  />
                </div>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div>
                    <Label htmlFor="city">Ciudad *</Label>
                    <Input 
                      id="city" 
                      placeholder="San Vicente Tagua Tagua" 
                      value={formData.city}
                      onChange={(e) => handleInputChange('city', e.target.value)}
                    />
                  </div>
                  <div>
                    <Label htmlFor="region">Región *</Label>
                    <Select onValueChange={(value) => handleInputChange('region', value)}>
                      <SelectTrigger>
                        <SelectValue placeholder="Selecciona región" />
                      </SelectTrigger>
                      <SelectContent>
                        {chileanRegions.map((region) => (
                          <SelectItem key={region} value={region}>
                            {region}
                          </SelectItem>
                        ))}
                      </SelectContent>
                    </Select>
                  </div>
                  <div>
                    <Label htmlFor="zipCode">Código Postal *</Label>
                    <Input 
                      id="zipCode" 
                      placeholder="2950000" 
                      value={formData.zipCode}
                      onChange={(e) => handleInputChange('zipCode', e.target.value)}
                    />
                  </div>
                </div>
                <div>
                  <Label htmlFor="notes">Notas de entrega (opcional)</Label>
                  <Textarea 
                    id="notes" 
                    placeholder="Instrucciones especiales para la entrega..."
                    value={formData.notes}
                    onChange={(e) => handleInputChange('notes', e.target.value)}
                  />
                </div>
              </CardContent>
            </Card>

            {/* Método de Envío */}
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center gap-2">
                  <div className="w-6 h-6 bg-primary text-primary-foreground rounded-full flex items-center justify-center text-xs font-semibold">3</div>
                  Método de Envío
                </CardTitle>
              </CardHeader>
              <CardContent>
                <RadioGroup value={selectedShipping} onValueChange={setSelectedShipping} className="space-y-3">
                  {shippingMethods.map((method) => {
                    const IconComponent = method.icon;
                    return (
                      <div key={method.id} className="flex items-center space-x-3 border rounded-lg p-4 hover:bg-accent/50 transition-colors">
                        <RadioGroupItem value={method.id} id={method.id} />
                        <IconComponent className="w-5 h-5 text-primary" />
                        <div className="flex-1">
                          <Label htmlFor={method.id} className="font-medium cursor-pointer">
                            {method.name}
                          </Label>
                          <p className="text-sm text-muted-foreground">{method.description}</p>
                        </div>
                        <div className="text-right">
                          <p className="font-semibold">
                            {method.price === 0 ? "Gratis" : `$${method.price.toLocaleString('es-CL')}`}
                          </p>
                        </div>
                      </div>
                    );
                  })}
                </RadioGroup>
              </CardContent>
            </Card>

            {/* Método de Pago */}
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center gap-2">
                  <div className="w-6 h-6 bg-primary text-primary-foreground rounded-full flex items-center justify-center text-xs font-semibold">4</div>
                  Método de Pago
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <RadioGroup value={selectedPayment} onValueChange={setSelectedPayment} className="space-y-3">
                  {paymentMethods.map((method) => {
                    const IconComponent = method.icon;
                    return (
                      <div key={method.id} className="border rounded-lg p-4">
                        <div className="flex items-center space-x-3">
                          <RadioGroupItem value={method.id} id={method.id} />
                          <IconComponent className="w-5 h-5 text-primary" />
                          <div className="flex-1">
                            <Label htmlFor={method.id} className="font-medium cursor-pointer">
                              {method.name}
                            </Label>
                            <p className="text-sm text-muted-foreground">{method.description}</p>
                          </div>
                        </div>
                      </div>
                    );
                  })}
                </RadioGroup>

                {selectedPayment === 'credit-card' && (
                  <div className="mt-4 p-4 bg-muted/30 rounded-lg space-y-4">
                    <div>
                      <Label htmlFor="cardName">Nombre del titular *</Label>
                      <Input 
                        id="cardName" 
                        placeholder="Juan Pérez" 
                        value={formData.cardName}
                        onChange={(e) => handleInputChange('cardName', e.target.value)}
                      />
                    </div>
                    <div>
                      <Label htmlFor="cardNumber">Número de tarjeta *</Label>
                      <Input 
                        id="cardNumber" 
                        placeholder="1234 5678 9012 3456" 
                        value={formData.cardNumber}
                        onChange={(e) => handleInputChange('cardNumber', e.target.value)}
                      />
                    </div>
                    <div className="grid grid-cols-2 gap-4">
                      <div>
                        <Label htmlFor="expiryDate">Fecha de vencimiento *</Label>
                        <Input 
                          id="expiryDate" 
                          placeholder="MM/AA" 
                          value={formData.expiryDate}
                          onChange={(e) => handleInputChange('expiryDate', e.target.value)}
                        />
                      </div>
                      <div>
                        <Label htmlFor="cvv">CVV *</Label>
                        <Input 
                          id="cvv" 
                          placeholder="123" 
                          value={formData.cvv}
                          onChange={(e) => handleInputChange('cvv', e.target.value)}
                        />
                      </div>
                    </div>
                  </div>
                )}

                {selectedPayment === 'transfer' && (
                  <div className="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div className="flex items-start gap-3">
                      <ShieldCheckIcon className="w-5 h-5 text-blue-600 mt-0.5" />
                      <div>
                        <h4 className="font-medium text-blue-900">Instrucciones de transferencia</h4>
                        <p className="text-sm text-blue-700 mt-1">
                          Te enviaremos las instrucciones de pago por email. 
                          Una vez confirmado el pago, procesaremos tu pedido.
                        </p>
                      </div>
                    </div>
                  </div>
                )}
              </CardContent>
            </Card>
          </div>

          {/* Resumen del pedido */}
          <div>
            <Card className="sticky top-4">
              <CardHeader>
                <CardTitle>Resumen del Pedido</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="space-y-3">
                  {state.items.map((item) => (
                    <div key={item.id} className="flex gap-3">
                      <img
                        src={item.image}
                        alt={item.name}
                        className="w-12 h-12 object-cover rounded"
                      />
                      <div className="flex-1">
                        <h4 className="text-sm font-medium">{item.name}</h4>
                        <p className="text-xs text-muted-foreground">Cantidad: {item.quantity}</p>
                      </div>
                      <p className="text-sm font-semibold">
                        ${(item.price * item.quantity).toLocaleString('es-CL')}
                      </p>
                    </div>
                  ))}
                </div>

                <Separator />

                <div className="space-y-2">
                  <div className="flex justify-between text-sm">
                    <span>Subtotal:</span>
                    <span>${state.totalPrice.toLocaleString('es-CL')}</span>
                  </div>
                  <div className="flex justify-between text-sm">
                    <span>Envío ({selectedMethod?.name}):</span>
                    <span>
                      {shippingCost === 0 ? "Gratis" : `$${shippingCost.toLocaleString('es-CL')}`}
                    </span>
                  </div>
                  <Separator />
                  <div className="flex justify-between font-semibold text-lg">
                    <span>Total:</span>
                    <span className="text-primary">${total.toLocaleString('es-CL')}</span>
                  </div>
                </div>

                {/* Security badges */}
                <div className="flex items-center gap-2 text-xs text-muted-foreground">
                  <ShieldCheckIcon className="w-4 h-4" />
                  <span>Pago 100% seguro y encriptado</span>
                </div>

                <Button 
                  onClick={handleSubmit}
                  disabled={isProcessing}
                  className="w-full bg-primary hover:bg-primary/90" 
                  size="lg"
                >
                  {isProcessing ? (
                    <>Procesando pedido...</>
                  ) : (
                    <>
                      <CheckCircleIcon className="w-4 h-4 mr-2" />
                      Confirmar Pedido - ${total.toLocaleString('es-CL')}
                    </>
                  )}
                </Button>

                <div className="text-center">
                  <p className="text-xs text-muted-foreground">
                    Al confirmar tu pedido, aceptas nuestros{" "}
                    <a href="#" className="text-primary hover:underline">términos y condiciones</a>
                  </p>
                </div>
              </CardContent>
            </Card>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  );
};

export default Checkout;