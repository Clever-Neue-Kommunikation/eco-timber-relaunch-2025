<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_icon_grid',
    'title' => 'Icon Grid – Einstellungen',
    'fields' => [
      [
        'key' => 'field_ig_headline',
        'label' => 'Überschrift',
        'name' => 'headline',
        'type' => 'text',
      ],
      [
        'key' => 'field_ig_subtitle',
        'label' => 'Subtitel',
        'name' => 'ig_subtitle',
        'type' => 'text',
      ],
      [
        'key' => 'field_ig_text_align',
        'label' => 'Textausrichtung',
        'name' => 'reference_text_align',
        'type' => 'button_group',
        'choices' => [
          'text-left' => 'Links',
          'text-center' => 'Zentriert',
          'text-right' => 'Rechts',
        ],
        'default_value' => 'text-left',
        'layout' => 'horizontal',
      ],
      [
        'key' => 'field_ig_columns',
        'label' => 'Anzahl Spalten',
        'name' => 'columns',
        'type' => 'select',
        'choices' => [
          '2' => '2',
          '3' => '3',
          '4' => '4',
          '5' => '5',
          '6' => '6',
        ],
        'default_value' => '4',
        'ui' => 1,
      ],
      [
        'key' => 'field_use_large_text',
        'label' => 'Große fette Schrift verwenden?',
        'name' => 'use_large_text',
        'type' => 'true_false',
        'ui' => 1,
        'default_value' => 0,
      ],
      [
        'key' => 'field_ig_bg_color',
        'label' => 'Hintergrundfarbe',
        'name' => 'bg_color',
        'type' => 'select',
        'choices' => [
          'white' => 'Weiß',
          'green' => 'Grün',
        ],
        'default_value' => 'white',
        'ui' => 1,
      ],
      [
        'key' => 'field_ig_items',
        'label' => 'Items',
        'name' => 'items',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Item hinzufügen',
        'sub_fields' => [
          [
            'key' => 'field_ig_icon',
            'label' => 'Icon-Klasse (Font Awesome)',
            'name' => 'icon',
            'type' => 'text',
          ],
          [
            'key' => 'field_ig_text',
            'label' => 'Text',
            'name' => 'text',
            'type' => 'text',
          ],
          [
            'key' => 'field_highlight',
            'label' => 'Item hervorheben?',
            'name' => 'use_highlight',
            'type' => 'true_false',
            'ui' => 1,
            'default_value' => 0,
          ],
        ],
      ],
      [
        'key' => 'field_ig_show_buttons',
        'label' => 'Contact-Buttons anzeigen',
        'name' => 'show_buttons',
        'type' => 'true_false',
        'ui' => 1,
        'default_value' => 1,
      ],
      [
        'key' => 'field_ig_button_text',
        'label' => 'Button – Text',
        'name' => 'button_text',
        'type' => 'text',
      ],
      [
        'key' => 'field_ig_button_url',
        'label' => 'Button – URL',
        'name' => 'button_url',
        'type' => 'url',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/icon-grid',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'icon-grid',
    'title' => __('Icon Grid', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_icon_grid',
    'category' => 'flowbite-blocks',
    'icon' => 'screenoptions',
    'keywords' => ['icons', 'grid', 'features'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_icon_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.icon-grid', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
