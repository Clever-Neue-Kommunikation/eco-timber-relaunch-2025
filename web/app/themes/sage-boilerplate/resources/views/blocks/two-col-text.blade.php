@php
    $leftTitle = get_field('tct_left_title');
    $leftSubtitle = get_field('tct_left_subtitle');
    $leftText = get_field('tct_left_text');
    $rightTitle = get_field('tct_right_title');
    $rightText = get_field('tct_right_text');
    $showButtons = get_field('tct_show_buttons');

    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
@endphp

<div class="{{ $classes }} py-16 is-layout-constrained">
    <div class="px-8 xl:px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

            {{-- Linke Spalte --}}
            <div>
                @if ($leftTitle)
                    <h2 class="heading-2 text-secondary uppercase mb-12">{{ $leftTitle }}</h2>
                @endif
                @if ($leftSubtitle)
                    <h3 class="text-2xl font-black italic uppercase text-primary mb-4">{{ $leftSubtitle }}</h3>
                @endif

                @if ($leftText)
                    <div class="text-base text-gray-medium">
                        {!! $leftText !!}
                    </div>
                @endif
            </div>

            {{-- Rechte Spalte --}}
            <div>
                @if ($rightTitle)
                    <h3 class="text-2xl font-black italic uppercase text-primary mb-4">{{ $rightTitle }}</h3>
                @endif

                @if ($rightText)
                    <div class="text-base text-gray-medium">
                        {!! $rightText !!}
                    </div>
                @endif
            </div>

        </div>
        @if ($showButtons)
            <div class="mt-16">
                @include('partials.contact-buttons', [
                    'phoneBtnClass' => 'btn-clean',
                    'phoneIconColor' => 'text-secondary',
                    'emailBtnClass' => 'btn btn-secondary',
                    'align' => 'justify-center',
                ])
            </div>
        @endif
    </div>
</div>
