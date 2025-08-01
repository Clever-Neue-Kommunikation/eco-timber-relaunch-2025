<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_advantages_grid',
        'title'  => 'Advantages Grid – Einstellungen',
        'fields' => [
            [
                'key'   => 'field_ag_title',
                'label' => 'Blocktitel',
                'name'  => 'ag_title',
                'type'  => 'text',
                'instructions' => 'Überschrift oben, z.B. „Ihre Vorteile“',
            ],
            [
                'key'         => 'field_ag_items',
                'label'       => 'Vorteile',
                'name'        => 'ag_items',
                'type'        => 'repeater',
                'layout'      => 'block',
                'button_label'=> 'Vorteil hinzufügen',
                'sub_fields'  => [
                    [
                        'key'   => 'field_ag_icon',
                        'label' => 'Icon-Klasse',
                        'name'  => 'icon_class',
                        'type'  => 'text',
                        'instructions' => 'Font-Awesome-Klasse, z.B. „fa-solid fa-hourglass-fast“',
                    ],
                    [
                        'key'   => 'field_ag_text',
                        'label' => 'Text unter dem Icon',
                        'name'  => 'text',
                        'type'  => 'textarea',
                        'rows'  => 2,
                        'instructions' => 'Kurzer Satz oder Stichpunkt.',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/advantages-grid',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'advantages-grid',
        'title'           => __('Advantages Grid', 'sage'),
        'description'     => __('Icon-Grid mit kurzer Beschriftung', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_advantages_grid',
        'category'        => 'flowbite-blocks',
        'icon'            => 'star-filled',
        'keywords'        => ['advantages','icons','grid'],
        'mode'            => 'preview',
        'supports'        => [
            'align'     => ['wide','full'],
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_advantages_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.advantages-grid', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}
