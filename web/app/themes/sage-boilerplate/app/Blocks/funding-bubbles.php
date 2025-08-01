<?php

namespace App;

add_action('acf/init', function () {
    // Feldgruppe registrieren
    acf_add_local_field_group([
        'key'   => 'group_funding_bubbles',
        'title' => 'Förder-Bubble-Element – Einstellungen',
        'fields'=> [
            [
                'key'   => 'field_fb_section_title',
                'label' => 'Sektionstitel',
                'name'  => 'fb_section_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_fb_section_subtitle',
                'label' => 'Untertitel',
                'name'  => 'fb_section_subtitle',
                'type'  => 'text',
            ],
            [
                'key'         => 'field_fb_items',
                'label'       => 'Bubbles (in Reihenfolge)',
                'name'        => 'fb_items',
                'type'        => 'repeater',
                'layout'      => 'row',
                'button_label'=> 'Bubble hinzufügen',
                'sub_fields'  => [
                    [
                        'key'   => 'field_fb_item_text',
                        'label' => 'Text',
                        'name'  => 'text',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'   => 'field_fb_item_subtext',
                        'label' => 'SubText',
                        'name'  => 'subtext',
                        'type'  => 'textarea',
                        
                    ],
                    [
                        'key'   => 'field_fb_item_highlight',
                        'label' => 'Hervorheben?',
                        'name'  => 'highlight',
                        'type'  => 'true_false',
                        'ui'    => 1,
                        'message' => 'Diesen Bubble farbig füllen',
                        'default_value' => 0,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/funding-bubbles',
                ],
            ],
        ],
    ]);

    // Block registrieren
    acf_register_block_type([
        'name'            => 'funding-bubbles',
        'title'           => __('Förder-Bubbles', 'sage'),
        'description'     => __('Horizontales Bubble-Diagramm mit "+" dazwischen', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_funding_bubbles',
        'category'        => 'flowbite-blocks',
        'icon'            => 'editor-ul',
        'keywords'        => ['bubble','förder','kfw','förderung'],
        'mode'            => 'preview',
        'supports'        => [
            'align'     => true,
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_funding_bubbles($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.funding-bubbles', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}
