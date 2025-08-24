const StatsSection = () => {
  return (
    <section className="py-16 bg-background">
      <div className="u-container">
        {/* Stats */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 text-center max-w-4xl mx-auto">
          <div>
            <div className="text-3xl md:text-4xl font-bold text-primary mb-2">150+</div>
            <div className="text-sm text-muted-foreground">Clientes</div>
          </div>
          <div>
            <div className="text-3xl md:text-4xl font-bold text-primary mb-2">200+</div>
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