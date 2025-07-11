<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_site_contact',
    'title' => 'Kontaktinformationen',
    'fields' => [
      [
        'key' => 'field_phone',
        'label' => 'Telefonnummer',
        'name' => 'phone',
        'type' => 'text',
      ],
      [
        'key' => 'field_phone_link',
        'label' => 'Telefonnummer-Link',
        'name' => 'phone_link',
        'type' => 'text',
      ],
      [
        'key' => 'field_email',
        'label' => 'E-Mail-Adresse',
        'name' => 'email',
        'type' => 'text',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'site-options',
        ],
      ],
    ],
  ]);
});
