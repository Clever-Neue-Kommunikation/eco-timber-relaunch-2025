<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_card_grid',
        'title' => 'Card Grid Einstellungen',
        'fields' => [
            [
                'key' => 'field_card_grid_title',
                'label' => 'Block-Titel',
                'name' => 'card_grid_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_card_grid_subtitle',
                'label' => 'Untertitel',
                'name' => 'card_grid_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_card_grid_description',
                'label' => 'Einleitungstext',
                'name' => 'card_grid_description',
                'type' => 'text',
            ],
            [
                'key' => 'field_card_grid_cards',
                'label' => 'Cards',
                'name' => 'cards',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Card hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_card_icon',
                        'label' => 'Icon-Klasse',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'z. B. "fa-solid fa-gear"',
                    ],
                    [
                        'key' => 'field_card_heading',
                        'label' => 'Überschrift',
                        'name' => 'heading',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_card_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'textarea',
                    ],
                    [
                        'key' => 'field_card_highlight',
                        'label' => 'Hervorheben',
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
                    'value' => 'acf/card-grid',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'card-grid',
        'title' => __('Card Grid', 'sage'),
        'description' => __('Ein Grid mit Karten', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'grid-view',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['card', 'grid'],
        'render_callback' => __NAMESPACE__ . '\\render_card_grid',
        'supports' => [
            'align' => ['wide', 'full'],
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_card_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.card-grid', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}
