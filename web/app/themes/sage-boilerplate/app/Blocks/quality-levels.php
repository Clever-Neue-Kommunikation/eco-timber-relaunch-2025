<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_quality_levels',
        'title' => 'Qualitätsstufen – Einstellungen',
        'fields' => [
            [
                'key' => 'field_ql_title',
                'label' => 'Überschrift',
                'name' => 'ql_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_ql_subtitle',
                'label' => 'Untertitel',
                'name' => 'ql_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_ql_levels',
                'label' => 'Stufen',
                'name' => 'ql_levels',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Stufe hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_ql_level_label',
                        'label' => 'Name der Stufe',
                        'name' => 'label',
                        'type' => 'wysiwyg',
                        'tabs' => 'visual',
                        'media_upload' => 0,
                        'delay' => 1,
                    ],
                    [
                        'key' => 'field_ql_level_stars',
                        'label' => 'Sterne (1–3)',
                        'name' => 'stars',
                        'type' => 'number',
                        'min' => 1,
                        'max' => 3,
                        'default_value' => 1,
                    ],
                    [
                        'key' => 'field_ql_level_features',
                        'label' => 'Leistungspunkte',
                        'name' => 'features',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'button_label' => 'Punkt hinzufügen',
                        'sub_fields' => [
                            [
                                'key' => 'field_ql_feature_text',
                                'label' => 'Text',
                                'name' => 'text',
                                'type' => 'text',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/quality-levels',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'quality-levels',
        'title' => __('Qualitätsstufen', 'sage'),
        'description' => __('Drei Leistungsstufen mit Sternen und Bullet-Points', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_quality_levels',
        'category' => 'flowbite-blocks',
        'icon' => 'star-filled',
        'keywords' => ['qualität', 'stufen', 'stars'],
        'mode' => 'preview',
        'supports' => [
            'align' => ['wide', 'full'],
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_quality_levels($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.quality-levels', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}
