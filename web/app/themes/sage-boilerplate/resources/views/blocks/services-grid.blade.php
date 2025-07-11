@php
    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
    $items = get_field('items');
@endphp

<section class="{{ $classes }} px-2">
    <div class="is-layout-constrained text-center mb-17">
        <div class="px-8 sm:px-16 xl:px-32">
            <h2 class="heading-2 mb-7">{{ get_field('title') }}</h2>
            <p class="subtitle">{{ get_field('subtitle') }}</p>
        </div>
        <div class="text-gray-medium px-8 sm:px-16 xl:px-32 font-medium text-base">
            {!! get_field('description') !!}
        </div>
    </div>

    @if ($items && is_iterable($items))
        <div class="space-y-2 mb-30">
            @foreach (array_chunk($items, 2) as $rowIndex => $pair)
                @php $reverse = $rowIndex % 2 === 1; @endphp
                <div class="grid xl:grid-cols-2 gap-2">
                    @foreach ($pair as $item)
                        @php
                            $bg =
                                $item['color_scheme'] === 'primary'
                                    ? 'bg-primary text-secondary'
                                    : 'bg-secondary text-white';
                            $heading = $item['color_scheme'] === 'primary' ? 'text-secondary' : 'text-primary';
                            $image = wp_get_attachment_image_url($item['image'], 'full');
                            $itemDirection = $reverse ? 'sm:flex-row-reverse' : 'sm:flex-row';
                            $textAlign = $reverse ? 'xl:text-right' : 'xl:text-left';
                            $align = $reverse ? 'xl:items-end' : 'xl:items-start';
                        @endphp

                        <div class="flex flex-col {{ $itemDirection }} {{ $bg }} overflow-hidden h-full">
                            <div class="sm:w-1/2 h-auto">
                                <img src="{{ $image }}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="sm:w-1/2 flex flex-col justify-center px-8 py-8 2xl:px-11 2xl:py-11 items-start {{ $align }} {{ $textAlign }}">
                                <h3 class="heading-3 {{ $heading }} 2xl:mb-11 mb-8 uppercase">{{ $item['title'] }}</h3>
                                <p class="mb-11 text-white text-base font-medium">{{ $item['description'] }}</p>
                                @if ($item['button_text'] && $item['button_url'])
                                    <a href="{{ esc_url($item['button_url']) }}"
                                        class="btn btn-white">
                                        {{ $item['button_text'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
    @include('partials.contact-buttons', [
        'phoneBtnClass' => 'text-secondary',
        'phoneIconColor' => 'text-secondary',
        'emailBtnClass' => 'btn-secondary',
        'align' => 'justify-center'
    ])
</section>
