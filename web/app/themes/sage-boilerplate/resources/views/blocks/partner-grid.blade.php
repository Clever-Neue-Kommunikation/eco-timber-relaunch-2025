@php
    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
    $backgroundColor = get_field('pt_background') ?: 'white';
    $bgColor = match ($backgroundColor) {
        'secondary' => 'bg-secondary',
        'white' => 'bg-white',
        default => 'bg-white',
    };
    $titleColor = match ($backgroundColor) {
        'secondary' => ' text-primary',
        'white' => ' text-secondary',
        default => ' text-primary',
    };
    $textColor = match ($backgroundColor) {
        'secondary' => ' text-white',
        'white' => ' text-gray-medium',
        default => ' text-gray-medium',
    };
    $title = get_field('partner_grid_title');
    $subtitle = get_field('partner_grid_subtitle');
    $intro = get_field('partner_grid_intro');
    $items = get_field('partner_items') ?: [];
@endphp




@if ($items)
    <section class="{{ $classes }} is-layout-constrained px-8 xl:px-4 text-left py-20 {{ $bgColor }}">
        @if ($title)
            <div class="text-center !mb-20">
                <h2 class="heading-2 {{ $titleColor }} uppercase">{{ $title }}</h2>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-20 px-8 xl:px-4">
            @foreach ($items as $item)
                @php
                    $icon = $item['icon'];
                    $heading = $item['heading'];
                    $text = $item['text'];
                    $highlight = $item['highlight'];
                @endphp

                <div>
                    @if ($icon)
                        <div class="flex items-end mb-10">
                            <i class="{{ $icon }} text-6xl text-white p-4 bg-secondary rounded"></i>
                            @if ($heading)
                                <h3 class="text-2xl font-black italic text-primary ps-4">{{ $heading }}</h3>
                            @endif
                        </div>
                    @endif



                    @if ($text)
                        <div class="{{ $textColor }} text-base">
                            {!! $text !!}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endif
