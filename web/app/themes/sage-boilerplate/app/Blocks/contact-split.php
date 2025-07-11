<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_contact_split',
    'title' => 'Kontakt Split – Einstellungen',
    'fields' => [
        [
        'key' => 'field_cs_image',
        'label' => 'Bild',
        'name' => 'image',
        'type' => 'image',
        'return_format' => 'id',
        'preview_size' => 'medium',
      ],
      [
        'key' => 'field_cs_text1',
        'label' => 'Beschreibung',
        'name' => 'text1',
        'type' => 'wysiwyg',
        'media_upload' => 0,
        'delay' => 1,
      ],
      [
        'key' => 'field_cs_text2',
        'label' => 'Beschreibung',
        'name' => 'text2',
        'type' => 'wysiwyg',
        'media_upload' => 0,
        'delay' => 1,
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/contact-split',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'contact-split',
    'title' => __('Contact-Split', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_contact_split',
    'category' => 'flowbite-blocks',
    'icon' => 'phone',
    'keywords' => ['contact', 'split'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_contact_split($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.contact-split', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
