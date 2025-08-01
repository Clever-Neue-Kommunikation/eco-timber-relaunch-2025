@php
  // Block-Klassen
  $classes = 'swiper-block ' . ($block['className'] ?? '');
  $partners = get_field('ps_partners') ?: [];
  $title = get_field('ps_title');
  $description = get_field('ps_description');
@endphp
<div class="px-8 xl:px-4 pb-10">
  <h2 class="heading-2 text-secondary  uppercase text-center">
  {{-- Titel --}}
  {{ $title }}
  </h2>
  @if ($description)
    <div class="text-center text-base text-gray-medium mt-10">{!! $description !!}</div>
  @endif
</div>
<section class=" relative py-16 is-layout-constrained overflow-hidden px-8 xl:px-4">
  {{-- Prev/Next Buttons --}}
  <button class="swiper-button-prev absolute  top-1/2 -translate-y-1/2 z-10 p-1 rounded-full border-2 border-primary bg-white hover:bg-primary group !w-8 !h-8">
  <i class="fa-regular fa-arrow-left text-primary group-hover:text-white text-3xl"></i>
  </button>
  <button class="swiper-button-next absolute  top-1/2  z-10 p-1 rounded-full border-2 border-primary bg-white hover:bg-primary group !w-8 !h-8">
  <i class="fa-regular fa-arrow-right text-primary group-hover:text-white text-3xl"></i>
  </button>

  {{-- Swiper Container --}}
  <div class="{{ $classes }} swiper partnerSwiper !mt-0">
    {{-- Swiper Wrapper --}}
    <div class="swiper-wrapper">
      @foreach ($partners as $partner)
        @if (!empty($partner['logo']))
          <div class="swiper-slide flex items-center justify-center">
            <img src="{{ esc_url($partner['logo']) }}"
                 alt="{{ esc_attr($partner['name'] ?? '') }}"
                 class="h-10 object-contain m-auto" />
          </div>
        @endif
      @endforeach
    </div>
  </div>
</section>


