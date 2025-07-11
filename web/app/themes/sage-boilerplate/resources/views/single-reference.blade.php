@extends('layouts.app')

@section('content')
    @php(the_post())

    <article class="alignfull" @php(post_class())>
        @if (has_post_thumbnail())
            <div class=" bg-secondary">
                <div class="flex flex-col lg:flex-row overflow-hidden">
                    {{-- Inhalt --}}
                    <div
                        class="flex basis-[45%] items-end justify-center lg:justify-start relative shrink grow-0 z-1 with-slant with-slant--secondary-right xl:ml-[calc((100%-1176px)/2)] order-2 lg:order-1">
                        <div class="py-15 lg:py-0 px-2 lg:px-0 xl:!ps-4 lg:ps-8   text-center lg:text-left">
                            @if ($subtitle = get_field('project_subtitle'))
                                <p class="text-primary !text-2xl xl:!text-3xl font-bold italic pb-8 lg:whitespace-nowrap">
                                    {{ $subtitle }}</p>
                            @endif
                            @if (get_the_title())
                                <h1 class="heading-2 text-primary lg:mb-10">{!! get_the_title() !!}</h1>
                            @endif
                        </div>
                    </div>

                    {{-- Bild --}}
                    <div class="basis-[55%] shrink-0 grow order-1 lg:order-2">
                        <img src="{{ get_the_post_thumbnail_url() }}" alt=""
                            class="w-full h-[450px] lg:h-[450px] object-cover" />
                    </div>
                </div>
            </div>
        @endif
        <div class="is-layout-constrained mt-8 mb-20 text-xs text-gray-dark font-medium">
            @if (function_exists('yoast_breadcrumb'))
                {!! yoast_breadcrumb('<nav class="breadcrumb">', '</nav>') !!}
            @endif
        </div>

        <div class="is-layout-constrained mb-30">
            <div class="xl:ps-4 ps-8 pe-4 ">
                @if ($headline = get_field('project_name'))
                    <h2 class="heading-2 text-secondary">{{ $headline }}</h2>
                @endif
                @if ($text = get_field('project_description'))
                    <div class=" text-gray-medium text-base mt-11">
                        {!! $text !!}
                    </div>
                @endif
            </div>
        </div>

        <div class="!mt-2 mx-2 lg:mx-0">
            <div class="flex flex-col lg:flex-row overflow-hidden">
                {{-- Bild --}}
                <div class="basis-[50%] shrink-0 grow my-15">
                    <img src="{{ get_the_post_thumbnail_url() }}" alt=""
                        class="w-full h-[500px] lg:h-[700px] object-cover" />
                </div>

                {{-- Inhalt --}}
                <div
                    class="flex basis-[50%] items-center relative shrink grow-0 z-1 with-slant with-slant--secondary-left bg-secondary pe-4">
                    <div class="px-15 py-15 lg:py-0 flex flex-col justify-between w-full ">
                        <div class="flex mb-10">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Projektname:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($projectname = get_field('project_name'))
                                    <p class="text-base text-white font-bold">{{ $projectname }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex mb-10">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Projektort:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($project_location = get_field('project_location'))
                                    <p class="text-white text-base">
                                        {{ $project_location }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex mb-10">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Ausführungszeitraum:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($project_year = get_field('project_year'))
                                    <p class="text-white text-base">
                                        {{ $project_year }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex mb-10">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Bauweise:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($construction_type = get_field('construction_type'))
                                    <p class="text-white text-base">
                                        {{ $construction_type }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex mb-10">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Verarbeitete Holzarten:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($wood_types = get_field('wood_types'))
                                    <p class="text-white text-base">
                                        {{ $wood_types }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-5">
                            <p class="w-full text-base font-extrabold text-gray-light">Eco-Timber-Leistungen</p>

                            @if (have_rows('eco_timber_services'))
                                @foreach (get_field('eco_timber_services') as $row)
                                    <div class="basis-[50%] mb-5">
                                        <p class="text-gray-light text-base">
                                            {{ $row['service_type'] }}:
                                        </p>
                                    </div>
                                    <div class="basis-[50%]">
                                        <p class="text-white text-base">
                                            {{ $row['service_desc'] }}
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </div>



                        <div class="flex">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Ausführende Firma:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($contractor = get_field('contractor'))
                                    <p class="text-white text-base">
                                        {{ $contractor }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Holzbauplanung:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($planning_office = get_field('planning_office'))
                                    <p class="text-white text-base">
                                        {{ $planning_office }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex">
                            <div class="basis-[50%]">
                                <p class="text-base text-gray-light">Architekturbüro:</p>
                            </div>
                            <div class="basis-[50%]">
                                @if ($architecture = get_field('architecture'))
                                    <p class="text-white text-base">
                                        {{ $architecture }}
                                    </p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Galerie als Grid mit images aus field_gallery und lightbox --}}
        @if ($gallery = get_field('field_gallery'))
            <div class="is-layout-constrained mt-40">
                {{-- Erstes Bild: Full-width --}}
                @if (isset($gallery[0]))
                    <div class="mb-6 xl:ps-4 ps-8 pe-4">
                        <a href="{{ $gallery[0]['url'] }}" data-lightbox="gallery">
                            <img src="{{ $gallery[0]['url'] }}" alt="{{ $gallery[0]['alt'] }}"
                                class="w-full h-150 object-cover" />
                        </a>
                    </div>
                @endif

                {{-- Restliche Bilder: 4 Spalten --}}
                @if (count($gallery) > 1)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach (array_slice($gallery, 1) as $image)
                            <div class="overflow-hidden xl:ps-4 ps-8 pe-4">
                                <a href="{{ $image['url'] }}" data-lightbox="gallery">
                                    <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}"
                                        class="w-[270px] h-[240px] object-cover" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        <div class="mt-40">
            <div class="prose max-w-none">
                {!! apply_filters('the_content', get_the_content()) !!}
            </div>
        </div>

        {{-- IDs & Terms laden --}}
        @php($current_id = get_queried_object_id())
        @php($cats = wp_get_post_terms($current_id, 'reference_category', ['fields' => 'ids']))

        {{-- Related Posts holen, wenn Kategorien vorhanden sind --}}
        @php(
    $related_references =
        !empty($cats) && is_array($cats)
            ? get_posts([
                'post_type' => 'reference',
                'posts_per_page' => 3,
                'post__not_in' => [$current_id],
                'tax_query' => [
                    [
                        'taxonomy' => 'reference_category',
                        'field' => 'term_id',
                        'terms' => $cats,
                    ],
                ],
            ])
            : []
)

        {{-- Ausgabe --}}
        @if (!empty($related_references))
            <section class="is-layout-constrained mt-20 px-8 xl:px-4">
                <h2 class="heading-2 text-secondary text-center uppercase pb-12">
                    Weitere Projekte
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-11">
                    @foreach ($related_references as $ref)
                        {{-- Bild, nur wenn vorhanden --}}
                        <div class="mix rounded shadow-sm overflow-hidden hover:shadow-2xl transition-shadow">
                            @if ($image_src = get_the_post_thumbnail_url($ref->ID, 'large'))
                                <a href="{{ get_permalink($ref->ID) }}" class="relative">
                                    <img src="{{ $image_src }}" alt="{{ esc_attr(get_the_title($ref->ID)) }}"
                                        class="w-full h-120 object-cover">
                            @endif

                            {{-- Titel --}}
                            <div
                                class="pb-4 ps-4 xl:ps-8 pe-4 pt-20 absolute bottom-0 bg-gradient-to-t from-black to-transparent w-full flex">
                                <h3 class="text-xl text-white font-bold italic mb-2 w-full">
                                    {{ get_the_title($ref->ID) }}
                                </h3>
                                <i class="fa-regular fa-circle-arrow-right text-white text-3xl self-end mb-3"></i>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center pt-10">
                    <a href="/referenz-projekte" class="btn btn-secondary">
                        Alle Projekte
                    </a>
                </div>
            </section>
        @endif

    </article>
@endsection
