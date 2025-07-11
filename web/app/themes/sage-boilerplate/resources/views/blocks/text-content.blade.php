@php
  $headline = get_field('headline');
  $subheadline = get_field('subheadline');
  $text = get_field('text');
  $showButtons = get_field('show_buttons') !== false;

  $classes = array_filter([
    $block['className'] ?? '',
    isset($block['align']) ? 'align' . $block['align'] : '',
  ]);
  $classes = implode(' ', $classes);
@endphp

<section class="{{ $classes }} xl:ps-4 ps-8 pe-4">
  <div class="is-layout-constrained ">
    @if ($headline)
      <h2 class="heading-2 text-secondary">{{ $headline }}</h2>
    @endif

    @if ($subheadline)
      <p class="subtitle">{{ $subheadline }}</p>
    @endif

    @if ($text)
      <div class=" text-gray-medium text-base !mb-15">
        {!! $text !!}
      </div>
    @endif

    @if ($showButtons)
      @include('partials.contact-buttons', [
        'phoneBtnClass' => 'text-gray-medium',
        'phoneIconColor' => 'text-primary',
        'emailBtnClass' => 'btn-primary-outline',
        'align' => 'justify-center'
    ])
    @endif
  </div>
</section>
