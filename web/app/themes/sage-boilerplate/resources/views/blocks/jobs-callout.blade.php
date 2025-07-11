@php
    $classes = array_filter([$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']);
    $classes = implode(' ', $classes);
    // Erster Callout
    $heading = get_field('jobs_heading');
    $subheading = get_field('jobs_subheading');
    $ctaText = get_field('jobs_cta_text');
    $ctaUrl = get_field('jobs_cta_url');
    $imageUrl = get_field('jobs_image');

    // Zweiter Callout
    $teamHeading = get_field('team_heading');
    $teamText = get_field('team_text');
    $contactName = get_field('contact_name');
    $contactPhone = get_field('contact_phone');
    $emailText = get_field('contact_email_text');
    $emailUrl = get_field('contact_email_url');
    $imageUrl2 = get_field('team_image');

    // Videos
    $videos = get_field('videos') ?: [];

    // Footer CTAs
    $primaryText = get_field('footer_cta_primary_text');
    $primaryUrl = get_field('footer_cta_primary_url');
    $secondaryText = get_field('footer_cta_secondary_text');
    $secondaryUrl = get_field('footer_cta_secondary_url');
@endphp
<section class="alignfull">
    <!-- 1. Slanted Callout -->
    <div class="{{ $classes }}">
        <div class="flex relative mx-auto items-center bg-full-secondary-left">
            <div
                class="w-full relative z-1 flex flex-col items-center justify-center lg:w-1/2 xl:ml-[calc((100%-1176px)/2)] ml-8 xl:ps-4 py-30 with-slant with-slant--secondary-right text-primary">
                @if ($heading)
                    <h2 class="heading-2 mb-4">{{ $heading }}</h2>
                @endif
                @if ($subheading)
                    <h3 class="heading-2 font-black italic uppercase text-[#707070] mb-12">{{ $subheading }}</h3>
                @endif
                @if ($ctaText && $ctaUrl)
                    <a href="{{ esc_url($ctaUrl) }}" class="btn btn-white">{{ $ctaText }}</a>
                @endif
            </div>
            @if ($imageUrl)
                <div class="w-full shrink-0 lg:w-1/2 -my-16 bg-white">
                    <img src="{{ $imageUrl }}" alt="" class="w-full h-[500px] object-cover">
                </div>
            @endif
        </div>
    </div>

    <!-- 2. Team Intro -->
    <div class="is-layout-constrained mx-auto px-8 xl:px-4 pt-16">
        <div class="flex gap-12 items-end">
            <div class="px-4 w-[50%] flex items-end">
                <img src="{{ $imageUrl2 }}" alt="" class="pr-5 object-cover">
                <p class="font-black text-2xl italic mb-8">„Hi, ich bin {{ $contactName }} und bei ECO-TIMBER die
                    Ansprechpartnerin für deinen Einstieg bei uns.“</p>
            </div>

            <div class="px-4 w-[50%]">
                @if ($teamHeading)
                    <h3 class="text-2xl text-primary font-black italic uppercase mb-4">{{ $teamHeading }}</h3>
                @endif
                @if ($teamText)
                    <div class="text-base text-gray-medium mb-10">{!! $teamText !!}</div>
                @endif
                @if ($contactName || $contactPhone)
                    @if ($contactPhone)
                        <div class="flex items-center gap-10 mb-16">
                            <a href="tel:{{ esc_attr($contactPhone) }}" class="btn btn-clean"><i
                                    class="fa-regular fa-phone-arrow-right text-2xl"></i>{{ $contactPhone }}
                            </a>
                    @endif
                    @if ($emailText && $emailUrl)
                        <a href="{{ esc_url($emailUrl) }}" class="btn btn-secondary">{{ $emailText }}</a>
                    @endif
            </div>


            @endif

        </div>
    </div>
    </div>

    <!-- 3. Video Grid -->
    @if ($videos)
        <div class="is-layout-constrained bg-secondary  py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 px-8 xl:px-4 gap-8">
                @foreach ($videos as $video)
                    @php
                        // Extrahiere die YouTube-ID aus der URL
                        preg_match(
                            '~(?:youtu\.be/|youtube(?:-nocookie)?\.com/(?:watch\?v=|embed/|v/))([^&?/]+)~',
                            $video['video_url'],
                            $m,
                        );
                        $youtubeId = $m[1] ?? '';
                        $thumb = esc_url($video['thumb']);
                        $title = esc_attr($video['video_title']);
                        $desc = $video['video_text'];
                    @endphp

                    <div class="group">
                        {{-- Lazy-Load Container --}}
                        <div class="yt-lazy relative block overflow-hidden h-64 cursor-pointer bg-black/10"
                            data-id="{{ $youtubeId }}">
                            <img src="{{ $thumb }}" alt="{{ $title }}"
                                class="w-full h-full object-cover" />
                            <span
                                class="absolute inset-0 flex items-center justify-center text-white text-6xl opacity-50 group-hover:opacity-100 transition-opacity">
                                <i class="fa-regular fa-circle-play"></i>
                            </span>
                        </div>

                        <h4 class="mt-6 mb-4 text-2xl font-black italic text-primary">
                            {{ $video['video_title'] }}
                        </h4>
                        @if ($desc)
                            <p class="text-white text-base">{{ $desc }}</p>
                        @endif
                    </div>
                @endforeach

            </div>
            <div class="flex gap-10 justify-center pt-15">
                @if ($primaryText && $primaryUrl)
                    <a href="{{ esc_url($primaryUrl) }}" class="btn btn-primary">{{ $primaryText }}</a>
                @endif
                @if ($secondaryText && $secondaryUrl)
                    <a href="{{ esc_url($secondaryUrl) }}" class="btn btn-white">{{ $secondaryText }}</a>
                @endif
            </div>
        </div>
    @endif

    <!-- 4. Footer CTAs -->

</section>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.yt-lazy').forEach(function(el) {
      el.addEventListener('click', function() {
        var id = this.dataset.id;
        if (!id) return;
        var src = 'https://www.youtube-nocookie.com/embed/' + id + '?autoplay=1';
        var iframe = document.createElement('iframe');
        iframe.src = src;
        iframe.allow = 'autoplay; encrypted-media; fullscreen';
        iframe.allowFullscreen = true;
        iframe.classList.add('w-full','h-full','object-cover');
        this.innerHTML = '';
        this.appendChild(iframe);
      });
    });
  });
</script>
