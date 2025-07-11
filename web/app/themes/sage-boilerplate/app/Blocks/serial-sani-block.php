<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_serial_sani',
        'title' => 'Serielle energetische Sanierung',
        'fields' => [
            [
                'key' => 'field_serial_title',
                'label' => 'Titel',
                'name' => 'serial_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_serial_subtitle',
                'label' => 'Untertitel',
                'name' => 'serial_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_serial_features',
                'label' => 'Vorteile (Liste)',
                'name' => 'serial_features',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Vorteil hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_serial_feature_icon',
                        'label' => 'Icon-Klasse',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'z.B. "fa-solid fa-check"',
                    ],
                    [
                        'key' => 'field_serial_feature_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_serial_image1',
                'label' => 'Bild Vorteile',
                'name' => 'serial_image1',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_serial_buildings_title',
                'label' => 'Überschrift Gebäude',
                'name' => 'serial_buildings_title',
                'type' => 'text',
                'default_value' => 'Geeignete Gebäude',
            ],
            [
                'key' => 'field_serial_buildings',
                'label' => 'Gebäude-Liste',
                'name' => 'serial_buildings',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Punkt hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_serial_building_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'key' => 'field_serial_image2',
                'label' => 'Bild Gebäude',
                'name' => 'serial_image2',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_serial_quote',
                'label' => 'Zitat',
                'name' => 'serial_quote',
                'type' => 'textarea',
            ],
            [
                'key' => 'field_serial_attribution',
                'label' => 'Attribution',
                'name' => 'serial_attribution',
                'type' => 'text',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/serial-sani-block',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'serial-sani-block',
        'title' => __('Serielle energetische Sanierung', 'sage'),
        'description' => __('Vorteile + Voraussetzungen auf einen Blick', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'list-view',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['serielle', 'sanierung', 'vorteile'],
        'render_callback' => __NAMESPACE__ . '\\render_serial_sani_block',
        'supports' => [
            'align' => ['wide', 'full'],
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_serial_sani_block($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.serial-sani-block', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}
