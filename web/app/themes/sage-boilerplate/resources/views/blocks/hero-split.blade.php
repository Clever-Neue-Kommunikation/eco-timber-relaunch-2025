@php
    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
    $image = wp_get_attachment_image_url(get_field('image'), 'large');
    $headline = get_field('headline');
    $text = get_field('text');
@endphp

<section class="{{ $classes }}">
    <div class="flex flex-col lg:flex-row items-start xl:max-h-116">

        {{-- Bildseite: klebt am Rand --}}
        <div class="relative -mb-50 lg:mb-0 z-0 order-2 lg:order-1 pt-20 lg:pt-0 pe-20 lg:pe-0">
            <img src="{{ $image }}" alt="" class="w-full h-full object-cover" />
        </div>

        {{-- Inhalt im Container --}}
        <div class="flex items-center lg:w-250 bg-white z-10 order-1 lg:order-2">
            <div class="px-8 lg:px-20">
                <h2 class="heading-2 mb-15">
                    {{ $headline }}
                </h2>
                <div class="text-gray-medium text-base font-medium mb-11">
                    {!! $text !!}
                </div>
                @include('partials.contact-buttons', [
                    'phoneBtnClass' => 'text-gray-medium',
                    'phoneIconColor' => 'text-primary',
                    'emailBtnClass' => 'btn-primary-outline',
                    'align' => 'justify-center lg:justify-start'
                ])
            </div>
        </div>

    </div>
</section>
