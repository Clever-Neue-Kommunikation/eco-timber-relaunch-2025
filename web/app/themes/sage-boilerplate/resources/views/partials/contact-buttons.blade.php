@php
  $phone = get_field('phone', 'option') ?: '+49 (0) 3606 502310-0';
  $phoneLink = get_field('phone_link', 'option') ?: 'tel:036065023100';
  $email = get_field('email', 'option') ?: 'info@eco-timber.de';

  $phoneBtnClass = $phoneBtnClass ?? 'btn-clean text-gray-medium';
  $phoneIconColor = $phoneIconColor ?? 'text-primary';
  $emailBtnClass = $emailBtnClass ?? 'btn-primary-outline';

  $align = $align ?? 'justify-center';
@endphp

<div class="flex xs:flex-row flex-col items-center {{ $align }} gap-10 font-medium">
  <a href="tel:{{ $phoneLink }}" class="btn btn-clean {{ $phoneBtnClass }}">
    <i class="fa-regular fa-phone-arrow-right text-2xl {{ $phoneIconColor }}"></i>
    {{ $phone }}
  </a>
  <a href="mailto:{{ $email }}" class="btn {{ $emailBtnClass }}">
    E-Mail an uns
  </a>
</div>
