@php
    $sectionTitle = get_field('cert_section_title');
    $sectionSubTitle = get_field('cert_section_subtitle');
    $introText = get_field('cert_intro_text');
    $items = get_field('cert_items') ?: [];
    $classes = trim(implode(' ', [$block['className'] ?? '', isset($block['align']) ? 'align' . $block['align'] : '']));
    $videos = get_field('videos') ?: [];
@endphp

<section class="{{ $classes }} py-16">
    <div class="px-4">

        @if ($sectionTitle)
            <h2 class="heading-2 text-secondary text-center uppercase mb-4">{{ $sectionTitle }}</h2>
        @endif

        @if ($sectionSubTitle)
            <p class="subtitle text-center">
                {!! $sectionSubTitle !!}
            </p>
        @endif

        @if (count($items))
            <div class="pt-9">
                @foreach ($items as $item)
                    <div class="flex items-start gap-20 pb-24">
                        @if (!empty($item['image']))
                            <img src="{{ esc_url($item['image']) }}" alt="{{ esc_attr($item['title'] ?: 'Siegel') }}"
                                class=" h-auto flex-shrink-0 mt-10" />
                        @endif
                        <div class="ml-6 flex-1">
                            @if (!empty($item['title']))
                                <h3 class="text-2xl font-black italic text-primary mb-2">
                                    {{ $item['title'] }}
                                </h3>
                            @endif

                            @if (!empty($item['description']))
                                <div class="mb-4 text-base text-gray-medium">
                                    {!! $item['description'] !!}
                                </div>
                            @endif

                            {{-- NEU: Video-Embed aus oEmbed-Feld --}}
                            
                                @foreach ($item['videos'] as $video)
                                    @php
                                        // Extrahiere die YouTube-ID aus der URL
                                        preg_match(
                                            '~(?:youtu\.be/|youtube(?:-nocookie)?\.com/(?:watch\?v=|embed/|v/))([^&?/]+)~',
                                            $video['video_url'],
                                            $m,
                                        );
                                        $youtubeId = $m[1] ?? '';
                                        $thumb = esc_url($video['thumb']);
                                    @endphp

                                    <div class="group">
                                        {{-- Lazy-Load Container --}}
                                        <div class="yt-lazy relative block overflow-hidden h-64 cursor-pointer bg-black/10"
                                            data-id="{{ $youtubeId }}">
                                            <img src="{{ $thumb }}" alt=""
                                                class="w-full h-full object-cover" />
                                            <span
                                                class="absolute inset-0 flex items-center justify-center text-white text-6xl opacity-50 group-hover:opacity-100 transition-opacity">
                                                <i class="fa-regular fa-circle-play"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
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
