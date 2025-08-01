@php
    $sectionTitle = get_field('ps_section_title');
    $items = get_field('ps_items') ?: [];
    // Block-CSS-Klassen (align, custom className)
    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
@endphp

<section class="{{ $classes }} py-16 bg-secondary is-layout-constrained">
    <div class="mx-auto px-4 text-center">
        {{-- Sektionstitel --}}
        @if ($sectionTitle)
            <h2 class="heading-2 text-primary uppercase mb-12">{{ $sectionTitle }}</h2>
        @endif

        @if (count($items))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($items as $item)
                    @php
                        $img = $item['image'] ?? '';
                        $title = $item['title'] ?? '';
                        $url = $item['url'] ?? '#';
                        $label = $item['label'] ?: __('mehr erfahren', 'sage');
                    @endphp

                    <div
                        class="mix rounded shadow-sm overflow-hidden hover:shadow-2xl transition-shadow">
                        @if ($img)
                            <a href="{{ $url }}" class="relative block">
                                <img src="{{ $img }}" alt="{{ $title }}"
                                    class="w-full h-120 object-cover " />
                                <div
                                    class="pb-4 ps-4 xl:ps-8 pe-4 pt-20 absolute bottom-0 bg-gradient-to-t from-black to-transparent w-full flex align-items-end">
                                    <h3 class="text-4xl text-white font-black text-left italic mb-2 w-full">
                                        {!! $title !!}
                                    </h3>
                                    <span class="text-white text-base font-semibold self-end px-2 mb-3 shrink-0">
                                        {{ $label }}
                                    </span>
                                    <i class="fa-regular fa-circle-arrow-right text-white text-3xl self-end mb-3 shrink-0"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
