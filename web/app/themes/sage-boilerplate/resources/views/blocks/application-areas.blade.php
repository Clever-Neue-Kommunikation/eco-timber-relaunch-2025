@php
    // ACF-Felder
    $title = get_field('aa_title');
    $introLeft = get_field('aa_intro_left');
    $introRight = get_field('aa_intro_right');
    $items = get_field('aa_items') ?: [];
    $showContact = get_field('aa_show_contact');

    // Block-Klassen
    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
@endphp

<section class="{{ $classes }} py-24 bg-secondary text-white is-layout-constrained !mt-2">
    <div class="px-8 xl:px-4 text-center">

        {{-- Überschrift --}}
        @if ($title)
            <h2 class="heading-2 uppercase text-primary mb-20">{{ $title }}</h2>
        @endif

        {{-- Einleitungen --}}
        @if($introLeft && $introRight)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-base text-left mb-16">
            <div class="">{!! $introLeft !!}</div>
            <div class="">{!! $introRight !!}</div>
        </div>
        @endif
        {{-- Icon-Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach ($items as $item)
                @php
                    $img = $item['image'] ?? '';
                    $label = $item['label'] ?? '';
                    $desc = $item['desc'] ?? '';
                @endphp
                <div class="flex flex-col items-center justify-start">
                    @if ($img)
                        <img src="{{ esc_url($img) }}" alt="" class="w-full h-80 mb-4 object-cover">
                    @endif
                    @if ($label)
                        <div class="w-full text-left">
                            <h3 class="font-black italic text-2xl">{{ $label }}</h3>
                        </div>
                    @endif
                    @if ($desc)
                        <p class="text-base text-left w-full">{{ $desc }}</p>
                    @endif
                </div>
            @endforeach
            {{-- Optionaler, statischer Kontaktbereich --}}
            @if ($showContact)
                <div class="flex flex-col col-span-[2] items-center h-80 lg:flex-row bg-primary text-secondary">
                    {{-- Linke Seite: fester Text + Icons --}}
                    <div class="p-6 justify-between">
                        <p class="font-black italic text-2xl mb-6 text-left">Christian Thüne freut sich auf Ihre
                            Anfrage.</p>

                        <div class="flex items-center text-base font-medium mb-6">
                            <i class="fa-regular fa-phone-arrow-right text-xl me-2"></i>
                            <a href="tel:+49360650231031">+49 3606 502310-31</a>
                        </div>
                        <div class="flex items-center text-base font-medium mb-6">
                            <i class="fa-regular fa-mobile-screen-button text-xl me-3"></i>
                            <a href="tel:+491621726946">+49 162 1726946</a>
                        </div>
                        <div class="flex justfy-start">
                            <a href="mailto:christian.thuene@eco-timber.de" class="btn btn-secondary">
                                E-Mail an Christian
                            </a>
                        </div>
                    </div>

                    {{-- Rechte Seite: festes Bild --}}
                    <div class="p-6 flex grow items-center">
                        <img src="{{ Vite::asset('resources/images/Mitarbeiterbilder-061.jpg') }}" alt="Christian Thüne"
                            class="w-full h-60 object-cover">
                    </div>
                </div>
            @endif
        </div>

        @if (get_field('aa_show_contact_btns'))
            <div class="mt-24">
                @include('partials.contact-buttons', [
                    'phoneBtnClass' => 'btn-clean text-primary',
                    'phoneIconColor' => 'text-primary',
                    'emailBtnClass' => 'btn btn-primary-outline',
                    'align' => 'justify-center',
                ])
            </div>
        @endif
    </div>
</section>
