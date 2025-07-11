@props(['image', 'link' => '#', 'linkText' => 'Mehr erfahren', 'logos'])

<div class="swiper-slide relative h-full">
    <img src="{{ $image }}" class="object-cover w-full h-[850px]" alt="">
    <div>
        <img src="{{ Vite::asset('resources/images/siegel.jpg') }}" alt="" class="h-24 absolute bottom-24 left-50 hidden xl:block">
    </div>
    <div class="absolute md:bottom-15 md:right-18 bottom-5 right-3 flex flex-col items-end z-20">
        <a href="{{ $link }}"
            class="flex items-center gap-2 uppercase text-white text-[19px] font-medium group hover:underline">
            {{ $linkText }}
            <i
                class="fa-regular fa-circle-arrow-right group-hover:translate-x-1 transition-transform p-1"></i>
        </a>
    </div>
</div>
