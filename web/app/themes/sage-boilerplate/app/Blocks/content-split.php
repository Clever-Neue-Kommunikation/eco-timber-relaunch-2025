<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_content_split',
    'title' => 'Content Split – Einstellungen',
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
        'key' => 'field_cs_image_position',
        'label' => 'Bildposition',
        'name' => 'image_position',
        'type' => 'select',
        'choices' => [
          'left' => 'Links',
          'right' => 'Rechts',
        ],
        'default_value' => 'left',
      ],
      [
        'key' => 'field_cs_background',
        'label' => 'Hintergrundfarbe',
        'name' => 'background',
        'type' => 'select',
        'choices' => [
          'primary' => 'Grün (primary)',
          'secondary' => 'Dunkelgrün (secondary)',
        ],
        'default_value' => 'secondary',
      ],
      [
        'key' => 'field_cs_headline',
        'label' => 'Überschrift',
        'name' => 'headline',
        'type' => 'text',
      ],
      [
        'key' => 'field_cs_text',
        'label' => 'Text',
        'name' => 'text',
        'type' => 'wysiwyg',
        'media_upload' => 0,
        'delay' => 1,
      ],
      [
        'key' => 'field_cs_button_1_text',
        'label' => 'Button 1 – Text',
        'name' => 'button_1_text',
        'type' => 'text',
      ],
      [
        'key' => 'field_cs_show_buttons',
        'label' => 'Buttons anzeigen',
        'name' => 'show_buttons',
        'type' => 'true_false',
        'ui' => 1,
        'default_value' => 1,
      ],
      [
        'key' => 'field_cs_button_1_url',
        'label' => 'Button 1 – URL',
        'name' => 'button_1_url',
        'type' => 'url',
      ],
      [
        'key' => 'field_cs_button_2_text',
        'label' => 'Button 2 – Text',
        'name' => 'button_2_text',
        'type' => 'text',
      ],
      [
        'key' => 'field_cs_button_2_url',
        'label' => 'Button 2 – URL',
        'name' => 'button_2_url',
        'type' => 'url',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/content-split',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'content-split',
    'title' => __('Content Split', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_content_split',
    'category' => 'flowbite-blocks',
    'icon' => 'columns',
    'keywords' => ['content', 'split', 'image'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_content_split($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.content-split', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
