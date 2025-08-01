<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_build_types',
        'title'  => 'Anbau-/Aufstockungsarten – Einstellungen',
        'fields' => [
            [
                'key'   => 'field_bt_section_title',
                'label' => 'Sektionstitel',
                'name'  => 'bt_section_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_bt_left_description',
                'label' => 'Sektion Beschreibung',
                'name'  => 'bt_left_description',
                'type'  => 'wysiwyg',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key'   => 'field_bt_right_description',
                'label' => 'Sektion Beschreibung rechts',
                'name'  => 'bt_right_description',
                'type'  => 'wysiwyg',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key'   => 'field_bt_button_text',
                'label' => 'Button Text',
                'name'  => 'bt_button_text',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_bt_button_url',
                'label' => 'Button URL',
                'name'  => 'bt_button_url',
                'type'  => 'url',
            ],
            [
                'key'          => 'field_bt_items',
                'label'        => 'Typen',
                'name'         => 'bt_items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Typ hinzufügen',
                'sub_fields'   => [
                    [
                        'key'           => 'field_bt_item_image',
                        'label'         => 'Bild',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                        'library'       => 'all',
                    ],
                    [
                        'key'   => 'field_bt_item_label',
                        'label' => 'Beschriftung',
                        'name'  => 'label',
                        'type'  => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/build-types',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'build-types',
        'title'           => __('Anbau-/Aufstockungsarten', 'sage'),
        'description'     => __('Darstellung verschiedener Anbau- und Aufstockungsarten', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_build_types',
        'category'        => 'flowbite-blocks',
        'icon'            => 'images-alt2',
        'keywords'        => ['anbau', 'aufstockung', 'arten'],
        'mode'            => 'preview',
        'supports'        => [
            'align'     => true,
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_build_types($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.build-types', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}
