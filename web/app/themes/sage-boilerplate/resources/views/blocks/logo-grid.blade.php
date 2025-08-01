@php
    $logos = get_field('logo_grid_list');
    $showButtons = get_field('show_buttons') !== false;
@endphp

@if ($logos)
    <section class="{{ $block['className'] ?? '' }} align{{ $block['align'] ?? '' }} is-layout-constrained">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-8 xl:px-4">
            @foreach ($logos as $item)
                <div
                    class="bg-white h-70 rounded shadow-md flex flex-col items-center justify-between py-7 px-3 relative border-t-secondary border-t-6">
                    @if (!empty($item['logo']))
                        <img src="{{ $item['logo']['sizes']['medium'] ?? $item['logo']['url'] }}"
                            alt="{{ $item['name'] }}" class="max-h-24 object-contain mt-4" loading="lazy">
                    @endif
                    <div class="text-center text-gray-medium text-sm">
                        {{ $item['name'] }}
                    </div>
                </div>
            @endforeach
        </div>
        @if ($showButtons)
            <div class="pt-20">
                @include('partials.contact-buttons', [
                    'phoneBtnClass' => 'text-gray-medium',
                    'phoneIconColor' => 'text-primary',
                    'emailBtnClass' => 'btn-primary-outline',
                    'align' => 'justify-center',
                ])
            </div>
        @endif
    </section>
@endif
