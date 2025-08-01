@php
  $title = get_field('ag_title');
  $items = get_field('ag_items') ?: [];
  // Block-Klassen (custom & align)
  $classes = trim(implode(' ', [
    $block['className'] ?? '',
    isset($block['align']) ? 'align'.$block['align'] : '',
  ]));
@endphp

<section class="{{ $classes }}">
  <div class="px-8 xl:px-4 text-center">
    @if($title)
      <h2 class="heading-2 mb-16 uppercase">{{ $title }}</h2>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
      @foreach($items as $item)
        @php
          $icon = $item['icon_class'] ?? '';
          $text = $item['text']       ?? '';
        @endphp
        <div class="flex flex-col items-center">
          @if($icon)
            <div class="bg-secondary p-12 rounded-lg mb-6">
              <i class="{{ $icon }} text-6xl text-primary"></i>
            </div>
          @endif
          @if($text)
            <p class="text-gray-medium text-base font-medium">
              {!! nl2br(esc_html($text)) !!}
            </p>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
