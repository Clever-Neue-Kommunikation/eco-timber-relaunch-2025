@php
    $title = get_field('preview_title');
    $category = get_field('preview_category');

    $references = get_posts([
        'post_type' => 'reference',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'tax_query' => [
            [
                'taxonomy' => 'reference_category',
                'field' => 'term_id',
                'terms' => $category,
            ],
        ],
    ]);
@endphp

@if ($title || $references)
    <section class="{{ $block['className'] ?? '' }} align{{ $block['align'] ?? '' }} is-layout-constrained ">
        @if ($title)
            <h2 class="heading-2 text-secondary uppercase text-center pb-12">{{ $title }}</h2>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 px-8 xl:px-4 mb-20">
            @foreach ($references as $ref)
                @php
                    $ref_title = esc_html($ref->post_title);
                    $permalink = get_permalink($ref->ID);
                    $image_id = get_post_thumbnail_id($ref->ID);
                    $image_src = $image_id ? wp_get_attachment_image_url($image_id, 'large') : null;
                @endphp

                <div class="rounded overflow-hidden shadow-sm hover:shadow-2xl transition-shadow">
                    @if ($image_src)
                        <a href="{{ $permalink }}" class="relative">
                            <img src="{{ $image_src }}" alt="{{ $ref_title }}" class="w-full h-120 object-cover" />
                            <div class="pb-4 ps-4 xl:ps-8 pe-4 pt-20 absolute bottom-0 bg-gradient-to-t from-black to-transparent w-full flex">
                                <h3 class="text-xl text-white font-bold italic mb-2 w-full">
                                    {!! $ref_title !!}
                                </h3>
                                <i class="fa-regular fa-circle-arrow-right text-white text-3xl self-end mb-3"></i>
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="flex justify-center pt-10">
            <a href="/referenz-projekte" class="btn btn-secondary">Alle Projekte</a>
        </div>
    </section>
@endif
