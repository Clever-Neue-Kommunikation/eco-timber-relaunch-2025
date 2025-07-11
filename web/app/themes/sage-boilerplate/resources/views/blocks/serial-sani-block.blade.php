@php
    $title = get_field('serial_title');
    $subtitle = get_field('serial_subtitle');
    $features = get_field('serial_features') ?: [];
    $image1 = get_field('serial_image1');
    $buildingsTitle = get_field('serial_buildings_title');
    $buildings = get_field('serial_buildings') ?: [];
    $image2 = get_field('serial_image2');
@endphp

<div class="{{ $block['className'] ?? '' }} align is-layout-constrained px-8 xl:px-4">
    {{-- Titel & Untertitel --}}
    @if ($title)
        <div class="mb-6">
            <h2 class="heading-2 text-secondary uppercase">{{ $title }}</h2>
        </div>
    @endif
    @if ($subtitle)
        <div class="mb-12">
            <p class="subtitle">{{ $subtitle }}</p>
        </div>
    @endif

    {{-- Erste Sektion: Vorteile + Bild --}}
    <div class="flex flex-col lg:flex-row items-center gap-12 mb-16">
        <div class="lg:w-1/2">
            <ul class="space-y-4">
                @foreach ($features as $feat)
                    <li class="flex items-center">
                        <i class="{{ $feat['icon'] }} w-4 h-4 text-primary bg-secondary rounded-full p-2 mr-3 "></i>
                        <span class="text-secondary text-lg font-bold">{{ $feat['text'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @if ($image1)
            <div class="lg:w-1/2">
                <img src="{{ esc_url($image1['url']) }}" alt="{{ esc_attr($image1['alt'] ?? '') }}"
                    class="w-full h-auto object-cover" />
            </div>
        @endif
    </div>

    {{-- Zweite Sektion: Bild + Gebäude-Liste --}}
    <div class="flex flex-col-reverse lg:flex-row items-center gap-12 !mt-15">
        @if ($image2)
            <div class="lg:w-1/3">
                <img src="{{ esc_url($image2['url']) }}" alt="{{ esc_attr($image2['alt'] ?? '') }}"
                    class="w-full h-auto object-cover" />
            </div>
        @endif
        <div class="lg:w-2/3">
            @if ($buildingsTitle)
                <h3 class="text-primary text-2xl font-black italic uppercase mb-8">{{ $buildingsTitle }}</h3>
            @endif
            <ul class="columns-2">
                @foreach ($buildings as $b)
                    <li class="flex items-start mb-4">
                        <span class="!w-3 !h-3 shrink-0 bg-primary rounded-full mt-2 mr-3"></span>
                        <p class="text-secondary text-lg font-medium">{{ $b['text'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@php
    $quote = get_field('serial_quote');
    $attribution = get_field('serial_attribution');
    $email = get_field('serial_email');
    $phone = get_field('serial_phone');
@endphp

@if ($quote || $attribution || $email || $phone)
    <div class="alignfull bg-secondary text-white pt-20 pb-34">
        <div class="is-layout-constrained px-8 xl:px-4 text-center">
            @if ($quote)
                <blockquote class="font-black italic text-2xl text-primary mb-6">
                    {{ $quote }}
                </blockquote>
            @endif

            @if ($attribution)
                <p class="mb-8 font-medium text-base">{{ $attribution }}</p>
            @endif
            <div class="!mt-10">
                @include('partials.contact-buttons', [
                    'phoneBtnClass' => 'text-white',
                    'phoneIconColor' => 'text-primary',
                    'emailBtnClass' => 'btn-primary-outline',
                    'align' => 'justify-center',
                ])
            </div>
        </div>
    </div>
@endif
