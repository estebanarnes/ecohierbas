import { useState, useEffect } from "react";
import Header from "@/components/Header";
import Hero from "@/components/Hero";
import BenefitsSection from "@/components/BenefitsSection";
import FeaturedProducts from "@/components/FeaturedProducts";
import ReviewsSection from "@/components/ReviewsSection";
import StatsSection from "@/components/StatsSection";
import WorkshopsSection from "@/components/WorkshopsSection";
import Footer from "@/components/Footer";
import OffersPopup from "@/components/OffersPopup";

const Index = () => {
  const [showOffersPopup, setShowOffersPopup] = useState(false);

  useEffect(() => {
    // Show popup after 2 seconds if user hasn't seen it before
    const hasSeenPopup = localStorage.getItem('ecohierbas-popup-seen');
    if (!hasSeenPopup) {
      const timer = setTimeout(() => {
        setShowOffersPopup(true);
      }, 2000);
      return () => clearTimeout(timer);
    }
  }, []);

  const handleClosePopup = () => {
    setShowOffersPopup(false);
    localStorage.setItem('ecohierbas-popup-seen', 'true');
  };

  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main>
        <Hero />
        <FeaturedProducts />
        <StatsSection />
        <BenefitsSection />
        <ReviewsSection />
        <WorkshopsSection />
      </main>
      <Footer />
      
      <OffersPopup 
        isOpen={showOffersPopup} 
        onClose={handleClosePopup} 
      />
    </div>
  );
};

export default Index;
