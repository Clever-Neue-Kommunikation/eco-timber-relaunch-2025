@php
    $title = get_field('fb_section_title');
    $subtitle = get_field('fb_section_subtitle');
    $items = get_field('fb_items') ?: [];

    // Klassen aus Block-Settings
    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
@endphp

<div class="{{ $classes }} py-20 bg-secondary is-layout-constrained text-white">
    <div class="mx-auto px-4 text-center">

        {{-- Sektionstitel --}}
        @if ($title)
            <h2 class="heading-2 mb-4 uppercase text-primary">{{ $title }}</h2>
        @endif

        {{-- Untertitel --}}
        @if ($subtitle)
            <p class="text-base mb-12 uppercase">{{ $subtitle }}</p>
        @endif

        {{-- Bubble-Reihe --}}
        @if (count($items))
            <div class="flex items-center justify-center space-x-4 md:space-x-2 lg:space-x-4">
                @foreach ($items as $idx => $item)
                    @php
                        $text = nl2br(esc_html($item['text']));
                        $highlight = (bool) $item['highlight'];
                        $subtext = nl2br(esc_html($item['subtext']));
                    @endphp

                    {{-- Einzelner Bubble --}}
                    <div class="relative flex-shrink-0">
                        <div
                            class="flex items-center justify-start flex-col w-50 h-50 md:w-65 md:h-65 rounded-full pt-4
                        {{ $highlight
                            ? 'bg-primary text-secondary border-2 border-white'
                            : 'border-2 border-white text-white bg-transparent' }}">
                            <i
                                class="fa-regular fa-check text-2xl md:text-3xl mb-2 {{ $highlight ? ' text-secondary ' : ' text-primary' }}">"></i>
                            <div class="inset-0 flex items-center justify-center px-4 mb-2 text-center font-bold md:text-lg leading-tight">
                                {{-- Text --}}
                                {!! $text !!}
                            </div>
                            <div
                                class="inset-0 flex items-center justify-center px-4 text-center md:text-base {{ $highlight ? ' text-white ' : ' text-gray-light' }}">
                                {!! $subtext !!}
                            </div>
                        </div>

                    </div>

                    {{-- "+" zwischen den Bubbles (außer nach dem letzten) --}}
                    @if ($idx < count($items) - 1)
                        <i class="fa-regular fa-circle-plus text-primary text-2xl md:text-3xl mb-2"></i>
                    @endif
                @endforeach
            </div>
        @endif

    </div>
</div>
