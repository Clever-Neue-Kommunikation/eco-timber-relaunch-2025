<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_logo_grid',
        'title' => 'Logo/Partner Grid Einstellungen',

        'fields' => [
            [
                'key' => 'field_show_buttons',
                'label' => 'Kontakt-Buttons anzeigen',
                'name' => 'show_buttons',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
            ],
            [
                'key' => 'field_logo_grid_list',
                'label' => 'Logos / Mitglieder',
                'name' => 'logo_grid_list',
                'type' => 'repeater',
                'button_label' => 'Logo/Mitglied hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_logo_grid_image',
                        'label' => 'Logo',
                        'name' => 'logo',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ],
                    [
                        'key' => 'field_logo_grid_name',
                        'label' => 'Name/Bezeichnung',
                        'name' => 'name',
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
                    'value' => 'acf/logo-grid',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'logo-grid',
        'title' => __('Logo/Partner Grid', 'sage'),
        'description' => __('Raster mit Logos und Namen, z. B. für Mitgliedschaften, Partner, Institutionen etc.', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'grid-view',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['logo', 'grid', 'partner', 'mitglieder', 'icon'],
        'render_callback' => __NAMESPACE__ . '\\render_logo_grid',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_logo_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.logo-grid', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}
