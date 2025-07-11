<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_partner_grid',
        'title' => 'Partner Grid Einstellungen',
        'fields' => [
            [
                'key' => 'field_partner_grid_title',
                'label' => 'Block-Titel',
                'name' => 'partner_grid_title',
                'type' => 'text',
                'default_value' => 'Wir sind der richtige Partner für …',
            ],
            [
                'key' => 'field_partner_grid_items',
                'label' => 'Partner-Module',
                'name' => 'partner_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Modul hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_partner_icon',
                        'label' => 'Icon-Klasse',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'z. B. "fa-solid fa-house-chimney-user"',
                    ],
                    [
                        'key' => 'field_partner_heading',
                        'label' => 'Überschrift',
                        'name' => 'heading',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_partner_text',
                        'label' => 'Beschreibungstext',
                        'name' => 'text',
                        'type' => 'wysiwyg',
                        'media_upload' => 0,
                        'delay' => 1,
                    ],
                    [
                        'key' => 'field_partner_highlight',
                        'label' => 'Hervorheben (grüner Rahmen)',
                        'name' => 'highlight',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 0,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/partner-grid',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'partner-grid',
        'title' => __('Partner Grid', 'sage'),
        'description' => __('Grid mit Service- und Leistungsmodule', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'groups',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['partner', 'module', 'grid'],
        'render_callback' => __NAMESPACE__ . '\\render_partner_grid',
        'supports' => [
            'align' => ['wide', 'full'],
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_partner_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.partner-grid', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}
