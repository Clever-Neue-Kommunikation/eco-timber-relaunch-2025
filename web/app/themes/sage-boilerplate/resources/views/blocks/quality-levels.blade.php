@php
    $title = get_field('ql_title');
    $subtitle = get_field('ql_subtitle');
    $levels = get_field('ql_levels') ?: [];

    // Block-Klassen
    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
@endphp

<section class="{{ $classes }}">
    <div class="px-8 xl:px-4 flex gap-12">
        <div>
            {{-- Überschrift --}}
            @if ($title)
                <h2 class="heading-2 uppercase text-secondary mb-6">{{ $title }}</h2>
            @endif

            {{-- Untertitel --}}
            @if ($subtitle)
                <p class="subtitle">{{ $subtitle }}</p>
            @endif
        </div>
        {{-- Stufen Grid --}}
        <div class="space-y-12">
            @foreach ($levels as $level)
                @php
                    $label = $level['label'] ?? '';
                    $stars = (int) $level['stars'];
                    $features = $level['features'] ?: [];
                @endphp

                <div class="bg-white rounded-lg shadow">
                    {{-- Kopf mit Titel + Sterne --}}
                    <div class="flex justify-between items-center mb-4 bg-secondary p-6 rounded-tl-lg rounded-tr-lg">
                        <h3 class="text-3xl font-bold text-primary">{!! $label !!}</h3>
                        <div class="flex gap-2">
                            @for ($i = 0; $i < $stars; $i++)
                                <i class="fa-regular fa-star text-primary text-5xl"></i>
                            @endfor
                        </div>
                    </div>

                    {{-- Bullet-Points --}}
                    <ul class="space-y-2 list-none p-6">
                        @foreach ($features as $feat)
                            @php $text = $feat['text'] ?? ''; @endphp
                            <li class="flex items-start mb-4 text-base text-gray-medium">
                                <i class="fa-regular fa-check text-primary text-xl mt-1 me-3"></i>
                                <span>{{ $text }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
