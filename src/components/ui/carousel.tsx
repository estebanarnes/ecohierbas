import * as React from "react"
import { cn } from "@/lib/utils"

interface CarouselProps extends React.HTMLAttributes<HTMLDivElement> {
  opts?: {
    align?: "start" | "center" | "end"
    loop?: boolean
  }
  setApi?: (api: any) => void
}

interface CarouselContentProps extends React.HTMLAttributes<HTMLDivElement> {}

interface CarouselItemProps extends React.HTMLAttributes<HTMLDivElement> {
  basis?: string
}

interface CarouselButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {}

const Carousel = React.forwardRef<HTMLDivElement, CarouselProps>(
  ({ className, children, opts, setApi, ...props }, ref) => {
    const [currentIndex, setCurrentIndex] = React.useState(0)
    const containerRef = React.useRef<HTMLDivElement>(null)

    const api = React.useMemo(() => ({
      selectedScrollSnap: () => currentIndex,
      on: (event: string, callback: () => void) => {
        if (event === "select") {
          // Simple implementation - in a real carousel you'd handle events properly
        }
      }
    }), [currentIndex])

    React.useEffect(() => {
      if (setApi) {
        setApi(api)
      }
    }, [setApi, api])

    return (
      <div
        ref={ref}
        className={cn("relative overflow-hidden", className)}
        {...props}
      >
        <div ref={containerRef} className="overflow-hidden">
          {children}
        </div>
      </div>
    )
  }
)
Carousel.displayName = "Carousel"

const CarouselContent = React.forwardRef<HTMLDivElement, CarouselContentProps>(
  ({ className, ...props }, ref) => {
    return (
      <div
        ref={ref}
        className={cn("flex", className)}
        {...props}
      />
    )
  }
)
CarouselContent.displayName = "CarouselContent"

const CarouselItem = React.forwardRef<HTMLDivElement, CarouselItemProps>(
  ({ className, basis, ...props }, ref) => {
    return (
      <div
        ref={ref}
        className={cn("min-w-0 shrink-0 grow-0", basis && `basis-${basis}`, className)}
        {...props}
      />
    )
  }
)
CarouselItem.displayName = "CarouselItem"

const CarouselPrevious = React.forwardRef<HTMLButtonElement, CarouselButtonProps>(
  ({ className, ...props }, ref) => {
    return (
      <button
        ref={ref}
        className={cn(
          "absolute top-1/2 -translate-y-1/2 left-4 h-8 w-8 rounded-full border border-input bg-background shadow-md hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50",
          className
        )}
        {...props}
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          strokeWidth="2"
          strokeLinecap="round"
          strokeLinejoin="round"
          className="h-4 w-4"
        >
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
    )
  }
)
CarouselPrevious.displayName = "CarouselPrevious"

const CarouselNext = React.forwardRef<HTMLButtonElement, CarouselButtonProps>(
  ({ className, ...props }, ref) => {
    return (
      <button
        ref={ref}
        className={cn(
          "absolute top-1/2 -translate-y-1/2 right-4 h-8 w-8 rounded-full border border-input bg-background shadow-md hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50",
          className
        )}
        {...props}
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          strokeWidth="2"
          strokeLinecap="round"
          strokeLinejoin="round"
          className="h-4 w-4"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>
      </button>
    )
  }
)
CarouselNext.displayName = "CarouselNext"

export {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselPrevious,
  CarouselNext,
}