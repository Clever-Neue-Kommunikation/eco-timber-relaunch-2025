<?php

namespace App;

add_action('acf/init', function () {
  acf_add_local_field_group([
    'key' => 'group_services_grid',
    'title' => 'Services Grid – Einstellungen',
    'fields' => [
      [
        'key' => 'field_sg_title',
        'label' => 'Titel',
        'name' => 'title',
        'type' => 'text',
      ],
      [
        'key' => 'field_sg_subtitle',
        'label' => 'Subtitel',
        'name' => 'subtitle',
        'type' => 'text',
      ],
      [
        'key' => 'field_sg_description',
        'label' => 'Beschreibung',
        'name' => 'description',
        'type' => 'wysiwyg',
        'media_upload' => 0,
        'delay' => 1,
      ],
      [
        'key' => 'field_sg_items',
        'label' => 'Grid-Elemente',
        'name' => 'items',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Element hinzufügen',
        'sub_fields' => [
          [
            'key' => 'field_sg_item_image',
            'label' => 'Bild',
            'name' => 'image',
            'type' => 'image',
            'return_format' => 'id',
            'preview_size' => 'medium',
          ],
          [
            'key' => 'field_sg_item_title',
            'label' => 'Titel',
            'name' => 'title',
            'type' => 'text',
          ],
          [
            'key' => 'field_sg_item_description',
            'label' => 'Beschreibung',
            'name' => 'description',
            'type' => 'textarea',
          ],
          [
            'key' => 'field_sg_item_button_text',
            'label' => 'Button-Text',
            'name' => 'button_text',
            'type' => 'text',
          ],
          [
            'key' => 'field_sg_item_button_url',
            'label' => 'Button-Link',
            'name' => 'button_url',
            'type' => 'url',
          ],
          [
            'key' => 'field_sg_item_color_scheme',
            'label' => 'Farb-Schema',
            'name' => 'color_scheme',
            'type' => 'select',
            'choices' => [
              'primary' => 'Primary (Grün)',
              'secondary' => 'Secondary (Dunkelgrün)',
            ],
            'default_value' => 'primary',
            'allow_null' => 0,
            'multiple' => 0,
          ],
        ],
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/services-grid',
        ],
      ],
    ],
  ]);

  acf_register_block_type([
    'name' => 'services-grid',
    'title' => __('Services Grid', 'sage'),
    'render_callback' => __NAMESPACE__ . '\\render_services_grid',
    'category' => 'flowbite-blocks',
    'icon' => 'grid-view',
    'keywords' => ['leistungen', 'services', 'grid'],
    'supports' => [
      'align' => true,
      'mode' => 'auto',
      'jsx' => true,
      'className' => true,
    ],
  ]);
});

function render_services_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
  echo \Roots\view('blocks.services-grid', [
    'block' => $block,
    'is_preview' => $is_preview,
  ]);
}
