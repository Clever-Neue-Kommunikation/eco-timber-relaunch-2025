<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_project_benefits',
    'title' => 'Projekt-Benefits – Einstellungen',
    'fields' => [
      [
        'key' => 'field_pb_title',
        'label' => 'Titel',
        'name' => 'title',
        'type' => 'text',
      ],
      [
        'key' => 'field_pb_text',
        'label' => 'Beschreibung',
        'name' => 'text',
        'type' => 'wysiwyg',
        'media_upload' => 0,
        'delay' => 1,
      ],
      [
        'key' => 'field_pb_icons',
        'label' => 'Vorteile',
        'name' => 'benefits',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Vorteil hinzufügen',
        'sub_fields' => [
          [
            'key' => 'field_pb_icon_class',
            'label' => 'Icon-Klasse (Font Awesome)',
            'name' => 'icon',
            'type' => 'text',
          ],
          [
            'key' => 'field_pb_icon_text',
            'label' => 'Text',
            'name' => 'text',
            'type' => 'text',
          ],
        ],
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/project-benefits',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'project-benefits',
    'title' => __('Projekt-Benefits', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_project_benefits',
    'category' => 'flowbite-blocks',
    'icon' => 'lightbulb',
    'keywords' => ['projekt', 'benefits', 'vorteile'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_project_benefits($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.project-benefits', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
