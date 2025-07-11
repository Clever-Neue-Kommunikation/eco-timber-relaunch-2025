@php
    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
    $image = wp_get_attachment_image_url(get_field('image'), 'full');
    $headline = get_field('headline');
    $subtitle = get_field('subtitle');
@endphp

<section class="{{ $classes }} bg-secondary">
    <div class="flex flex-col lg:flex-row overflow-hidden">
        {{-- Inhalt --}}
        <div class="flex basis-[45%] items-end justify-center lg:justify-start relative shrink grow-0 z-1 with-slant with-slant--secondary-right xl:ml-[calc((100%-1176px)/2)] order-2 lg:order-1">
            <div class="py-15 lg:py-0 px-2 lg:px-0 xl:!ps-4 lg:ps-8   text-center lg:text-left">
                @if ($subtitle)
                    <p class="text-primary !text-2xl xl:!text-3xl font-bold italic pb-8 lg:whitespace-nowrap">{{ $subtitle }}</p>
                @endif
                @if ($headline)
                    <h1 class="heading-2 uppercase text-primary lg:mb-10">{{ $headline }}</h1>
                @endif
            </div>
        </div>

        {{-- Bild --}}
        <div class="basis-[55%] shrink-0 grow order-1 lg:order-2">
            <img src="{{ $image }}" alt="" class="w-full h-[450px] lg:h-[450px] object-cover" />
        </div>
    </div>
</section>
