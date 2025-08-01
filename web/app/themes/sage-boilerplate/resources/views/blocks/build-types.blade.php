@php
    $sectionTitle = get_field('bt_section_title');
    $items = get_field('bt_items') ?: [];
    $leftdescription = get_field('bt_left_description');
    $rightdescription = get_field('bt_right_description');
    $btnText = get_field('bt_button_text');
    $btnUrl = get_field('bt_button_url');
    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
@endphp

<section class="{{ $classes }} px-8 xl:px-4 bg-white">
    <div class="mx-auto text-center">

        {{-- Sektionstitel --}}
        @if ($sectionTitle)
            <h2 class="heading-2 text-secondary mb-12">{{ $sectionTitle }}</h2>
        @endif
        @if ($leftdescription && $rightdescription)
            <div class="grid grid-cols-1 lg:grid-cols-2 text-gray-medium text-base text-left gap-14 my-16">
                <div>{!! $leftdescription !!}</div>
                <div>{!! $rightdescription !!}</div>
            </div>
        @endif

        {{-- Grid mit Bildern & Beschriftungen --}}
        @if (count($items))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($items as $item)
                    @php
                        $img = $item['image'] ?? '';
                        $label = $item['label'] ?? '';
                    @endphp
                    <div>
                        @if ($img)
                            <img src="{{ esc_url($img) }}" alt="{{ esc_attr($label) }}"
                                class="w-full h-auto object-cover mb-4" />
                        @endif
                        @if ($label)
                            <p class="text-2xl text-left font-black italic text-secondary">{{ $label }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        @if ($btnText && $btnUrl)
            <div class="mt-20 flex flex-col items-center">
                <a class="btn btn-primary-outline" href="{{ esc_url($btnUrl) }}">{{ esc_html($btnText) }}</a>
            </div>
        @endif
    </div>
</section>
