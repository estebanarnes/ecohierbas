const StatsSection = () => {
  return (
    <section className="py-16 bg-background -mt-[20px]">
      <div className="u-container">
        {/* Stats */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-8 text-center max-w-3xl mx-auto">
          <div>
            <div className="text-3xl md:text-4xl font-bold text-primary mb-3 md:mb-2">150+</div>
            <div className="text-sm text-muted-foreground">Clientes</div>
          </div>
          <div>
            <div className="text-3xl md:text-4xl font-bold text-primary mb-3 md:mb-2">200+</div>
            <div className="text-sm text-muted-foreground">Recuperaciones de residuos deshidratados</div>
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
    </section>
  );
};

export default StatsSection;