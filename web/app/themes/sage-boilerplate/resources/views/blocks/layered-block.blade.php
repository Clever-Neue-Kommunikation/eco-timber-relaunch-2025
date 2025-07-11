@php
    $title = get_field('layered_block_title');
    $image = get_field('layered_image');
    $items = get_field('layered_items') ?: [];
@endphp

<section class="{{ $block['className'] ?? '' }} align is-layout-constrained px-8 xl:px-4 !mt-36">
    {{-- Block-Titel --}}
    @if ($title)
        <div class="text-center">
            <h2 class="heading-2 text-secondary uppercase">{{ $title }}</h2>
        </div>
    @endif

    <div class="flex flex-col md:flex-row items-center gap-20">
        {{-- Bild links --}}
        @if ($image)
            <div class="md:w-1/2">
                <img src="{{ esc_url($image['url']) }}"
                     alt="{{ esc_attr($image['alt'] ?? '') }}"
                     class="w-full h-auto object-cover" />
            </div>
        @endif

        {{-- Nummernliste rechts --}}
        @if ($items)
            <div class="md:w-1/2">
                <ul class="space-y-6">
                    @foreach ($items as $item)
                        @php
                            $num = $item['number'];
                            $desc = $item['description'];
                        @endphp
                        <li class="flex items-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 
                                         rounded-full bg-secondary text-primary font-black italic text-2xl">
                                {{ $num }}
                            </span>
                            <p class="ml-4 text-secondary text-xl">{{ $desc }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
