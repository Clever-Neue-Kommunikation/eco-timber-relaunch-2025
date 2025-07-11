@php
    $title = get_field('partner_grid_title');
    $subtitle = get_field('partner_grid_subtitle');
    $intro = get_field('partner_grid_intro');
    $items = get_field('partner_items') ?: [];
@endphp




@if ($items)
    <section class="align is-layout-constrained px-8 xl:px-4 text-left mb-20">
        @if ($title)
            <div class="text-center !mb-20">
                <h2 class="heading-2 text-secondary uppercase">{{ $title }}</h2>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-20">
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
                        <div class="text-gray-medium text-base">
                            {!! $text !!}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endif
