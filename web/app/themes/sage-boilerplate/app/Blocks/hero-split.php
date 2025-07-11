<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_hero_split',
    'title' => 'Hero Split – Einstellungen',
    'fields' => [
      [
        'key' => 'field_hero_image',
        'label' => 'Bild',
        'name' => 'image',
        'type' => 'image',
        'return_format' => 'id',
        'preview_size' => 'medium',
      ],
      [
        'key' => 'field_hero_headline',
        'label' => 'Überschrift',
        'name' => 'headline',
        'type' => 'text',
      ],
      [
        'key' => 'field_hero_text',
        'label' => 'Text',
        'name' => 'text',
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
          'value' => 'acf/hero-split',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'hero-split',
    'title' => __('Hero Split', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_hero_split',
    'category' => 'flowbite-blocks',
    'icon' => 'align-left',
    'keywords' => ['hero', 'split', 'image'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_hero_split($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.hero-split', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
