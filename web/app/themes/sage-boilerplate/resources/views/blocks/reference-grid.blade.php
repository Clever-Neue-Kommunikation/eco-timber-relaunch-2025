@php
    $limit = get_field('reference_limit') ?: -1;
    $show_filter = get_field('reference_show_filter');
    $title = get_field('reference_title');
    $subtitle = get_field('reference_subtitle');
    $intro = get_field('reference_intro_text');
    $text_align = get_field('reference_text_align') ?: 'text-left';
    $showButtons = get_field('reference_show_buttons');

    $references = get_posts([
        'post_type' => 'reference',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
    ]);

    $terms_by_id = [];
    foreach (wp_get_object_terms(wp_list_pluck($references, 'ID'), 'reference_category') as $term) {
        $terms_by_id[$term->term_id] = $term;
    }
@endphp

@if ($title || $subtitle || $intro)
    <div class="align is-layout-constrained px-8 xl:px-4 {{ $text_align }} !mb-16">
        @if ($title)
            <h2 class="heading-2 text-secondary uppercase mb-2">{{ $title }}</h2>
        @endif

        @if ($subtitle)
            <p class="subtitle mb-4">{{ $subtitle }}</p>
        @endif

        @if ($intro)
            <div class="text-gray-medium text-base font-medium">
                {!! $intro !!}
            </div>
        @endif
    </div>
@endif
<section class="{{ $block['className'] ?? '' }} align{{ $block['align'] ?? '' }} is-layout-constrained references !mt-0">
    <div class="px-8 xl:px-4 flex flex-col">
        {{-- Filter-Buttons --}}
        @if ($show_filter)
            <p class="text-xs text-gray-medium mb-3">Filter</p>
            <div class="mb-12 inline-flex flex-col xl:flex-row rounded shadow text-base text-gray-medium filters"
                role="group">
                <button data-filter="all" type="button"
                    class="px-4 py-2 xl:border-r border-b xl:border-b-0 border-[#7070701c] rounded-s cursor-pointer">Alle</button>
                @foreach (array_values($terms_by_id) as $term)
                    <button data-filter=".cat-{{ $term->slug }}" type="button"
                        class="px-4 py-2 xl:[&:not(:last-child)]:border-r [&:not(:last-child)]:border-b xl:!border-b-0 border-[#7070701c] last:rounded-e cursor-pointer">
                        {{ $term->name }}
                    </button>
                @endforeach
            </div>
        @endif
        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-11" data-mixitup-container>
            @foreach ($references as $ref)
                @php
                    $title = esc_html($ref->post_title);
                    $permalink = esc_url(get_permalink($ref->ID));
                    $image_id = get_post_thumbnail_id($ref->ID);
                    $image_src = $image_id ? wp_get_attachment_image_url($image_id, 'full') : null;
                    $ref_terms = wp_get_object_terms($ref->ID, 'reference_category');
                    $term_classes = collect($ref_terms)->map(fn($t) => 'cat-' . $t->slug)->implode(' ');
                @endphp

                <div
                    class="mix {{ $term_classes }} rounded shadow-sm overflow-hidden hover:shadow-2xl transition-shadow">
                    @if ($image_src)
                        <a href="{{ $permalink }}" class="relative">
                            <img src="{{ $image_src }}" alt="{{ $title }}"
                                class="w-full h-120 object-cover " />
                            <div
                                class="pb-4 ps-4 xl:ps-8 pe-4 pt-20 absolute bottom-0 bg-gradient-to-t from-black to-transparent w-full flex">
                                <h3 class="text-xl text-white font-bold italic mb-2 w-full">
                                    {!! $title !!}
                                </h3>
                                <i class="fa-regular fa-circle-arrow-right text-white text-3xl self-end mb-3"></i>
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach
            @if (get_field('show_reference_summary'))
                <div
                    class="relative mix rounded shadow-sm overflow-hidden hover:shadow-2xl transition-shadow bg-secondary">
                    <img src="{{ Vite::asset('resources/images/project-card.png') }}" alt="Alle Projekte ansehen"
                        class="w-full h-120 object-contain " />
                    <div class="pb-4 ps-4 xl:ps-8 pe-8 pt-10 absolute top-0 w-full flex">
                        <h3 class="text-xl text-white font-bold italic w-full">
                            Übersicht all unserer Referenz-Projekte
                        </h3>
                    </div>
                    <div class="flex justify-center w-full absolute bottom-9">
                        <a href="/referenz-projekte" class="btn btn-primary">Alle Projekte</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if ($showButtons)
        <div class="pt-20">
            @include('partials.contact-buttons', [
                'phoneBtnClass' => 'text-secondary',
                'phoneIconColor' => 'text-secondary',
                'emailBtnClass' => 'btn btn-secondary',
                'align' => 'justify-center',
            ])
        </div>
    @endif
</section>
