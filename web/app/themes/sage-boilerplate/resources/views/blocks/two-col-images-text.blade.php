@php
  // Felder
  $images        = get_field('tc_images') ?: [];
  $title         = get_field('tc_title');
  $text          = get_field('tc_text');
  // Neue Option: Bilder links oder rechts
  $imagePosition = get_field('tc_image_position') ?: 'left'; // left oder right

  // Order‑Klassen für Tailwind
  $imgOrderClass  = $imagePosition === 'left'  ? 'lg:order-1' : 'lg:order-2';
  $textOrderClass = $imagePosition === 'left'  ? 'lg:order-2' : 'lg:order-1';

  // Block-Klassen
  $classes = trim(implode(' ', [
    $block['className'] ?? '',
    isset($block['align']) ? 'align'.$block['align'] : '',
  ]));
@endphp

<section class="{{ $classes }}">
  <div class="px-8 xl:px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

      {{-- Bild-Spalte --}}
      <div class="space-y-8 {{ $imgOrderClass }}">
        @foreach($images as $row)
          @if(!empty($row['image']))
            <div class="overflow-hidden">
              <img src="{{ esc_url($row['image']) }}"
                   alt=""
                   class="w-full h-80 object-cover">
            </div>
          @endif
        @endforeach
      </div>

      {{-- Text-Spalte --}}
      <div class="flex flex-col justify-between {{ $textOrderClass }}">
        <div class="">
          @if($title)
            <h2 class="heading-2 text-secondary mb-4 uppercase">{{ $title }}</h2>
          @endif
        </div>

        <div class="text-gray-medium text-base">
          {!! $text !!}
        </div>

        <div class="pt-20">
          @include('partials.contact-buttons', [
            'phoneBtnClass'  => 'text-gray-medium',
            'phoneIconColor' => 'text-primary',
            'emailBtnClass'  => 'btn btn-primary-outline',
            'align'          => 'justify-center',
          ])
        </div>
      </div>

    </div>
  </div>
</section>

