@php
  $classes = array_filter([
    $block['className'] ?? '',
    isset($block['align']) ? 'align' . $block['align'] : '',
  ]);
  $classes = implode(' ', $classes);
  $benefits = get_field('benefits');
@endphp

<section class="is-layout-constrained overflow-hidden {{ $classes }}">
  <div class="grid xl:grid-cols-2 items-center">

    {{-- Linke Spalte --}}
    <div class="bg-primary bg-full-primary-left px-4 py-20 xl:my-12 relative with-slant with-slant--primary-right z-10">
      <h2 class="heading-2 text-secondary mb-15">
        {{ get_field('title') }}
      </h2>
      <div class="text-base text-white mb-11 font-medium">
        {!! get_field('text') !!}
      </div>

      <div class="flex flex-col xl:flex-row gap-6 items-center">
        <div class="flex items-center gap-2">
          <a href="tel:036065023100"
          class="mt-4 sm:mt-0 btn btn-clean">
          <i class="fa-regular fa-phone-arrow-right text-2xl text-secondary"></i>
          +49 (0) 3606 502310-0
        </a>
        </div>
        <a href="mailto:info@eco-timber.de"
          class="mt-4 sm:mt-0 btn btn-secondary">
          E-Mail an uns
        </a>
      </div>
    </div>

    {{-- Rechte Spalte --}}
    <div class="bg-secondary bg-full-secondary-right text-white relative xl:ps-32 py-20 grid gap-18 xl:gap-12 items-center xl:justify-items-start justify-items-center with-slant with-slant--secondary-left z-1">
      @if($benefits)
        @foreach($benefits as $benefit)
          <div class="flex flex-col xl:flex-row items-center gap-6 xl:gap-4 px-4 xl:px-0">
            <i class="{{ $benefit['icon'] }} text-primary text-7xl w-30 h-30 shrink-0 mt-1"></i>
            <p class="text-base text-center xl:text-start font-semibold">{{ $benefit['text'] }}</p>
          </div>
        @endforeach
      @endif
    </div>

  </div>
</section>
