@props([
    'name'       => null,
    'inactive'   => 'text-gray-dark hover:text-secondary',
    'active'     => 'text-secondary',
    'ul'         => 'flex flex-col items-center font-medium p-4 xl:p-0 mt-4 xl:space-x-8 xl:flex-row xl:mt-0 xl:border-0',
    'a'          => 'text-base font-normal block px-3 rounded xl:bg-transparent xl:p-0',
    'button'     => 'text-base font-normal flex items-center justify-between text-gray-dark hover:text-secondary w-full xl:py-2 px-3 rounded xl:p-0 xl:w-auto',
    'ulChild'    => 'py-2 text-sm text-gray-700 dark:text-gray-400',
    'aChild'     => 'text-sm block px-4 text-secondary py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white',
])

@php($menu = Navi::build($name))

<header class="banner fixed top-0 left-0 w-full z-100">
  <div class="bg-secondary is-layout-constrained py-2 hidden xl:block">
    <div class="flex justify-end gap-11 pe-4 text-gray-light">
      <div><i class="fa-regular fa-phone-arrow-right text-primary"></i> <a href="tel:036065023100">+49 (0) 3606 502310-0</a></div>
      <div><i class="fa-regular fa-envelope text-primary"></i> <a href="mailto:info@eco-timber.de">info@eco-timber.de</a></div>
      <div><i class="fa-regular fa-arrow-down-to-bracket text-primary"></i> <a href="/downloads">Downloads</a></div>
    </div>
  </div>
  <nav id="main-nav" class="is-layout-constrained transition-all duration-300 sticky top-0 mt-8">
    <div id="nav-div"
         class="bg-white flex flex-wrap items-center justify-between mx-auto pt-4 pb-4 px-8 xl:px-4 shadow-sm rounded-sm">
      <a href="/" class="flex items-center space-x-3">
        <img id="nav-logo" src="{{ Vite::asset('resources/images/logo-eco-timber.png') }}"
             class="h-10 transition-all duration-300" alt="TMC Logo">
      </a>
      <button data-collapse-toggle="navbar-dropdown" type="button"
              class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-secondary rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-light"
              aria-controls="navbar-dropdown" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
      <div class="hidden w-full xl:block xl:w-auto" id="navbar-dropdown">
        @if ($menu->isNotEmpty())
          <ul @class([$ul]) {{ $attributes }}>
            @php($isHome = is_front_page())
            <li class="{{ $isHome ? $active : $inactive }}">
              <a href="/"><i class="fa-regular fa-house-blank text-xl w-7 h-7"></i></a>
            </li>
            @foreach ($menu->all() as $item)
              @php($dropdownId = 'dropdownNavbar-' . $loop->index)
              <li @class([
                    $item->classes,
                    $inactive => !$item->active,
                    $active   =>  $item->active,
                  ])>
                @if ($item->children)
                  <button id="{{ $dropdownId }}-link"
                          data-dropdown-toggle="{{ $dropdownId }}"
                          @class([$button])>
                    {{ $item->label }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4"/>
                    </svg>
                  </button>
                @else
                  <a @class([$a]) href="{{ $item->url }}">{{ $item->label }}</a>
                @endif

                @if ($item->children)
                  <div id="{{ $dropdownId }}"
                       class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                       aria-labelledby="{{ $dropdownId }}-link">
                    <ul @class([$ulChild]) aria-labelledby="{{ $dropdownId }}-link">
                      @foreach ($item->children as $child)
                        @php($childDropdownId = $dropdownId . '-child-' . $loop->index)
                        <li @class([
                              $inactive => ! $child->active,
                              $active   =>   $child->active,
                              'relative'
                            ])>
                          @if ($child->children)
                            {{-- 2nd Level mit 3rd-Level --}}
                            <button id="{{ $childDropdownId }}-link"
                                    data-dropdown-toggle="{{ $childDropdownId }}"
                                    data-dropdown-placement="right-start"
                                    @class([$aChild, 'flex justify-between items-center w-full'])>
                              {{ $child->label }}
                              <svg class="w-3 h-3 ms-2" aria-hidden="true" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 1l4 4-4 4"/>
                              </svg>
                            </button>

                            <div id="{{ $childDropdownId }}"
                                 class="z-20 hidden absolute top-0 left-full mt-0 ml-1 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                                 aria-labelledby="{{ $childDropdownId }}-link">
                              <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                                @foreach ($child->children as $grand)
                                  <li @class([$inactive => ! $grand->active, $active => $grand->active])>
                                    <a @class([$aChild]) href="{{ $grand->url }}">{{ $grand->label }}</a>
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          @else
                            {{-- reines 2nd-Level-Item --}}
                            <a @class([$aChild]) href="{{ $child->url }}">{{ $child->label }}</a>
                          @endif
                        </li>
                      @endforeach
                    </ul>
                  </div>
                @endif
              </li>
            @endforeach
          </ul>
        @endif
      </div>
    </div>
  </nav>
</header>
