import { Link } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { 
  MapPinIcon, 
  PhoneIcon, 
  EnvelopeIcon,
  HeartIcon 
} from "@heroicons/react/24/outline";
import { Instagram, Facebook, Linkedin } from "lucide-react";

const Footer = () => {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="relative">
      {/* Fondo tierra */}
      <div className="absolute inset-0 bg-gradient-to-b from-amber-900 via-amber-800 to-amber-900"></div>
      
      {/* Overlay transparente acuoso */}
      <div className="relative bg-white/10 backdrop-blur-lg border-t border-white/20">
        <div className="absolute inset-0 bg-gradient-to-b from-white/5 to-transparent"></div>
      {/* Main Footer */}
      <div className="relative z-10 u-container py-16 text-white">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Company Info */}
          <div className="lg:col-span-1">
            <div className="flex items-center space-x-2 mb-6">
              <div className="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/30">
                <span className="text-white font-bold text-lg">E</span>
              </div>
              <div className="flex flex-col">
                <span className="text-lg font-serif font-semibold">EcoHierbas</span>
                <span className="text-xs opacity-80 -mt-1">Chile</span>
              </div>
            </div>
            <p className="text-white/90 mb-6 leading-relaxed">
              Empresa chilena especializada en productos orgánicos, hierbas medicinales 
              y soluciones de vermicompostaje para un futuro más sustentable.
            </p>
            
            {/* Contact Info */}
            <div className="space-y-3">
              <div className="flex items-center gap-3">
                <MapPinIcon className="w-5 h-5 text-white/80" />
                <span className="text-sm">
                  Camino El tambo, San Vicente Tagua Tagua<br />
                  VI Región, Chile
                </span>
              </div>
              <div className="flex items-center gap-3">
                <PhoneIcon className="w-5 h-5 text-white/80" />
                <span className="text-sm text-white/90">+56 9 1234 5678</span>
              </div>
              <div className="flex items-center gap-3">
                <EnvelopeIcon className="w-5 h-5 text-white/80" />
                <span className="text-sm text-white/90">contacto@ecohierbaschile.cl</span>
              </div>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-lg font-semibold mb-6 text-white">Navegación</h3>
            <ul className="space-y-3">
              <li>
                <Link to="/" className="text-white/80 hover:text-white transition-colors">
                  Inicio
                </Link>
              </li>
              <li>
                <Link to="/nosotros" className="text-white/80 hover:text-white transition-colors">
                  Nosotros
                </Link>
              </li>
              <li>
                <Link to="/productos" className="text-white/80 hover:text-white transition-colors">
                  Productos
                </Link>
              </li>
              <li>
                <Link to="/contacto" className="text-white/80 hover:text-white transition-colors">
                  Contacto
                </Link>
              </li>
              <li>
                <Link to="/talleres" className="text-white/80 hover:text-white transition-colors">
                  Talleres
                </Link>
              </li>
            </ul>
          </div>

          {/* Products */}
          <div>
            <h3 className="text-lg font-semibold mb-6 text-white">Productos</h3>
            <ul className="space-y-3">
              <li>
                <a href="#" className="text-white/80 hover:text-white transition-colors">
                  Hierbas Medicinales
                </a>
              </li>
              <li>
                <a href="#" className="text-white/80 hover:text-white transition-colors">
                  Infusiones Funcionales
                </a>
              </li>
              <li>
                <a href="#" className="text-white/80 hover:text-white transition-colors">
                  Vermicomposteras
                </a>
              </li>
              <li>
                <a href="#" className="text-white/80 hover:text-white transition-colors">
                  Maceteros Ecológicos
                </a>
              </li>
              <li>
                <a href="#" className="text-white/80 hover:text-white transition-colors">
                  Kits de Cultivo
                </a>
              </li>
            </ul>
          </div>

          {/* Newsletter */}
          <div>
            <h3 className="text-lg font-semibold mb-6 text-white">Mantente Conectado</h3>
            <p className="text-white/90 mb-4">
              Recibe noticias sobre nuevos productos, talleres y tips de vida sustentable.
            </p>
            <div className="space-y-4">
              <div className="flex gap-2">
                <Input 
                  placeholder="Tu email"
                  className="bg-white/10 backdrop-blur-sm border-white/30 text-white placeholder:text-white/60"
                />
                <Button 
                  variant="secondary"
                  className="bg-white/20 backdrop-blur-sm text-white border border-white/30 hover:bg-white/30"
                >
                  Suscribir
                </Button>
              </div>
              
              {/* Social Links */}
              <div>
                <p className="text-sm text-white/80 mb-3">Síguenos:</p>
                <div className="flex gap-3">
                  <a 
                    href="#" 
                    className="w-9 h-9 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20"
                  >
                    <Instagram className="w-4 h-4 text-white" />
                  </a>
                  <a 
                    href="#" 
                    className="w-9 h-9 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20"
                  >
                    <Facebook className="w-4 h-4 text-white" />
                  </a>
                  <a 
                    href="#" 
                    className="w-9 h-9 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-colors border border-white/20"
                  >
                    <Linkedin className="w-4 h-4 text-white" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Bottom Footer */}
      <div className="relative z-10 border-t border-white/20">
        <div className="u-container py-6">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4">
            <div className="text-sm text-white/80">
              © {currentYear} EcoHierbas Chile. Todos los derechos reservados.
            </div>
            
            <div className="flex items-center gap-6 text-sm">
              <a href="#" className="text-white/80 hover:text-white transition-colors">
                Términos y Condiciones
              </a>
              <a href="#" className="text-white/80 hover:text-white transition-colors">
                Política de Privacidad
              </a>
              <div className="flex items-center gap-1 text-white/80">
                Hecho con <HeartIcon className="w-4 h-4 fill-current text-accent" /> en Chile
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </footer>
  );
};

export default Footer;