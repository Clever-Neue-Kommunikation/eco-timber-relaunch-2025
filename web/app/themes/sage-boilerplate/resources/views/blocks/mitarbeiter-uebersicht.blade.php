@php
    $mitarbeiter = get_posts([
        'post_type' => 'mitarbeiter',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ]);

    $chef = null;
    $team = [];

    foreach ($mitarbeiter as $m) {
        if (get_field('is_chef', $m->ID)) {
            $chef = $m;
        } else {
            $team[] = $m;
        }
    }
@endphp


<section class="{{ $block['className'] ?? '' }} align{{ $block['align'] ?? '' }} is-layout-constrained ">
    @if ($chef)
        @php
            $number = get_field('telefonnummer', $chef->ID);
            $number_clean = preg_replace('/[^+0-9]/', '', $number);
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-3 gap-x-12 gap-y-16 px-8 xl:px-4 pb-8">
            <div>
                <div class="bg-secondary p-4">
                    <p class="text-primary uppercase text-2xl font-black italic">{{ get_field('position', $chef->ID) }}
                    </p>
                </div>
                <img src="{{ get_the_post_thumbnail_url($chef->ID, 'medium') }}"
                    class="w-full h-80 object-cover mx-auto mb-2">
                <h3 class="text-2xl font-black italic py-4">{{ $chef->post_title }}</h3>
                <p class="text-base pb-2">
                    <i class="fa-regular fa-phone-arrow-right text-primary text-lg pe-2"></i>
                    <a href="tel:{{ $number_clean }}" class="text-gray-medium">
                        {{ $number }}
                    </a>
                </p>
                <p class="text-base">
                    <i class="fa-regular fa-paper-plane text-primary text-lg pe-2"></i>
                    <a href="mailto:{{ get_field('email', $chef->ID) }}" class="text-gray-medium">
                        {{ get_field('email', $chef->ID) }}
                    </a>
                </p>
            </div>

            <div>

            </div>
        </div>
    @endif

    @if (count($team))
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-12 gap-y-16 px-8 xl:px-4">
            @foreach ($team as $m)
                @php
                    $number = get_field('telefonnummer', $m->ID);
                    $number_clean = preg_replace('/[^+0-9]/', '', $number);
                @endphp
                <div class="">
                    <div class="bg-secondary p-4">
                        <p class="text-primary uppercase text-2xl font-black italic">
                            {{ get_field('position', $m->ID) }}</p>
                    </div>
                    <img src="{{ get_the_post_thumbnail_url($m->ID, 'full') }}"
                        class="w-full h-80 object-cover mx-auto mb-2">
                    <h3 class="text-2xl font-black italic py-4">{{ $m->post_title }}</h3>

                    <p class="text-base pb-2">
                        <i class="fa-regular fa-phone-arrow-right text-primary text-lg pe-2"></i>
                        <a href="tel:{{ $number_clean }}" class="text-gray-medium">
                            {{ $number }}
                        </a>
                    </p>
                    <p class="text-base">
                        <i class="fa-regular fa-paper-plane text-primary text-lg pe-2"></i>
                        <a href="mailto:{{ get_field('email', $m->ID) }}" class="text-gray-medium">
                            {{ get_field('email', $m->ID) }}
                        </a>
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p class="py-8 text-center text-gray-medium">Keine weiteren Mitarbeiter gefunden.</p>
    @endif
</section>
