@php
    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
    $image = wp_get_attachment_image_url(get_field('image'), 'full');
    $imagePosition = get_field('image_position') ?? 'left';
    $bg = get_field('background') === 'primary' ? 'bg-primary text-secondary' : 'bg-secondary text-white';
    $headline = get_field('headline');
    $headlineColor = get_field('background') === 'primary' ? 'text-secondary' : 'text-primary';
    $btnColor = get_field('background') === 'primary' ? 'btn-secondary' : 'btn-primary-outline';
    $text = get_field('text');
    $btn1Text = get_field('button_1_text');
    $btn1Url = get_field('button_1_url');
    $btn2Text = get_field('button_2_text');
    $btn2Url = get_field('button_2_url');
    $showButtons = get_field('show_buttons') !== false;
    $contentMargin =
        $imagePosition === 'right' ? 'xl:ml-[calc((100%-1176px)/2)] ml-8' : 'xl:mr-[calc((100%-1176px)/2)] mr-8';
    $contentPadding = $imagePosition === 'right' ? 'xl:pe-20 xl:ps-4 pe-8' : 'xl:ps-20 ps-8';

    $hasCustomButtons = ($btn1Text && $btn1Url) || ($btn2Text && $btn2Url);

    $reverse = $imagePosition === 'right' ? 'lg:flex-row-reverse' : 'lg:flex-row';
    $slantClass = match (true) {
        $imagePosition === 'right' && get_field('background') === 'secondary' => 'with-slant--secondary-right',
        $imagePosition === 'right' && get_field('background') === 'primary' => 'with-slant--primary-right',
        $imagePosition === 'left' && get_field('background') === 'secondary' => 'with-slant--secondary-left',
        $imagePosition === 'left' && get_field('background') === 'primary' => 'with-slant--primary-left',
        default => '',
    };
@endphp

<div class="{{ $classes }} {{ $bg }} mt-2! mx-2 lg:mx-0">
    <div class="flex flex-col lg:flex-row {{ $reverse }} overflow-hidden">
        {{-- Bild --}}
        <div class="basis-[50%] shrink-0 grow">
            <img src="{{ $image }}" alt="" class="w-full h-[500px] lg:h-[700px] object-cover" />
        </div>

        {{-- Inhalt --}}
        <div
            class="flex basis-[50%] items-center relative shrink grow-0 z-1 with-slant {{ $slantClass }} {{ $contentMargin }}">
            <div class="{{ $contentPadding }} py-15 lg:py-0">
                @if ($headline)
                    <h2 class="heading-2 {{ $headlineColor }} mb-15">{{ $headline }}</h2>
                @endif

                @if ($text)
                    <div class="text-white text-base">
                        {!! $text !!}
                    </div>
                @endif

                @if ($showButtons)
                    @if ($hasCustomButtons)
                        <div class="flex flex-col sm:flex-row gap-4 text-secondary font-medium mt-10">
                            @if ($btn1Text && $btn1Url)
                                <a href="{{ esc_url($btn1Url) }}"
                                    class="btn btn-clean {{ $btnColor }}">{{ $btn1Text }}</a>
                            @endif
                            @if ($btn2Text && $btn2Url)
                                <a href="{{ esc_url($btn2Url) }}"
                                    class="btn {{ $btnColor }}">{{ $btn2Text }}</a>
                            @endif
                        </div>
                    @else
                        <div class="mt-10">
                            @include('partials.contact-buttons', [
                                'phoneBtnClass' => $headlineColor,
                                'phoneIconColor' => $headlineColor,
                                'emailBtnClass' => $btnColor,
                                'align' => 'justify-start',
                            ])
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
