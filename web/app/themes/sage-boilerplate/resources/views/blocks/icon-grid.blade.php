@php
    $headline = get_field('headline');
    $subtitle = get_field('ig_subtitle');
    $items = collect(get_field('items') ?: []);
    $columns = get_field('columns') ?: 4;
    $chunks = $items->chunk($columns);
    $showButtons = get_field('show_buttons') !== false;
    $useLargeText = get_field('use_large_text');
    $textClass = $useLargeText ? 'font-extrabold !text-2xl font-display italic' : 'font-medium text-base';
    $text_align = get_field('reference_text_align') ?: 'text-left';
    $btnText = get_field('button_text');
    $btnUrl = get_field('button_url');

    $bgColor = get_field('bg_color') ?: 'white';
    if ($bgColor === 'green') {
        $containerBg = 'bg-secondary';
        $containerText = 'text-white';
        $headlineColor = 'text-primary';
    } else {
        $containerBg = 'bg-white';
        $containerText = 'text-secondary';
        $headlineColor = 'text-secondary';
    }

    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
@endphp



<section class=" {{ $containerBg }} {{ $containerText }} {{ $classes }} is-layout-constrained !mb-40">
    <div class=" text-center px-8 xl:px-4">
        @if ($headline)
            <h2 class="heading-2 uppercase mb-0 {{ $headlineColor }} {{ $text_align }}">
                {{ $headline }}
            </h2>
        @endif
        @if ($subtitle)
            <p class="subtitle mt-6 {{ $text_align }}">{{ $subtitle }}</p>
        @endif

        @foreach ($chunks as $chunk)
            @php
                $defaultCols = match ($columns) {
                    1 => 'grid-cols-1',
                    2 => 'grid-cols-2',
                    3 => 'grid-cols-3',
                    4 => 'grid-cols-4',
                    5 => 'grid-cols-5',
                    6 => 'grid-cols-6',
                    default => 'grid-cols-4',
                };
                $chunkCount = $chunk->count();
                $chunkCols = match ($chunkCount) {
                    1 => 'grid-cols-1 place-items-center',
                    2 => 'grid-cols-2 place-items-center',
                    3 => 'lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 place-items-center',
                    4 => 'lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 place-items-center',
                    5 => 'lg:grid-cols-5 sm:grid-cols-2 grid-cols-1 place-items-center',
                    6 => 'lg:grid-cols-6 sm:grid-cols-2 grid-cols-1 place-items-center',
                    default => "$defaultCols place-items-center",
                };
            @endphp

            <div class="grid items-stretch {{ $chunkCols }} justify-items-center gap-6 gap-y-10 xl:gap-y-20 mt-20">
                @foreach ($chunk as $item)
                    @php
                        $isHighlighted = $item['use_highlight'];
                        // wenn hervorgehoben: Hintergrund-Klasse
                        $itemBgClass = $isHighlighted ? 'bg-primary' : '';
                        // Icon-Farbe je nach Highlight
                        $itemIconClass = $isHighlighted ? 'text-secondary' : 'text-primary';
                    @endphp
                    <div class="flex flex-col text-center w-40 py-6 px-2 {{ $itemBgClass }}">
                        <i class="{{ $item['icon'] }} text-6xl {{ $itemIconClass }} mb-6"></i>
                        <p class="{{ $textClass }}">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach

        @if ($btnText && $btnUrl)
            <div class="mt-20 flex flex-col items-center">
                <a class="btn btn-primary-outline" href="{{ esc_url($btnUrl) }}">{{ esc_html($btnText) }}</a>
            </div>
        @endif

        @if ($showButtons)
            <div class="mt-20">
                @include('partials.contact-buttons', [
                    'phoneBtnClass' => 'text-primary',
                    'phoneIconColor' => 'text-primary',
                    'emailBtnClass' => 'btn-primary-outline',
                    'align' => 'justify-center',
                ])
            </div>
        @endif
    </div>
</section>
