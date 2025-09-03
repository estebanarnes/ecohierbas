import Header from "@/components/Header";
import Footer from "@/components/Footer";
import HeroSection from "@/components/contacto/HeroSection";
import ContactForm from "@/components/contacto/ContactForm";
import ContactInfo from "@/components/contacto/ContactInfo";
import FAQSection from "@/components/contacto/FAQSection";

const Contacto = () => {
  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main>
        <HeroSection />
        
        {/* Contact Content */}
        <section className="py-16">
          <div className="u-container">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
              <ContactForm />
              <ContactInfo />
            </div>
          </div>
        </section>

        <FAQSection />
      </main>
      <Footer />
    </div>
  );
};

export default Contacto;