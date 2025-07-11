<section class="relative bg-secondary text-white overflow-hidden">
    <div class="grid xl:grid-cols-[45%_55%]">

        {{-- LINKE SPALTE --}}
        <div class="relative flex items-center justify-center xl:justify-start bg-secondary order-2 xl:order-1">
            {{-- Schräge Fläche als before-Element --}}
            <div class="absolute inset-0 with-slant with-slant--secondary-right z-10"></div>

            {{-- Inhalt mit CONTAINER --}}
            <div class="xl:ml-[calc((100vw-1176px)/2)] z-10 xl:ps-2 px-4 pb-15 pt-15 xl:pt-48 xl:pb-0 text-center xl:text-start">
                <p class="subtitle xl:text-nowrap">
                    Natürlich nachhaltig. Perfekt verarbeitet.
                </p>
                <h1
                    class="text-5xl xl:text-9xl font-display font-black italic uppercase xl:leading-30 tracking-wider xl:mb-6 xl:-mr-108">
                    Wir machen mehr<br />aus Ihrem Holz.
                </h1>
                <div class="flex flex-wrap justify-center xl:justify-start gap-4 mt-11 xl:my-32">
                    <a href="/referenz-projekte"
                        class="btn btn-primary">
                        Referenz-Projekte
                    </a>
                    <a href="/uber-uns"
                        class="btn btn-white">
                        Mehr über uns
                    </a>
                </div>
            </div>
        </div>

        {{-- RECHTE SPALTE --}}
        <div class="relative h-full overflow-hidden order-1 xl:order-2">
            <div class="swiper heroSwiper w-full h-full"> 
                <div class="swiper-wrapper">
                    @include('partials.hero-slide', [
                        'image' => Vite::asset('resources/images/header-holzbau.jpg'),
                        'link' => '/leistungen/holzbau',
                        'linkText' => 'Holzbau',
                    ])
                    @include('partials.hero-slide', [
                        'image' => Vite::asset('resources/images/header-lohnabbund.jpg'),
                        'link' => '/leistungen/lohnabbund',
                        'linkText' => 'Lohnabbund',
                    ])
                </div>
                <div class="swiper-pagination bottom-10"></div>
            </div>
        </div>

    </div>
</section>
