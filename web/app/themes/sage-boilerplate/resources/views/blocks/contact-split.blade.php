@php
    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
    $image = wp_get_attachment_image_url(get_field('image'), 'large');
@endphp

<section class="is-layout-constrained overflow-hidden {{ $classes }}">
    <div class="grid xl:grid-cols-2 items-center">

        {{-- Linke Spalte --}}
        <div
            class="bg-primary bg-full-primary-left ps-4 xl:os-4 pe-8 py-24 xl:my-12 relative with-slant with-slant--primary-right z-10">
            <div class="heading-2 text-secondary">
                {!! get_field('text1') !!}
            </div>
        </div>

        {{-- Rechte Spalte --}}
        <div
            class="bg-secondary bg-full-secondary-right text-white relative xl:ps-0 py-24 grid gap-18 xl:gap-12 items-center xl:justify-items-start justify-items-center with-slant with-slant--secondary-left z-1">

            <div class="flex flex-col xl:flex-row xl:items-end gap-10 xl:gap-10 px-4 xl:px-0">
                <div class="shrink-0 text-center">
                    <img src="{{ $image }}" alt="" class="xl:w-full h-full m-auto object-cover pb-15" />
                    <a class="btn btn-primary-outline xl:ms-15" href="">E-Mail an Christian</a>
                </div>
                <div class=" text-primary font-display italic text-2xl font-extrabold">
                    {!! get_field('text2') !!}
                    <div class="mt-15 flex flex-col items-center xl:items-start">
                        <a class="btn btn-clean text-white" href=""><i
                                class="fa-regular fa-phone-arrow-right text-2xl text-primary"></i> +49 (0) 3606
                            502310-31</a>
                        <a class="btn btn-clean text-white mt-5" href=""><i
                                class="fa-regular fa-mobile-button text-2xl text-primary me-1"></i> +49 (0) 162 1726946</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
