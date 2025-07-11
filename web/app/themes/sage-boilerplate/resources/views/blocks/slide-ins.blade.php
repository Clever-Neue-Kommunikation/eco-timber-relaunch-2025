@php
    $title = get_field('slide_ins_title');
    $title2 = get_field('slide_ins_title2');
    $subtitle = get_field('slide_ins_subtitle');
    $text = get_field('slide_ins_text');
    $btnText = get_field('slide_ins_button_text');
    $btnUrl = get_field('slide_ins_button_url');
    // holt nun die ausgewählte Tailwind-Klasse
    $bgClass = get_field('slide_ins_bg_class') ?: 'slide-in-primary-left';
    $marginTop = get_field('slide_ins_margin_top') ?: '!-mt-0';

    $btnMap = [
        'slide-in-primary-left' => 'btn-secondary',
        'slide-in-secondary-left' => 'btn-primary-outline',
    ];
    // setze Default auf btn-primary wenn nichts gemappt ist
    $buttonClass = 'btn ' . ($btnMap[$bgClass] ?? 'btn-primary-outline');
@endphp

<section
    class="alignfull is-layout-constrained relative overflow-hidden slide-ins-block {{ $marginTop }} {{ $bgClass }}"
    data-slide-ins-block>
    <div class="flex items-center relative z-10 px-8 xl:px-4 py-16">
        <div class="basis-2/3 pr-8">
            {{-- $title --}}
            @if ($title)
                <h2 class="heading-2 text-secondary uppercase mb-4">{{ $title }}</h2>
            @endif

            @if ($subtitle)
                <p class="text-white text-base uppercase font-medium mb-10">{{ $subtitle }}</p>
            @endif

            @if($title2)
                <p class="text-primary text-2xl font-black italic mb-10">{{ $title2 }}</p>
            @endif

            @if ($text)
                <div class="prose prose-invert mb-8 text-white text-base">
                    {!! $text !!}
                </div>
            @endif
        </div>
        @if ($btnText && $btnUrl)
            <div class="whitespace-nowrap">
                <a href="{{ esc_url($btnUrl) }}" class="btn {{ $buttonClass }}">
                    {{ $btnText }}
                </a>
            </div>
        @endif

    </div>
</section>

<style>
    .slide-ins-block {
        transform: translateX(-500px);
        opacity: 0;
        transition: transform 1s ease-out, opacity 1s ease-out;
    }

    .slide-ins-block.in-view {
        transform: translateX(0);
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const els = document.querySelectorAll('[data-slide-ins-block]');
        if (!els.length) return;

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        // Beobachte jedes Slide-In-Element
        els.forEach(el => observer.observe(el));
    });
</script>
