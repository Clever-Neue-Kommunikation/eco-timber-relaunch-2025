<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_layered_block',
        'title'  => 'Bild mit Nummernliste Einstellungen',
        'fields' => [
            [
                'key'   => 'field_layered_block_title',
                'label' => 'Block-Titel',
                'name'  => 'layered_block_title',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_layered_image',
                'label'        => 'Bild',
                'name'         => 'layered_image',
                'type'         => 'image',
                'return_format'=> 'array',
                'preview_size' => 'medium',
            ],
            [
                'key'          => 'field_layered_items',
                'label'        => 'Nummerierte Liste',
                'name'         => 'layered_items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Punkt hinzufügen',
                'sub_fields'   => [
                    [
                        'key'   => 'field_layered_number',
                        'label' => 'Nummer',
                        'name'  => 'number',
                        'type'  => 'text',
                        'default_value' => '1',
                    ],
                    [
                        'key'   => 'field_layered_description',
                        'label' => 'Beschreibung',
                        'name'  => 'description',
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
                    'value'    => 'acf/layered-block',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'layered-block',
        'title'           => __('Bild mit Nummernliste', 'sage'),
        'description'     => __('Bild links, nummerierte Liste rechts', 'sage'),
        'category'        => 'flowbite-blocks',
        'icon'            => 'format-image',
        'mode'            => 'preview',
        'align'           => 'full',
        'keywords'        => ['bild', 'liste', 'nummer'],
        'render_callback' => __NAMESPACE__ . '\\render_layered_block',
        'supports'        => [
            'align'     => ['wide', 'full'],
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_layered_block($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.layered-block', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}
