<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_hero_section',
    'title' => 'Hero Section – Einstellungen',
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
        'key' => 'field_cs_headline',
        'label' => 'Überschrift',
        'name' => 'headline',
        'type' => 'text',
      ],
      [
        'key' => 'field_cs_subtitle',
        'label' => 'Subtitle',
        'name' => 'subtitle',
        'type' => 'text',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/hero-section',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'hero-section',
    'title' => __('Hero Section', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_hero_section',
    'category' => 'flowbite-blocks',
    'icon' => 'columns',
    'keywords' => ['hero', 'section', 'image'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_hero_section($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.hero-section', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
