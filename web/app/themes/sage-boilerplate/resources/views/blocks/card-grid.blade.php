@php
    $title = get_field('card_grid_title');
    $subtitle = get_field('card_grid_subtitle');
    $description = get_field('card_grid_description');
    $cards = get_field('cards') ?: [];
@endphp

@if ($title)
    <section class="align is-layout-constrained px-8 xl:px-4 text-left mb-12">
        <h2 class="heading-2 text-secondary uppercase">{{ $title }}</h2>
        @if ($subtitle)
            <p class="subtitle">{{ $subtitle }}</p>
        @endif
        @if ($description)
            <p class="mt-2 text-gray-medium text-base">{{ $description }}</p>
        @endif

@endif

@if ($cards)
    <div class="{{ $block['className'] ?? '' }} align{{ $block['align'] ?? '' }} !mt-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($cards as $card)
                @php
                    $icon = $card['icon'];
                    $heading = $card['heading'];
                    $text = $card['text'];
                    $highlight = $card['highlight'];
                @endphp

                <div @class(['bg-white p-6', 'border-2 border-primary' => $highlight])>
                    {{-- Icon statt Bild --}}
                    @if ($icon)
                        <i class="{{ $icon }} text-6xl text-primary mb-4 w-full"></i>
                    @endif

                    @if ($heading)
                        <h3 class="text-xl font-bold text-center mb-6">{{ $heading }}</h3>
                    @endif

                    @if ($text)
                        <p class="mt-2 text-gray-medium text-base">{{ $text }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="!mt-25">
        @include('partials.contact-buttons', [
            'phoneBtnClass' => 'text-gray-medium',
            'phoneIconColor' => 'text-primary',
            'emailBtnClass' => 'btn-primary-outline',
            'align' => 'justify-center',
        ])
    </div>
    </section>
@endif
