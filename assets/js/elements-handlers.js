(()=>{
    if (window.elementorProFrontend) {
        const extendDefaultHandlers = e => {
            const carousel = e.carousel;
            class customCarousel extends carousel {
                constructor() {
                    super();
                    elementorFrontend.hooks.addAction(
                        'frontend/element_ready/dynamic-media-carousel.default',
                        (e => {elementorFrontend.hooks.doAction('frontend/element_ready/media-carousel.default', e)})
                    )
                }
            }
            e.carousel = customCarousel;
            return e;
        };
        elementorProFrontend.on('elementor-pro/modules/init/before', (() => {
            elementorFrontend.hooks.addFilter('elementor-pro/frontend/handlers', extendDefaultHandlers, 11)
        }))
    }
})();