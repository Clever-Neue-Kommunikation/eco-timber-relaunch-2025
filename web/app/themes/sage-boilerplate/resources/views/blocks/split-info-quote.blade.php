@php
    $leftContent = get_field('si_left_content');
    $iconClass = get_field('si_icon_class');
    $quote = get_field('si_quote');
    $quoteSource = get_field('si_quote_source');
    $showButtons = get_field('si_buttons');

    // Block-Klassen (custom & align)
    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
@endphp

<section class="{{ $classes }} is-layout-constrained overflow-hidden">
    <div class="flex flex-col lg:flex-row relative items-center">

        {{-- Linke Spalte --}}
        <div class="w-full lg:w-1/2 ps-8 xl:ps-4 pe-20">
            @if ($leftContent)
                <div class="text-base text-gray-medium">
                    {!! $leftContent !!}
                </div>
            @endif

            @if ($showButtons)
                <div class="mt-10">
                    @include('partials.contact-buttons', [
                        'phoneBtnClass' => 'btn btn-clean text-gray-medium',
                        'phoneIconColor' => 'text-primary',
                        'emailBtnClass' => 'btn btn-primary-outline',
                        'align' => 'justify-start',
                    ])
                </div>
            @endif
        </div>

        {{-- Rechte Spalte --}}
        <div
            class="w-full lg:w-1/2 with-slant with-slant--secondary-left bg-full-secondary-right z-1 text-white py-16 flex flex-col justify-center">
            <div class="ps-20">
                @if ($iconClass)
                    <i class="{{ $iconClass }} text-6xl mb-6 text-primary self-start"></i>
                @endif

                @if ($quote)
                    <blockquote class="italic text-base mb-6">
                        {{ $quote }}
                    </blockquote>
                @endif

                @if ($quoteSource)
                    <cite class="text-base font-medium">
                        {{ $quoteSource }}
                    </cite>
                @endif
            </div>

        </div>

    </div>
</section>
