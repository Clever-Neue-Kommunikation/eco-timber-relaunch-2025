@php
    $headline = get_field('cig_headline');
    $subline = get_field('cig_subline');
    $desc = get_field('cig_description');
    $images = get_field('cig_images') ?: []; // Jetzt alle Bilder in einem Array
    $showButtons = get_field('cig_show_buttons');
@endphp

<section class="">
    <div class="is-layout-constrained px-8 xl:px-4">
        <div class="grid grid-cols-4 grid-rows-3 gap-8">
            {{-- Textbereich nimmt die ersten beiden Zeilen und die ersten beiden Spalten ein --}}
            <div class="col-span-2 row-span-2 flex flex-col gap-4 justify-between bg-white">
                <div class="pe-16">
                    @if ($headline)
                        <h2 class="heading-2 mb-4">{{ $headline }}</h2>
                    @endif

                    @if ($subline)
                        <div class="subtitle">{!! $subline !!}</div>
                    @endif

                    @if ($desc)
                        <div class="text-gray-medium text-base mb-6">{!! nl2br(e($desc)) !!}</div>
                    @endif
                    @if ($showButtons)
                        <div class="mt-16">
                            @include('partials.contact-buttons', [
                                'phoneBtnClass' => 'text-primary',
                                'phoneIconColor' => 'text-primary',
                                'emailBtnClass' => 'btn-primary-outline',
                                'align' => 'justify-start',
                            ])
                        </div>
                    @endif
                </div>

            </div>
            {{-- Jetzt die Bilder – alle nacheinander in die freien Felder, Reihenfolge wie im Array --}}
            @php
                // Es gibt insgesamt 12 Felder im Grid, eins ist der Textblock (nimmt 4 Felder ein: 2x2)
                // Wir müssen die Felder für die Bilder "überspringen", wo der Textblock sitzt
                $cells = [];
                // Baue ein Array aller Zellen (je Feld: [row, col])
                for ($row = 1; $row <= 3; $row++) {
                    for ($col = 1; $col <= 4; $col++) {
                        // Die ersten beiden Reihen & Spalten sind der Textblock (also col 1-2 und row 1-2)
                        if ($row <= 2 && $col <= 2) {
                            continue;
                        }
                        $cells[] = [$row, $col];
                    }
                }
            @endphp
            @foreach ($cells as $i => [$row, $col])
                <div class="aspect-square bg-offwhite overflow-hidden flex items-center justify-center">
                    @if (!empty($images[$i]['image']))
                        <img src="{{ $images[$i]['image']['sizes']['large'] ?? $images[$i]['image']['url'] }}"
                            alt="{{ $headline }}" class="w-full h-full object-cover" />
                    @endif
                </div>
            @endforeach

        </div>
    </div>
</section>
