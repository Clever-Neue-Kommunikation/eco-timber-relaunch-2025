@php
    $rows = get_field('rows') ?: [];
    $source = get_field('source');
@endphp

@if ($rows)
    <section
        class="{{ $block['className'] ?? '' }} align{{ $block['align'] ?? '' }} is-layout-constrained px-8 xl:px-4 my-12 overflow-auto">
        <table class="w-full border-collapse table-fixed">
            <thead>
                <tr>
                    <th class="bg-secondary text-lg font-bold text-white border-3 border-s-0 p-4 rounded-tl-2xl" rowspan="1"></th>
                    <th class="bg-secondary text-lg font-bold text-white border-3 p-4" rowspan="1">Standard</th>
                    <th class="bg-secondary text-lg font-bold text-white border-3 p-4" colspan="2">Klassen (nicht untereinander
                        kumulierbar)</th>
                    <th class="bg-secondary text-lg font-bold text-white border-3 border-e-0 p-4 rounded-tr-2xl" colspan="2">Klassen (zusammen max. 20 %
                        kumulierbar)</th>

                </tr>
                <tr class="text-left">
                    <th class="bg-primary text-secondary text-lg font-medium border-3 border-white border-s-0 p-2" rowspan="1"></th>
                    <th class="bg-primary text-secondary text-lg font-medium border-3 border-white p-4" rowspan="2">Tilgungszuschuss</th>
                    <th class="bg-primary text-secondary text-lg font-medium border-3 border-white p-4">EE</th>
                    <th class="bg-primary text-secondary text-lg font-medium border-3 border-white p-4">NH</th>
                    <th class="bg-primary text-secondary text-lg font-medium border-3 border-white p-4">WPB</th>
                    <th class="bg-secondary text-white text-lg font-medium border-3 border-e-0 border-white p-4" rowspan="2">SerSan (nur Wohngebäude)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr class="@if ($loop->even)  @endif">
                        <td class="border-3 border-s-0 border-white bg-[#D8E7BD] font-bold text-lg p-4">{{ $row['label'] }}</td>
                        <td class="border-3 border-white bg-[#D8E7BD] font-medium text-lg p-4">{{ $row['standard'] }}</td>
                        <td class="border-3 border-white bg-[#D8E7BD] font-medium text-lg p-4">{{ $row['ee'] }}</td>
                        <td class="border-3 border-white bg-[#D8E7BD] font-medium text-lg p-4">{{ $row['nh'] }}</td>
                        <td class="border-3 border-white bg-[#D8E7BD] font-medium text-lg p-4">{{ $row['wpb'] }}</td>
                        <td class="border-3 border-e-0 border-white bg-secondary text-white font-medium text-lg p-4">{{ $row['sersan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            @if ($source)
                <tfoot>
                    <tr>
                        <td colspan="6" class="pt-3 text-xs text-gray-500">
                            {{ $source }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </section>
@endif
