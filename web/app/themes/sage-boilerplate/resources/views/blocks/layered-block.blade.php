@php
    $title = get_field('layered_block_title');
    $image = get_field('layered_image');
    $items = get_field('layered_items') ?: [];
    $showButton = get_field('layered_button') ?: false;
@endphp

<section class="{{ $block['className'] ?? '' }} align is-layout-constrained px-8 xl:px-4 !mt-36">
    {{-- Block-Titel --}}
    @if ($title)
        <div class="text-center pb-10">
            <h2 class="heading-2 text-secondary uppercase">{{ $title }}</h2>
        </div>
    @endif

    <div class="flex flex-col md:flex-row items-center gap-20">
        {{-- Bild links --}}
        @if ($image)
            <div class="md:w-1/2 flex flex-col items-center">
                <img src="{{ esc_url($image['url']) }}" alt="{{ esc_attr($image['alt'] ?? '') }}"
                    class="w-full h-auto object-cover" />
                @if ($showButton)
                    <a class="btn btn-primary text-center w-[250px] mt-15" href="#">Jetzt konfigurieren</a>
                @endif
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
                            $subdesc = $item['subdescription'];
                        @endphp
                        <li class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 
                                         rounded-full bg-secondary text-primary font-black italic text-2xl shrink-0">
                                {{ $num }}
                            </span>
                            <div>
                                <p class="ml-4 text-secondary text-xl shrink-0">{{ $desc }}</p>
                                @if ($subdesc)
                                    <p class="ml-4 text-gray-medium text-base shrink-0">{{ $subdesc }}</p>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
