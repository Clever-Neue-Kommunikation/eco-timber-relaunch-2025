<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_tilgung_table',
        'title'  => 'Tilgungszuschuss-Tabelle',
        'fields' => [
            [
                'key'   => 'field_tilgung_rows',
                'label' => 'Tabellenzeilen',
                'name'  => 'rows',
                'type'  => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Zeile hinzufügen',
                'sub_fields'   => [
                    [
                        'key'   => 'field_row_label',
                        'label' => 'Reihen-Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_row_standard',
                        'label' => 'Standard',
                        'name'  => 'standard',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_row_ee',
                        'label' => 'EE',
                        'name'  => 'ee',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_row_nh',
                        'label' => 'NH',
                        'name'  => 'nh',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_row_wpb',
                        'label' => 'WPB',
                        'name'  => 'wpb',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_row_sersan',
                        'label' => 'SerSan',
                        'name'  => 'sersan',
                        'type'  => 'text',
                    ],
                ],
            ],
            [
                'key'   => 'field_tilgung_source',
                'label' => 'Quelle / Fußnote',
                'name'  => 'source',
                'type'  => 'text',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/tilgung-table',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'tilgung-table',
        'title'           => __('Tilgungszuschuss-Tabelle', 'sage'),
        'description'     => __('Tabelle mit Effizienzhaus-Förderhöhen', 'sage'),
        'category'        => 'flowbite-blocks',
        'icon'            => 'editor-table', 
        'mode'            => 'preview',
        'align'           => 'wide',
        'keywords'        => ['tabelle','förderung','effizienzhaus'],
        'render_callback' => __NAMESPACE__ . '\\render_tilgung_table',
        'supports'        => [
            'align'     => ['wide','full'],
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_tilgung_table($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.tilgung-table', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}
