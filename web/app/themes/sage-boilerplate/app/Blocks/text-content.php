<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_text_content',
    'title' => 'Text Content – Einstellungen',
    'fields' => [
      [
        'key' => 'field_tc_headline',
        'label' => 'Headline',
        'name' => 'headline',
        'type' => 'text',
      ],
      [
        'key' => 'field_tc_subheadline',
        'label' => 'Subheadline',
        'name' => 'subheadline',
        'type' => 'text',
      ],
      [
        'key' => 'field_tc_text',
        'label' => 'Text',
        'name' => 'text',
        'type' => 'wysiwyg',
        'media_upload' => 0,
        'delay' => 1,
      ],
      [
        'key' => 'field_tc_show_buttons',
        'label' => 'Contact-Buttons anzeigen',
        'name' => 'show_buttons',
        'type' => 'true_false',
        'ui' => 1,
        'default_value' => 1,
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/text-content',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'text-content',
    'title' => __('Text Content', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_text_content',
    'category' => 'flowbite-blocks',
    'icon' => 'editor-alignleft',
    'keywords' => ['text', 'content', 'static'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_text_content($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.text-content', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
